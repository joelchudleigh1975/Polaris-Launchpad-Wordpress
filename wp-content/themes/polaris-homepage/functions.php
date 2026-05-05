<?php
/**
 * Polaris Blocks Registration and Setup
 *
 * Handles block registration and asset enqueueing
 * for all Polaris custom blocks.
 *
 * @package PolarisLaunchpad
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme styles
 *
 * Loads all theme stylesheets in the correct order
 */
function polaris_enqueue_styles() {
    $theme_dir = get_template_directory();

    // Global styles
    wp_enqueue_style(
        'polaris-globals',
        get_template_directory_uri() . '/globals.css',
        array(),
        filemtime($theme_dir . '/globals.css')
    );

    // Styleguide
    wp_enqueue_style(
        'polaris-styleguide',
        get_template_directory_uri() . '/styleguide.css',
        array('polaris-globals'),
        filemtime($theme_dir . '/styleguide.css')
    );

    // Main theme styles
    wp_enqueue_style(
        'polaris-theme-style',
        get_stylesheet_uri(),
        array('polaris-globals', 'polaris-styleguide'),
        filemtime($theme_dir . '/style.css')
    );
}
add_action('wp_enqueue_scripts', 'polaris_enqueue_styles');

/**
 * Fix company name on legal pages
 *
 * Replaces bare "Polaris Launchpad" (not already followed by " Ltd") with
 * "Polaris Launchpad Ltd" on the Privacy Policy and Terms pages, so the
 * legal name shown to visitors matches the registered company name on
 * Companies House (Company No. 16538085).
 *
 * @param string $content Post content.
 * @return string Modified content.
 */
function polaris_fix_legal_company_name( $content ) {
    $legal_slugs = array( 'privacy-policy', 'terms', 'terms-of-service', 'terms-and-conditions' );
    $post        = get_post();

    if ( ! $post || ! in_array( $post->post_name, $legal_slugs, true ) ) {
        return $content;
    }

    // Replace "Polaris Launchpad" not already followed by " Ltd"
    return preg_replace( '/Polaris Launchpad(?! Ltd)/', 'Polaris Launchpad Ltd', $content );
}
add_filter( 'the_content', 'polaris_fix_legal_company_name' );

/**
 * Enqueue block editor assets
 *
 * Loads JavaScript for block editor functionality
 */
function polaris_enqueue_block_editor_assets() {
    $theme_version = wp_get_theme()->get('Version');

    // Single blocks JavaScript file
    $blocks_js = get_template_directory() . '/blocks.js';
    if (file_exists($blocks_js)) {
        wp_enqueue_script(
            'polaris-blocks',
            get_template_directory_uri() . '/blocks.js',
            array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components'),
            $theme_version,
            true
        );
    }

    // Enqueue editor styles if file exists
    $editor_css = get_template_directory() . '/editor-style.css';
    if (file_exists($editor_css)) {
        wp_enqueue_style(
            'polaris-editor-styles',
            get_template_directory_uri() . '/editor-style.css',
            array(),
            $theme_version
        );
    }
}
add_action('enqueue_block_editor_assets', 'polaris_enqueue_block_editor_assets');

/**
 * Load all block files
 *
 * Automatically includes all PHP files from the blocks directory
 */
function polaris_load_blocks() {
    $blocks_dir = get_template_directory() . '/blocks/';

    // Check if blocks directory exists
    if (!is_dir($blocks_dir)) {
        return;
    }

    // Include all PHP files in blocks directory
    $block_files = glob($blocks_dir . '*.php');

    if (!empty($block_files)) {
        foreach ($block_files as $block_file) {
            if (is_readable($block_file)) {
                require_once $block_file;
            }
        }
    }
}
add_action('after_setup_theme', 'polaris_load_blocks');

/**
 * Add theme support features
 */
function polaris_theme_setup() {
    // Add support for block styles
    add_theme_support('wp-block-styles');

    // Add support for wide alignment
    add_theme_support('align-wide');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for custom line height
    add_theme_support('custom-line-height');

    // Add support for custom spacing
    add_theme_support('custom-spacing');

    // Let WordPress manage the <title> tag (prevents "homepage" / blank titles)
    add_theme_support('title-tag');

    // Add support for post thumbnails (useful for blocks)
    add_theme_support('post-thumbnails');

    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
}
add_action('after_setup_theme', 'polaris_theme_setup');

/**
 * Enhanced debug function - shows comprehensive block info
 */
