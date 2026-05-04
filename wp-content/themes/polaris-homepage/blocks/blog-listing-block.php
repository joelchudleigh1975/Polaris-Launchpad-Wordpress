<?php
/**
 * Blog Listing Block
 *
 * Displays a paginated list of blog posts with featured images, categories,
 * excerpts, and a working "Load More" button powered by WordPress AJAX.
 *
 * AJAX endpoint: wp_ajax(nopriv)_polaris_load_more_posts
 * Nonce action:  polaris_load_more
 */

/**
 * Render a single post <article> element.
 *
 * Extracted into its own function so both the initial render and the
 * AJAX handler produce identical markup without duplicating template code.
 *
 * @param WP_Post $post The post object to render.
 * @return string       HTML string for the article.
 */
function polaris_render_blog_post_card( $post ) {
    $post_title = $post->post_title;
    if ( empty( $post_title ) ) {
        $post_title = get_the_title( $post->ID );
    }

    $featured_image = get_the_post_thumbnail_url( $post->ID, 'large' );
    $categories     = get_the_category( $post->ID );
    $category_name  = ! empty( $categories ) ? $categories[0]->name : 'Uncategorized';
    $excerpt        = get_the_excerpt( $post->ID );
    if ( empty( $excerpt ) ) {
        $excerpt = wp_trim_words( get_the_content( null, false, $post->ID ), 25, '...' );
    }

    ob_start();
    ?>
    <article class="div">
        <?php if ( $featured_image ) : ?>
            <img class="rectangle"
                 src="<?php echo esc_url( $featured_image ); ?>"
                 alt="<?php echo esc_attr( $post_title ); ?>"
                 loading="lazy" />
        <?php else : ?>
            <div class="rectangle placeholder-image"
                 style="background-color:#f0f0f0;display:flex;align-items:center;justify-content:center;color:#999;">
                No Image
            </div>
        <?php endif; ?>

        <div class="frame-2">
            <div class="frame-3">
                <div class="frame-4">
                    <div class="AI-tech-wrapper">
                        <div class="AI-tech"><?php echo esc_html( $category_name ); ?></div>
                    </div>
                    <h2 class="text-wrapper"><?php echo esc_html( $post_title ); ?></h2>
                    <p class="july-by-admin">
                        <span class="span">
                            <?php echo get_the_date( 'F j, Y', $post->ID ); ?>&nbsp;&nbsp;|&nbsp;&nbsp;By:
                        </span>
                        <span class="text-wrapper-2">
                            <?php echo esc_html( get_the_author_meta( 'display_name', $post->post_author ) ); ?>
                        </span>
                    </p>
                </div>
                <p class="p"><?php echo esc_html( $excerpt ); ?></p>
            </div>
            <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="button-wrapper">
                <div class="button">Read More</div>
            </a>
        </div>
    </article>
    <?php
    return ob_get_clean();
}

/**
 * Render the full Blog Listing block.
 *
 * @param array $attributes Block attributes from the editor.
 * @return string           HTML output.
 */
