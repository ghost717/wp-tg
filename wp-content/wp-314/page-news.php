<?php
/**
 * Template Name: Aktualności
 *
*/

get_header();


// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "wp_trefl_silver";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 
// mysqli_set_charset($conn,"utf8");

// $sql = "SELECT * FROM newsobject WHERE ClassName = 'MansVolleyballNewsObject' AND Kategoria = 'Aktualności'"; 
// $result = $conn->query($sql);


   
//   // Insert the post into the database

// if ($result->num_rows > 0) {
//     // output data of each row

//     //echo $upload_dir = wp_upload_dir();
//     echo get_page_by_title('Gdańsk gospodarzem');

//     $i=0; while($row = $result->fetch_assoc()) {
     
//         global $post;
//         $content = str_replace("http://sport.trefl.com/","http://localhost/praca/wp-content/uploads/",$row['Content']);

//         $my_post = array(
//             'post_title'    => wp_strip_all_tags( $row['Title'] ),
//             'post_content'  => $row['Content'],
//             'post_status'   => 'publish',
//             'post_author'   => 1,
//             'post_date'     => $row['PublishDate'],
//             'post_category' => array( 19 )
//         );

//         //echo "id: " . $row["ClassName"]. " - Title: " . $row["Title"]." ".$row["Kategoria"]." ".$row["Zrodlo"]." ".$row["Lead"]." ".$row["Content"]." ".$row["LastEdited"]."<br>";
        
//         //if($row["LastEdited"] > '2017-06-31'):
//         if($row["PublishDate"] > '2017-08-30'):
//             if (!get_page_by_title($row["Title"], 'OBJECT', 'post') ):
                
//                 //echo $i++." id: " . $row["id"]." ".$row["Title"]." ".$row["LastEdited"]."<br>";
//                 $post_id = wp_insert_post( $my_post );
//                 $thumbnail_id = 187;
//                 set_post_thumbnail( $post_id, $thumbnail_id );
//                 echo '<br> dodano post: '.$i++.' id: '.$row['id'];
//             else:
//                 $page = get_page_by_title($row['Title'], OBJECT, 'post');
//                 echo '<br> zaktualizowano post: '.$i++.' id: '.$page->ID;
                
//                 $my_post = array(
//                     'ID'            => $page->ID,
//                     'post_content'  => $row['Content'],
//                     'post_status'   => 'publish',
//                     'post_author'   => 1,
//                     'post_date'     => $row['PublishDate'],
//                     'post_category' => array( 19 )
//                 );
                
//                 if(!get_the_post_thumbnail()):
//                     $thumbnail_id = 187;
//                     set_post_thumbnail( $page->ID, $thumbnail_id );
//                 endif;

//                 //wp_delete_post($page->ID);
//                 wp_update_post( $my_post, true );
    
//                 // if (is_wp_error($post_id)) {
//                 //      $errors = $post_id->get_error_messages();
//                 //      foreach ($errors as $error) {
//                 //          echo $error;
//                 //      }
//                 // }
//             endif; 
//         endif;

//     }
// } else {
//     echo "0 results";
// }
// $conn->close();

?>

    <main class="main">
        <section class="main__news">
            <div class="wrap content">
            
                <div class="main__header">
                    <h2><?php the_title(); ?></h2>
                </div>

                <div class="grid grid--news">
                    <?php
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

                        $args = array(
                            'paged'          => $paged,
                            'posts_per_page' => 12,
                            'post_type'      => 'post',
                            'order'          => 'DESC',
                            // 'taxonomy' => 'category',
                            // 'term'    => 'bez-kategorii',
                            // 'tax_query' => array(
                            //     array(
                            //         'taxonomy' => 'category',
                            //         'field'    => 'slug',
                            //         'terms'    => 'bez-kategorii',
                            //     ),
                            // ),
                        );

                        $custom_query = new WP_Query($args);

                        while($custom_query->have_posts()) : $custom_query->the_post();
                            $thumb_id = get_post_thumbnail_id();
                            $thumb = wp_get_attachment_image_src($thumb_id,'thumbNews', true);
                    ?>

                        <?php get_template_part('post-content'); ?>
                    
                    <?php endwhile; wp_reset_postdata(); ?>
                </div><!-- grid__news -->
                <nav>
                    <?php kriesi_pagination($custom_query->max_num_pages); ?>
                </nav>

            </div>
        </section><!-- main__news -->
    </main>

<?php get_footer(); ?>