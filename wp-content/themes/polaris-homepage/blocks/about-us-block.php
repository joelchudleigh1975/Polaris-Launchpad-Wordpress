 <?php
  /**
   * About Us Block
   *
   * Displays the complete About Us section including Our Background and Our
   Mission.
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  function polaris_about_us_block_init() {
      register_block_type('polaris/about-us', array(
          'render_callback' => 'polaris_about_us_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => ''
              )
          )
      ));
  }
  add_action('init', 'polaris_about_us_block_init');

  function polaris_about_us_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  esc_attr($attributes['className']) : '';
      $img_uri = get_template_directory_uri() . '/img/';

      ob_start();
      ?>

      <div class="wp-block-polaris-about-us <?php echo $custom_class; ?>">
          <main class="about" data-model-id="603:4740">
              <!-- Our Background Section -->
              <section class="overlap-group"
  aria-labelledby="background-heading">
                  <div class="group-2">
                      <article class="group-3">
                          <h1 class="text-wrapper-2"
  id="background-heading">Our Background</h1>
                          <p class="we-ve-spent-over-two">
                              We've spent over two decades in the trenches
  with small businesses, helping them compete against companies
                              10x their size. Time and again, we've
  witnessed the same frustrating pattern: brilliant small businesses
                              with innovative ideas and unmatched customer
  service getting overshadowed by larger competitors—not
                              because they're inferior, but because they
  lack access to professional marketing expertise.<br /><br />While
                              big corporations have entire teams crafting
  their message, most small business owners are juggling
                              marketing between a hundred other tasks. We
  built Polaris Launchpad to change that. Because we believe
                              your ability to succeed shouldn't depend on
  whether you can afford a marketing agency.
                          </p>
                      </article>
                  </div>
                  <img
                      class="background-analytics-img"
                      src="<?php echo esc_url($img_uri .
  'about-us-background-analytics.png'); ?>"
                      alt="Marketing dashboard showing business analytics
  and performance metrics"
                      loading="lazy"
                  />
              </section>

              <!-- Our Mission Section -->
              <section class="overlap" aria-labelledby="mission-heading">
                  <div class="group">
                      <article class="div">
                          <h2 class="text-wrapper" id="mission-heading">Our
  Mission</h2>
                          <p class="we-re-on-a-mission">
                              We're on a mission to democratise world-class
  marketing for every small business owner.<br /><br />Polaris
                              Launchpad transforms the way you tell your
  story by combining two powerful forces: deep knowledge about
                              your unique business and cutting-edge AI
  technology. Instead of generic, one-size-fits-all content, you
                              get marketing materials that sound like you,
  connect with your specific customers, and showcase what makes
                              your business special.<br /><br />Our goal is
  simple: give you the same marketing firepower as the big
                              players, so you can focus on what you do
  best—running your business and delighting your customers.
                          </p>
                      </article>
                      <img
                          class="mission-dashboard-img"
                          src="<?php echo esc_url($img_uri .
  'about-us-mission-dashboard.png'); ?>"
                          alt="Polaris Launchpad dashboard interface showing
   marketing analytics and tools"
                          loading="lazy"
                      />
                  </div>
              </section>
          </main>
      </div>

      <?php
      return ob_get_clean();
  }
  ?>
