<?php

$enable_page_title     = is_single() ? school_time_get_option( 'archive-single-use-page-title', false ) : true;
$header_message        = school_time_get_option( 'archive-single-header-message', '' );
$enable_header_message = is_single() && ( get_post_type() == 'post' || get_post_type() == 'teacher' ) && ! empty( $header_message ) ? true : false;
$enable_breadcrumbs    = school_time_get_option( 'page-title-breadcrumbs-enable', true );
$breadcrumbs_position  = school_time_get_option( 'page-title-breadcrumbs-position', 'bellow_title' );


?>
<?php if ( $enable_breadcrumbs && $breadcrumbs_position == 'above_title' ): ?>
	<?php get_template_part( 'templates/breadcrumbs' ); ?>
<?php endif ?>
<?php if ( $enable_header_message ) : ?>
	<div class="<?php echo school_time_class( 'header-mesage-row' ); ?>">
		<div class="<?php echo school_time_class( 'container' ); ?>">
			<div class="one whole wh-padding">
				<p><?php echo '' . $header_message; ?></p>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php if ( $enable_page_title ) : ?>
	<div class="<?php echo school_time_class( 'page-title-row' ); ?>">
		<div class="<?php echo school_time_class( 'container' ); ?>">
			<div class="<?php echo school_time_class( 'page-title-grid-wrapper' ); ?>">
				<h1 class="<?php echo school_time_class( 'page-title' ); ?>"><?php echo school_time_title(); ?></h1>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php if ( $enable_breadcrumbs && $breadcrumbs_position == 'bellow_title' ): ?>
	<?php get_template_part( 'templates/breadcrumbs' ); ?>
<?php endif ?>
