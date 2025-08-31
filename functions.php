<?php
/**
 * Theme Scripts and Styles Setup
 *
 * @package Elica_Bootstrap
 */

if ( ! function_exists( 'elica_bootstrap_enqueue_scripts' ) ) {
	/**
	 * Enqueue theme styles and scripts.
	 *
	 * @return void
	 */
	function elica_bootstrap_enqueue_scripts() {
		$theme_uri = get_template_directory_uri();
		$version   = '1.3.0';

		// ---------------------------
		// Enqueue Stylesheets
		// ---------------------------

		wp_enqueue_style(
			'elica-bootstrap-bootstrap',
			$theme_uri . '/css/bootstrap.css',
			array(),
			$version,
			'all'
		);

		wp_enqueue_style(
			'elica-bootstrap-fontawesome',
			$theme_uri . '/css/fontawesome.min.css',
			array(),
			$version,
			'all'
		);

		wp_enqueue_style(
			'elica-bootstrap-theme-style',
			get_stylesheet_uri(),
			array(),
			$version,
			'all'
		);

		// ---------------------------
		// Enqueue JavaScript
		// ---------------------------

		wp_enqueue_script(
			'elica-bootstrap-popup',
			$theme_uri . '/js/pop-up.js',
			array(),
			$version,
			true
		);

		wp_enqueue_script(
			'elica-bootstrap-fontawesome',
			$theme_uri . '/js/fontawesome.min.js',
			array(),
			$version,
			true
		);

		wp_enqueue_script(
			'elica-bootstrap-bootstrap',
			$theme_uri . '/js/bootstrap.bundle.min.js',
			array(),
			$version,
			true
		);

		wp_enqueue_script(
			'elica-bootstrap-main',
			$theme_uri . '/js/main.js',
			array(),
			$version,
			true
		);

		// ---------------------------
		// Comments Script
		// ---------------------------
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'elica_bootstrap_enqueue_scripts' );

// Load theme support file (Make sure it does not contain FSE/block-related code).
require_once get_template_directory() . '/inc/theme-support.php';

/**
 * Change default menu parent class to a custom one.
 *
 * @param string[] $classes Array of CSS classes applied to the menu <li> element.
 * @return string[] Filtered array of CSS classes.
 */
function elica_bootstrap_change_menu_parent_class( array $classes ) : array {
	foreach ( $classes as &$class ) {
		if ( 'menu-item-has-children' === $class ) {
			$class = 'mc-has-children';
		}
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'elica_bootstrap_change_menu_parent_class' );
