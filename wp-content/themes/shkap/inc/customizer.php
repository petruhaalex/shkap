<?php
/**
 * Shkap Customizer functionality
 *
 * @package WordPress
 * @subpackage Shkap
 * @since Shkap 1.0
 */
/**
 * Customizer.
 *
 * @since Shkap 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */

function shkap_customize_register( $wp_customize ) {

    class shkap_Theme_Support extends WP_Customize_Control    {
        public function render_content()
        {
        }
    }

    /* theme setting */
    $wp_customize->add_section( 'shkap_theme_setting' , array(
        'title'      => __('Shkap Theme Setting','shkap'),
//        'description' => __('<h3>Set Theme Options</h3>','shkap'),
        'priority'   => 1,
    ));
    $wp_customize->add_setting('shkap_theme_setting');

    $wp_customize->add_control( new shkap_Theme_Support( $wp_customize, 'shkap_theme_setting',
        array(
            'section' => 'shkap_theme_setting',
        )
    ));

    $wp_customize->add_setting( 'shkap_main_phone' ,
        array('sanitize_callback' => 'shkap_sanitize_text', 'default' =>  '+375 296 125 125'));

    $wp_customize->add_control( 'shkap_main_phone', array(
        'label'    => __( 'Main Telephone:', 'shkap' ),
        'section'  => 'shkap_theme_setting',
        'settings' => 'shkap_main_phone',
        'priority' => '2',
    ) );

    function shkap_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
}
add_action( 'customize_register', 'shkap_customize_register' );

?>