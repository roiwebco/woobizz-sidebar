<?php
//RENAME SIDEBAR ON WIDGET PAGE ONLY
if (!function_exists( 'woobizz_rename_sidebar_plugin' ) ) {
	function woobizz_rename_sidebar_plugin( $translated ) {
		if (strpos($_SERVER['REQUEST_URI'], "widgets.php") !== false){
			add_filter(  'gettext',  'woobizz_rename_sidebar_plugin'  );
			add_filter(  'ngettext',  'woobizz_rename_sidebar_plugin'  );
			$words = array('Sidebar' => 'Woobizz Sidebar',);
			$translated = str_ireplace(  array_keys($words),  $words,  $translated );
			return $translated; 
		}else{
		 //do nothing
		}
	}
	woobizz_rename_sidebar_plugin( $translated );
}

//ADD SIDEBAR MENU
if (!function_exists( 'woobizz_main_menu' ) ) {
		//echo "function no existe";
		function woobizz_main_menu() {
		//add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
		add_menu_page('Woobizz', 'Woobizz', 'manage_options', 'woobizz','woobizz_main_menu','',0);
		}
	add_action( 'admin_menu', 'woobizz_main_menu' );
}
add_action( 'admin_menu', 'woobizz_main_menu' );

//HIDE ALL WP NOTICES ON SIDEBAR PAGE
if (!function_exists( 'woobizz_hide_sidebar_notices' ) ) {
	function woobizz_hide_sidebar_notices() {
		if (strpos($_SERVER['REQUEST_URI'], "woobizz-sidebar") !== false){
			echo"<style>.notice{display:none;}#tab-list:before{content:'WooBizz Sidebar';text-transform: uppercase;margin:18px 18px 18px 18px;display:inherit;}</style>";
		}else{
		 //do nothing
		}
	}
	add_action ('in_admin_header','woobizz_hide_sidebar_notices');
}