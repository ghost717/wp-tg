<?php
/**
 * Template Name: Home
 *
*/

get_header(); ?>

    <main class="main">
      <section class="main__sliders">
        <div class="wrap content --relative">

          <div class="main__slider">
            <div class="owl-carousel --relative">
  
              <?php 
                  while(have_rows('slider')): the_row();
                    $post = get_sub_field('post'); setup_postdata( $post );
                    if(get_sub_field('zdjecie')): $image = get_sub_field('zdjecie'); $thumb = $image['sizes']['sliderFull']; else: $thumb_id = get_post_thumbnail_id(); $thumb = wp_get_attachment_image_src($thumb_id,'sliderFull', true); endif;
              ?>
                
                  <div class="main__slider__item flex-center">
                      <div class="bg" style="background-image: url(<?php if(get_sub_field('zdjecie')): echo $thumb; else: echo $thumb[0]; endif; ?>);"></div>
                      
                      <div class="main__post --bg">
                        <article class="main__post__content content">
                            <div class="meta"><?php echo get_the_date('d.m.Y'); ?></div>
                            
                            <a href="<?php the_permalink(); ?>" class="main__post__title">
                              <h2><?php if(get_sub_field('title')): the_sub_field('title'); else: the_title(); endif; ?></h2>
                            </a>

                            <?php if(get_sub_field('text')): the_sub_field('text'); else: the_content(); endif; ?>
                        </article><!-- content -->
                        <a href="<?php the_permalink(); ?>" class="more">></a>
                      </div>
                  </div>
  
              <?php wp_reset_postdata(); endwhile; ?>
  
            </div><!-- owl -->
          </div><!-- main__slider -->

          <div class="main__thumbslider">
            <div class="owl-carousel">
  
              <?php 
                  while(have_rows('slider')): the_row();
                    $post = get_sub_field('post'); setup_postdata( $post );
                    if(get_sub_field('zdjecie')): $image = get_sub_field('zdjecie'); $thumb = $image['sizes']['sliderHalf']; else: $thumb_id = get_post_thumbnail_id(); $thumb = wp_get_attachment_image_src($thumb_id,'sliderHalf', true); endif;
              ?>
                
                  <div class="main__thumbslider__item flex-center">
                      <div class="bg" style="background-image: url(<?php if(get_sub_field('zdjecie')): echo $thumb; else: echo $thumb[0]; endif; ?>);"></div>
                      
                      <div class="main__post --bg">
                        <article class="main__post__content content">
                            <div class="meta"><?php echo get_the_date('d.m.Y'); ?></div>
                            <h5 class="main__post__title"><?php if(get_sub_field('title')): the_sub_field('title'); else: the_title(); endif; ?></h5>
                        </article><!-- content -->
                        <a href="<?php the_permalink(); ?>" class="more">></a>
                      </div>
                  </div>
  
              <?php wp_reset_postdata(); endwhile; ?>
  
            </div><!-- owl -->
          </div><!-- main__thumbslider -->

        </div>
      </section><!-- main__sliders -->

      <section class="main__game">
        <div class="wrap content">

          <div class="main__header">
            <h2><?php the_field('naglowek_spotkania'); ?> <span class="--yellow"><?php the_field('seo_title', 'options'); ?></span></h2>
          </div>

          <div class="grid grid--news">
            <?php $i=0; while(have_rows('spotkania')): the_row(); ?>

              <div class="grid__item">
                <div class="post">
                  <?php if($i == 1): ?><div class="bg" style="background-image: url(<?php asset('img/logo_bg.png'); ?>)"></div><?php endif; ?>
                  <h4><?php the_sub_field('naglowek'); ?></h4>
                  <span class="term"><?php the_sub_field('termin'); ?></span>

                  <div class="main__game__term">
                    <div class="main__game__term__match">
                      <div class="teams">
                        <div class="team team1">
                            <span class="name"><?php the_sub_field('nazwa_1'); ?></span>
                            <span class="logo"></span>
                            <span class="score"><?php the_sub_field('wynik_1'); ?></span>
                        </div>
                        -
                        <div class="team team2">
                            <span class="score"><?php the_sub_field('wynik_2'); ?></span>
                            <span class="logo"></span>
                            <span class="name"><?php the_sub_field('nazwa_2'); ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- .post -->

                <a href="<?php the_sub_field('link'); ?>" class="more"><?php if($i < 2): echo 'Statystyki'; else: echo 'Kup bilety'; endif; ?></a>
              </div>

            <?php $i++; endwhile; ?>
          </div>

        </div>
      </section><!-- main__game -->

      <section class="main__news">
        <div class="wrap content">
          
          <div class="main__header">
            <h2><?php the_field('naglowek_news'); ?> <span class="--yellow"><?php the_field('seo_title', 'options'); ?></span></h2>
          </div>

          <div class="grid grid--news">
            <?php
                $args = array(
                  'paged'          => 1,
                  'posts_per_page' => 6,
                  'post_type'      => 'post',
                  'order'          => 'DESC',
                );

                $custom_query = new WP_Query($args);

                while($custom_query->have_posts()) : $custom_query->the_post();
                  $thumb_id = get_post_thumbnail_id();
                  $thumb = wp_get_attachment_image_src($thumb_id,'thumbNews', true);
            ?>

                  <?php get_template_part('post-content'); ?>
              
            <?php endwhile; wp_reset_postdata(); ?>
          </div><!-- grid__news -->

        </div>
      </section><!-- main__news -->
      
      <section class="main__sonda">
        <div class="bg"></div>
        
        <div class="wrap content --relative">
          
            <div class="main__header">
              <h2><?php the_field('naglowek_sonda'); ?> <span class="--yellow"><?php the_field('seo_title', 'options'); ?></span></h2>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <?php while(have_rows('sonda')): the_row(); ?>

                  <article class="sf --relative">
                    <div class="bg" style="background-image: url(<?php asset('img/bg_logo_full.png'); ?>)"></div>
                    <h4><?php the_sub_field('pytanie'); ?></h4>
                    <ul>
                      <?php $i=1; $glosy = array(); while(have_rows('pole')): the_row();
                            $l_glosow = get_sub_field('liczba_glosow'); 
                            
                      ?>

                            <li>
                              <form>  
                                <img src="<?php $image = get_sub_field('zdjecie'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
                                <input type="radio" name="l_glosow" value="<?php echo $l_glosow + 1; ?>"><?php the_sub_field('text'); ?>
                                <input type="hidden" name="nr" value="<?php echo $i; ?>">
                                <input type="hidden" name="postID" value="<?php the_ID(); ?>">
                              </form>
                              <?php $glosy[$i] = $l_glosow; ?>
                              <div class="glosy"><?php echo $l_glosow; ?></div>
                            </li>
                            
                      <?php $i++; endwhile; ?>
                    </ul>
                    <a href="#" class="more">Zobacz wyniki</a>
                    <div class="msg" data-total="<?php for($i=0; $i<count($glosy); $i++){ $counter += $glosy[$i]; } echo $counter; ?>"></div>
                  </article>

                <?php endwhile; ?>
              </div>

              <div class="col-xs-12 col-sm-6">
                <div class="owl-carousel">
                  <?php while(have_rows('slider_sonda')): the_row(); ?>

                      <div class="item">
                        <img src="<?php $image = get_sub_field('zdjecie'); echo $thumb = $image['sizes']['bannerSmall']; ?>" alt="<?php echo $image['alt']; ?>">
                        <div class="bg" style="background-image: url(<?php $image = get_sub_field('zdjecie'); echo $thumb = $image['sizes']['bannerSmall']; ?>)"></div>
                        <article>
                          <?php the_sub_field('text'); ?>
                        </article>
                      </div>

                  <?php endwhile; ?>
                </div>
              </div>
            </div>

        </div>
      </section><!-- main__sonda -->
      
      <section class="main__team">
        <div class="wrap content">
            
            <div class="main__header">
              <h2><?php the_field('naglowek_zawodnicy'); ?> <span class="--yellow"><?php the_field('seo_title', 'options'); ?></span></h2>
            </div>

            <div class="row">
              <div class="col-xs-12 col-sm-9">
                <div class="owl-carousel">

                    <?php while(have_rows('zawodnicy')): the_row(); 
                      $post = get_sub_field('zawodnik'); setup_postdata( $post );
                    ?>
                          <div class="main__team__player">
                            <div class="main__team__player__thumb">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbZawodnik'); ?></a>
                                <!-- <div class="bg" style="background-image: url(<?php echo $thumb[0]; ?>"></div> -->
                            </div>

                            <article class="main__team__player__content content">
                                <h6><?php the_field('pozycja'); ?></h6>
                                <a href="<?php the_permalink(); ?>" class="main__team__player__title"><h3><?php the_title(); ?></h3></a> 
                                <h6 class="nr"><?php the_field('nr'); ?></h6>
                            </article>
                          </div>

                    <?php wp_reset_postdata(); endwhile; ?>

                </div>

                <a href="<?php the_field('zawodnicy_link'); ?>" class="more more2">Drużyna</a>

              </div>
            </div>
            
            <div class="main__team__banner --relative">
              <img src="<?php $image = get_field('zawodnicy_banner'); echo $thumb = $image['sizes']['banner']; ?>" alt="<?php $image['alt']; ?>">
              <div class="bg" style="background-image: url(<?php $image = get_field('zawodnicy_banner'); echo $thumb = $image['sizes']['banner']; ?>);"></div>
              <article class="bg">
                  <a href="<?php if(get_field('banner_link')): the_field('banner_link'); else: the_field('bilet', 'option'); endif; ?>" class="more" target="_blank">Kup bilet</a>
                  <span><?php the_field('seo_title', 'options'); ?></span>
              </article>  
            </div>

        </div>
      </section>

      <section class="main__calendar --bgGray --relative">
        <div class="bg"></div>

        <div class="wrap content">

          <div class="row">
            <div class="col-xs-12 col-sm-8">
              <div class="main__header">
                <h2><?php the_field('naglowek_kalendarz'); ?> <span class="--yellow"><?php the_field('seo_title', 'options'); ?></span></h2>
              </div>
              <div class="calendar">

                <?php echo do_shortcode('[eo_fullcalendar]'); ?>
             
              </div>
            </div>

            <div class="col-xs-12 col-sm-4">
              <div class="main__header">
                <h2><?php the_field('naglowek_tabela'); ?></h2>
              </div>

              <div class="main__game">
                <div class="main__game__table">

                    <div class="main__game__table__team flex-center">
                        <div class="lp">Pozycja</div>
                        <div class="logo"></div>
                        <div class="name"><h4>Zespół</h4></div>
                        <div class="pkt">Pkt</div>
                        <!-- <div class="games">Mecze</div> -->
                    </div>

                    <?php
                      $map_url = get_field('link_tabela');

                      if (($response_xml_data = file_get_contents($map_url))===false){
                          echo "Error fetching XML\n";
                      } else {
                          libxml_use_internal_errors(true);
                          $data = simplexml_load_string($response_xml_data);
                      if (!$data) {
                          echo "Error loading XML\n";
                          foreach(libxml_get_errors() as $error) {
                              echo "\t", $error->message;
                          }
                      } else {

                          $i=1; foreach($data->table->team as $team):
                            if($i < 7){
                      ?>

                          <div class="main__game__table__team flex-center">
                              <div class="lp"><?php echo $team['position']; ?></div>
                              <div class="logo flex-center"><?php while(have_rows('druzyny', 232)): the_row(); $post = get_sub_field('team'); setup_postdata( $post ); if(get_the_title() == $team): ?><img src="<?php $image = get_field('logo'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>"><?php endif; wp_reset_postdata(); endwhile; ?></div>
                              <div class="name"><h4><?php echo $team; ?></h4></div>
                              <div class="pkt"><?php echo $team['points']; ?></div>
                              <!-- <div class="games"><?php the_field('liczba_meczy'); ?></div> -->
                          </div>

                      <?php }
                         $i++; endforeach;
                      }
                      }
                  ?> 
                </div>

                <a href="<?php echo get_page_link(232); ?>" class="more --gray">Pełna tabela</a>
              </div>

            </div>
          </div>

        </div>
      </section><!-- main__calendar -->
      
      <section class="main__video">
        <div class="wrap content">
            
          <div class="main__header">
            <h2><?php the_field('naglowek_video'); ?> <span class="--yellow"><?php the_field('seo_title', 'options'); ?></span></h2>
          </div>
          
          <div class="grid grid--video">
            <?php
              $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
              $taxonomy = 'multimedie';

              $args = array(
                            'paged'          => $paged,
                            'posts_per_page' => 4,
                            'post_type'      => 'multimedia',
                            'order'          => 'DESC',
                            
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field'    => 'slug',
                                    'terms'    => 'video',
                                ),
                            ),
              );

              $custom_query = new WP_Query($args);

              while($custom_query->have_posts()) : $custom_query->the_post();
                  $thumb_id = get_post_thumbnail_id();
                  $thumb = wp_get_attachment_image_src($thumb_id,'thumbNews', true);
            ?>

                        <div class="grid__item main__post">
                            <div class="thumb">
                                <?php
                                        // if($thumb_id): 
                                        //     the_post_thumbnail('thumbNews');
                                        //     echo '<div class="bg" style="background-image: url('.$thumb[0].'"></div>';
                                        // else:
                                        //     echo '<div class="bg logo"></div>';
                                        // endif;
                                ?>
                                <div class="video fluidMedia">
                                    <iframe width="420" height="315" src="https://www.youtube.com/embed/<?php the_field('video'); ?>?controls=0&autoplay=0&rel=0&showinfo=0&modestbranding=0"></iframe>
                                </div>
                            </div>

                            <article class="main__post__content content">
                                <div class="meta"><?php echo get_the_date('d.m.Y'); ?></div>
                                <a href="<?php the_permalink(); ?>" class="main__post__title"><h5><span class="--yellow"><?php the_field('subtitle'); ?></span><?php the_title(); ?></h5></a> 
                            </article>
                            <a href="<?php the_permalink(); ?>" class="more"><svg class="icon"><use xlink:href="#play" /></svg></a>
                        </div>
                    
            <?php endwhile; wp_reset_postdata(); ?>
          </div><!-- grid__foto -->

          <a href="<?php the_field('link_video'); ?>" class="more --gray">Zobacz wszystkie</a>

            </div>
        </div>
      </section>

    </main>

<?php get_footer(); ?>