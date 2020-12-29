<?php
/**
 * Template Name: Klub - Zarząd
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__club --relative">
            <!-- <div class="bg lion1"></div>
            <div class="bg lion2"></div> -->

            <div class="wrap content">
            
                <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'thumbNewsSingle', true);
                ?>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="main__header">
                                <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php the_title(); ?></span></h2>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-offset-4 col-sm-8 managment">
                            <article>
                                <?php while(have_rows('zarzad')): the_row(); ?>
                                    
                                    <div class="post">
                                        <div class="thumb">
                                            <img src="<?php $image = get_sub_field('zdjecie'); echo $thumb = $image['sizes']['thumbNews']; ?>" alt="<?php echo $image['alt']; ?>">
                                        </div>
                                        <article>
                                            <h4><?php the_sub_field('nazwa'); ?></h4>
                                            <span><?php the_sub_field('stanowisko'); ?></span>
                                            <?php the_sub_field('text'); ?>
                                        </article>
                                    </div>

                                <?php endwhile; ?>
                            </article>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>
        </section><!-- main__club -->
    </main>

<?php get_footer(); ?>