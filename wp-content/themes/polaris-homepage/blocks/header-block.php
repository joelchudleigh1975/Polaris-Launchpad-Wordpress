<?php
  /**
   * Header Block for Polaris Launchpad
   *
   * Reusable header that matches hero section styling
   *
   * @package PolarisLaunchpad
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  /**
   * Initialize the header block
   */
  function polaris_header_block_init() {
      register_block_type('polaris/header', array(
          'render_callback' => 'polaris_header_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => ''
              ),
              'isStandalone' => array(
                  'type' => 'boolean',
                  'default' => true
              )
          )
      ));
  }
  add_action('init', 'polaris_header_block_init');

  /**
   * Render the header block
   *
   * @param array $attributes Block attributes
   * @return string Rendered HTML
   */
  function polaris_header_block_render($attributes) {
      $logo_url = get_template_directory_uri() . '/img/polaris-logo-1-1.png';
      $custom_class = isset($attributes['className']) ?
  $attributes['className'] : '';
      $is_standalone = isset($attributes['isStandalone']) ?
  $attributes['isStandalone'] : true;

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

      // If standalone, wrap with homepage class and hero-like background
      if ($is_standalone) : ?>
          <div class="homepage polaris-header-standalone <?php echo
  esc_attr($custom_class); ?>">
              <div class="header-background-wrapper">
      <?php endif; ?>

      <header class="header">
          <img class="polaris-logo"
               src="<?php echo esc_url($logo_url); ?>"
               alt="Polaris Launchpad" />

          <div class="group-2">
              <div class="frame-2">
                  <?php foreach ($nav_items as $label => $path) : ?>
                      <div class="div-wrapper">
                          <div class="text-wrapper-2">
                              <a href="<?php echo esc_url(home_url($path));
   ?>">
                                  <?php echo esc_html($label); ?>
                              </a>
                          </div>
                      </div>
                  <?php endforeach; ?>
              </div>

              <div class="small-button">
                  <a href="<?php echo esc_url(home_url('/login')); ?>"
  class="button-2">
                      Login
                  </a>
              </div>

              <div class="button-wrapper">
                  <a href="<?php echo esc_url(home_url('/signup')); ?>"
  class="button-2">
                      Start 14-day Free Trial
                  </a>
              </div>
          </div>
      </header>

      <?php if ($is_standalone) : ?>
              </div>
          </div>
      <?php endif; ?>

      <?php
      return ob_get_clean();
  }
  ?>
