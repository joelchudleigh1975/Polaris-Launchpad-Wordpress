 <?php
  /**
   * Blog Listing Block
   *
   * Displays a list of blog posts with featured images, categories,
  excerpts,
   * and pagination for the main blog page.
   */

  function polaris_blog_listing_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  esc_attr($attributes['className']) : '';
      $posts_per_page = isset($attributes['postsPerPage']) ?
  (int)$attributes['postsPerPage'] : 4;

      // Get blog posts
      $args = array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' => $posts_per_page,
          'orderby' => 'date',
          'order' => 'DESC'
      );

      $blog_posts = get_posts($args);

      ob_start();
      ?>
      <div class="wp-block-polaris-blog-listing <?php echo $custom_class;
  ?>">
          <div class="blog" data-model-id="603:4745">
              <h1 class="text-wrapper-3">News</h1>
              <div class="frame">
                  <?php if (!empty($blog_posts)) : ?>
                      <?php foreach ($blog_posts as $post) :
                          setup_postdata($post);
                          $post_title = $post->post_title;
                          if (empty($post_title)) {
                              $post_title = get_the_title($post->ID);
                          }
                          if (empty($post_title)) {
                              $post_title = "DEBUG: Still no title for post
  " . $post->ID;
                          }
                          $featured_image =
  get_the_post_thumbnail_url($post->ID, 'large');
                          $categories = get_the_category($post->ID);
                          $category_name = !empty($categories) ?
  $categories[0]->name : 'Uncategorized';
                          $excerpt = get_the_excerpt($post->ID);
                          if (empty($excerpt)) {
                              $excerpt = wp_trim_words(get_the_content(null,
   false, $post->ID), 25, '...');
                          }
                      ?>
                          <article class="div">
                              <?php if ($featured_image) : ?>
                                  <img class="rectangle" src="<?php echo
  esc_url($featured_image); ?>" alt="<?php echo esc_attr($post_title); ?>"
  loading="lazy" />
                              <?php else : ?>
                                  <div class="rectangle placeholder-image"
  style="background-color: #f0f0f0; display: flex; align-items: center;
  justify-content: center; color: #999;">
                                      No Image
                                  </div>
                              <?php endif; ?>
                              <div class="frame-2">
                                  <div class="frame-3">
                                      <div class="frame-4">
                                          <div class="AI-tech-wrapper">
                                              <div class="AI-tech"><?php
  echo esc_html($category_name); ?></div>
                                          </div>
                                          <h2 class="text-wrapper"><?php
  echo esc_html($post_title); ?></h2>
                                          <p class="july-by-admin">
                                              <span class="span"><?php echo
  get_the_date('F j, Y', $post->ID); ?>&nbsp;&nbsp; |&nbsp;&nbsp; By:
  </span>
                                              <span
  class="text-wrapper-2"><?php echo
  esc_html(get_the_author_meta('display_name', $post->post_author));
  ?></span>
                                          </p>
                                      </div>
                                      <p class="p"><?php echo
  esc_html($excerpt); ?></p>
                                  </div>
                                  <a href="<?php echo
  esc_url(get_permalink($post->ID)); ?>" class="button-wrapper">
                                      <div class="button">Read More</div>
                                  </a>
                              </div>
                          </article>
                      <?php endforeach; ?>
                      <?php wp_reset_postdata(); ?>

                      <!-- Load More Button -->
                      <button class="div-wrapper" onclick="loadMorePosts()">
                          <div class="button-2">Load More</div>
                      </button>
                  <?php else : ?>
                      <div class="no-posts">
                          <p>No blog posts found. <a href="<?php echo
  admin_url('post-new.php'); ?>">Create your first post</a>.</p>
                      </div>
                  <?php endif; ?>
              </div>
          </div>
      </div>

      <script>
      function loadMorePosts() {
          alert('Load more functionality can be implemented with AJAX');
      }
      </script>
      <?php
      return ob_get_clean();
  }

  // Register the block
  function polaris_blog_listing_block_init() {
      register_block_type('polaris/blog-listing', array(
          'render_callback' => 'polaris_blog_listing_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => '',
              ),
              'postsPerPage' => array(
                  'type' => 'number',
                  'default' => 4,
              ),
          ),
      ));
  }
  add_action('init', 'polaris_blog_listing_block_init');
  ?>
