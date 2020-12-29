<?php
/**
 * Template Name: Newsletter
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__newsletter --relative">
            <div class="wrap content">
            
                <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'thumbNewsSingle', true);
                ?>

                    <div class="main__header">
                        <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php the_title(); ?></span></h2>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-9">
                            <article>
                                <?php the_content(); ?>
                            </article> 
                            <?php dynamic_sidebar('newsletter'); ?>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="logo">
                                <img class="header__logo" src="<?php $image = get_field('logo' ,'options'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
                            </div>
                        </div>
                    </div>   

                <?php endwhile; ?>

            </div>
        </section><!-- main__zone -->
    </main>

<?php get_footer(); ?>