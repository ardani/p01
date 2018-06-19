<?php global $post_id; ?>
<?php $post_class = school_time_class( 'post-item' ); ?>
<div <?php echo post_class( $post_class ) ?>>

	<div class="one whole">
		<div class="thumbnail">
			<?php school_time_get_thumbnail( 'wh-featured-image' ); ?>
		</div>
		<?php get_template_part( 'templates/entry-meta' ); ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</div>
	<div class="item one whole">
		<div class="entry-summary"><?php echo strip_shortcodes( get_the_excerpt() ); ?></div>
		<a class="wh-alt-button read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'school-time' ); ?></a>
	</div>
</div>
