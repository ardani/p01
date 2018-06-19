<?php $top_bar_text = school_time_get_option( 'top-bar-text', '' ); ?>
<?php if ( $top_bar_text ): ?>
	<div class="<?php echo school_time_class( 'top-bar-text' ); ?>">
		<?php echo do_shortcode( $top_bar_text ); ?>
	</div>
<?php endif; ?>
