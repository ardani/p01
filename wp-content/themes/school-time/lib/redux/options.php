<?php

$opt_name = SCHOOL_TIME_THEME_OPTION_NAME;

if ( ! class_exists('Redux')) {
	return;
}

$other_settings = '';
if ( function_exists( 'scp_fgc') ) {
	$other_settings = scp_fgc( get_template_directory() . '/lib/redux/css/other-settings/vars.scss' );
}
// ----------------------------------
// -> General
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'section-general',
	'title'  => esc_html__( 'General Settings', 'school-time' ),
	'icon'   => 'el-icon-home',
	// 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(
//		array(
//			'id'       => 'google-analytics-code',
//			'type'     => 'ace_editor',
//			'title'    => esc_html__( 'Tracking Code', 'school_time' ),
//			'subtitle' => esc_html__( 'Paste your Google Analytics (or other) tracking code here. This will be added into the head of your theme.',
//				'school_time' ),
//			'mode'     => 'plain_text',
//			'theme'    => 'monokai',
//		),
		array(
			'id'       => 'custom-js-code',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'JS Code', 'school-time' ),
			'subtitle' => esc_html__( 'Paste your JS code here.', 'school-time' ),
			'mode'     => 'javascript',
			'theme'    => 'monokai',
			'default'  => "jQuery(document).ready(function(){\n\n});"
		),
		array(
			'id'          => 'custom-thumbnail-sizes',
			'type'        => 'ace_editor',
			'title'       => esc_html__( 'Custom Thumbnail Sizes', 'school-time' ),
			'subtitle'    => esc_html__( 'Pipe separated list of custom thumbnail size names and sizes.', 'school-time' ),
			'description' => esc_html__( 'Please use this format: <br><strong>custom-thumbnail-size:500x500|another-custom-thumbnail-size:320x150</strong>. <br>No spaces allowed. Thumnail Sizes you register here will only be applied to any new image from now on. If you wish to apply them on any of the old images we recomend using <a href="http://wordpress.org/plugins/regenerate-thumbnails/">Regenerate Thumbnails Plugin</a>',
				'school-time' ),
			'mode'        => 'text',
			'theme'       => 'monokai',
			'default'     => ""
		),
		array(
			'id'       => 'top-bar-layout-block',
			'type'     => 'select',
			'title'    => esc_html__('Top Bar Layout Block', 'school-time'),
			'data'     => 'posts',
			'args'     => array('post_type' => array('layout_block')),
		),
		array(
			'id'       => 'footer-layout-block',
			'type'     => 'select',
			'title'    => esc_html__('Footer Layout Block', 'school-time'),
			'data'     => 'posts',
			'args'     => array('post_type' => array('layout_block')),
		),
	),
) );
// -> End General


// ----------------------------------
// -> Styling
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'section-styling',
	'icon'   => 'el-icon-website',
	'title'  => esc_html__( 'Styling', 'school-time' ),
	'fields' => array(
		array(
		    'id'       => 'global-accent-color',
		    'type'     => 'color',
		    'title'    => esc_html__('Global Accent Color', 'school-time'),
		    'desc'     => esc_html__('This color will be used accross the site.', 'school-time'),
			'compiler' => 'true',
		    'default'  => '#ffc000',
		    'validate' => 'color',
		),
		// array(
		// 	'id'      => 'color-scheme',
		// 	'type'    => 'image_select',
		// 	'presets' => true,
		// 	'title'   => esc_html__( 'Color Scheme', 'wheels' ),
		// 	'desc'    => esc_html__( 'Choose one color scheme preset below. You are free to alter the preset to your liking. Whenever you wish to return to original preset colors just click on one of the preset icons again. Beware that all settings will be reset to preset colors selected (excerpt for logo and any textarea content).',
		// 		'wheels' ),
		// 	'options' => $presets,
		// 	'default' => '1'
		// ),
		// array(
		// 	'id'      => 'color-scheme-stylesheet',
		// 	'type'    => 'select',
		// 	'title'   => esc_html__( 'Stylesheet', 'wheels' ),
		// 	'desc'    => esc_html__( 'Select which stylesheet you want to include.', 'wheels' ),
		// 	'options' => $color_scheme_stylesheets,
		// 	'default' => $default_color_scheme_stylesheet,
		// ),
		array(
			'id'       => 'custom-css',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'Custom CSS Code', 'school-time' ),
			'subtitle' => esc_html__( 'Paste your CSS code here.', 'school-time' ),
			'compiler' => 'true',
			'mode'     => 'css',
			'theme'    => 'monokai',
			'default'  => '',
			'options'  => array(
				'minLines'=> 50
			),
		),
	)
) );
// -> End Styling

// ----------------------------------
// -> Body
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'section-body',
	'title'  => esc_html__( 'Body', 'school-time' ),
	'icon'   => 'el-icon-check-empty',
	'fields' => array(
		array(
			'id'       => 'container-width',
			'type'     => 'dimensions',
			'units'    => array( 'px' ),
			'title'    => esc_html__( 'Container Width', 'school-time' ),
			'compiler' => array( '.cbp-container', '#tribe-events-pg-template' ),
			'height'   => false,
			'mode'     => 'max-width',
			'default'  => array(
				'width' => '980',
				'units' => 'px',
			),
		),
		array(
			'id'       => 'boxed-outer-container-width',
			'type'     => 'dimensions',
			'units'    => array( 'px' ),
			'title'    => esc_html__( 'Boxed Outer Container Width', 'school-time' ),
			'subtitle' => esc_html__( 'This is only applicable when "Boxed" page template is used.', 'school-time' ),
			'compiler' => array( '.wh-main-wrap' ),
			'height'   => false,
			'mode'     => 'max-width',
			'default'  => array(
				'width' => '1100',
				'units' => 'px',
			),
		),
		array(
			'id'       => 'body-background',
			'type'     => 'background',
			'compiler' => array( 'body' ),
			'title'    => esc_html__( 'Background', 'school-time' ),
		),
		array(
			'id'         => 'body-typography',
			'type'       => 'typography',
			'title'      => esc_html__( 'Font', 'school-time' ),
			'subtitle'   => esc_html__( 'Specify the body font properties.', 'school-time' ),
			'google'     => true,
			'text-align' => false,
			'compiler'   => array( 'body' ),
			'default'    => array(
				'color'       => '#333',
				'font-size'   => '14px',
				'line-height' => '20px',
				'font-family' => 'Arial,Helvetica,sans-serif',
				'font-weight' => 'Normal',
			),
		),
		array(
			'id'       => 'body-link-color',
			'type'     => 'link_color',
			'title'    => esc_html__( 'Link Color', 'school-time' ),
			'compiler' => array( 'a' ),
			'default'  => array(
				'regular' => '#353434',
				'hover'   => '#585757',
				'active'  => '#353434',
			)
		),
//		array(
//		    'id'       => 'body-hr',
//		    'type'     => 'border',
//		    'title'    => esc_html__('HR', 'school_time'),
//		    'subtitle' => esc_html__('Style body HR element', 'school_time'),
//		    'compiler' => array(
//			    'hr',
//			    '.wh-sidebar .widget hr',
//			    '.linp-post-list hr',
//			    '.wh-content .linp-post-list hr',
//                '.wh-separator',
//                '.wh-content hr.wh-separator',
//		    ),
//		    'bottom' => false,
//		    'right' => false,
//		    'left' => false,
//		    'default'  => array(
//		        'border-color'  => '#1e73be',
//		        'border-style'  => 'solid',
//		        'border-top'    => '5px',
//		    )
//		),
//		array(
//		    'id'       => 'body-hr-width',
//		    'type'     => 'dimensions',
//		    'units'    => array('em','px','%'),
//		    'title'    => esc_html__('HR Width', 'school_time'),
//		    'height'    => false,
//		    'compiler' => array(
//			    'hr',
//			    '.wh-sidebar .widget hr',
//			    '.linp-post-list hr',
//                '.wh-content .linp-post-list hr',
//                '.wh-separator',
//                '.wh-content hr.wh-separator',
//		    ),
//		    'default'  => array(
//		        'width'   => '70',
//		        'units'  => 'px'
//		    ),
//		),
//		array(
//		    'id'             => 'body-hr-spacing',
//		    'type'           => 'spacing',
//		    'compiler' => array(
//			    'hr',
//			    '.wh-sidebar .widget hr',
//			    '.linp-post-list hr',
//                '.wh-content .linp-post-list hr',
//                '.wh-separator',
//                '.wh-content hr.wh-separator',
//		    ),
//		    'mode'           => 'margin',
//		    'units'          => array('em', 'px'),
//		    'units_extended' => 'false',
//		    'title'          => esc_html__('HR Margin', 'school_time'),
//		    'default'            => array(
//		        'margin-top'     => '15px',
//		        'margin-right'   => '0px',
//		        'margin-bottom'  => '15px',
//		        'margin-left'    => '0px',
//		        'units'          => 'px',
//		    )
//		),
		array(
			'id'             => 'main-padding',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-padding' , '#tribe-events-pg-template'),
			'mode'           => 'padding',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Padding', 'school-time' ),
			'desc'    => esc_html__( 'This is where you select a padding for all layout elements. For widgets compiled from a page you need to set the padding on each widget.',
				'school-time' ),
			'default'        => array(
				'padding-top'    => '20px',
				'padding-right'  => '20px',
				'padding-bottom' => '20px',
				'padding-left'   => '20px',
				'units'          => 'px',
			)
		),
	)
) );



