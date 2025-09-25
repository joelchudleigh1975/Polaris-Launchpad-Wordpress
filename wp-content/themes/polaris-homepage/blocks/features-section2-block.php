 <?php
  /**
   * Features Section 2 Block
   *
   * "How It Works" features section showing the step-by-step process
   * of using the Polaris Launchpad platform.
   */

  function polaris_features_section2_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  esc_attr($attributes['className']) : '';
      $img_uri = get_template_directory_uri() . '/img/';

      ob_start();
      ?>
      <div class="wp-block-polaris-features-section2 <?php echo
  $custom_class; ?>">
          <main class="features-section" data-model-id="603:4733">
              <div class="overlap-group">
                  <div class="overlap">
                      <section class="div">
                          <img class="vector" src="<?php echo
  esc_url($img_uri . 'features-2-vector-8.svg'); ?>" alt="Background
  decorative vector" />
                          <article class="group">
                              <div class="group-2">
                                  <h2 class="text-wrapper">Start
  Simple:</h2>
                                  <p class="p">
                                      Begin with basic information like your
   company name and website. Our smart crawler automatically pulls
                                      in additional details to get you
  started.
                                  </p>
                              </div>
                          </article>
                          <article class="group-wrapper">
                              <div class="group-3">
                                  <h2 class="text-wrapper">Watch Your AI Get
   Smarter:</h2>
                                  <p class="p">
                                      Our "Launchpad Fuel" meter shows your
  data completeness. As the meter rises, your AI outputs become
                                      more sophisticated and on-brand. It's
  like watching your marketing assistant learn your business in
                                      real-time.
                                  </p>
                              </div>
                          </article>
                          <article class="div-wrapper">
                              <div class="group-4">
                                  <h2 class="text-wrapper">Build Over
  Time:</h2>
                                  <p class="p">Add information at your own
  pace across seven key areas:</p>
                                  <div class="business-profile">
                                      <p>
                                          <strong class="span">Business
  Profile:</strong>
                                          <span class="text-wrapper-2"> Your
   mission, values, and what makes you unique</span>
                                      </p>
                                      <p>
                                          <strong class="span">Branding:
  </strong>
                                          <span
  class="text-wrapper-2">Colors, tone of voice, and visual style</span>
                                      </p>
                                      <p>
                                          <strong class="span">Customer
  Personas:</strong>
                                          <span class="text-wrapper-2"> Who
  buys from you and why</span>
                                      </p>
                                      <p>
                                          <strong class="span">Industry
  Details:</strong>
                                          <span class="text-wrapper-2">
  Market trends and terminology</span>
                                      </p>
                                  </div>
                                  <div class="competitors-what">
                                      <p>
                                          <strong
  class="span">Competitors:</strong>
                                          <span class="text-wrapper-2"> What
   others are doing (and how you're different)</span>
                                      </p>
                                      <p>
                                          <strong class="span">Custom
  Data:</strong>
                                          <span class="text-wrapper-2"> Your
   specific products, services, and offers</span>
                                      </p>
                                      <p>
                                          <strong class="span">Media
  Library: </strong>
                                          <span
  class="text-wrapper-2">Logos, product images, and brand assets</span>
                                      </p>
                                  </div>
                                  <div class="vector-wrapper"
  role="presentation">
                                      <img class="img" src="<?php echo
  esc_url($img_uri . 'features-2-vector-13-6.svg'); ?>" alt="Bullet point"
  />
                                  </div>
                                  <div class="img-wrapper"
  role="presentation">
                                      <img class="img" src="<?php echo
  esc_url($img_uri . 'features-2-vector-13-6.svg'); ?>" alt="Bullet point"
  />
                                  </div>
                                  <div class="group-5" role="presentation">
                                      <img class="img" src="<?php echo
  esc_url($img_uri . 'features-2-vector-13-6.svg'); ?>" alt="Bullet point"
  />
                                  </div>
                                  <div class="group-6" role="presentation">
                                      <img class="img" src="<?php echo
  esc_url($img_uri . 'features-2-vector-13-6.svg'); ?>" alt="Bullet point"
  />
                                  </div>
                                  <div class="group-7" role="presentation">
                                      <img class="img" src="<?php echo
  esc_url($img_uri . 'features-2-vector-13-6.svg'); ?>" alt="Bullet point"
  />
                                  </div>
                                  <div class="group-8" role="presentation">
                                      <img class="img" src="<?php echo
  esc_url($img_uri . 'features-2-vector-13-6.svg'); ?>" alt="Bullet point"
  />
                                  </div>
                                  <div class="group-9" role="presentation">
                                      <img class="img" src="<?php echo
  esc_url($img_uri . 'features-2-vector-13-6.svg'); ?>" alt="Bullet point"
  />
                                  </div>
                              </div>
                          </article>
                          <img class="mask-group" src="<?php echo
  esc_url($img_uri . 'features-2-mask-group-1.png'); ?>" alt="Interface
  screenshot showing simple setup" loading="lazy" />
                          <img class="group-10" src="<?php echo
  esc_url($img_uri . 'features-2-group-315.png'); ?>" alt="Interface
  screenshot showing build over time features" loading="lazy" />
                          <img class="mask-group-2" src="<?php echo
  esc_url($img_uri . 'features-2-mask-group-2.png'); ?>" alt="Interface
  screenshot showing AI getting smarter" loading="lazy" />
                      </section>
                      <img class="logo-icon" src="<?php echo
  esc_url($img_uri . 'features-2-logo-icon-1.png'); ?>" alt="Company logo"
  loading="lazy" />
                  </div>
                  <h1 class="text-wrapper-3">How It Works</h1>
              </div>
          </main>
      </div>
      <?php
      return ob_get_clean();
  }

  // Register the block
  function polaris_features_section2_block_init() {
      register_block_type('polaris/features-section2', array(
          'render_callback' => 'polaris_features_section2_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => '',
              ),
          ),
      ));
  }
  add_action('init', 'polaris_features_section2_block_init');
  ?>
