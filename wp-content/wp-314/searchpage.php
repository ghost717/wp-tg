<?php
/*
Template Name: Search Page
*/
get_header(); ?>

    <main class="main">
        <section class="main__search">
            <div class="wrap content">
                
                <?php //get_search_form(); ?>

                <?php 
                    global $query_string;

                    $search_query = wp_parse_str( $query_string );
                    $search = new WP_Query( $search_query );

                    while($search->have_posts()) : $search->the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'thumbZawodnik', true);
                ?>

                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <?php the_content(); ?>
                    </div>

                <?php endwhile; wp_reset_postdata(); ?>
                
                <nav>
                    <?php kriesi_pagination($custom_query->max_num_pages); ?>
                </nav>

            </div>
        </section>     
    </main>

<?php get_footer(); ?>