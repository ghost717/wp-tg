<?php
/**
 * Template Name: Rozgrywki - Liga Mistrzów - Faza Grupowa
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
                    <a href="<?php echo get_page_link(1034); ?>">Tabela</a>
                    <a href="<?php echo get_page_link(1034); ?>">Faza grupowa</a>
                    <a href="<?php echo get_page_link(1034); ?>">Play off</a>
                </div>

                <div class="main__game__table  --lm">
                    <h3>Grupa<?php //the_field('faza_zasadnicza'); ?></h3>
                    <?php

$map_url = get_field('link_do_terminarza');
$map_url = 'https://plk.pl/tmp/tabela.xml';

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

    foreach($data as $tabela):

        echo '
            <div class="main__game__table__team flex-center --first">
                <div class="lp"> </div>
                <div class="name">'.$tabela['runda'].'</div>
                <div class="m">M</div>
                <div class="z">Z</div>
                <div class="p">P</div>
                <div class="ks">S</div>
                <div class="pkt">P</div>
                <div class="forma">Forma</div>
            </div>
        ';

                foreach($tabela->druzyna as $druzyna):
                    
?>
                <div class="main__game__table__team flex-center">
                    <div class="lp"><?php echo $druzyna['pozycja']; ?></div>
                    <div class="name"><?php echo $druzyna['pelna_nazwa']; ?></div>
                    <div class="m"><?php echo $druzyna['mecze']; ?></div>
                    <div class="z"><?php echo $druzyna['zwyciestwa']; ?></div>
                    <div class="p"><?php echo $druzyna['porazki']; ?></div>
                    <div class="ks"><?php echo $druzyna['kosze_zdobyte'].':'.$druzyna['kosze_zdobyte']; ?></div>
                    <div class="pkt"><?php echo $druzyna['pkt']; ?></div>
                    <div class="forma"></div>
                </div>
<?php
            endforeach;
    endforeach;
  }
}
?>                    
                </div>

            </div>
        </section><!-- main__game -->
    </main>

<?php get_footer(); ?>