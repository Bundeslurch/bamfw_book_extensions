<?php
/**
 * Plugin Name:     Bafmw_book_exensions
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     bafmw_book_exensions
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Bafmw_book_exensions
 */

// Your code starts here.


function add_author_support_to_products() {
    add_post_type_support( 'product', 'author' ); 
 }
 add_action( 'init', 'add_author_support_to_products' );

 add_filter( 'get_the_author_description', 'do_shortcode');

// function that runs when shortcode is called
function bafmw_book_author_products($atts = array(), $content = null, $tag = '' ) { 
    if (is_author()){
    //    $user_name =   
        $author = get_user_by( 'slug', get_query_var( 'author_name' ) );

    }
    $atts = shortcode_atts(
        array(
        'user_id' => $author->ID
        ), $atts, $tag
    );
	$args = array(
        'post_type' => 'product',
        'author' => $author->ID,
        'posts_per_page' => 9,

        'offset' => 0,
        'fields' => 'ids',
        'meta_query'=>array(

            array(

         'key'=>'_thumbnail_id',

              'compare' => 'EXISTS'

                            )

                    )
    );
    $product_ids = get_posts($args );    
return do_shortcode('[products ids="'.implode(",",$product_ids).'"]');
}
// register shortcode
add_shortcode('bafmw_products', 'bafmw_book_author_products');