<?php
/**
 * Template Name: Multimedia - Foto
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__foto">
            <div class="wrap content">
            
                <div class="main__header">
                    <h2><?php the_field('subtitle'); ?><span class="--yellow"> - <?php the_title(); ?></span></h2>
                </div>

                <div class="grid grid--news">
                    <?php
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                        $taxonomy = 'multimedie';

                        $args = array(
                            'paged'          => $paged,
                            'posts_per_page' => 12,
                            'post_type'      => 'multimedia',
                            'order'          => 'DESC',
                            
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field'    => 'slug',
                                    'terms'    => 'foto',
                                ),
                            ),
                        );

                        $custom_query = new WP_Query($args);

                        while($custom_query->have_posts()) : $custom_query->the_post();
                            $thumb_id = get_post_thumbnail_id();
                            $thumb = wp_get_attachment_image_src($thumb_id,'thumbNews', true);
                    ?>

                        <div class="grid__item main__post">
                            <div class="thumb">
                                <?php
                                        if($thumb_id): 
                                            the_post_thumbnail('thumbNews');
                                            echo '<div class="bg" style="background-image: url('.$thumb[0].'"></div>';
                                        else:
                                            echo '<div class="bg logo"></div>';
                                        endif;
                                ?>
                            </div>

                            <article class="main__post__content content">
                                <div class="meta"><?php echo get_the_date('d.m.Y'); ?></div>
                                <a href="<?php the_permalink(); ?>" class="main__post__title"><h5 ><?php the_title(); ?></h5></a> 
                            </article>
                        </div>
                    
                    <?php endwhile; wp_reset_postdata(); ?>
                </div><!-- grid__foto -->
                <nav>
                    <?php kriesi_pagination($custom_query->max_num_pages); ?>
                </nav>

            </div>
        </section><!-- main__foto -->
    </main>

<?php get_footer(); ?>