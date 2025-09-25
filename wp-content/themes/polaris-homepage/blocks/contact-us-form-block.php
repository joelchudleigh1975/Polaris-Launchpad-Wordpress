<?php
  /**
   * Contact Us Form Block
   *
   * Displays contact form with validation and submission handling
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  /**
   * Initialize the contact us form block
   */
  function polaris_contact_us_form_block_init() {
      register_block_type('polaris/contact-us-form', array(
          'render_callback' => 'polaris_contact_us_form_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => ''
              )
          )
      ));
  }
  add_action('init', 'polaris_contact_us_form_block_init');

  /**
   * Render the contact us form block
   */
  function polaris_contact_us_form_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  $attributes['className'] : '';
      $img_uri = get_template_directory_uri() . '/img/';

      ob_start();
      ?>

      <main class="contact <?php echo esc_attr($custom_class); ?>"
  data-model-id="603:4728">
          <div class="overlap">
              <img class="vector" src="<?php echo esc_url($img_uri .
  'contact-form-vector-2.svg'); ?>" alt="" role="presentation" />
              <img class="img" src="<?php echo esc_url($img_uri .
  'contact-form-vector-3.svg'); ?>" alt="" role="presentation" />
              <section class="group">
                  <div class="overlap-group">
                      <img class="astronaut" src="<?php echo
  esc_url($img_uri . 'contact-form-astronaut.png'); ?>" alt="Astronaut
  illustration" />
                      <img class="vector-2" src="<?php echo esc_url($img_uri
   . 'contact-form-vector-12.svg'); ?>" alt="" role="presentation" />
                      <p class="we-re-here-to-help">
                          We're here to help you navigate your marketing
  journey. Whether you have a question or need some support
                          with one of our features, our team is ready to
  assist. Get in contact using this form - we'll get back to
                          you as soon as possible.
                      </p>
                  </div>
                  <div class="frame contact-form">
                      <?php echo do_shortcode('[contact-form-7 id="525452b"
  title="Contact Us Form"]'); ?>
                  </div>
                  <header class="contact-us-about">
                      <span class="span">Contact us About<br /></span> <span
   class="text-wrapper-3">Polaris Launchpad AI</span>
                  </header>
              </section>
          </div>
      </main>

      <?php
      return ob_get_clean();
  }
  ?>