Redux::setSection( $opt_name, array(
	'subsection' => true,
	'id'         => 'subsection-body-headings',
	'title'      => esc_html__( 'Headings', 'school-time' ),
	'fields'     => array(
		array(
			'id'         => 'headings-typography-h1',
			'type'       => 'typography',
			'title'      => esc_html__( 'H1', 'school-time' ),
			'google'     => true,
			'text-align' => false,
			'compiler'   => array( 'h1', 'h1 a' ),
			'default'    => array(
				'font-size'   => '48px',
				'line-height' => '52px',
			),
		),
		array(
			'id'             => 'headings-margin-h1',
			'type'           => 'spacing',
			'compiler'       => array( 'h1', 'h1 a' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'H1 Margin', 'school-time' ),
			'default'        => array(
				'margin-top'    => '33px',
				'margin-right'  => 0,
				'margin-bottom' => '33px',
				'margin-left'   => 0,
				'units'         => 'px',
			)
		),
		array(
			'id'         => 'headings-typography-h2',
			'type'       => 'typography',
			'title'      => esc_html__( 'H2', 'school-time' ),
			'google'     => true,
			'text-align' => false,
			'compiler'   => array( 'h2', 'h2 a' ),
			'default'    => array(
				'font-size'   => '30px',
				'line-height' => '34px',
			),
		),
		array(
			'id'             => 'headings-margin-h2',
			'type'           => 'spacing',
			'compiler'       => array( 'h2', 'h2 a' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'H2 Margin', 'school-time' ),
			'default'        => array(
				'margin-top'    => '25px',
				'margin-right'  => 0,
				'margin-bottom' => '25px',
				'margin-left'   => 0,
				'units'         => 'px',
			)
		),
		array(
			'id'         => 'headings-typography-h3',
			'type'       => 'typography',
			'title'      => esc_html__( 'H3', 'school-time' ),
			'google'     => true,
			'text-align' => false,
			'compiler'   => array( 'h3', 'h3 a' ),
			'default'    => array(
				'font-size'   => '22px',
				'line-height' => '24px',
			),
		),
		array(
			'id'             => 'headings-margin-h3',
			'type'           => 'spacing',
			'compiler'       => array( 'h3', 'h3 a' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'H3 Margin', 'school-time' ),
			'default'        => array(
				'margin-top'    => '22px',
				'margin-right'  => 0,
				'margin-bottom' => '22px',
				'margin-left'   => 0,
				'units'         => 'px',
			)
		),
		array(
			'id'         => 'headings-typography-h4',
			'type'       => 'typography',
			'title'      => esc_html__( 'H4', 'school-time' ),
			'google'     => true,
			'text-align' => false,
			'compiler'   => array( 'h4', 'h4 a' ),
			'default'    => array(
				'font-size'   => '20px',
				'line-height' => '24px',
			),
		),
		array(
			'id'             => 'headings-margin-h4',
			'type'           => 'spacing',
			'compiler'       => array( 'h4', 'h4 a' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'H4 Margin', 'school-time' ),
			'default'        => array(
				'margin-top'    => '25px',
				'margin-right'  => 0,
				'margin-bottom' => '25px',
				'margin-left'   => 0,
				'units'         => 'px',
			)
		),
		array(
			'id'         => 'headings-typography-h5',
			'type'       => 'typography',
			'title'      => esc_html__( 'H5', 'school-time' ),
			'google'     => true,
			'text-align' => false,
			'compiler'   => array( 'h5', 'h5 a' ),
			'default'    => array(
				'font-size'   => '18px',
				'line-height' => '22px',
			),
		),
		array(
			'id'             => 'headings-margin-h5',
			'type'           => 'spacing',
			'compiler'       => array( 'h5', 'h5 a' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'H5 Margin', 'school-time' ),
			'default'        => array(
				'margin-top'    => '30px',
				'margin-right'  => 0,
				'margin-bottom' => '30px',
				'margin-left'   => 0,
				'units'         => 'px',
			)
		),
		array(
			'id'         => 'headings-typography-h6',
			'type'       => 'typography',
			'title'      => esc_html__( 'H6', 'school-time' ),
			'google'     => true,
			'text-align' => false,
			'compiler'   => array( 'h6', 'h6 a' ),
			'default'    => array(
				'font-size'   => '16px',
				'line-height' => '20px',
			),
		),
		array(
			'id'             => 'headings-margin-h6',
			'type'           => 'spacing',
			'compiler'       => array( 'h6', 'h6 a' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'H6 Margin', 'school-time' ),
			'default'        => array(
				'margin-top'    => '36px',
				'margin-right'  => 0,
				'margin-bottom' => '36px',
				'margin-left'   => 0,
				'units'         => 'px',
			)
		),
	)
) );
// -> End Body

// ----------------------------------
// -> Header
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'header',
	'title'  => esc_html__( 'Header', 'school-time' ),
	'icon'   => 'el-icon-delicious',
	'fields' => array(
		array(
			'id'       => 'header-background',
			'type'     => 'background',
			'compiler' => array( '.wh-header, .respmenu-wrap' ),
			'title'    => esc_html__( 'Background', 'school-time' ),
			'subtitle' => esc_html__( 'Pick a background color for the header', 'school-time' ),
			'default'  => array(
				'background-color' => '#bfbfbf'
			),
		),
		array(
			'id'       => 'logo',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo', 'school-time' ),
			'url'      => true,
			'mode'     => false, // Can be set to false to allow any media type, or can also be set to any mime type.
			'subtitle' => esc_html__( 'Upload logo', 'school-time' ),

		),
		array(
			'id'       => 'logo-sticky',
			'type'     => 'media',
			'title'    => esc_html__( 'Sticky Menu Logo', 'school-time' ),
			'url'      => true,
			'mode'     => false, // Can be set to false to allow any media type, or can also be set to any mime type.
			'subtitle' => esc_html__( 'If not set Logo will be used in sticky menu.', 'school-time' ),

		),
		array(
			'id'       => 'logo-alt-text',
			'type'     => 'text',
			'title'    => __('Logo Alt Text', 'school-time'),
			'subtitle' => __('This text will be used as alt attribute on logo image.', 'school-time'),
			'default'  => 'logo'
		),
		array(
		    'id'       => 'logo-location',
		    'type'     => 'select',
		    'title'    => esc_html__('Logo Location', 'school-time'),
		    'options'  => array(
		        'main_menu' => 'Main Menu',
		        'no_show' => 'Do not show',
			),
		    'default'  => array('main_menu'),
		),
		array(
			'id'            => 'logo-width',
			'type'          => 'slider',
			'title'         => esc_html__( 'Logo Width/ Menu Width', 'school-time' ),
			'subtitle'      => esc_html__( 'Drag the slider to change logo width.', 'school-time' ),
			'desc'          => esc_html__( 'The grid has 12 steps. If Logo location is set to Main Menu, the menu will take what is left up to 12. If logo is set to 12 menu will also take up 12 and will be put bellow it.',
				'school-time' ),
			'default'       => 3,
			'min'           => 1,
			'step'          => 1,
			'max'           => 12,
			'display_value' => 'label',
		),
		array(
			'id'       => 'logo-width-exact',
			'type'     => 'dimensions',
			'units'    => array('px'),
			'title'    => esc_html__('Logo Width', 'school-time'),
			'desc'     => esc_html__('Set exact logo width', 'school-time'),
			'height'   => false,
			'default'  => array(

			),
		),
		array(
			'id'       => 'logo-sticky-width-exact',
			'type'     => 'dimensions',
			'units'    => array('px'),
			'title'    => esc_html__('Sticky Logo Width', 'school-time'),
			'desc'     => esc_html__('Set exact sticky logo width', 'school-time'),
			'height'   => false,
			'default'  => array(

			),
		),
		array(
			'id'             => 'logo-margin',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-logo' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'right'          => false,
			'left'           => false,
			'bottom'         => false,
			'title'          => esc_html__( 'Logo Margin Top', 'school-time' ),
			'default'        => array(
				'units'          => 'px',
			),

		),
		array(
			'id'       => 'logo-alignment',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Logo Alignment', 'school-time' ),
			'options'  => array(
				'left'   => 'Left',
				'center' => 'Center',
				'right'  => 'Right',
			),
			'default'  => 'left',
		),
		array(
			'id'       => 'main-menu-alignment',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Menu Alignment', 'school-time' ),
			'options'  => array(
				'left'   => 'Left',
				'center' => 'Center',
				'right'  => 'Right',
			),
			'default'  => 'right',
		),
		array(
			'id'      => 'header-padding-override',
			'type'    => 'switch',
			'title'   => esc_html__( 'Override Header Padding', 'school-time' ),
			'default' => false,
			'on'      => 'Yes',
			'off'     => 'No',
		),
		array(
			'id'             => 'header-padding',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-main-menu-bar-wrapper > .cbp-container > div' ),
			'mode'           => 'padding',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Header Padding', 'school-time' ),
			'default'        => array(
				'padding-top'    => '5px',
				'padding-right'  => '20px',
				'padding-bottom' => '5px',
				'padding-left'   => '20px',
				'units'          => 'px',
			),
			'required'       => array(
				array( 'header-padding-override', 'equals', '1' ),
			),

		),
	)
) );

