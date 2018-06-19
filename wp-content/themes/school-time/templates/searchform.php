<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" value="<?php if ( is_search() ) { echo get_search_query(); } ?>" name="s" class="search-field" placeholder="<?php esc_html_e( 'Search', 'school-time' ); ?>">
	<label class="hidden"><?php esc_html_e( 'Search for:', 'school-time' ); ?></label>
	<button type="submit" class="search-submit"><?php esc_html_e( 'Search', 'school-time' ); ?></button>
</form>
