<?php
/*
Plugin Name: Shkap Main Slider
Plugin URI: http://its-diz.com/
Description: Shkap's main page slider
Version: 1.0
Author: its-diz.com
Author Email: didous@mail.ru
License: GPLv2 or later
*/

//	Slider Post Thumbnail
	if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	}
	
        
//  Add Custom Owl Slider Script
	function owl_script() {
    wp_register_script('owlscript', plugins_url('/mykraft-owl-slider/owl-carousel/owl.script.js'));
    wp_enqueue_script('owlscript');
	}
    add_action('wp_print_scripts', 'owl_script');

//  Add Owl Sider Styles
	function slider_register_styles() {
    wp_register_style('sliderstyle1', plugin_dir_url( __FILE__ ) . 'owl-carousel/owl.carousel.css');
    wp_register_style('sliderstyle2', plugin_dir_url( __FILE__ ) . 'owl-carousel/owl.theme.css');
    wp_enqueue_style('sliderstyle1');
    wp_enqueue_style('sliderstyle2');
	}
	add_action('wp_print_styles', 'slider_register_styles');

//  Add Owl Slider Script
	function slider_register_script() {
    wp_register_script('sliderscript', plugin_dir_url( __FILE__ ) . 'owl-carousel/owl.carousel.min.js');
    wp_enqueue_script('sliderscript');
	}
	add_action('wp_print_scripts', 'slider_register_script');
	
//  Slider Post Type
	function register_slides_posttype() {
		$labels = array(
			'name' 				=> _x( 'Slides', 'post type general name','mykraft' ),
			'singular_name'		=> _x( 'Slide', 'post type singular name','mykraft' ),
			'add_new' 			=> __( 'Add New Slide','mykraft' ),
			'add_new_item' 		=> __( 'Add New Slide','mykraft' ),
			'edit_item' 		=> __( 'Edit Slide','mykraft' ),
			'new_item' 			=> __( 'New Slide','mykraft' ),
			'view_item' 		=> __( 'View','mykraft'),
			'search_items' 		=> __( 'Search Slides','mykraft' ),
			'not_found' 		=> __( 'Slide','mykraft' ),
			'not_found_in_trash'=> __( 'Slide','mykraft' ),
			'parent_item_colon' => __( 'Slide','mykraft' ),
			'menu_name'			=> __( 'Slider','mykraft' )
		);
		$taxonomies = array();
		$supports = array('title','excerpt','thumbnail');
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Slide','mykraft'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'can_export'        => true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> true,
			'rewrite' 			=> array('slug' => 'slides', 'with_front' => false ),
            'supports'          => array( 'title', 'excerpt', 'thumbnail' ),
			'menu_position' 	=> 27,
			'menu_icon' 		=> plugin_dir_url( __FILE__ ) . '/images/slider-icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('slides',$post_type_args);
	}
	add_action('init', 'register_slides_posttype');
	
