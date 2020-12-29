<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <!-- encoding -->
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- info / SEO -->
        <title><?php echo (get_field('title', 'option')) ? get_field('title', 'option') : bloginfo('title').' '.wp_title();; ?></title>
        <meta name="description" content="<?php echo (get_field('title', 'option')) ? get_field('description', 'option') : get_bloginfo('description'); ?>">
        
        <!-- fonts -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php get_template_part('no-script'); ?>

    <header class="header">
        <div class="header__top hidden-xs" data-aos="fade">
            <div class="wrap">
                <div class="row">

                    <div class="col-xs-12 col-sm-6 header__top__left">
                        <ul>
                            <li class="hidden-sm">
                                <svg class="icon"><use xlink:href="#marker" /></svg>
                                <?php the_field('adres', 'option'); ?>
                            </li>
                            <li>
                                <a href="tel:<?php the_field('tel', 'option'); ?>">
                                    <svg class="icon"><use xlink:href="#phone" /></svg>
                                    <?php the_field('tel', 'option'); ?>
                                </a>
                            </li>
                            <li class="hidden-xs">
                                <a href="mailto:<?php the_field('email', 'option'); ?>">
                                    <svg class="icon"><use xlink:href="#mail" /></svg>
                                    <?php the_field('email', 'option'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xs-12 col-sm-6 header__top__right">
                        <ul>
                            <li class="hidden-sm"><h6><?php the_field('seo_title', 'option'); ?></h6></li>
                            <li><?php get_template_part('search', 'form'); ?></li>
                            <li><?php dynamic_sidebar('social'); ?></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div><!-- header__top -->

        <div class="header__nav" data-aos="fade">
            <div class="wrap">
                <div class="row">

                    <a class="header__branding" href="<?php echo get_home_url(); ?>">
                        <img class="header__logo" src="<?php $image = get_field('logo' ,'options'); echo $thumb = $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
                    </a>
                
                    <nav class="header__menu" role="navigation">
                        <button class="header__nav__button menu__toggle">
                            <span class="menu__line"></span>
                            <span class="menu__line"></span>
                            <span class="menu__line"></span>
                        </button>
                        
                        <div id="menu" class="hidden-sm">
                            <?php wp_nav_menu(array('theme_location' => 'primary-menu')); ?>
                        </div>
                    </nav>

                </div>
            </div>
        </div><!-- header__nav -->

        <div class="header__bottom" data-aos="fade">
            <div class="wrap flex-center --relative">

                <div class="bg" style="background-image: url(<?php //asset('img/top_bar.png'); ?>);">
                    <?php get_template_part('lion', 'small'); ?>
                </div>

                <div class="match flex-center">
                    <div class="mecz">
                        <?php the_field('mecz_text', 'option'); ?>
                        <b <?php if(get_field('gospodarz', 'option') == 220) echo 'class="--yellow"'; ?>><?php echo get_the_title(get_field('gospodarz', 'option')); ?></b>
                        vs 
                        <b <?php if(get_field('goscie', 'option') == 220) echo 'class="--yellow"'; ?>><?php echo get_the_title(get_field('goscie', 'option')); ?></b>
                    </div>
                    <?php $termin = get_field('termin', 'option'); $string = strtotime($termin); $date = date('Y-m-d', $string); /* Y-m-d ?*/  $godz = date('H:i:s', $string); ?>
                    <span id="matchDay" class="date" data-date="<?php echo $date; ?>" data-hour="<?php echo $godz; ?>"></span>
                </div>

                <a href="<?php the_field('bilet', 'option'); ?>" target="__blank" class="more --yellow">Kup bilet</a>

            </div>
        </div>
    </header>

    <div class="main__animation">
        <div class="wrap">

            <div class="bg bg2 bg3">
                <?php get_template_part('lion', 'anim'); ?>
            </div>

        </div>
    </div>

<script>
    function czasDoWydarzenia(rok, miesiac, dzien, godzina, minuta, sekunda, milisekunda)
    {
        var aktualnyCzas = new Date();
        var dataWydarzenia = new Date(rok, miesiac, dzien, godzina, minuta, sekunda, milisekunda);
        var pozostalyCzas = dataWydarzenia.getTime() - aktualnyCzas.getTime();
        
        if (pozostalyCzas > 0)
        {						
            var s = pozostalyCzas / 1000;	// sekundy
            var min = s / 60;				// minuty
            var h = min / 60;				// godziny
            var d = h / 24;                 // dni

            var sLeft = Math.floor(s  % 60);	// pozostało sekund		
            var minLeft = Math.floor(min % 60);	// pozostało minut
            var hLeft = Math.floor(h);			// pozostało godzin	
            var dLeft = Math.floor(d);          // dni
            
            if (hLeft > 24)
            hLeft = hLeft%24;

            if (minLeft < 10)
            minLeft = "0" + minLeft;
            if (sLeft < 10)
            sLeft = "0" + sLeft;
            
            return "<b>" + dLeft + "</b>d : <b>" + hLeft + "</b>h : <b>" + minLeft + "</b>m : <b>" + sLeft + "</b>s";
        }
        else
            return "Mecz już się zakonczył";
    }
                        
    window.onload = function()
    {
        var date = document.getElementById('matchDay').getAttribute("data-date");
        dateRes = date.split('-');
        var hour = document.getElementById('matchDay').getAttribute("data-hour");
        hourRes = hour.split(':');
        //console.log(dateRes + ' ' + hourRes);
        for(var i=0; i<dateRes.length;i++){
            dateRes[i] = parseInt(dateRes[i], 10);
            hourRes[i] = parseInt(hourRes[i], 10);
        }
        dateRes[1] = dateRes[1] - 1; //msc - 1
        //console.log(dateRes + ' ' + hourRes);
        document.getElementById('matchDay').innerHTML = czasDoWydarzenia(dateRes[0], dateRes[1], dateRes[2], hourRes[0], hourRes[1], hourRes[2], 0);
        setInterval("document.getElementById('matchDay').innerHTML = czasDoWydarzenia(dateRes[0], dateRes[1], dateRes[2], hourRes[0], hourRes[1], hourRes[2], 0)", 1000);
    };
</script>