function polaris_debug_blocks() {
    if (is_admin() && current_user_can('edit_posts') && isset($_GET['debug_polaris'])) {
        add_action('admin_notices', function() {
            global $wp_version;
            $blocks_dir = get_template_directory() . '/blocks/';
            $blocks_js = get_template_directory() . '/blocks.js';
            
            echo '<div class="notice notice-info"><p>';
            echo '<strong>Polaris Debug Info:</strong><br>';
            echo 'WordPress Version: ' . $wp_version . '<br>';
            echo 'Theme Directory: ' . get_template_directory() . '<br>';
            echo 'Blocks directory exists: ' . (is_dir($blocks_dir) ? 'Yes' : 'No') . '<br>';
            echo 'blocks.js exists: ' . (file_exists($blocks_js) ? 'Yes' : 'No') . '<br>';
            echo 'blocks.js readable: ' . (is_readable($blocks_js) ? 'Yes' : 'No') . '<br>';
            echo 'blocks.js size: ' . (file_exists($blocks_js) ? filesize($blocks_js) . ' bytes' : 'N/A') . '<br>';
            echo 'PHP files in blocks/: ' . count(glob($blocks_dir . '*.php')) . '<br>';
            
            // List PHP block files
            $php_files = glob($blocks_dir . '*.php');
            if (!empty($php_files)) {
                echo 'Block files: ' . implode(', ', array_map('basename', $php_files)) . '<br>';
            }
            
            echo '</p></div>';
        });

        // Add JavaScript debug info to admin footer
        add_action('admin_footer', function() {
            if (get_current_screen()->base === 'post') {
                ?>
                <script>
                console.log('=== POLARIS DEBUG INFO ===');
                console.log('wp.blocks available:', typeof wp.blocks !== 'undefined');
                console.log('wp.element available:', typeof wp.element !== 'undefined');
                console.log('wp.blockEditor available:', typeof wp.blockEditor !== 'undefined');
                console.log('wp.components available:', typeof wp.components !== 'undefined');
                
                // Check if polaris blocks are registered
                if (typeof wp.blocks !== 'undefined' && wp.blocks.getBlockTypes) {
                    var polarisBlocks = wp.blocks.getBlockTypes().filter(function(block) {
                        return block.name.startsWith('polaris/');
                    });
                    console.log('Registered Polaris blocks:', polarisBlocks.map(function(b) { return b.name; }));
                }
                </script>
                <?php
            }
        });
    }
}
add_action('init', 'polaris_debug_blocks');

add_action('init', 'polaris_debug_blocks');

  // Remove page titles from all pages
  add_filter('the_title', 'hide_page_titles_in_content', 10, 2);
  function hide_page_titles_in_content($title, $id) {
      if (is_page() && in_the_loop()) {
          return '';
      }
      return $title;
  }
 // Pricing Plans Block Toggle Functionality
  function polaris_pricing_plans_toggle_script() {
      ?>
      <script>
      document.addEventListener('DOMContentLoaded', function() {
          const pricingPlansToggle =
  document.querySelector('.wp-block-polaris-pricing-plans .group-wrapper');
          const pricingPlansMonthly =
  document.querySelector('.wp-block-polaris-pricing-plans .group-17');
          const pricingPlansAnnual =
  document.querySelector('.wp-block-polaris-pricing-plans .group-18');
          const pricingPlansGroup =
  document.querySelector('.wp-block-polaris-pricing-plans .pricing-page .group');

          if (pricingPlansToggle && pricingPlansMonthly &&
  pricingPlansAnnual && pricingPlansGroup) {
              // Click on pricing plans toggle capsule itself
              pricingPlansToggle.addEventListener('click', function() {
                  pricingPlansToggle.classList.toggle('pricing-plans-annual');
                  pricingPlansGroup.classList.toggle('pricing-plans-annual');
              });

              // Click on Monthly Pro Plan text
              pricingPlansMonthly.addEventListener('click', function() {
                  pricingPlansToggle.classList.remove('pricing-plans-annual');
                  pricingPlansGroup.classList.remove('pricing-plans-annual');
              });

              // Click on Annual Pro Plan text
              pricingPlansAnnual.addEventListener('click', function() {
                  pricingPlansToggle.classList.add('pricing-plans-annual');
                  pricingPlansGroup.classList.add('pricing-plans-annual');
              });
          }
      });
      </script>
      <?php
  }
  add_action('wp_footer', 'polaris_pricing_plans_toggle_script');

 // FAQ Block Accordion Functionality
  function polaris_faq_accordion_script() {
      ?>
      <script>
      document.addEventListener('DOMContentLoaded', function() {
          const faqItems = document.querySelectorAll('.FAQ .faq-item');

          faqItems.forEach(function(item) {
              const question = item.querySelector('.faq-question');
              const answer = item.querySelector('.faq-answer');
              const arrow = item.querySelector('.faq-arrow');

              if (question && answer && arrow) {
                  question.addEventListener('click', function() {
                      const isOpen = item.classList.contains('faq-open');

                      // Close all other FAQ items
                      faqItems.forEach(function(otherItem) {
                          if (otherItem !== item) {
                              otherItem.classList.remove('faq-open');
                              const otherArrow =
  otherItem.querySelector('.faq-arrow');
                              if (otherArrow) {
                                  otherArrow.src =
  otherArrow.src.replace('faq-arrow-up.png', 'vector-5-2.svg');
                              }
                          }
                      });

                      // Toggle current item
                      if (isOpen) {
                          item.classList.remove('faq-open');
                          arrow.src = arrow.src.replace('faq-arrow-up.png',
  'vector-5-2.svg');
                      } else {
                          item.classList.add('faq-open');
                          arrow.src = arrow.src.replace('vector-5-2.svg',
  'faq-arrow-up.png');
                      }
                  });
              }
          });
      });
      </script>
      <?php
  }
  add_action('wp_footer', 'polaris_faq_accordion_script');

