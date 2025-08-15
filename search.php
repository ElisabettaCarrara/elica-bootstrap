<?php
/**
 * Search results template.
 *
 * Displays a list of posts matching the search query.
 *
 * @package Elica_Bootstrap
 */

get_header();
?>

<main class="search-results container">
	<h1>
		<?php
		// Translators: %s = search query.
		printf(
			esc_html__( 'Showing search results for: %s', 'elica-bootstrap' ),
			esc_html( get_search_query() )
		);
		?>
	</h1>

	<?php if ( have_posts() ) : ?>
		<ul class="search-posts">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<li class="search-post-item">
					<a href="<?php the_permalink(); ?>">
						<h2><?php the_title(); ?></h2>
						<p>
							<?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?>
						</p>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php else : ?>
		<p><?php esc_html_e( 'No blog posts found.', 'elica-bootstrap' ); ?></p>
	<?php endif; ?>
</main>

<?php
get_footer();
