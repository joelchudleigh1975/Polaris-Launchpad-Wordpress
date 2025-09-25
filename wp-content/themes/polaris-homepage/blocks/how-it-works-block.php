<?php
    /**
     * How It Works Block for Polaris Launchpad
     *
     * Animated section showing the 4-step journey with proper images
     *
     * @package PolarisLaunchpad
     */

    // Prevent direct access
    if (!defined('ABSPATH')) {
        exit;
    }

    /**
     * Initialize the how it works block
     */
    function polaris_how_it_works_block_init() {
        register_block_type('polaris/how-it-works', array(
            'render_callback' => 'polaris_how_it_works_block_render',
            'attributes' => array(
                'mainHeading' => array(
                    'type' => 'string',
                    'default' => 'A Smarter Foundation for Your AI in Three
  Steps.'
                )
            )
        ));
    }
    add_action('init', 'polaris_how_it_works_block_init');

    /**
     * Render the how it works block
     */
    function polaris_how_it_works_block_render($attributes) {
        $mainHeading = !empty($attributes['mainHeading']) ?
            sanitize_text_field($attributes['mainHeading']) : 'A Smarter
  Foundation for Your AI in Three Steps.';

        ob_start();
        ?>
        <div class="homepage polaris-how-it-works-section">
            <div class="how-it-works">
                <div class="overlap-2">
                    <div class="ellipse-2"></div>
                    <img class="rectangle-2" src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/rectangle-4.png" alt=""
  loading="lazy" />
                    <img class="image-2" src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/image-2-1.png"
  alt="Background pattern" loading="lazy" />
                    <img class="group-5" src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/group-270.png" alt=""
  loading="lazy" />

                    <!-- Main Heading (Static) -->
                    <p class="text-wrapper-5"><?php echo
  esc_html($mainHeading); ?></p>

                    <!-- Journey Path and Dots (Static) -->
                    <div class="group-6">
                        <div class="overlap-group-2">
                            <img class="vector-3" src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/vector-7.png" alt=""
  loading="lazy" />
                            <div class="ellipse-3"></div>
                            <div class="ellipse-4"></div>
                            <div class="ellipse-5"></div>
                        </div>
                        <img class="logo-icon-white-2" src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/logo-icon-white-1-1.png"
  alt="Polaris logo" loading="lazy" />
                    </div>

                    <!-- Animated Step Images - MIDDLE POSITION -->
                    <div class="animated-step-images">
                        <!-- Stage 1: BLANK -->
                        <div class="step-image step-1-img active">
                            <!-- Empty for stage 1 -->
                        </div>
                        <!-- Stage 2: Fuel Your AI Text -->
                        <div class="step-image step-2-img">
                            <div class="overlap-group-wrapper">
                                <div class="overlap-group-3"><div
  class="text-wrapper-8">2</div></div>
                            </div>
                            <div class="text-wrapper-6 center-title">Fuel
  Your AI</div>
                            <p class="text-wrapper-7">Your Base Camp becomes
   the "single source of truth". Use this rich context to inform any AI tool
   or prompt, ensuring it understands your business deeply.</p>
                            <img class="line" src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/line-20.svg" alt=""
  loading="lazy" />
                        </div>
                        <!-- Stage 3: Fuel Tank Image -->
                        <div class="step-image step-3-img">
                            <img src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/fuel-1.png" alt="Fuel Tank"
  class="fuel-tank-image" />
                        </div>
                    </div>

                    <!-- Animated Right Images - RIGHT POSITION -->
                    <div class="animated-right-images">
                        <!-- Stage 1: BLANK -->
                        <div class="step-image step-1-img active">
                            <!-- Empty for stage 1 -->
                        </div>
                        <!-- Stage 2: BLANK -->
                        <div class="step-image step-2-img">
                            <!-- Empty for stage 2 -->
                        </div>
                        <!-- Stage 3: Launch Marketing Text -->
                        <div class="step-image step-3-img">
                            <div class="overlap-group-wrapper">
                                <div class="overlap-group-3"><div
  class="text-wrapper-8">3</div></div>
                            </div>
                            <div class="text-wrapper-6 center-title">Launch
  Effective Marketing</div>
                            <p class="text-wrapper-7">Generate targeted,
  consistent, and on-brand content, strategies, and creative ideas that
  truly resonate with your ideal customers.</p>
                            <img class="line" src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/line-20.svg" alt=""
  loading="lazy" />
                        </div>
                    </div>

                    <!-- Step Content Area (Animated Text) - LEFT POSITION
  -->
                    <div class="group-7 animated-step-content">
                        <!-- Stage 1: Build Your Base Camp Text -->
                        <div class="step-content step-1 active">
                            <div class="text-wrapper-6">Build Your Base
  Camp</div>
                            <p class="text-wrapper-7">We guide you through
  centralising your key business knowledge. Our Smart Crawler helps by
  automatically finding information from your website and the wider internet
   to get you started.</p>
                            <img class="line" src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/line-20.svg" alt=""
  loading="lazy" />
                            <div class="overlap-group-wrapper">
                                <div class="overlap-group-3"><div
  class="text-wrapper-8">1</div></div>
                            </div>
                        </div>
                        <!-- Stage 2: Astronaut Image -->
                        <div class="step-content step-2">
                            <img src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/astronaut-1.png"
  alt="Astronaut" class="astronaut-image" />
                        </div>
                        <!-- Stage 3: Astronaut Image -->
                        <div class="step-content step-3">
                            <img src="<?php echo
  esc_url(get_template_directory_uri()); ?>/img/astronaut-1.png"
  alt="Astronaut" class="astronaut-image" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
        /* Animated Step Images - MIDDLE POSITION */
        .animated-step-images {
            position: absolute;
            top: 170px;
            left: 46%;
            transform: translateX(-50%);
            width: 280px;
            height: 150px;
            z-index: 4;
        }

        /* Animated Right Images - RIGHT POSITION (ADJUSTED) */
        .animated-right-images {
            position: absolute;
            top: 170px;
            right: 17%;
            width: 280px;
            height: 150px;
            z-index: 4;
        }

        .step-image {
            position: absolute;
            top: 0;
            left: 0;
            transform: scale(0.8);
            opacity: 0;
            transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            width: 280px;
            height: auto;
            color: white;
            text-align: center;
        }

        .step-image.active {
            opacity: 1;
            transform: scale(1);
        }

        /* Image sizing and positioning */
        .astronaut-image {
            max-width: 240px;
            height: auto;
            display: block;
            margin: 0 auto;
            margin-top: 20px;
        }

        .fuel-tank-image {
            max-width: 240px;
            height: auto;
            display: block;
            margin: 20px auto 0 auto;
            transform: translateX(50px);
        }

        /* General image centering */
        .step-image img {
            display: block;
            margin: 0 auto;
        }

        /* Force center alignment for the title specifically */
        .animated-step-images .center-title,
        .animated-right-images .center-title {
            text-align: center !important;
            width: 100%;
            display: block;
        }

        /* Ensure all other elements stay center-aligned */
        .animated-step-images .text-wrapper-7,
        .animated-right-images .text-wrapper-7 {
            text-align: center;
        }

        .animated-step-images .overlap-group-wrapper,
        .animated-right-images .overlap-group-wrapper {
            text-align: center;
            display: flex;
            justify-content: center;
        }

        .animated-step-images .line,
        .animated-right-images .line {
            display: block;
            margin: 0 auto;
        }

        /* Step Content Animation (Text Changes) */
        .polaris-how-it-works-section .step-content {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-in-out;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
        }

        .polaris-how-it-works-section .step-content.active {
            opacity: 1;
            transform: translateY(0);
        }

        .polaris-how-it-works-section .animated-step-content {
            position: relative;
            min-height: 200px;
        }

        /* Ensure proper z-index stacking */
        .polaris-how-it-works-section {
            position: relative;
            z-index: 1;
        }

        /* Remove any potential overlay issues */
        .polaris-how-it-works-section * {
            box-sizing: border-box;
        }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps =
  document.querySelectorAll('.polaris-how-it-works-section .step-content');
            const images =
  document.querySelectorAll('.polaris-how-it-works-section .step-image');
            let currentStep = 0;
            let animationInterval;

            function showStep(index) {
                // Hide all steps and images
                steps.forEach(step => step.classList.remove('active'));
                images.forEach(img => img.classList.remove('active'));

                // Show current step and image
                if (steps[index]) {
                    steps[index].classList.add('active');
                }
                if (images[index]) {
                    images[index].classList.add('active');
                }

                // ALSO show the corresponding right image (offset by 3)
                if (images[index + 3]) {
                    images[index + 3].classList.add('active');
                }
            }

            function nextStep() {
                currentStep = (currentStep + 1) % Math.min(steps.length,
  images.length);
                showStep(currentStep);
            }

            function startAnimation() {
                if (animationInterval) {
                    clearInterval(animationInterval);
                }
                animationInterval = setInterval(nextStep, 4000);
            }

            function stopAnimation() {
                if (animationInterval) {
                    clearInterval(animationInterval);
                    animationInterval = null;
                }
            }

            // Initialize
            showStep(0);
            startAnimation();

            // Pause on hover
            const container =
  document.querySelector('.polaris-how-it-works-section');
            if (container) {
                container.addEventListener('mouseenter', stopAnimation);
                container.addEventListener('mouseleave', startAnimation);
            }
        });
        </script>
        <?php
        return ob_get_clean();
    }
    ?>
