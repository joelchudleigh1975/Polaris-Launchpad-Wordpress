<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <div class="page-container">
        <?php 
        if (have_posts()) : 
            while (have_posts()) : 
                the_post(); 
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php 
            endwhile; 
        endif; 
        ?>
    </div>
    
    <?php wp_footer(); ?>
</body>
</html>
