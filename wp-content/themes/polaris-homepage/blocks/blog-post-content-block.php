 <?php
  /**
   * Blog Post Content Block
   *
   * Displays the main content of a blog post including:
   * - Hero image, category tag, post title, date/author metadata, full post
   content
   */

  function polaris_blog_post_content_block_init() {
      register_block_type('polaris/blog-post-content', array(
          'render_callback' => 'polaris_blog_post_content_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => '',
              ),
          ),
      ));
  }
  add_action('init', 'polaris_blog_post_content_block_init');

  function polaris_blog_post_content_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  esc_attr($attributes['className']) : '';

      if (!is_single() && !in_the_loop()) {
          return '<div class="blog-post-content-block error">This block
  should only be used on single post pages.</div>';
      }

      global $post;
      if (!$post) {
          return '<div class="blog-post-content-block error">No post data
  available.</div>';
      }

      $post_id = get_the_ID();
      $post_title = get_the_title();
      $post_date = get_the_date('F j, Y');
      $post_author = get_the_author();
      $featured_image = get_the_post_thumbnail_url($post_id, 'full');

      $categories = get_the_category();
      $primary_category = !empty($categories) ? $categories[0]->name :
  'Uncategorized';

      // Process content with all WordPress filters
      $content = get_post_field('post_content', $post_id);
      $content = apply_filters('the_content', $content);

      ob_start();
      ?>

      <div class="blog-detail <?php echo $custom_class; ?>">
          <?php if ($featured_image): ?>
              <img class="rectangle" src="<?php echo
  esc_url($featured_image); ?>" alt="<?php echo esc_attr($post_title); ?>"
  />
          <?php endif; ?>

          <div class="group">
              <div class="frame">
                  <div class="AI-tech"><?php echo
  esc_html($primary_category); ?></div>
              </div>
              <p class="text-wrapper"><?php echo esc_html($post_title);
  ?></p>
              <p class="july-by-admin">
                  <span class="span"><?php echo esc_html($post_date);
  ?>&nbsp;&nbsp; |&nbsp;&nbsp; By: </span>
                  <span class="text-wrapper-2"><?php echo
  esc_html($post_author); ?></span>
              </p>
          </div>

          <div class="post-content-wrapper">
              <div class="entry-content">
                  <?php echo $content; ?>
              </div>
          </div>
      </div>

      <?php
      return ob_get_clean();
  }
  ?>
