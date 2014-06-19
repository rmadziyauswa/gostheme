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

	$cb_args = array(
		'default-image' => '',
		'default-color' => 'eff2e3',
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' =>'',
		'admin-preview-callback' => ''
		);

	add_theme_support('custom-background',$cb_args);


	// $ch_args = array(
	// 	'default-image' => '',
	// 	'default-text-color' => '000',
	// 	'header-text' => true,
	// 	'uploads' => true,
	// 	'wp-head-callback' => '',
	// 	'admin-head-callback' =>'',
	// 	'admin-preview-callback' => ''
	// 	);
	// add_theme_support('custom-header',$ch_args);


}

add_action( 'after_setup_theme', 'liquidblank_setup' );


function liquidblank_widgets_init() {

	require get_template_directory() . '/inc/widgets.php';


	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'liquidblank' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the right.', 'liquidblank' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );



	register_sidebar( array(
		'name'          => __( 'Footer Sidebar', 'liquidblank' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Footer sidebar that appears above copyright info.', 'liquidblank' ),
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

			echo "<div class='pagination'>";
			

						posts_nav_link();
						
					echo "</div>";	
						
						

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
		echo "Copyright ". date("Y")." ". get_bloginfo('name').".Goscustom Theme By <a href='http://www.kozmikinc.com'>Kozmik</a>";
	}


	function liquidblank_the_category()
	{
		$categories = get_the_category();
		$num_cats = count($categories);

		if($num_cats > 0)	//the post belongs to one or more categories
		{	
			echo "<div>";

				if($num_cats==1)
				{
					echo "Category : ";
				}
				else
				{
					echo "Categories : ";
				}

				the_category(',');
			
			echo "</div>";


		}
	}


	add_action('admin_menu','liquidblank_add_appearance_menu');


	function liquidblank_add_appearance_menu()
	{
			add_theme_page("Theme Options For : Goscustom","Theme Options","edit_theme_options","my-theme-page","liquidblank_theme_options_page");
	}


	function liquidblank_theme_options_page()
	{
		?>

		<div class="wrap">
			<div class="icon32" id="icon-tools"> <br /> </div>
			<h2>Customise Your Theme Options</h2>

			<form action="options.php" method="post" enctype="multipart/form-data">

				<?php settings_fields('liquidblank_theme_options'); ?>
				<?php do_settings_sections(__FILE__); ?>

				<p>
					<input type='submit' name='Submit' class='button-primary' value='Save Changes' />
				</p>
			</form>

		</div>	

		<?php
	}


	add_action('admin_init','register_liquidblank_theme_settings');


	function register_liquidblank_theme_settings()
	{
		register_setting('liquidblank_theme_options','liquidblank_theme_options','validate_setting');
		add_settings_section('liquidblank_style_colors','Customize Theme Colors','customise_theme_colors','__FILE__');
		add_settings_field('liquidblank_top_nav_color','Topmost Navigational Menu Background Color','top_nav_color_setting','__FILE__','liquidblank_style_colors');
		add_settings_field('liquidblank_top_nav_text_color','Topmost Navigational Menu Text Color','top_nav_text_color_setting','__FILE__','liquidblank_style_colors');

	

	}

		function customise_theme_colors() 
		{
			echo "<h2>Wahalade</h2>";
		}


	function top_nav_color_setting()
	{
		$options = get_option('liquidblank_theme_options');
		// echo "<input type='text' name='". liquidblank_theme_options[liquidblank_top_nav_color] ." ' value='" . $options['liquidblank_top_nav_color'] ."' />";
		echo "<input type='text' name='txtliquidblank_top_nav_color' value='" . $options['liquidblank_top_nav_color'] ."' />";
	}


	function top_nav_text_color_setting()
	{
		$options = get_option('liquidblank_theme_options');
		// echo "<input type='text' name='". liquidblank_theme_options[liquidblank_top_nav_text_color] ." ' value='" . $options['liquidblank_top_nav_text_color'] ."' />";
		echo "<input type='text' name='txtliquidblank_top_nav_text_color' value='" . $options['liquidblank_top_nav_text_color'] ."' />";
	}



// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';