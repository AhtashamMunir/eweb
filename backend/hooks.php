<?php

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Admin menu hook 
 * 
*/
add_action( 'admin_menu', 'eweb_menu_hooker' );

/**
 * @Shortcode to display results 
 *
*/
add_shortcode('EWEB', 'eweb_shortcode'); 