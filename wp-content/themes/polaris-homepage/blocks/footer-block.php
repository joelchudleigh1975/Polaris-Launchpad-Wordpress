  <?php
  /**
   * Footer Block for Polaris Launchpad
   *
   * Complete footer section with links and branding
   *
   * @package PolarisLaunchpad
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  /**
   * Initialize the footer block
   */
  function polaris_footer_block_init() {
      register_block_type('polaris/footer', array(
          'render_callback' => 'polaris_footer_block_render',
          'attributes' => array(
              'copyrightText' => array(
                  'type' => 'string',
                  'default' => '© 2025 www.polaris-launchpad.com'
              )
          )
      ));
  }
  add_action('init', 'polaris_footer_block_init');

  /**
   * Render the footer block
   *
   * @param array $attributes Block attributes
   * @return string Rendered HTML
   */
  function polaris_footer_block_render($attributes) {
      $copyrightText = !empty($attributes['copyrightText']) ?
  sanitize_text_field($attributes['copyrightText']) : '© 2025
  www.polaris-launchpad.com';

      ob_start();
      ?>
      <div class="homepage polaris-footer-section">
          <footer class="footer">
              <div class="overlap-5">
                  <div class="overlap-6">
                      <img class="rocket-smoke-2"
                           src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/rocket-smoke-1-1.png"
                           alt=""
                           loading="lazy" />
                      <img class="group-13"
                           src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/group-249-1.png"
                           alt=""
                           loading="lazy" />
                      <img class="group-14"
                           src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/group-248-1.png"
                           alt=""
                           loading="lazy" />
                      <img class="logo-icon-white-4"
                           src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/logo-icon-white-1-2.png"
                           alt="Polaris logo"
                           loading="lazy" />
                      <p class="element-www-polaris">
                          <span class="text-wrapper-18">© 2025</span>
                          <span class="text-wrapper-19">&nbsp;</span>
                          <span
  class="text-wrapper-18">www.polaris-launchpad.com</span>
                      </p>
                      <div class="group-15">
                          <div class="overlap-group-4">
                              <div class="frame-9">
                                  <a href="<?php echo
  esc_url(home_url('/terms')); ?>" class="text-wrapper-20">Terms of
  Service</a>
                              </div>
                              <div class="frame-10">
                                  <a href="<?php echo
  esc_url(home_url('/privacy')); ?>" class="text-wrapper-20">Privacy
  Policy</a>
                              </div>
                              <div class="text-wrapper-21">|</div>
                          </div>
                      </div>
                  </div>
                  <img class="polaris-logo-2"
                       src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/polaris-logo-1-1.png"
                       alt="Polaris Launchpad logo"
                       loading="lazy" />
                  <div class="group-16">
                      <div class="group-17">
                          <div class="text-wrapper-22">Customers</div>
                          <div class="group-18">
                              <p class="text-wrapper-23">
                                  Ecommerce <br />Real Estate Agents <br
  />Travel Agents and Businesses <br />Nonprofits <br />Local
                                  Services <br />Education
                              </p>
                              <p class="fitness-life-coaches">
                                  Fitness &amp; Life Coaches <br />Agency
  <br />Freelance <br />Creators <br />Startups
                              </p>
                          </div>
                      </div>
                      <div class="group-19">
                          <div class="text-wrapper-22">What you can
  do</div>
                          <div class="group-20">
                              <p class="text-wrapper-23">
                                  Rank #1 on SEO <br />Get more followers
  on social media <br />Get started with online marketing
                                  <br />Learn how to use AI <br
  />Collaborate with your team <br />Engage with customers
                              </p>
                              <p class="produce-great-ads">
                                  Produce great ads <br />Sell your
  products online <br />AI Brand Voice <br />AI Brand Style <br />AI
                                  Blog Post Generator <br />AI Images
                              </p>
                          </div>
                      </div>
                      <div class="group-21">
                          <div class="text-wrapper-22">Company</div>
                          <div class="pricing-customer-wrapper">
                              <p class="text-wrapper-23">
                                  Pricing <br />Customer Stories <br
  />About Polaris Launchpad <br />Polaris Launchpad&#39;s Team
                              </p>
                          </div>
                      </div>
                  </div>
                  <img class="socmed"
                       src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/socmed-1.png"
                       alt="Social media links"
                       loading="lazy" />
              </div>
          </footer>
      </div>
      <?php
      return ob_get_clean();
  }
  ?>
