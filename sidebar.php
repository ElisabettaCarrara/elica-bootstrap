<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Elica_Bootstrap
 */

if ( is_active_sidebar( 'sidebar-1' ) ) :
	?>
	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
	<?php
endif;
