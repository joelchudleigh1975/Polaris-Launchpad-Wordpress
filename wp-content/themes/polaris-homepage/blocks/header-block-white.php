<?php
  /**
   * Header Block - White Background (Inner Pages)
   *
   * Simple white header for all pages except homepage
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  /**
   * Initialize the header white block
   */
  function polaris_header_white_block_init() {
      register_block_type('polaris/header-white', array(
          'render_callback' => 'polaris_header_white_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => ''
              )
          )
      ));
  }
  add_action('init', 'polaris_header_white_block_init');

  /**
   * Render the header white block
   *
   * @param array $attributes Block attributes
   * @return string Rendered HTML
   */
  function polaris_header_white_block_render($attributes) {
      $logo_url = get_template_directory_uri() . '/img/polaris-logo-1.png';
      $custom_class = isset($attributes['className']) ?
  $attributes['className'] : '';

      // Navigation items
      $nav_items = array(
          'HOME' => '/',
          'FEATURES' => '/features',
          'PRICING' => '/pricing',
          'ABOUT' => '/about',
          'CONTACT US' => '/contact',
          'NEWS' => '/blog'
      );

      ob_start();
      ?>

      <div class="pricing-page">
          <div class="header-innerpage">
              <header class="header">
                  <img class="polaris-logo"
                       src="<?php echo esc_url($logo_url); ?>"
                       alt="Polaris Launchpad" />

                  <div class="group">
                      <div class="frame">
                          <?php foreach ($nav_items as $label => $path) : ?>
                              <div class="div-wrapper">
                                  <div class="text-wrapper">
                                      <a href="<?php echo
  esc_url(home_url($path)); ?>">
                                          <?php echo esc_html($label); ?>
                                      </a>
                                  </div>
                              </div>
                          <?php endforeach; ?>
                      </div>

                      <div class="small-button">
                          <a href="<?php echo esc_url(home_url('/login'));
  ?>" class="button">
                              Login
                          </a>
                      </div>

                      <div class="button-wrapper">
                          <a href="<?php echo esc_url(home_url('/signup'));
  ?>" class="button">
                              Start 14-day Free Trial
                          </a>
                      </div>
                  </div>
              </header>
          </div>
      </div>

      <?php
      return ob_get_clean();
  }
  ?>
