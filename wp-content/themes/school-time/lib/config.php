<?php
/**
 * Configuration values
 */
define( 'SCHOOL_TIME_THEME_OPTION_NAME', 'school_time_options' );
define( 'SCHOOL_TIME_THEME_NAME', 'school_time' );
// Length in words for excerpt_length filter (http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length)
// This is just theme default value - it is overridden from theme options
define( 'POST_EXCERPT_LENGTH', 40 );

add_theme_support( 'title-tag' );

/**
 * Enable theme features
 */
// add_theme_support( 'wheels-gallery' ); // Custom [gallery]

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}

/**
 * Sensei Support Declaration
 */
add_action( 'after_setup_theme', 'school_time_declare_sensei_support' );
function school_time_declare_sensei_support() {
	add_theme_support( 'sensei' );
}

/**
 * Woocommerce Support Declaration
 */
add_theme_support( 'woocommerce' );

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'school_time_vc_set_as_theme' );
function school_time_vc_set_as_theme() {
	vc_set_as_theme(true);
}

/**
 * Layer Slider
 */
add_action('layerslider_ready', 'my_layerslider_overrides');
function my_layerslider_overrides() {
	// Disable auto-updates
	$GLOBALS['lsAutoUpdateBox'] = false;
	update_option('layerslider-authorized-site', true);
}

/**
 * Ultimate Addons for Visual Composer
 */
define('BSF_PRODUCTS_NOTICES', false);
