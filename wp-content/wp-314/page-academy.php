<?php
/**
 * Template Name: Młodzież - Akademia
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__academy --relative">
            <div class="wrap content">
            
                <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'thumbBiznes', true);
                ?>

                        <div class="main__header">
                            <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php the_title(); ?></span></h2>
                        </div>

                        <div class="main__academy__item">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3">
                                    <div class="thumb flex-center">
                                        <!-- <img src="<?php echo $thumb[0]; ?>" alt="<?php echo $image['alt']; ?>"> -->
                                        <?php the_post_thumbnail('thumbBiznes'); ?>
                                    </div>
                                    <div class="logo">
                                        <img class="header__logo" src="<?php $image = get_field('logo' ,'options'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-9 art">
                                    <article>
                                        <?php the_content(); ?>
                                    </article>
                                    <?php if(get_field('link')): ?>
                                        <a href="<?php the_field('link'); ?>" class="more --gray">Nabór do akademii</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                <?php endwhile; ?>

            </div>
        </section><!-- main__academy -->
    </main>

<?php get_footer(); ?>