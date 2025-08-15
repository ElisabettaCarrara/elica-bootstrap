<?php
/**
 * Template for displaying single posts and pages.
 *
 * @package Elica_Bootstrap
 */

get_header();
?>

<main id="primary" class="site-main container">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content">
				<?php
				the_content();

				// Pagination support for page breaks (<!--nextpage-->)
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elica-bootstrap' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</article>

		<?php
		// Load the comment template if comments are open or there is at least one comment.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</main><!-- #primary -->

<?php
get_footer();
