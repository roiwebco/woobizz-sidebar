<?php
/**
* Plugin Name: Woobizz Sidebar 
* Plugin URI: https://woobizz.com
* Description: WooCommerce Storefront Sidebar Customiser
* Author: ROIWEB.CO
* Author URI: https://roiweb.co
* Version: 1.0.2
* Text Domain: woobizz-sidebar
* Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizz_sidebar_load_textdomain' );
function woobizz_sidebar_load_textdomain(){load_plugin_textdomain('woobizz-sidebar',false,basename(dirname( __FILE__ )) . '/lang' );}
// Admin Files
define('WOOBIZZSIDEBAR', 'woobizzsidebar');
foreach ( glob( plugin_dir_path( __FILE__ ) . "/admin/*.php" ) as $file ) {include_once $file;}
// Functions Files
define('WOOBIZZSIDEBAR', 'woobizzsidebar');
foreach ( glob( plugin_dir_path( __FILE__ ) . "/admin/functions/*.php" ) as $file ) {include_once $file;}
// Options Files
define('WOOBIZZSIDEBAR', 'woobizzsidebar');
foreach ( glob( plugin_dir_path( __FILE__ ) . "/admin/options/*.php" ) as $file ) {include_once $file;}
// Section Files
foreach ( glob( plugin_dir_path( __FILE__ ) . "/admin/sections/*.php" ) as $file ) {include_once $file;}
// ADD OPTIONS AND SUBMENU
$options_page = new WoobizzSidebarOptions( 'WooBizz Sidebar', 'woobizz-sidebar', WOOBIZZSIDEBAR, 'woobizz', null, 'read', null, true, false, true, $options );