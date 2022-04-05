<?php

/**
 * Plugin Name:     Bafmw_book_exensions
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Add Shortcode Wrapper to WC Shortcode to show Products by user_id
 * Author:          Sebastian Weiss
 * Author URI:      https://lightweb-media.de
 * Text Domain:     bafmw_book_exensions
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Bafmw_book_exensions
 */

// Your code starts here.


function add_author_support_to_products()
{
    add_post_type_support('product', 'author');
}
add_action('init', 'add_author_support_to_products');

add_filter('get_the_author_description', 'do_shortcode');

// function that runs when shortcode is called
function bafmw_book_author_products($atts = array(), $content = null, $tag = '')
{
    if (empty($atts['user_id'])) {
        $author = get_user_by('slug', get_query_var('author_name'));
    } else {
        $author = get_user_by('ID', $atts['user_id']);
    }


    $atts = shortcode_atts(
        array(
            'user_id' => $author->ID,
            'columns' => 3,
            'paginate' => true,
            'limit' => 10
        ),
        $atts,
        $tag
    );

    $args = array(
        'post_type' => 'product',
        'author' => $atts['user_id'],
        'posts_per_page' => -1,
        'limit' => '-1',
        'offset' => 0,
        'fields' => 'ids'

    );
    $product_ids = get_posts($args);
    $atts['ids'] = implode(",", $product_ids);
    $atts['limit'] = 10;
    $o_shortcode_atts = " ";



    foreach ($atts as $key_att => $val_att) {
        if ($key_att != 'user_id') {
            $o_shortcode_atts .= $o_shortcode_atts . " " . $key_att . "=\"" . $val_att . "\" ";
        }
    }
    trim($o_shortcode_atts, " ");

    return '<h2 style="padding-top:1rem;">' . __('Bücher von ', 'bafmw_book_exensions') . $author->display_name . '</h2>' .
        do_shortcode('[products ' . $o_shortcode_atts . ']');
}
// register shortcode
add_shortcode('bafmw_products', 'bafmw_book_author_products');


add_action('TieLabs/after_archive_title', 'lwm_products');

function lwm_products()
{
    echo  do_shortcode('[bafmw_products]');
}
