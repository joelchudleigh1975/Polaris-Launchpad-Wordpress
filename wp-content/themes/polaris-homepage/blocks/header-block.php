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
      $logo_square_url = get_template_directory_uri() . '/img/polaris-logo-square-white.png';
      $custom_class = isset($attributes['className']) ? $attributes['className'] : '';
      $is_standalone = isset($attributes['isStandalone']) ? $attributes['isStandalone'] : true;

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
          <div class="homepage polaris-header-standalone <?php echo esc_attr($custom_class); ?>">
              <div class="header-background-wrapper">
      <?php endif; ?>

      <header class="header">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo-link">
              <img class="polaris-logo polaris-logo-wide"
                   src="<?php echo esc_url($logo_url); ?>"
                   alt="Polaris Launchpad" />
              <img class="polaris-logo polaris-logo-square"
                   src="<?php echo esc_url($logo_square_url); ?>"
                   alt="Polaris Launchpad" />
          </a>

          <div class="group-2">
              <div class="frame-2">
                  <?php foreach ($nav_items as $label => $path) : ?>
                      <div class="div-wrapper">
                          <div class="text-wrapper-2">
                              <a href="<?php echo esc_url(home_url($path)); ?>">
                                  <?php echo esc_html($label); ?>
                              </a>
                          </div>
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>

          <div class="header-cta-buttons">
              <div class="small-button">
                  <a href="https://app.polaris-launchpad.com/login" class="button-2">
                      Login
                  </a>
              </div>

              <div class="button-wrapper">
                  <a href="https://app.polaris-launchpad.com/register" class="button-2">
                      Start 14-day Free Trial
                  </a>
              </div>
          </div>

          <button class="burger-menu" aria-label="Toggle navigation" aria-expanded="false">
              <span class="burger-bar"></span>
              <span class="burger-bar"></span>
              <span class="burger-bar"></span>
          </button>
      </header>

      <?php if ($is_standalone) : ?>
              </div>
          </div>
      <?php endif; ?>

      <script>
      // Burger menu toggle
      document.addEventListener('DOMContentLoaded', function() {
          var burger = document.querySelector('.burger-menu');
          var nav = document.querySelector('.group-2');
          var headerEl = document.querySelector('.homepage .header, .polaris-header-standalone .header');
          if (burger && nav) {
              burger.addEventListener('click', function() {
                  var expanded = burger.getAttribute('aria-expanded') === 'true';
                  burger.setAttribute('aria-expanded', !expanded);
                  burger.classList.toggle('active');
                  nav.classList.toggle('nav-open');
                  if (headerEl) {
                      headerEl.classList.toggle('nav-is-open');
                      // Toggle overflow on parent containers so fixed overlay isn't clipped
                      var hero = document.querySelector('.homepage .hero');
                      var standalone = document.querySelector('.polaris-header-standalone');
                      var bgWrapper = document.querySelector('.header-background-wrapper');
                      if (hero) hero.classList.toggle('nav-parent-open');
                      if (standalone) standalone.classList.toggle('nav-parent-open');
                      if (bgWrapper) bgWrapper.classList.toggle('nav-parent-open');
                  }
              });
          }
      });

      </script>

      <?php
      return ob_get_clean();
  }
  ?>
