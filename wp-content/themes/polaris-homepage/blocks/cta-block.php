<?php
  /**
   * CTA Block for Polaris Launchpad
   *
   * Call-to-action section with trial signup
   *
   * @package PolarisLaunchpad
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  /**
   * Initialize the CTA block
   */
  function polaris_cta_block_init() {
      register_block_type('polaris/cta', array(
          'render_callback' => 'polaris_cta_block_render',
          'attributes' => array(
              'mainHeading' => array(
                  'type' => 'string',
                  'default' => 'Ready to See the Difference Better Data
  Makes?'
              ),
              'description' => array(
                  'type' => 'string',
                  'default' => 'Stop getting generic results. Start
  generating AI marketing content that is deeply informed by your unique
  business, brand, and customers. It takes just minutes to get started.'
              ),
              'ctaText' => array(
                  'type' => 'string',
                  'default' => 'Start 14-Day Free Trial'
              ),
              'ctaSubtext' => array(
                  'type' => 'string',
                  'default' => 'No payment details required. Set up in
  minutes.'
              ),
              'ctaUrl' => array(
                  'type' => 'string',
                  'default' => '/signup'
              )
          )
      ));
  }
  add_action('init', 'polaris_cta_block_init');

  /**
   * Render the CTA block
   *
   * @param array $attributes Block attributes
   * @return string Rendered HTML
   */
  function polaris_cta_block_render($attributes) {
      $mainHeading = !empty($attributes['mainHeading']) ?
  sanitize_text_field($attributes['mainHeading']) : 'Ready to See the
  Difference Better Data Makes?';
      $description = !empty($attributes['description']) ?
  sanitize_textarea_field($attributes['description']) : 'Stop getting
  generic results. Start generating AI marketing content that is deeply
  informed by your unique business, brand, and customers. It takes just
  minutes to get started.';
      $ctaText = !empty($attributes['ctaText']) ?
  sanitize_text_field($attributes['ctaText']) : 'Start 14-Day Free Trial';
      $ctaSubtext = !empty($attributes['ctaSubtext']) ?
  sanitize_text_field($attributes['ctaSubtext']) : 'No payment details
  required. Set up in minutes.';
      $ctaUrl = !empty($attributes['ctaUrl']) ?
  sanitize_text_field($attributes['ctaUrl']) : '/signup';

      ob_start();
      ?>
      <div class="homepage polaris-cta-section">
          <div class="CTA">
              <div class="overlap-4">
                  <div class="group-11">
                      <p class="text-wrapper-15"><?php echo
  esc_html($mainHeading); ?></p>
                      <p class="stop-getting-generic"><?php echo
  esc_html($description); ?></p>
                      <div class="group-12">
                          <div class="large-button">
                              <div class="overlap-group">
                                  <div class="div"></div>
                                  <a href="<?php echo
  esc_url(home_url($ctaUrl)); ?>"
                                     class="text-wrapper-16"
                                     aria-describedby="cta-description">
                                      <?php echo esc_html($ctaText); ?>
                                  </a>
                              </div>
                          </div>
                          <p class="text-wrapper-17"
  id="cta-description"><?php echo esc_html($ctaSubtext); ?></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <?php
      return ob_get_clean();
  }
  ?>
