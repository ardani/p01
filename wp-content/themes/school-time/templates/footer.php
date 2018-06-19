<?php
$footer_layout_block = school_time_get_layout_block( 'footer-layout-block' );
?>
<?php if ( $footer_layout_block ): ?>
	<div class="<?php echo school_time_class( 'container_footer' ); ?>">
		<?php echo do_shortcode( $footer_layout_block->post_content ); ?>
	</div>
<?php endif; ?>
