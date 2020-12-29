<?php
/**
 * Template Name: Bilety - Promocje
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__tickets__promo --relative">
            <div class="wrap content">
            
                <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'banner', true);
                ?>

                    <div class="main__header">
                        <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php the_title(); ?></span></h2>
                    </div>

                    <div class="main__banner">
                        <?php while(have_rows('bannery')): the_row(); ?>

                            <div class="main__banner__item">
                                <div class="thumb --relative">
                                    <img src="<?php $image = get_sub_field('zdjecie'); echo $thumb = $image['sizes']['banner']; ?>" alt="<?php echo $image['alt']; ?>">
                                    <div class="bg" style="background-image: url(<?php echo $thumb; ?>);"></div>
                                    <a class="more" href="<?php the_sub_field('link'); ?>"><svg class="icon"><use xlink:href="#ticket"/></svg>Kup Bilety</a>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    </div>

                    <div class="main__newsletter">
                        <?php dynamic_sidebar('newsletter'); ?>
                    </div>

                <?php endwhile; ?>

            </div>
        </section><!-- main__bilety__promo -->
    </main>

<?php get_footer(); ?>