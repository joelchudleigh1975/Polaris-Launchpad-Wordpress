<?php
  /**
   * Features Section 4 Block
   *
   * "The Polaris Launchpad Advantage" section highlighting key platform
  features:
   * Live vs. Recommended Data, Continuous Learning, and Future-Ready
  capabilities.
   */

  function polaris_features_section4_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  esc_attr($attributes['className']) : '';
      $img_uri = get_template_directory_uri() . '/img/';

      ob_start();
      ?>
      <div class="wp-block-polaris-features-section4 <?php echo
  $custom_class; ?>">
          <section class="features-section" data-model-id="603:4735"
  aria-labelledby="features-heading">
              <div class="overlap-group">
                  <img class="vector" src="<?php echo esc_url($img_uri .
  'features-vector-3.svg'); ?>" alt="" role="presentation" />
                  <img class="img" src="<?php echo esc_url($img_uri .
  'features-vector-4.svg'); ?>" alt="" role="presentation" />
                  <div class="group">
                      <header class="the-polaris" id="features-heading">
                          <span class="text-wrapper">The </span> <span
  class="span">Polaris Launchpad Advantage</span>
                      </header>
                      <div class="frame">
                          <article class="div">
                              <div class="img-wrapper" aria-hidden="true">
                                  <img class="vector-2" src="<?php echo
  esc_url($img_uri . 'features-vector-2.svg'); ?>" alt="" />
                              </div>
                              <h3 class="text-wrapper-2">Live vs.
  Recommended Data</h3>
                              <p class="p">
                                  We put you in control. See AI suggestions
  for improving your business information, but you decide what
                                  to accept. Your data, your rules.
                              </p>
                          </article>
                          <article class="group-2">
                              <div class="img-wrapper" aria-hidden="true">
                                  <img class="learningn" src="<?php echo
  esc_url($img_uri . 'features-learningn-1.png'); ?>" alt="" loading="lazy"
  />
                              </div>
                              <h3 class="text-wrapper-4">Continuous
  Learning</h3>
                              <p class="text-wrapper-3">
                                  Every piece of information compounds. Add
  your summer sale details, and suddenly all your content
                                  reflects current promotions. Update your
  ideal customer profile, and watch your messaging shift to
                                  match.
                              </p>
                          </article>
                          <article class="group-3">
                              <div class="img-wrapper" aria-hidden="true">
                                  <img class="logo-icon-white" src="<?php
  echo esc_url($img_uri . 'features-logo-icon-white-2.png'); ?>" alt=""
  loading="lazy" />
                              </div>
                              <h3 class="ready-for-what-s">Ready for What's
  Next</h3>
                              <p class="text-wrapper-3">
                                  While we're launching with three powerful
  applications, we're constantly developing new AI tools. Your
                                  Business Hub data will power every future
  application—no need to start from scratch.
                              </p>
                          </article>
                      </div>
                  </div>
              </div>
          </section>
      </div>
      <?php
      return ob_get_clean();
  }

  // Register the block
  function polaris_features_section4_block_init() {
      register_block_type('polaris/features-section4', array(
          'render_callback' => 'polaris_features_section4_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => '',
              ),
          ),
      ));
  }
  add_action('init', 'polaris_features_section4_block_init');
  ?>
