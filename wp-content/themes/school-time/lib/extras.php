<?php
/**
 * Custom functions
 */

add_action( 'wp_head', 'school_time_custom_css' );
add_action( 'wp_head', 'school_time_custom_js_code' );
//add_action( 'wp_head', 'school_time_google_analytics_code' );
add_action( 'wp_head', 'school_time_responsive_menu_scripts' );
add_action( 'wp_head', 'school_time_add_layout_blocks_css' );
//add_action( 'vc_after_init', 'school_time_mutate_params' ); /* Note: here we are using vc_after_init because WPBMap::GetParam and mutateParame are available only when default content elements are "mapped" into the system */


add_filter( 'wp_nav_menu_items', 'school_time_wcmenucart', 10, 2 );

add_filter( 'breadcrumb_trail_labels', 'school_time_breadcrumb_trail_labels' );


//function school_time_mutate_params() {
//	//Get current values stored in the color param in "Accordion" element
//	$param = WPBMap::getParam( 'vc_icon', 'type' );
//	//Append new value to the 'value' array
//	$param['value'][ esc_html__( 'School Time Icons', 'wheels' ) ] = 'school-time-icons';
//	//Finally "mutate" param with new values
//	vc_update_shortcode_param( 'vc_icon', $param );
//
//}


function school_time_add_layout_blocks_css() {

	$top_bar_layout_block_id = school_time_get_option( 'top-bar-layout-block', false );
	echo school_time_get_vc_page_custom_css( $top_bar_layout_block_id );
	echo school_time_get_vc_shortcodes_custom_css( $top_bar_layout_block_id );

	$footer_layout_block_id = school_time_get_option( 'footer-layout-block', false );
	echo school_time_get_vc_page_custom_css( $footer_layout_block_id );
	echo school_time_get_vc_shortcodes_custom_css( $footer_layout_block_id );
}

function school_time_get_vc_page_custom_css( $id ) {
	if ( ! is_singular() ) {
//		return;
	}
	$out = '';
	if ( $id ) {
		$post_custom_css = get_post_meta( $id, '_wpb_post_custom_css', true );
		if ( ! empty( $post_custom_css ) ) {
			$out .= '<style type="text/css" data-type="vc_custom-css">';
			$out .= $post_custom_css;
			$out .= '</style>';
		}
	}

	return $out;
}

function school_time_get_vc_shortcodes_custom_css( $id ) {
	if ( ! is_singular() ) {
//		return;
	}
	$out = '';
	if ( $id ) {
		$shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
		if ( ! empty( $shortcodes_custom_css ) ) {
			$out .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
			$out .= $shortcodes_custom_css;
			$out .= '</style>';
		}
	}

	return $out;
}

// add_filter( 'wp_page_menu_args', 'school_time_filter_wp_page_menu_args' );

function school_time_filter_wp_page_menu_args( $args ) {

	// $args['menu_class']      = school_time_class( 'main-menu' );
	// $args['container_class'] = school_time_class( 'main-menu-container' );

	return $args;
}

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
function school_time_wcmenucart( $menu, $args ) {

	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary_navigation' !== $args->theme_location ) {
		return $menu;
	}

	ob_start();
	global $woocommerce;
	$viewing_cart        = esc_html__( 'View your shopping cart', 'school-time' );
	$start_shopping      = esc_html__( 'Start shopping', 'school-time' );
	$cart_url            = wc_get_cart_url();
	$shop_page_url       = get_permalink( wc_get_page_id( 'shop' ) );
	$cart_contents_count = $woocommerce->cart->cart_contents_count;
//	$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'wheels'), $cart_contents_count);
	$cart_contents = sprintf( _n( '%d', '%d', $cart_contents_count, 'school-time' ), $cart_contents_count );
	$cart_total    = $woocommerce->cart->get_cart_total();
	$menu_item     = '';
	// Uncomment the line below to hide nav menu cart item when there are no items in the cart
	if ( $cart_contents_count > 0 ) {
		if ( $cart_contents_count == 0 ) {
			$menu_item = '<li class="menu-item"><a class="wcmenucart-contents" href="' . $shop_page_url . '" title="' . $start_shopping . '">';
		} else {
			$menu_item = '<li class="menu-item"><a class="wcmenucart-contents" href="' . $cart_url . '" title="' . $viewing_cart . '">';
		}

		$menu_item .= '<i class="fa fa-shopping-cart"></i> ';

		$menu_item .= $cart_contents . ' - ' . $cart_total;
		$menu_item .= '</a></li>';
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
	}
	echo '' . $menu_item;
	$social = ob_get_clean();

	return $menu . $social;

}


