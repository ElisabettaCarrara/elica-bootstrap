<?php
/**
 * Theme Support, Customizer, Widgets, and Fallback Functions
 *
 * @package Elica_Bootstrap
 */

declare(strict_types=1);

add_action('after_setup_theme', 'elica_bootstrap_theme_support');
if ( ! function_exists('elica_bootstrap_theme_support') ) {
    /**
     * Setup theme features and register menus.
     *
     * Removes block editor widget support for ClassicPress compatibility.
     *
     * @return void
     */
    function elica_bootstrap_theme_support(): void {
        // Register navigation menus.
        register_nav_menus(
            array(
                'primary-menu'    => esc_html__('Primary Menu', 'elica-bootstrap'),
                'footer-menu'     => esc_html__('Footer Menu', 'elica-bootstrap'),
                'footer-menu-two' => esc_html__('Second Footer Menu', 'elica-bootstrap'),
            )
        );

        // Enable post thumbnails support.
        add_theme_support('post-thumbnails');

        // Title tag support for dynamic titles.
        add_theme_support('title-tag');

        // Enable custom logo support.
        add_theme_support('custom-logo');

        // Enable custom header with default text color and header text shown.
        add_theme_support(
            'custom-header',
            array(
                'default-text-color' => '000000',
                'header-text'        => true,
            )
        );
    }
}

add_action('after_setup_theme', 'elica_bootstrap_theme_setup');
if ( ! function_exists('elica_bootstrap_theme_setup') ) {
    /**
     * Additional theme setup for feed links, backgrounds, and editor styles.
     *
     * Removes FSE and block editor supports for ClassicPress.
     *
     * @return void
     */
    function elica_bootstrap_theme_setup(): void {
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo');
        add_theme_support('custom-background');

    }
}

