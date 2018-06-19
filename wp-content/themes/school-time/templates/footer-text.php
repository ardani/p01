<?php $footer_text = school_time_get_option( 'footer-text', '' ); ?>
<?php if ( $footer_text ): ?>
	<div class="<?php echo school_time_class( 'footer-text' ); ?>">
		<?php echo do_shortcode( $footer_text ); ?>
	</div>
<?php endif; ?>
