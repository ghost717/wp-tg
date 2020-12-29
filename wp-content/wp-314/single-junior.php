<?php get_header(); ?>

    <main class="main">
        <section class="main__teamPlayer">
            
            <?php if (have_posts()) : while (have_posts()) : the_post();
                    $thumb_id = get_post_thumbnail_id();
                    $thumb = wp_get_attachment_image_src($thumb_id,'thumbZawodnik', true);
            ?>

                <div class="wrap content">
                    <div class="main__header">
                        <h2><?php the_field('subtitle', 138); ?><span class="--yellow"> - <?php the_title(); ?></span></h2>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-4 avatar">
                            <img src="<?php $image = get_field('avatar_1'); echo $thumb = $image['sizes']['thumbZawodnikBig']; ?>" alt="<?php echo $image['alt']; ?>">
                        </div>
                        <div class="col-xs-12 col-sm-8 card">
                            <img src="<?php if(get_field('avatar_2')): $image = get_field('avatar_2'); echo $thumb = $image['sizes']['thumbZawodnik']; else: echo $thumb[0]; endif; ?>" alt="<?php echo $image['alt']; ?>">
                            <h3><?php the_field('seo_title', 'option'); ?></h3>

                            <div class="top">
                                <img class="logo" src="<?php $image = get_field('logo' ,'options'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
                                <h1><?php the_title(); ?></h1>
                            </div>
                            <div class="info">
                                <div class="nr"><span>NR <?php the_field('nr'); ?></span></div>
                                <div class="pos"><?php the_field('pozycja'); ?></div>
                                <div class="dane">Wzrost: <span><?php the_field('nr'); ?></span> Wiek: <span><?php the_field('wiek'); ?></span></div>
                            </div>
                        </div>
                    </div>
                </div><!-- wrap -->

                <div class="row --relative">
                    <div class="wrap content">
                        <div class="bg"></div>
                        <div class="col-xs-12 col-sm-offset-4 col-sm-8 stats">
                            <h2><?php the_title(); ?></h2>
                            <ul>
                                <li>Wiek: <b><?php the_field('wiek'); ?></b></li>
                                <li>Waga: <b><?php the_field('waga'); ?></b></li>
                                <li>Wzrost: <b><?php the_field('wzrost'); ?></b></li>
                                <li>Numer: <b><?php the_field('nr'); ?></b></li>
                                <li>Pozycja: <b><?php the_field('pozycja'); ?></b></li>
                                <li>Zasięg w bloku: <b><?php the_field('zasieg_w_bloku'); ?></b></li>
                                <li>Zasięg w ataku: <b><?php the_field('zasieg_w_ataku'); ?></b></li>
                            </ul>
                            <ul>
                                <li>Liczba sezonów w lidze: <b><?php the_field('liczba_sezonow_w_lidze'); ?></b></li>
                                <li>Liczba rozegranych meczów: <b><?php the_field('liczba_rozegranych_meczow'); ?></b></li>
                                <li>Liczba pkt zdobytych w lidze: <b><?php the_field('liczba_pkt_zdobytych_w_lidze'); ?></b></li>
                                <li>Liczba asów: <b><?php the_field('liczba_asow'); ?></b></li>
                                <li>Najwięcej asów w meczu: <b><?php the_field('najwiecej_asow_w_meczu'); ?></b></li>
                                <li>Liczba pkt z bloków: <b><?php the_field('liczba_pkt_z_blokow'); ?></b></li>
                                <li>Najwyższa liczba pkt zdobytych w meczu:<b><?php the_field('najwyzsza_liczba_zdobytych_pkt_w_meczu'); ?></b></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="main__teamPlayer__gallery">
                    <div class="wrap content">
                        <div class="main__header">
                            <h3>Zdjęcia powiązane z <span class="--yellow"> - <?php the_title(); ?></span></h3>
                        </div>
                        <div class="grid grid--gallery jwba_gallery">
                            
                            <?php 
                                while(have_rows('powiazane')): the_row();
                                    $image = get_sub_field('zdjecie'); $thumb = $image['sizes']['medium'];
                            ?>
                            
                                <div class="grid__item main__teamPlayer__gallery__item">
                                    <a href="<?php echo $thumb; ?>" class="bg" style="background-image: url(<?php echo $thumb; ?>);">
                                        <img src="<?php echo $thumb; ?>" alt="<?php echo $image['alt']; ?>">
                                    </a>
                                </div>
                            
                            <?php endwhile; ?>
<?php

//http://php.net/manual/en/function.exif-read-data.php
//https://piwigo.org/doc/doku.php?id=user_documentation:metadata



$query_images_args = array(
    'post_type' => 'attachment',
    'post_mime_type' =>'image',
    'post_status' => 'inherit',
    'posts_per_page' => -1,
);

$query_images = new WP_Query( $query_images_args );
$images = array();
foreach ( $query_images->posts as $image) {
//    echo $images[] = wp_get_attachment_url( $image->ID );
}
?>
                        </div>
                        <!-- <nav class="content">
                            <div id="prev">
                                <?php $next_post = get_previous_post(); if(!empty( $next_post )): ?>
                                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                                        <span class="more"><</span>
                                        <div class="name">
                                            <h4><?php echo $next_post->post_title; ?></h4>
                                        </div>
                                    </a>
                                <?php endif; ?>    
                            </div>
                            <div id="next">
                                <?php $next_post = get_next_post(); if(!empty( $next_post )): ?>
                                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                                        <div class="name">
                                            <h4><?php echo $next_post->post_title; ?></h4>
                                        </div>
                                        <span class="more">></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </nav> -->
                    </div>
                </div>

            <?php endwhile;endif; ?>

        </section><!-- main__teamPlayer -->
    </main>

<?php get_footer(); ?>