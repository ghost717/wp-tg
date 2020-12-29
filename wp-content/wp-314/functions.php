<?php

// function post_type_gallery(){
//     $labels = array(
//         'name' => _x('Galeria', 'Galeria', 'jwba'),
//         'singular_name' => _x('Galeria', 'Galeria', 'jwba'),
//     );
//     $args = array(
//         'label' => __('Galeria', 'jwba'),
//         'labels' => $labels,
//         'supports' => array('title', 'editor', 'thumbnail'),
//         'hierarchical' => false,
//         'public' => true,
//         'show_ui' => true,
//         'show_in_menu' => true,
//         'menu_position' => 4,
//         'show_in_admin_bar' => true,
//         'show_in_nav_menus' => true,
//         'can_export' => true,
//         'has_archive' => true,
//         'exclude_from_search' => false,
//         'publicly_queryable' => true,
//         'capability_type' => 'page',
//         // 'taxonomies' => array('category'),
//     );
    
//     register_post_type('gallery', $args);
// }
// add_action('init', 'post_type_gallery', 0);

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('<?php echo get_template_directory_uri(); ?>/dist/img/logo.png');
            height:137px;
            width:147px;
            background-size: 137px 147px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );

/*Function to defer or asynchronously load scripts*/
function js_async_attr($tag){

    # Do not add defer or async attribute to these scripts
    $scripts_to_exclude = array();
    
    foreach($scripts_to_exclude as $exclude_script){
     if(true == strpos($tag, $exclude_script ) )
     return $tag; 
    }
    
    # Defer or async all remaining scripts not excluded above
    return str_replace( ' src', ' defer="defer" src', $tag );
}

//add_filter( 'script_loader_tag', 'js_async_attr', 10 );

/**
 * webs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package webs
 */

 
//sierotki
// wywolanie dla ACF
// echo iworks_orphan(get_sub_field('opis'));
function iworks_orphan( $content )
{
    if ( !class_exists( 'iWorks_Orphan' ) ) {
        return $content;
    }
    $orphan = new iWorks_Orphan();
    return $orphan->replace( $content );
}

//remove_filter ('the_content', 'wpautop');
//add_filter('the_content','my_custom_formatting');
function my_custom_formatting($content){
    if(is_page()): 
        return $content;//usuwa p
    else:
        return wpautop($content);
    endif;
}


/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
*/

function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


/**
 * enqueue scripts and styles 
 * GOOGLE MAP APIS
*/

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyDI2evHkrl6x8squ2g-AhIGwzbWJKOYDG8');
}

add_action('acf/init', 'my_acf_init');

function nr_load_scripts() {
    //https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false
    if ( is_page(295) || is_page(604) || is_page(702) || is_page(705) ):
        wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDI2evHkrl6x8squ2g-AhIGwzbWJKOYDG8',null,null,true);  
        wp_enqueue_script('googlemaps');
	endif;
}
add_action( 'wp_enqueue_scripts', 'nr_load_scripts' );


function na_remove_slugg( $post_link, $post, $leavename ) {
    if ( 'offer' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}
//add_filter( 'post_type_link', 'na_remove_slugg', 10, 3 );

function na_parse_request( $query ) {

   if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
       return;
   }

   if ( ! empty( $query->query['name'] ) ) {
       $query->set( 'post_type', array( 'post', 'offer', 'page' ) );
   }
}
//add_action( 'pre_get_posts', 'na_parse_request' );



/**
* Outputs the url of ACF image object
* Usage: aImage('field', 'null/size', 'null/type')
* @param field $field
* @param size $size
* @param type $type
*
* @return string
*/
function aImage($row, $size = null, $type = null)
{
    if ($type != null) {
        $image = get_field($row);
    } else {
        $image = get_sub_field($row);
    }

    if ($size != null) {
        $img = $image['sizes'][$size];
    } else {
        $img = $image['url'];
    }
    echo $img;
}

/**
* Outputs the alt of ACF image object
* Usage: aAlt('field', 'null/type')
* @param field $field
* @param type $type
*
* @return string
*/
function aAlt($image, $type = null)
{
    if ($type != null) {
        $image = get_field($image);
    } else {
        $image = get_sub_field($image);
    }
    $alt = $image['alt'];
    echo $alt;
}

// function getPins() {
// 	$pins = array();
// 	$pinsRows = get_field('lokacja', 'option');

// 	foreach ($pinsRows as $row) {
// 		$pin = array('lat' => $row['mapa']['lat'], 'lng' => $row['mapa']['lng']);
// 		array_push($pins, $pin);
// 	}
    
// 	echo json_encode($pins);
// }


/**
* Takes a string and outputs N characters
* @param string
* @param integer
*
* @return string
*/
function trimStr($str, $count)
{
    return substr($str, 0, $count);
}


