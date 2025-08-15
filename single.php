<?php
/**
 * Template for displaying a single blog post.
 *
 * @package Elica_Bootstrap
 */

get_header();
?>

<main class="blog-post-container">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'blog-post' ); ?>>
				<h1 class="post-title"><?php the_title(); ?></h1>

				<div class="post-meta">
					<span>
						<?php
						printf(
							esc_html__( 'By %s', 'elica-bootstrap' ),
							esc_html( get_the_author() )
						);
						?>
					</span>
					|
					<span><?php echo esc_html( get_the_date() ); ?></span>
					|
					<span>
						<?php
						comments_number(
							esc_html__( 'No Comments', 'elica-bootstrap' ),
							esc_html__( '1 Comment', 'elica-bootstrap' ),
							esc_html__( '% Comments', 'elica-bootstrap' )
						);
						?>
					</span>
				</div>

				<?php if ( has_post_thumbnail() ) : ?>
					<img
						class="post-image"
						src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>"
						alt="<?php echo esc_attr( get_the_title() ); ?>"
					/>
				<?php endif; ?>

				<div class="post-content">
					<?php the_content(); ?>
				</div>
			</article>

			<?php the_tags( '<div class="post-tags">', ', ', '</div>' ); ?>

			<section class="comments-section">
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</section>
		<?php endwhile; ?>
	<?php else : ?>
		<h1><?php esc_html_e( 'Post Not Found', 'elica-bootstrap' ); ?></h1>
	<?php endif; ?>
</main>

<?php
get_footer();