add_action('customize_register', 'elica_bootstrap_footer_customizer');
if ( ! function_exists('elica_bootstrap_footer_customizer') ) {
    /**
     * Register footer customization options in the Customizer.
     *
     * @param WP_Customize_Manager $wp_customize Customizer object.
     * @return void
     */
    function elica_bootstrap_footer_customizer(WP_Customize_Manager $wp_customize): void {
        // Footer Settings section.
        $wp_customize->add_section(
            'elica_bootstrap_footer_section',
            array(
                'title'       => esc_html__('Footer Settings', 'elica-bootstrap'),
                'description' => esc_html__('Customize the footer content here.', 'elica-bootstrap'),
                'priority'    => 160,
            )
        );

        // Footer Copyright Text.
        $wp_customize->add_setting(
            'elica_bootstrap_footer_copyright',
            array(
                'default'           => '© ' . date('Y') . ' Elica-Bootstrap. All rights reserved.',
                'sanitize_callback' => 'sanitize_text_field',
                'type'              => 'theme_mod',
            )
        );
        $wp_customize->add_control(
            'elica_bootstrap_footer_copyright_control',
            array(
                'label'    => esc_html__('Copyright Text', 'elica-bootstrap'),
                'section'  => 'elica_bootstrap_footer_section',
                'settings' => 'elica_bootstrap_footer_copyright',
                'type'     => 'text',
            )
        );

        // Footer Background Color.
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
                    'label'    => esc_html__('Footer Background Color', 'elica-bootstrap'),
                    'section'  => 'elica_bootstrap_footer_section',
                    'settings' => 'elica_bootstrap_footer_bg_color',
                )
            )
        );

        // Footer Menu Title 1.
        $wp_customize->add_setting(
            'elica_bootstrap_footer_menu_title_1',
            array(
                'default'           => esc_html__('Footer Menu Title One', 'elica-bootstrap'),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control(
            'elica_bootstrap_footer_menu_title_1',
            array(
                'label'   => esc_html__('Footer Title 1', 'elica-bootstrap'),
                'section' => 'elica_bootstrap_footer_section',
                'type'    => 'text',
            )
        );

        // Footer Menu Title 2.
        $wp_customize->add_setting(
            'elica_bootstrap_footer_menu_title_2',
            array(
                'default'           => esc_html__('Footer Menu Title Two', 'elica-bootstrap'),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control(
            'elica_bootstrap_footer_menu_title_2',
            array(
                'label'   => esc_html__('Footer Title 2', 'elica-bootstrap'),
                'section' => 'elica_bootstrap_footer_section',
                'type'    => 'text',
            )
        );

        // Footer Description Title.
        $wp_customize->add_setting(
            'elica_bootstrap_footer_description_title',
            array(
                'default'           => esc_html__('Footer Title Three', 'elica-bootstrap'),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        $wp_customize->add_control(
            'elica_bootstrap_footer_description_title',
            array(
                'label'   => esc_html__('Footer Description Title', 'elica-bootstrap'),
                'section' => 'elica_bootstrap_footer_section',
                'type'    => 'text',
            )
        );

        // Footer Description Text.
        $wp_customize->add_setting(
            'elica_bootstrap_footer_description',
            array(
                'default'           => esc_html__('This is the footer description text.', 'elica-bootstrap'),
                'sanitize_callback' => 'sanitize_textarea_field',
            )
        );
        $wp_customize->add_control(
            'elica_bootstrap_footer_description',
            array(
                'label'   => esc_html__('Footer Description', 'elica-bootstrap'),
                'section' => 'elica_bootstrap_footer_section',
                'type'    => 'textarea',
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
    echo '<li><a style="color:black;font-size:28px;" href="' . esc_url(admin_url('nav-menus.php')) . '">';
    echo esc_html__('Add a new menu to primary locations', 'elica-bootstrap');
    echo '</a></li>';
    echo '</ul>';
}

add_action('widgets_init', 'elica_bootstrap_widgets_init');
if ( ! function_exists('elica_bootstrap_widgets_init') ) {
    /**
     * Register widget areas (sidebars).
     *
     * @return void
     */
    function elica_bootstrap_widgets_init(): void {
        register_sidebar(
            array(
                'name'          => esc_html__('Main Sidebar', 'elica-bootstrap'),
                'id'            => 'sidebar-1',
                'description'   => esc_html__('Add widgets here.', 'elica-bootstrap'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );
    }
}

add_action('customize_register', 'elica_bootstrap_header_customizer');
if ( ! function_exists('elica_bootstrap_header_customizer') ) {
    /**
     * Register header customization options in the Customizer.
     *
     * @param WP_Customize_Manager $wp_customize Customizer object.
     * @return void
     */
    function elica_bootstrap_header_customizer(WP_Customize_Manager $wp_customize): void {
        $wp_customize->add_section(
            'elica_bootstrap_header_section',
            array(
                'title'       => esc_html__('Header Settings', 'elica-bootstrap'),
                'description' => esc_html__('Customize the header area here.', 'elica-bootstrap'),
                'priority'    => 30,
            )
        );

        // Header Background Color setting.
        $wp_customize->add_setting(
            'elica_bootstrap_header_bg_color',
            array(
                'default'           => '#ffffff',
                'sanitize_callback' => 'sanitize_hex_color',
                'type'              => 'theme_mod',
            )
        );

        // Header Background Color control.
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'elica_bootstrap_header_bg_color_control',
                array(
                    'label'    => esc_html__('Header Background Color', 'elica-bootstrap'),
                    'section'  => 'elica_bootstrap_header_section',
                    'settings' => 'elica_bootstrap_header_bg_color',
                )
            )
        );
    }
}

/**
 * Add inline style for custom header text color.
 *
 * @return void
 */
function elica_bootstrap_custom_header_color(): void {
    $text_color = get_theme_mod('header_text_color', '#000000');
    $custom_css = sprintf(
        '.site-title { color: %s; }',
        esc_attr($text_color)
    );

    wp_add_inline_style('elica-bootstrap-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'elica_bootstrap_custom_header_color');
