 <?php
  /**
   * Marketing Not Easy Block for Polaris Launchpad
   *
   * Section highlighting marketing challenges with AI
   *
   * @package PolarisLaunchpad
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  /**
   * Initialize the marketing not easy block
   */
  function polaris_marketing_not_easy_block_init() {
      register_block_type('polaris/marketing-not-easy', array(
          'render_callback' => 'polaris_marketing_not_easy_block_render',
          'attributes' => array(
              'mainHeading' => array(
                  'type' => 'string',
                  'default' => 'Marketing (even with AI) is not easy to get
   right'
              ),
              'problem1Title' => array(
                  'type' => 'string',
                  'default' => 'Generic Content'
              ),
              'problem1Text' => array(
                  'type' => 'string',
                  'default' => 'You spend time feeding your AI details, but
   the blog posts and social media updates it creates sound generic and
  lack your brand\'s unique personality.'
              ),
              'problem2Title' => array(
                  'type' => 'string',
                  'default' => 'Inconsistent Voice'
              ),
              'problem2Text' => array(
                  'type' => 'string',
                  'default' => 'You use one tool for ad copy and another
  for emails, and they end up with completely different tones, confusing
  your customers.'
              ),
              'problem3Title' => array(
                  'type' => 'string',
                  'default' => 'Repetitive Work'
              ),
              'problem3Text' => array(
                  'type' => 'string',
                  'default' => 'You find yourself explaining the same core
  information about your business, your customers, and your products to
  every new AI tool you try.'
              )
          )
      ));
  }
  add_action('init', 'polaris_marketing_not_easy_block_init');

  /**
   * Render the marketing not easy block
   *
   * @param array $attributes Block attributes
   * @return string Rendered HTML
   */
  function polaris_marketing_not_easy_block_render($attributes) {
      // Sanitize attributes
      $mainHeading = !empty($attributes['mainHeading']) ?
  sanitize_text_field($attributes['mainHeading']) : 'Marketing (even with
  AI) is not easy to get right';
      $problem1Title = !empty($attributes['problem1Title']) ?
  sanitize_text_field($attributes['problem1Title']) : 'Generic Content';
      $problem1Text = !empty($attributes['problem1Text']) ?
  sanitize_textarea_field($attributes['problem1Text']) : 'You spend time
  feeding your AI details, but the blog posts and social media updates it
  creates sound generic and lack your brand\'s unique personality.';
      $problem2Title = !empty($attributes['problem2Title']) ?
  sanitize_text_field($attributes['problem2Title']) : 'Inconsistent Voice';
      $problem2Text = !empty($attributes['problem2Text']) ?
  sanitize_textarea_field($attributes['problem2Text']) : 'You use one tool
  for ad copy and another for emails, and they end up with completely
  different tones, confusing your customers.';
      $problem3Title = !empty($attributes['problem3Title']) ?
  sanitize_text_field($attributes['problem3Title']) : 'Repetitive Work';
      $problem3Text = !empty($attributes['problem3Text']) ?
  sanitize_textarea_field($attributes['problem3Text']) : 'You find yourself
   explaining the same core information about your business, your
  customers, and your products to every new AI tool you try.';

      ob_start();
      ?>
      <div class="homepage polaris-marketing-not-easy-section">
          <div class="marketing-not-easy">
              <div class="frame-3">
                  <p class="marketing-even-with"><?php echo
  esc_html($mainHeading); ?></p>
                  <div class="frame-4">
                      <div class="frame-5">
                          <img class="vector"
                               src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/vector.png"
                               alt="Generic content icon"
                               loading="lazy" />
                          <div class="text-wrapper-3"><?php echo
  esc_html($problem1Title); ?></div>
                          <p class="text-wrapper-4"><?php echo
  esc_html($problem1Text); ?></p>
                      </div>
                      <div class="frame-5">
                          <div class="group-wrapper">
                              <img class="group-4"
                                   src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/group-269.jpg"
                                   alt="Inconsistent voice icon"
                                   loading="lazy" />
                          </div>
                          <div class="text-wrapper-3"><?php echo
  esc_html($problem2Title); ?></div>
                          <p class="text-wrapper-4"><?php echo
  esc_html($problem2Text); ?></p>
                      </div>
                      <div class="frame-5">
                          <div class="vector-wrapper">
                              <img class="vector-2"
                                   src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/vector-1.png"
                                   alt="Repetitive work icon"
                                   loading="lazy" />
                          </div>
                          <div class="text-wrapper-3"><?php echo
  esc_html($problem3Title); ?></div>
                          <p class="text-wrapper-4"><?php echo
  esc_html($problem3Text); ?></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <?php
      return ob_get_clean();
  }
  ?>
