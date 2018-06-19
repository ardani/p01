<?php
$search_page      = school_time_get_option('sensei-course-search-page', false);
$search_page_link = $search_page ? get_permalink( $search_page ) : site_url( '/' );

$args = array(
	'taxonomy'        => 'course-category',
	'name'            => 'course-category',
	'show_option_all' => 'Category',
	'show_count'      => true,
	'hierarchical'    => true
);

if ( isset( $_GET['course-category'] ) ) {
	$args['selected'] = $_GET['course-category'];
}
?>
<form action="<?php echo esc_url( $search_page_link ); ?>" method="get" id="searchform" class="search-form-wrap search-for-courses">
	<input type="hidden" name="search-type" value="courses"/>
	<ul>
		<li>
			<?php wp_dropdown_categories( $args ); ?>
		</li>
		<li>
			<select name="status">
				<option value=""><?php esc_html_e( 'Course Status', 'school-time' ); ?></option>
				<option
					value="free" <?php echo isset( $_GET['status'] ) && $_GET['status'] == 'free' ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Free', 'school-time' ); ?></option>
				<option
					value="paid" <?php echo isset( $_GET['status'] ) && $_GET['status'] == 'paid' ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Paid', 'school-time' ); ?></option>
			</select>
		</li>
		<li>
			<input type="text" value="<?php if ( school_time_is_search_courses() ) {
				echo get_search_query();
			} ?>" name="s" placeholder="<?php esc_html_e( 'Type Keyword', 'school-time' ); ?>"/>
		</li>
		<li class="search-courses-button-item">
			<button type="submit" class="wh-button"><?php esc_html_e( 'Search', 'school-time' ); ?></button>
		</li>
	</ul>
</form>
