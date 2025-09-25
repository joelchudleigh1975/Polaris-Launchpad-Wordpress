 <!DOCTYPE html>
  <html <?php language_attributes(); ?>>
  <head>
      <meta charset="<?php bloginfo('charset'); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php wp_title(); ?></title>
      <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <!-- Header Block (White Background for inner pages) -->
  <div class="wp-block-polaris-header-white">
      <?php echo polaris_header_white_block_render(array()); ?>
  </div>

  <!-- Blog Post Content Block -->
  <div class="wp-block-polaris-blog-post-content">
      <?php echo polaris_blog_post_content_block_render(array()); ?>
  </div>

  <!-- Related Articles Block -->
  <div class="wp-block-polaris-related-articles">
      <?php echo polaris_related_articles_block_render(array()); ?>
  </div>

  <!-- Footer Block -->
  <div class="wp-block-polaris-footer">
      <?php echo polaris_footer_block_render(array()); ?>
  </div>

  <?php endwhile; endif; ?>

  <?php wp_footer(); ?>
  </body>
  </html>
