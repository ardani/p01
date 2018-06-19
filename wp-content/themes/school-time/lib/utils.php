<?php

/**
 * Utility functions
 */
function school_time_add_filters( $tags, $function ) {
	foreach ( $tags as $tag ) {
		add_filter( $tag, $function );
	}
}

function school_time_is_element_empty( $element ) {
	$element = trim( $element );

	return empty( $element ) ? true : false;
}

function school_time_get_thumbnail( $thumbnail = 'thumbnail', $echo = true ) {
	global $post_id;

	$img_url = '';
	if ( has_post_thumbnail( $post_id ) ) {
		$img_url = get_the_post_thumbnail( $post_id, $thumbnail, array(
			'class' => $thumbnail
		) );
	}
	$out = '';
	if ( '' != $img_url ) {
		$out = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $img_url . '</a>';
	}
	if ( $echo ) {
		echo $out;
	} else {
		return $out;
	}
}

function school_time_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo "<div class='pagination'>";
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<a href='" . get_pagenum_link( 1 ) . "'>&laquo;</a>";
		}
		if ( $paged > 1 && $showitems < $pages ) {
			echo "<a href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo;</a>";
		}

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? "<span class='current'>" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class='inactive' >" . $i . "</a>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo "<a href='" . get_pagenum_link( $paged + 1 ) . "'>&rsaquo;</a>";
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<a href='" . get_pagenum_link( $pages ) . "'>&raquo;</a>";
		}
		echo "</div>\n";
	}
}

function school_time_grid_class_map() {

	return array(
		array( 'one twelfth', 'eleven twelfths' ), // 1/11
		array( 'one sixth', 'five sixths' ),     // 2/10
		array( 'one fourth', 'three fourths' ),   // 3/9
		array( 'one third', 'two thirds' ),      // 4/8
		array( 'five twelfths', 'seven twelfths' ),  // 5/7
		array( 'one half', 'one half' ),        // 6/6
		array( 'seven twelfths', 'five twelfths' ),   // 7/5
		array( 'two thirds', 'one third' ),       // 8/4
		array( 'three fourths', 'one fourth' ),      // 9/3
		array( 'five sixths', 'one sixth' ),       // 10/2
		array( 'eleven twelfths', 'one twelfth' ),     // 11/1
		array( 'one whole', 'one whole' ),       // 12/12
	);
}

function school_time_get_grid_class( $index, $invert = false ) {
	$grid = school_time_grid_class_map();
	return isset( $grid[ $index ]) ? $grid[ $index ][ $invert ? 1 : 0 ] : '';
}

function school_time_get_option( $option_name, $default = false ) {
	$options = isset($GLOBALS[ SCHOOL_TIME_THEME_OPTION_NAME ]) ? $GLOBALS[ SCHOOL_TIME_THEME_OPTION_NAME ] : false;

	if ( $options && is_string( $option_name ) ) {
		return isset( $options[ $option_name ] ) ? $options[ $option_name ] : $default;
	}

	return $default;
}

function school_time_get_page_template() {

	$post_id = null;
	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	} elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	} else {
		global $post;
		$post_id = $post->ID;
	}

	if ( $post_id ) {
		return get_post_meta( $post_id, '_wp_page_template', true );
	}

}

function school_time_is_page_template( $template_file ) {
	return school_time_get_page_template() == $template_file;
}

function school_time_custom_css() {
	$custom_css = school_time_get_option( 'custom-css' );
	if ( ! school_time_is_element_empty( $custom_css ) ) {
		echo '<style>' . $custom_css . '</style>' . "\n";
	}
}
//
//function school_time_google_analytics_code() {
//	$google_analytics_code = school_time_get_option( 'google-analytics-code', false );
//	if ( $google_analytics_code ) {
//		echo '' . $google_analytics_code . "\n";
//	}
//}

function school_time_custom_js_code() {
	$customJsCode = school_time_get_option( 'custom-js-code', false );
	if ( $customJsCode ) {
		echo '<script id="wh-custom-js-code">' . "\n" . $customJsCode . "\n</script>\n";
	}
}

