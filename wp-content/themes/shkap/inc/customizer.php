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
    
    /* Main PHONE */
    $wp_customize->add_setting( 'shkap_main_phone' ,
        array('sanitize_callback' => 'shkap_sanitize_text', 'default' =>  '+375 296 125 125'));

    $wp_customize->add_control( 'shkap_main_phone', array(
        'label'    => __( 'Main Telephone:', 'shkap' ),
        'section'  => 'shkap_theme_setting',
        'settings' => 'shkap_main_phone',
        'priority' => '2',
    ) );
    
    /* Address */
    $wp_customize->add_setting( 'shkap_main_address' ,
        array('sanitize_callback' => 'shkap_sanitize_text', 'default' =>  'Брест, ул.Дзержинского, 63'));

    $wp_customize->add_control( 'shkap_main_address', array(
        'label'    => __( 'Address:', 'shkap' ),
        'section'  => 'shkap_theme_setting',
        'settings' => 'shkap_main_address',
        'priority' => '3',
    ) );
    
    /* Working time */
    $wp_customize->add_setting( 'shkap_working_time' ,
        array('sanitize_callback' => 'shkap_sanitize_text', 'default' =>  '9:00 &ndash; 17:30 пн &ndash; пт'));

    $wp_customize->add_control( 'shkap_working_time', array(
        'label'    => __( 'Working time:', 'shkap' ),
        'section'  => 'shkap_theme_setting',
        'settings' => 'shkap_working_time',
        'priority' => '4',
    ) );
    
    /* Header - Logo */
    $wp_customize->add_setting( 'shkap_header_logo',
    array('sanitize_callback' => 'esc_url_raw', 'default' => get_template_directory_uri() .'/svg/logo_shkap.svg') );
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shkap_header_logo', array(
                'label'    => __( 'Logo:', 'shkap' ),
                'section'  => 'shkap_theme_setting',
                'settings' => 'shkap_header_logo',
                'priority' => '5',
            ) ) );

    
    function shkap_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }
}
add_action( 'customize_register', 'shkap_customize_register' );

?>