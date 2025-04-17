<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
 * Theme Files
 */

require get_template_directory() . '/inc/theme_options.php';

/*
 * Setup
 */
function vixen_setup() {

    if ( apply_filters( 'vixen_register_menus', true ) ) {
        register_nav_menus( [ 'menu-1' => esc_html__( 'Header', 'vixen' ) ] );
        register_nav_menus( [ 'menu-2' => esc_html__( 'Footer', 'vixen' ) ] );
    }

    if ( apply_filters( 'vixen_post_type_support', true ) ) {
        add_post_type_support( 'page', 'excerpt' );
    }

    if ( apply_filters( 'vixen_add_theme_support', true ) ) {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            ]
        );
        add_theme_support(
            'custom-logo',
            [
                'height'      => 100,
                'width'       => 350,
                'flex-height' => true,
                'flex-width'  => true,
            ]
        );
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );

        /*
         * Editor Styles
         */
        add_theme_support( 'editor-styles' );
        add_editor_style( 'editor-styles.css' );

        /*
         * WooCommerce.
         */
        if ( apply_filters( 'vixen_add_woocommerce_support', true ) ) {
            // WooCommerce in general.
            add_theme_support( 'woocommerce' );
            // zoom.
            add_theme_support( 'wc-product-gallery-zoom' );
            // lightbox.
            add_theme_support( 'wc-product-gallery-lightbox' );
            // swipe.
            add_theme_support( 'wc-product-gallery-slider' );
        }
    }
}
add_action( 'after_setup_theme', 'vixen_setup' );


/* 
 * Register Customization Options
 */
function vixen_customize_register($wp_customize) {
    // Add a new section for customization
    $wp_customize->add_section('vixen_custom_section', array(
        'title'    => __('vixen Custom Options', 'vixen'),
        'priority' => 30,
    ));

    // Add logo upload setting and control
    $wp_customize->add_setting('vixen_logo', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vixen_logo_control', array(
        'label'    => __('Upload Logo', 'vixen'),
        'section'  => 'vixen_custom_section',
        'settings' => 'vixen_logo',
    )));

    // Add background color setting and control
    $wp_customize->add_setting('vixen_background_color', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vixen_background_color_control', array(
        'label'    => __('Background Color', 'vixen'),
        'section'  => 'vixen_custom_section',
        'settings' => 'vixen_background_color',
    )));

    // Add footer text setting and control
    $wp_customize->add_setting('vixen_footer_text', array(
        'default'   => 'Default footer text',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('vixen_footer_text_control', array(
        'label'    => __('Footer Text', 'vixen'),
        'section'  => 'vixen_custom_section',
        'settings' => 'vixen_footer_text',
        'type'     => 'text',
    ));
}

add_action('customize_register', 'vixen_customize_register');

/*
 * Theme Styles and Scripts
 */
function vixen_Scripts() {
    //Main stylesheet
    wp_enqueue_style( "Main Stylesheet", get_stylesheet_uri(), array(), null, false);
}
add_action( 'wp_enqueue_scripts', 'vixen_Scripts');