<?php

/** 
* Admin 
*/
if ( ! class_exists('WoobizzSidebarOptions') ) {
	class WoobizzSidebarOptions{
	
		public $_parent;
		public $_icon;
		public $_role;
		public $_style;
		public $_name;
		public $_slug;
		public $_order;
		public $_options;
		public $_prefix;
		public $_url;
		public $_folder;
		
		public function __construct( 
			$name 		= 'Options Page', 
			$slug 		= 'options-page',
			$prefix		= 'wl',
			$parent 	= null,
			$icon		= null,
			$role 		= 'read', 
			$order 		= null, 
			$style 		= true,
			$title		= false,
			$sidebar	= false,
			$options	= null,
			$url 		= null,
			$folder 	= 'admin') {
			
			$this->_parent 	= $parent;
			$this->_icon	= $icon;
			$this->_role	= $role;
			$this->_style 	= $style;
			$this->_title	= $title;
			$this->_name	= $name;
			$this->_slug	= $slug;
			$this->_order	= $order;
			$this->_options	= $options;
			$this->_prefix	= $prefix;
			$this->_url		= ( $url ) ? $url : plugins_url().'/woobizz-sidebar';
			$this->_folder	= $folder;
			
			/**
			if ( $sidebar === true && WhitelabelSidebars::$_count < 1) {
				$sidebar = new WhitelabelSidebars( $this->_url, $this->_folder );
			}
			*/
			
			/** Only do in Admin */
			if ( is_admin() ) {
			
				add_action('admin_enqueue_scripts', array($this, 'load_scripts') );
				/** Create Options Page */
				if ( $parent ) {
					add_action('admin_menu', array( $this, 'submenu_page' ) );
				} else {
					add_action('admin_menu', array( $this, 'menu_page' ) );
				}
			
				
				/** Save Options */
				add_action( 'wp_ajax_'.$this->_prefix.'_save_options', array( $this, 'save_options') );
				
				/** Import Options */
				add_action( 'wp_ajax_'.$this->_prefix.'_import_options', array( $this, 'import_options' ) );
				
				/** Backup Options */
				add_action( 'wp_ajax_'.$this->_prefix.'_backup_options', array( $this, 'backup_options' ) );
				
				/** Reset Options */
				add_action( 'wp_ajax_'.$this->_prefix.'_reset_options', array( $this, 'reset_options' ) );
				
				/** Restore Options */
				add_action( 'wp_ajax_'.$this->_prefix.'_restore_options', array( $this, 'restore_options' ) );
				
				/** Admin Bar */
				add_action( 'wp_before_admin_bar_render', array( $this, 'top_navigation' ) );
			
			}
		}
		
		/** Save Options Hook */
		function save_options() {
			
			if ( ! isset( $_POST['theme_options_nonce'] ) ) {
				return;
			}
		
			if ( ! wp_verify_nonce( $_POST['theme_options_nonce'], 'theme_options_nonce_field' ) ) {
				return;
			}
			
			$data = $_POST['data'];
			
			if ( isset( $data ) ) {
				foreach ($data as $key => $value) {
					update_option( $data[$key][0], wp_kses_post( stripcslashes( $data[$key][1] ) ) );
				}
			}
			
			die();
		}
		
		/** Import Options Hook */
		function import_options() {
			$data = $_POST['data'];
			$data = base64_decode( $data );
			$data = json_decode( $data, true );
			
			if ( isset( $data ) ) {
				foreach ( $data as $key => $value ) {
					update_option( $key, wp_kses_post( stripcslashes( $value) ) );
				}
			}
			
			die();
		}
		
		/** Backup Options Hook */
		function backup_options() {
			
			foreach ( $_POST['data'] as $key => $value ) {
				$now = time();
				if ( $_POST['data'][$key][0] ==  $this->_prefix.'_theme_options_backup_list' ) {
					$current_list = get_option( $this->_prefix.'_theme_options_backup_list' );
					update_option( $this->_prefix.'_theme_options_backup_list', $current_list.$now.' ' );
					
				} else {
					update_option( $_POST['data'][$key][0].$now, wp_kses_post( stripcslashes( $_POST['data'][$key][1] ) ) );
				}
			}
			
			die();
		}
		
		/** Reset Options Hook */
		function reset_options() {
			$data = $_POST['data'];
			
			if (isset($data)) {
				foreach ( $data as $key => $value ) {
					if ( strpos( $data[$key][0], '_theme_options_backup_') !== false ) {
						$old = get_option( $this->_prefix.'_theme_options_backup_list' );
						$new = str_replace( $data[$key][1], ' ', $old );
						update_option( $this->_prefix.'_theme_options_backup_list', $new );
					}
					delete_option( $data[$key][0] );
				}
			}
			
			die();
		}
		
		/** Restore Options Hook */
		function restore_options() {
			$data = get_option($_POST['data'][0][0]);
			$data = json_decode( $data, true );
			
			foreach ( $data as $key => $value ) {
				update_option( $value['option'], wp_kses( stripcslashes( $value['value'] ) ) );
			}
			
			die();
		}
		
		/** Enqueue Scripts & Styles */
		function load_scripts() {
			if ( strpos( get_current_screen()->id, $this->_slug ) ) {
				
				global $_wp_admin_css_colors; 
				$admin_colors = $_wp_admin_css_colors;
				$color_scheme = $admin_colors[get_user_option('admin_color')]->colors;
				
				if ( $this->_style !== false ) {
					wp_enqueue_style( 'curly-google-font-roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,300,700,900', true );
				}
				
				wp_enqueue_style('curly-whitelabel-select', $this->_url . '/'.$this->_folder.'/css/selectric.css', true);
				wp_enqueue_style('curly-whitelabel-chosen', $this->_url.'/'.$this->_folder.'/css/chosen.css', true);
				wp_enqueue_style('curly-whitelabel-fontawesome','//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', true);
				wp_enqueue_style('curly-whitelabel-main', $this->_url.'/'.$this->_folder.'/css/main.css', true);
				wp_enqueue_style( 'wp-color-picker' );	
				wp_enqueue_script('wp-color-picker');	
				wp_enqueue_script('jquery-ui-core');
				wp_enqueue_script('jquery-ui-tabs');
				wp_enqueue_script('jquery-ui-position');
				wp_enqueue_script('jquery-ui-accordion');
				wp_enqueue_script('jquery-ui-widget');
				wp_enqueue_script('jquery-ui-mouse');
				wp_enqueue_script('jquery-ui-button');
				wp_enqueue_media();
				wp_enqueue_script('curly-whitelabel-selectric', $this->_url.'/'.$this->_folder.'/js/jquery.selectric.min.js' , 'jquery', null, true);
				wp_enqueue_script('curly-whitelabel-chosen', $this->_url.'/'.$this->_folder.'/js/jquery.chosen.min.js' , 'jquery', null, true);
				wp_enqueue_script('curly-whitelabel-main', $this->_url.'/'.$this->_folder.'/js/main.js' , 'jquery', null, true);
				
				wp_localize_script('curly-whitelabel-main', 'js_options_data', array(
					1 => $this->_url,
					2 => __('Saving', 'whitelabel'),
					3 => __('You are about to leave this page without saving. All changes will be lost.', 'whitelabel'),
					4 => __('WARNING: You are about to delete all your settings! Please confirm this action.', 'whitelabel'),
					5 => $this->_prefix,
					6 => __('WARNING: You are about to restore your backup. This will overwrite all your settings! Please confirm this action.', 'whitelabel'),
					7 => __('WARNING: You are about to delete your backup. All unsaved options will be lost. We recommend that you save your options before deleting a backup. Please confirm this action.', 'whitelabel'),
					8 => __('WARNING: You are about to create a backup. All unsaved options will be lost. We recommend that you save your options before deleting a backup. Please confirm this action.', 'whitelabel'),
					9 => __('Delete','whitelabel'),
					10=> $this->_prefix
				));
				
				if ( $this->_style !== false ) {
					$typography = '
						#theme-options-wrapper{
							font-family: "Roboto", sans-serif;
						}
						#theme-options-wrapper h2{
							font-weight: 300;
							font-size: 24px;
						}
						#theme-options .form-control label.name{
							font-size: 16px;
							line-height: 22px;
						}
						#theme-options .form-control input[type=text],
						#theme-options .buttons label,
						#theme-options .wp-color-result::after,
						#theme-options .wp-picker-clear,
						#tab-list a{
							font-size: 13px;
						}
						#theme-options .wp-color-picker,
						#theme-options p,
						#theme-options .message h3{
							font-size: 14px !important;
						}
					';	
				} else {
					$typography = null;
				}
				
				$color_scheme = '
					#tab-list li.ui-state-active a{
						color: '.$color_scheme[3].';
						border-color: '.$color_scheme[3].';
					}
					#save-options-top, #save-options-bottom,
					#theme-options .buttons label.ui-state-active,
					#theme-options .slider.ui-slider .ui-slider-handle,
					#theme-options .buttons.buttons-images label.ui-state-active::after,
					#theme-options .selectricItems li:hover,
					#theme-options .chosen-container .chosen-results li.highlighted,
					#theme-options .switch.on,
					#theme-options .btn,
					#options-saved{
						background: '.$color_scheme[3].';
						color: #fff;
					}
					#options-error{
						background: '.$color_scheme[2].';
						color: #fff;
					}
					#theme-options .btn:hover,
					#save-options-top:hover, #save-options-bottom:hover,
					#theme-options .slider.ui-slider .ui-slider-handle:hover,
					#theme-options .slider.ui-slider .ui-slider-handle:active{
						background: '.$color_scheme[2].';
						color: #fff;
					}
					#theme-options .buttons.buttons-images label.ui-state-active,
					#theme-options .switch.on{
						border-color: '.$color_scheme[3].';
					}
					#tab-list a:hover{
						color: '.$color_scheme[3].';
					}';
					
					$css = $typography.$color_scheme;
					
				wp_add_inline_style('curly-whitelabel-main', $css);
			} 
		}
		
		/** Top Navigation Hook */
		function top_navigation() {
		
			global $wp_admin_bar;
			
			if ( $this->_parent ) {
				$link_base = admin_url().$this->_parent.'?page='.$this->_slug;
			} else {
				$link_base = admin_url().'admin.php?page='.$this->_slug;
			}
			/**
			$wp_admin_bar->add_menu( array(
				'parent'	=> false,
				'id'		=> $this->_slug,
				'title'		=> $this->_name,
				'href'		=> $link_base,
				'meta' 		=> array( 'title' => $this->_name )
			) );
			*/
			
			foreach ( $this->_options as $key => $value) {
				if ($value['type'] == 'section') {
					$wp_admin_bar->add_menu( array(
						'parent'	=> $this->_slug,
						'id'		=> 'curly'.$key,
						'title'		=> $value['name'],
						'href'		=> $link_base.'#'.$key,
						'meta' 		=> array( 'title' => $value['name'] )
					) );
				}
			}
		}
		
		/** Add Subpage */
		function submenu_page(){
		     add_submenu_page( $this->_parent, $this->_name, $this->_name, $this->_role, $this->_slug, array($this, 'create_page') ); 
		}
		
		/** Add Page */
		function menu_page() {
			add_menu_page( $this->_name, $this->_name, $this->_role, $this->_slug, array($this, 'create_page'), $this->_icon, $this->_order ); 
		}
		
		/** Create Page Hook */
		function create_page() {
			if ( $this->_options ) {
				foreach ( $this->_options as $key => $value ) {
					if ( $value['type'] == 'section' ) { 
						$tabs[] = array('id' => $key, 'name' => $value['name']);
						$parent = $key;
					} else {
						if ( ! isset( $parent ) ) {
							$parent = 0;
						}
						if ( isset( $value['id'] ) ) { 
							${'tab_'.$parent}[$key]['id'] = $value['id'];
						}
						if ( isset( $value['type'] ) ) { 
							${'tab_'.$parent}[$key]['type'] = $value['type'];
						}
						if ( isset( $value['name'] ) ) { 
							${'tab_'.$parent}[$key]['name'] = $value['name'];
						}
						if ( isset( $value['desc'] ) ) { 
							${'tab_'.$parent}[$key]['desc'] = $value['desc'];
						}
						if ( isset( $value['std'] ) ){
							${'tab_'.$parent}[$key]['std'] = $value['std'];
						} else {
							${'tab_'.$parent}[$key]['std'] = null;
						}
						if ( isset( $value['options'] ) ) { 
							${'tab_'.$parent}[$key]['options'] = $value['options'];
						}
						if ( isset( $value['class'] ) ) { 
							${'tab_'.$parent}[$key]['class'] = $value['class'];
						}
						if ( isset( $value['prefix'] ) ) { 
							${'tab_'.$parent}[$key]['prefix'] = $value['prefix'];
						}
						if ( isset( $value['suffix'] ) ) { 
							${'tab_'.$parent}[$key]['suffix'] = $value['suffix'];
						}
						if ( isset( $value['min'] ) ) { 
							${'tab_'.$parent}[$key]['min'] = $value['min'];
						}
						if ( isset( $value['max'] ) ) { 
							${'tab_'.$parent}[$key]['max'] = $value['max'];
						}
						if ( isset( $value['increment'] ) ) { 
							${'tab_'.$parent}[$key]['increment'] = $value['increment'];
						}
						if ( isset( $value['alert'] ) ) { 
							${'tab_'.$parent}[$key]['alert'] = $value['alert'];
						}
						if ( isset( $value['source'] ) ) { 
							${'tab_'.$parent}[$key]['source'] = $value['source'];
						}
						if ( isset( $value['placeholder'] ) ) { 
							${'tab_'.$parent}[$key]['placeholder'] = $value['placeholder'];
						}
						if ( isset( $value['editor_settings'] ) ) { 
							${'tab_'.$parent}[$key]['editor_settings'] = $value['editor_settings'];
						}
						if ( isset( $value['height'] ) ) { 
							${'tab_'.$parent}[$key]['height'] = $value['height'];
						}
					}
				}
				
				if ( isset( $tabs ) ) {
					
					$list_items = '<ul id="tab-list">';
					$div_contents = null;
					
					foreach ( $tabs as $tab ) {
					
						$list_items 	.= '<li><a href="#'.$tab['id'].'">'.$tab['name'].'</a></li>';
						$div_contents 	.= '<div id="'.$tab['id'].'" class="tab">';
						
						if ( isset( ${'tab_'.$tab['id']} ) ) {
							foreach ( ${'tab_'.$tab['id']} as $tab_content ) {
								$option = new WoobizzSidebarOptionsGenerator( $tab_content, $this->_prefix );
								$div_contents .= $option;
							}
						} else {
							$div_contents .= __('There are no options defined for this tab.', 'whitelabel');
						}
						
						$div_contents	.= '</div>';
					}
					$list_items .= '</ul>';
					
				} else {
				
					$no_tab = true;
					$div_contents = '<div class="no-tab">';
					
					foreach ( ${'tab_0'} as $tab_content ) {
						$option = new WoobizzSidebarOptionsGenerator( $tab_content );
						$div_contents .= $option;
					}
					
					$div_contents .= '</div>';
					
				}
			}
			
			$html = '<div id="theme-options-wrapper">';
				$html .= ( $this->_title === true ) ? '<h1>'.$this->_name.'</h1>' : null;
				$html .= '<div id="theme-options">';
				
				
					$html .= ( isset( $list_items ) ) ? $list_items : null;
					$html .= ( $div_contents ) ? $div_contents : null;
				$html .= '</div>';
				$html .= wp_nonce_field('theme_options_nonce_field', 'theme_options_nonce', true, false);
				$html .= '<a href="#" id="save-options-bottom" class="'.( ( isset($no_tab) && $no_tab === true ) ? 'no-tab' : null ).'" title="'.__('Save Options','whitelabel').'">'.__('Save Options','whitelabel').'</a>';
			$html .= '</div>';
			$html .= '<a href="#" id="save-options-top" title="'.__('Quick Save','whitelabel').'">'.__('Quick Save','whitelabel').'</a>';
			$html .= '<div id="options-saved"><div class="fa fa-save fa-large fa-5x"></div><strong>'.__('Saved','whitelabel').'</strong></div>';
			$html .= '<div id="options-error"><div class="fa fa-warning fa-large fa-5x"></div><strong>'.__('Error','whitelabel').'</strong></div>';
			
			echo $html;
		}
	}
}

