<?php
/**
 * Popup search form template.
 *
 * Displays a search form restricted to blog posts.
 *
 * @package Elica_Bootstrap
 */
?>
<form role="search" method="get" class="popup-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input
		type="search"
		class="popup-search-field"
		placeholder="<?php esc_attr_e( 'Search blog posts...', 'elica-bootstrap' ); ?>"
		value="<?php echo esc_attr( get_search_query() ); ?>"
		name="s"
	/>
	<input type="hidden" name="post_type" value="post" />
	<button type="submit" class="popup-search-submit">
		<?php esc_html_e( 'Search', 'elica-bootstrap' ); ?>
	</button>
</form>
