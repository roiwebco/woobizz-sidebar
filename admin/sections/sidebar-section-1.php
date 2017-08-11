<?php
//----------------------------------------------------------------------------
//WOOBIZZ SIDEBAR SECTION 1
//----------------------------------------------------------------------------
function woobizz_check_if_sidebar1_is_active(){

	if (is_active_sidebar('sidebar-1')){
		//---------------------------------------------------------------------------- 
		//START HEX TO RGB FUNCTION
		//----------------------------------------------------------------------------
		function woobizz_sidebar_hextorgb($hex){
			$hex = str_replace("#", "", $hex);
		if(strlen($hex) == 3){
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		}else{
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); 
		}
		//---------------------------------------------------------------------------- 
		//END HEX TO RGB FUNCTION
		//----------------------------------------------------------------------------
		//---------------------------------------------------------------------------- 
		//START ALL CSS OPTIONS FUNCTION
		//----------------------------------------------------------------------------
		function woobizz_sidebar_allcssoptions(){
		//----------------------------------------------------------------------------	
		//START GENERAL SETTINGS
		//----------------------------------------------------------------------------
		$woobizz_sidebar_display= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_display');
			if ($woobizz_sidebar_display==0){
				//Display widget left sidebar
			} elseif($woobizz_sidebar_display==1) {
				//Display widget left sidebar
				$woobizz_sidebar_display_float_content="right";
				$woobizz_sidebar_display_margin_content=0;
				$woobizz_sidebar_display_float_widget="left";
				$woobizz_sidebar_display_margin_widget=0;
			} else {
				//Default right sidebar
			}
		$woobizz_sidebar_sidebarsidebarsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_sidebarsidebarsize');
		$woobizz_sidebar_pagecontentsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_pagecontentsize');
		//----------------------------------------------------------------------------	
		//END GENERAL SETTINGS
		//----------------------------------------------------------------------------	
		//START BACKGROUND
		$woobizz_sidebar_backgroundimage= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_backgroundimage');
		$woobizz_sidebar_backgroundcolor= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_backgroundcolor');
		$woobizz_sidebar_backgroundsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_backgroundsize');
		if ($woobizz_sidebar_backgroundsize==0){
				$woobizz_sidebar_backgroundsize="contain";
			} elseif($woobizz_sidebar_backgroundsize==1) {
				$woobizz_sidebar_backgroundsize="cover";
			} elseif($woobizz_sidebar_backgroundsize==2) {
				$woobizz_sidebar_backgroundsize="inherit";
			} elseif($woobizz_sidebar_backgroundsize==3) {
				$woobizz_sidebar_backgroundsize="initial";
			} else {
				$woobizz_sidebar_backgroundsize="initial";
		}
		$woobizz_sidebar_backgroundrepeat= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_backgroundrepeat');
		if ($woobizz_sidebar_backgroundrepeat==0){
				$woobizz_sidebar_backgroundrepeat="no-repeat";
			} elseif($woobizz_sidebar_backgroundrepeat==1) {
				$woobizz_sidebar_backgroundrepeat="repeat";
			} elseif($woobizz_sidebar_backgroundrepeat==2) {
				$woobizz_sidebar_backgroundrepeat="repeat-x";
			} elseif($woobizz_sidebar_backgroundrepeat==3) {
				$woobizz_sidebar_backgroundrepeat="repeat-y";
			} elseif($woobizz_sidebar_backgroundrepeat==4) {
				$woobizz_sidebar_backgroundrepeat="round";
			} elseif($woobizz_sidebar_backgroundrepeat==5) {
				$woobizz_sidebar_backgroundrepeat="space";
			} elseif($woobizz_sidebar_backgroundrepeat==6) {
				$woobizz_sidebar_backgroundrepeat="inherit";
			} elseif($woobizz_sidebar_backgroundrepeat==5) {
				$woobizz_sidebar_backgroundrepeat="initial";
			} else {
				$woobizz_sidebar_backgroundrepeat="initial";
		}
		$woobizz_sidebar_backgroundposition= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_backgroundposition');
		if ($woobizz_sidebar_backgroundposition==0){
				$woobizz_sidebar_backgroundposition="left top";
			} elseif($woobizz_sidebar_backgroundposition==1) {
				$woobizz_sidebar_backgroundposition="left center";
			} elseif($woobizz_sidebar_backgroundposition==2) {
				$woobizz_sidebar_backgroundposition="left bottom";
			} elseif($woobizz_sidebar_backgroundposition==3) {
				$woobizz_sidebar_backgroundposition="right top";
			} elseif($woobizz_sidebar_backgroundposition==4) {
				$woobizz_sidebar_backgroundposition="right center";
			} elseif($woobizz_sidebar_backgroundposition==5) {
				$woobizz_sidebar_backgroundposition="right bottom";
			} elseif($woobizz_sidebar_backgroundposition==6) {
				$woobizz_sidebar_backgroundposition="center top";
			} elseif($woobizz_sidebar_backgroundposition==7) {
				$woobizz_sidebar_backgroundposition="center center";
			} elseif($woobizz_sidebar_backgroundposition==8) {
				$woobizz_sidebar_backgroundposition="center bottom";
			} elseif($woobizz_sidebar_backgroundposition==9) {
				$woobizz_sidebar_backgroundposition="initial";
			} elseif($woobizz_sidebar_backgroundposition==10) {
				$woobizz_sidebar_backgroundposition="initial";
			} else {
				$woobizz_sidebar_backgroundposition="initial";
		}
		//----------------------------------------------------------------------------
		//END BACKGROUND
		//----------------------------------------------------------------------------
		//----------------------------------------------------------------------------
		//START GRADIENTS
		//----------------------------------------------------------------------------
		$woobizz_sidebar_backgroundgradient1= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_backgroundgradient1');
		$woobizz_sidebar_backgroundgradient1opacity= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_backgroundgradient1opacity');
		$trasnform_woobizz_sidebar_backgroundgradient1=woobizz_sidebar_hextorgb($woobizz_sidebar_backgroundgradient1);
		$woobizz_sidebar_backgroundfullgradient1=$trasnform_woobizz_sidebar_backgroundgradient1.",".$woobizz_sidebar_backgroundgradient1opacity;
		$woobizz_sidebar_backgroundgradient2= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_backgroundgradient2');
		$woobizz_sidebar_backgroundgradient2opacity= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_backgroundgradient2opacity');
		$trasnform_woobizz_sidebar_backgroundgradient2=woobizz_sidebar_hextorgb($woobizz_sidebar_backgroundgradient2);
		$woobizz_sidebar_backgroundfullgradient2=$trasnform_woobizz_sidebar_backgroundgradient2.",".$woobizz_sidebar_backgroundgradient2opacity;
		//----------------------------------------------------------------------------
		//END GRADIENTS
		//----------------------------------------------------------------------------
		//----------------------------------------------------------------------------
		//START SHADOWS
		//----------------------------------------------------------------------------
		$woobizz_sidebar_shadowcolor= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_shadowcolor');
		$woobizz_sidebar_shadowrightdistance= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_shadowrightdistance');
		$woobizz_sidebar_shadowbottomdistance= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_shadowbottomdistance');
		$woobizz_sidebar_shadowspread= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_shadowspread');
		$woobizz_sidebar_shadowsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_shadowsize');
		$woobizz_sidebar_shadowapply= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_shadowapply');
		if ($woobizz_sidebar_shadowapply==0){
				$woobizz_sidebar_shadowfull=$woobizz_sidebar_shadowrightdistance."px "
													.$woobizz_sidebar_shadowbottomdistance."px "
													.$woobizz_sidebar_shadowspread."px "
													.$woobizz_sidebar_shadowsize."px "
													.$woobizz_sidebar_shadowcolor;
			} elseif($woobizz_sidebar_shadowapply==1) {
				$woobizz_sidebar_shadowfull="none";
			} else {
				$woobizz_sidebar_shadowfull="none";
		} 
		//----------------------------------------------------------------------------
		//END SHADOW
		//----------------------------------------------------------------------------
		//----------------------------------------------------------------------------
		//START BORDER
		//----------------------------------------------------------------------------
		$woobizz_sidebar_bordersize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_bordersize');
		$woobizz_sidebar_bordercolor= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_bordercolor');
		$woobizz_sidebar_borderstyle= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_borderstyle');
		if ($woobizz_sidebar_borderstyle==0){
				$woobizz_sidebar_borderstyle="dotted";
			} elseif($woobizz_sidebar_borderstyle==1) {
				$woobizz_sidebar_borderstyle="dashed";
			} elseif($woobizz_sidebar_borderstyle==2) {
				$woobizz_sidebar_borderstyle="solid";
			} elseif($woobizz_sidebar_borderstyle==3) {
				$woobizz_sidebar_borderstyle="none";
			} else {$woobizz_sidebar_borderstyle="none";
		}
		$woobizz_sidebar_borderradius= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_borderradius'); 
		$woobizz_sidebar_borderfull=$woobizz_sidebar_bordersize."px "
										.$woobizz_sidebar_borderstyle." "
										.$woobizz_sidebar_bordercolor." ";
		//----------------------------------------------------------------------------
		//END BORDER
		//----------------------------------------------------------------------------
		//---------------------------------------------------------------------------- 
		//START MARGINS
		//----------------------------------------------------------------------------
		//Padding Top
		$woobizz_sidebar_margintopsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_margintopsize');
		$woobizz_sidebar_marginunittop= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_marginunittop');
		if ($woobizz_sidebar_marginunittop==0){
			$woobizz_sidebar_marginunittop="px";
		} elseif($woobizz_sidebar_marginunittop==1) {
			$woobizz_sidebar_marginunittop="%";
		} elseif($woobizz_sidebar_marginunittop==2) {
			$woobizz_sidebar_marginunittop="em";
		} elseif($woobizz_sidebar_marginunittop==3) {
			$woobizz_sidebar_marginunittop="pt";
		} else {
			$woobizz_sidebar_marginunittop="initial";
		} 
		//Padding Right
		$woobizz_sidebar_marginrightsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_marginrightsize');
		$woobizz_sidebar_marginunitright= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_marginunitright');
		if ($woobizz_sidebar_marginunitright==0){
			$woobizz_sidebar_marginunitright="px";
		} elseif($woobizz_sidebar_marginunitright==1) {
			$woobizz_sidebar_marginunitright="%";
		} elseif($woobizz_sidebar_marginunitright==2) {
			$woobizz_sidebar_marginunitright="em";
		} elseif($woobizz_sidebar_marginunitright==3) {
			$woobizz_sidebar_marginunitright="pt";
		} else {
			$woobizz_sidebar_marginunitright="initial";
		}	
		//Padding Bottom
		$woobizz_sidebar_marginbottomsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_marginbottomsize');
		$woobizz_sidebar_marginunitbottom= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_marginunitbottom');
		if ($woobizz_sidebar_marginunitbottom==0){
			$woobizz_sidebar_marginunitbottom="px";
		} elseif($woobizz_sidebar_marginunitbottom==1) {
			$woobizz_sidebar_marginunitbottom="%";
		} elseif($woobizz_sidebar_marginunitbottom==2) {
			$woobizz_sidebar_marginunitbottom="em";
		} elseif($woobizz_sidebar_marginunitbottom==3) {
			$woobizz_sidebar_marginunitbottom="pt";
		} else {
			$woobizz_sidebar_marginunitbottom="initial";
		}	
		//Padding Left
		$woobizz_sidebar_marginleftsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_marginleftsize');
		$woobizz_sidebar_marginunitleft= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_marginunitleft');
		if ($woobizz_sidebar_marginunitleft==0){
			$woobizz_sidebar_marginunitleft="px";
		} elseif($woobizz_sidebar_marginunitleft==1) {
			$woobizz_sidebar_marginunitleft="%";
		} elseif($woobizz_sidebar_marginunitleft==2) {
			$woobizz_sidebar_marginunitleft="em";
		} elseif($woobizz_sidebar_marginunitleft==3) {
			$woobizz_sidebar_marginunitleft="pt";
		} else {
			$woobizz_sidebar_marginunitleft="initial";
		}
		$woobizz_sidebar_marginfull=$woobizz_sidebar_margintopsize.$woobizz_sidebar_marginunittop." "
									   .$woobizz_sidebar_marginrightsize.$woobizz_sidebar_marginunitright." "
									   .$woobizz_sidebar_marginbottomsize.$woobizz_sidebar_marginunitbottom." "
									   .$woobizz_sidebar_marginleftsize.$woobizz_sidebar_marginunitleft." ";							   	
		//---------------------------------------------------------------------------- 
		//END MARGIN
		//----------------------------------------------------------------------------
		//---------------------------------------------------------------------------- 
		//START PADDING
		//----------------------------------------------------------------------------
		//Padding Top
		$woobizz_sidebar_paddingtopsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_paddingtopsize');
		$woobizz_sidebar_paddingunittop= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_paddingunittop');
		if ($woobizz_sidebar_paddingunittop==0){
			$woobizz_sidebar_paddingunittop="px";
		} elseif($woobizz_sidebar_paddingunittop==1) {
			$woobizz_sidebar_paddingunittop="%";
		} elseif($woobizz_sidebar_paddingunittop==2) {
			$woobizz_sidebar_paddingunittop="em";
		} elseif($woobizz_sidebar_paddingunittop==3) {
			$woobizz_sidebar_paddingunittop="pt";
		} else {
			$woobizz_sidebar_paddingunittop="initial";
		} 
		//Padding Right
		$woobizz_sidebar_paddingrightsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_paddingrightsize');
		$woobizz_sidebar_paddingunitright= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_paddingunitright');
		if ($woobizz_sidebar_paddingunitright==0){
			$woobizz_sidebar_paddingunitright="px";
		} elseif($woobizz_sidebar_paddingunitright==1) {
			$woobizz_sidebar_paddingunitright="%";
		} elseif($woobizz_sidebar_paddingunitright==2) {
			$woobizz_sidebar_paddingunitright="em";
		} elseif($woobizz_sidebar_paddingunitright==3) {
			$woobizz_sidebar_paddingunitright="pt";
		} else {
			$woobizz_sidebar_paddingunitright="initial";
		}	
		//Padding Bottom
		$woobizz_sidebar_paddingbottomsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_paddingbottomsize');
		$woobizz_sidebar_paddingunitbottom= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_paddingunitbottom');
		if ($woobizz_sidebar_paddingunitbottom==0){
			$woobizz_sidebar_paddingunitbottom="px";
		} elseif($woobizz_sidebar_paddingunitbottom==1) {
			$woobizz_sidebar_paddingunitbottom="%";
		} elseif($woobizz_sidebar_paddingunitbottom==2) {
			$woobizz_sidebar_paddingunitbottom="em";
		} elseif($woobizz_sidebar_paddingunitbottom==3) {
			$woobizz_sidebar_paddingunitbottom="pt";
		} else {
			$woobizz_sidebar_paddingunitbottom="initial";
		}	
		//Padding Left
		$woobizz_sidebar_paddingleftsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_paddingleftsize');
		$woobizz_sidebar_paddingunitleft= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_paddingunitleft');
		if ($woobizz_sidebar_paddingunitleft==0){
			$woobizz_sidebar_paddingunitleft="px";
		} elseif($woobizz_sidebar_paddingunitleft==1) {
			$woobizz_sidebar_paddingunitleft="%";
		} elseif($woobizz_sidebar_paddingunitleft==2) {
			$woobizz_sidebar_paddingunitleft="em";
		} elseif($woobizz_sidebar_paddingunitleft==3) {
			$woobizz_sidebar_paddingunitleft="pt";
		} else {
			$woobizz_sidebar_paddingunitleft="initial";
		}
		$woobizz_sidebar_paddingfull=$woobizz_sidebar_paddingtopsize.$woobizz_sidebar_paddingunittop." "
									   .$woobizz_sidebar_paddingrightsize.$woobizz_sidebar_paddingunitright." "
									   .$woobizz_sidebar_paddingbottomsize.$woobizz_sidebar_paddingunitbottom." "
									   .$woobizz_sidebar_paddingleftsize.$woobizz_sidebar_paddingunitleft." ";							   	
		//---------------------------------------------------------------------------- 
		//END PADDING
		//----------------------------------------------------------------------------
		//---------------------------------------------------------------------------- 
		//START SIDEBAR SIDEBAR TITLE
		//----------------------------------------------------------------------------
		//Hide Title?
		$woobizz_sidebar_titlehide=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlehide');
		if ($woobizz_sidebar_titlehide==0){
			$woobizz_sidebar_titlehide="none";
		} elseif($woobizz_sidebar_titlehide==1) {
			$woobizz_sidebar_titlehide="inherit";
		} else {
			$woobizz_sidebar_titlehide="inherit";
		}
		//Title Size
		$woobizz_sidebar_titlesize=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlesize');
		//Title Color
		$woobizz_sidebar_titlecolor=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlecolor');
		//Title Weight
		$woobizz_sidebar_titleweight=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titleweight');
		if ($woobizz_sidebar_titleweight==0){
				$woobizz_sidebar_titleweight="100";
			} elseif($woobizz_sidebar_titleweight==1) {
				$woobizz_sidebar_titleweight="200";
			} elseif($woobizz_sidebar_titleweight==2) {
				$woobizz_sidebar_titleweight="300";
			} elseif($woobizz_sidebar_titleweight==3) {
				$woobizz_sidebar_titleweight="400";
			} elseif($woobizz_sidebar_titleweight==4) {
				$woobizz_sidebar_titleweight="500";
			} elseif($woobizz_sidebar_titleweight==5) {
				$woobizz_sidebar_titleweight="600";
			} elseif($woobizz_sidebar_titleweight==6) {
				$woobizz_sidebar_titleweight="700";
			} else {
				$woobizz_sidebar_titleweight="400";
			}
		//Padding Top
		$woobizz_sidebar_titlepaddingtopsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlepaddingtopsize');
		$woobizz_sidebar_titlepaddingunittop= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlepaddingunittop');
		if ($woobizz_sidebar_titlepaddingunittop==0){
			$woobizz_sidebar_titlepaddingunittop="px";
		} elseif($woobizz_sidebar_titlepaddingunittop==1) {
			$woobizz_sidebar_titlepaddingunittop="%";
		} elseif($woobizz_sidebar_titlepaddingunittop==2) {
			$woobizz_sidebar_titlepaddingunittop="em";
		} elseif($woobizz_sidebar_titlepaddingunittop==3) {
			$woobizz_sidebar_titlepaddingunittop="pt";
		} else {
			$woobizz_sidebar_titlepaddingunittop="initial";
		} 
		//Padding Right
		$woobizz_sidebar_titlepaddingrightsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlepaddingrightsize');
		$woobizz_sidebar_titlepaddingunitright= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlepaddingunitright');
		if ($woobizz_sidebar_titlepaddingunitright==0){
			$woobizz_sidebar_titlepaddingunitright="px";
		} elseif($woobizz_sidebar_titlepaddingunitright==1) {
			$woobizz_sidebar_titlepaddingunitright="%";
		} elseif($woobizz_sidebar_titlepaddingunitright==2) {
			$woobizz_sidebar_titlepaddingunitright="em";
		} elseif($woobizz_sidebar_titlepaddingunitright==3) {
			$woobizz_sidebar_titlepaddingunitright="pt";
		} else {
			$woobizz_sidebar_titlepaddingunitright="initial";
		}	
		//Padding Bottom
		$woobizz_sidebar_titlepaddingbottomsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlepaddingbottomsize');
		$woobizz_sidebar_titlepaddingunitbottom= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlepaddingunitbottom');
		if ($woobizz_sidebar_titlepaddingunitbottom==0){
			$woobizz_sidebar_titlepaddingunitbottom="px";
		} elseif($woobizz_sidebar_titlepaddingunitbottom==1) {
			$woobizz_sidebar_titlepaddingunitbottom="%";
		} elseif($woobizz_sidebar_titlepaddingunitbottom==2) {
			$woobizz_sidebar_titlepaddingunitbottom="em";
		} elseif($woobizz_sidebar_titlepaddingunitbottom==3) {
			$woobizz_sidebar_titlepaddingunitbottom="pt";
		} else {
			$woobizz_sidebar_titlepaddingunitbottom="initial";
		}	
		//Padding Left
		$woobizz_sidebar_titlepaddingleftsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlepaddingleftsize');
		$woobizz_sidebar_titlepaddingunitleft= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_titlepaddingunitleft');
		if ($woobizz_sidebar_titlepaddingunitleft==0){
			$woobizz_sidebar_titlepaddingunitleft="px";
		} elseif($woobizz_sidebar_titlepaddingunitleft==1) {
			$woobizz_sidebar_titlepaddingunitleft="%";
		} elseif($woobizz_sidebar_titlepaddingunitleft==2) {
			$woobizz_sidebar_titlepaddingunitleft="em";
		} elseif($woobizz_sidebar_titlepaddingunitleft==3) {
			$woobizz_sidebar_titlepaddingunitleft="pt";
		} else {
			$woobizz_sidebar_titlepaddingunitleft="initial";
		}
		$woobizz_sidebar_titlepaddingfull=$woobizz_sidebar_titlepaddingtopsize.$woobizz_sidebar_titlepaddingunittop." "
									   .$woobizz_sidebar_titlepaddingrightsize.$woobizz_sidebar_titlepaddingunitright." "
									   .$woobizz_sidebar_titlepaddingbottomsize.$woobizz_sidebar_titlepaddingunitbottom." "
									   .$woobizz_sidebar_titlepaddingleftsize.$woobizz_sidebar_titlepaddingunitleft." ";
		//---------------------------------------------------------------------------- 
		//END SIDEBAR SIDEBAR TITLE
		//----------------------------------------------------------------------------
		//---------------------------------------------------------------------------- 
		//START SIDEBAR SIDEBAR DESCRIPTION
		//----------------------------------------------------------------------------
		//Hide Description?
		$woobizz_sidebar_descriptionhide=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionhide');
		if ($woobizz_sidebar_descriptionhide==0){
			$woobizz_sidebar_descriptionhide="none";
		} elseif($woobizz_sidebar_descriptionhide==1) {
			$woobizz_sidebar_descriptionhide="inherit";
		} else {
			$woobizz_sidebar_descriptionhide="inherit";
		}
		//Description Size
		$woobizz_sidebar_descriptionsize=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionsize');
		//Description Color
		$woobizz_sidebar_descriptioncolor=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptioncolor');
		//Description Weight
		$woobizz_sidebar_descriptionweight=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionweight');
		if ($woobizz_sidebar_descriptionweight==0){
				$woobizz_sidebar_descriptionweight="100";
			} elseif($woobizz_sidebar_descriptionweight==1) {
				$woobizz_sidebar_descriptionweight="200";
			} elseif($woobizz_sidebar_descriptionweight==2) {
				$woobizz_sidebar_descriptionweight="300";
			} elseif($woobizz_sidebar_descriptionweight==3) {
				$woobizz_sidebar_descriptionweight="400";
			} elseif($woobizz_sidebar_descriptionweight==4) {
				$woobizz_sidebar_descriptionweight="500";
			} elseif($woobizz_sidebar_descriptionweight==5) {
				$woobizz_sidebar_descriptionweight="600";
			} elseif($woobizz_sidebar_descriptionweight==6) {
				$woobizz_sidebar_descriptionweight="700";
			} else {$woobizz_sidebar_descriptionweight="400";
		}
		//Padding Top
		$woobizz_sidebar_descriptionpaddingtopsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionpaddingtopsize');
		$woobizz_sidebar_descriptionpaddingunittop= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionpaddingunittop');
		if ($woobizz_sidebar_descriptionpaddingunittop==0){
			$woobizz_sidebar_descriptionpaddingunittop="px";
		} elseif($woobizz_sidebar_descriptionpaddingunittop==1) {
			$woobizz_sidebar_descriptionpaddingunittop="%";
		} elseif($woobizz_sidebar_descriptionpaddingunittop==2) {
			$woobizz_sidebar_descriptionpaddingunittop="em";
		} elseif($woobizz_sidebar_descriptionpaddingunittop==3) {
			$woobizz_sidebar_descriptionpaddingunittop="pt";
		} else {
			$woobizz_sidebar_descriptionpaddingunittop="initial";
		} 
		//Padding Right
		$woobizz_sidebar_descriptionpaddingrightsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionpaddingrightsize');
		$woobizz_sidebar_descriptionpaddingunitright= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionpaddingunitright');
		if ($woobizz_sidebar_descriptionpaddingunitright==0){
			$woobizz_sidebar_descriptionpaddingunitright="px";
		} elseif($woobizz_sidebar_descriptionpaddingunitright==1) {
			$woobizz_sidebar_descriptionpaddingunitright="%";
		} elseif($woobizz_sidebar_descriptionpaddingunitright==2) {
			$woobizz_sidebar_descriptionpaddingunitright="em";
		} elseif($woobizz_sidebar_descriptionpaddingunitright==3) {
			$woobizz_sidebar_descriptionpaddingunitright="pt";
		} else {
			$woobizz_sidebar_descriptionpaddingunitright="initial";
		}	
		//Padding Bottom
		$woobizz_sidebar_descriptionpaddingbottomsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionpaddingbottomsize');
		$woobizz_sidebar_descriptionpaddingunitbottom= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionpaddingunitbottom');
		if ($woobizz_sidebar_descriptionpaddingunitbottom==0){
			$woobizz_sidebar_descriptionpaddingunitbottom="px";
		} elseif($woobizz_sidebar_descriptionpaddingunitbottom==1) {
			$woobizz_sidebar_descriptionpaddingunitbottom="%";
		} elseif($woobizz_sidebar_descriptionpaddingunitbottom==2) {
			$woobizz_sidebar_descriptionpaddingunitbottom="em";
		} elseif($woobizz_sidebar_descriptionpaddingunitbottom==3) {
			$woobizz_sidebar_descriptionpaddingunitbottom="pt";
		} else {
			$woobizz_sidebar_descriptionpaddingunitbottom="initial";
		}	
		//Padding Left
		$woobizz_sidebar_descriptionpaddingleftsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionpaddingleftsize');
		$woobizz_sidebar_descriptionpaddingunitleft= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_descriptionpaddingunitleft');
		if ($woobizz_sidebar_descriptionpaddingunitleft==0){
			$woobizz_sidebar_descriptionpaddingunitleft="px";
		} elseif($woobizz_sidebar_descriptionpaddingunitleft==1) {
			$woobizz_sidebar_descriptionpaddingunitleft="%";
		} elseif($woobizz_sidebar_descriptionpaddingunitleft==2) {
			$woobizz_sidebar_descriptionpaddingunitleft="em";
		} elseif($woobizz_sidebar_descriptionpaddingunitleft==3) {
			$woobizz_sidebar_descriptionpaddingunitleft="pt";
		} else {
			$woobizz_sidebar_descriptionpaddingunitleft="initial";
		}
		$woobizz_sidebar_descriptionpaddingfull=$woobizz_sidebar_descriptionpaddingtopsize.$woobizz_sidebar_descriptionpaddingunittop." "
									   .$woobizz_sidebar_descriptionpaddingrightsize.$woobizz_sidebar_descriptionpaddingunitright." "
									   .$woobizz_sidebar_descriptionpaddingbottomsize.$woobizz_sidebar_descriptionpaddingunitbottom." "
									   .$woobizz_sidebar_descriptionpaddingleftsize.$woobizz_sidebar_descriptionpaddingunitleft." ";
		//---------------------------------------------------------------------------- 
		//END SIDEBAR SIDEBAR DESCRIPTION
		//----------------------------------------------------------------------------
		//---------------------------------------------------------------------------- 
		//START 1.2.1 SIDEBAR SIDEBAR THUMBNAIL
		//----------------------------------------------------------------------------
		//Hide Thumnail?
		$woobizz_sidebar_thumbsbghide=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbghide');
		if ($woobizz_sidebar_thumbsbghide==0){
			$woobizz_sidebar_thumbsbghide="none";
		} elseif($woobizz_sidebar_thumbsbghide==1) {
			$woobizz_sidebar_thumbsbghide="inherit";
		} else {
			$woobizz_sidebar_thumbsbghide="inherit";
		}
		//Expand Thumbnail?
		$woobizz_sidebar_thumbsbgexpand=get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgexpand');
		if ($woobizz_sidebar_thumbsbgexpand==0){
			$woobizz_sidebar_thumbsbgexpand="100%";
		} elseif($woobizz_sidebar_thumbsbgexpand==1) {
			$woobizz_sidebar_thumbsbgexpand="auto";
		} else {
			$woobizz_sidebar_thumbsbgexpand="auto";
		}
		//Borders
		$woobizz_sidebar_thumbsbgbordersize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgbordersize');
		$woobizz_sidebar_thumbsbgbordercolor= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgbordercolor');
		$woobizz_sidebar_thumbsbgborderstyle= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgborderstyle');
		if ($woobizz_sidebar_thumbsbgborderstyle==0){
				$woobizz_sidebar_thumbsbgborderstyle="dotted";
			} elseif($woobizz_sidebar_thumbsbgborderstyle==1) {
				$woobizz_sidebar_thumbsbgborderstyle="dashed";
			} elseif($woobizz_sidebar_thumbsbgborderstyle==2) {
				$woobizz_sidebar_thumbsbgborderstyle="solid";
			} elseif($woobizz_sidebar_thumbsbgborderstyle==3) {
				$woobizz_sidebar_thumbsbgborderstyle="none";
			} else {$woobizz_sidebar_thumbsbgborderstyle="none";
		}
		$woobizz_sidebar_thumbsbgborderradius= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgborderradius'); 
		$woobizz_sidebar_thumbsbgborderfull=$woobizz_sidebar_thumbsbgbordersize."px "
										.$woobizz_sidebar_thumbsbgborderstyle." "
										.$woobizz_sidebar_thumbsbgbordercolor." ";
		//Shadows
		$woobizz_sidebar_thumbsbgshadowcolor= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgshadowcolor');
		$woobizz_sidebar_thumbsbgshadowrightdistance= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgshadowrightdistance');
		$woobizz_sidebar_thumbsbgshadowbottomdistance= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgshadowbottomdistance');
		$woobizz_sidebar_thumbsbgshadowspread= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgshadowspread');
		$woobizz_sidebar_thumbsbgshadowsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgshadowsize');
		$woobizz_sidebar_thumbsbgshadowapply= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgshadowapply');
		if ($woobizz_sidebar_thumbsbgshadowapply==0){
				$woobizz_sidebar_thumbsbgshadowfull=$woobizz_sidebar_thumbsbgshadowrightdistance."px "
													.$woobizz_sidebar_thumbsbgshadowbottomdistance."px "
													.$woobizz_sidebar_thumbsbgshadowspread."px "
													.$woobizz_sidebar_thumbsbgshadowsize."px "
													.$woobizz_sidebar_thumbsbgshadowcolor;
			} elseif($woobizz_sidebar_thumbsbgshadowapply==1) {
				$woobizz_sidebar_thumbsbgshadowfull="none";
			} else {
				$woobizz_sidebar_thumbsbgshadowfull="none";
		}
		//----------------------------------------------------------------------------
		//THUMBNAIL BACKGROUND
		//----------------------------------------------------------------------------
		$woobizz_sidebar_thumbsbgpadding= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgpadding');
		$woobizz_sidebar_thumbsbgimage= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgimage');
		$woobizz_sidebar_thumbsbgcolor= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgcolor');
		$woobizz_sidebar_thumbsbgsize= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgsize');
		if ($woobizz_sidebar_thumbsbgsize==0){
				$woobizz_sidebar_thumbsbgsize="contain";
			} elseif($woobizz_sidebar_thumbsbgsize==1) {
				$woobizz_sidebar_thumbsbgsize="cover";
			} elseif($woobizz_sidebar_thumbsbgsize==2) {
				$woobizz_sidebar_thumbsbgsize="inherit";
			} elseif($woobizz_sidebar_thumbsbgsize==3) {
				$woobizz_sidebar_thumbsbgsize="initial";
			} else {
				$woobizz_sidebar_thumbsbgsize="initial";
		}
		$woobizz_sidebar_thumbsbgrepeat= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgrepeat');
		if ($woobizz_sidebar_thumbsbgrepeat==0){
				$woobizz_sidebar_thumbsbgrepeat="no-repeat";
			} elseif($woobizz_sidebar_thumbsbgrepeat==1) {
				$woobizz_sidebar_thumbsbgrepeat="repeat";
			} elseif($woobizz_sidebar_thumbsbgrepeat==2) {
				$woobizz_sidebar_thumbsbgrepeat="repeat-x";
			} elseif($woobizz_sidebar_thumbsbgrepeat==3) {
				$woobizz_sidebar_thumbsbgrepeat="repeat-y";
			} elseif($woobizz_sidebar_thumbsbgrepeat==4) {
				$woobizz_sidebar_thumbsbgrepeat="round";
			} elseif($woobizz_sidebar_thumbsbgrepeat==5) {
				$woobizz_sidebar_thumbsbgrepeat="space";
			} elseif($woobizz_sidebar_thumbsbgrepeat==6) {
				$woobizz_sidebar_thumbsbgrepeat="inherit";
			} elseif($woobizz_sidebar_thumbsbgrepeat==5) {
				$woobizz_sidebar_thumbsbgrepeat="initial";
			} else {
				$woobizz_sidebar_thumbsbgrepeat="initial";
		}
		$woobizz_sidebar_thumbsbgposition= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbgposition');
		if ($woobizz_sidebar_thumbsbgposition==0){
				$woobizz_sidebar_thumbsbgposition="left top";
			} elseif($woobizz_sidebar_thumbsbgposition==1) {
				$woobizz_sidebar_thumbsbgposition="left center";
			} elseif($woobizz_sidebar_thumbsbgposition==2) {
				$woobizz_sidebar_thumbsbgposition="left bottom";
			} elseif($woobizz_sidebar_thumbsbgposition==3) {
				$woobizz_sidebar_thumbsbgposition="right top";
			} elseif($woobizz_sidebar_thumbsbgposition==4) {
				$woobizz_sidebar_thumbsbgposition="right center";
			} elseif($woobizz_sidebar_thumbsbgposition==5) {
				$woobizz_sidebar_thumbsbgposition="right bottom";
			} elseif($woobizz_sidebar_thumbsbgposition==6) {
				$woobizz_sidebar_thumbsbgposition="center top";
			} elseif($woobizz_sidebar_thumbsbgposition==7) {
				$woobizz_sidebar_thumbsbgposition="center center";
			} elseif($woobizz_sidebar_thumbsbgposition==8) {
				$woobizz_sidebar_thumbsbgposition="center bottom";
			} elseif($woobizz_sidebar_thumbsbgposition==9) {
				$woobizz_sidebar_thumbsbgposition="initial";
			} elseif($woobizz_sidebar_thumbsbgposition==10) {
				$woobizz_sidebar_thumbsbgposition="initial";
			} else {
				$woobizz_sidebar_thumbsbgposition="initial";
		}
		//---------------------------------------------------------------------------- 
		//END SIDEBAR SIDEBAR THUMBNAIL
		//----------------------------------------------------------------------------
		//----------------------------------------------------------------------------
		//START THUMBNAIL GRADIENTS
		//----------------------------------------------------------------------------
		$woobizz_sidebar_thumbsbggradient1= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbggradient1');
		$woobizz_sidebar_thumbsbggradient1opacity= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbggradient1opacity');
		$trasnform_woobizz_sidebar_thumbsbggradient1=woobizz_sidebar_hextorgb($woobizz_sidebar_thumbsbggradient1);
		$woobizz_sidebar_thumbsbgfullgradient1=$trasnform_woobizz_sidebar_thumbsbggradient1.",".$woobizz_sidebar_thumbsbggradient1opacity;
		$woobizz_sidebar_thumbsbggradient2= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbggradient2');
		$woobizz_sidebar_thumbsbggradient2opacity= get_option(WOOBIZZSIDEBAR.'_woobizz_sidebar_thumbsbggradient2opacity');
		$trasnform_woobizz_sidebar_thumbsbggradient2=woobizz_sidebar_hextorgb($woobizz_sidebar_thumbsbggradient2);
		$woobizz_sidebar_thumbsbgfullgradient2=$trasnform_woobizz_sidebar_thumbsbggradient2.",".$woobizz_sidebar_thumbsbggradient2opacity;
		//----------------------------------------------------------------------------
		//END GRADIENTS
		//----------------------------------------------------------------------------
		//----------------------------------------------------------------------------    
		//START SHOWING CSS OPTIONS
		//----------------------------------------------------------------------------
		 echo"
		<style>
		/**Display widget side*/
		@media (min-width: 768px){
				.right-sidebar .widget-area {
				   float:".$woobizz_sidebar_display_float_widget."!important;
				   margin:".$woobizz_sidebar_display_margin_widget."!important;
				   width:".$woobizz_sidebar_sidebarsidebarsize."%!important;
				}
				.right-sidebar .content-area {
				   float:".$woobizz_sidebar_display_float_content."!important;
				   margin:".$woobizz_sidebar_display_margin_content."!important;
				   width:".$woobizz_sidebar_pagecontentsize."%!important;
				}
		}
		.right-sidebar .widget-area .widget {
			background:linear-gradient(rgba(".$woobizz_sidebar_backgroundfullgradient1."),
									   rgba(".$woobizz_sidebar_backgroundfullgradient2.")),
										url(".$woobizz_sidebar_backgroundimage.");
			background-color:".$woobizz_sidebar_backgroundcolor.";
			background-size:".$woobizz_sidebar_backgroundsize.";
			background-repeat:".$woobizz_sidebar_backgroundrepeat.";
			background-position:".$woobizz_sidebar_backgroundposition.";
			box-shadow:".$woobizz_sidebar_shadowfull.";
			border:".$woobizz_sidebar_borderfull.";
			border-radius:".$woobizz_sidebar_borderradius."px;
			margin-top:".$woobizz_sidebar_margintopsize.$woobizz_sidebar_marginunittop."!important;
			margin-bottom:".$woobizz_sidebar_marginbottomsize.$woobizz_sidebar_marginunitbottom."!important;
			padding:".$woobizz_sidebar_paddingfull.";					   
		}
		/**Right Sidebar Title*/
		.right-sidebar .widget-title{
			font-size:17px;
			font-weight:300;
			text-align:center;
			margin:0;
			padding:3%;
			border-bottom:1px solid #dbdbdb;
			background:#f3f3f3;
		}
		/**Right Sidebar Content Padding*/
		.right-sidebar .widget ul,
		.right-sidebar .widget-area .buttons,
		.right-sidebar .widget-area .form,
		.right-sidebar .widget-area .tagcloud,
		.right-sidebar .widget-area .price_slider_wrapper,
		.right-sidebar .siteorigin-widget-tinymce.textwidget {
			padding:10px 15px;
		}
		/**Right Sidebar links*/
		.right-sidebar .widget a, .right-sidebar ul.product_list_widget a {
			text-decoration:none!important;
			font-family: arial!important;
			font-weight:400!important;
		}
		/**Right Sidebar Carrito*/
		.right-sidebar a.button.wc-forward, .right-sidebar a.button.wc-forward:hover {
			color: white;
			background:#95b965;
		}
		.right-sidebar a.button.checkout, .right-sidebar a.button.checkout:hover{
			color:white;
			background:orange;
		}
		.right-sidebar  .widget_price_filter .price_slider_amount .button {
			float: none;
			width: 100%;
		}
		.right-sidebar .widget_price_filter .price_slider_amount {
			text-align: center;
			line-height: 2.4em;
		}
		.right-sidebar .widget-area .widget .buttons{
			margin-bottom:10%;
		}
		.right-sidebar .wc-forward:after, .woocommerce-Button--next:after {
			display: none;
		 }
		.right-sidebar .widget-area .widget a.button {
			font-size: 15px;
			font-family: arial;
			font-weight: 400;
		}
		.right-sidebar .widget_product_search form input[type=search]{
			background:white;
		}
		.right-sidebar .so-panel:last-child {
			margin: 0;
			padding: 0;
		}
		/**END RIGHT SIDEBAR*/
		/**START FOOTER SIDEBAR*/
		.wb-customfooter-sidebar-content h3.widget-title{
			border:none;
			background:none;
		}
		/**END FOOTER SIDEBAR*/
		/**START CONTENT SIDEBAR*/
		.content-area .widget-title{
			border:none;
			background:none;
		}
		p.woocommerce-mini-cart__empty-message {
			padding: 6% 2%;
			margin: 0;
			text-align: center;
		}
		</style>";
		}
		add_action('wp_head', 'woobizz_sidebar_allcssoptions', 100);
		//---------------------------------------------------------------------------- 
		//END ALL CSS FUNCTIONS
		//----------------------------------------------------------------------------
		
	//End check if widget is active	
	}else{
	//Do nothing
	}
}
add_action('wp_head','woobizz_check_if_sidebar1_is_active');