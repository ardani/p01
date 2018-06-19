<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class ST_Team_Member {

	protected $shortcode_name = 'st_team_member';
	protected $title = 'Team Member';
	protected $description = '';
	protected $textdomain = 'vc_extend';

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

		global $_wp_additional_image_sizes;
		$thumbnail_sizes         = array();
		$thumbnail_sizes['Full'] = 'full';
		foreach ( $_wp_additional_image_sizes as $name => $settings ) {
			$thumbnail_sizes[ $name . ' (' . $settings['width'] . 'x' . $settings['height'] . ')' ] = $name;
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
			"category"    => __( 'Aislin', $this->textdomain ),
			//'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
			//'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
			"params"      => array(
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Name', $this->textdomain ),
					'param_name' => 'name',
				),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Job Position', $this->textdomain ),
					'param_name' => 'job_position',
				),
				array(
					'type'        => 'attach_image',
					'heading'     => __( 'Thumbnail', $this->textdomain ),
					'param_name'  => 'image',
					'value'       => '',
					'description' => __( 'Select image from media library.', $this->textdomain ),
					'dependency'  => array(
						'value' => 'media_library',
					),
				),
				array(
					'type'       => 'dropdown',
					'class'      => '',
					'heading'    => __( 'Image Size', $this->textdomain ),
					'param_name' => 'img_size',
					'value'      => $thumbnail_sizes,
				),
				array(
					"type"        => "textarea_html",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Content", $this->textdomain ),
					"param_name"  => "content",
					"value"       => __( "<p>I am test text block. Click edit button to change this text.</p>", $this->textdomain ),
					"description" => __( "Enter your content.", $this->textdomain )
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Extra class name', 'js_composer' ),
					'param_name'  => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS box', 'js_composer' ),
					'param_name' => 'css',
					'group'      => __( 'Design Options', 'js_composer' ),
				),
			)
		) );
	}

	/*
	Shortcode logic how it should be rendered
	*/
	public function render( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'name'         => '',
			'job_position' => '',
			'image'        => '',
			'img_size'     => 'wh-medium',
			'el_class'     => '',

		), $atts ) );
		$content = wpb_js_remove_wpautop( $content, true ); // fix unclosed/unwanted paragraph tags in $content


		$default_src = vc_asset_url( 'vc/no_image.png' );

		$img_id = preg_replace( '/[^\d]/', '', $image );

		$img = wpb_getImageBySize( array(
			'attach_id'  => $img_id,
			'thumb_size' => $img_size,
			'class'      => 'vc_single_image-img',
		) );

		if ( ! $img ) {
			$img['thumbnail'] = '<img class="vc_img-placeholder vc_single_image-img" src="' . $default_src . '" />';
		}

		$wrapperClass = 'vc_single_image-wrapper';

		$html = '<div class="' . $wrapperClass . '">' . $img['thumbnail'] . '</div>';

		$name = '<h2 class="name">' . $name . '</h2>';
		$job_position = '<h3 class="job-position">' . $job_position . '</h3>';

		$html .= $name . $job_position . $content;

		return $html;
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
new ST_Team_Member();
