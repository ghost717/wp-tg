<?php
/**
 * Template Name: Biznes
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__biznes --relative">
            <div class="wrap content">
            
                <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'thumbNewsSingle', true);
                ?>

                        <div class="main__header">
                            <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php the_title(); ?></span></h2>
                        </div>

                        <div id="p<?php the_ID(); ?>" class="partners">
                            <?php while(have_rows('partnerzy')): the_row();
                                    $image = get_sub_field('zdjecie'); $thumb = $image['sizes']['thumbBiznes']; 
                            ?>

                                <div class="partners__item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-3">
                                            <div class="thumb flex-center">
                                                <img src="<?php echo $thumb; ?>" alt="<?php echo $image['alt']; ?>">

                                                <?php if(get_the_ID() == 450): ?>
                                                    <div class="bg" style="background-image: url(<?php echo $thumb; ?>);"></div>
                                                <?php endif; ?>
                                            </div>
                                            <?php if(get_sub_field('link')): ?>
                                                <a class="link" href="<?php the_sub_field('link'); ?>">
                                                    <img src="<?php asset('img/icon-world.png'); ?>" alt="">
                                                    <?php the_sub_field('link'); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-xs-12 col-sm-9 art">
                                            <article>
                                                <?php the_sub_field('text'); ?>
                                            </article>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                        </div>

                <?php endwhile; ?>

            </div>
        </section><!-- main__biznes -->
    </main>

<?php get_footer(); ?>