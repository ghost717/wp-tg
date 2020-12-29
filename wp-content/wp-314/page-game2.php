<?php
/**
 * Template Name: Rozgrywki - Faza Play Off
 *
*/

get_header(); ?>

    <main class="main">
        <section class="main__game">
            <div class="wrap content">
                
                <div class="main__header">
                    <h2><?php the_field('subtitle'); ?><span class="--yellow"> - <?php the_field('subtitle_2'); ?></span></h2>
                </div>

                <div class="main__game__link">
                    <a href="<?php echo get_page_link(181); ?>">Faza zasadnicza</a>
                    <a href="<?php echo get_page_link(234); ?>">Faza play-off</a>
                </div>

                <div class="main__game__term">
                    <h3><?php the_field('faza_play-off'); ?></h3>
                    <?php

$map_url = get_field('link_do_terminarza');

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

    $i=1; foreach($data as $game):

        if($game['stage'] == "PlayOff"):
            if($game->homeTeam == 'Trefl Gdańsk' || $game->awayTeam == 'Trefl Gdańsk'):
?>
    
                <div class="main__game__term__match">
                    <div class="round">
                        <?php $j=1; while(have_rows('faza')): the_row(); if($j == $game['round']): the_sub_field('text'); endif; $j++; endwhile; ?>
                    </div>
                    <div class="round">TERMIN: <?php echo $game['round']; ?></div>
                    <div class="teams" data-score="<?php echo $game->result; $result = explode("-",$game->result) ?>">

                        <div class="team team1" data-team="<?php echo $game->homeTeam; ?>" data-score="<?php ?>">
                            <span class="name"><?php echo $game->homeTeam; ?></span>
                            <span class="logo"></span>
                            <span class="score"><?php echo $result[0]; ?></span>
                        </div>
                        -
                        <div class="team team2" data-team="<?php echo $game->awayTeam; ?>" data-score="<?php ?>">
                            <span class="score"><?php echo $result[1]; ?></span>
                            <span class="logo"></span>
                            <span class="name"><?php echo $game->awayTeam; ?></span>
                        </div>
                    </div>
                    <div class="date">
                        <?php $string = strtotime($game['date']); echo date('Y-m-d H:i:s', $string); ?>
                    </div> 
                </div>
<?php
            endif;
        endif;
    $i++; endforeach;
  }
}
?>                    
                </div>

            </div>
        </section><!-- main__game -->
    </main>

<?php get_footer(); ?>