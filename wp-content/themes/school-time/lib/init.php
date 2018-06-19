<?php

add_action( 'after_setup_theme', 'school_time_setup' );
add_action( 'widgets_init', 'school_time_widgets_init' );

add_action('admin_head', 'school_time_custom_fonts');

function school_time_custom_fonts() {
	echo '<style>
    .redux-notice {
        display: none;
    }
  </style>';
}


if ( ! function_exists( 'school_time_setup' ) ) {

	function school_time_setup() {

		add_filter('school_time_alt_buttons', 'school_time_add_to_alt_button_list');

		require_once get_template_directory() . '/lib/redux/redux-settings.php';
		require_once get_template_directory() . '/lib/redux/options.php';
		require_once get_template_directory() . '/lib/metaboxes.php';

		// Make theme available for translation
		load_theme_textdomain( 'school-time', get_template_directory() . '/languages' );

		// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
		register_nav_menus( array(
			'primary_navigation' => esc_html__( 'Primary Navigation', 'school-time' ),
		) );
		register_nav_menus( array(
			'secondary_navigation' => esc_html__( 'Secondary Navigation', 'school-time' ),
		) );
		register_nav_menus( array(
			'top_navigation' => esc_html__( 'Top Navigation', 'school-time' ),
		) );
		register_nav_menus( array(
			'one_page_navigation_1' => esc_html__( 'One Page Navigation 1', 'school-time' ),
		) );
		register_nav_menus( array(
			'one_page_navigation_2' => esc_html__( 'One Page Navigation 2', 'school-time' ),
		) );
		register_nav_menus( array(
			'one_page_navigation_3' => esc_html__( 'One Page Navigation 3', 'school-time' ),
		) );

		// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150, false );

		// Add_image_size('wh-medium', 300, 9999); // 300px wide (and unlimited height)
		add_image_size( 'wh-featured-image', 895, 430, true );
		add_image_size( 'wh-medium', 768, 510, true );
		add_image_size( 'wh-medium-alt', 768, 410, true );
		add_image_size( 'wh-square', 768, 768, true );


		// Add post formats (http://codex.wordpress.org/Post_Formats)
		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat'
		) );
		add_theme_support( 'automatic-feed-links' );

		// Tell the TinyMCE editor to use a custom stylesheet
		// add_editor_style('/assets/css/editor-style.css');

		school_time_register_custom_thumbnail_sizes();

	}
}

function school_time_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Primary', 'school-time' ),
		'id'            => 'wheels-sidebar-primary',
		'before_widget' => '<div class="widget %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Child Pages', 'school-time' ),
		'id'            => 'wheels-sidebar-child-pages',
		'before_widget' => '<div class="widget %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

}

function school_time_add_to_alt_button_list($alt_button_arr) {

	$alt_button_arr[] = '.yith-wcwl-add-button a';

	return $alt_button_arr;

}
