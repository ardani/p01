<?php
/*
Plugin Name: Extend Visual Composer Plugin Example
Plugin URI: http://wpbakery.com/vc
Description: Extend Visual Composer with your own set of shortcodes.
Version: 0.1.1
Author: WPBakery
Author URI: http://wpbakery.com
License: GPLv2 or later
*/

/*
This example/starter plugin can be used to speed up Visual Composer plugins creation process.
More information can be found here: http://kb.wpbakery.com/index.php?title=Category:Visual_Composer
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class SCP_Menu {

	protected $shortcode_name = 'scp_menu';
	protected $title = 'Menu';
	protected $description = 'Choose a menu';
	protected $textdomain = 'school_time';

	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'integrateWithVC' ) );

		// Use this when creating a shortcode addon
		add_shortcode( $this->shortcode_name, array( $this, 'render' ) );

		// Register CSS and JS
		add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
	}

	public function integrateWithVC() {
		// Check if Visual Composer is installed
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			// Display notice that Visual Compser is required
			add_action( 'admin_notices', array( $this, 'showVcVersionNotice' ) );

			return;
		}

		/*
		Add your Visual Composer logic here.
		Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.

		More info: http://kb.wpbakery.com/index.php?title=Vc_map
		*/
		vc_map( array(
			"name"        => __( $this->title, $this->textdomain ),
			"description" => __( $this->description, $this->textdomain ),
			"base"        => $this->shortcode_name,
			"class"       => "",
			"controls"    => "full",
			"icon"        => plugins_url( 'assets/aislin-vc-icon.png', __FILE__ ),
			// or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
			"category"    => __( 'Aislin', 'js_composer' ),
			//'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
			//'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
			"params"      => array(
				array(
					'type'        => 'textfield',
					'holder'      => '',
					'class'       => '',
					'heading'     => __( 'Depth', $this->textdomain ),
					'param_name'  => 'depth',
					'value'       => __( '3', $this->textdomain ),
					'description' => __( 'Depth of the menu.', $this->textdomain )
				),
				array(
					'type'        => 'dropdown',
					'holder'      => '',
					'class'       => '',
					'heading'     => __( 'Menu', $this->textdomain ),
					'param_name'  => 'menu',
					'admin_label' => true,
					'value'       => array_flip( get_registered_nav_menus() ),
				),
				array(
					'type'        => 'dropdown',
					'holder'      => '',
					'class'       => '',
					'heading'     => __( 'Container', $this->textdomain ),
					'param_name'  => 'container',
					'value'       => array(
						'div'   => 'div',
						'nav'   => 'nav',
						'false' => 'false',
					),
					'description' => __( 'Float.', $this->textdomain )
				),
				array(
					'type'       => 'textfield',
					'holder'     => '',
					'class'      => '',
					'heading'    => __( 'Container Class', $this->textdomain ),
					'param_name' => 'container_class',
					'value'      => '',
				),
				array(
					'type'       => 'textfield',
					'holder'     => '',
					'class'      => '',
					'heading'    => __( 'Container ID', $this->textdomain ),
					'param_name' => 'container_id',
					'value'      => '',
				),
				array(
					'type'       => 'textfield',
					'holder'     => '',
					'class'      => '',
					'heading'    => __( 'Menu Class', $this->textdomain ),
					'param_name' => 'menu_class',
					'value'      => __( 'sf-menu', $this->textdomain ),
				),
				array(
					'type'        => 'dropdown',
					'holder'      => '',
					'class'       => '',
					'heading'     => __( 'Position', $this->textdomain ),
					'param_name'  => 'position',
					'value'       => array(
						'Left'   => 'vc_pull-left',
						'Right'  => 'vc_pull-right',
						'Center' => 'vc_txt_align_center',
					),
					'description' => __( 'Float.', $this->textdomain )
				),
			)
		) );
	}

	/*
	Shortcode logic how it should be rendered
	*/
	public function render( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'depth'           => 3,
			'menu'            => 'primary_navigation',
			'container'       => 'div',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'sf-menu',
			'position'        => 'vc_pull-left',
		), $atts ) );

		ob_start();


		$args = array(
			'theme_location'  => $menu,
			'menu_class'      => $menu_class,
			'depth'           => $depth,
			'container'       => $container != 'false' ? $container : false,
			'container_class' => $container_class . ' ' . $position,
			'container_id'    => $container_id,
		);

		wp_nav_menu( $args );

		$content = ob_get_clean();

		return $content;
	}

	/*
	Load plugin css and javascript files which you may need on front end of your site
	*/
	public function loadCssAndJs() {
		wp_register_style( 'vc_extend_style', plugins_url( 'assets/vc_extend.css', __FILE__ ) );
		wp_enqueue_style( 'vc_extend_style' );

		// If you need any javascript files on front end, here is how you can load them.
		//wp_enqueue_script( 'vc_extend_js', plugins_url('assets/vc_extend.js', __FILE__), array('jquery') );
	}

	/*
	Show notice if your plugin is activated but Visual Composer is not
	*/
	public function showVcVersionNotice() {
		$plugin_data = get_plugin_data( __FILE__ );
		echo '
        <div class="updated">
          <p>' . sprintf( __( '<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', $this->textdomain ), $plugin_data['Name'] ) . '</p>
        </div>';
	}
}

// Finally initialize code
new SCP_Menu();
