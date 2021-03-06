<?php
$logo     = school_time_get_option( 'logo-sticky', array() );
$logo_url = isset( $logo['url'] ) && $logo['url'] ? $logo['url'] : '';
$logo_alt_text = school_time_get_option('logo-alt-text', 'logo');

if ( ! $logo_url ) {
	$logo     = school_time_get_option( 'logo', array() );
	$logo_url = isset( $logo['url'] ) && $logo['url'] ? $logo['url'] : '';
}

$logo_sticky_width = school_time_get_option( 'logo-sticky-width-exact', '' );

if ( $logo_sticky_width && isset( $logo_sticky_width['width'] ) ) {
	$logo_sticky_width = (int) $logo_sticky_width['width'] ? (int) $logo_sticky_width['width'] : '';
}
?>
<?php if ( $logo_url ): ?>
	<div class="<?php echo school_time_class( 'logo-sticky' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img width="<?php echo esc_attr( $logo_sticky_width ); ?>" src="<?php echo esc_url( $logo_url ); ?>"
			     alt="<?php echo esc_attr(trim($logo_alt_text)); ?>">
		</a>
	</div>
<?php else: ?>
	<div class="<?php echo school_time_class( 'logo-sticky' ); ?>">
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>

		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div>
<?php endif; ?>