/**
* Check if the post is older than $days
* @param string
*
* @return boolean
*/
function isOld($days)
{
    $days = (int)$days;
    $offset = $days * 60 * 60 * 24;
    if (get_post_time() < date('U') - $offset) {
        return true;
    }
    return false;
}


//wywolanie
//kriesi_pagination($custom_query->max_num_pages);

function kriesi_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


function post_type_zawodnik()
{
    $labels = array(
        'name' => _x('Zawodnicy', 'Zawodnicy', 'webs'),
        'singular_name' => _x('Zawodnik', 'Zawodnik', 'webs'),
    );

    $args = array(
        'label' => __('Zawodnik', 'webs'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    //    'taxonomies' => array('category'),
    );
    
  register_post_type('zawodnik', $args);
}
add_action('init', 'post_type_zawodnik', 0);

register_taxonomy(
    "zawodnicy",
    array("zawodnik"),
    array(
        "hierarchical" => true,
        "label" => "Kategorie",
        "singular_label" => "Kategoria",
        "rewrite" => true
        )
);

function post_type_sztab()
{
    $labels = array(
        'name' => _x('Sztab szkoleniowy', 'Sztab szkoleniowy', 'webs'),
        'singular_name' => _x('Sztab szkoleniowy', 'Sztab szkoleniowy', 'webs'),
    );

    $args = array(
        'label' => __('Sztab szkoleniowy', 'webs'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    //    'taxonomies' => array('category'),
    );
    
  register_post_type('sztab', $args);
}
add_action('init', 'post_type_sztab', 0);

// register_taxonomy(
//     "zawodnicy",
//     array("sztab"),
//     array(
//         "hierarchical" => true,
//         "label" => "Kategorie",
//         "singular_label" => "Kategoria",
//         "rewrite" => true
//         )
// );

function post_type_druzyny()
{
    $labels = array(
        'name' => _x('Drużyny', 'Drużyny', 'webs'),
        'singular_name' => _x('Drużyna', 'Drużyna', 'webs'),
    );

    $args = array(
        'label' => __('Drużyna', 'webs'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    //    'taxonomies' => array('category'),
    );
    
  register_post_type('team', $args);
}
add_action('init', 'post_type_druzyny', 0);

register_taxonomy(
    "teams",
    array("team"),
    array(
        "hierarchical" => true,
        "label" => "Kategorie",
        "singular_label" => "Kategoria",
        "rewrite" => true
        )
);

function post_type_junior()
{
    $labels = array(
        'name' => _x('Juniorzy', 'Juniorzy', 'webs'),
        'singular_name' => _x('Junior', 'Junior', 'webs'),
    );

    $args = array(
        'label' => __('Junior', 'webs'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    //    'taxonomies' => array('category'),
    );
    
  register_post_type('junior', $args);
}
add_action('init', 'post_type_junior', 0);

register_taxonomy(
    "juniorzy",
    array("junior"),
    array(
        "hierarchical" => true,
        "label" => "Kategorie",
        "singular_label" => "Kategoria",
        "rewrite" => true
        )
);

function post_type_multimedia()
{
    $labels = array(
        'name' => _x('Multimedia', 'Multimedia', 'webs'),
        'singular_name' => _x('Multimedia', 'Multimedia', 'webs'),
    );

    $args = array(
        'label' => __('Multimedia', 'webs'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    //    'taxonomies' => array('category'),
    );
    
  register_post_type('multimedia', $args);
}
add_action('init', 'post_type_multimedia', 0);

register_taxonomy(
    "multimedie",
    array("multimedia"),
    array(
        "hierarchical" => true,
        "label" => "Kategorie",
        "singular_label" => "Kategoria",
        "rewrite" => true
        )
);



// remove the wp version
remove_action('wp_head', 'wp_generator');

// svg support
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//remove woocommerce styles
// add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// add options page
if (function_exists('acf_add_options_page')) {
	// Main page ACF Option
    $parent = acf_add_options_page(array(
        'page_title'    => '314 Theme',
        'menu_title'    => '314 Theme',
        'redirect'      => false
    ));

    // Subpage ACF Option
    // acf_add_options_sub_page(array(
    //     'page_title'    => 'Slider strony głównej',
    //     'menu_title'    => 'Slider',
    //     'parent_slug'   => $parent['menu_slug'],
    // ));

    // Subpage ACF Option
    acf_add_options_sub_page(array(
        'page_title'    => 'Ustawienia stopki',
        'menu_title'    => 'Footer',
        'parent_slug'   => $parent['menu_slug'],
    ));
}

// add the custom thumbnails size
add_action('after_setup_theme', 'wpdocs_theme_setup');
function wpdocs_theme_setup(){
    //add_image_size('fullhd', 1920, 1080, true);
    add_image_size('sliderFull', 1200, 574, true); //2,089
    add_image_size('sliderHalf', 600, 343, true); //1,75
    add_image_size('banner', 1200, 354, true); //3,391
    add_image_size('bannerSmall', 400, 213, true); //1,875
    add_image_size('thumbNews', 400, 410, true); //0,975
    add_image_size('thumbNewsSingle', 800, 468, true); //1,711
    add_image_size('thumbZawodnik', 300, 435, true); //0,69
    add_image_size('thumbZawodnikBig', 310, 810, true); //0,38
    add_image_size('thumbBiznes', 270, 220, true); //1,22
    add_image_size('thumbFan', 270, 420, true); //0,65
    add_image_size('thumbBilety', 1200, 800, true); //1,5
}

if (!function_exists('webs_setup')) :
 function webs_setup()
 {
     add_theme_support('post-thumbnails');

     register_nav_menus(array(
        'primary-menu' => esc_html__('Primary', 'webs'),
        'secondary-menu' => esc_html__('Secondary', 'webs'),
     ));

     add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
     ));

     add_theme_support('customize-selective-refresh-widgets');
}
endif;
add_action('after_setup_theme', 'webs_setup');

function webs_widgets_init(){
    register_sidebar(array(
        'name' => esc_html__('Social', 'webs'),
        'id' => 'social',
        'description' => esc_html__('Add widgets here.', 'webs'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Kaledarz', 'webs'),
        'id' => 'calendar',
        'description' => esc_html__('Add widgets here.', 'webs'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Newsletter', 'webs'),
        'id' => 'newsletter',
        'description' => esc_html__('Add widgets here.', 'webs'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'webs_widgets_init');


/**
* Returns the path to the asset
* @param string
*
* @return string
*/
function asset($asset)
{
    echo get_template_directory_uri() .'/dist/'. $asset;
}

// inc scripts and styles
function webs_scripts(){
    wp_enqueue_style('libcss', get_template_directory_uri() . '/dist/css/lib.css', true);
    wp_enqueue_style('maincss', get_template_directory_uri() . '/dist/css/app.css', true);
  

    wp_enqueue_script('libjs', get_template_directory_uri() . '/dist/js/lib.js', false);
    wp_enqueue_script('mainjs', get_template_directory_uri() . '/dist/js/app.js', false);
}
add_action('wp_enqueue_scripts', 'webs_scripts');

add_action('wp_enqueue_scripts', 'animationsScripts');
function animationsScripts() {
    wp_enqueue_script('tweenmax', get_template_directory_uri() .'/lion/TweenMax.min.js', false, '03092018', true);
    wp_enqueue_script('morphSVG', get_template_directory_uri() .'/lion/MorphSVGPlugin.min.js', false, '03092018', true);
    wp_enqueue_script('animationsJs', get_template_directory_uri() .'/lion/main.js', false, '03092018', true);
}


// body class
require get_template_directory() . '/inc/extras.php';


/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array( 'wpemoji' ));
    } else {
        return array();
    }
}
   
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
    if ('dns-prefetch' == $relation_type) {
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
        $urls = array_diff($urls, array( $emoji_svg_url ));
    }
    return $urls;
}




class jwba_social_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'jwba_social_widget', 'Social Icon',
            array('description' => 'Widget wyświetlający linki do popularnych portali społecznościowych.')
        );
    }

    //odpowiedzialna za samo wyświetlanie widgetu, w tablicy $args otrzymujemy ustawienia motywu odnośnie znaczników HTML-a używanych do budowania sidebaru
    public function widget($args, $instance) {


        $fb = $instance['facebook'];
        $tweet = $instance['twitter'];
        $google = $instance['google'];
        $inst = $instance['instagram'];
        $pinterest = $instance['pinterest'];
        $in = $instance['linkedin'];
        $yt = $instance['youtube'];


        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];

        if(!empty($title)){
            echo $args['before_title'].$title.$args['after_title'];
        }
        echo '<ul class="social-icons">';

            if(!empty($fb)){
                echo '<li><a href="'.$fb.'" class="btn btn-facebook" target="_blank"><span class="fa fa-facebook"></span></a></li>';
            }
            if(!empty($tweet)){
                echo '<li><a href="'.$tweet.'" class="btn btn-twitter" target="_blank"><span class="fa fa-twitter"></span></a></li>';
            }
            if(!empty($google)){
                echo '<li><a href="'.$google.'" class="btn btn-google" target="_blank"><span class="fa fa-google"></span></a></li>';
            }
            if(!empty($inst)){
                echo '<li><a href="'.$inst.'" class="btn btn-instagram" target="_blank"><span class="fa fa-instagram"></span></a></li>';
            }
            if(!empty($pinterest)){
                echo '<li><a href="'.$pinterest.'" class="btn btn-pinterest" target="_blank"><span class="fa fa-pinterest"></span></a></li>';
            }
            if(!empty($in)){
                echo '<li><a href="'.$in.'" class="btn btn-linkedin" target="_blank"><span class="fa fa-linkedin"></span></a></li>';
            }
            if(!empty($yt)){
                echo '<li><a href="'.$yt.'" class="btn btn-youtube" target="_blank"><span class="fa fa-youtube"></span></a></li>';
            }
        echo '</ul>';
    //    echo '<p>'.$text.'</p>';
        echo $args['after_widget'];

    }

    //wyświetlająca prosty formularz z ustawieniami, my używamy wyłącznie pola do uzupełnienia tytułu
    public function form($instance) {
            if(isset($instance['title'])){
                $title = $instance['title'];
            } else {
                $title = 'FOLLOW ME';
            }
            $fb = $instance['facebook'];
            $tweet = $instance['twitter'];
            $google = $instance['google'];
            $inst = $instance['instagram'];
            $pinterest = $instance['pinterest'];
            $in = $instance['linkedin'];
            $yt = $instance['youtube'];

            echo '<p><label for="'.$this->get_field_id('title').'">'.__('Title:').'</label><input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.esc_attr($title).'" /></p>';
            echo '<p><br/></p>';
            echo '<p><label for="'.$this->get_field_id('facebook').'">'.__('Facebook:').'</label><input class="widefat" id="'.$this->get_field_id('facebook').'" name="'.$this->get_field_name('facebook').'" type="text" value="'.esc_attr($fb).'" /></p>';
            echo '<p><label for="'.$this->get_field_id('twitter').'">'.__('Twitter:').'</label><input class="widefat" id="'.$this->get_field_id('twitter').'" name="'.$this->get_field_name('twitter').'" type="text" value="'.esc_attr($tweet).'" /></p>';
            echo '<p><label for="'.$this->get_field_id('google').'">'.__('Google:').'</label><input class="widefat" id="'.$this->get_field_id('google').'" name="'.$this->get_field_name('google').'" type="text" value="'.esc_attr($google).'" /></p>';
            echo '<p><label for="'.$this->get_field_id('instagram').'">'.__('Instagram:').'</label><input class="widefat" id="'.$this->get_field_id('instagram').'" name="'.$this->get_field_name('instagram').'" type="text" value="'.esc_attr($inst).'" /></p>';
            echo '<p><label for="'.$this->get_field_id('pinterest').'">'.__('Pinterest:').'</label><input class="widefat" id="'.$this->get_field_id('pinterest').'" name="'.$this->get_field_name('pinterest').'" type="text" value="'.esc_attr($pinterest).'" /></p>';
            echo '<p><label for="'.$this->get_field_id('linkedin').'">'.__('Linkedin:').'</label><input class="widefat" id="'.$this->get_field_id('linkedin').'" name="'.$this->get_field_name('linkedin').'" type="text" value="'.esc_attr($in).'" /></p>';
            echo '<p><label for="'.$this->get_field_id('youtube').'">'.__('Youtube:').'</label><input class="widefat" id="'.$this->get_field_id('youtube').'" name="'.$this->get_field_name('youtube').'" type="text" value="'.esc_attr($yt).'" /></p>';
    }

    //zapis konfiguracji – możemy tutaj sprawdzić poprawność wprowadzonych danych
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        $instance['facebook'] = (!empty($new_instance['facebook'])) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter'])) ? strip_tags($new_instance['twitter']) : '';
        $instance['google'] = (!empty($new_instance['google'])) ? strip_tags($new_instance['google']) : '';
        $instance['instagram'] = (!empty($new_instance['instagram'])) ? strip_tags($new_instance['instagram']) : '';
        $instance['pinterest'] = (!empty($new_instance['pinterest'])) ? strip_tags($new_instance['pinterest']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin'])) ? strip_tags($new_instance['linkedin']) : '';
        $instance['youtube'] = (!empty($new_instance['youtube'])) ? strip_tags($new_instance['youtube']) : '';

        return $instance;
    }

}

function register_jwba_social_widget() {
    register_widget('jwba_social_widget');
}
add_action('widgets_init', 'register_jwba_social_widget');


function your_scripts(){
    wp_enqueue_script(
        'script',
        get_template_directory_url().'/dist/js/ap.js',
        array('jquery'),
        null,
        true
    );
    wp_localize_script('script', 'anObject', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_script', 'your_scripts');

function your_function(){
    if($_POST){
        $var = $_POST['formInput'];
        $id = $_POST['postID'];
        $nr = $_POST['postNR'];
    //    $var += 1;
    //    update_field('licznik', 98, 2); //dziala
    
        update_sub_field(array('sonda', 1, 'pole', $nr, 'liczba_glosow'), $var, $id);      
    }
}
add_action('wp_ajax_your_function' , 'your_function');
add_action('wp_ajax_nopriv_your_function' , 'your_function');


