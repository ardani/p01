<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Default - No Title
 */
get_header();
?>
<div class="<?php echo school_time_class( 'main-wrapper' ) ?>">
	<div class="<?php echo school_time_class( 'container' ) ?>">
		<div class="<?php echo school_time_class( 'content' ) ?>">
			<?php get_template_part( 'templates/content-page' ); ?>
		</div>
		<div class="<?php echo school_time_class( 'sidebar' ) ?>">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
