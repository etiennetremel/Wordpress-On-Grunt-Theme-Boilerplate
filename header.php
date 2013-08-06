<!doctype html>
<!--[if lt IE 7]>      <html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>
    <?php wp_title( '-', true, 'right' ); ?>
    <?php bloginfo( 'name' ); ?>
    </title>

    <link rel="icon shortcut" href="<?php bloginfo('template_url'); ?>/assets/images/favicon.png" type="image/x-icon" />
    <link rel="icon" href="<?php bloginfo('template_url'); ?>/assets/images/apple-touch-icon.png" sizes="57x57" />
    <link rel="icon" href="<?php bloginfo('template_url'); ?>/assets/images/apple-touch-icon-72x72.png" sizes="72x72" />
    <link rel="icon" href="<?php bloginfo('template_url'); ?>/assets/images/apple-touch-icon-114x114.png" sizes="114x114" />
    <link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/assets/images/apple-touch-icon.png" />

    <?php get_template_part( 'partials/social' ); ?>

    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php
        if ( function_exists( 'the_theme_setting' ) )
            the_theme_setting( 'ga_code' );
    ?>

	<?php wp_head(); ?>
</head>
<body lang="en" <?php body_class(); ?>>
    <div id="site" class="container">
        <div id="header" class="site-header row">
        	<div id="logo" class="col-3">
        		<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" class="home-link"><img src="<?php bloginfo('template_url'); ?>/assets/images/apple-touch-icon.png" alt="<?php bloginfo('name'); ?>" /></a>
            </div>
            <nav id="main-menu" class="col-9">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' =>'menu' ) ); ?>
            </nav>
        </div>