//  Slider Meta Box
	$slidelink_2_metabox = array( 
		'id' => 'slidelink',
		'title' => 'Slide Link',
		'page' => array('slides'),
		'context' => 'normal',
		'priority' => 'default',
		'fields' => array(
                		array(
						'name' 			=> 'URL',
						'desc' 			=> '',
						'id' 			=> 'mykraft_slideurl',
						'class' 		=> 'mykraft_slideurl',
						'type' 			=> 'text',
						'rich_editor' 	=> 0,
						'std'          	=> '',
						'max' 			=> 0
						),
						array(
						'name' 			=> __('Open slide link in new tab:','mykraft'),
						'desc' 			=> '',
						'id' 			=> 'mykraft_slidetarget',
						'class' 		=> 'mykraft_slidetarget',
						'type' 			=> 'checkbox'
						),
					)
	);	
	
	// add meta box			
	add_action('admin_menu', 'mykraft_add_slidelink_2_meta_box');
	function mykraft_add_slidelink_2_meta_box() {
		global $slidelink_2_metabox;		
		foreach($slidelink_2_metabox['page'] as $page) {
			add_meta_box($slidelink_2_metabox['id'], $slidelink_2_metabox['title'], 'mykraft_show_slidelink_2_box', $page, 'normal', 'default', $slidelink_2_metabox);
		}
	}
	
	// show meta boxes
	function mykraft_show_slidelink_2_box()	{
		global $post;
		global $slidelink_2_metabox;
		global $mykraft_prefix;
		global $wp_version;
		
	//  nonce for verification
		echo '<input type="hidden" name="mykraft_slidelink_2_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($slidelink_2_metabox['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			echo '<tr>',
					'<th style="width:20%"><label for="', $field['id'], '">', stripslashes($field['name']), '</label></th>',
					'<td class="mykraft_field_type_' . str_replace(' ', '_', $field['type']) . '">';
			switch ($field['type']) {
				case 'text':
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /><br/>', '', stripslashes($field['desc']);
					break;
				case 'checkbox':
					echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
					break;
			}
			echo    '<td>',
				'</tr>';
		}
		echo '</table>';
	}	
	
    // url target
	function mykraft_targetlink() {
	$meta = get_post_meta( get_the_ID(), 'mykraft_slidetarget', true );
    if ($meta == '') {
        echo '_self';
    } else {
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
	add_action('save_post', 'mykraft_slidelink_2_save');
	function mykraft_slidelink_2_save($post_id) {
		global $post;
		global $slidelink_2_metabox;
		// verify nonce
		if ( !isset( $_POST['mykraft_slidelink_2_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['mykraft_slidelink_2_meta_box_nonce'], basename( __FILE__ ) ) ) {
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
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($slidelink_2_metabox['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			if ($new && $new != $old) {
				if($field['type'] == 'date') {
					$new = mykraft_format_date($new);
					update_post_meta($post_id, $field['id'], $new);
				} else {
					if(is_string($new)) {
						$new = $new;
					} 
					update_post_meta($post_id, $field['id'], $new);
				}
			} elseif ('' == $new && $old) {
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
                                        <p class="custom-font sparkle">Хочется приключений? Получи Чудесное письмо из Страны Игрушек!</p>
                                        <?php
                                            if ( get_post_meta( get_the_id(), 'mykraft_slideurl', true) != '' ) { ?>

                                                    <?php
                                                        if ( ! has_excerpt() ) {
                                                            } else { ?>
                                                                 <span><?php the_excerpt();?></span>
                                                        <?php }
//                                                                    the_post_thumbnail('slider', array('class' => 'owl-featured-image')); ?>

                                        <?php
                                            }
                                            else {
                                                if ( ! has_excerpt() ) {
                                                } else { ?>
                                                        <div>
                                                                <div><?php the_excerpt(); ?></div>
                                                        </div>
                                                        <?php }
                                                        the_post_thumbnail('slider', array('class' => 'owl-featured-image'));
                                                } ?>

                                        <a class="classicButton" href="<?php echo esc_url( get_post_meta( get_the_id(), 'mykraft_slideurl', true ) ); ?>" target="<?php echo mykraft_targetlink(); ?>">
                                                        <?php echo __( 'More','mykraft' );?>
                                                    </a>
                                    </article>
                                    <!--<article class="slideBG" style="background-image: url(<?php // echo wp_get_attachment_image_src(get_the_id())[0]; ?> )"></article>-->
                                    <?php
                                    $image_attributes = wp_get_attachment_image_src(get_the_id());
                                    //echo $image_attributes[0];
                                    ?>
                                    <article class="slideBG" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]; ?>)"></article>
                                </div>
                            </section><!--.custom-border-->
                        </div><!--.item-->
                <?php endwhile; ?>
		</div><!--#owl-demo-->
	<?php
	}
	add_action( 'wp_enqueue', 'homepage_slider' );

    
    function new_excerpt_more( $excerpt ) {
        //$excerpt = get_the_excerpt();
        $tags = array("<p>", "</p>");
        $excerpt = str_replace($tags, "", $excerpt);

	return $excerpt;
        
        
    }
    add_filter( 'the_excerpt', 'new_excerpt_more' );


    
    
?>