function school_time_responsive_menu_scripts() {

	$respmenu_use                      = (int) school_time_get_option( 'respmenu-use', 1 );
	$respmenu_show_start               = (int) school_time_get_option( 'respmenu-show-start', 767 );
	$respmenu_logo                     = school_time_get_option( 'respmenu-logo', array() );
	$respmenu_logo_url                 = isset( $respmenu_logo['url'] ) && $respmenu_logo['url'] ? $respmenu_logo['url'] : '';
	$respmenu_display_switch_logo      = school_time_get_option( 'respmenu-display-switch-img', array() );
	$respmenu_display_switch_logo_url  = isset( $respmenu_display_switch_logo['url'] ) && $respmenu_display_switch_logo['url'] ? $respmenu_display_switch_logo['url'] : '';
	$logo_alt_text                     = school_time_get_option('logo-alt-text', 'logo');
	$logo_alt_text                     = esc_attr(trim($logo_alt_text));


	if ( $respmenu_use && $respmenu_show_start ) {
	?>
	<style>
		@media screen and (max-width: <?php echo intval( $respmenu_show_start ); ?>px) {
			#cbp-menu-main { width: 100%; }

			.wh-main-menu { display: none; }
			.wh-header { display: none; }
		}
	</style>
	<script>
		var wheels  = wheels || {};
		wheels.data = wheels.data || {};

		wheels.data.respmenu = {
			id: 'cbp-menu-main',
			options: {
				id: 'cbp-menu-main-respmenu',
				submenuToggle: {
					className: 'cbp-respmenu-more',
					html: '<i class="fa fa-angle-down"></i>'
				},
				logo: {
					src: <?php echo json_encode( $respmenu_logo_url ); ?>,
					link: '<?php echo esc_url( home_url( '/' ) ); ?>',
					alt: <?php echo json_encode( $logo_alt_text ); ?>
				},
				toggleSwitch: {
					src: <?php echo json_encode( $respmenu_display_switch_logo_url ); ?>
				},
				prependTo: 'body',
				skipClasses: ['wcmenucart-contents']
			}
		};
	</script>
	<?php
	}


}

function school_time_filter_array( $filter_name, $default = array() ) {

	$filtered = apply_filters( $filter_name, $default);

	if ( ! is_array( $filtered ) || ! count( $filtered ) ) {
		$filtered = $default;
	}

	return array_unique( $filtered );
}

function school_time_array_val_concat( $array = null, $postfix = '', $default ) {

	if ( is_array( $array ) ) {

		$res = array();

		foreach ( $array as $val) {
			$res[] = $val . $postfix;
		}

		return $res;
	}

	return $default;
}

function school_time_get_rwmb_meta( $key, $post_id, $options = array() ) {
	$prefix = 'school_time_';
	$value = false;

	if ( function_exists( 'rwmb_meta' ) ) {
		$value = rwmb_meta( $prefix . $key, $options, $post_id );
	}
	return $value;
}

function school_time_get_logo_url() {
	$logo_url = '';

	// Get custom page logo
	global $post;
	if ($post) {

		$logo = school_time_get_rwmb_meta('custom_logo', $post->ID, array('type' => 'image'));
		if ( is_array( $logo ) && count( $logo ) ) {
			$logo = reset( $logo );	// get first element

			$logo_url = isset( $logo['full_url'] ) ? $logo['full_url'] : '';
			return $logo_url;
		}
	}

	// Get default logo
	$logo     = school_time_get_option( 'logo', array() );
	$logo_url = isset( $logo['url'] ) && $logo['url'] ? $logo['url'] : '';


	return $logo_url;
}

function school_time_strip_comments( $string ) {

	$regex = array(
		"`^([\t\s]+)`ism"=>'',
		"`^\/\*(.+?)\*\/`ism"=>"",
		"`([\n\A;]+)\/\*(.+?)\*\/`ism"=>"$1",
		"`//(.+?)[\n\r]`ism"=>"",
		"`([\n\A;\s]+)//(.+?)[\n\r]`ism"=>"$1\n",
		"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism"=>"\n"
	);

	return preg_replace( array_keys( $regex ), $regex, $string );
}

function school_time_get_layout_block( $key ) {

	global $post;
	$layout_block_id = null;

	if  ( $post ) {
		$layout_block_id = school_time_get_rwmb_meta( str_replace( '-', '_', $key ), $post->ID );
	}
	if ( ! $layout_block_id ) {
		$layout_block_id = school_time_get_option( $key, false );
	}

	// WPML
    $curr_lang = apply_filters( 'wpml_current_language', null );
    $layout_block_id = apply_filters( 'wpml_object_id', $layout_block_id, 'layout_block', true, $curr_lang );

	if ( $layout_block_id ) {
		$layout_block = get_post( $layout_block_id );
		return $layout_block;
	}
}

function school_time_get_child_pages() {

	global $post;

	$args = array(
		'child_of' => $post->ID,
		'sort_column' => 'menu_order',
	);

	$pages = get_pages($args);
	return count($pages);

}

function school_time_get_top_ancestor_id() {

	global $post;

	if ($post->post_parent) {
		$ancestors = array_reverse(get_post_ancestors($post->ID));
		return $ancestors[0];

	}

	return $post->ID;

}
