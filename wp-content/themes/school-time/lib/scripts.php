<?php

/**
 * Enqueue scripts and stylesheets
 */

add_action( 'wp_enqueue_scripts', 'school_time_scripts', 100 );
add_action( 'wp_enqueue_scripts', 'wheels_add_compiled_style', 999 );
add_action( 'wp_head', 'school_time_set_js_global_var' );

function school_time_scripts() {
	wp_enqueue_style( 'bricklayer.groundwork', get_template_directory_uri() . '/assets/css/groundwork-responsive.css', false );
	wp_enqueue_style( 'style.default', get_stylesheet_uri(), false );
	wp_enqueue_style( 'school-time-icons', get_template_directory_uri() . '/assets/css/school-time-icons.css', false );



	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.7.0.min.js', array(), null, false );
	wp_enqueue_script( 'school_time_plugins', get_template_directory_uri() . '/assets/js/wheels-plugins.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'school_time_scripts', get_template_directory_uri() . '/assets/js/wheels-main.min.js', array( 'jquery' ), null, true );

	$is_rtl = apply_filters( 'school_time_filter_is_rtl' , school_time_get_option( 'is-rtl', false ) );
	if ( $is_rtl ) {
		wp_enqueue_style( 'school_time_rtl', get_template_directory_uri() . '/assets/css/rtl.css', false );
		wp_deregister_script( 'wpb_composer_front_js' );
		wp_enqueue_script( 'wpb_composer_front_js', get_template_directory_uri() . '/assets/js/rtl.js', array( 'jquery' ), WPB_VC_VERSION, true );
	}
}

if ( ! function_exists( 'wheels_add_compiled_style' ) ) {

	function wheels_add_compiled_style() {
		$upload_dir = wp_upload_dir();

		$opt_name = SCHOOL_TIME_THEME_OPTION_NAME;

		if ( file_exists( $upload_dir['basedir'] . '/' . $opt_name . '_style.css' ) ) {
			$upload_url = $upload_dir['baseurl'];
			if ( strpos( $upload_url, 'https' ) !== false ) {
				$upload_url = str_replace( 'https:', '', $upload_url );
			} else {
				$upload_url = str_replace( 'http:', '', $upload_url );
			}
			wp_enqueue_style( $opt_name . '_style', $upload_url . '/' . $opt_name . '_style.css', false );
		} else {
			wp_enqueue_style( $opt_name . '_style', get_template_directory_uri() . '/assets/css/wheels_options_style.css', false );
		}
	}
}

function school_time_set_js_global_var() {
	$scroll_to_top_text = school_time_get_option( 'scroll-to-top-text', '' );
	?>
	<script>
		var wheels = wheels ||
			{
				siteName: "<?php bloginfo('name'); ?>",
				data: {
					useScrollToTop: <?php echo json_encode( filter_var( school_time_get_option( 'use-scroll-to-top', true ), FILTER_VALIDATE_BOOLEAN ) ); ?>,
					useStickyMenu: <?php echo json_encode( filter_var( school_time_get_option( 'main-menu-use-menu-is-sticky', true ), FILTER_VALIDATE_BOOLEAN ) ); ?>,
					scrollToTopText: <?php echo json_encode( $scroll_to_top_text ); ?>,
					isAdminBarShowing: <?php echo is_admin_bar_showing() ? 'true' : 'false'; ?>,
					initialWaypointScrollCompensation: <?php echo json_encode( school_time_get_option( 'main-menu-initial-waypoint-compensation', 120 ) ); ?>
				}
			};
	</script>
<?php
}