//Redux::setSection( $opt_name, array(
//	'subsection' => true,
//	'id'         => 'subsection-header-top-bar',
//	'title'      => esc_html__( 'Top Bar', 'school_time' ),
//	'fields'     => array(
//		array(
//			'id'       => 'top-bar-use',
//			'type'     => 'switch',
//			'title'    => esc_html__( 'Use Top Bar', 'school_time' ),
//			'default'  => false,
//			'compiler' => 'true',
//			'on'       => 'Yes',
//			'off'      => 'No',
//		),
//		array(
//			'id'       => 'top-bar-background',
//			'type'     => 'background',
//			'compiler' => array( '.wh-top-bar' ),
//			'title'    => esc_html__( 'Background', 'school_time' ),
//			'subtitle' => esc_html__( 'Pick a background color for the top bar', 'school_time' ),
//			'default'  => array(),
//			'required' => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'         => 'top-bar-typography',
//			'type'       => 'typography',
//			'title'      => esc_html__( 'Font', 'school_time' ),
//			'subtitle'   => esc_html__( 'Specify font properties.', 'school_time' ),
//			'google'     => true,
//			'text-align' => false,
//			'compiler'   => array( '.wh-top-bar' ),
//			'default'    => array(
//				'color'       => '#333',
//				'font-size'   => '14px',
//				'line-height' => '22px',
//				'font-family' => 'Arial,Helvetica,sans-serif',
//				'font-weight' => 'Normal',
//			),
//			'required'   => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'             => 'top-bar-menu-typography',
//			'type'           => 'typography',
//			'title'          => esc_html__( 'Menu Font', 'school_time' ),
//			'subtitle'       => esc_html__( 'Specify the top bar menu font properties.', 'school_time' ),
//			'google'         => true,
//			'text-align'     => false,
//			'color'          => false,
//			'text-transform' => true,
//			'compiler'       => array( '.wh-top-bar a' ),
//			'default'        => array(
//				'font-size'   => '14px',
//				'line-height' => '22px',
//				'font-family' => 'Arial,Helvetica,sans-serif',
//				'font-weight' => 'Normal',
//			),
//			'required'       => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-menu-alignment',
//			'type'     => 'button_set',
//			'title'    => esc_html__( 'Menu Alignment', 'school_time' ),
//			'options'  => array(
//				'left'   => 'Left',
//				'center' => 'Center',
//				'right'  => 'Right',
//			),
//			'default'  => 'right',
//			'required' => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-link-color',
//			'type'     => 'link_color',
//			'title'    => esc_html__( 'Link Color', 'school_time' ),
//			'compiler' => array( '.wh-top-bar a' ),
//			'default'  => array(
//				'regular' => '#000',
//				'hover'   => '#bbb',
//				'active'  => '#ccc',
//			),
//			'required' => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-text',
//			'type'     => 'editor',
//			'title'    => esc_html__( 'Text Block', 'school_time' ),
//			'default'  => 'Demo Top Bar Text',
//			'args'     => array(
//				'teeny'         => false,
//				'media_buttons' => false
//			),
//			'required' => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-text-alignment',
//			'type'     => 'button_set',
//			'title'    => esc_html__( 'Text Block Alignment', 'school_time' ),
//			'options'  => array(
//				'left'   => 'Left',
//				'center' => 'Center',
//				'right'  => 'Right',
//			),
//			'default'  => 'left',
//			'required' => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-layout',
//			'type'     => 'sorter',
//			'title'    => 'Layout Manager',
//			'desc'     => 'Organize how you want the elements to appear in the top bar.',
//			'options'  => array(
//				'enabled'  => array(
//					'text' => 'Top Bar Text',
//					'menu' => 'Menu',
//				),
//				'disabled' => array(
//				),
//			),
//			'required' => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'            => 'top-bar-menu-width',
//			'type'          => 'slider',
//			'title'         => esc_html__( 'Menu Width', 'school_time' ),
//			'subtitle'      => esc_html__( 'Drag the slider to change menu width grid steps.', 'school_time' ),
//			'desc'          => esc_html__( 'The grid has 12 steps.', 'school_time' ),
//			'default'       => 6,
//			'min'           => 1,
//			'step'          => 1,
//			'max'           => 12,
//			'display_value' => 'label',
//			'required'      => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'            => 'top-bar-text-width',
//			'type'          => 'slider',
//			'title'         => esc_html__( 'Text Width', 'school_time' ),
//			'subtitle'      => esc_html__( 'Drag the slider to change text width grid steps.', 'school_time' ),
//			'desc'          => esc_html__( 'The grid has 12 steps.', 'school_time' ),
//			'default'       => 6,
//			'min'           => 1,
//			'step'          => 1,
//			'max'           => 12,
//			'display_value' => 'label',
//			'required'      => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-padding-override',
//			'type'     => 'switch',
//			'title'    => esc_html__( 'Override Top Bar Padding', 'school_time' ),
//			'default'  => false,
//			'on'       => 'Yes',
//			'off'      => 'No',
//			'required' => array(
//				array( 'top-bar-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'             => 'top-bar-padding',
//			'type'           => 'spacing',
//			'compiler'       => array( '.wh-top-bar > .cbp-container > div' ),
//			'mode'           => 'padding',
//			'units'          => array( 'em', 'px' ),
//			'units_extended' => 'false',
//			'title'          => esc_html__( 'Top Bar Padding', 'school_time' ),
//			'default'        => array(
//				'padding-top'    => '5px',
//				'padding-right'  => '20px',
//				'padding-bottom' => '5px',
//				'padding-left'   => '20px',
//				'units'          => 'px',
//			),
//			'required'       => array(
//				array( 'top-bar-use', 'equals', '1' ),
//				array( 'top-bar-padding-override', 'equals', '1' ),
//			),
//
//		),
//	)
//) );
//
//
//Redux::setSection( $opt_name, array(
//	'subsection' => true,
//	'id'         => 'subsection-header-top-bar-additional',
//	'title'      => esc_html__( 'Top Bar Additional', 'school_time' ),
//	'fields'     => array(
//		array(
//			'id'       => 'top-bar-additional-use',
//			'type'     => 'switch',
//			'title'    => esc_html__( 'Use Top Bar Additional', 'school_time' ),
//			'default'  => false,
//			'compiler' => 'true',
//			'on'       => 'Yes',
//			'off'      => 'No',
//		),
//		array(
//			'id'       => 'top-bar-additional-show-on-mobile',
//			'type'     => 'switch',
//			'title'    => esc_html__( 'Show on Mobile Devices', 'school_time' ),
//			'default'  => false,
//			'compiler' => 'true',
//			'on'       => 'Yes',
//			'off'      => 'No',
//		),
//		array(
//			'id'       => 'top-bar-additional-background',
//			'type'     => 'background',
//			'compiler' => array( '.wh-top-bar-additional' ),
//			'title'    => esc_html__( 'Background', 'school_time' ),
//			'subtitle' => esc_html__( 'Pick a background color for the top bar', 'school_time' ),
//			'default'  => array(),
//			'required' => array(
//				array( 'top-bar-additional-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'         => 'top-bar-additional-typography',
//			'type'       => 'typography',
//			'title'      => esc_html__( 'Font', 'school_time' ),
//			'subtitle'   => esc_html__( 'Specify font properties.', 'school_time' ),
//			'google'     => true,
//			'text-align' => false,
//			'compiler'   => array( '.wh-top-bar-additional' ),
//			'default'    => array(
//				'color'       => '#333',
//				'font-size'   => '14px',
//				'line-height' => '22px',
//				'font-family' => 'Arial,Helvetica,sans-serif',
//				'font-weight' => 'Normal',
//			),
//			'required'   => array(
//				array( 'top-bar-additional-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-additional-link-color',
//			'type'     => 'link_color',
//			'title'    => esc_html__( 'Link Color', 'school_time' ),
//			'compiler' => array( '.wh-top-bar-additional a' ),
//			'default'  => array(
//				'regular' => '#000',
//				'hover'   => '#bbb',
//				'active'  => '#ccc',
//			),
//			'required' => array(
//				array( 'top-bar-additional-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-additional-text',
//			'type'     => 'editor',
//			'title'    => esc_html__( 'Text Block', 'school_time' ),
//			'default'  => 'Demo Top Bar Additional Text',
//			'args'     => array(
//				'teeny'         => false,
//				'media_buttons' => false
//			),
//			'required' => array(
//				array( 'top-bar-additional-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-additional-text-alignment',
//			'type'     => 'button_set',
//			'title'    => esc_html__( 'Text Block Alignment', 'school_time' ),
//			'options'  => array(
//				'left'   => 'Left',
//				'center' => 'Center',
//				'right'  => 'Right',
//			),
//			'default'  => 'left',
//			'required' => array(
//				array( 'top-bar-additional-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'       => 'top-bar-additional-padding-override',
//			'type'     => 'switch',
//			'title'    => esc_html__( 'Override Top Bar Padding', 'school_time' ),
//			'default'  => false,
//			'on'       => 'Yes',
//			'off'      => 'No',
//			'required' => array(
//				array( 'top-bar-additional-use', 'equals', '1' ),
//			),
//		),
//		array(
//			'id'             => 'top-bar-additional-padding',
//			'type'           => 'spacing',
//			'compiler'       => array( '.wh-top-bar-additional > .cbp-container > div' ),
//			'mode'           => 'padding',
//			'units'          => array( 'em', 'px' ),
//			'units_extended' => 'false',
//			'title'          => esc_html__( 'Top Bar Padding', 'school_time' ),
//			'default'        => array(
//				'padding-top'    => '5px',
//				'padding-right'  => '20px',
//				'padding-bottom' => '5px',
//				'padding-left'   => '20px',
//				'units'          => 'px',
//			),
//			'required'       => array(
//				array( 'top-bar-additional-use', 'equals', '1' ),
//				array( 'top-bar-additional-padding-override', 'equals', '1' ),
//			),
//
//		),
//		array(
//			'id'       => 'top-bar-additional-border',
//			'type'     => 'border',
//			'title'    => esc_html__('Border', 'school_time'),
//			'compiler' => array('.wh-top-bar-additional'),
//			'all'      => false,
//			'top'      => false,
//			'right'    => false,
//			'left'     => false,
//			'default'  => array(
//				'border-color'  => '#ccc',
//				'border-style'  => 'solid',
//				'border-top'    => '1px',
//			)
//		)
//	)
//) );



