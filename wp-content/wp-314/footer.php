
    <div class="main__bg --relative">
      <div class="bg lion3"></div>

      <section class="bottom">
        <div class="wrap">

          <div class="bottom__banners">
            <div class="content">
              <div class="row">

                <div class="owl-carousel --relative">
                  <?php $i=0; while(have_rows('bannery' ,'options')): the_row(); ?>

                    <div class="col-xs-12 bottom__banners__item" data-aos="fade-right" data-aos-delay=<?php echo $t+=100; ?>>
                      <div class="row">

                        <div class="thumb --relative">
                          <img src="<?php $image = get_sub_field('zdjecie'); echo $thumb = $image['sizes']['bannerSmall']; ?>" alt="<?php echo $image['alt']; ?>">
                          <a class="bg" href="<?php echo the_sub_field('link'); ?>" style="background-image: url(<?php //echo $thumb; ?>);"></a>
                        </div>

                      </div>
                    </div>  

                  <?php $i++; endwhile; ?>
                </div>

              </div>
            </div>
          </div><!-- bottom__banners -->

          <div class="bottom__partners">
            <div class="content">
              <div class="row">

                <?php $i=1; while(have_rows('sponsorzy' ,'options')): the_row(); ?>

                  <div class="col-xs-12 <?php if($i === 4 || $i === 6): echo 'col-sm-8'; else: echo 'col-sm-4'; endif; ?>">
                    <h4><?php the_sub_field('nazwa'); ?></h4>

                    <div class="logos flex-center">
                      <?php $t=0;$s=1; while(have_rows('sponsor')): the_row(); ?>

                        <a class="p-<?php echo $s; ?>" href="<?php the_sub_field('link'); ?>" rel="nofollow" target="_blank" data-aos="fade" data-aos-delay=<?php echo $t+=50; ?>><img  src="<?php $image = get_sub_field('logo'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>"></a>

                      <?php $s++; endwhile; ?>
                    </div>
                  </div>

                <?php $i++; endwhile; ?>

              </div>
            </div>
          </div>

        </div>
      </section>

      <footer class="footer">
        <div class="bg"></div>
        
        <div class="wrap content">

          <ul class="row">

            <li class="col-xs-12 col-sm-3 footer__logo" data-aos="fade" data-aos-delay=<?php $t=0; echo $t+=100; ?>>
              <a href="<?php echo get_home_url(); ?>"><img class="footer__logo" src="<?php $image = get_field('logo_2' ,'options'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>"></a>
              <a href="<?php echo get_home_url(); ?>"><img class="footer__logo" src="<?php $image = get_field('logo_3' ,'options'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>"></a>
            </li>

            <li class="col-xs-12 col-sm-3 footer__info" data-aos="fade" data-aos-delay=<?php echo $t+=100; ?>>
              <h5><?php the_field('seo_title', 'option'); ?></h5>
              <p>
                <svg class="icon"><use xlink:href="#marker" /></svg>
                <?php the_field('adres', 'option'); ?>
              </p>
              <p>
                <a href="tel:<?php the_field('tel', 'option'); ?>">
                  <svg class="icon"><use xlink:href="#phone" /></svg>
                  <?php the_field('tel', 'option'); ?>
                </a>
              </p>
              <p>
                <a href="mailto:<?php the_field('email', 'option'); ?>">
                  <svg class="icon"><use xlink:href="#mail" /></svg>
                  <?php the_field('email', 'option'); ?>
                </a>
              </p>            
            </li>

            <li class="col-xs-12 col-sm-3 footer__menu" data-aos="fade" data-aos-delay=<?php echo $t+=100; ?>>
              <?php wp_nav_menu(array('theme_location' => 'secondary-menu')); ?>
            </li>

            <li class="col-xs-12 col-sm-3 footer__archive" data-aos="fade" data-aos-delay=<?php echo $t+=100; ?>>
              <?php dynamic_sidebar('social'); ?>
            </li>

          </ul>
        </div>

        <div class="footer__copy">
          <?php the_field('podpis_stopka' , 'option'); ?>
        </div>
      </footer>
    </div>

    <?php wp_footer(); ?>
  </body>
</html>