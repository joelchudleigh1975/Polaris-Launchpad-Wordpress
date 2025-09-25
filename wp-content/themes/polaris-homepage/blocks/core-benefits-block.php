<?php
  /**
   * Core Benefits Block for Polaris Launchpad
   *
   * Section highlighting the four main benefits
   *
   * @package PolarisLaunchpad
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  /**
   * Initialize the core benefits block
   */
  function polaris_core_benefits_block_init() {
      register_block_type('polaris/core-benefits', array(
          'render_callback' => 'polaris_core_benefits_block_render',
          'attributes' => array(
              'benefit1Title' => array(
                  'type' => 'string',
                  'default' => 'All Your Marketing Knowledge, In One Place'
              ),
              'benefit1Text' => array(
                  'type' => 'string',
                  'default' => 'Stop repeating yourself. From your brand
  colours and core values to customer pain points and competitor insights,
  your Base Camp keeps all your essential marketing data organised and
  ready. This ensures consistency across every piece of AI-generated
  content.'
              ),
              'benefit2Title' => array(
                  'type' => 'string',
                  'default' => 'Let Our Smart Crawler Do the Heavy Lifting'
              ),
              'benefit2Text' => array(
                  'type' => 'string',
                  'default' => 'Getting started is simple. Just provide
  your website URL along with some of your competitors URLs, and our
  crawler will help find and populate your profile with key text, social
  media links, and other publicly available information, saving you hours
  of manual data entry.'
              ),
              'benefit3Title' => array(
                  'type' => 'string',
                  'default' => 'Develop a Unique Voice'
              ),
              'benefit3Text' => array(
                  'type' => 'string',
                  'default' => 'Move beyond generic AI tones. Our unique
  Brand Voice Inspirations engine helps you define a distinctive
  personality, allowing you to generate content that sounds authentically
  yours and connects with your audience.'
              ),
              'benefit4Title' => array(
                  'type' => 'string',
                  'default' => 'Generate AI Content That Actually Works'
              ),
              'benefit4Text' => array(
                  'type' => 'string',
                  'default' => 'Use your completed Base Camp to power our
  suite of applications, including a LinkedIn Post Generator and Instagram
  & Facebook Post Builder. Create marketing materials that are not just
  well-written, but are strategically aligned with your business goals and
  customer needs.'
              )
          )
      ));
  }
  add_action('init', 'polaris_core_benefits_block_init');

  /**
   * Render the core benefits block
   *
   * @param array $attributes Block attributes
   * @return string Rendered HTML
   */
  function polaris_core_benefits_block_render($attributes) {
      $benefit1Title = !empty($attributes['benefit1Title']) ?
  sanitize_text_field($attributes['benefit1Title']) : 'All Your Marketing
  Knowledge, In One Place';
      $benefit1Text = !empty($attributes['benefit1Text']) ?
  sanitize_textarea_field($attributes['benefit1Text']) : 'Stop repeating
  yourself. From your brand colours and core values to customer pain points
   and competitor insights, your Base Camp keeps all your essential
  marketing data organised and ready. This ensures consistency across every
   piece of AI-generated content.';
      $benefit2Title = !empty($attributes['benefit2Title']) ?
  sanitize_text_field($attributes['benefit2Title']) : 'Let Our Smart
  Crawler Do the Heavy Lifting';
      $benefit2Text = !empty($attributes['benefit2Text']) ?
  sanitize_textarea_field($attributes['benefit2Text']) : 'Getting started
  is simple. Just provide your website URL along with some of your
  competitors URLs, and our crawler will help find and populate your
  profile with key text, social media links, and other publicly available
  information, saving you hours of manual data entry.';
      $benefit3Title = !empty($attributes['benefit3Title']) ?
  sanitize_text_field($attributes['benefit3Title']) : 'Develop a Unique
  Voice';
      $benefit3Text = !empty($attributes['benefit3Text']) ?
  sanitize_textarea_field($attributes['benefit3Text']) : 'Move beyond
  generic AI tones. Our unique Brand Voice Inspirations engine helps you
  define a distinctive personality, allowing you to generate content that
  sounds authentically yours and connects with your audience.';
      $benefit4Title = !empty($attributes['benefit4Title']) ?
  sanitize_text_field($attributes['benefit4Title']) : 'Generate AI Content
  That Actually Works';
      $benefit4Text = !empty($attributes['benefit4Text']) ?
  sanitize_textarea_field($attributes['benefit4Text']) : 'Use your
  completed Base Camp to power our suite of applications, including a
  LinkedIn Post Generator and Instagram & Facebook Post Builder. Create
  marketing materials that are not just well-written, but are strategically
   aligned with your business goals and customer needs.';

      ob_start();
      ?>
      <div class="homepage polaris-core-benefits-section">
          <div class="core-benefits">
              <div class="group-8">
                  <div class="frame-6">
                      <div class="frame-7">
                          <p class="div-2">
                              <span class="span">All Your Marketing
  Knowledge, In </span>
                              <span class="text-wrapper-9">One Place</span>
                          </p>
                          <p class="text-wrapper-10"><?php echo
  esc_html($benefit1Text); ?></p>
                      </div>
                      <div class="frame-7">
                          <p class="div-2">
                              <span class="span">Let Our Smart Crawler Do
  the </span>
                              <span class="text-wrapper-9">Heavy
  Lifting</span>
                          </p>
                          <p class="text-wrapper-10"><?php echo
  esc_html($benefit2Text); ?></p>
                      </div>
                  </div>
                  <div class="frame-8">
                      <div class="frame-7">
                          <p class="div-2">
                              <span class="span">Develop a<br /></span>
  <span class="text-wrapper-9">Unique Voice</span>
                          </p>
                          <p class="text-wrapper-10"><?php echo
  esc_html($benefit3Text); ?></p>
                      </div>
                      <div class="frame-7">
                          <p class="div-2">
                              <span class="span">Generate AI Content That
  </span> <span class="text-wrapper-9">Actually Works</span>
                          </p>
                          <p class="text-wrapper-10"><?php echo
  esc_html($benefit4Text); ?></p>
                      </div>
                  </div>
                  <div class="market-knowledge-wrapper">
                      <img class="img-2"
                           src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/market-knowledge-1.png"
                           alt="Marketing knowledge illustration"
                           loading="lazy" />
                  </div>
                  <div class="voice-wrapper">
                      <img class="img-2"
                           src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/voice-1.png"
                           alt="Brand voice illustration"
                           loading="lazy" />
                  </div>
                  <div class="crawler-wrapper">
                      <img class="img-2"
                           src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/crawler-1.png"
                           alt="Smart crawler illustration"
                           loading="lazy" />
                  </div>
                  <div class="logo-icon-white-wrapper">
                      <img class="logo-icon-white-3"
                           src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/logo-icon-white-2.png"
                           alt="Polaris logo"
                           loading="lazy" />
                  </div>
              </div>
          </div>
      </div>
      <?php
      return ob_get_clean();
  }
  ?>