Redux::setSection( $opt_name, array(
	'subsection' => true,
	'id'         => 'subsection-header-main-menu',
	'title'      => esc_html__( 'Main Menu', 'school-time' ),
		'fields'     => array(
			array(
			    'id'             => 'menu-main-top-level-typography',
			    'type'           => 'typography',
			    'title'          => esc_html__('Top Level Items Typography', 'school-time'),
			    'google'         => true,    // Disable google fonts. Won't work if you haven't defined your google api key
			    'font-backup'    => true,    // Select a backup non-google font in addition to a google font
			    'color'          => false,
			    'text-transform' => true,
			    'all_styles'     => true,    // Enable all Google Font style/weight variations to be added to the page
			    'compiler'         => array('.sf-menu.wh-menu-main a, .respmenu li a'), // An array of CSS selectors to apply this font style to dynamically
			    'units'          => 'px', // Defaults to px
			    'default'        => array(
			        'font-style'    => '700',
			        'font-family'   => 'Abel',
			        'google'        => true,
			        'font-size'     => '18px',
			        'line-height'   => '24px'
			    ),
			),
			array(
			    'id'             => 'menu-main-sub-items-typography',
			    'type'           => 'typography',
			    'title'          => esc_html__('Subitems Typography', 'school-time'),
			    'google'         => true,    // Disable google fonts. Won't work if you haven't defined your google api key
			    'font-backup'    => true,    // Select a backup non-google font in addition to a google font
			    'color'          => false,
			    'text-transform' => true,
			    'all_styles'     => true,    // Enable all Google Font style/weight variations to be added to the page
			    'compiler'         => array('.sf-menu.wh-menu-main ul li a'), // An array of CSS selectors to apply this font style to dynamically
			    'units'          => 'px', // Defaults to px
			    'default'        => array(
			        'font-style'    => '700',
			        'font-family'   => 'Abel',
			        'google'        => true,
			        'font-size'     => '16px',
			        'line-height'   => '24px'
			    ),
			),
			array(
			    'id'        => 'main-menu-link-color',
			    'type'      => 'link_color',
			    'title'     => esc_html__('Menu Item Link Color', 'school-time'),
			    'active'    => false, // Disable Active Color
			    'compiler'     => array('.sf-menu.wh-menu-main a', '.respmenu li a', '.cbp-respmenu-more'),
			    'default'   => array(
			        'regular'   => '#000',
			        'hover'     => '#333',
			    ),
			),
			array(
			    'id'        => 'main-menu-menu-item-hover-background',
			    'type'      => 'background',
			    'compiler'    => array('.sf-menu.wh-menu-main > li:hover, .sf-menu.wh-menu-main > li.sfHover'),
			    'title'     => esc_html__('Menu Item Hover Background', 'school-time'),
			    'subtitle'  => esc_html__('Pick a background color for the menu item on hover.', 'school-time'),
			),
			array(
			    'id'        => 'main-menu-current-item-background',
			    'type'      => 'background',
			    'compiler'    => array(
				    '.sf-menu.wh-menu-main .current-menu-item',
				    '.respmenu_current'
			    ),
			    'title'     => esc_html__('Current Menu Item Background', 'school-time'),
			    'subtitle'  => esc_html__('Pick a background color for the current menu item.', 'school-time'),
			),
			array(
			    'id'        => 'main-menu-current-item-link-color',
			    'type'      => 'link_color',
			    'title'     => esc_html__('Current Menu Item Link Color', 'school-time'),
			    'active'    => false, // Disable Active Color
			    'compiler'     => array('.sf-menu.wh-menu-main .current-menu-item > a'),
			    'default'   => array(
			        'regular'   => '#000',
			        'hover'     => '#333',
			    ),
			),
			array(
			    'id'        => 'main-menu-submenu-item-background',
			    'type'      => 'background',
			    'compiler'    => array(
					'.sf-menu.wh-menu-main ul li',
					'.sf-menu.wh-menu-main .sub-menu',
				),
			    'title'     => esc_html__('Submenu Menu Item Background', 'school-time'),
			    'default'   => array(
			        'background-color'   => '#fff',
			    ),
			),
			array(
			    'id'        => 'main-menu-submenu-item-hover-background',
			    'type'      => 'background',
			    'compiler'    => array('.sf-menu.wh-menu-main ul li:hover, .sf-menu.wh-menu-main ul ul li:hover'),
			    'title'     => esc_html__('Subenu Item Hover Background', 'school-time'),
			    'subtitle'  => esc_html__('Pick a background color for the menu item on hover.', 'school-time'),
			),
			array(
			    'id'        => 'main-menu-submenu-item-link-color',
			    'type'      => 'link_color',
			    'title'     => esc_html__('Submenu Item Link Color', 'school-time'),
			    'active'    => false, // Disable Active Color
			    'compiler'     => array('.sf-menu.wh-menu-main ul li a'),
			    'default'   => array(
			        'regular'   => '#000',
			        'hover'     => '#333',
			    ),
			),
			array(
			    'id'             => 'main-menu-padding',
			    'type'           => 'spacing',
			    'compiler'         => array('.wh-menu-main'),
			    'mode'           => 'padding',
			    'units'          => array('px'),
			    'units_extended' => 'false',
			    'title'          => esc_html__('Padding Top', 'school-time'),
			    'description'    => esc_html__('Use it to better vertical align the menu', 'school-time'),
			    'left' => false,
			    'right' => false,
			    'default'            => array(
			        'padding-top'    => '0',
			        'padding-bottom' => '0',
			        'units'          => 'px',
			    ),
			),
			array(
			    'id'        => 'main-menu-use-menu-is-sticky',
			    'type'      => 'switch',
			    'title'     => esc_html__('Enable Sticky Menu', 'school-time'),
			    'default'   => 1,
			),
			array(
				'id'       => 'main-menu-sticky-background',
				'type'     => 'background',
				'title'    => esc_html__('Sticky Menu Background', 'school-time'),
				'compiler'         => array('.wh-sticky-header .wh-main-menu-bar-wrapper'),
				'default'  => array(
				   'background-color' => '#999',
				),
			    'required' => array(
					array( 'main-menu-use-menu-is-sticky', 'equals', '1' ),
				),
			),
			array(
				'id'       => 'main-menu-sticky-link-color',
				'type'     => 'link_color',
				'title'    => esc_html__('Sticky Menu Link Color', 'school-time'),
				'compiler' => array(
					'.wh-sticky-header .sf-menu.wh-menu-main > li > a',
				),
				'active'   => false,
				'visited'  => false,
				'default'  => array(
					'regular'  => '#000', // blue
					'hover'    => '#333', // red
				)
			),
			array(
				'id'             => 'main-menu-sticky-padding',
				'type'           => 'spacing',
				'compiler'         => array('.wh-sticky-header .wh-menu-main'),
				'mode'           => 'padding',
				'units'          => array('px'),
				'units_extended' => 'false',
				'title'          => esc_html__('Sticky Menu Padding', 'school-time'),
				'description'    => esc_html__('Use it to better vertical align the menu', 'school-time'),
				'left' => false,
				'right' => false,
				'default'            => array(
					'padding-top'    => '0',
					'padding-bottom' => '0',
					'units'          => 'px',
				),
				'required' => array(
					array( 'main-menu-use-menu-is-sticky', 'equals', '1' ),
				)
			),
			array(
			    'id'       => 'main-menu-sticky-border',
			    'type'     => 'border',
			    'title'    => esc_html__('Sticky Menu Border', 'school-time'),
			    'compiler' => array('.wh-sticky-header .wh-main-menu-bar-wrapper'),
			    'all'      => false,
			    'bottom'   => true,
			    'top'      => false,
			    'left'     => false,
			    'right'    => false,
			    'default'  => array(
			        'border-color'  => '#f5f5f5',
			        'border-style'  => 'solid',
			        'border-bottom' => '1px',
			    )
			),
			array(
			    'id'          => 'main-menu-initial-waypoint-compensation',
			    'type'        => 'text',
			    'title'       => esc_html__('Initial Waypoint Scroll Compensation', 'school-time'),
			    'description' => esc_html__('Enter number only.', 'school-time'),
			    'validate'    => 'number',
			    'default'     => 120
			),
			array(
				'id'      => 'main-menu-show-x',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show x sign after menu item', 'school-time' ),
				'default' => true,
				'on'      => 'Yes',
				'off'     => 'No',
			),

		)
) );

