  <?php
  /**
   * Pricing Fuel Block
   *
   * Displays fuel section for pricing page with annual pricing
   * Based on Anima export structure
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  /**
   * Initialize the pricing fuel block
   */
  function polaris_pricing_fuel_block_init() {
      register_block_type('polaris/pricing-fuel', array(
          'render_callback' => 'polaris_pricing_fuel_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => ''
              )
          )
      ));
  }
  add_action('init', 'polaris_pricing_fuel_block_init');

  /**
   * Render the pricing fuel block
   *
   * @param array $attributes Block attributes
   * @return string Rendered HTML
   */
  function polaris_pricing_fuel_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  $attributes['className'] : '';

      ob_start();
      ?>

      <div class="pricing-page-section">
          <div class="overlap-group">
              <p class="element-month-paid">
                  <span class="text-wrapper">£39.99/month<br /></span>
                  <span class="span">paid annually</span>
              </p>
              <div class="group">
                  <p class="fuel-your-launchpad">
                      <span class="text-wrapper-2">Fuel Your Launchpad for
  </span>
                      <span class="text-wrapper-3">Maximum
  Performance</span>
                  </p>
                  <p class="the-more">
                      The more comprehensive your business data, the more
  intelligent and effective your AI becomes. Our
                      &#39;Launchpad Fuel&#39; indicator gives you a clear,
  visual guide to your data completeness, motivating you
                      to build a powerful foundation that delivers the best
  possible marketing results.
                  </p>
                  <div class="large-button"><div class="div">Book a
  Demo</div></div>
                  <p class="p">
                      <span class="text-wrapper">£39.99/month<br /></span>
                      <span class="span">paid annually</span>
                  </p>
              </div>
              <div class="rectangle"></div>
              <img class="mask-group" src="<?php echo
  esc_url(get_template_directory_uri() .
  '/img/pricing-fuel-block-mask-group.png'); ?>" />
              <img class="mockup" src="<?php echo
  esc_url(get_template_directory_uri() .
  '/img/pricing-fuel-block-mockup-1.png'); ?>" />
          </div>
      </div>

      <?php
      return ob_get_clean();
  }
  ?>
