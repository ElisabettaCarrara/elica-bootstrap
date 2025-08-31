<?php
/**
 * Theme Support, Customizer, Widgets, and Fallback Functions
 *
 * Registers theme supports, menus, customizer settings including footer logo control,
 * widget areas, and fallback functions.
 *
 * @package Elica_Bootstrap
 */

declare( strict_types=1 );

add_action( 'after_setup_theme', 'elica_bootstrap_theme_support' );
if ( ! function_exists( 'elica_bootstrap_theme_support' ) ) {
	/**
	 * Sets up theme features and registers navigation menus.
	 *
	 * Removes block editor widget support for ClassicPress compatibility.
	 *
	 * @return void
	 */
	function elica_bootstrap_theme_support(): void {
		// Register navigation menus.
		register_nav_menus(
			array(
				'primary-menu'    => esc_html__( 'Primary Menu', 'elica-bootstrap' ),
				'footer-menu'     => esc_html__( 'Footer Menu', 'elica-bootstrap' ),
				'footer-menu-two' => esc_html__( 'Second Footer Menu', 'elica-bootstrap' ),
			)
		);

		// Enable post thumbnails support.
		add_theme_support( 'post-thumbnails' );

		// Title tag support for dynamic titles.
		add_theme_support( 'title-tag' );

		// Enable custom logo support.
		add_theme_support( 'custom-logo' );

		// Enable custom header with default settings.
		add_theme_support(
			'custom-header',
			array(
				'default-text-color' => '000000',
				'header-text'        => true,
				'height'             => 300, // Recommended height, adjust as needed.
				'width'              => 900, // Recommended width, adjust as needed.
				'flex-height'        => true,
				'flex-width'         => true,
			)
		);
	}
}

add_action( 'after_setup_theme', 'elica_bootstrap_theme_setup' );
if ( ! function_exists( 'elica_bootstrap_theme_setup' ) ) {
	/**
	 * Additional theme support and setup for feed links, backgrounds, and editor styles.
	 *
	 * Removes FSE and block editor supports for ClassicPress.
	 *
	 * @return void
	 */
	function elica_bootstrap_theme_setup(): void {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'custom-background' );
	}
}

