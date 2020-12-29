<?php
/**
 * Template Name: Bilety
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__tickets">
            <div class="bg gray"></div>
            <div class="wrap content --relative">

                <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'banner', true);
                ?>

                    <div class="main__header">
                        <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php if(get_field('subtitle_cennik')): the_field('subtitle_cennik'); else: the_title(); endif; ?></span></h2>
                    </div>

                    <div class="main__game">
                        <div class="main__game__link">
                            <?php if(get_field('mecze_standard')): ?>
                                <a href="<?php the_field('mecze_standard'); ?>">Mecze standard</a>
                            <?php endif; if(get_field('mecze_top')): ?>
                                <a href="<?php the_field('mecze_top'); ?>">Mecze top</a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="main__bilety__banner">
                        <div class="thumb --relative">
                            <img src="<?php $image = get_field('banner'); echo $thumb = $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            <div class="bg" style="background-image: url(<?php echo $thumb; ?>)"></div>
                        </div>
                    </div>

                    <div class="main__game">
                        <div class="main__game__link --ticket">
                            <?php if(get_field('link_bilety')): ?>
                                <a class="more --gray" href="<?php the_field('link_bilety'); ?>"><svg class="icon"><use xlink:href="#ticket"/></svg>Kup Bilety</a>
                            <?php endif; if(get_field('link_karnety')): ?>
                                <a class="more --gray" href="<?php the_field('link_karnety'); ?>"><svg class="icon"><use xlink:href="#ticket"/></svg>Kup Karnet</a>
                            <?php endif; ?>
                        </div>
                    </div>  

                <?php endwhile; ?>

            </div>
        </section><!-- main__bilety -->
    </main>

<?php get_footer(); ?>