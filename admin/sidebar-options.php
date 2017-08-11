<?php
// WOOBIZZ SIDEBAR PLUGIN (options.php)
/* 	File Paths
================================================= */
$imgurl = get_stylesheet_directory_uri().'/admin/images/';
//Access the WordPress Pages via an Array
$pages = array();
$pages_obj = get_pages('sort_column=post_parent,menu_order');  
foreach ( $pages_obj as $key ) { 
$pages[$key->ID] = ucwords($key->post_title); 
}
//Access the WordPress Pages via an Array
$tags = array();
$tags_obj = get_tags('orderby=name&hide_empty=false&get=all');
foreach ( $tags_obj as $key ) { 
$tags[$key->term_id ] = ucwords($key->name);
}
//Access the WordPress Categories via an Array
$categories = array();  
$categories_obj = get_categories('hide_empty=0');
foreach ( $categories_obj as $key ) {
$categories[$key->cat_ID] = ucwords($key->cat_name);
}
//---------------------------------------------------------------------------- 
//START GENERAL OPTIONS
//----------------------------------------------------------------------------
$options = array();							
//---------------------------------------------------------------------------- 
//START SIDEBAR SECTION
//----------------------------------------------------------------------------
$options[] = array( "name" => __('1- Sidebar Options ','woobizz-sidebar'),
				"type" => "section");
$options[] = array("type" => "divider");
$options[] = array( "name" => __('1 Sidebar Options','woobizz-sidebar'),
				"type" => "title",
				"class" => "medium first",
				"desc" => __("", "woobizz-sidebar"));

$options[] = array("type" => "divider");
$options[] = array( "name" => "1.1 SIDEBAR POSITION & SIZE", 
		"type" => "html",
		 "std" => "");