add_action( 'customize_register', 'elica_bootstrap_customizer_register' );
if ( ! function_exists( 'elica_bootstrap_customizer_register' ) ) {
	/**
	 * Register theme customizer settings and controls.
	 *
	 * Adds the Footer Settings section with footer-specific controls including footer logo.
	 * The footer logo control allows a separate logo image, which overrides the site identity
	 * logo in the footer if set.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer object.
	 * @return void
	 */
	function elica_bootstrap_customizer_register( WP_Customize_Manager $wp_customize ): void {
		/**
		 * Add Footer Settings section.
		 */
		$wp_customize->add_section(
			'elica_bootstrap_footer_section',
			array(
				'title'       => esc_html__( 'Footer Settings', 'elica-bootstrap' ),
				'description' => esc_html__( 'Customize the footer content here.', 'elica-bootstrap' ),
				'priority'    => 160,
			)
		);

		/**
		 * Add Footer Logo setting.
		 *
		 * Stores URL of the footer-specific logo image.
		 */
		$wp_customize->add_setting(
			'elica_bootstrap_footer_logo',
			array(
				'sanitize_callback' => 'esc_url_raw',
				'type'              => 'theme_mod',
				'default'           => '',
			)
		);

		/**
		 * Add Footer Logo image upload control.
		 */
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'elica_bootstrap_footer_logo_control',
				array(
					'label'       => esc_html__( 'Footer Logo', 'elica-bootstrap' ),
					'description' => esc_html__( 'Upload a custom logo to display in the footer. If none is set, the site identity logo will be used.', 'elica-bootstrap' ),
					'section'     => 'elica_bootstrap_footer_section',
					'settings'    => 'elica_bootstrap_footer_logo',
					'priority'    => 1,
				)
			)
		);

		/**
		 * Footer Copyright Text setting and control.
		 */
		$wp_customize->add_setting(
			'elica_bootstrap_footer_copyright',
			array(
				'default'           => '© ' . date_i18n( 'Y' ) . ' Elica-Bootstrap. All rights reserved.',
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'theme_mod',
			)
		);

		$wp_customize->add_control(
			'elica_bootstrap_footer_copyright_control',
			array(
				'label'    => esc_html__( 'Copyright Text', 'elica-bootstrap' ),
				'section'  => 'elica_bootstrap_footer_section',
				'settings' => 'elica_bootstrap_footer_copyright',
				'type'     => 'text',
			)
		);

		/**
		 * Footer Background Color setting and control.
		 */
		$wp_customize->add_setting(
			'elica_bootstrap_footer_bg_color',
			array(
				'default'           => '#000000',
				'sanitize_callback' => 'sanitize_hex_color',
				'type'              => 'theme_mod',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'elica_bootstrap_footer_bg_color_control',
				array(
					'label'    => esc_html__( 'Footer Background Color', 'elica-bootstrap' ),
					'section'  => 'elica_bootstrap_footer_section',
					'settings' => 'elica_bootstrap_footer_bg_color',
				)
			)
		);

		/**
		 * Other Footer Settings controls: Menu Titles, Descriptions, etc.
		 * Keeping your existing controls for consistency.
		 */

		// Footer Menu Title 1.
		$wp_customize->add_setting(
			'elica_bootstrap_footer_menu_title_1',
			array(
				'default'           => esc_html__( 'Footer Menu Title One', 'elica-bootstrap' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'elica_bootstrap_footer_menu_title_1',
			array(
				'label'   => esc_html__( 'Footer Title 1', 'elica-bootstrap' ),
				'section' => 'elica_bootstrap_footer_section',
				'type'    => 'text',
			)
		);

		// Footer Menu Title 2.
		$wp_customize->add_setting(
			'elica_bootstrap_footer_menu_title_2',
			array(
				'default'           => esc_html__( 'Footer Menu Title Two', 'elica-bootstrap' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'elica_bootstrap_footer_menu_title_2',
			array(
				'label'   => esc_html__( 'Footer Title 2', 'elica-bootstrap' ),
				'section' => 'elica_bootstrap_footer_section',
				'type'    => 'text',
			)
		);

		// Footer Description Title.
		$wp_customize->add_setting(
			'elica_bootstrap_footer_description_title',
			array(
				'default'           => esc_html__( 'Footer Title Three', 'elica-bootstrap' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'elica_bootstrap_footer_description_title',
			array(
				'label'   => esc_html__( 'Footer Description Title', 'elica-bootstrap' ),
				'section' => 'elica_bootstrap_footer_section',
				'type'    => 'text',
			)
		);

		// Footer Description Text.
		$wp_customize->add_setting(
			'elica_bootstrap_footer_description',
			array(
				'default'           => esc_html__( 'This is the footer description text.', 'elica-bootstrap' ),
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);

		$wp_customize->add_control(
			'elica_bootstrap_footer_description',
			array(
				'label'   => esc_html__( 'Footer Description', 'elica-bootstrap' ),
				'section' => 'elica_bootstrap_footer_section',
				'type'    => 'textarea',
			)
		);
	}
}

add_action( 'widgets_init', 'elica_bootstrap_widgets_init' );
if ( ! function_exists( 'elica_bootstrap_widgets_init' ) ) {
	/**
	 * Register widget areas (sidebars).
	 *
	 * @return void
	 */
	function elica_bootstrap_widgets_init(): void {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Main Sidebar', 'elica-bootstrap' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'elica-bootstrap' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}

/**
 * Fallback callback for wp_nav_menu when no menu is assigned.
 *
 * @return void
 */
function elica_bootstrap_efc(): void {
	echo '<ul style="list-style-type:none;">';
	echo '<li><a style="color:black;font-size:28px;" href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">';
	echo esc_html__( 'Add a new menu to primary locations', 'elica-bootstrap' );
	echo '</a></li>';
	echo '</ul>';
}

/**
 * Output footer logo.
 *
 * Checks if a footer logo is set via Customizer; outputs that logo.
 * If no footer logo is set, outputs the site identity logo.
 *
 * @return void
 */
function elica_bootstrap_footer_logo(): void {
	$footer_logo_url = get_theme_mod( 'elica_bootstrap_footer_logo' );
	if ( ! empty( $footer_logo_url ) ) {
		echo '<img src="' . esc_url( $footer_logo_url ) . '" alt="' . esc_attr__( 'Footer Logo', 'elica-bootstrap' ) . '" />';
	} elseif ( has_custom_logo() ) {
		the_custom_logo();
	} else {
		// Optionally, fallback site title or text logo here.
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="site-title-link">' . esc_html__( get_bloginfo( 'name' ) ) . '</a>';
	}
}
