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
      $logo_square_url = get_template_directory_uri() . '/img/polaris-logo-square.png';
      $custom_class = isset($attributes['className']) ? $attributes['className'] : '';

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
                  <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo-link">
                      <img class="polaris-logo polaris-logo-wide"
                           src="<?php echo esc_url($logo_url); ?>"
                           alt="Polaris Launchpad" />
                      <img class="polaris-logo polaris-logo-square"
                           src="<?php echo esc_url($logo_square_url); ?>"
                           alt="Polaris Launchpad" />
                  </a>

                  <div class="group">
                      <div class="frame">
                          <?php foreach ($nav_items as $label => $path) : ?>
                              <div class="div-wrapper">
                                  <div class="text-wrapper">
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
                          <a href="<?php echo esc_url("https://app.polaris-launchpad.com/login"); ?>" class="button">
                              Login
                          </a>
                      </div>

                      <div class="button-wrapper">
                          <a href="<?php echo esc_url("https://app.polaris-launchpad.com/register"); ?>" class="button">
                              Start 14-day Free Trial
                          </a>
                      </div>
                  </div>

                  <button class="burger-menu burger-menu-dark" aria-label="Toggle navigation" aria-expanded="false">
                      <span class="burger-bar"></span>
                      <span class="burger-bar"></span>
                      <span class="burger-bar"></span>
                  </button>
              </header>
          </div>
      </div>

      <script>
      document.addEventListener('DOMContentLoaded', function() {
          var burger = document.querySelector('.header-innerpage .burger-menu');
          var nav = document.querySelector('.header-innerpage .group');
          var headerEl = document.querySelector('.header-innerpage .header');
          if (burger && nav) {
              burger.addEventListener('click', function() {
                  var expanded = burger.getAttribute('aria-expanded') === 'true';
                  burger.setAttribute('aria-expanded', !expanded);
                  burger.classList.toggle('active');
                  nav.classList.toggle('nav-open');
                  if (headerEl) headerEl.classList.toggle('nav-is-open');
              });
          }
      });
      </script>

      <?php
      return ob_get_clean();
  }
  ?>
