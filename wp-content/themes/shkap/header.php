<?php
/**
 * The template for displaying Header.
 *
 * @package WordPress
 * @subpackage Shkap
 * @since Shkap 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
           
        <!--<title><?php // wp_title( '|', true, 'right' ); ?></title>-->
	<title>
            <?php
               if (function_exists('is_tag') && is_tag()) {
                  single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
               elseif (is_archive()) {
                  wp_title(''); echo ' Archive - '; }
               elseif (is_search()) {
                  echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
               elseif (!(is_404()) && (is_single()) || (is_page())) {
                  wp_title(''); echo ' - '; }
               elseif (is_404()) {
                  echo 'Not Found - '; }
               if (is_home()) {
                  bloginfo('name'); echo ' - '; bloginfo('description'); }
               else {
                   bloginfo('name'); }
               if ($paged>1) {
                  echo ' - page '. $paged; }
               ?>            
	</title>
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>

	<!--<link rel="pingback" href="<?php // bloginfo('pingback_url'); ?>">-->

	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
    <div id="wrapper">
        <div class="bgLeft"></div>
        <div class="bgRight"></div>
        <div class="responsive-container">
            <div class="middle layout">

                <div class="main-container">
                    <header id="header">
                        <div class="header-container">
                            <h1 class="logo">
                                <a href="<?php echo home_url(); ?>"><img src="<?php echo get_theme_mod( 'shkap_header_logo', get_template_directory_uri().'/svg/logo_shkap.svg');?>" alt="logo"/></a>
                                    Лавка чудес книжного шкапа
                            </h1>
                            <nav id="main_menu" class="layout">
                                <span class="slogan">Возможно всё!</span>
                                <span class="telephone">
                                    <?php
                                        if ( get_theme_mod( 'shkap_main_phone','+375 296 125 125' ))
                                            echo get_theme_mod( 'shkap_main_phone','+375 296 125 125' );
                                    ?>
                                </span>
                                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'top-menu', 'container' => '' ) ); ?>
                            </nav>
                            <div class="toolbar layout">
                                <form action="#">
                                    <div class="custom-border">
                                        <span class="cb_top"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_top.png" alt="top"/></span>
                                        <span class="cb_bottom"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_bottom.png" alt="bottom"/></span>
                                        <span class="cb_left"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_left.png" alt="left"/></span>
                                        <span class="cb_right"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_right.png" alt="right"/></span>
                                        <span class="cb_top-left"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_left-top.png" alt="left-top"/></span>
                                        <span class="cb_top-right"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_right-top.png" alt="right-top"/></span>
                                        <span class="cb_bottom-left"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_left-bottom.png" alt="left-bottom"/></span>
                                        <span class="cb_bottom-right"><img src="<?php echo home_url('/wp-content/uploads/'); ?>images/temp/border_right-bottom.png" alt="right-bottom"/></span>
                                        <input type="text" placeholder="Поиск чудес"/>
                                    </div>
                                    <button type="submit">
                                        <img class="fullContainer" src="<?php echo home_url('/wp-content/uploads/'); ?>svg/search_icon.svg" alt="#"/>
                                        <span class="rabbit">
                                            <span class="fullContainer transition">
                                                <svg class="rabbitImg" xmlns="http://www.w3.org/2000/svg" height="74.06" viewBox="0 0 41.938 74.063"><path d="m40.92 54.15c-.182 4.467-2.92 18.913-2.92 18.913h-17l-17.387-.08c0 0-2.973-16.267-2.573-20.13.847-8.178 1.189-14.83 7.719-18.13-.224-5.739-2.864-16.36-2.591-22.13.154-3.274.375-9.134 3.958-10.854 10.276-4.932 8.306 15.89 7.874 31.32-.017.61 5.196.37 5.196.37 0 0-1.235-30.521 7.998-29.982 5.43-.886 5.445 6.274 5.153 11.56-.373 6.732-2.373 14.496-4.146 21.01 7.441 3.044 9.04 10.155 8.719 18.13" fill="#aebbf1" stroke="#000" fill-rule="evenodd" stroke-width="2"/></svg>
                                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 12" enable-background="new 0 0 7 12"><path d="m6.8 6.5c.2-.4.3-.9 0-1.3-1.5-2-3.9-4.1-5.3-5.1-.8-.4-1.2.4-1.3.6-.1.4-.1.9 0 1.1 1.2 1.3 4.1 3.6 4.1 4 0 .7-3 3-4.2 4.4 0 0-.3.7.1 1.2.4.5 1.4.9 2 .3 1.5-1.7 2.9-3.2 4.4-4.9-.1 0 .2-.2.2-.3" fill-rule="evenodd"/></svg>
                                            </span>
                                        </span>
                                    </button>
                                </form>
                                <div class="registr">
                                    <a href="#" class="user-enter transition">Вход</a>/<a href="#" class="user-registr transition">Регистрация</a>
                                </div>
                                <div class="basket">
                                    <a href="#" class="transition">Корзина
                                        <span>
                                            <svg class="svg-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 28" enable-background="new 0 0 30 28"><path d="m0 14.1c.3 7.9 7.9 13.5 15.6 13.9 6.9.4 14.4-7.7 14.4-14.2 0 0 0 0 0-.1 0 0 0-.1 0-.1-1-8.5-7-12.2-15.1-13.5-7.6-1.2-15.2 6.7-14.9 14"/></svg>
                                            <svg class="svg-in transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 28" enable-background="new 0 0 30 28"><path d="m0 14.1c.3 7.9 7.9 13.5 15.6 13.9 6.9.4 14.4-7.7 14.4-14.2 0 0 0 0 0-.1 0 0 0-.1 0-.1-1-8.5-7-12.2-15.1-13.5-7.6-1.2-15.2 6.7-14.9 14"/></svg>
                                            <span class="transition">38</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="language">
                                    <select class="circle-select">
                                        <option>BYR</option>
                                        <option>RUS</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </header>
                    
                    <div id="main">
                        <div id="content">

