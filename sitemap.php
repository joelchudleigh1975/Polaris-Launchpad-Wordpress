<?php
/**
 * Dynamic XML Sitemap for Polaris Launchpad
 *
 * Queries the WordPress database on every request and returns a fresh,
 * complete sitemap. Automatically includes any new pages or blog posts
 * without manual updates.
 *
 * Served at: https://polaris-launchpad.com/sitemap.xml
 * (WordPress rewrites /sitemap.xml to this file - see functions.php)
 *
 * Includes:
 *   - Homepage (priority 1.0)
 *   - All published pages except homepage slug and legal pages (priority 0.7-0.9)
 *   - Blog index page (priority 0.8)
 *   - All published posts, newest first (priority 0.6)
 *   - Legal pages: privacy-policy, terms-conditions (priority 0.3)
 */

// Bootstrap WordPress to get DB access and helper functions
define( 'SHORTINIT', true );
require_once( dirname( __FILE__ ) . '/wp-load.php' );

// Serve as XML
header( 'Content-Type: application/xml; charset=UTF-8' );
header( 'X-Robots-Tag: noindex, follow' );

$site_url = rtrim( get_option( 'home' ), '/' );

// Slugs that get special handling or are excluded from the general pages block
$legal_slugs    = [ 'privacy-policy', 'terms-conditions' ];
$excluded_slugs = [ 'homepage' ]; // front page is listed separately as /

// Fetch all published pages
$pages = $wpdb->get_results(
    "SELECT post_name, post_modified
     FROM {$wpdb->posts}
     WHERE post_status = 'publish'
       AND post_type = 'page'
     ORDER BY menu_order ASC, post_date ASC"
);

// Fetch all published posts, newest first
$posts = $wpdb->get_results(
    "SELECT post_name, post_modified
     FROM {$wpdb->posts}
     WHERE post_status = 'publish'
       AND post_type = 'post'
     ORDER BY post_date DESC"
);

// Separate pages into buckets
$main_pages  = [];
$blog_page   = null;
$legal_pages = [];

foreach ( $pages as $page ) {
    $slug = $page->post_name;
    if ( in_array( $slug, $excluded_slugs, true ) ) {
        continue;
    }
    if ( $slug === 'blog' ) {
        $blog_page = $page;
    } elseif ( in_array( $slug, $legal_slugs, true ) ) {
        $legal_pages[] = $page;
    } else {
        $main_pages[] = $page;
    }
}

// Format a date for lastmod
function sitemap_date( $date_str ) {
    return date( 'Y-m-d', strtotime( $date_str ) );
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  <!-- Homepage -->
  <url>
    <loc><?php echo $site_url; ?>/</loc>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>

<?php if ( $blog_page ) : ?>
  <!-- Blog index -->
  <url>
    <loc><?php echo $site_url; ?>/<?php echo $blog_page->post_name; ?>/</loc>
    <lastmod><?php echo sitemap_date( $blog_page->post_modified ); ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>

<?php endif; ?>
<?php foreach ( $main_pages as $page ) : ?>
  <url>
    <loc><?php echo $site_url; ?>/<?php echo $page->post_name; ?>/</loc>
    <lastmod><?php echo sitemap_date( $page->post_modified ); ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

<?php endforeach; ?>
<?php foreach ( $posts as $post ) : ?>
  <!-- Blog post -->
  <url>
    <loc><?php echo $site_url; ?>/<?php echo $post->post_name; ?>/</loc>
    <lastmod><?php echo sitemap_date( $post->post_modified ); ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>

<?php endforeach; ?>
<?php foreach ( $legal_pages as $page ) : ?>
  <!-- Legal -->
  <url>
    <loc><?php echo $site_url; ?>/<?php echo $page->post_name; ?>/</loc>
    <lastmod><?php echo sitemap_date( $page->post_modified ); ?></lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.3</priority>
  </url>

<?php endforeach; ?>
</urlset>
