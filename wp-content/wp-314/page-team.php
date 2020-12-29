<?php
/**
 * Template Name: Zawodnicy
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__team --page">
            <div class="wrap content">
                
                <div class="main__header">
                    <h2><?php the_field('subtitle'); ?><span class="--yellow"> - <?php the_title(); ?></span></h2>
                </div>

                <?php if(get_field('menu')): ?>
                    <div class="main__team__menu">
                        <?php
                            $i=1; while(have_rows('menu')): the_row(); 
                                $post = get_sub_field('zawodnik'); setup_postdata( $post );
                                $thumb_id = get_post_thumbnail_id();
                                if($thumb_id):
                                    $thumb = wp_get_attachment_image_src($thumb_id,'thumbZawodnik', true);
                                else:
                                    $thumb[0] = get_bloginfo('template_url').'/dist/img/sztab.jpg';
                                endif;

                        ?>

                            <div class="main__team__menu__item item-<?php echo $i; ?>">
                                <a href="<?php the_permalink(); ?>"><img src="<?php $image = get_field('avatar_1'); echo $thumb = $image['sizes']['thumbZawodnikBig']; ?>" alt="<?php $image['alt']; ?>"></a>
                                <a href="<?php the_permalink(); ?>" class="button">
                                    <h4><?php the_field('nr'); ?></h4>
                                    <h5><?php the_title(); ?></h5>
                                </a>
                            </div>

                        <?php wp_reset_postdata(); $i++; endwhile; ?>
                    </div>
                <?php endif; ?>
                
                <?php if(!is_page(566)): ?>
                    <div class="main__header --center">
                        <h3><?php the_title(); ?><span class="--yellow"> <?php the_field('seo_title' ,'options'); ?></span></h2>
                    </div>
                <?php endif; ?>

                <div class="grid grid--team">
                    <?php
                        while(have_rows('zawodnicy')): the_row(); 
                            $post = get_sub_field('zawodnik'); setup_postdata( $post );
                            $thumb_id = get_post_thumbnail_id();
                            if($thumb_id):
                                $thumb = wp_get_attachment_image_src($thumb_id,'thumbZawodnik', true);
                            else:
                                $thumb[0] = get_bloginfo('template_url').'/dist/img/sztab.jpg';
                            endif;
                    ?>

                        <div class="grid__item main__team__player">
                            <div class="main__team__player__thumb --relative">
                                <a href="<?php if(get_post_type( get_the_ID() ) == 'zawodnik'): the_permalink(); else: echo '#'; endif; ?>" class="bg" style="background-image: url(<?php echo $thumb[0]; ?>"><?php the_post_thumbnail('thumbZawodnik'); ?></a>
                            </div>

                            <article class="main__team__player__content content">
                                <h6><?php the_field('pozycja'); ?></h6>
                                <a href="<?php if(get_post_type( get_the_ID() ) == 'zawodnik'): the_permalink(); else: echo '#'; endif; ?>" class="main__team__player__title"><h3><?php the_title(); ?></h3></a> 
                                <h6 class="nr"><?php the_field('nr'); ?></h6>
                                <!-- <a href="<?php if(get_post_type( get_the_ID() ) == 'zawodnik'): the_permalink(); else: echo '#'; endif; ?>" class="more">></a> -->
                            </article>
                        </div>
                    
                    <?php wp_reset_postdata(); endwhile; ?>
                </div><!-- grid__team -->

                <div class="main__team">
                    <div class="owl-carousel">

                        <?php while(have_rows('zawodnicy')): the_row(); 
                            $post = get_sub_field('zawodnik'); setup_postdata( $post );
                            $thumb_id = get_post_thumbnail_id();
                            $thumb = wp_get_attachment_image_src($thumb_id,'thumbZawodnik', true);
                        ?>
                            <div class="main__team__player">
                                <div class="main__team__player__thumb">
                                    <a href="<?php if(get_post_type( get_the_ID() ) == 'zawodnik'): the_permalink(); else: echo '#'; endif;  ?>">
                                        <?php if(get_the_post_thumbnail()): 
                                                the_post_thumbnail('thumbZawodnik');
                                            else:    
                                        ?>
                                            <img src="<?php echo get_bloginfo( 'url' ).'/wp-content/uploads/2018/08/junior.jpg'; ?>" alt="">
                                        <?php endif; ?>
                                    </a>
                                </div>

                                <article class="main__team__player__content content">
                                    <h6><?php the_field('pozycja'); ?></h6>
                                    <a href="<?php the_permalink(); ?>" class="main__team__player__title"><h3><?php the_title(); ?></h3></a> 
                                    <h6 class="nr"><?php the_field('nr'); ?></h6>
                                </article>
                            </div>

                        <?php wp_reset_postdata(); endwhile; ?>

                    </div>
                </div>

            </div>
        </section><!-- main__team -->
    </main>

<?php get_footer(); ?>