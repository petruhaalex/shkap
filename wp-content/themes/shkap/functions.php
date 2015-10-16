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

require get_template_directory() . '/inc/main-slider.php';


?>