<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>
<a class="skip-link screen-reader-text" href="#main-content">
	<?php esc_html_e( 'Skip to content', 'elica-bootstrap' ); ?>
</a>
<?php
$header_bg_color = get_theme_mod( 'elica_bootstrap_header_bg_color', '#ffffff' );
?>
<header class="site-header" style="background-color: <?php echo esc_attr( $header_bg_color ); ?>;">
	<div class="container header-wrapper">

		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				?>
				<h1 class="site-title" style="color:#<?php echo esc_attr( get_header_textcolor() ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				<?php
			}
			?>
		</div>

		<!-- Hamburger Button (Mobile Only) -->
		<button
			id="mobile-menu-toggle"
			aria-controls="primary-menu"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Toggle menu', 'elica-bootstrap' ); ?>"
		>
			<i class="fas fa-bars"></i>
		</button>

		<!-- Navigation Menu -->
		<nav
			class="main-navigation"
			role="navigation"
			aria-label="<?php esc_attr_e( 'Primary Menu', 'elica-bootstrap' ); ?>"
		>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-menu',
					'menu_class'     => 'main-menu',
					'menu_id'        => 'primary-menu',
					'container'      => true,
					'fallback_cb'    => 'elica-bootstrap_efc',
				)
			);
			?>
		</nav>

		<!-- Search Button (Both Desktop & Mobile) -->
		<button
			id="openSearchPopup"
			class="search-toggle"
			aria-label="<?php esc_attr_e( 'Open search', 'elica-bootstrap' ); ?>"
		>
			<i class="fas fa-search"></i>
		</button>

		<!-- Search Popup -->
		<div id="searchPopup" class="search-popup" hidden>
			<div class="search-popup-content">
				<button
					id="closeSearchPopup"
					class="close-search-popup"
					aria-label="<?php esc_attr_e( 'Close search', 'elica-bootstrap' ); ?>"
				>
					<i class="fas fa-times"></i>
				</button>
				<?php get_search_form(); ?>
			</div>
		</div>

	</div>
</header>
