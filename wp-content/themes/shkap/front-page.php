<?php
/**
 * The template for Front-Page.
 *
 * @package WordPress
 * @subpackage Shkap
 * @since Shkap 1.0
 */
?>
<?php get_header(); ?>

            <?php 
            if (function_exists('homepage_slider')) { 
                homepage_slider();
            } 
            ?>

            </div><!-- #content -->
        </div><!-- #main -->
    </div><!--.main-container -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>