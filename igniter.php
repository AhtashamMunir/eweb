<?php
/**
 * Plugin Name:       Embed Website
 * Description:       Embed Website is a WordPress plugin that allows you to embed any other website to your WordPress pages via shortcode.
 * Author:            Ahtasham Munir
 * Author URI:        https://ahtashammunir.github.io/portfolio/
 * Version:           1.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       eweb
 * 
 * 
*/

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

define( "EWEBPATH", dirname( __FILE__ ) );

// define('ALTERNATE_WP_CRON', true);

include_once( EWEBPATH.'/autoload.php' );