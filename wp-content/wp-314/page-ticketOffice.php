<?php
/**
 * Template Name: Bilety - Kasa
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__tickets__tf">
            <div class="wrap content --relative">

                <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'large', true);
                ?>

                    <div class="main__header">
                        <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php if(get_field('subtitle_2')): the_field('subtitle_2'); else: the_title(); endif; ?></span></h2>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-7">
                            <div class="thumb">
                                <?php the_post_thumbnail('large'); ?>
                                <!-- <div class="bg" style="background-image: url(<?php echo $thumb[0]; ?>);"></div> -->
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <div class="kasy">
                                <?php while(have_rows('kasy')): the_row(); ?>

                                    <div class="kasy__item">
                                        <h3><?php the_field('subtitle_2'); ?> <span class="--yellow"><b><?php the_sub_field('title'); ?></b></span></h3>
                                        <article>
                                            <?php the_sub_field('text'); ?>
                                        </article>
                                        <?php if(get_sub_field('link')): ?>
                                            <a href="<?php the_sub_field('link'); ?>" class="more"><svg class="icon"><use xlink:href="#ticket"/></svg>Kup Bilety</a>
                                        <?php endif; ?>
                                    </div>

                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>
        </section><!-- main__tickets__tf -->
    </main>

<?php get_footer(); ?>