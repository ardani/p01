<div class="<?php echo school_time_class( 'top-bar-menu-wrap' ); ?>">
	<?php
	$menu_options = array(
		'theme_location'  => 'top_navigation',
		'menu_class'      => school_time_class( 'top-menu' ),
		'container_class' => school_time_class( 'top-menu-container' ),
		'depth'           => 1
	);
	?>
	<?php wp_nav_menu( $menu_options ); ?>
</div>
