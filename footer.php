<footer class="site-footer" style="background-color: <?php echo esc_attr( get_theme_mod( 'elica-bootstrap_footer_bg_color', '#000000' ) ); ?>;">
	<div class="container">
		<div class="footer-container">
			<!-- Logo Section -->
			<div class="footer-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
						<h1 class="site-title" style="color:#<?php echo esc_attr( get_header_textcolor() ); ?>">
							<?php bloginfo( 'name' ); ?>
						</h1>
						<?php
					}
					?>
				</a>
			</div>
			<!-- Menu Column 1 -->
			<div class="footer-column">
				<h4><?php echo esc_html( get_theme_mod( 'elica-bootstrap_footer_menu_title_1', 'Footer menu Title One' ) ); ?></h4>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'menu_class'     => 'footer-menu',
					'fallback_cb'    => 'efc',
				) );
				?>
			</div>
			<!-- Menu Column 2 -->
			<div class="footer-column">
				<h4><?php echo esc_html( get_theme_mod( 'elica-bootstrap_footer_menu_title_2', 'Footer menu Title Two' ) ); ?></h4>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu-two',
					'menu_class'     => 'footer-menu',
					'fallback_cb'    => 'efc',
				) );
				?>
			</div>
			<!-- Text/Info Column -->
			<div class="footer-column">
				<h4><?php echo esc_html( get_theme_mod( 'elica-bootstrap_footer_description_title', 'Footer Description' ) ); ?></h4>
				<p><?php echo esc_html( get_theme_mod( 'elica-bootstrap_footer_description', 'This is the footer description text.' ) ); ?></p>
			</div>
		</div>
	</div>
	<!-- Copyright -->
	<div class="footer-bottom">
		<p>
			<?php
			echo esc_html(
				get_theme_mod(
					'elica-bootstrap_footer_copyright',
					'© ' . gmdate( 'Y' ) . ' Elica-Bootstrap. All rights reserved.'
				)
			);
			?>
		</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
