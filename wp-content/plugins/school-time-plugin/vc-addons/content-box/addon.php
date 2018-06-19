<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Scp_Content_Box {

	protected $name = 'Content Box';
	protected $namespace = 'scp_content_box';
	protected $textdomain = SCP_TEXT_DOMAIN;

	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'integrateWithVC' ) );

		// Use this when creating a shortcode addon
		add_shortcode( $this->namespace, array( $this, 'render' ) );

		// Register CSS and JS
		add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'loadCssAndJs' ) );

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
			'name'             => esc_html( $this->name, $this->textdomain ),
			'description'      => '',
			'base'             => $this->namespace,
			'class'            => '',
			'controls'         => 'full',
//			'is_container'     => true,
			'js_view'          => 'VcColumnView',
			'as_parent'        => array( 'except' => $this->namespace ),
			'icon'             => plugins_url( 'assets/aislin-vc-icon.png', __FILE__ ),
			// or css class name which you can reffer in your css file later. Example: 'vc_extend_my_class'
			'category'         => __( 'Aislin', $this->textdomain ),
			// 'admin_enqueue_js' => array( plugins_url( 'assets/admin-theme-icon.js', __FILE__ ) ),
			// This will load js file in the VC backend editor
			//'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
			'params'           => array(
				array(
					'type'        => 'vc_link',
					'heading'     => __( 'URL (Link)', 'js_composer' ),
					'param_name'  => 'link',
					'description' => __( 'Add link to icon.', 'js_composer' ),
				),
				array(
					'type'        => 'textfield',
					'param_name'  => 'el_class',
					'heading'     => __( 'Extra class name', $this->textdomain ),
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', $this->textdomain ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS box', 'js_composer' ),
					'param_name' => 'css',
					'group'      => __( 'Design Options', 'js_composer' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Hover Bg Color', $this->textdomain ),
					'param_name'  => 'hover_bg_color',
					'description' => __( 'If color is not set, theme accent color will be used.', $this->textdomain ),
					'group'       => __( 'Design Options', 'js_composer' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Box Shadow Color', $this->textdomain ),
					'param_name'  => 'box_shadow_color',
					'description' => __( 'If color is not set, theme accent color will be used.', $this->textdomain ),
					'group'       => __( 'Design Options', 'js_composer' ),
				),
			)
		) );
	}


	/*
	Shortcode logic how it should be rendered
	*/
	public function render( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'link'             => '',
			'hover_bg_color'   => '',
			'box_shadow_color' => '',
			'css'              => '',
			'el_class'         => '',
		), $atts ) );
		// $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content

		$class_to_filter = 'wh-content-box';
		$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter . ' ' . $el_class, $this->namespace, $atts );

//		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wh-theme-icon ' . $el_class, $this->namespace, $atts );


		$link     = vc_build_link( $link );
		$a_href   = $link['url'];
		$a_title  = $link['title'];
		$a_target = $link['target'];

		$icon_style = '';


		if ( $icon_style ) {
			$icon_style = 'style="' . $icon_style . '"';
		}

		ob_start();


		?>

		<div class="<?php echo esc_attr( $css_class ); ?>" <?php echo $icon_style; ?>>
			<?php if ( $a_href ) : ?>
				<a class="wh-content-box-link"
				   href="<?php echo esc_attr( $a_href ); ?>"
					<?php if ( $a_title ) : ?>
						title="<?php echo esc_attr( $a_title ); ?>"
					<?php endif; ?>
					<?php if ( $a_target ) : ?>
						target="<?php echo esc_attr( $a_target ); ?>"
					<?php endif; ?>
					<?php echo $icon_style; ?>
					></a>
			<?php endif; ?>

			<?php echo do_shortcode( $content ); ?>
		</div>



		<?php
		$content = ob_get_clean();

		return $content;
	}

	/*
	Load plugin css and javascript files which you may need on front end of your site
	*/
	public function loadCssAndJs() {
		// wp_register_style( 'school-time-icons', get_template_directory_uri() . '/assets/css/school-time-icons.css', false );

		// wp_enqueue_style( 'school-time-icons' );
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
new Scp_Content_Box();

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_scp_content_box extends WPBakeryShortCodesContainer {
	}
}
