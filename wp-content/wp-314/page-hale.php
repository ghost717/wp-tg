<?php
/**
 * Template Name: Bilety - Hale
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__hale --relative">
            <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'thumbBilety', true);
            ?>

                <div class="wrap content">
                    <div class="main__header">
                        <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php the_field('subtitle_2'); ?></span></h2>
                    </div>

                    <div class="main__game">
                        <div class="main__game__link">
                            <?php while(have_rows('menu')): the_row(); ?>

                                <a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('text'); ?></a>

                            <?php endwhile; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <h1><?php the_field('subtitle_3'); ?></h1>
                        </div>
                        <div class="col-xs-12 col-sm-5 art">
                            <article>
                                <?php the_field('text'); ?>
                            </article>
                        </div>
                        <div class="col-xs-12 col-sm-7">
                            <?php the_post_thumbnail('thumbBilety'); ?>
                        </div>
                    </div>

                    <div class="main__header">
                        <h3>Dojazd <span class="--yellow"><b>na <?php the_field('subtitle_3'); ?></b></span></h3>
                    </div>
                    <?php if(get_field('dojazd')): ?>
                        <div class="row dojazd">
                            <?php while(have_rows('dojazd')): the_row(); ?>

                                <div class="col-xs-12 col-sm-3 dojazd__item">
                                    <article>
                                        <?php the_sub_field('text'); ?>
                                    </article>
                                </div>

                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if(get_field('mapa')): ?>
                    <div id="map">
                        <?php $location = get_field('mapa'); ?>
                        <div class="acf_map">
                            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-address="<?php echo $location['address']; ?>"></div>
                            <p class="address"><?php echo $location['address']; ?></p>
                        </div>
                    </div>
                <?php endif;  ?>

                <?php if(get_field('statystyki')): ?>
                    <div class="wrap content">
                        <div class="main__header">
                            <h3><?php the_field('subtitle_3'); ?> <span class="--yellow"><b>w liczbach</b></span></h3>
                        </div>
                        <div class="main__stats">
                            <div class="row">
                                <?php while(have_rows('statystyki')): the_row(); ?>

                                    <div class="col-xs-6 col-sm-2">
                                        <h6><span><?php the_sub_field('nr'); ?></span><?php the_sub_field('tytul'); ?></h6>
                                    </div>

                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endwhile; ?>

        </section><!-- main__hale -->
    </main>

<?php get_footer(); ?>
