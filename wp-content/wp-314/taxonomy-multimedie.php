<?php 

include_once( ABSPATH . 'wp-admin/includes/image.php' );

$dir = $dir2 = $dirs = array();
$subdir = 'kadeci';
$newdir = 'trefl/mlodziez/'.$subdir;
$dir = glob('wp-content/uploads/trefl/mlodziez/'.$subdir.'/*');

$i=1;

// $pathinfo = pathinfo('/2018-2019/*');
// print_r($pathinfo);

// foreach ($dir as $d) {
//     $info = new SplFileInfo($d);
//     $fileExt = $info->getExtension();

//     if(!$fileExt){
//         array_push($dirs, $d);

//         global $post;
//         $title = explode('/', $d);
//         $title = array_reverse($title);

//         if (!get_page_by_title($title[0], 'OBJECT', 'multimedia')):

//             $post_id = addPost($title[0]);

//             wp_set_object_terms($post_id, 25, 'multimedie', true);

//             $result = dirToArray($d); 
            
//             addMedia($result, $post_id, $title[0], $subdir);

//             echo 'dodano: '.$title[0].'<br>';
//         else:
//             $page = get_page_by_title($title[0], 'OBJECT', 'multimedia');                                          
            
//             updatePost($page->ID, $title[0]);
//             //wp_delete_post($page->ID);
//             wp_set_object_terms($page->ID, 25, 'multimedie', true);
            
//             $result = dirToArray($d); 

//             //brakuje warunku sprawdzajacego duble / przycinane rozmiary
//         //    addMedia($result, $page->ID, $title[0], $subdir);

//             echo '<br> zaktualizowano post: id: '.$page->ID.'<br>';
//         endif;


//         $i++;
//     } else{
//         echo 'file: '.$d.'<br/>';
//     }
// }

function addMedia($result, $postID, $dirName, $subdir){
    for($i=0; $i<count($result); $i++){
        $filename = $result[$i];
       
        $uploaddir = wp_upload_dir();
    //    print_r($uploaddir);

        $uploadfile = $uploaddir['basedir'] . '/'.$subdir.'/' .$dirName. '/' . $filename;
        $uploadfile = $uploaddir['basedir'] . '/trefl/mlodziez/'.$subdir.'/' .$dirName. '/' . $filename;
        
        $wp_filetype = wp_check_filetype(basename($filename), null );
        
        $attachment = array(
            //'guid'           => $uploaddir['basedir'] . '/trefl/'.$subdir.'/' .$dirName. '/' . $filename, 
            'guid'           => $uploaddir['path'] . '/'. $filename, 
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => $filename,
            'post_content' => $filename,
            'post_status' => 'inherit'
        );
        
        $attach_id = wp_insert_attachment( $attachment, $uploadfile );
        
        //if(!get_the_post_thumbnail() && $i==0):
        if($i==0):
            set_post_thumbnail( $postID, $attach_id );
        endif;

        $imagenew = get_post( $attach_id );
        $fullsizepath = get_attached_file( $imagenew->ID );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
        wp_update_attachment_metadata( $attach_id, $attach_data );
        
        add_row( 'galeria', Array( 'zdjecie' => $attach_id ), $postID );

        echo 'dodano '.$filename.' '.$attach_id.'<br>';
    }
}

function addPost($title){
    $my_post = array(
        'post_title'    => wp_strip_all_tags( $title ),
        'post_content'  => ' ',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'      => 'multimedia',
    );

    $post_id = wp_insert_post( $my_post );

    return $post_id;
}

function updatePost($postID, $title){
    $my_post = array(
        'ID'            => $postID,
        'post_title'    => wp_strip_all_tags( $title ),
        'post_content'  => ' ',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'      => 'multimedia',
    );
    
    // wp_delete_post($page->ID);
    wp_update_post( $my_post, true );
}

function dirToArray($dir) { 
   
    $result = array(); 
 
    $cdir = scandir($dir); 
    foreach ($cdir as $key => $value) 
    { 
       if (!in_array($value,array(".",".."))) 
       { 
          if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
          { 
             $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value); 
          } 
          else 
          { 
             $result[] = $value; 
          } 
       } 
    } 
    
    return $result; 
}

get_header(); ?>

    <main class="main">
        <section class="main__foto">
            <div class="wrap content">
            
                <div class="main__header">
                    <h2>Multimedia</h2>
                </div>

                <div class="grid grid--news">
                    <?php
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                        $taxonomy = 'multimedie';

                        $args = array(
                            'paged'          => $paged,
                            'posts_per_page' => 12,
                            'post_type'      => 'multimedia',
                            'order'          => 'DESC',
                            
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field'    => 'slug',
                                    'terms'    => 'foto',
                                ),
                            ),
                        );

                        while (have_posts()) : the_post();
                            $thumb_id = get_post_thumbnail_id();
                            $thumb = wp_get_attachment_image_src($thumb_id,'thumbNews', true);
                    ?>

                        <div class="grid__item main__post">
                            <div class="thumb">
                                <?php
                                        if($thumb_id): 
                                            the_post_thumbnail('thumbNews');
                                            echo '<div class="bg" style="background-image: url('.$thumb[0].');"></div>';
                                        else:
                                            echo '<div class="bg logo"></div>';
                                        endif;
                                ?>
                            </div>

                            <article class="main__post__content content">
                                <div class="meta"><?php echo get_the_date('d.m.Y'); ?></div>
                                <a href="<?php the_permalink(); ?>" class="main__post__title"><h5 ><?php the_title(); ?></h5></a> 
                            </article>
                        </div>
                    
                    <?php endwhile; ?>
                </div><!-- grid__foto -->
                <nav>
                    <?php kriesi_pagination($custom_query->max_num_pages); ?>
                </nav>

            </div>
        </section><!-- main__foto -->
    </main>

<?php get_footer(); ?>