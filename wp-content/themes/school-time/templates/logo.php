<?php
$logo_url   = school_time_get_logo_url();
$logo_width = school_time_get_option( 'logo-width-exact', '' );
$logo_alt_text = school_time_get_option('logo-alt-text', 'logo');

if ( $logo_width && isset( $logo_width['width'] ) ) {
	$logo_width = (int) $logo_width['width'] ? (int) $logo_width['width'] : '';
}

?>
<?php if ( $logo_url ): ?>
	<div class="<?php echo school_time_class( 'logo' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img width="<?php echo esc_attr( $logo_width ); ?>" src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr(trim($logo_alt_text)); ?>">
		</a>
	</div>
<?php else: ?>
	<div class="<?php echo school_time_class( 'logo' ); ?>">
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>

		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div>
<?php endif; ?>
