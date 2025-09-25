 <?php
  /**
   * Features Section 1 Block
   *
   * Displays "Your Business Hub: The AI's Knowledge Center" section.
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  function polaris_features_section1_block_init() {
      register_block_type('polaris/features-section1', array(
          'render_callback' => 'polaris_features_section1_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => ''
              )
          )
      ));
  }
  add_action('init', 'polaris_features_section1_block_init');

  function polaris_features_section1_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  esc_attr($attributes['className']) : '';
      $img_uri = get_template_directory_uri() . '/img/';

      ob_start();
      ?>

      <div class="wp-block-polaris-features-section1 <?php echo
  $custom_class; ?>">
          <section class="features-section" data-model-id="603:4732"
  role="main" aria-labelledby="main-heading">
              <div class="overlap-group">
                  <img class="vector" src="<?php echo esc_url($img_uri .
  'features-vector-2.svg'); ?>" alt="" role="presentation" />
                  <img class="img" src="<?php echo esc_url($img_uri .
  'features-vector-3.svg'); ?>" alt="" role="presentation" />
                  <img
                      class="hero-copy"
                      src="<?php echo esc_url($img_uri .
  'features-hero-copy-3.png'); ?>"
                      alt="Business Hub illustration showing AI-powered
  devices and analytics dashboards"
                      loading="lazy"
                  />
                  <div class="group">
                      <h1 class="your-business-hub" id="main-heading">
                          <span class="text-wrapper">Your Business Hub:<br
  /></span>
                          <span class="span">The AI's Knowledge
  Center</span>
                      </h1>
                      <p class="think-of-your">
                          Think of your Business Hub as your AI's brain—the
  more you feed it, the smarter it gets. Every detail you
                          add about your business, your customers, and your
  market makes your AI-generated content more accurate, more
                          personal, and more effective.
                      </p>
                  </div>
                  <img class="vector-2" src="<?php echo esc_url($img_uri .
  'features-vector-8.svg'); ?>" alt="" role="presentation" />
                  <img class="logo-icon" src="<?php echo esc_url($img_uri .
  'features-logo-icon-1.png'); ?>" alt="Company logo" loading="lazy" />
              </div>
          </section>
      </div>

      <?php
      return ob_get_clean();
  }
  ?>
