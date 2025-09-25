<?php
    /**
     * Founder Block for Polaris Launchpad
     *
     * Section with founder testimonial and background
     *
     * @package PolarisLaunchpad
     */

    // Prevent direct access
    if (!defined('ABSPATH')) {
        exit;
    }

    /**
     * Initialize the founder block
     */
    function polaris_founder_block_init() {
        register_block_type('polaris/founder', array(
            'render_callback' => 'polaris_founder_block_render',
            'attributes' => array(
                'mainHeading' => array(
                    'type' => 'string',
                    'default' => 'A Tool Built for Small Business Owners, by
   People Who Understand Them'
                ),
                'testimonialText' => array(
                    'type' => 'string',
                    'default' => 'As someone with years of experience in
  digital marketing, I see countless small businesses struggle to get
  marketing right for their unique brand. I created Polaris Launchpad AI to
  solve this problem – to provide a simple, powerful foundation that allows
  any business to harness the true potential of AI. Our goal is to empower
  you with tools that deliver clear, measurable results and support your
  sustainable growth.'
                ),
                'founderName' => array(
                    'type' => 'string',
                    'default' => '– Joel Chudleigh, Founder, Polaris
  Launchpad AI'
                )
            )
        ));
    }
    add_action('init', 'polaris_founder_block_init');

    /**
     * Render the founder block
     *
     * @param array $attributes Block attributes
     * @return string Rendered HTML
     */
    function polaris_founder_block_render($attributes) {
        $mainHeading = !empty($attributes['mainHeading']) ?
  sanitize_text_field($attributes['mainHeading']) : 'A Tool Built for Small
  Business Owners, by People Who Understand Them';
        $testimonialText = !empty($attributes['testimonialText']) ?
  sanitize_textarea_field($attributes['testimonialText']) : 'As someone with
   years of experience in digital marketing, I see countless small
  businesses struggle to get marketing right for their unique brand. I
  created Polaris Launchpad AI to solve this problem – to provide a simple,
  powerful foundation that allows any business to harness the true potential
   of AI. Our goal is to empower you with tools that deliver clear,
  measurable results and support your sustainable growth.';
        $founderName = !empty($attributes['founderName']) ?
  sanitize_text_field($attributes['founderName']) : '– Joel Chudleigh,
  Founder, Polaris Launchpad AI';

        ob_start();
        ?>
        <div class="homepage polaris-founder-section">
            <div class="founder">
                <div class="overlap-3">
                    <div class="group-10">
                        <p class="div-3">
                            <span class="text-wrapper-11">A Tool Built for
  Small Business Owners, by </span>
                            <span class="text-wrapper-12">People Who
  Understand Them</span>
                        </p>
                        <p class="as-someone-with">
                            <span class="text-wrapper-13">"<?php echo
  esc_html($testimonialText); ?>"<br /><br /><br /></span>
                            <span class="text-wrapper-14"><?php echo
  esc_html($founderName); ?></span>
                        </p>
                    </div>
                    <img class="logo-icon"
                         src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/logo-icon-1.png"
                         alt="Polaris logo"
                         loading="lazy" />
                    <img class="element"
                         src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/2asdf-1.png"
                         alt="Founder photo"
                         loading="lazy" />
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
  ?>