$options[] = array("type" => "divider");		 
//Widget Position
$options[] = array( "name" => __("Sidebar Position","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_display",
		"class" => "short first",
		"std" => 0,
		"type" => "radio",
		"options" => array(
			0 => "Right Side",
			1 => "Left Side",
			
			));	
//Sidebar Widget Size			
$options[] = array( "name" => __("Sidebar Width","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_sidebarsidebarsize",
		"class" => "short",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "%",
		"increment" => 1,
		"type" => "number");	
//Sidebar Widget Size			
$options[] = array( "name" => __("Page Width","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_pagecontentsize",
		"class" => "short last",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "%",
		"increment" => 1,
		"type" => "number");		
			
$options[] = array("type" => "divider");
$options[] = array( "name" => "1.2 SIDEBAR BACKGROUND", 
		"type" => "html",
		 "std" => "");
$options[] = array("type" => "divider");	
 
//Bakground Image 
$options[] = array( "name" => __("Background Image","woobizz-sidebar"),
		"desc" => __("Note: Image will always override color", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_backgroundimage",
		"class" => "medium first",
		"std" => null,
		"type" => "upload");
//Background Color 
$options[] = array( "name" => __("Background Color","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_backgroundcolor",
		"class" => "medium last",
		"std" => '#2c2d33',
		"type" => "color");	
//Background Size
$options[] = array( "name" => __("Background Size","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_backgroundsize",
		"class" => "short first",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Contain",
			1 => "Cover",
			2 => "Inherit",
			3 => "Initial",
			));
$options[] = array( "name" => __("Background Position","woobizz-sidebar"), 
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_backgroundposition",
		"class" => "short",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Left Top",
			1 => "Left Center",
			2 => "Left Bottom",
			3 => "Right Top",
			4 => "Right Center",
			5 => "Right Bottom",
			6 => "Center Top",
			7 => "Center Center",
			8 => "Center Bottom",
			9 => "Inherit",
			10=> "Initial",
		));	
//Background repeat 
$options[] = array( "name" => __("Background Repeat","woobizz-sidebar"),
		"desc" => __("X = Horizontal Y= Vertical", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_backgroundrepeat",
		"class" => "short last",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "No-Repeat",
			1 => "Repeat X & Y",
			2 => "Repeat X Only",
			3 => "Repeat Y Only",
			4 => "Repeat Round",
			5 => "Repeat Space",
			4 => "Inherit",
			5 => "Initial",
		));	
$options[] = array("type" => "divider");			
$options[] = array( "name" => "1.3 SIDEBAR GRADIENTS", 
		"type" => "html",
		 "std" => "");	
$options[] = array("type" => "divider");				 
$options[] = array( "name" => __("Gradient Color 1","woobizz-sidebar"), 
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_backgroundgradient1",
		"class" => "medium first",
		"std" => '#2c2d33',
		"type" => "color");
//Gradient1 Opacity
$options[] = array( "name" => __("Gradient Opacity 1","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_backgroundgradient1opacity",
		"class" => "medium last",
		"std" => 0,
		"min" => 0,
		"max" => 1,
		"suffix" => "",
		"increment" => 0.01,
		"type" => "number");
$options[] = array( "name" => __("Gradient Color 2","woobizz-sidebar"), 
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_backgroundgradient2",
		"class" => "medium first",
		"std" => '#2c2d33',
		"type" => "color");
//Gradient 2 Opacity
$options[] = array( "name" => __("Gradient Opacity 2","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_backgroundgradient2opacity",
		"class" => "medium last",
		"std" => 0,
		"min" => 0,
		"max" => 1,
		"suffix" => "",
		"increment" => 0.01,
		"type" => "number");	
//2.3 Page Box Shadow 
$options[] = array("type" => "divider");
$options[] = array( "name" => "1.4 SIDEBAR SHADOWS",
		"type" => "html",
		"std" => "");
$options[] = array("type" => "divider");
$options[] = array( "name" => __("Apply Shadow?","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_shadowapply",
		"class" => "short first",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Yes",
			1 => "Non",
			));
$options[] = array( "name" => __("Shadow Color","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_shadowcolor",
		"class" => "short",
		"std" => '#2c2d33',
		"type" => "color");
$options[] = array( "name" => __("Shadow Right","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_shadowrightdistance",
		"class" => "short last",
		"std" => 0,
		"min" => -200,
		"max" => 200,
		"suffix" => "px",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Shadow Bottom","woobizz-sidebar"),
			"desc" => __("", "woobizz-sidebar"),
			"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_shadowbottomdistance",
			"class" => "short first",
			"std" => 0,
			"min" => -200,
			"max" => 200,
			"suffix" => "px",
			"increment" => 1,
			"type" => "number");
$options[] = array( "name" => __("Shadow Spread","woobizz-sidebar"),
			"desc" => __("", "woobizz-sidebar"),
			"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_shadowspread",
			"class" => "short",
			"std" => 0,
			"min" => 0,
			"max" => 200,
			"suffix" => "px",
			"increment" => 1,
			"type" => "number");
$options[] = array( "name" => __("Shadow Size","woobizz-sidebar"),
			"desc" => __("", "woobizz-sidebar"),
			"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_shadowsize",
			"class" => "short last",
			"std" => 0,
			"min" => 0,
			"max" => 200,
			"suffix" => "px",
			"increment" => 1,
			"type" => "number");
$options[] = array("type" => "divider");
$options[] = array( "name" => "1.5 SIDEBAR BORDER",
		"type" => "html",
		"std" => "");
$options[] = array("type" => "divider");							
$options[] = array( "name" => __("Border Size","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_bordersize",
		"class" => "tiny first",
		"std" => 0,
		"min" => 0,
		"max" => 50,
		"suffix" => "px",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Border Style","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_borderstyle",
		"class" => "tiny ",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "dotted",
			1 => "dashed",
			2 => "solid",
			3 => "none",
			));			
$options[] = array( "name" => __("Border Color","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_bordercolor",
		"class" => "tiny",
		"std" => '#2c2d33',
		"type" => "color");	
$options[] = array( "name" => __("Border Radius","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_borderradius",
		"class" => "tiny last",
		"std" => 0,
		"min" => 0,
		"max" => 50,
		"suffix" => "px",
		"increment" => 1,
		"type" => "number");				
// 1.2 MARGINGS 
$options[] = array("type" => "divider");
$options[] = array( "name" => "1.6 SIDEBAR MARGINS",
		"type" => "html",
		 "std" => "Top & Bottom only left and right will be apply on the responsive option");
$options[] = array("type" => "divider");
$options[] = array( "name" => __("Margin Top","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_margintopsize",
		"class" => "tiny first",
		"std" => 42,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Top","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_marginunittop",
		"class" => "tiny",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));
$options[] = array( "name" => __("Margin Bottom","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_marginbottomsize",
		"class" => "tiny",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Bottom","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_marginunitbottom",
		"class" => "tiny last",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));
// 1.2 PADDINGS 
$options[] = array("type" => "divider");
$options[] = array( "name" => "1.7 SIDEBAR PADDINGS",
		"type" => "html",
		 "std" => "");
$options[] = array("type" => "divider");
$options[] = array( "name" => __("Padding Top","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_paddingtopsize",
		"class" => "tiny first",
		"std" => 42,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Top","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_paddingunittop",
		"class" => "tiny",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));
$options[] = array( "name" => __("Padding Right","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_paddingrightsize",
		"class" => "tiny",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Right","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_paddingunitright",
		"class" => "tiny last",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));
$options[] = array( "name" => __("Padding Bottom","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_paddingbottomsize",
		"class" => "tiny first",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Bottom","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_paddingunitbottom",
		"class" => "tiny",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));
$options[] = array( "name" => __("Padding Left","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_paddingleftsize",
		"class" => "tiny",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Left","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_paddingunitleft",
		"class" => "tiny last",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));
$options[] = array("type" => "divider");
//---------------------------------------------------------------------------- 
//END SIDEBAR OPTIONS
//----------------------------------------------------------------------------

//---------------------------------------------------------------------------- 
//START SIDEBAR TITLE
//----------------------------------------------------------------------------
$options[] = array( "name" => "1.8 SIDEBAR TITLE", 
		"type" => "html",
		 "std" => "");
$options[] = array("type" => "divider");
//Hide Title
$options[] = array( "name" => __("Hide Title?","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlehide",
		"class" => "tiny first",
		"std" => 0,
		"type" => "radio",
		"options" => array(
			0 => "Yes",
			1 => "Non",
			));	
//Title Size			
$options[] = array( "name" => __("Title Size","woobizz-sidebar"), 
				"desc" => __("", "woobizz-sidebar"),
				"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlesize",
				"class" => "tiny",
				"std" => 18,
				"min" => 0,
				"max" => 100,
				"suffix" => "px",
				"increment" => 1,
				"type" => "number");			
//Title Color
$options[] = array( "name" => __("Title Color","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlecolor",
		"class" => "tiny",
		"std" => '#2c2d33',
		"type" => "color");	
//Title Weight		
$options[] = array( "name" => __("Title Weight","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titleweight",
		"class" => "tiny",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "100",
			1 => "200",
			2 => "300",
			3 => "400",
			4 => "500",
			5 => "600",
			6 => "700",			
			));
//Title paddings
$options[] = array( "name" => __("Padding Top","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlepaddingtopsize",
		"class" => "tiny first",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Top","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlepaddingunittop",
		"class" => "tiny",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));
$options[] = array( "name" => __("Padding Right","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlepaddingrightsize",
		"class" => "tiny",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Right","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlepaddingunitright",
		"class" => "tiny last",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));
$options[] = array( "name" => __("Padding Bottom","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlepaddingbottomsize",
		"class" => "tiny first",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Bottom","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlepaddingunitbottom",
		"class" => "tiny",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));
$options[] = array( "name" => __("Padding Left","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlepaddingleftsize",
		"class" => "tiny",
		"std" => 0,
		"min" => 0,
		"max" => 100,
		"suffix" => "",
		"increment" => 1,
		"type" => "number");
$options[] = array( "name" => __("Units Left","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_woobizz_sidebar_titlepaddingunitleft",
		"class" => "tiny last",
		"std" => 0,
		"type" => "select",
		"options" => array(
			0 => "Pixels (px)",
			1 => "Percent (%)",
			2 => "Ems” (em)",
			3 => "Points (pt)",));			
//---------------------------------------------------------------------------- 
//END SIDEBAR TITLE
//----------------------------------------------------------------------------	

//---------------------------------------------------------------------------- 
//START BACKUP & IMPORT
//----------------------------------------------------------------------------
$options[] = array( "name" => __('Back-up & Reset','woobizz-sidebar'),
				"type" => "section");
// Backup Field		
$options[] = array("type" => "divider");
$options[] = array( "name" => __('Back-up & Reset','woobizz-sidebar'),
				"type" => "title",
				"class" => "medium first",
				"desc" => __("", "woobizz-sidebar"));
$options[] = array("type" => "divider");			
$options[] = array( "name" => __("Back-up","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"id" => WOOBIZZSIDEBAR."_textarea",
		"class" => "first",
		"type" => "backup");
// Reset	
$options[] = array( "name" => __("Reset all options","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"class" => "first",
		"type" => "reset");	
//Export	
$options[] = array( "name" => __('Import & Export','woobizz-sidebar'),
				"type" => "section");
$options[] = array("type" => "divider");
$options[] = array( "name" => __('Import & Export','woobizz-sidebar'),
				"type" => "title",
				"class" => "medium first",
				"desc" => __("", "woobizz-sidebar"));
$options[] = array("type" => "divider");						
$options[] = array( "name" => __("Export Options","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"class" => "first",
		"type" => "export");			
// Import Field					
$options[] = array( "name" => __("Import Options","woobizz-sidebar"),
		"desc" => __("", "woobizz-sidebar"),
		"class" => "first",
		"placeholder" => "Paste your export code here",
		"type" => "import");
//---------------------------------------------------------------------------- 
//END BACKUP & IMPORT
//----------------------------------------------------------------------------		
?>