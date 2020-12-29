<?php
/**
 * Template Name: Multimedia - Foto
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__foto__single">
            <div class="wrap content">
            
                <div class="main__header">
                    <h2><?php the_field('subtitle', 404); ?><span class="--yellow"> - <?php the_title(); ?></span></h2>
                </div>

                <?php if(get_field('galeria')): ?>
                    <div class="grid grid--news jwba_gallery">
                        <?php while(have_rows('galeria')): the_row(); 
                            $image = get_sub_field('zdjecie'); $thumb = $image['sizes']['thumbNews'];
                        ?>

                            <div class="grid__item main__post">
                                <div class="thumb">
                                    <img src="<?php echo $thumb; ?>" alt="<?php echo $image['alt']; ?>">
                                    <a href="<?php echo $thumb; ?>" class="bg" style="background-image: url(<?php echo $thumb; ?>">
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                                    </a>
                                </div>
                            </div>
                        
                        <?php endwhile; ?>
                    </div><!-- grid__foto -->
                <?php endif; ?>

                <?php if(get_field('video')): ?>
                    <div class="video fluidMedia">
                        <iframe width="420" height="315" src="https://www.youtube.com/embed/<?php the_field('video'); ?>?controls=0&autoplay=1&rel=0"></iframe>
                    </div>
                <?php endif; ?>

            </div>
        </section><!-- main__foto -->
    </main>

    <div id="ajax"></div>

<?php get_footer(); ?>