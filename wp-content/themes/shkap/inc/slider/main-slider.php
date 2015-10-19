<?php
/**
 * Shkap Main Slider functionality
 *
 * @package WordPress
 * @subpackage Shkap
 * @since Shkap 1.0
 */
/**
 *
 * @since Shkap 1.0
 *
 */	

    //  Add Owl Sider Styles
    function slider_register_styles() {
        wp_register_style('sliderstyle1', get_template_directory_uri() . '/inc/slider/owl-carousel/owl.carousel.css');
        wp_register_style('sliderstyle2', get_template_directory_uri() . '/inc/slider/owl-carousel/owl.theme.css');
        wp_enqueue_style('sliderstyle1');
        wp_enqueue_style('sliderstyle2');
    }
    add_action('wp_print_styles', 'slider_register_styles');

    //  Add Owl Slider Script
    function slider_register_script() {
        wp_register_script('sliderscript', get_template_directory_uri() . '/inc/slider/owl-carousel/owl.carousel.min.js');
        wp_enqueue_script('sliderscript');
    }
    add_action('wp_print_scripts', 'slider_register_script');
	
    
    //  Slider Post Type
    function register_slides_posttype() {
        $labels = array(
                'name' 			=> _x( 'Slides', 'post type general name','shkap' ),
                'singular_name'		=> _x( 'Slide', 'post type singular name','shkap' ),
                'add_new' 		=> __( 'Add New Slide','shkap' ),
                'add_new_item' 		=> __( 'Add New Slide','shkap' ),
                'edit_item' 		=> __( 'Edit Slide','shkap' ),
                'new_item' 		=> __( 'New Slide','shkap' ),
                'view_item' 		=> __( 'View','shkap'),
                'search_items' 		=> __( 'Search Slides','shkap' ),
                'not_found' 		=> __( 'Slide','shkap' ),
                'not_found_in_trash'    => __( 'Slide','shkap' ),
                'parent_item_colon'     => __( 'Slide','shkap' ),
                'menu_name'             => __( 'Main Slider','shkap' )
        );
        $taxonomies = array();
        $supports = array('title','excerpt','thumbnail');
        $post_type_args = array(
                'labels'                => $labels,
                'singular_label' 	=> __('Slide','shkap'),
                'public' 		=> true,
                'show_ui' 		=> true,
                'publicly_queryable'    => true,
                'can_export'            => true,
                'query_var'		=> true,
                'capability_type' 	=> 'post',
                'has_archive'           => false,
                'hierarchical'          => true,
                'rewrite' 		=> array('slug' => 'slides', 'with_front' => false ),
                'supports'              => array( 'title', 'thumbnail' ),
                'menu_position' 	=> 27,
                'menu_icon'             => get_template_directory_uri() . '/inc/slider/images/slider-icon.png',
                'taxonomies'            => $taxonomies
         );
         register_post_type('slides',$post_type_args);
    }
    add_action('init', 'register_slides_posttype');
	
    //  Slider Meta Box
    $slidelink_2_metabox = array( 
        'id' => 'slidelink',
        'title' => __('Link and Description','shkap'),
        'page' => array('slides'),
        'context' => 'normal',
        'priority' => 'default',
        'fields' => array(
                        array(
                            'name' 			=> __('URL','shkap'),
                            'desc' 			=> '',
                            'id' 			=> '_shkap_slideurl',
                            'class'                     => '_shkap_slideurl',
                            'type' 			=> 'text',
                            'rich_editor'               => 0,
                            'std'                       => '',
                            'max' 			=> 0
                            ),
                        array(
                            'name' 			=> __('Description','shkap'),
                            'desc' 			=> '',
                            'id' 			=> '_shkap_slide_desc',
                            'class'                     => '_shkap_slide_desc',
                            'type' 			=> 'text',
                            'rich_editor'               => 0,
                            'std'                       => '',
                            'max' 			=> 0
                            ),
                        array(
                            'name' 			=> __('Promotions','shkap'),
                            'desc' 			=> '',
                            'id' 			=> '_shkap_slide_prom',
                            'class'                     => '_shkap_slide_prom',
                            'type' 			=> 'text',
                            'rich_editor'               => 0,
                            'std'                       => '',
                            'max' 			=> 0
                            )
                    )
        );	
    // add meta box			
    add_action('admin_menu', 'shkap_add_slidelink_2_meta_box');
        
    function shkap_add_slidelink_2_meta_box() {
        global $slidelink_2_metabox;		
        foreach($slidelink_2_metabox['page'] as $page) {
            add_meta_box($slidelink_2_metabox['id'], $slidelink_2_metabox['title'], 'shkap_show_slidelink_2_box', $page, 'normal', 'default', $slidelink_2_metabox);
        }
    }
	
    // show meta boxes
    function shkap_show_slidelink_2_box(){
        global $post;
        global $slidelink_2_metabox;

        //  nonce for verification
        echo '<input type="hidden" name="shkap_slidelink_2_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
        echo '<table class="form-table">';
        foreach ($slidelink_2_metabox['fields'] as $field) {
                // get current post meta data
                $meta = get_post_meta($post->ID, $field['id'], true);
                echo '<tr>',
                    '<th style="width:20%"><label for="', $field['id'], '">', stripslashes($field['name']), '</label></th>',
                    '<td class="shkap_field_type_' . str_replace(' ', '_', $field['type']) . '">';
                
                switch ($field['type']) {
                    case 'text':
                        echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', stripslashes($field['desc']);
                        break;
                }
                echo    '<td>',
                        '</tr>';
        }
        echo '</table>';
    }	
	
    // url target
    function shkap_targetlink() {
	$meta = get_post_meta( get_the_ID(), 'shkap_slidetarget', true );
        if ($meta == '') {
            echo '_self';
        }
        else {
            echo '_blank';
        }
    }

    // attachment
    if ( 'post_type' == 'slider' && post_status == 'publish' ) {
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_parent' => $post->ID,
            'exclude'     => get_post_thumbnail_id()
        ));
        if ($attachments) {
            foreach ($attachments as $attachment) {
            $thumbimg = wp_get_attachment_link( $attachment->ID, 'thumbnail-size', true );
            echo $thumbimg;
            }
        }
    }

    // Save data from meta box
    add_action('save_post', 'shkap_slidelink_2_save');
    function shkap_slidelink_2_save($post_id) {
        global $post;
        global $slidelink_2_metabox;
        // verify nonce
        if ( !isset( $_POST['shkap_slidelink_2_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['shkap_slidelink_2_meta_box_nonce'], basename( __FILE__ ) ) ) {
                return $post_id;
        }
        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } 
        elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
        foreach ($slidelink_2_metabox['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];
            if ($new && $new != $old) {
                if($field['type'] == 'date') {
                    $new = shkap_format_date($new);
                    update_post_meta($post_id, $field['id'], $new);
                } 
                else {
                    if(is_string($new)) {
                            $new = $new;
                    } 
                        update_post_meta($post_id, $field['id'], $new);
                }
            } 
            elseif ('' == $new && $old) {
                    delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }

    //  Construct Home Page Slider
    function homepage_slider() {
    ?>
        <div id="owl-demo" class="owl-carousel owl-theme">
        <?php
            $args = array('post_type' => 'slides', 'posts_per_page' => -1);
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
        ?>
                <div class="item">
                    <section class="custom-border big">
                        <span class="cb_top"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_top_white.png" alt="top"/></span>
                        <span class="cb_bottom"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_bottom_white.png" alt="bottom"/></span>
                        <span class="cb_left"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_left_white.png" alt="left"/></span>
                        <span class="cb_right"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_right_white.png" alt="right"/></span>
                        <span class="cb_top-left"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_left-top_white.png" alt="left-top"/></span>
                        <span class="cb_top-right"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_right-top_white.png" alt="right-top"/></span>
                        <span class="cb_bottom-left"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_left-bottom_white.png" alt="left-bottom"/></span>
                        <span class="cb_bottom-right"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_right-bottom_white.png" alt="right-bottom"/></span>
                        <div class="carousel-container">
                            <article class="pre-info">
                                <p class="custom-font sparkle"><?php echo esc_attr( get_post_meta( get_the_id(), '_shkap_slide_desc', true ) );?></p>
                                    <span><?php echo esc_attr( get_post_meta( get_the_id(), '_shkap_slide_prom', true ) );?></span>
                                <a class="classicButton" href="<?php echo esc_url( get_post_meta( get_the_id(), '_shkap_slideurl', true ) ); ?>" target="<?php echo shkap_targetlink(); ?>">
                                    <?php echo __( 'More','shkap' );?>
                                </a>
                            </article>
                            <article class="slideBG" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]; ?>)"></article>
                        </div>
                    </section><!--.custom-border-->
                </div><!--.item-->
            <?php 
            endwhile; ?>
        </div><!--#owl-demo-->
    <?php
    }
    add_action( 'wp_enqueue', 'homepage_slider' );    
?>