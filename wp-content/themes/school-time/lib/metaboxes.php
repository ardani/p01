<?php


add_filter( 'rwmb_meta_boxes', 'school_time_register_meta_boxes' );

function school_time_register_meta_boxes( $meta_boxes ) {
	$prefix     = 'school_time_';

	/**
	 * Single Course
	 */

	$meta_boxes[] = array(
		'title'  => 'Course Custom Fields',
		'pages'  => array( 'course' ), // can be used on multiple CPTs
		'fields' => array(
			array(
				'id'   => $prefix . 'course_duration',
				'type' => 'text',
				'name' => esc_html__( 'Course Duration', 'school-time' ),
			),
			array(
				'id'   => $prefix . 'sidebar_text',
				'type' => 'textarea',
				'rows' => '15',
				'name' => esc_html__( 'Sidebar Text', 'school-time' ),
			),
		)
	);


	/**
	 * Single Teacher
	 */

	$meta_boxes[] = array(
		'title'  => 'Teacher Settings',
		'pages'  => array( 'teacher' ), // can be used on multiple CPTs
		'fields' => array(
			array(
				'id'   => $prefix . 'job_title',
				'type' => 'text',
				'name' => esc_html__( 'Job Title', 'school-time' ),
				'desc' => esc_html__( 'This will be printed in Teacher Widget', 'school-time' ),
			),
			array(
				'id'   => $prefix . 'location',
				'type' => 'text',
				'name' => esc_html__( 'Location', 'school-time' ),
				'desc' => esc_html__( 'Printed only on teacher single page', 'school-time' ),
			),
			array(
				'id'   => $prefix . 'summary',
				'type' => 'wysiwyg',
				'name' => esc_html__( 'Summary', 'school-time' ),
				'desc' => esc_html__( 'This will be printed in Teacher Widget', 'school-time' ),
			),
			array(
				'id'   => $prefix . 'social_meta',
				'type' => 'textarea',
				'name' => esc_html__( 'Social Icon Shortcodes', 'school-time' ),
				'desc' => esc_html__( 'This will be printed in Teacher Widget', 'school-time' ),
			),
		)
	);


	/**
	 * Pages
	 */

	$menus       = get_registered_nav_menus();
	$menus_array = array();

	foreach ( $menus as $location => $description ) {
		$menus_array[ $location ] = $description;
	}

	$layout_blocks = get_posts(array('post_type' => 'layout_block'));
	$layout_blocks_array = array();
	foreach ( $layout_blocks as $layout_block ) {
		$layout_blocks_array[ $layout_block->ID ] = $layout_block->post_title;
	}


	$meta_boxes[] = array(
		'title'  => 'Page Settings',
		'pages'  => array( 'page' ), // can be used on multiple CPTs
		'fields' => array(
			array(
				'id'   => $prefix . 'use_one_page_menu',
				'type' => 'checkbox',
				'name' => esc_html__( 'Use One Page Menu', 'school-time' ),
				'desc' => esc_html__( 'When using one page menu functionality you need to add an extra class on each vc row you want to link to a menu item. Also you need to create a menu in Appearance/Menus and create custom links where each link url has the same name as the row class prefixed with # sign',
					'school-time' ),
			),
			array(
				'id'          => $prefix . 'one_page_menu_location',
				'type'        => 'select',
				'name'        => esc_html__( 'Select One Page Menu Location', 'school-time' ),
				'desc'        => esc_html__( 'Used only if Use One Page Menu is checked.', 'school-time' ),
				'options'     => $menus_array,
				'placeholder' => 'Select Menu Location',
			),
			array(
				'id'               => $prefix . 'custom_logo',
				'type'             => 'image_advanced',
				'name'             => esc_html__( 'Custom Logo', 'school-time' ),
				'desc'             => esc_html__( 'Used it to override the logo from theme options. This works well when using Transparent Header Template.', 'school-time' ),
				'max_file_uploads' => 1,
			),
			array(
				'id'          => $prefix . 'top_bar_layout_block',
				'type'        => 'select',
				'name'        => esc_html( 'Top Bar Layout Block', 'wheels' ),
				'desc'        => esc_html( 'Override Theme Options settings.', 'wheels' ),
				'options'     => $layout_blocks_array,
				'placeholder' => esc_html( 'Default' ),
			),
			array(
				'id'          => $prefix . 'footer_layout_block',
				'type'        => 'select',
				'name'        => esc_html( 'Footer Layout Block', 'wheels' ),
				'desc'        => esc_html( 'Override Theme Options settings.', 'wheels' ),
				'options'     => $layout_blocks_array,
				'placeholder' => esc_html( 'Default' ),
			),
		)
	);

	return $meta_boxes;
}
