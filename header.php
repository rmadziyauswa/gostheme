<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/bootstrap.min.css'; ?>" >
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="container">
	<div id="topmost-nav" class="row">
		
		<div class="menu-topmostnav col-md-6" id="topmost-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'menu' ) ); ?>
		</div>

		<div id="search-container">
			
				<?php get_search_form(); ?>
			
		</div>

	</div>

		<div id="site-title-row" class="row">
			<div class="col-md-7 site-title">
				<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<span id="site-description"><?php echo get_bloginfo('description'); ?></span>
			</div>

			<div id="social-connect" class="col-md-5">
				<ul class="menu">
					<li><a href="#"><img src="<?php echo get_stylesheet_directory_uri().'/images/facebook.png' ?>" ></a></li>
					<li><a href="#"><img src="<?php echo get_stylesheet_directory_uri().'/images/twitter.png' ?>" ></a></li>
					<li><a href="#"><img src="<?php echo get_stylesheet_directory_uri().'/images/googleplus.png' ?>" ></a></li>
				</ul>

			</div>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle"><?php _e( 'Menu', '_liquidblank' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
		

		
	

	<div id="main" class="site-main row">
