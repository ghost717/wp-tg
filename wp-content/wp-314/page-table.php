<?php
/**
 * Template Name: Tabela Plus Ligi
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__game__table">
            <div class="wrap content">
                
                <div class="main__header">
                    <h2><?php the_field('subtitle'); ?><span class="--yellow"> - <?php the_title(); ?></span></h2>
                </div>

                <div class="main__game__link">
                   <h3><?php the_field('subtitle_2'); ?></h3>
                </div>

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

                            foreach($data->table->team as $team):
                        ?>

                            <div class="main__game__table__team flex-center">
                                <div class="lp"><?php echo $team['position']; ?></div>
                                <div class="logo flex-center"><?php while(have_rows('druzyny')): the_row(); $post = get_sub_field('team'); setup_postdata( $post ); if(get_the_title() == $team): ?><img src="<?php $image = get_field('logo'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>"><?php endif; wp_reset_postdata(); endwhile; ?></div>
                                <div class="name"><h4><?php echo $team; ?></h4></div>
                                <div class="pkt"><?php echo $team['points']; ?></div>
                                <!-- <div class="games"><?php the_field('liczba_meczy'); ?></div> -->
                            </div>

                        <?php
                            endforeach;
                        }
                        }
                    ?>                    
                </div>

            </div>
        </section><!-- main__game -->
    </main>

<?php get_footer(); ?>