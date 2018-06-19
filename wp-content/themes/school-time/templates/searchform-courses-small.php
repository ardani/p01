<form action="<?php echo site_url( '/' ); ?>" method="get" id="searchform">
	<input type="text" value="<?php if ( school_time_is_search_courses() ) { echo get_search_query(); } ?>" name="s" placeholder="<?php esc_html_e( 'Search Courses', 'school-time' ); ?>"/>
	<input type="hidden" name="search-type" value="courses"/>
	<button type="submit" class="wh-button"><?php esc_html_e( 'Search', 'school-time' ); ?></button>
</form>
