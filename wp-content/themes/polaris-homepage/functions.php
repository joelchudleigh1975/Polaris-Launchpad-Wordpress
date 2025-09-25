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
    $theme_version = wp_get_theme()->get('Version');

    // Global styles
    wp_enqueue_style(
        'polaris-globals',
        get_template_directory_uri() . '/globals.css',
        array(),
        $theme_version
    );

    // Styleguide
    wp_enqueue_style(
        'polaris-styleguide',
        get_template_directory_uri() . '/styleguide.css',
        array('polaris-globals'),
        $theme_version
    );

    // Main theme styles
    wp_enqueue_style(
        'polaris-theme-style',
        get_stylesheet_uri(),
        array('polaris-globals', 'polaris-styleguide'),
        $theme_version
    );
}
add_action('wp_enqueue_scripts', 'polaris_enqueue_styles');

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

          if (pricingPlansToggle && pricingPlansMonthly &&
  pricingPlansAnnual) {
              // Click on pricing plans toggle capsule itself
              pricingPlansToggle.addEventListener('click', function() {

  pricingPlansToggle.classList.toggle('pricing-plans-annual');
              });

              // Click on Monthly Pro Plan text
              pricingPlansMonthly.addEventListener('click', function() {

  pricingPlansToggle.classList.remove('pricing-plans-annual');
              });

              // Click on Annual Pro Plan text  
              pricingPlansAnnual.addEventListener('click', function() {
                  pricingPlansToggle.classList.add('pricing-plans-annual');
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
