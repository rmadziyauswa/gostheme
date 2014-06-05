<?php

function liquidblank_setup() {


	load_theme_textdomain( 'liquidblank', get_template_directory() . '/languages' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'liquidblank-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'liquidblank' ),
		'secondary' => __( 'Secondary menu in topmost div', 'liquidblank' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'liquidblank_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}

add_action( 'after_setup_theme', 'liquidblank_setup' );


function liquidblank_widgets_init() {

	require get_template_directory() . '/inc/widgets.php';


	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'liquidblank' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'liquidblank' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'liquidblank' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'liquidblank' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'liquidblank' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'liquidblank' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'liquidblank_widgets_init' );


function liquidblank_scripts() {
	
	wp_enqueue_style( 'liquidblank-style', get_stylesheet_uri());
	wp_enqueue_script( 'liquidblank-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '', true );
}

add_action( 'wp_enqueue_scripts', 'liquidblank_scripts' );

function liquidblank_pagination() 
{

						posts_nav_link();
						

	}


	function liquidblank_prevnext() 
{
	
						

					// Previous/next post navigation.
						echo "<div class='PreviousNext'>";

						echo "<div class='prev-link'>";
						 	previous_post(); 
						 echo "</div>";

						 echo "<div class='next-link'>";
						 	next_post(); 
						 echo "</div>";

						 echo "</div>";
					
						

	}

	function liquidblank_the_attached_image()
	{
		wp_get_attachement_image(0);
	}

	function liquidblank_get_footer_signature()
	{
		echo "Copyright ". date("Y").". ". get_bloginfo('name').". Powered By <a href='http://www.wordpress.org'>Wordpress</a>";
	}