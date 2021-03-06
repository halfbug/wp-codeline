<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
//
// Your code goes below
//

function create_post_type() {
  register_post_type( 'sadaf_films',
    array(
      'labels' => array(
        'name' => __( 'Films' ),
        'singular_name' => __( 'Film' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports' => array( 'title', 'editor', 'custom-fields','thumbnail' ),
    )
  );
}
add_action( 'init', 'create_post_type' );

function themes_taxonomy() {  
    register_taxonomy(  
        'country',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'sadaf_films',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Country',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'country', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );  
}  
add_action( 'init', 'themes_taxonomy');

function themes_taxonomy_genre() {  
    register_taxonomy(  
        'genre',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'sadaf_films',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Genre',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'genre', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );  
}  
add_action( 'init', 'themes_taxonomy_genre');

function themes_taxonomy_year() {  
    register_taxonomy(  
        'year',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'sadaf_films',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Year',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'year', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );  
}  
add_action( 'init', 'themes_taxonomy_year');

function themes_taxonomy_actors() {  
    register_taxonomy(  
        'actors',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'sadaf_films',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Actors',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'actors', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );  
}  
add_action( 'init', 'themes_taxonomy_actors');

$set = get_option( 'post_type_rules_flased_mycpt' );
if ( $set !== true ){
    flush_rewrite_rules( false );
    update_option( 'post_type_rules_flased_mycpt', true );
}
// Function to show last 5 films  at right sidebar under search field.

  function last_five_films() {
  
	$posts = get_posts([
  'post_type' => 'sadaf_films',
  'post_status' => 'publish',
  'numberposts' => 5,
  'order'    => 'DESC'
   ]);
   
   //print_r($posts);
   //echo "<h3 class=\"widget-title\">Last Five Films</h3>";
   //echo "<ul>";
   $strig="";
   foreach ($posts as $post){
		$string=$string. '<li><a href="'.$post->guid.'">'.$post->post_title.'</a></li>';
   
   }
    return $string;
}
add_shortcode('last5films', 'last_five_films');