Redux::setSection( $opt_name, array(
	'subsection' => true,
	'id'         => 'subsection-header-responsive-menu',
	'title'      => esc_html__('Responsive Menu', 'school-time'),
    'fields'    => array(
        array(
            'id'        => 'respmenu-use',
            'type'      => 'switch',
            'compiler'  => 'true',
            'title'     => esc_html__('Use Responsive Menu?', 'school-time'),
            'default'   => true,
        ),
        array(
            'id'        => 'respmenu-show-start',
            'type'      => 'spinner',
            'title'     => esc_html__('Display bellow', 'school-time'),
            'desc'      => esc_html__('Set the width of the screen in px bellow which the menu is shown.', 'school-time'),
            'default'   => '767',
            'min'   => '50',
            'max'   => '2000',
            'step'     => '1',
            'required' => array(
                array('respmenu-use','equals','1'),
            ),
        ),
        array(
            'id'        => 'respmenu-logo',
            'type'      => 'media',
            'title'     => esc_html__('Logo', 'school-time'),
            'url'       => true,
            'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle'  => esc_html__('Set logo image', 'school-time'),
            'required' => array(
                array('respmenu-use','equals','1'),
            ),
        ),
        array(
            'id'       => 'respmenu-logo-dimensions',
            'type'     => 'dimensions',
            'units'    => array('em','px','%'),
            'title'    => esc_html__('Logo Dimensions (Width/Height)', 'school-time'),
            'compiler' => array('.respmenu-header .respmenu-header-logo-link img'),
            'required' => array(
                array('respmenu-use','equals','1'),
            ),
        ),
	    array(
		    'id'       => 'respmenu-background',
		    'type'     => 'background',
		    'title'    => esc_html__('Background', 'school-time'),
		    'compiler'         => array('.respmenu-wrap'),
		    'default'  => array(
			    'background-color' => '#fff',
		    ),
	    ),
	    array(
		    'id'       => 'respmenu-link-color',
		    'type'     => 'link_color',
		    'title'    => esc_html__('Menu Link Color', 'school-time'),
		    'compiler' => array(
			    '.respmenu li a',
				'.cbp-respmenu-more'
		    ),
		    'active'   => false,
		    'visited'  => false,
		    'default'  => array(
			    'regular'  => '#000', // blue
			    'hover'    => '#333', // red
		    )
	    ),
		array(
			'id'          => 'respmenu-display-switch-color',
			'type'        => 'color',
			'mode'        => 'border-color',
			'title'       => esc_html__( 'Display Toggle Color', 'school-time' ),
			'compiler'    => array('.respmenu-open hr'),
			'transparent' => false,
			'default'     => '#000',
			'validate'    => 'color',
		),
        array(
			'id'          => 'respmenu-display-switch-color-hover',
			'type'        => 'color',
			'mode'        => 'border-color',
			'title'       => esc_html__( 'Display Toggle Hover Color', 'school-time' ),
			'compiler'    => array('.respmenu-open:hover hr'),
			'transparent' => false,
			'default'     => '#999',
			'validate'    => 'color',
		),
        array(
            'id'        => 'respmenu-display-switch-img',
            'type'      => 'media',
            'title'     => esc_html__('Display Toggle Image', 'school-time'),
            'url'       => true,
            'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle'  => esc_html__('Set the image to replace default 3 lines for menu toggle button.', 'school-time'),
            'required' => array(
                array('respmenu-use','equals','1'),
            ),
        ),
        array(
            'id'       => 'respmenu-display-switch-img-dimensions',
            'type'     => 'dimensions',
            'units'    => array('em','px','%'),
            'title'    => esc_html__('Display Toggle Image Dimensions (Width/Height)', 'school-time'),
            'compiler' => array('.respmenu-header .respmenu-open img'),
            'required' => array(
                array('respmenu-use','equals','1'),
            ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
	'subsection' => true,
	'id'         => 'subsection-header-embellishments',
	'title'      => esc_html__( 'Embellishments', 'school-time' ),
	'fields'     => array(
		array(
			'id'      => 'header-embellishments-enable',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable', 'school-time' ),
			'default' => false,
		),
		array(
			'id'       => 'header-embellishment-background-top',
			'type'     => 'background',
			'compiler' => array( '.wh-embellishment-header-top' ),
			'title'    => esc_html__( 'Embellishment Top Background', 'school-time' ),
			'required' => array(
				array( 'header-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'header-embellishment-background-top-dimensions',
			'type'     => 'dimensions',
			'units'    => array( 'em', 'px', '%' ),
			'title'    => esc_html__( 'Embellishment Top Container Height', 'school-time' ),
			'compiler' => array( '.wh-embellishment-header-top' ),
			'width'    => false,
			'default'  => array(
				'height' => '20',
				'units'  => 'px'
			),
			'required' => array(
				array( 'header-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'             => 'header-embellishment-background-top-margin',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-embellishment-header-top' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Embellishment Top Container Margin', 'school-time' ),
			'desc'           => esc_html__( 'Use negative top margin to pull it up.', 'school-time' ),
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'margin-top'    => '0',
				'margin-bottom' => '0',
				'units'         => 'px',
			),
			'required'       => array(
				array( 'header-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'header-embellishment-background-bottom',
			'type'     => 'background',
			'compiler' => array( '.wh-embellishment-header-bottom' ),
			'title'    => esc_html__( 'Embellishment Bottom Background', 'school-time' ),
			'required' => array(
				array( 'header-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'header-embellishment-background-bottom-dimensions',
			'type'     => 'dimensions',
			'units'    => array( 'em', 'px', '%' ),
			'title'    => esc_html__( 'Embellishment Bottom Container Height', 'school-time' ),
			'compiler' => array( '.wh-embellishment-header-bottom' ),
			'width'    => false,
			'default'  => array(
				'height' => '20',
				'units'  => 'px'
			),
			'required' => array(
				array( 'header-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'             => 'header-embellishment-background-bottom-margin',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-embellishment-header-bottom' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Embellishment Bottom Container Margin', 'school-time' ),
			'desc'           => esc_html__( 'Use negative bottom margin to pull it down.', 'school-time' ),
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'margin-top'    => '0',
				'margin-bottom' => '0',
				'units'         => 'px',
			),
			'required'       => array(
				array( 'header-embellishments-enable', 'equals', '1' ),
			),
		),

	)
) );
// -> End Header

// ----------------------------------
// -> Page Title
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'section-page-title',
	'title'  => esc_html__( 'Page Title', 'school-time' ),
	'icon'   => 'el-icon-font',
	'fields' => array(
		array(
			'id'       => 'page-title-background',
			'type'     => 'background',
			'compiler' => array( '.wh-page-title-bar' ),
			'title'    => esc_html__( 'Background', 'school-time' ),
			'subtitle' => esc_html__( 'Pick a background color for the page title.', 'school-time' ),
			'default'  => array(
				'background-color' => '#bfbfbf'
			),
		),
		array(
			'id'             => 'page-title-typography',
			'type'           => 'typography',
			'title'          => esc_html__( 'Page Title Font', 'school-time' ),
			'subtitle'       => esc_html__( 'Specify the page title font properties.', 'school-time' ),
			'google'         => true,
			'text-align'     => true,
			'text-transform' => true,
			'compiler'       => array( 'h1.page-title' ),
			'default'        => array(
				'color'       => '#333',
				'font-size'   => '48px',
				'line-height' => '48px',
				'font-family' => 'Arial,Helvetica,sans-serif',
				'font-weight' => 'Normal',
			),
		),
		array(
			'id'             => 'page-title-spacing',
			'type'           => 'spacing',
			'compiler'       => array( '.page-title' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Page Title Margin', 'school-time' ),
			'default'        => array(
				'margin-top'    => '33px',
				'margin-right'  => '0px',
				'margin-bottom' => '33px',
				'margin-left'   => '0px',
				'units'         => 'px',
			),

		),
		array(
			'id'       => 'page-title-wrapper-padding-override',
			'type'     => 'switch',
			'title'    => esc_html__( 'OverridePage Title Wrapper Padding', 'school-time' ),
			'default'  => false,
			'on'       => 'Yes',
			'off'      => 'No',
		),
		array(
			'id'             => 'page-title-wrapper-padding',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-page-title-wrapper' ),
			'mode'           => 'padding',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Page Title Wrapper Padding', 'school-time' ),
			'default'        => array(
				'padding-top'    => '5px',
				'padding-right'  => '20px',
				'padding-bottom' => '5px',
				'padding-left'   => '20px',
				'units'          => 'px',
			),
			'required'       => array(
				array( 'page-title-wrapper-padding-override', 'equals', '1' ),
			),

		),
	),
) );

Redux::setSection( $opt_name, array(
	'subsection' => true,
	'id'         => 'subsection-page-title-breadcrumbs',
	'title'      => esc_html__( 'Breadcrumbs', 'school-time' ),
	'fields'     => array(
		array(
			'id'      => 'page-title-breadcrumbs-enable',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable', 'school-time' ),
			'default' => true,
		),
		array(
			'id'       => 'page-title-breadcrumbs-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Position', 'school-time' ),
			'options'  => array(
				'above_title'  => 'Above the title',
				'bellow_title' => 'Bellow the title',
			),
			'default'  => 'bellow_title',
			'required' => array(
				array( 'page-title-breadcrumbs-enable', 'equals', '1' ),
			),
		),
		array(
			'id'             => 'page-title-breadcrumbs-typography',
			'type'           => 'typography',
			'title'          => esc_html__( 'Font', 'school-time' ),
			'google'         => true,
			'font-backup'    => true,
			'text-transform' => true,
			'compiler'       => array( '.wh-breadcrumbs' ),
			'units'          => 'px',
			'default'        => array(
				'color'       => '#333',
				'font-style'  => '700',
				'font-family' => 'Abel',
				'google'      => true,
				'font-size'   => '14px',
				'line-height' => '10px'
			),
			'required'       => array(
				array( 'page-title-breadcrumbs-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'page-title-breadcrumbs-link-color',
			'type'     => 'link_color',
			'title'    => esc_html__( 'Links Color', 'school-time' ),
			'active'   => false,
			'compiler' => array( '.wh-breadcrumbs a' ),
			'default'  => array(
				'regular' => '#333',
				'hover'   => '#999',
			),
			'required' => array(
				array( 'page-title-breadcrumbs-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'page-title-breadcrumbs-alignment',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Alignment', 'school-time' ),
			'options'  => array(
				'left'   => 'Left',
				'center' => 'Center',
				'right'  => 'Right',
			),
			'default'  => 'left',
			'required' => array(
				array( 'page-title-breadcrumbs-enable', 'equals', '1' ),
			),
		),
		array(
			'id'             => 'page-title-breadcrumbs-padding',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-breadcrumbs-wrapper' ),
			'mode'           => 'padding',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Padding', 'school-time' ),
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'padding-top'    => '20',
				'padding-bottom' => '20',
				'units'       => 'px',
			),
			'required' => array(
				array( 'page-title-breadcrumbs-enable', 'equals', '1' ),
			),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'subsection' => true,
	'id'         => 'subsection-page-title-embellishments',
	'title'      => esc_html__( 'Embellishments', 'school-time' ),
	'fields'     => array(
		array(
			'id'      => 'page-title-embellishments-enable',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable', 'school-time' ),
			'default' => false,
		),
		array(
			'id'       => 'page-title-embellishment-background-top',
			'type'     => 'background',
			'compiler' => array( '.wh-embellishment-page-title-top' ),
			'title'    => esc_html__( 'Embellishment Top Background', 'school-time' ),
			'required' => array(
				array( 'page-title-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'page-title-embellishment-background-top-dimensions',
			'type'     => 'dimensions',
			'units'    => array( 'em', 'px', '%' ),
			'title'    => esc_html__( 'Embellishment Top Container Height', 'school-time' ),
			'compiler' => array( '.wh-embellishment-page-title-top' ),
			'width'    => false,
			'default'  => array(
				'height' => '20',
				'units'  => 'px'
			),
			'required' => array(
				array( 'page-title-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'             => 'page-title-embellishment-background-top-margin',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-embellishment-page-title-top' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Embellishment Top Container Margin', 'school-time' ),
			'desc'           => esc_html__( 'Use negative top margin to pull it up.', 'school-time' ),
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'margin-top'    => '0',
				'margin-bottom' => '0',
				'units'         => 'px',
			),
			'required'       => array(
				array( 'page-title-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'page-title-embellishment-background-bottom',
			'type'     => 'background',
			'compiler' => array( '.wh-embellishment-page-title-bottom' ),
			'title'    => esc_html__( 'Embellishment Bottom Background', 'school-time' ),
			'required' => array(
				array( 'page-title-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'page-title-embellishment-background-bottom-dimensions',
			'type'     => 'dimensions',
			'units'    => array( 'em', 'px', '%' ),
			'title'    => esc_html__( 'Embellishment Bottom Container Height', 'school-time' ),
			'compiler' => array( '.wh-embellishment-page-title-bottom' ),
			'width'    => false,
			'default'  => array(
				'height' => '20',
				'units'  => 'px'
			),
			'required' => array(
				array( 'page-title-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'             => 'page-title-embellishment-background-bottom-margin',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-embellishment-page-title-bottom' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Embellishment Bottom Container Margin', 'school-time' ),
			'desc'           => esc_html__( 'Use negative bottom margin to pull it down.', 'school-time' ),
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'margin-top'    => '0',
				'margin-bottom' => '0',
				'units'         => 'px',
			),
			'required'       => array(
				array( 'page-title-embellishments-enable', 'equals', '1' ),
			),
		),

	)
) );
// -> End Page Title

// ----------------------------------
// -> Content
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'section-content',
	'title'  => esc_html__( 'Content', 'school-time' ),
	'icon'   => 'el-icon-file-edit',
	'fields' => array(
		array(
			'id'       => 'content-background',
			'type'     => 'background',
			'compiler' => array( '.wh-content' ),
			'title'    => esc_html__( 'Background', 'school-time' ),
			'subtitle' => esc_html__( 'Pick a background color for the content', 'school-time' ),
		),
		array(
			'id'             => 'content-padding',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-content' ),
			'mode'           => 'padding',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Padding', 'school-time' ),
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'padding-top'    => '20',
				'padding-bottom' => '20',
				'units'       => 'px',
			)
		),
		array(
			'id'            => 'content-width',
			'type'          => 'slider',
			'title'         => esc_html__( 'Content Width', 'school-time' ),
			'subtitle'      => esc_html__( 'Drag the slider to change menu width grid steps.', 'school-time' ),
			'desc'          => esc_html__( 'The grid has 12 steps.', 'school-time' ),
			'default'       => 9,
			'min'           => 1,
			'step'          => 1,
			'max'           => 12,
			'display_value' => 'label'
		),
		array(
			'id'            => 'sidebar-width',
			'type'          => 'slider',
			'title'         => esc_html__( 'Sidebar Width', 'school-time' ),
			'subtitle'      => esc_html__( 'Drag the slider to change menu width grid steps.', 'school-time' ),
			'desc'          => esc_html__( 'The grid has 12 steps.', 'school-time' ),
			'default'       => 3,
			'min'           => 1,
			'step'          => 1,
			'max'           => 12,
			'display_value' => 'label'
		),
//		array(
//		    'id'       => 'content-hr',
//		    'type'     => 'border',
//		    'title'    => esc_html__('HR', 'school_time'),
//		    'subtitle' => esc_html__('Style content HR element', 'school_time'),
//		    'compiler' => array( '.wh-content hr' ),
//		    'bottom' => false,
//		    'right' => false,
//		    'left' => false,
//		    'default'  => array(
//		        'border-color'  => '#000',
//		        'border-style'  => 'solid',
//		        'border-top'    => '1px',
//		    )
//		),
//		array(
//		    'id'       => 'content-hr-width',
//		    'type'     => 'dimensions',
//		    'units'    => array('em','px','%'),
//		    'title'    => esc_html__('HR Width', 'school_time'),
//		    'height'    => false,
//		    'compiler' => array( '.wh-content hr' ),
//		    'default'  => array(
//		        'width'   => '100',
//		        'units'  => '%'
//		    ),
//		),
//		array(
//		    'id'             => 'content-hr-spacing',
//		    'type'           => 'spacing',
//		    'compiler' => array( '.wh-content hr' ),
//		    'mode'           => 'margin',
//		    'units'          => array('em', 'px'),
//		    'units_extended' => 'false',
//		    'title'          => esc_html__('HR Margin', 'school_time'),
//		    'default'            => array(
//		        'margin-top'     => '3px',
//		        'margin-right'   => '0px',
//		        'margin-bottom'  => '3px',
//		        'margin-left'    => '0px',
//		        'units'          => 'px',
//		    )
//		),

	),
) );

Redux::setSection( $opt_name, array(
	'subsection' => true,
	'id'         => 'subsection-content-embellishments',
	'title'      => esc_html__( 'Embellishments', 'school-time' ),
	'fields'     => array(
		array(
			'id'      => 'content-embellishments-enable',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable', 'school-time' ),
			'default' => false,
		),
		array(
			'id'       => 'content-embellishment-background-top',
			'type'     => 'background',
			'compiler' => array( '.wh-embellishment-content-top' ),
			'title'    => esc_html__( 'Embellishment Top Background', 'school-time' ),
			'required' => array(
				array( 'content-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'content-embellishment-background-top-dimensions',
			'type'     => 'dimensions',
			'units'    => array( 'em', 'px', '%' ),
			'title'    => esc_html__( 'Embellishment Top Container Height', 'school-time' ),
			'compiler' => array( '.wh-embellishment-content-top' ),
			'width'    => false,
			'default'  => array(
				'height' => '20',
				'units'  => 'px'
			),
			'required' => array(
				array( 'content-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'             => 'content-embellishment-background-top-margin',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-embellishment-content-top' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Embellishment Top Container Margin', 'school-time' ),
			'desc'           => esc_html__( 'Use negative top margin to pull it up.', 'school-time' ),
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'margin-top'    => '0',
				'margin-bottom' => '0',
				'units'         => 'px',
			),
			'required'       => array(
				array( 'content-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'content-embellishment-background-bottom',
			'type'     => 'background',
			'compiler' => array( '.wh-embellishment-content-bottom' ),
			'title'    => esc_html__( 'Embellishment Bottom Background', 'school-time' ),
			'required' => array(
				array( 'content-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'content-embellishment-background-bottom-dimensions',
			'type'     => 'dimensions',
			'units'    => array( 'em', 'px', '%' ),
			'title'    => esc_html__( 'Embellishment Bottom Container Height', 'school-time' ),
			'compiler' => array( '.wh-embellishment-content-bottom' ),
			'width'    => false,
			'default'  => array(
				'height' => '20',
				'units'  => 'px'
			),
			'required' => array(
				array( 'content-embellishments-enable', 'equals', '1' ),
			),
		),
		array(
			'id'             => 'content-embellishment-background-bottom-margin',
			'type'           => 'spacing',
			'compiler'       => array( '.wh-embellishment-content-bottom' ),
			'mode'           => 'margin',
			'units'          => array( 'em', 'px' ),
			'units_extended' => 'false',
			'title'          => esc_html__( 'Embellishment Bottom Container Margin', 'school-time' ),
			'desc'           => esc_html__( 'Use negative bottom margin to pull it up.', 'school-time' ),
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'margin-top'    => '0',
				'margin-bottom' => '0',
				'units'         => 'px',
			),
			'required'       => array(
				array( 'content-embellishments-enable', 'equals', '1' ),
			),
		),

	)
) );
// -> End Content

// ----------------------------------
// -> Blog Archive
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'section-blog-archive',
	'title'  => esc_html__( 'Blog/Archive', 'school-time' ),
	'icon'   => 'el-icon-file',
	'fields' => array(
		array(
			'id'       => 'post-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__('Post Excerpt Length', 'school-time'),
			'subtitle' => esc_html__('This setting will be applied to any section using post excerpt','school-time'),
			'validate' => 'numeric',
			'msg'      => 'You must enter a number.',
			'default'  => 20
		),
	)
) );

Redux::setSection( $opt_name, array(
	'id'     => 'section-blog-archive-single',
	'title'  => esc_html__( 'Blog/Archive Single', 'school-time' ),
	'subsection'   => true,
	'fields' => array(
		array(
			'id'      => 'single-post-is-boxed',
			'type'    => 'switch',
			'title'   => esc_html__( 'Is Boxed?', 'school-time' ),
			'default' => false,
			'on'      => 'Yes',
			'off'     => 'No',
		),
		array(
			'id'      => 'single-post-sidebar-left',
			'type'    => 'switch',
			'title'   => esc_html__( 'Sidebar on the Left?', 'school-time' ),
			'default' => false,
			'on'      => 'Yes',
			'off'     => 'No',
		),
		array(
			'id'      => 'archive-single-use-share-this',
			'type'    => 'switch',
			'title'   => esc_html__( 'Use Share This buttons?', 'school-time' ),
			'default' => false,
			'on'      => 'Yes',
			'off'     => 'No',
		),
		array(
			'id'      => 'archive-single-use-page-title',
			'type'    => 'switch',
			'title'   => esc_html__( 'Use Page Title?', 'school-time' ),
			'default' => false,
			'on'      => 'Yes',
			'off'     => 'No',
		),
		array(
			'id'       => 'archive-single-header-message',
			'type'     => 'textarea',
			'title'    => esc_html__('Header Message', 'school-time'),
			'subtitle' => esc_html__('This text is shown bellow the menu on single post and single teacher. If empty the box will not be printed.','school-time'),
		),

	)
) );
// -> End Blog Archive


// ----------------------------------
// -> Search Page
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'section-search-page',
	'title'  => esc_html__( 'Search Page', 'school-time' ),
	'icon'   => 'el-icon-search',
	'fields' => array(
		array(
			'id'      => 'search-page-use-sidebar',
			'type'    => 'switch',
			'title'   => esc_html__( 'Use Sidebar?', 'school-time' ),
			'default' => false,
			'on'      => 'Yes',
			'off'     => 'No',
		),
		array(
			'id'       => 'search-page-items-per-page',
			'type'     => 'text',
			'title'    => esc_html__( 'Items Per Page', 'school-time' ),
			'validate' => 'numeric',
			'msg'      => 'You must enter a number.',
			'default'  => 10
		),

	)
) );
// -> End Search Page


// ----------------------------------
// -> Footer
// ----------------------------------
//Redux::setSection( $opt_name, array(
//	'id'     => 'section-footer',
//	'title'  => esc_html__( 'Footer', 'school_time' ),
//	'icon'   => 'el-icon-credit-card',
//	'fields' => array(
//		array(
//			'id'       => 'footer-background',
//			'type'     => 'background',
//			'compiler' => array( '.wh-footer, .wh-footer-bottom' ),
//			'title'    => esc_html__( 'Background', 'school_time' ),
//			'subtitle' => esc_html__( 'Pick a background color for the footer.', 'school_time' ),
//			'default'  => array(
//				'background-color' => '#9e9e9e'
//			),
//		),
//		array(
//			'id'         => 'footer-typography',
//			'type'       => 'typography',
//			'title'      => esc_html__( 'Font', 'school_time' ),
//			'subtitle'   => esc_html__( 'Specify the footer font properties.', 'school_time' ),
//			'google'     => true,
//			'text-align' => false,
//			'compiler'   => array( '.wh-footer, .wh-footer-bottom' ),
//			'default'    => array(
//				'color'       => '#333',
//				'font-size'   => '14px',
//				'line-height' => '22px',
//				'font-family' => 'Arial,Helvetica,sans-serif',
//				'font-weight' => 'Normal',
//			),
//		),
//		array(
//			'id'         => 'footer-typography-headings',
//			'type'       => 'typography',
//			'title'      => esc_html__( 'Headings Font', 'school_time' ),
//			'subtitle'   => esc_html__( 'Specify headings footer font properties.', 'school_time' ),
//			'google'     => true,
//			'text-align' => false,
//			'compiler'   => array(
//				'.wh-footer h1, .wh-footer h1 a',
//				'.wh-footer h2, .wh-footer h2 a',
//				'.wh-footer h3, .wh-footer h3 a',
//				'.wh-footer h4, .wh-footer h4 a',
//				'.wh-footer h5, .wh-footer h5 a',
//				'.wh-footer h6, .wh-footer h6 a',
//			),
//			'default'    => array(
//				'color'       => '#333',
//				'font-size'   => '14px',
//				'line-height' => '22px',
//				'font-family' => 'Arial,Helvetica,sans-serif',
//				'font-weight' => 'Normal',
//			),
//		),
//		array(
//			'id'             => 'footer-menu-typography',
//			'type'           => 'typography',
//			'title'          => esc_html__( 'Menu Font', 'school_time' ),
//			'subtitle'       => esc_html__( 'Specify the footer menu font properties.', 'school_time' ),
//			'google'         => true,
//			'text-align'     => false,
//			'color'          => false,
//			'text-transform' => false,
//			'compiler'       => array( '.wh-footer-bottom a' ),
//			'default'        => array(
//				'font-size'   => '14px',
//				'line-height' => '22px',
//				'font-family' => 'Arial,Helvetica,sans-serif',
//				'font-weight' => 'Normal',
//			),
//		),
//		array(
//			'id'      => 'footer-menu-alignment',
//			'type'    => 'button_set',
//			'title'   => esc_html__( 'Menu Alignment', 'school_time' ),
//			'options' => array(
//				'left'   => 'Left',
//				'center' => 'Center',
//				'right'  => 'Right',
//			),
//			'default' => 'left'
//		),
//		array(
//			'id'       => 'footer-link-color',
//			'type'     => 'link_color',
//			'title'    => esc_html__( 'Link Color', 'school_time' ),
//			'compiler' => array( '.wh-footer .wh-footer-bottom a' ),
//			'default'  => array(
//				'regular' => '#000',
//				'hover'   => '#bbb',
//				'active'  => '#ccc',
//			)
//		),
//		array(
//			'id'      => 'footer-text',
//			'type'    => 'editor',
//			'title'   => esc_html__( 'Text Block', 'school_time' ),
//			'default' => 'Demo Footer Text',
//			'args'    => array(
//				'teeny'         => false,
//				'media_buttons' => false
//			),
//		),
//		array(
//			'id'      => 'footer-text-alignment',
//			'type'    => 'button_set',
//			'title'   => esc_html__( 'Text Block Alignment', 'school_time' ),
//			'options' => array(
//				'left'   => 'Left',
//				'center' => 'Center',
//				'right'  => 'Right',
//			),
//			'default' => 'right'
//		),
//		array(
//			'id'      => 'footer-layout',
//			'type'    => 'sorter',
//			'title'   => 'Layout Manager',
//			'desc'    => 'Organize how you want the elements to appear in the footer.',
//			'options' => array(
//				'enabled'  => array(
//					'menu'         => 'Menu',
//					'text'         => 'Footer Text',
//					'social_links' => 'Social Links',
//				),
//				'disabled' => array(),
//			),
//		),
//		array(
//			'id'            => 'footer-elements-grid-menu',
//			'type'          => 'slider',
//			'title'         => esc_html__( 'Menu Width', 'school_time' ),
//			'subtitle'      => esc_html__( 'Drag the slider to change width grid steps.', 'school_time' ),
//			'default'       => 4,
//			'min'           => 1,
//			'step'          => 1,
//			'max'           => 12,
//			'display_value' => 'label'
//		),
//		array(
//			'id'            => 'footer-elements-grid-text',
//			'type'          => 'slider',
//			'title'         => esc_html__( 'Text Width', 'school_time' ),
//			'subtitle'      => esc_html__( 'Drag the slider to change width grid steps.', 'school_time' ),
//			'default'       => 4,
//			'min'           => 1,
//			'step'          => 1,
//			'max'           => 12,
//			'display_value' => 'label'
//		),
//		array(
//			'id'            => 'footer-elements-grid-social-links',
//			'type'          => 'slider',
//			'title'         => esc_html__( 'Social Links Box Width', 'school_time' ),
//			'subtitle'      => esc_html__( 'Drag the slider to change width grid steps.', 'school_time' ),
//			'default'       => 4,
//			'min'           => 1,
//			'step'          => 1,
//			'max'           => 12,
//			'display_value' => 'label'
//		),
//		array(
//			'id'      => 'footer-social-links-alignment',
//			'type'    => 'button_set',
//			'title'   => esc_html__( 'Social Links Block Alignment', 'school_time' ),
//			'options' => array(
//				'left'   => 'Left',
//				'center' => 'Center',
//				'right'  => 'Right',
//			),
//			'default' => 'right'
//		),
//		array(
//			'id'      => 'footer-bottom-padding-override',
//			'type'    => 'switch',
//			'title'   => esc_html__( 'Override Footer Bottom Padding', 'school_time' ),
//			'default' => false,
//			'on'      => 'Yes',
//			'off'     => 'No',
//		),
//		array(
//			'id'             => 'footer-bottom-padding',
//			'type'           => 'spacing',
//			'compiler'       => array( '.wh-footer-bottom > .cbp-container > div' ),
//			'mode'           => 'padding',
//			'units'          => array( 'em', 'px' ),
//			'units_extended' => 'false',
//			'title'          => esc_html__( 'Footer Bottom Padding', 'school_time' ),
//			'default'        => array(
//				'padding-top'    => '0',
//				'padding-right'  => '0',
//				'padding-bottom' => '0',
//				'padding-left'   => '0px',
//				'units'          => 'px',
//			),
//			'required'       => array(
//				array( 'footer-bottom-padding-override', 'equals', '1' ),
//			),
//
//		),
//		array(
//			'id'      => 'footer-bottom-separator-use',
//			'type'    => 'switch',
//			'title'   => esc_html__( 'Use Footer Bottom Separator', 'school_time' ),
//			'desc'     => esc_html__('Enable the separator between Footer Widgets and Footer Bottom.', 'school_time'),
//			'compiler' => 'true',
//			'default' => true,
//			'on'      => 'Yes',
//			'off'     => 'No',
//		),
//		array(
//		    'id'       => 'footer-bottom-separator',
//		    'type'     => 'border',
//		    'title'    => esc_html__('Footer Bottom Separator', 'school_time'),
//		    'compiler'   => array('.wh-footer-separator'),
//		    'right'    => false,
//		    'bottom'   => false,
//		    'left'     => false,
//		    'default'  => array(
//		        'border-color'  => '#333',
//		        'border-style'  => 'solid',
//		        'border-top'    => '1px',
//		    ),
//		    'required'       => array(
//				array( 'footer-bottom-separator-use', 'equals', '1' ),
//			),
//		),
//		array(
//		    'id'             => 'footer-bottom-separator-padding',
//		    'type'           => 'spacing',
//		    'compiler'       => array('.wh-footer-separator-container'),
//		    'mode'           => 'padding',
//		    'units'          => array('em', 'px'),
//		    'units_extended' => 'false',
//		    'title'          => esc_html__('Footer Bottom Separator Padding', 'school_time'),
//		    'default'            => array(
//		        'padding-top'     => '0px',
//		        'padding-right'   => '15px',
//		        'padding-bottom'  => '0px',
//		        'padding-left'    => '15px',
//		        'units'          => 'px',
//		    ),
//		    'required'       => array(
//				array( 'footer-bottom-separator-use', 'equals', '1' ),
//			),
//		),
//		array(
//		    'id' => 'footer-social-links',
//		    'type' => 'multi_text',
//		    'title' => esc_html__('Social Links', 'school_time'),
//		    'desc' => esc_html__('Use this form: fa fa-twitter|http://google.com|20. First segment is icon name. The second is the link and the third is font size.', 'school_time'),
//			'default' => array(
//				'fa fa-twitter|http://google.com|20',
//				'fa fa-google-plus|http://google.com|20',
//				'fa fa-linkedin|http://google.com|20',
//			),
//		),
//	)
//) );

//Redux::setSection( $opt_name, array(
//	'subsection' => true,
//	'id'         => 'subsection-footer-widgets',
//	'title'      => esc_html__( 'Footer Widgets', 'school_time' ),
//	'fields'     => array(
//		array(
//			'id'       => 'footer-widget-background',
//			'type'     => 'background',
//			'compiler' => array( '.wh-footer' ),
//			'title'    => esc_html__( 'Background', 'school_time' ),
//			'default'  => array(
//				'background-color' => '#bfbfbf'
//			),
//		),
//		array(
//			'id'       => 'footer-widget-title-typography',
//			'type'     => 'typography',
//			'title'    => esc_html__( 'Title Font', 'school_time' ),
//			'subtitle' => esc_html__( 'Specify the widget title font properties.', 'school_time' ),
//			'google'   => true,
//			'compiler' => array( '.wh-footer h3' ),
//			'default'  => array(
//				'color'       => '#333',
//				'font-size'   => '20px',
//				'line-height' => '22px',
//				'font-weight' => 'Normal',
//			),
//		),
//		array(
//			'id'       => 'footer-widget-subtitle-typography',
//			'type'     => 'typography',
//			'title'    => esc_html__( 'Subtitle Font', 'school_time' ),
//			'subtitle' => esc_html__( 'Specify the widget link font properties.', 'school_time' ),
//			'google'   => true,
//			'color'    => false,
//			'compiler' => array(
//				'.wh-footer h4',
//				'.wh-footer h5',
//				'.wh-footer h4 a',
//				'.wh-footer h5 a'
//			),
//			'default'  => array(
//				'color'       => '#333',
//				'font-size'   => '14px',
//				'line-height' => '22px',
//				'font-weight' => 'Normal',
//			),
//		),
//		array(
//			'id'       => 'footer-widget-subtitle-color',
//			'type'     => 'link_color',
//			'title'    => esc_html__( 'Link Color', 'school_time' ),
//			'active'   => false,
//			'compiler' => array(
//				'.wh-footer a',
//				'.wh-footer .widget ul li:before',
//			 ),
//			'default'  => array(
//				'regular' => '#1e73be', // blue
//				'hover'   => '#dd3333', // red
//			)
//		),
//		array(
//			'id'       => 'footer-widget-text-typography',
//			'type'     => 'typography',
//			'title'    => esc_html__( 'Font', 'school_time' ),
//			'subtitle' => esc_html__( 'Specify the widget font properties.', 'school_time' ),
//			'google'   => true,
//			'compiler' => array( '.wh-footer', '.wh-footer p', '.wh-footer span' ),
//			'default'  => array(
//				'color'       => '#333',
//				'font-size'   => '14px',
//				'line-height' => '22px',
//				'font-weight' => 'Normal',
//			),
//		),
//		array(
//			'id'            => 'footer-widget-width',
//			'type'          => 'slider',
//			'title'         => esc_html__( 'Footer Widget Width', 'school_time' ),
//			'subtitle'      => esc_html__( 'Drag the slider to change widget width grid steps.', 'school_time' ),
//			'desc'          => esc_html__( 'The grid has 12 steps.', 'school_time' ),
//			'default'       => 3,
//			'min'           => 1,
//			'step'          => 1,
//			'max'           => 12,
//			'display_value' => 'label'
//		),
//		array(
//			'id'       => 'footer-widget-min-height',
//			'type'     => 'dimensions',
//			'units'    => array( 'px' ),
//			'title'    => esc_html__( 'Min Height', 'school_time' ),
//			'compiler' => array( '.wh-footer .widget' ),
//			'height'   => false,
//			'mode'     => 'min-height',
//			'default'  => array(
//				'width' => '250',
//				'units' => 'px',
//			),
//		),
//		array(
//			'id'      => 'footer-widget-padding-override',
//			'type'    => 'switch',
//			'title'   => esc_html__( 'Override Footer Widget Padding', 'school_time' ),
//			'default' => false,
//			'on'      => 'Yes',
//			'off'     => 'No',
//		),
//		array(
//			'id'             => 'footer-widget-padding',
//			'type'           => 'spacing',
//			'compiler'       => array( '.wh-footer > .cbp-container > div' ),
//			'mode'           => 'padding',
//			'units'          => array( 'em', 'px' ),
//			'units_extended' => 'false',
//			'title'          => esc_html__( 'Footer Widget Padding', 'school_time' ),
//			'default'        => array(
//				'padding-top'    => '5px',
//				'padding-right'  => '20px',
//				'padding-bottom' => '5px',
//				'padding-left'   => '20px',
//				'units'          => 'px',
//			),
//			'required'       => array(
//				array( 'footer-widget-padding-override', 'equals', '1' ),
//			),
//
//		),
//	)
//) );
// -> End Footer

// ----------------------------------
// -> Misc
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'section-misc',
	'title'  => esc_html__( 'Misc', 'school-time' ),
	'icon'   => 'el-icon-website',
	'fields' => array()
));

Redux::setSection( $opt_name, array(
	'subsection' => true,
	'id'         => 'subsection-misc-scroll-to-top-button',
	'title'      => esc_html__( 'Scroll to Top Button', 'school-time' ),
	'fields'     => array(
		array(
			'id'      => 'use-scroll-to-top',
			'type'    => 'switch',
			'title'   => esc_html__( 'Use Scroll to Top Button?', 'school-time' ),
			'default' => true,
			'on'      => 'Yes',
			'off'     => 'No',
		),
		array(
			'id'      => 'scroll-to-top-text',
			'type'    => 'text',
			'title'   => esc_html__( 'Scroll to Top Text', 'school-time' ),
			'default' => '',
			'required' => array(
				array( 'use-scroll-to-top', 'equals', '1' ),
			),
		),
		array(
			'id'      => 'scroll-to-top-button-override',
			'type'    => 'switch',
			'title'   => esc_html__( 'Override Scroll to Top Button?', 'school-time' ),
			'default' => false,
			'on'      => 'Yes',
			'off'     => 'No',
			'required' => array(
				array( 'use-scroll-to-top', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'scroll-to-top-button',
			'type'     => 'background',
			'compiler' => array( '#scrollUp' ),
			'title'    => esc_html__( 'Scroll to Top Button', 'school-time' ),
			'required' => array(
				array( 'use-scroll-to-top', 'equals', '1' ),
				array( 'scroll-to-top-button-override', 'equals', '1' ),
			),

		),
		array(
			'id'       => 'scroll-to-top-dimensions',
			'type'     => 'dimensions',
			'units'    => array( 'px' ),
			'compiler' => array( '#scrollUp' ),
			'title'    => esc_html__( 'Dimensions (Width/Height)', 'school-time' ),
			'default'  => array(
				'width'  => '70',
				'height' => '70'
			),
			'required' => array(
				array( 'use-scroll-to-top', 'equals', '1' ),
				array( 'scroll-to-top-button-override', 'equals', '1' ),
			),
		),
		array(
			'id'       => 'gmaps_api_key',
			'type'     => 'text',
			'title'    => esc_html__( 'Google Maps API Key', 'petal' ),
			'default'  => '',
			'desc'     => esc_html__( 'Enter GMaps API key', 'petal' ),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'subsection' => true,
	'id'         => 'subsection-misc-text-direction',
	'title'      => esc_html__( 'Text Direction', 'school-time' ),
	'fields'     => array(
		array(
			'id'      => 'is-rtl',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable RTL?', 'school-time' ),
			'default' => false,
		),
	)
) );
// -> End Misc


// ----------------------------------
// -> Other Settings
// ----------------------------------
Redux::setSection( $opt_name, array(
	'id'     => 'section-other-settings',
	'title'  => esc_html__( 'Other Settings', 'school-time' ),
	'icon'   => 'el-icon-website',
	'fields' => array(
		array(
		    'id'   => 'other-settings-info',
		    'type' => 'info',
			'desc' => esc_html__('If you have made edits to the code and wish to see the original code click on the link bellow. If you wish to completely restore the original code either copy this reference code to the editor bellow or reset the section.', 'school-time'),
		),
		array(
		    'id'   => 'other-settings-info-link',
		    'type' => 'info',
		    'desc' => '<a href="'.get_template_directory_uri().'/lib/redux/css/other-settings/vars.scss" target="_blank">Click here to see a refrence of original code</a>'
		),
		array(
			'id'       => 'other-settings-vars',
			'type'     => 'ace_editor',
			'title'    => esc_html__( 'Settings', 'school-time' ),
			'mode'     => 'scss',
			'compiler' => 'true',
			'theme'    => 'monokai',
			'default'  => $other_settings,
			'options'  => array(
				'minLines'=> 100
			),
		),
	)
) );
// -> End Other Settings