function polaris_blog_listing_block_render( $attributes ) {
    $custom_class  = isset( $attributes['className'] ) ? esc_attr( $attributes['className'] ) : '';
    $posts_per_page = isset( $attributes['postsPerPage'] ) ? (int) $attributes['postsPerPage'] : 4;

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $blog_posts  = get_posts( $args );
    $total_posts = (int) wp_count_posts( 'post' )->publish;
    $has_more    = $total_posts > $posts_per_page;

    ob_start();
    ?>
    <div class="wp-block-polaris-blog-listing <?php echo $custom_class; ?>">
        <div class="blog" data-model-id="603:4745">
            <h1 class="text-wrapper-3">News</h1>
            <div class="frame" id="polaris-posts-frame">
                <?php if ( ! empty( $blog_posts ) ) : ?>
                    <?php
                    foreach ( $blog_posts as $post ) {
                        echo polaris_render_blog_post_card( $post );
                    }
                    wp_reset_postdata();
                    ?>

                    <?php if ( $has_more ) : ?>
                    <button class="div-wrapper"
                            id="polaris-load-more-btn"
                            data-page="1"
                            data-per-page="<?php echo $posts_per_page; ?>"
                            data-total="<?php echo $total_posts; ?>"
                            onclick="polarisLoadMore()">
                        <div class="button-2" id="polaris-load-more-label">Load More</div>
                    </button>
                    <?php endif; ?>

                <?php else : ?>
                    <div class="no-posts">
                        <p>No blog posts found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
    function polarisLoadMore() {
        var btn      = document.getElementById('polaris-load-more-btn');
        var label    = document.getElementById('polaris-load-more-label');
        var frame    = document.getElementById('polaris-posts-frame');
        var page     = parseInt(btn.getAttribute('data-page'), 10);
        var perPage  = parseInt(btn.getAttribute('data-per-page'), 10);
        var total    = parseInt(btn.getAttribute('data-total'), 10);
        var nextPage = page + 1;

        // Prevent double-clicks
        btn.disabled = true;
        label.textContent = 'Loading\u2026';

        var data = new FormData();
        data.append('action',   'polaris_load_more_posts');
        data.append('page',     nextPage);
        data.append('per_page', perPage);
        data.append('nonce',    '<?php echo wp_create_nonce( 'polaris_load_more' ); ?>');

        fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
            method: 'POST',
            body:   data,
            credentials: 'same-origin',
        })
        .then(function(res) { return res.json(); })
        .then(function(response) {
            if (!response.success) {
                console.error('Load more failed:', response);
                label.textContent = 'Load More';
                btn.disabled = false;
                return;
            }

            // Inject the new post cards before the button
            var tmp = document.createElement('div');
            tmp.innerHTML = response.data.html;
            while (tmp.firstChild) {
                frame.insertBefore(tmp.firstChild, btn);
            }

            // Update the page counter
            btn.setAttribute('data-page', nextPage);

            // Hide the button if we have now loaded all posts
            var loaded = nextPage * perPage;
            if (loaded >= total || response.data.no_more) {
                btn.style.display = 'none';
            } else {
                label.textContent = 'Load More';
                btn.disabled = false;
            }
        })
        .catch(function(err) {
            console.error('Load more error:', err);
            label.textContent = 'Load More';
            btn.disabled = false;
        });
    }
    </script>
    <?php
    return ob_get_clean();
}

/**
 * AJAX handler for loading additional blog posts.
 *
 * Registered for both logged-in (wp_ajax_) and guest (wp_ajax_nopriv_)
 * requests so any visitor can load more posts.
 *
 * @return void Sends JSON and exits.
 */
function polaris_ajax_load_more_posts() {
    check_ajax_referer( 'polaris_load_more', 'nonce' );

    $page     = isset( $_POST['page'] )     ? (int) $_POST['page']     : 2;
    $per_page = isset( $_POST['per_page'] ) ? (int) $_POST['per_page'] : 4;
    $offset   = ( $page - 1 ) * $per_page;

    $posts = get_posts( array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $per_page,
        'offset'         => $offset,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    if ( empty( $posts ) ) {
        wp_send_json_success( array( 'html' => '', 'no_more' => true ) );
        return;
    }

    $html = '';
    foreach ( $posts as $post ) {
        $html .= polaris_render_blog_post_card( $post );
    }

    wp_send_json_success( array(
        'html'    => $html,
        'no_more' => count( $posts ) < $per_page,
    ) );
}
add_action( 'wp_ajax_polaris_load_more_posts',        'polaris_ajax_load_more_posts' );
add_action( 'wp_ajax_nopriv_polaris_load_more_posts', 'polaris_ajax_load_more_posts' );

/**
 * Register the block with WordPress.
 */
function polaris_blog_listing_block_init() {
    register_block_type( 'polaris/blog-listing', array(
        'render_callback' => 'polaris_blog_listing_block_render',
        'attributes'      => array(
            'className'    => array( 'type' => 'string', 'default' => '' ),
            'postsPerPage' => array( 'type' => 'number', 'default' => 4 ),
        ),
    ) );
}
add_action( 'init', 'polaris_blog_listing_block_init' );