function school_time_register_custom_thumbnail_sizes() {
	$string = school_time_get_option( 'custom-thumbnail-sizes' );

	if ( $string ) {

		$pattern     = '/[^a-zA-Z0-9\-\|\:]/';
		$replacement = '';
		$string      = preg_replace( $pattern, $replacement, $string );

		$resArr = explode( '|', $string );
		$thumbs = array();

		foreach ( $resArr as $thumbString ) {
			if ( ! empty( $thumbString ) ) {
				$parts               = explode( ':', trim( $thumbString ) );
				$thumbs[ $parts[0] ] = explode( 'x', $parts[1] );
			}
		}

		foreach ( $thumbs as $name => $sizes ) {
			add_image_size( $name, (int) $sizes[0], (int) $sizes[1], true );
		}
	}
}


if ( ! function_exists( 'school_time_entry_meta' ) ) {

	/**
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * @return void
	 */
	function school_time_entry_meta() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . esc_html__( 'Sticky', 'school-time' ) . '</span>';
		}

		if ( ! has_post_format( 'link' ) && 'post' == get_post_type() ) {
			school_time_entry_date();
		}

		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( esc_html__( ', ', 'school-time' ) );
		if ( $categories_list ) {
			echo '<span class="categories-links"><i class="icon-Folder2"></i>' . $categories_list . '</span>';
		}

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', esc_html__( ', ', 'school-time' ) );
		if ( $tag_list ) {
			echo '<span class="tags-links"><i class="icon-tag"></i> ' . $tag_list . '</span>';
		}

		// Post author
		if ( 'post' == get_post_type() ) {
			printf( '<span class="author vcard"><i class="icon-User2"></i> %1$s <a class="url fn n" href="%2$s" title="%3$s" rel="author">%4$s</a></span>', esc_html__( 'by', 'school-time' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( esc_html__( 'View all posts by %s', 'school-time' ), get_the_author() ) ), get_the_author() );

			$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

			if ( $num_comments == 0 ) {

			} else {

				if ( $num_comments > 1 ) {
					$comments = $num_comments . esc_html__( ' Comments', 'school-time' );
				} else {
					$comments = esc_html__( '1 Comment', 'school-time' );
				}
				echo '<span class="comments-count"><i class="icon-Message"></i><a href="' . get_comments_link() . '">' . $comments . '</a></span>';
			}

		}


	}
}

if ( ! function_exists( 'school_time_entry_date' ) ) {

	/**
	 * Prints HTML with date information for current post.
	 *
	 * @param boolean $echo Whether to echo the date. Default true.
	 *
	 * @return string The HTML-formatted post date.
	 */
	function school_time_entry_date( $echo = true ) {
		if ( has_post_format( array( 'chat', 'status' ) ) ) {
			$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'school-time' );
		} else {
			$format_prefix = '%2$s';
		}

		$date = sprintf( '<span class="date"><i class="icon-Agenda"></i><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
			esc_url( get_permalink() ),
			esc_attr( sprintf( esc_html__( 'Permalink to %s', 'school-time' ), the_title_attribute( 'echo=0' ) ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) ) );


		if ( $echo ) {
			echo $date;
		}

		return $date;
	}

}


function school_time_add_editor_style() {
	add_editor_style( 'editor-style.css' );
}

function school_time_breadcrumb_trail_labels($labels) {

	return wp_parse_args(array(
		'browse'              => esc_html__( 'Browse:',                               'school-time' ),
		'aria_label'          => esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'school-time' ),
		'home'                => esc_html__( 'Home',                                  'school-time' ),
		'error_404'           => esc_html__( '404 Not Found',                         'school-time' ),
		'archives'            => esc_html__( 'Archives',                              'school-time' ),
		// Translators: %s is the search query. The HTML entities are opening and closing curly quotes.
		'search'              => esc_html__( 'Search results for &#8220;%s&#8221;',   'school-time' ),
		// Translators: %s is the page number.
		'paged'               => esc_html__( 'Page %s',                               'school-time' ),
		// Translators: Minute archive title. %s is the minute time format.
		'archive_minute'      => esc_html__( 'Minute %s',                             'school-time' ),
		// Translators: Weekly archive title. %s is the week date format.
		'archive_week'        => esc_html__( 'Week %s',                               'school-time' ),
	), $labels);

}