// Include About Us block
  require_once get_template_directory() . '/blocks/about-us-block.php';

 // Include Features blocks
  require_once get_template_directory() .
  '/blocks/features-section1-block.php';
  require_once get_template_directory() .
  '/blocks/features-section2-block.php';
  require_once get_template_directory() .
  '/blocks/features-section3-block.php';
  require_once get_template_directory() .
  '/blocks/features-section4-block.php';

 // Include Blog Listing Block
  require_once get_template_directory() . '/blocks/blog-listing-block.php';

require_once get_template_directory() .
  '/blocks/blog-post-content-block.php';
  require_once get_template_directory() .
  '/blocks/related-articles-block.php';

/**
 * Open Graph, Twitter Card, and Schema.org meta tags
 *
 * Outputs social sharing and structured data tags for all page types.
 * Hooked into wp_head so it applies to every template automatically.
 * Blog posts use their featured image and excerpt; pages and the homepage
 * fall back to the Polaris Launchpad logo.
 */
function polaris_meta_tags() {
    // Never output on admin pages
    if ( is_admin() ) {
        return;
    }

    $site_name    = 'Polaris Launchpad';
    $site_url     = home_url();
    $default_desc = 'The AI-powered marketing platform built for small businesses. Generate content, build your brand, and launch to market faster.';
    $logo_url     = get_template_directory_uri() . '/img/polaris-logo-square.png';

    // --- Resolve title, description, image, URL and type per page context ---

    if ( is_front_page() || is_home() && ! is_singular() ) {
        // Homepage
        $og_title   = $site_name . ' - AI Marketing Tools for Small Businesses';
        $og_desc    = $default_desc;
        $og_image   = $logo_url;
        $og_url     = $site_url . '/';
        $og_type    = 'website';
        $schema_type = 'homepage';

    } elseif ( is_singular( 'post' ) ) {
        // Blog post
        global $post;
        setup_postdata( $post );
        $og_title = get_the_title();
        $og_desc  = get_the_excerpt();
        if ( ! $og_desc ) {
            $og_desc = wp_trim_words( strip_tags( get_the_content() ), 30 );
        }
        $og_desc  = wp_strip_all_tags( $og_desc );

        // Featured image or fall back to logo
        if ( has_post_thumbnail() ) {
            $img_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            $og_image = $img_data ? $img_data[0] : $logo_url;
        } else {
            $og_image = $logo_url;
        }

        $og_url   = get_permalink();
        $og_type  = 'article';
        $schema_type = 'post';

    } else {
        // All other pages (About, Features, Pricing, Blog index, etc.)
        $og_title = get_the_title() . ' - ' . $site_name;
        if ( is_archive() || is_home() ) {
            $og_title = 'Blog - ' . $site_name;
        }
        $og_desc = '';
        if ( is_singular() ) {
            global $post;
            setup_postdata( $post );
            $og_desc = get_the_excerpt();
            if ( ! $og_desc ) {
                $og_desc = wp_trim_words( strip_tags( get_the_content() ), 30 );
            }
            $og_desc = wp_strip_all_tags( $og_desc );
        }
        if ( ! $og_desc ) {
            $og_desc = $default_desc;
        }

        if ( is_singular() && has_post_thumbnail() ) {
            $img_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
            $og_image = $img_data ? $img_data[0] : $logo_url;
        } else {
            $og_image = $logo_url;
        }

        $og_url      = is_singular() ? get_permalink() : ( is_home() ? get_post_type_archive_link( 'post' ) : get_the_permalink() );
        $og_url      = $og_url ?: home_url( $_SERVER['REQUEST_URI'] );
        $og_type     = 'website';
        $schema_type = 'page';
    }

    // Sanitise for output
    $og_title = esc_attr( $og_title );
    $og_desc  = esc_attr( wp_trim_words( $og_desc, 35 ) ); // ~160 chars
    $og_image = esc_url( $og_image );
    $og_url   = esc_url( $og_url );
    $og_type  = esc_attr( $og_type );

    ?>

    <!-- Standard meta description (used by Google for indexing quality signals) -->
    <meta name="description" content="<?php echo $og_desc; ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type"        content="<?php echo $og_type; ?>">
    <meta property="og:url"         content="<?php echo $og_url; ?>">
    <meta property="og:site_name"   content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:title"       content="<?php echo $og_title; ?>">
    <meta property="og:description" content="<?php echo $og_desc; ?>">
    <meta property="og:image"       content="<?php echo $og_image; ?>">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale"      content="en_GB">

    <?php if ( $og_type === 'article' && isset( $post ) ) : ?>
    <meta property="article:published_time" content="<?php echo esc_attr( get_the_date( 'c', $post ) ); ?>">
    <meta property="article:modified_time"  content="<?php echo esc_attr( get_the_modified_date( 'c', $post ) ); ?>">
    <meta property="article:section"        content="Business &amp; Marketing">
    <?php endif; ?>

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo $og_title; ?>">
    <meta name="twitter:description" content="<?php echo $og_desc; ?>">
    <meta name="twitter:image"       content="<?php echo $og_image; ?>">

    <?php
    // --- Schema.org JSON-LD ---
    $org_schema = array(
        '@type'  => 'Organization',
        'name'   => 'Polaris Launchpad',
        'url'    => $site_url,
        'logo'   => array(
            '@type' => 'ImageObject',
            'url'   => $logo_url,
        ),
        'sameAs' => array(
            'https://www.linkedin.com/company/polaris-launchpad',
        ),
    );

    if ( $schema_type === 'homepage' ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@graph'   => array(
                array(
                    '@type'           => 'WebSite',
                    '@id'             => $site_url . '/#website',
                    'url'             => $site_url . '/',
                    'name'            => $site_name,
                    'description'     => $default_desc,
                    'inLanguage'      => 'en-GB',
                    'potentialAction' => array(
                        '@type'       => 'SearchAction',
                        'target'      => array(
                            '@type'       => 'EntryPoint',
                            'urlTemplate' => $site_url . '/?s={search_term_string}',
                        ),
                        'query-input' => 'required name=search_term_string',
                    ),
                ),
                $org_schema,
            ),
        );

    } elseif ( $schema_type === 'post' && isset( $post ) ) {
        $author_name = get_the_author_meta( 'display_name', $post->post_author );
        $schema = array(
            '@context'         => 'https://schema.org',
            '@type'            => 'BlogPosting',
            'headline'         => get_the_title( $post ),
            'description'      => wp_strip_all_tags( get_the_excerpt() ),
            'url'              => get_permalink( $post ),
            'datePublished'    => get_the_date( 'c', $post ),
            'dateModified'     => get_the_modified_date( 'c', $post ),
            'author'           => array(
                '@type' => 'Organization',
                'name'  => 'Polaris Launchpad',
            ),
            'publisher'        => $org_schema,
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id'   => get_permalink( $post ),
            ),
            'image'            => array(
                '@type' => 'ImageObject',
                'url'   => $og_image,
            ),
            'inLanguage'       => 'en-GB',
        );

    } else {
        // Generic WebPage
        $schema = array(
            '@context'  => 'https://schema.org',
            '@type'     => 'WebPage',
            'name'      => html_entity_decode( $og_title ),
            'url'       => $og_url,
            'description' => html_entity_decode( $og_desc ),
            'publisher' => $org_schema,
            'inLanguage' => 'en-GB',
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'polaris_meta_tags', 5 );

/**
 * Rewrite /sitemap.xml to sitemap.php in the WordPress root.
 * This serves a dynamic sitemap that auto-includes all published
 * posts and pages without any manual updates.
 */
function polaris_sitemap_rewrite() {
    add_rewrite_rule( '^sitemap\.xml$', 'sitemap.php', 'top' );
}
add_action( 'init', 'polaris_sitemap_rewrite' );
