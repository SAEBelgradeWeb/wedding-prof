<?php
/**
 * wedding-theme Theme Customizer
 *
 * @package wedding-theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wedding_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->add_section( 'wedding_homepage_section' , array(
        'title'    => __( 'Homepage Settings', 'wedding' ),
        'priority' => 10
    ) );

    $wp_customize->add_setting( 'wedding_slogan' , array(
        'default'   => 'Bla bla',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_setting( 'boja' , array(
        'default'   => '#000000',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slogan', array(
        'label'    => __( 'Slogan', 'wedding' ),
        'section'  => 'wedding_homepage_section',
        'settings' => 'wedding_slogan',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bla', array(
        'label'    => __( 'Bla', 'wedding' ),
        'section'  => 'wedding_homepage_section',
        'settings' => 'boja',
    ) ) );
}
add_action( 'customize_register', 'wedding_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wedding_theme_customize_preview_js() {
	wp_enqueue_script( 'wedding_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wedding_theme_customize_preview_js' );
