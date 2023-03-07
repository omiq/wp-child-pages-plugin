<?php
/*
Plugin Name: Show Page Children
Plugin URI:  https://github.com/omiq
Description: Shortcode to show child pages of a page
Version:     1.0.0
Author:      Chris Garrett
Author URI:  https://www.chrisg.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

function list_child_pages() {

    global $post;

    $args = array(
        'post_type'   => 'page',
        'post_status' => 'publish',
        'parent' => $post->ID,
        'sort_column' => 'menu_order',
        'hierarchical' => 0
    );

    $children = get_pages($args);

    $result = "<ul class='child_pages'>";
    foreach ( $children as $child )
    {
        $child_id = $child->ID;
        $url  = get_permalink( $child_id );
        $thumb = get_the_post_thumbnail($child_id, array(500, 500));
        $title= $child->post_title;

        $link = "<a href='$url'><div class='child_page_thumb'>$thumb</div><div class='child_page_title'>$title</div></a>";

        $result .= "<li>$link</li>";
    }

    $result .= "</ul>";

    return $result;

}

add_shortcode('list_childpages', 'list_child_pages');
