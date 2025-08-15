<?php
/**
 * Main blog listing template.
 *
 * Displays the latest blog posts in a grid layout with pagination.
 *
 * @package Elica_Bootstrap
 */
get_header();
?>
<main id="main-content">
	<section class="blog-section">
		<div class="container">
			<h2 class="section-title">
				<?php esc_html_e( 'Latest Blog Posts', 'elica-bootstrap' ); ?>
			</h2>
			<div class="blog-grid">
				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<div class="blog-card">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail( 'medium' ); ?>
								</a>
							<?php endif; ?>
							<div class="blog-content">
								<span class="blog-category">
									<?php
									$category = get_the_category();
									if ( ! empty( $category ) ) {
										echo esc_html( $category[0]->name );
									}
									?>
								</span>
								<h3 class="blog-title">
									<a href="<?php echo esc_url( get_permalink() ); ?>">
										<?php the_title(); ?>
									</a>
								</h3>
								<p class="blog-excerpt">
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?>
								</p>
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more">
									<?php esc_html_e( 'Read More', 'elica-bootstrap' ); ?>
								</a>
							</div>
						</div>
					<?php endwhile; ?>
				<?php else : ?>
					<p>
						<?php esc_html_e( 'No posts found.', 'elica-bootstrap' ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="pagination">
			<?php
			$pagination_links = paginate_links(
				array(
					'prev_text' => esc_html__( '« Prev', 'elica-bootstrap' ),
					'next_text' => esc_html__( 'Next »', 'elica-bootstrap' ),
					'mid_size'  => 2,
					'type'      => 'list',
				)
			);

			if ( $pagination_links ) {
				// Allow only safe HTML for pagination.
				echo wp_kses_post( $pagination_links );
			}
			?>
		</div>
	</div>
</main>
<?php
get_footer();
