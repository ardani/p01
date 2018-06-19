<?php
global $post_id;
$top_bar_layout_block = school_time_get_layout_block( 'top-bar-layout-block' );
$logo_location        = school_time_get_option( 'logo-location', 'main_menu' );
$use_logo             = $logo_location == 'main_menu' ? true : false;
?>
<?php if ( $top_bar_layout_block ): ?>
	<div class="<?php echo school_time_class( 'container_top_bar' ); ?> pad-left">
		<?php echo do_shortcode( $top_bar_layout_block->post_content ); ?>
	</div>
<?php endif; ?>

<header class="<?php echo school_time_class( 'header' ); ?>">

	<div class="<?php echo school_time_class( 'main-menu-bar-wrapper' ); ?>">
		<div class="<?php echo school_time_class( 'container' ); ?>">
			<?php if ( $use_logo ): ?>
				<div class="<?php echo school_time_class( 'logo-wrapper' ); ?>">
					<?php get_template_part( 'templates/logo' ); ?>
				</div>
			<?php endif; ?>
			<?php get_template_part( 'templates/logo-sticky' ); ?>
			<div class="<?php echo school_time_class( 'main-menu-wrapper' ); ?>">
				<?php get_template_part( 'templates/menu-main' ); ?>
			</div>
		</div>
	</div>
</header>

