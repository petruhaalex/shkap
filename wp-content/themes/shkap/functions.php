<?php
	
    // Add RSS links to <head> section
    automatic_feed_links();

    // Load jQuery
    if ( !is_admin() ) {
       wp_deregister_script('jquery');
       wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"), false);
       wp_enqueue_script('jquery');
    }
	
    // Clean up the <head>
    function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
	// Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => __( 'Sidebar Widgets', 'shkap' ),
    		'id'   => 'sidebar-widgets',
    		'description'   => __( 'These are widgets for the sidebar.', 'shkap' ),
//    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
//    		'after_widget'  => '</div>',
    		'before_title'  => '',
    		'after_title'   => ''
    	));
    }
    
//    ====================== ADD SUPPORTS =======================
    if (function_exists('add_theme_support')) {
        add_theme_support('menus');
        add_theme_support( 'post-thumbnails' ); //  Slider Post Thumbnail
    }

//    ====================== Declare Menus =======================
    register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'shkap' ),
		'footer_menu' => __( 'Secondary menu in footer', 'shkap' ),
	) );
    
//   =============== Declare scripts ============================
    add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
    function my_scripts_method(){
            wp_enqueue_script( 'newscript1', get_template_directory_uri() . '/js/jquery.selectbox-0.2.js', array('jquery'),'', true);
//            wp_enqueue_script( 'newscript2', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'),'', true);
//            wp_enqueue_script( 'newscript3', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1.js', array('jquery'),'', true);
            wp_enqueue_script( 'newscript4', get_template_directory_uri() . '/js/jquery.resizeimagetoparent.min.js', array('jquery'),'', true);
//            wp_enqueue_script( 'newscript5', get_template_directory_uri() . '/js/jquery.jcarousel.min.js', array('jquery'),'', true);  // (gallery)
//            wp_enqueue_script( 'newscript6', get_template_directory_uri() . '/js/jquery.pikachoose.min.js', array('jquery'),'', true); // (gallery)
            wp_enqueue_script( 'newscript7', get_template_directory_uri() . '/js/jquery.mousewheel-3.0.6.min.js', array('jquery'),'', true);
            wp_enqueue_script( 'newscript8', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.min.js', array('jquery'),'', true);
            wp_enqueue_script( 'newscript9', get_template_directory_uri() . '/js/scripts.js', array('jquery'),'', true);
            wp_enqueue_script( 'newscript10', get_template_directory_uri() . '/js/counter.js', array('jquery'),'', true);           
            
    }
    //   =============== Declare CSS ============================
    function my_register_styles() {
        wp_register_style('newstyle1', get_template_directory_uri() . '/hovers.css'); //temp
        wp_enqueue_style('newstyle1');
    }
    add_action('wp_print_styles', 'my_register_styles');         
      
    
//  support SVG
    function my_myme_types($mime_types){
        $mime_types['svg'] = 'image/svg+xml'; // support SVG
        return $mime_types;
    }
    add_filter('upload_mimes', 'my_myme_types', 1, 1);

    
//    SUPPORT WooCommerce
//    ==============================================================================================
    remove_action ('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10); 
    remove_action ('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    
    add_action( 'after_setup_theme', 'woocommerce_support' );
    function woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }
    
//    add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
//    add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
//
//    function my_theme_wrapper_start() {
//      echo '<section id="main">';
//    }
//
//    function my_theme_wrapper_end() {
//      echo '</section>';
//    }
    
    
//  Disable the default WooCommerce stylesheet (CSS)
//    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
    
    //    ==================================================================
        
//  Remove each style one by one
//    add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
//    function jk_dequeue_styles( $enqueue_styles ) {
//            unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
//            unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
//            unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
//            return $enqueue_styles;
//    }
    // Or just remove them all in one line
//    add_filter( 'woocommerce_enqueue_styles', '__return_false' );
    
//    ==================================================================
    
    
    
//  ADD Custom CSS
    function jk_enqueue_woocommerce_css(){
	wp_register_style( 'woocommerce', get_template_directory_uri() . '/woocommerce/css/woocommerce.css' );
	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'woocommerce' );
	}
    }
    add_action( 'wp_enqueue_scripts', 'jk_enqueue_woocommerce_css' );
    
    
    
    // Removes showing results in Storefront theme
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
//    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
    
//    ADD currency BYR
    add_filter( 'woocommerce_currencies', 'add_my_currency' );
    function add_my_currency( $currencies ) {
        $currencies['ABC'] = __( __( 'Belorussian ruble', 'shkap' ), 'woocommerce' );
        return $currencies;
    }
    add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
    
    function add_my_currency_symbol( $currency_symbol, $currency ) {
        switch( $currency ) {
            case 'ABC': $currency_symbol = 'BYR'; 
            break;
        }
        return $currency_symbol;
    }

//    =============================================================================================
    
/**
 * Customizer additions.
 *
 * @since Shkap 1.0
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Slider additions.
 *
 * @since Shkap 1.0
 */

require get_template_directory() . '/inc/slider/main-slider.php';


?>