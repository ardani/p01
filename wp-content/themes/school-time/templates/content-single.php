<?php while ( have_posts() ) : the_post(); ?>
	<div <?php post_class(); ?>>
		<div class="thumbnail">
			<?php school_time_get_thumbnail( 'wh-featured-image' ); ?>
		</div>
		<?php get_template_part( 'templates/entry-meta' ); ?>
		<?php if ( ! school_time_get_option( 'archive-single-use-page-title', false ) ) : ?>
			<?php the_title( '<h1>', '</h1>' ); ?>
		<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<?php if ( school_time_get_option( 'archive-single-use-share-this', false ) ): ?>
			<div class="share-this">
				<div class="share-title"><?php esc_html_e( 'Share it', 'school-time' ) ?></div>
				<!-- http://simplesharingbuttons.com/ -->
				<ul class="share-buttons">
					<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( site_url() ); ?>&t="
					       target="_blank" title="Share on Facebook"
					       onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><i
								class="fa fa-facebook"></i></a></li>
					<li>
						<a href="https://twitter.com/intent/tweet?source=<?php echo urlencode( site_url() ); ?>&text=:%20<?php echo urlencode( site_url() ); ?>"
						   target="_blank" title="Tweet"
						   onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20' + encodeURIComponent(document.URL)); return false;"><i
								class="fa fa-twitter"></i></a></li>
					<li><a href="https://plus.google.com/share?url=<?php echo urlencode( site_url() ); ?>"
					       target="_blank" title="Share on Google+"
					       onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><i
								class="fa fa-google-plus"></i></a></li>
					<li>
						<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( site_url() ); ?>&description="
						   target="_blank" title="Pin it"
						   onclick="window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(document.URL) + '&description=' +  encodeURIComponent(document.title)); return false;"><i
								class="fa fa-pinterest"></i></a></li>
					<li>
						<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( site_url() ); ?>&title=&summary=&source=<?php echo urlencode( site_url() ); ?>"
						   target="_blank" title="Share on LinkedIn"
						   onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><i
								class="fa fa-linkedin"></i></a></li>
				</ul>
			</div>
		<?php endif; ?>
		<div class="prev-next-item">
			<?php wp_link_pages( array(
				'before' => '<nav class="page-nav"><p>' . esc_html__( 'Pages:', 'school-time' ),
				'after'  => '</p></nav>'
			) ); ?>

			<div class="left-cell">
				<p class="label"><?php esc_html_e( 'Previous', 'school-time' ) ?></p>
				<?php previous_post_link( '<i class="icon-Arrow-left"></i> %link ', '%title', false ); ?>

			</div>
			<div class="right-cell">
				<p class="label"><?php esc_html_e( 'Next', 'school-time' ) ?></p>
				<?php next_post_link( '%link <i class="icon-Arrow-right"></i> ', '%title', false ); ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php comments_template( '/templates/comments.php' ); ?>
	</div>
<?php endwhile; ?>