/**
* Whitelabel Options Generator
* Used to create each option based on type.
* 
* @since Whitelabel Theme & Plugin Options 1.2
*
*/

if ( ! class_exists( 'WoobizzSidebarOptionsGenerator' ) ) {
	class WoobizzSidebarOptionsGenerator {
	
	public $_data;
	public $_id;
	public $_type;
	public $_default;
	public $_value;
	public $_class;
	public $_desc;
	public $_increment;
	public $_name;
	public $_options;
	public $_min;
	public $_max;
	public $_prefix;
	public $_suffix;
	public $_source;
	public $_placeholder;
	public $_editor;
	public $_height;
	public $_upload_title;
	public $_upload_button;
	public $_options_prefix;
	
	public function __construct( $data = null, $prefix = 'white' ) {
		$this->_data 			= $data;
		$this->_type			= $data['type'];
		$this->_id				= ( isset( $data['id'] ) ) ? $data['id'] : null;
		$this->_default 		= ( isset( $data['std'] ) ) ? $data['std'] : null;
		$this->_value 			= ( null !== get_option( $this->_id, null ) ) ? esc_html( get_option( $this->_id ) ) : $this->_default;
		$this->_class 			= ( isset( $data['class'] ) ) ? $data['class'] : null;
		$this->_desc 			= ( isset( $data['desc'] ) ) ? '<span class="description">'.$data['desc'].'</span>' : null;
		$this->_desc 		   .= ( isset( $data['alert'] ) ) ? '<span class="description alert">'.$data['alert'].'</span>' : null;
		$this->_increment 		= ( isset( $data['increment'] ) ) ? $data['increment'] : 1;	
		$this->_name 			= ( isset( $data['name'] ) ) ? esc_html($data['name']) : null;
		$this->_options 		= ( isset( $data['options'] ) ) ? $data['options'] : null;
		$this->_min 			= ( isset( $data['min'] ) ) ? $data['min'] : null;
		$this->_max 			= ( isset( $data['max'] ) ) ? $data['max'] : null;
		$this->_prefix 			= ( isset( $data['prefix'] ) ) ? $data['prefix'] : null;
		$this->_suffix 			= ( isset( $data['suffix'] ) ) ? $data['suffix'] : null;
		$this->_source 			= ( isset( $data['source'] ) ) ? $data['source'] : null;
		$this->_placeholder 	= ( isset( $data['placeholder'] ) ) ? $data['placeholder'] : null;
		$this->_editor 			= ( isset( $data['editor'] ) ) ? $data['editor_settings'] : null;
		$this->_height 			= ( isset( $data['height'] ) ) ? $data['height'] : null;
		$this->_upload_title 	= __('Insert ', 'whitelabel') . $this->_name;
		$this->_upload_button	= __('Choose as ', 'whitelabel') . $this->_name;
		$this->_options_prefix	= $prefix;
	}
	
	public function __toString() {
		switch ( $this->_type ) {
			case 'title' : {
				return $this->title();
			} break;
			case 'message' : { 
				return $this->message();
			} break;
			case 'html' : { 
				return $this->html(); 
			} break;
			case 'iframe' : { 
				return $this->iframe(); 
			} break;
			case 'divider' : { 
				return $this->divider();
			} break;
			case 'text' : { 
				return $this->text();
			} break;
			case 'textarea' : {
				return $this->textarea();
			} break;
			case 'switch' : {
				return $this->switcher();
			} break;
			case 'checkbox' : {
				return $this->checkbox();
			} break;
			case 'checkboxes' : {
				return $this->checkboxes();
			} break;
			case 'radio' : {
				return $this->radio(); 
			} break;
			case 'select' : {
				return $this->select();
			} break;
			case 'select_search' : {
				return $this->select_search(); 
			} break;
			case 'select_multiple' : {
				return $this->select_multiple(); 
			} break;
			case 'color' : {
				return $this->color(); 
			} break;
			case 'upload' : {
				return $this->image(); 
			} break;
			case 'upload_min' : { 
				return $this->image_mini(); 
			} break;
			case 'images' : {
				return $this->images(); 
			} break;
			case 'number' : {
				return $this->number(); 
			} break;
			case 'buttons' : {
				return $this->buttons(); 
			} break;
			case 'editor_settings' : {
				return $this->editor(); 
			} break;
			case 'font' : {
				return $this->font(); 
			} break;
			case 'google_font' : {
				return $this->font_google();
			} break;
			case 'backup' : {
				return $this->backup_button(); 
			} break;
			case 'reset' : {
				return $this->reset_button();
			} break;
			case 'export' : {
				return $this->export(); 
			} break;
			case 'import' : {
				return $this->import(); 
			} break;
			case 'code' : {
				return $this->code(); 
			} break;
			default	: {
				return '';
			}
		}
	}
	
	/** Title Option */
	function title() {
		$output = '<div class="form-control '.$this->_class.' info-title">';
			$output .= '<h2>'.$this->_name.'</h2>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Message Option */
	function message() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<div class="message">';
			$output .= ( $this->_name ) ? '<h3>'.$this->_name.'</h3>' : null;
			$output .= $this->_default;
			$output .= '</div>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** HTML Option */
	function html() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label><br>';
			$output .= $this->_default;
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** iFrame Option */
	function iframe() {
		$output = '<div class="form-control">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<div class="content-frame"><iframe src="'.$this->_source.'" height="'.$this->_height.'"></iframe></div>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Divider Option **/
	function divider() {
		$output = '<hr>';
		
		return $output;
	}
	
	/** Text Field **/
	function text() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<input type="text" placeholder="'.$this->_placeholder.'" id="'.$this->_id.'" name="'.$this->_name.'" value="'.$this->_value.'">';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Textarea Field */
	function textarea() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<textarea placeholder="'.$this->_placeholder.'" id="'.$this->_id.'" name="'.$this->_id.'">'.wp_kses_post( $this->_value ).'</textarea>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Switch Option */
	function switcher() {
		$output = '<div class="form-control '.$this->_class.' switch-control">';
			$output .= '<input type="checkbox" class="js-switch" id="'.$this->_id.'" name="'.$this->_id.'" '.checked( $this->_value, 'true', false ).'><label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Checkbox Option */
	function checkbox() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">';
			$output .= '<input type="checkbox" id="'.$this->_id.'" name="'.$this->_id.'"'.checked( $this->_value, 'true', false ).'>'.$this->_name;
			$output .= '</label>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Checkboxes Option */
	function checkboxes() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			foreach ( $this->_options as $key => $option ) {
				$output .= '<label class="checkbox"><input type="checkbox" id="'.$this->_id.'_'.$key.'" value="'.$key.'"'.checked( get_option( $this->_id.'_'.$key, $this->_default[$key] ), 'true', false).'>'.$option.'</label>';
			}
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Radio Option */
	function radio() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			foreach ( $this->_options as $key => $option ) {
				$output .= '<label class="checkbox"><input type="radio" id="'.$this->_id.'_'.$key.'" value="'.$key.'" name="'.$this->_id.'" '.checked( $this->_value, $key, false).'>'.$option.'</label>';
			}
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Select Option */
	function select() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<select class="select-style" id="'.$this->_id.'" name="'.$this->_id.'">';
				foreach ( $this->_options as $key => $option ) {
					$output .= '<option value="'.$key.'" '.selected( $this->_value, $key, false ).'>'.$option.'</option>';
				}
			$output .= '</select>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Select Option with Search */
	function select_search() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<select class="select-chosen" id="'.$this->_id.'" name="'.$this->_id.'">';
				foreach ( $this->_options as $key => $option ) {
					$output .= '<option value="'.$key.'" '.selected( $this->_value, $key, false ).'>'.$option.'</option>';
				}
			$output .= '</select>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Search Multiple Option */
	function select_multiple() {
		$value = get_option( $this->_id, $this->_default );
		if ( !is_array($value) ) { 
			$value = explode(",", $value);
		}
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<select class="select-chosen" multiple id="'.$this->_id.'" name="'.$this->_id.'">';
				foreach ( $this->_options as $key => $option ) {
					$output .= '<option value="'.$key.'" '.selected( in_array( $key, $value ) ? $key : null, $key, false).'>'.$option.'</option>';
				}
			$output .= '</select>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Color Option */
	function color() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<input type="text" id="'.$this->_id.'" name="'.$this->_id.'" class="color-picker" value="'.$this->_value.'">';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Image Option */
	function image() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<input type="text" id="'.$this->_id.'" name="'.$this->_id.'" value="'.get_option( $this->_id ).'">';
			$output .= '<input type="hidden" id="'.$this->_id.'_id" name="'.$this->_id.'_id" value="'.get_option( $this->_id.'_id' ).'">';
			$output .= '<a href="#" class="image-upload-button btn" data-upload-title="'.$this->_upload_title.'" data-upload-button="'.$this->_upload_button.'">'.__('Upload','whitelabel').'</a>';
			$output .= '<a href="#" class="image-clear-button btn" style="display:'.( ( $this->_value ) ? 'inline-block' : 'none').'">'.__('Clear','whitelabel').'</a>';
			$output .= ( $this->_value ) ? '<img src="'.$this->_value.'" class="image-preview">' : null;
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Image Option without Preview */
	function image_mini() {
		$output = '<div class="form-control '.$this->_class.' upload_file">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<input type="text" id="'.$this->_id.'" name="'.$this->_id.'" value="'.get_option( $this->_id ).'">';
			$output .= '<a href="#" class="image-upload-button btn" data-upload-title="'.$this->_upload_title.'" data-upload-button="'.$this->_upload_button.'">'.__('Upload','whitelabel').'</a>';
			$output .= '<a href="#" class="image-clear-button btn" style="display:'.( ( $this->_value ) ? 'inline-block' : 'none').'">'.__('Clear','whitelabel').'</a>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Images Select Option */
	function images() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<div class="buttons buttons-images">';
				foreach ( $this->_options as $key => $option ) {
					$output .= '<input type="radio" id="'.$this->_id.'_'.$key.'" value="'.$key.'" name="'.$this->_id.'" '.checked( $this->_value, $key, false ).'>';
					$output .= '<label for="'.$this->_id.'_'.$key.'"><img src="'.$option.'" alt=""></label>';
				}
			$output .= '</div>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Number Option */
	function number() {
		$output = '<div class="form-control '.$this->_class.'" style="position:relative">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<input type="hidden" id="'.$this->_id.'" name="'.$this->_id.'" value="'.$this->_value.'">';
			$output .= '<div class="slider" id="'.$this->_id.'_slider"></div>';
			$output .= '<div class="slider_value">'.$this->_prefix.$this->_value.$this->_suffix.'</div>';
			$output .= $this->_desc;
		$output .= '</div>';
		$output .= '<script type="text/javascript">jQuery(function() { jQuery( "#'.$this->_id.'_slider" ).slider({ value: '.$this->_value.' , step: '.$this->_increment.' , min:'.$this->_min.' , max:'.$this->_max.' , slide: function( event, ui ) { jQuery(this).siblings(".slider_value").text( "'.$this->_prefix.'" + ui.value + "'.$this->_suffix.'" ); jQuery(this).siblings("input[type=hidden]").val(ui.value); }}); });</script>';
		
		return $output;
	}
	
	/** Buttons Option */
	function buttons() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<div class="buttons">';
				foreach ( $this->_options as $key => $option ) {
					$output .= '<input type="radio" id="'.$this->_id.'_'.$key.'" value="'.$key.'" name="'.$this->_id.'" '.checked( $this->_value, $key, false ).'>';
					$output .= '<label for="'.$this->_id.'_'.$key.'">'.$option.'</label>';
				}
			$output .= '</div>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Editor Option */
	function editor() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			ob_start(); wp_editor( get_option( $this->_id, $this->_default ), $this->_id, $this->_editor);
			$output .= ob_get_clean();
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Font Option */
	function font() {
		$font_style = array(
			__('Light', 'whitelabel'), 
			__('Light Italic', 'whitelabel'), 
			__('Normal', 'whitelabel'), 
			__('Bold', 'whitelabel'), 
			__('Italic', 'whitelabel'), 
			__('Bold Italic', 'whitelabel')
		);
		$font_variant = array(
			__('Normal', 'whitelabel'),
			__('Capitalize', 'whitelabel'),
			__('Uppercase', 'whitelabel'),
			__('Small Caps', 'whitelabel')
		);
		$value = get_option( $this->_id, $this->_default[0] );
		$value_size = ( get_option( $this->_id.'_size', null) ) ? get_option( $this->_id.'_size') : $this->_default[1];
		$value_style = ( get_option( $this->_id.'_style', null) ) ? get_option( $this->_id.'_style') : $this->_default[2];
		$value_variant = ( get_option( $this->_id.'_variant', null) ) ? get_option( $this->_id.'_variant') : $this->_default[3];
		
		$output = '<div class="form-control typography">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<div class="font-chooser">';
				$output .= '<select class="select-chosen" id="'.$this->_id.'" name="'.$this->_id.'">';
					foreach ( $this->_options as $key => $option ) {
						$output .= '<option value="'.$option.'" '.selected( $value, $option, false ).'>'.$option.'</option>';
					}
				$output .= '</select>';
			$output .= '</div>';
			$output .= '<select class="select-style" id="'.$this->_id.'_style" name="'.$this->_id.'_style">';
				foreach ( $font_style as $key => $option ) {
					$output .= '<option value="'.$key.'" '.selected( $value_style, $key, false ).'>'.$option.'</option>';
				}
			$output .= '</select>';
			$output .= '<select class="select-style font-variant" id="'.$this->_id.'_variant" name="'.$this->_id.'_variant">';
				foreach ( $font_variant as $key => $option ) {
					$output .= '<option value="'.$key.'" '.selected( $value_variant, $key, false ).'>'.$option.'</option>';
				}
			$output .= '</select>';
			$output .= '<div class="font-size">';
				$output .= '<input type="hidden" id="'.$this->_id.'_size" name="'.$this->_id.'_size" value="'.$value_size.'">';
				$output .= '<div class="slider" id="'.$this->_id.'_size_slider"></div>';
				$output .= '<div class="slider_value">'.$value_size.$this->_suffix.'</div>';
			$output .= '</div>';
			$output .= $this->_desc;
		$output .= '</div>';
		$output .= '<script type="text/javascript">jQuery(function() { jQuery( "#'.$this->_id.'_size_slider" ).slider({ value: '.$value_size.' ,  min:'.$this->_min.' , max:'.$this->_max.' , step: '.$this->_increment.' , slide: function( event, ui ) { jQuery(this).siblings(".slider_value").text( ui.value + "'.$this->_suffix.'" ); jQuery(this).siblings("input[type=hidden]").val(ui.value); }}); });</script>';
		
		return $output;
	}
	
	/** Google Font Option */
	function font_google() {
		$font_style = array( 
			__('Light', 'whitelabel'),
			__('Light Italic', 'whitelabel'),
			__('Normal', 'whitelabel'),
			__('Bold', 'whitelabel'),
			__('Italic', 'whitelabel'),
			 __('Bold Italic', 'whitelabel')
		);
		$font_variant = array(
			__('Normal', 'whitelabel'),
			__('Capitalize', 'whitelabel'),
			__('Uppercase', 'whitelabel'),
			__('Small Caps', 'whitelabel')
		);
		$value = get_option( $this->_id, $this->_default[0] );
		$value_size = ( get_option( $this->_id.'_size', null) ) ? get_option( $this->_id.'_size' ) : $this->_default[1];
		$value_style = ( get_option( $this->_id.'_style', null) ) ? get_option( $this->_id.'_style' ) : $this->_default[2];
		$value_variant = ( get_option( $this->_id.'_variant', null) ) ? get_option( $this->_id.'_variant' ) : $this->_default[3];
		
		$output = '<div class="form-control typography">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<div class="font-chooser">';
				$output .= '<select class="select-chosen" id="'.$this->_id.'" name="'.$this->_id.'">';
					foreach ( $this->_options as $key => $option ) {
						$output .= '<option value="'.$option['family'].'" '.selected( $value, $option['family'], false ).'>'.$option['family'].'</option>';
					}
				$output .= '</select>';
			$output .= '</div>';
			$output .= '<select class="select-style" id="'.$this->_id.'_style" name="'.$this->_id.'_style">';
				foreach ( $font_style as $key => $option ) {
					$output .= '<option value="'.$key.'" '.selected( $value_style, $key, false ).'>'.$option.'</option>';
				}
			$output .= '</select>';
			$output .= '<select class="select-style font-variant" id="'.$this->_id.'_variant" name="'.$this->_id.'_variant">';
				foreach ( $font_variant as $key => $option ) {
					$output .= '<option value="'.$key.'" '.selected( $value_variant, $key, false ).'>'.$option.'</option>';
				}
			$output .= '</select>';
			$output .= '<div class="font-size">';
				$output .= '<input type="hidden" id="'.$this->_id.'_size" name="'.$this->_id.'_size" value="'.$value_size.'">';
				$output .= '<div class="slider" id="'.$this->_id.'_size_slider"></div>';
				$output .= '<div class="slider_value">'.$value_size.$this->_suffix.'</div>';
			$output .= '</div>';
			$output .= $this->_desc;
		$output .= '</div>';
		$output .= '<script type="text/javascript">jQuery(function() { jQuery( "#'.$this->_id.'_size_slider" ).slider({ value: '.$value_size.' ,  min:'.$this->_min.' , max:'.$this->_max.' , step: '.$this->_increment.' , slide: function( event, ui ) { jQuery(this).siblings(".slider_value").text( ui.value + "'.$this->_suffix.'" ); jQuery(this).siblings("input[type=hidden]").val(ui.value); }}); });</script>';
		
		return $output;
	}
	
	/** Back-up Option */
	function backup_button() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			
			// Variables
			$current_list = get_option( $this->_options_prefix . '_theme_options_backup_list' );
			$current_list = explode( ' ', $current_list );
			$current_list = array_filter( $current_list, 'strlen' );
			
			$css = ( count( $current_list ) > 0 ) ? 'with-list' :  'no-list';
			
			$output .= '<div class="message '.$css.'">';
				$output .= '<h3 class="even">'.__('Back-up available','whitelabel').'</h3>';
				$output .= '<p class="even">'.__('You options have been backed up. You can always restore your options by clicking the <strong>Restore</strong> button below:','whitelabel').'</p>';
				$output .= '<ul class="backup-list even">';
				foreach ( $current_list as $backup ) {
				
					$output .= '<li>'.date( "M d, Y H:i", $backup ).'<a href="#" class="delete-backup" data-backup="'.$backup.'">'.__('Delete','whitelabel').'</a><a href="#" class="restore-backup" data-backup="'.$backup.'">'.__('Restore','whitelabel').'</a></li>';
				}
				$output .= '</ul>';
				$output .= '<p class="odd">'.__('You currently have not backups. You can create a backup by clicking the <strong>Backup Now</strong> link below:','whitelabel').'</p>'; 
				$output .= '<a href="#" id="backup">'.__('Backup Now','whitelabel').'</a>';
			$output .= '</div>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Reset Option */
	function reset_button() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= $this->_desc;
			$output .= '<a href="#" id="reset-options-bottom" title="'.__('Reset Options','whitelabel').'">'.__('Reset Options','whitelabel').'</a>';
		$output .= '</div>';
		
		return $output;
	}
	
	/** Export Option */
	function export() {
		$all_options = wp_load_alloptions();
		$options_data = array();
		foreach( $all_options as $option_name => $this->_value ) {
			if ( substr( $option_name, 0, strlen( $this->_options_prefix ) ) === $this->_options_prefix ) $options_data[$option_name] = $this->_value;
		}
		
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="export_field">'.$this->_name.'</label>';
			$output .= '<textarea readonly id="export_field" name="export_field">'.base64_encode( json_encode( $options_data ) ).'</textarea>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	/** Import Option */
	function import() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="import_field">'.$this->_name.'</label>';
			$output .= '<textarea placeholder="'.$this->_placeholder.'" id="import_field" name="import_field"></textarea>';
			$output .= $this->_desc;
			$output .= '<a href="#" id="import-options" title="'.__('Import Options','whitelabel').'">'.__('Import Options','whitelabel').'</a>';
		$output .= '</div>';
		
		return $output;
	}
	
	/** Code Option */
	function code() {
		$output = '<div class="form-control '.$this->_class.'">';
			$output .= '<label class="name" for="'.$this->_id.'">'.$this->_name.'</label>';
			$output .= '<textarea class="code" placeholder="'.$this->_placeholder.'" id="'.$this->_id.'" name="'.$this->_id.'">'.wp_kses_post( $this->_value ).'</textarea>';
			$output .= $this->_desc;
		$output .= '</div>';
		
		return $output;
	}
	
	}
}
?>