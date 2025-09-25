 <?php
  /**
   * Pricing FAQ Block
   *
   * Displays frequently asked questions section for pricing page
   * Based on Anima export structure
   */

  // Prevent direct access
  if (!defined('ABSPATH')) {
      exit;
  }

  /**
   * Initialize the pricing FAQ block
   */
  function polaris_pricing_faq_block_init() {
      register_block_type('polaris/pricing-faq', array(
          'render_callback' => 'polaris_pricing_faq_block_render',
          'attributes' => array(
              'className' => array(
                  'type' => 'string',
                  'default' => ''
              )
          )
      ));
  }
  add_action('init', 'polaris_pricing_faq_block_init');

  /**
   * Render the pricing FAQ block
   *
   * @param array $attributes Block attributes
   * @return string Rendered HTML
   */
  function polaris_pricing_faq_block_render($attributes) {
      $custom_class = isset($attributes['className']) ?
  $attributes['className'] : '';
      $img_uri = get_template_directory_uri() . '/img/';

      // FAQ items with updated content
      $faq_items = array(
          array(
              'question' => 'Can I change my plan?',
              'answer' => 'You can change your plan at any time. If you are
  on a monthly plan, we will prorate your charges accordingly. If you are on
   an annual plan, changes will take effect at the beginning of your next
  annual billing cycle.'
          ),
          array(
              'question' => 'What happens if I invite more members than my
  plan allows?',
              'answer' => 'You can add additional team members at any time
  for £15 per person.'
          ),
          array(
              'question' => 'How do I cancel my subscription plan?',
              'answer' => 'Cancel anytime from the billing tab in your
  workspace settings. You\'ll retain access until your subscription period
  ends. After your subscription ends, workspaces can be reactivated by
  creating a new subscription for that workspace.'
          ),
          array(
              'question' => 'Is my plan restricted to only one
  website/domain?',
              'answer' => 'Yes, all Polaris Launchpad accounts are
  restricted to only your main business website/domain including any
  sub-domains. If you are an agency and manage multiple websites then you
  can simply create multiple accounts or else contact us for a special offer
   on your additional domains.'
          )
      );

      ob_start();
      ?>

      <div class="FAQ">
          <div class="group">
              <div class="text-wrapper-2">Frequently Asked Questions</div>
              <div class="frame">
                  <?php foreach ($faq_items as $index => $faq) : ?>
                      <div class="div faq-item" data-faq="<?php echo $index
  + 1; ?>">
                          <img class="line" src="<?php echo esc_url($img_uri
   . 'line-19-2.svg'); ?>" />
                          <div class="faq-question">
                              <p class="text-wrapper"><?php echo
  esc_html($faq['question']); ?></p>
                              <img class="vector faq-arrow" src="<?php echo
  esc_url($img_uri . 'vector-5-2.svg'); ?>" />
                          </div>
                          <div class="faq-answer">
                              <p><?php echo esc_html($faq['answer']); ?></p>
                          </div>
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>
      </div>

      <?php
      return ob_get_clean();
  }
  ?>
