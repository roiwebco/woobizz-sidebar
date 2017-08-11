<?php
/**
 Plugin Name: Woobizz Sidebar
Plugin URI: http://woobizz.com
Description: Woobizz sidebar customiser
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizz-sidebar
Domain Path: /lang/
 */
 //Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizz_sidebar_load_textdomain' );
function woobizz_sidebar_load_textdomain() {
  load_plugin_textdomain( 'woobizz-sidebar', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
} 
/** The prefix Name*/
define('WOOBIZZSIDEBAR', 'woobizzsidebar');

/** Include the Whitelabel plugin */
include('admin/sidebar-admin-page.php' );
	
/** Include the $options array */
include( 'admin/sidebar-options.php' );

/** Include all sections php files */
foreach ( glob( plugin_dir_path( __FILE__ ) . "/admin/sections/*.php" ) as $file ) {
    include_once $file;
}
/** Create the Options Page */
$options_page = new WoobizzSidebarOptions( 'WooBizz Sidebar', 'woobizz-sidebar', WOOBIZZSIDEBAR, 'admin.php', null, 'read', null, true, false, true, $options );
function woobizz_sidebar_submenu(){
	//add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page( 'woobizz', '', 'Woobizz Sidebar','manage_options', 'woobizz-sidebar');
}
add_action( 'admin_menu', 'woobizz_sidebar_submenu',40);