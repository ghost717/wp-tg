<?php
/**
 * Template Name: Klub - Media
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__club --relative">
            <!-- <div class="bg lion1"></div>
            <div class="bg lion2"></div> -->

            <div class="wrap content">
            
                <?php while (have_posts()) : the_post();
                        $thumb_id = get_post_thumbnail_id();
                        $thumb = wp_get_attachment_image_src($thumb_id,'thumbNewsSingle', true);
                ?>

                    <div class="row">

                        <div class="col-xs-12">
                            <div class="main__header">
                                <h2><?php the_field('subtitle'); ?> - <span class="--yellow"><?php the_title(); ?></span></h2>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-offset-6 col-sm-6 media contact">
                            <article>
                                <?php the_content(); ?>

                                <?php while(have_rows('kontakt')): the_row(); ?>
                                    
                                    <div class="post">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <h4><?php the_sub_field('nazwa'); ?></h4>
                                                <article>
                                                    <?php the_sub_field('text'); ?>
                                                </article>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <?php if(get_sub_field('tel')): ?><span class="tel">Tel: <a href="tel:<?php the_sub_field('tel'); ?>"><?php the_sub_field('tel'); ?></a></span> <?php endif; ?>
                                                <?php if(get_sub_field('fax')): ?><span class="fax">FAX: <a href="fax:<?php the_sub_field('fax'); ?>"><?php the_sub_field('fax'); ?></a></span> <?php endif; ?>
                                                <?php if(get_sub_field('email')): ?><span class="email">E-mail: <a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a></span> <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php endwhile; ?>
                            </article>
                        </div>

                        <div class="col-xs-12">

                            <a href="<?php $image = get_field('mapa'); echo $image['url']; ?>">
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            </a>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>
        </section><!-- main__club -->
    </main>

<?php get_footer(); ?>