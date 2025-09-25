  <?php
  /**
   * Related Articles Block
   *
   * Shows 3 related articles:
   * - First tries to get posts from the same category
   * - Falls back to most recent posts if not enough in same category
   */

  function polaris_related_articles_block_init() {
      register_block_type('polaris/related-articles', array(
          'render_callback' => 'polaris_related_articles_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => '',
              ),
          ),
      ));
  }
  add_action('init', 'polaris_related_articles_block_init');

  function polaris_related_articles_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  esc_attr($attributes['className']) : '';

      global $post;
      $current_post_id = $post ? $post->ID : 0;

      // Get current post's categories
      $categories = get_the_category($current_post_id);
      $category_ids = array();
      foreach ($categories as $category) {
          $category_ids[] = $category->term_id;
      }

      $related_posts = array();

      // First, try to get posts from same category
      if (!empty($category_ids)) {
          $same_category_posts = get_posts(array(
              'post_type' => 'post',
              'post_status' => 'publish',
              'posts_per_page' => 3,
              'post__not_in' => array($current_post_id),
              'category__in' => $category_ids,
              'orderby' => 'date',
              'order' => 'DESC'
          ));

          $related_posts = $same_category_posts;
      }

      // If we don't have enough posts, fill with recent posts
      if (count($related_posts) < 3) {
          $exclude_ids = array($current_post_id);
          foreach ($related_posts as $existing_post) {
              $exclude_ids[] = $existing_post->ID;
          }

          $recent_posts = get_posts(array(
              'post_type' => 'post',
              'post_status' => 'publish',
              'posts_per_page' => (3 - count($related_posts)),
              'post__not_in' => $exclude_ids,
              'orderby' => 'date',
              'order' => 'DESC'
          ));

          $related_posts = array_merge($related_posts, $recent_posts);
      }

      // Limit to exactly 3 posts
      $related_posts = array_slice($related_posts, 0, 3);

      if (empty($related_posts)) {
          return '<div class="related-articles-block">No related articles
  found.</div>';
      }

      ob_start();
      ?>

      <div class="related-articles-section <?php echo $custom_class; ?>">
          <div class="text-wrapper-4">Related Articles</div>

          <?php foreach ($related_posts as $index => $related_post):
              $post_id = $related_post->ID;
              $title = get_the_title($post_id);
              $excerpt = get_the_excerpt($post_id);
              $permalink = get_permalink($post_id);
              $featured_image = get_the_post_thumbnail_url($post_id,
  'medium');
              $post_date = get_the_date('F j, Y', $post_id);
              $post_author = get_the_author_meta('display_name',
  $related_post->post_author);

              // Get categories
              $post_categories = get_the_category($post_id);
              $primary_category = !empty($post_categories) ?
  $post_categories[0]->name : 'Uncategorized';
          ?>

          <div class="frame-<?php echo ($index + 3); ?>">
              <?php if ($featured_image): ?>
                  <img class="rectangle-2" src="<?php echo
  esc_url($featured_image); ?>" alt="<?php echo esc_attr($title); ?>" />
              <?php endif; ?>

              <div class="frame-4">
                  <div class="frame-wrapper">
                      <div class="frame-5">
                          <div class="AI-tech-wrapper">
                              <div class="AI-tech"><?php echo
  esc_html($primary_category); ?></div>
                          </div>
                          <p class="text-wrapper-10"><?php echo
  esc_html($title); ?></p>
                          <p class="july-by-admin-2">
                              <span class="span"><?php echo
  esc_html($post_date); ?>&nbsp;&nbsp; |&nbsp;&nbsp; By: </span>
                              <span class="text-wrapper-2"><?php echo
  esc_html($post_author); ?></span>
                          </p>
                      </div>
                  </div>
                  <a href="<?php echo esc_url($permalink); ?>"
  class="large-button">
                      <div class="button">Read More</div>
                  </a>
              </div>
          </div>

          <?php endforeach; ?>
      </div>

      <?php
      return ob_get_clean();
  }
  ?>
