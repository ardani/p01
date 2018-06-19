<?php
/**
 * Plugin Name: School Time
 * Plugin URI:  http://wordpress.org/plugins
 * Description: School Time theme helper plugin
 * Version:     1.2.4
 * Author:      Aislin Themes
 * Author URI:  http://themeforest.net/user/Aislin/portfolio
 * License:     GPLv2+
 * Text Domain: chp
 * Domain Path: /languages
 */
define( 'SCP_PLUGIN_VERSION', '1.2.4' );
define( 'SCP_PLUGIN_NAME', 'School Time' );
define( 'SCP_PLUGIN_PREFIX', 'scp_' );
define( 'SCP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SCP_PLUGIN_PATH', dirname( __FILE__ ) . '/' );
define( 'SCP_TEXT_DOMAIN', 'scp_school_time' );

register_activation_hook( __FILE__, 'scp_activate' );
register_deactivation_hook( __FILE__, 'scp_deactivate' );

add_action( 'plugins_loaded', 'scp_init' );
add_action( 'widgets_init', 'scp_register_wp_widgets' );
add_action( 'wp_enqueue_scripts', 'scp_enqueue_scripts', 100 );
add_action( 'admin_init', 'scp_register_wp_widgets' );
add_action( 'admin_init', 'scp_vc_editor_set_post_types', 11 );
add_action( 'wp_head', 'scp_set_js_global_var' );

add_filter( 'pre_get_posts', 'scp_portfolio_posts' );
add_filter( 'widget_text', 'do_shortcode' );

require_once 'shortcodes.php';

function scp_clean( $item ) {
	$firstClosingPTag = substr( $item, 0, 4 );
	$lastOpeningPTag  = substr( $item, - 3 );

	if ( $firstClosingPTag == '</p>' ) {
		$item = substr( $item, 4 );
	}

	if ( $lastOpeningPTag == '<p>' ) {
		$item = substr( $item, 0, - 3 );
	}

	return $item;
}


function scp_init() {
	scp_add_extensions();
	scp_add_vc_custom_addons();

	require_once 'extensions/CPT.php';
	$layout_blocks = new CPT('layout_block', array(
		'supports' => array('title', 'editor', 'revisions')
	));
}

function scp_activate() {
	scp_init();
	flush_rewrite_rules();
}

function scp_deactivate() {

}

function scp_add_vc_custom_addons() {
	require_once 'vc-addons/content-box/addon.php';
	require_once 'vc-addons/video-popup/addon.php';
	require_once 'vc-addons/logo/addon.php';
	require_once 'vc-addons/theme-button/addon.php';
	require_once 'vc-addons/theme-icon/addon.php';
	require_once 'vc-addons/theme-map/addon.php';
//	require_once 'vc-addons/menu/addon.php';
//	require_once 'vc-addons/ribbon/ribbon.php';
	require_once 'vc-addons/events/events.php';
	require_once 'vc-addons/post-list/addon.php';
	require_once 'vc-addons/teachers/addon.php';
//	require_once 'vc-addons/our-process/addon.php';
//	require_once 'vc-addons/countdown/addon.php';
}

function scp_add_extensions() {

	require_once 'extensions/teacher-post-type/teacher-post-type.php';

	if ( ! scp_is_plugin_activating( 'breadcrumb-trail/breadcrumb-trail.php' ) && ! function_exists( 'breadcrumb_trail_theme_setup' ) ) {
		require_once 'extensions/breadcrumb-trail/breadcrumb-trail.php';
	}
	if ( ! scp_is_plugin_activating( 'smart-grid-gallery/smart-grid-gallery.php' ) && ! class_exists( 'SmartGridGallery' ) ) {
		require_once 'extensions/smart-grid-gallery/smart-grid-gallery.php';
	}

	/**
	 * Events Settings the first time
	 */
	add_option( 'tribe_events_calendar_options', array(
		'tribeEventsTemplate' => 'template-fullwidth.php',
	) );
}

function scp_get_wheels_option( $option_name, $default = false ) {
	if ( function_exists( 'school_time_get_option' ) ) {
		return school_time_get_option( $option_name, $default );
	}

	return $default;
}

function scp_set_js_global_var() {
	?>
	<script>
		var school_time_plugin = school_time_plugin ||
			{
				data: {
					vcWidgets: {}
				}
			};
	</script>
<?php
}

function scp_register_wp_widgets() {
	require_once 'wp-widgets/SCP_Latest_Posts_Widget.php';
	require_once 'wp-widgets/SCP_Contact_Info_Widget.php';
	require_once 'wp-widgets/SCP_Working_Hours_Widget.php';
	require_once 'wp-widgets/twitter-widget/recent-tweets-widget.php';
}

function scp_portfolio_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( is_tax() && isset( $query->tax_query ) && $query->tax_query->queries[0]['taxonomy'] == 'portfolio_category' ) {
		$query->set( 'posts_per_page', 10 );

		return;
	}
}

function scp_vc_editor_set_post_types() {
	$opt_name = 'scp_vc_post_types_set';
	$is_set   = (int) get_option( $opt_name );
	if ( ! $is_set ) {

		if ( function_exists( 'vc_editor_post_types' ) ) {

			$post_types = vc_editor_post_types();
			if ( ! in_array( 'layout_block', $post_types ) ) {
				$post_types[] = 'layout_block';
			}
			if ( ! in_array( 'course', $post_types ) ) {
				$post_types[] = 'course';
			}
			if ( ! in_array( 'teacher', $post_types ) ) {
				$post_types[] = 'teacher';
			}
			if ( ! in_array( 'events', $post_types ) ) {
				$post_types[] = 'events';
			}
			vc_editor_set_post_types( $post_types );
			add_option( $opt_name, true );
		}
	}
}

function scp_enqueue_scripts() {
//     wp_enqueue_style('linp-css', SCP_PLUGIN_URL . '/public/css/scp-style.css', false);
	wp_enqueue_script( 'linp-main-js', SCP_PLUGIN_URL . '/public/js/linp-main.js', array( 'jquery' ), false, true );
}

function scp_is_plugin_activating( $plugin ) {
	if ( isset( $_GET['action'] ) && $_GET['action'] == 'activate' && isset( $_GET['plugin'] ) ) {
		if ( $_GET['plugin'] == $plugin ) {
			return true;
		}
	}

	return false;
}

function scp_fpc( $filename, $filecontent ) {
	file_put_contents( $filename, $filecontent );
}

function scp_fgc( $filename ) {
	return file_get_contents( $filename );
}

function scp_sanitize_size( $value, $default = 'px' ) {

	return preg_match( '/(px|em|rem|\%|pt|cm)$/', $value ) ? $value : ( (int) $value ) . $default;
}