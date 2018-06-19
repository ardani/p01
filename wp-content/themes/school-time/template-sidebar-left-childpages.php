<?php
/**
 * @package WordPress
 * @subpackage Wheels
 *
 * Template Name: Sidebar - Left with Child Pages
 */
get_header();
?>
<?php get_template_part( 'templates/title' ); ?>
<div class="<?php echo school_time_class( 'main-wrapper' ) ?>">
	<div class="<?php echo school_time_class( 'container' ) ?>">
		<div class="<?php echo school_time_class( 'sidebar' ) ?>">
		<?php get_template_part( 'templates/child-pages-sidebar' ); ?>
			<?php get_sidebar('child-pages'); ?>
		</div>
		<div class="<?php echo school_time_class( 'content' ) ?>">
			<?php get_template_part( 'templates/content-page' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
