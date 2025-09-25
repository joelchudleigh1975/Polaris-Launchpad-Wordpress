 <?php
  /**
   * Pricing Plans Block - Fixed Structure
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  function polaris_pricing_plans_block_init() {
      register_block_type('polaris/pricing-plans', array(
          'render_callback' => 'polaris_pricing_plans_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => ''
              )
          )
      ));
  }
  add_action('init', 'polaris_pricing_plans_block_init');

  function polaris_pricing_plans_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  $attributes['className'] : '';
      $img_uri = get_template_directory_uri() . '/img/';

      ob_start();
      ?>

      <div class="wp-block-polaris-pricing-plans <?php echo
  esc_attr($custom_class); ?>">
          <div class="pricing-page">
              <div class="overlap">
                  <img class="vector" src="<?php echo esc_url($img_uri .
  'pricing-plans-block-vector.svg'); ?>" />
                  <img class="img" src="<?php echo esc_url($img_uri .
  'pricing-plans-block-vector-1.svg'); ?>" />
                  <img class="vector-2" src="<?php echo esc_url($img_uri .
  'pricing-plans-block-vector-8.svg'); ?>" />
                  <img class="logo-icon" src="<?php echo esc_url($img_uri .
  'pricing-plans-block-logo-icon-1.png'); ?>" />
                  <div class="group">
                      <div class="frame">
                          <!-- MONTHLY CARD -->
                          <div class="div">
                              <div class="small-button"><button
  class="button">Start Free Trial</button></div>
                              <div class="overlap-group-wrapper">
                                  <div class="overlap-group">
                                      <div
  class="text-wrapper">Monthly</div>
                                      <div
  class="text-wrapper-2">£49.99/month</div>
                                  </div>
                              </div>
                              <div class="features-list">
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-ellipse-3.svg'); ?>" />
                                      <span class="feature-text">1
  User</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-7.svg'); ?>" />
                                      <span class="feature-text">1 Company
  profile</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-8-1.svg'); ?>" />
                                      <span class="feature-text">30
  scheduled posts</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-2.svg'); ?>" />
                                      <span class="feature-text">3 free
  plagiarism scans</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-10.svg'); ?>" />
                                      <span class="feature-text">Unlimited
  source materials to train your Launchpad</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-3.svg'); ?>" />
                                      <span class="feature-text">Unlimited
  use of all AI applications</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-4.svg'); ?>" />
                                      <span class="feature-text">Unlimited
  AI image generation</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-ellipse-23.svg'); ?>" />
                                      <span class="feature-text">Free
  Customer support via email/messaging</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-group-261.png'); ?>" />
                                      <span class="feature-text">Up to 1GB
  in stored media</span>
                                  </div>
                              </div>
                          </div>

                          <!-- ANNUAL CARD -->
                          <div class="div">
                              <div class="button-wrapper"><button
  class="button">Start Free Trial</button></div>
                              <div class="overlap-group-wrapper">
                                  <div class="overlap-group-5">
                                      <div
  class="text-wrapper">Annually</div>
                                      <div
  class="text-wrapper-2">£39.99/month but paid annually</div>
                                  </div>
                              </div>
                              <div class="features-list">
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-ellipse-3-1.svg'); ?>" />
                                      <span class="feature-text">1
  User</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-7-1.svg'); ?>" />
                                      <span class="feature-text">1 Company
  profile</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-8-2.svg'); ?>" />
                                      <span class="feature-text">30
  scheduled posts</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-5.svg'); ?>" />
                                      <span class="feature-text">3 free
  plagiarism scans</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-10-1.svg'); ?>" />
                                      <span class="feature-text">Unlimited
  source materials to train your Launchpad</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-6.svg'); ?>" />
                                      <span class="feature-text">Unlimited
  use of all AI applications</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-vector-11.svg'); ?>" />
                                      <span class="feature-text">Unlimited
  AI image generation</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-ellipse-23-1.svg'); ?>" />
                                      <span class="feature-text">Free
  Customer support via email/messaging</span>
                                  </div>
                                  <div class="feature-item">
                                      <img class="feature-icon" src="<?php
  echo esc_url($img_uri . 'pricing-plans-block-group-261-1.png'); ?>" />
                                      <span class="feature-text">Up to 1GB
  in stored media</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="plan">
                          <div class="group-wrapper"></div>
                          <div class="group-17">
                              <div class="overlap-group-6">
                                  <div class="text-wrapper-6">Monthly Pro
  Plan</div>
                                  <div
  class="text-wrapper-7">£49.99/month</div>
                              </div>
                          </div>
                          <div class="group-18">
                              <div class="overlap-5">
                                  <div class="text-wrapper-8">Annual Pro
  Plan</div>
                                  <div class="text-wrapper-9">£39.99/month
  paid annually</div>
                              </div>
                          </div>
                      </div>
                      <p class="text-wrapper-10">Let your aspirations point
  towards the sky</p>
                      <p class="text-wrapper-11">Save 25% monthly with
  annual billing</p>
                  </div>
              </div>
          </div>
      </div>

      <?php
      return ob_get_clean();
  }
  ?>
