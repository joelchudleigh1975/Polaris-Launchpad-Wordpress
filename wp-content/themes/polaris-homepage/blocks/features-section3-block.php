<?php
    /**
     * Features Section 3 Block
     *
     * AI Marketing Tools section showcasing Brand Guidelines Generator,
     * LinkedIn Post Generator, and Meta Ads Builder.
     */

    function polaris_features_section3_block_render($attributes) {
        $custom_class = isset($attributes['className']) ?
    esc_attr($attributes['className']) : '';
        $img_uri = get_template_directory_uri() . '/img/';

        ob_start();
        ?>
        <div class="wp-block-polaris-features-section3 <?php echo
    $custom_class; ?>">
            <main class="features-section" data-model-id="603:4734">
                <div class="overlap">
                    <section class="group">
                        <div class="overlap-group">
                            <img class="img" src="<?php echo
  esc_url($img_uri
  . 'features-group-316-2.png'); ?>" alt="Brand Guidelines Generator
  interface mockup" loading="lazy" />
                            <div class="div">
                                <header>
                                    <h2 class="text-wrapper">Brand
  Guidelines
  Generator</h2>
                                    <p class="p">Turn your business
  personality into a professional brand guide</p>
                                </header>
                                <p class="text-wrapper-2">
                                    Stop wondering if your marketing sounds
  "right." Our Brand Guidelines Generator analyzes everything
                                    you've told us about your business and
  creates a comprehensive guide that defines:
                                </p>
                                <p class="perfect-for">
                                    Perfect for maintaining consistency
  across
   all your marketing—whether you're writing it or AI is
                                    helping.
                                </p>
                                <div class="group-2">
                                    <div class="bullet-point-1">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-3">Your
  unique
  brand voice and tone</p>
                                    </div>
                                    <div class="bullet-point-2">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p
  class="text-wrapper-3">Communication style across different channels</p>
                                    </div>
                                </div>
                                <div class="group-3">
                                    <div class="bullet-point-1">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-3">Messaging
  do's and don'ts</p>
                                    </div>
                                    <div class="bullet-point-2">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-3">Brand
  personality traits that resonate with your customers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="overlap-wrapper">
                        <div class="overlap-2">
                            <div class="rectangle" aria-hidden="true"></div>
                            <img class="mask-group" src="<?php echo
  esc_url($img_uri . 'features-mask-group.png'); ?>" alt="LinkedIn Post
  Generator background design" loading="lazy" />
                            <div class="group-4">
                                <header>
                                    <h2 class="text-wrapper-4">LinkedIn Post
  Generator</h2>
                                    <p class="text-wrapper-5">Create
  engaging
  LinkedIn content that sounds like you, not a robot</p>
                                </header>
                                <p class="text-wrapper-6">
                                    Generate LinkedIn posts that actually
  get
  engagement. Our AI crafts posts that:
                                </p>
                                <p class="simply-provide-a">
                                    Simply provide a topic or let AI suggest
  trending themes in your industry. Edit with natural language
                                    commands like "make it more casual" or
  "add a customer success story."
                                </p>
                                <div class="group-5">
                                    <div class="bullet-point-1">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-7">Reflect
  your
   industry expertise and unique perspective</p>
                                    </div>
                                    <div class="bullet-point-2">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-7">Speak
  directly to your target audience's challenges</p>
                                    </div>
                                </div>
                                <div class="group-6">
                                    <div class="bullet-point-1">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-7">Include
  compelling hooks and clear calls-to-action</p>
                                    </div>
                                    <div class="bullet-point-2">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-7">Maintain
  your authentic voice while following LinkedIn best practices</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rectangle-2"
  aria-hidden="true"></div>
                            <img class="mockup" src="<?php echo
  esc_url($img_uri . 'features-mockup-2.png'); ?>" alt="LinkedIn Post
  Generator interface mockup" loading="lazy" />
                            <img class="mask-group-2" src="<?php echo
  esc_url($img_uri . 'features-mask-group-1.png'); ?>" alt="LinkedIn Post
  Generator overlay design" loading="lazy" />
                        </div>
                    </section>
                    <section class="overlap-group-wrapper">
                        <div class="overlap-3">
                            <img class="group-7" src="<?php echo
  esc_url($img_uri . 'features-group-316-1.png'); ?>" alt="Meta Ads Builder
  interface mockup" loading="lazy" />
                            <div class="group-8">
                                <header>
                                    <h2 class="text-wrapper">Meta Ads
  Builder</h2>
                                    <p class="p">Design scroll-stopping
  Facebook and Instagram ads in minutes</p>
                                </header>
                                <p class="text-wrapper-2">
                                    Create complete ad campaigns with both
  compelling copy and eye-catching visuals:
                                </p>
                                <p class="text-wrapper-8">
                                    Build ads that look like they came from
  an
   expensive agency—because your AI has been trained on your
                                    specific business data.
                                </p>
                                <div class="group-9">
                                    <div class="bullet-point-1">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-3">
                                            <span class="meta-label">Ad
  Copy:</span> Headlines and descriptions tailored to your audience's pain
  points
                                        </p>
                                    </div>
                                    <div class="bullet-point-2">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-3">
                                            <span
  class="meta-label">Visuals:</span> AI-generated images that match your
  brand style and colors
                                        </p>
                                    </div>
                                </div>
                                <div class="group-11">
                                    <div class="bullet-point-1">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-3">
                                            <span
  class="meta-label">Variations:</span> Multiple versions for A/B testing
                                        </p>
                                    </div>
                                    <div class="bullet-point-2">
                                        <div class="vector-wrapper"
  aria-hidden="true">
                                            <img class="vector" src="<?php
  echo esc_url($img_uri . 'features-vector-13-11.svg'); ?>" alt="" />
                                        </div>
                                        <p class="text-wrapper-3">
                                            <span
  class="meta-label">Audience-Matched:</span> Different approaches for
  different customer personas
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </div>
        <?php
        return ob_get_clean();
    }

    // Register the block
    function polaris_features_section3_block_init() {
        register_block_type('polaris/features-section3', array(
            'render_callback' => 'polaris_features_section3_block_render',
            'attributes' => array(
                'className' => array(
                    'type' => 'string',
                    'default' => '',
                ),
            ),
        ));
    }
    add_action('init', 'polaris_features_section3_block_init');
    ?>
