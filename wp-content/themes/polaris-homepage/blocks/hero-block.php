<?php
/**
 * Hero Block for Polaris Launchpad
 *
 * Hero section with seamless background transition from header
 *
 * @package PolarisLaunchpad
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Initialize the hero block
 */
function polaris_hero_block_init() {
    register_block_type('polaris/hero', array(
        'render_callback' => 'polaris_hero_block_render',
        'attributes' => array(
            'title' => array(
                'type' => 'string',
                'default' => 'Launch AI Marketing That Truly Understands Your Business.'
            ),
            'subtitle' => array(
                'type' => 'string',
                'default' => 'Polaris Launchpad AI centralises your unique business data to create a \'Base Camp\' that fuels every AI tool for more effective, on-brand content and strategies.'
            ),
            'ctaText' => array(
                'type' => 'string',
                'default' => 'Start 14-Day Free Trial'
            ),
            'ctaSubtext' => array(
                'type' => 'string',
                'default' => 'No payment details required. Set up in minutes.'
            ),
            'ctaUrl' => array(
                'type' => 'string',
                'default' => '/signup'
            )
        )
    ));
}
add_action('init', 'polaris_hero_block_init');

/**
 * Render the hero block
 *
 * @param array $attributes Block attributes
 * @return string Rendered HTML
 */
function polaris_hero_block_render($attributes) {
    // Sanitize attributes with proper fallbacks
    $title = !empty($attributes['title']) ? sanitize_text_field($attributes['title']) : 'Launch AI Marketing That Truly Understands Your Business.';
    $subtitle = !empty($attributes['subtitle']) ? sanitize_textarea_field($attributes['subtitle']) : 'Polaris Launchpad AI centralises your unique business data to create a \'Base Camp\' that fuels every AI tool for more effective, on-brand content and strategies.';
    $ctaText = !empty($attributes['ctaText']) ? sanitize_text_field($attributes['ctaText']) : 'Start 14-Day Free Trial';
    $ctaSubtext = !empty($attributes['ctaSubtext']) ? sanitize_text_field($attributes['ctaSubtext']) : 'No payment details required. Set up in minutes.';
    $ctaUrl = !empty($attributes['ctaUrl']) ? sanitize_text_field($attributes['ctaUrl']) : '/signup';

    ob_start();
    ?>
    <div class="homepage polaris-hero-section">
        <div class="hero">
            <div class="overlap">
                <div class="ellipse"></div>
                <img class="rocket-smoke" 
                     src="<?php echo esc_url(get_template_directory_uri()); ?>/img/rocket-smoke-1-1.png" 
                     alt="Rocket smoke decoration"
                     loading="lazy" />
                <img class="hero-copy" 
                     src="<?php echo esc_url(get_template_directory_uri()); ?>/img/hero-copy-2.png" 
                     alt="AI Marketing dashboard illustration"
                     loading="eager" />

                <div class="frame">
                    <h1 class="text-wrapper"><?php echo esc_html($title); ?></h1>
                    <p class="polaris-launchpad-AI"><?php echo esc_html($subtitle); ?></p>
                    <div class="group">
                        <div class="large-button">
                            <div class="overlap-group">
                                <div class="div"></div>
                                <a href="<?php echo esc_url(home_url($ctaUrl)); ?>" 
                                   class="button"
                                   aria-describedby="cta-description">
                                    <?php echo esc_html($ctaText); ?>
                                </a>
                            </div>
                        </div>
                        <p class="p" id="cta-description"><?php echo esc_html($ctaSubtext); ?></p>
                    </div>
                </div>

                <img class="img" 
                     src="<?php echo esc_url(get_template_directory_uri()); ?>/img/group-249.png" 
                     alt="" 
                     loading="lazy" />
                <img class="group-3" 
                     src="<?php echo esc_url(get_template_directory_uri()); ?>/img/group-248.png" 
                     alt="" 
                     loading="lazy" />
                <img class="logo-icon-white" 
                     src="<?php echo esc_url(get_template_directory_uri()); ?>/img/logo-icon-white-1.png" 
                     alt="Polaris Launchpad logo" 
                     loading="lazy" />
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
?>
