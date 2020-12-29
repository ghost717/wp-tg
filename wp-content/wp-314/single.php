<?php get_header(); ?>

    <main class="main">
        <section class="main__news__single">
            
            <?php while (have_posts()) : the_post();
                    $thumb_id = get_post_thumbnail_id();
                    $thumb = wp_get_attachment_image_src($thumb_id,'thumbNewsSingle', true);
            ?>

                <div class="wrap content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8">
                            <div class="thumb --relative <?php echo 't'.$thumb_id; ?>">
                                <?php the_post_thumbnail('thumbNewsSingle'); ?>
                                <div class="bg" style="background-image: url(<?php echo $thumb[0]; ?>);"></div>
                            </div>
                            <div class="main__header">
                                <div class="date flex-center">
                                    <span><?php echo get_the_date('d'); ?></span>
                                    <?php echo get_the_date('M'); ?>
                                </div>
                                <h2><?php the_title(); ?></h2>
                            </div>
                            <article>
                                <?php the_content(); ?>
                            </article>
                            <ul class="tags">
                                <?php
                                    $posttags = get_the_tags();
                                    if ($posttags) {
                                        foreach($posttags as $tag) {
                                            //echo $tag->name . ' '; 
                                            echo '<li>'.$tag->name.'</li>';
                                        }
                                    }
                                ?>
                            </ul>
                            <nav class="content">
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
                            </nav>
                        </div>
                        <div class="col-xs-12 col-sm-4 sidebar">
                            <div class="main__header">
                                <h3>Aktualności<span class="--yellow"><b> najnowsze</b></span></h3>
                            </div>
                            <?php
                                $args = array(
                                    'paged'          => 1,
                                    'posts_per_page' => 3,
                                    'post_type'      => 'post',
                                    'order'          => 'DESC',
                                );

                                $custom_query = new WP_Query($args);

                                while($custom_query->have_posts()) : $custom_query->the_post();
                                    $thumb_id = get_post_thumbnail_id();
                                    $thumb = wp_get_attachment_image_src($thumb_id,'medium', true);
                            ?>
                                
                                <div class="post">
                                    <div class="thumb --relative <?php echo 't'.$thumb_id; ?>">
                                        <?Php the_post_thumbnail('medium'); ?>
                                        <div class="bg" style="background-image: url(<?php echo $thumb[0]; ?>);"></div>
                                    </div>
                                    <article>
                                        <div class="date"><?php echo get_the_date('d.m.Y'); ?></div>
                                        <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                                    </article>
                                </div>

                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div><!-- wrap -->


            <?php endwhile; ?>

        </section><!-- main__news__single -->
    </main>

<?php get_footer(); ?>