<?php
/**
 * Template Name: Młodzież - Junior - Osiągnięcia
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__achiev --relative">
            <div class="wrap content">
            
                <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'banner', true);
                ?>

                    <div class="main__header">
                        <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php the_title(); ?></span></h2>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="thumb">
                                <img src="<?php $image = get_field('zdjecie'); echo $thumb = $image['sizes']['sliderFull']; ?>" alt="<?php echo $image['alt']; ?>">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="main__stats">
                                <h3><?php the_field('subtitle_2'); ?></h3>

                                <?php while(have_rows('statystyki')): the_row(); ?>

                                    <h4><span><?php the_sub_field('nr'); ?></span><?php the_sub_field('tytul'); ?></h4>
        
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-8">
                            <artiche>
                                <?php the_content(); ?>
                            </artiche>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="thumb"><img src="<?php $image = get_field('zdjecie_2'); echo $thumb = $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>"></div>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>
        </section><!-- main__achiev -->
    </main>

<?php get_footer(); ?>