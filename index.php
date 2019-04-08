<?php get_header(); ?>
<?php

    $args = array(
    	'post_type' => 'room',
    );
    $your_loop = new WP_Query( $args );

    if ( $your_loop->have_posts() ) : while ( $your_loop->have_posts() ) : $your_loop->the_post();
    $meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

    <!-- contents of Your Post -->
    <h1>Title</h1>
    <?php the_title(); ?>

    <h1>Content</h1>
    <?php the_content(); ?>

    <?php endwhile; endif; wp_reset_postdata(); ?>
<?php get_footer(); ?>