<?php
    /**
     * Fuel Block for Polaris Launchpad
     *
     * Section about Launchpad Fuel indicator
     *
     * @package PolarisLaunchpad
     */

    // Prevent direct access
    if (!defined('ABSPATH')) {
        exit;
    }

    /**
     * Initialize the fuel block
     */
    function polaris_fuel_block_init() {
        register_block_type('polaris/fuel', array(
            'render_callback' => 'polaris_fuel_block_render',
            'attributes' => array(
                'mainHeading' => array(
                    'type' => 'string',
                    'default' => 'Fuel Your Launchpad for Maximum
    Performance'
                ),
                'description' => array(
                    'type' => 'string',
                    'default' => 'The more comprehensive your business data,
    the more intelligent and effective your AI becomes. Our \'Launchpad
    Fuel\' indicator gives you a clear, visual guide to your data
    completeness, motivating you to build a powerful foundation that delivers
     the best possible marketing results.'
                )
            )
        ));
    }
    add_action('init', 'polaris_fuel_block_init');

    /**
     * Render the fuel block
     *
     * @param array $attributes Block attributes
     * @return string Rendered HTML
     */
    function polaris_fuel_block_render($attributes) {
        $mainHeading = !empty($attributes['mainHeading']) ?
    sanitize_text_field($attributes['mainHeading']) : 'Fuel Your Launchpad
    for Maximum Performance';
        $description = !empty($attributes['description']) ?
    sanitize_textarea_field($attributes['description']) : 'The more
    comprehensive your business data, the more intelligent and effective your
     AI becomes. Our \'Launchpad Fuel\' indicator gives you a clear, visual
    guide to your data completeness, motivating you to build a powerful
    foundation that delivers the best possible marketing results.';

        ob_start();
        ?>
        <div class="homepage polaris-fuel-section">
            <div class="fuel">
                <div class="group-9">
                    <p class="div-3">
                        <span class="text-wrapper-11">Fuel Your Launchpad for
     </span>
                        <span class="text-wrapper-12">Maximum
    Performance</span>
                    </p>
                    <p class="the-more"><?php echo esc_html($description);
    ?></p>
                </div>
                <img class="mask-group"
                     src="<?php echo esc_url(get_template_directory_uri());
    ?>/img/mask-group.png"
                     alt="Dashboard interface preview"
                     loading="lazy" />
                <img class="fuel-tank"
                     src="<?php echo esc_url(get_template_directory_uri());
    ?>/img/fuel-tank-5-1.png"
                     alt="Fuel tank indicator showing data completeness"
                     loading="lazy" />
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    ?>
