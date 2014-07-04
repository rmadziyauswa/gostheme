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

		$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

		$footer_text = "Copyright ". date("Y")." ". get_bloginfo('name').".Goscustom Theme By <a href='http://www.kozmikinc.com'>Kozmik</a>";
	
		if(isset($options['liquidblank_footer_text']))
		{
			$footer_text = $options['liquidblank_footer_text'];
			
		}

		echo $footer_text;

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
			<div id="icon-tools" class="icon32"></div>
			<h3>Customise Your Theme Options</h3>

			<style type="text/css">
				.form-table th {
					width: 325px;
					}
			</style>

			<div id="tabs">

				<ul>
					<li><a href="#top_nav_div">Navigation Options</a></li>
					<li><a href="#primary_nav_div">Social Options</a></li>
					<li><a href="#copyright_div">Copyright Text</a></li>
					<li><a href="#scripts_div">Scripts And Custom Styles</a></li>
				</ul>


				<div id="top_nav_div">

					<form action="options.php" method="post">

						<?php settings_fields('liquidblank_theme_options_group'); ?>
						<?php do_settings_sections(__FILE__); ?>
						<?php submit_button(); ?>

					</form>
				</div>


				<div id="primary_nav_div">

						<form action='options.php' method='post'>

						<?php settings_fields('liquidblank_theme_options_group'); ?>
						<?php do_settings_sections('my-theme-page#primary_nav_div'); ?>
						<?php submit_button(); ?>

					</form>

					</div>
				<div id="copyright_div">
					<form action='options.php' method='post'>

						<?php settings_fields('liquidblank_theme_options_group'); ?>
						<?php do_settings_sections('my-theme-page#copyright_div'); ?>
						<?php submit_button(); ?>

					</form>


				</div>


				<div id="scripts_div">
					<form action='options.php' method='post'>

						<?php settings_fields('liquidblank_theme_options_group'); ?>
						<?php do_settings_sections('my-theme-page#scripts_div'); ?>
						<?php submit_button(); ?>

					</form>


				</div>

			</div>


		</div>	

		<?php
	}
	


	function register_liquidblank_theme_settings()
	{
		register_setting('liquidblank_theme_options_group','liquidblank_theme_options_group','validate_setting');
		add_settings_section('liquidblank_style_colors','Customize Theme Colors','customise_theme_colors',__FILE__);
		add_settings_field('liquidblank_top_nav_color','Topmost Navigational Menu Background Color','top_nav_color_setting',__FILE__,'liquidblank_style_colors');
		add_settings_field('liquidblank_top_nav_text_color','Topmost Navigational Menu Text Color','top_nav_text_color_setting',__FILE__,'liquidblank_style_colors');
		add_settings_field('liquidblank_menu_color','Main Navigational Menu Background Color','main_nav_color_setting',__FILE__,'liquidblank_style_colors');
		add_settings_field('liquidblank_menu_text_color','Main Navigational Menu Text Color','main_nav_text_color_setting',__FILE__,'liquidblank_style_colors');

	
		add_settings_section('liquidblank_footer_options','Options for your footer area','customise_footer_area','my-theme-page#copyright_div');
		add_settings_field('liquidblank_footer_text','Footer text for the copyright area','fn_footer_text','my-theme-page#copyright_div','liquidblank_footer_options');
	


		add_settings_section('liquidblank_social_options','Social Options','custome_social_options','my-theme-page#primary_nav_div');
		add_settings_field('liquidblank_facebok_url','Facebook URL','fn_facebook_url','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_twitter_url','Twitter URL','fn_twitter_url','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_googleplus_url','Google Plus URL','fn_googleplus_url','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_pinterest_url','Pinterest URL','fn_pinterest_url','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_flickr_url','Flickr URL','fn_flickr_url','my-theme-page#primary_nav_div','liquidblank_social_options');
	
	}

	add_action('admin_init','register_liquidblank_theme_settings');


		function customise_theme_colors() 
		{
			
		}


		function customise_footer_area() 
		{
			
		}



		function custome_social_options() 
		{
			
		}

	function validate_setting($input)
	{
		return $input;
	}

	function top_nav_color_setting()
	{
		$options = wp_parse_args(get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings));

		if(isset($options['liquidblank_top_nav_color']))
		{
			echo "			
			<input type='text' id='txtliquidblank_top_nav_color' name='liquidblank_theme_options_group[liquidblank_top_nav_color]' value='{$options['liquidblank_top_nav_color']}' />
			<div id='topnav_color_picker'></div>
			";
		
			
		}
		else
		{
			echo "			
			<input type='text' id='txtliquidblank_top_nav_color' name='liquidblank_theme_options_group[liquidblank_top_nav_color]' value='#ba2e1f' />
			<div id='topnav_color_picker'></div>
			";		

			// echo $options['liquidblank_top_nav_color'];


		}



		
	}


	function top_nav_text_color_setting()
	{
		$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

		if(isset($options['liquidblank_top_nav_text_color']))
		{

			echo "
			<input type='text' id='txtliquidblank_top_nav_text_color' name='liquidblank_theme_options_group[liquidblank_top_nav_text_color]' value='{$options['liquidblank_top_nav_text_color'] }' />
			<div id='top_nav_text_color_picker'></div>
			";
		
		}
		else
		{
			echo "
			<input type='text' id='txtliquidblank_top_nav_text_color' name='liquidblank_theme_options_group[liquidblank_top_nav_text_color]' value='#fff' />
			<div id='top_nav_text_color_picker'></div>
			";		}

	}


	function main_nav_color_setting()
	{
		$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);


		if(isset($options['liquidblank_menu_color']))
		{

			echo "
				<input type='text' id='txtliquidblank_menu_nav_color' name='liquidblank_theme_options_group[liquidblank_menu_color]' value='{$options['liquidblank_menu_color']}' />
				<div id='liquidblank_menu_color_picker'></div>
			";
		}
		else
		{
			echo "
				<input type='text' id='txtliquidblank_menu_nav_color' name='liquidblank_theme_options_group[liquidblank_menu_color]' value='#333333' />
				<div id='liquidblank_menu_color_picker'></div>
			";

		}
	}


	function main_nav_text_color_setting()
	{
		$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

		if(isset($options['liquidblank_menu_text_color']))
		{

			echo "
				<input type='text' id='txtliquidblank_menu_nav_text_color' name='liquidblank_theme_options_group[liquidblank_menu_text_color]' value='{$options['liquidblank_menu_text_color']}' />
				<div id='liquidblank_menu_text_color_picker'></div>
			";


		}
		else
		{

			echo "
				<input type='text' id='txtliquidblank_menu_nav_text_color' name='liquidblank_theme_options_group[liquidblank_menu_text_color]' value='#e9e8e3' />
				<div id='liquidblank_menu_text_color_picker'></div>
			";
		}
	}



		function fn_footer_text()
		{
			$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

			if(isset($options['liquidblank_footer_text']))
			{

				echo "
					<textarea id='txtliquidblank_footer_text' name='liquidblank_theme_options_group[liquidblank_footer_text]'> {$options['liquidblank_footer_text']} </textarea>
				";


			}
			else
			{

					echo "
					<textarea id='txtliquidblank_footer_text' name='liquidblank_theme_options_group[liquidblank_footer_text]'></textarea>
				";
			}
		}


		function fn_facebook_url()
		{
			$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

			if(isset($options['liquidblank_facebook_url']))
			{

				echo "
					<input type='text' id='txtliquidblank_facebook_url' name='liquidblank_theme_options_group[liquidblank_facebook_url]' value='{$options['liquidblank_facebook_url']}' />
				";


			}
			else
			{

					echo "
					<input type='text' id='txtliquidblank_facebook_url' name='liquidblank_theme_options_group[liquidblank_facebook_url]' value='' />
				";
			}
		}



		function fn_twitter_url()
		{
			$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

			if(isset($options['liquidblank_twitter_url']))
			{

				echo "
					<input type='text' id='txtliquidblank_twitter_url' name='liquidblank_theme_options_group[liquidblank_twitter_url]' value='{$options['liquidblank_twitter_url']}' />
				";


			}
			else
			{

					echo "
					<input type='text' id='txtliquidblank_twitter_url' name='liquidblank_theme_options_group[liquidblank_twitter_url]' value='' />
				";
			}
		}


			function fn_googleplus_url()
		{
			$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

			if(isset($options['liquidblank_googleplus_url']))
			{

				echo "
					<input type='text' id='txtliquidblank_googleplus_url' name='liquidblank_theme_options_group[liquidblank_googleplus_url]' value='{$options['liquidblank_googleplus_url']}' />
				";


			}
			else
			{

					echo "
					<input type='text' id='txtliquidblank_googleplus_url' name='liquidblank_theme_options_group[liquidblank_googleplus_url]' value='' />
				";
			}
		}


			function fn_pinterest_url()
		{
			$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

			if(isset($options['liquidblank_pinterest_url']))
			{

				echo "
					<input type='text' id='txtliquidblank_pinterest_url' name='liquidblank_theme_options_group[liquidblank_pinterest_url]' value='{$options['liquidblank_pinterest_url']}' />
				";


			}
			else
			{

					echo "
					<input type='text' id='txtliquidblank_pinterest_url' name='liquidblank_theme_options_group[liquidblank_pinterest_url]' value='' />
				";
			}
		}


			function fn_flickr_url()
		{
			$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

			if(isset($options['liquidblank_flickr_url']))
			{

				echo "
					<input type='text' id='txtliquidblank_flickr_url' name='liquidblank_theme_options_group[liquidblank_flickr_url]' value='{$options['liquidblank_flickr_url']}' />
				";


			}
			else
			{

					echo "
					<input type='text' id='txtliquidblank_flickr_url' name='liquidblank_theme_options_group[liquidblank_flickr_url]' value='' />
				";
			}
		}



add_action('init','liquidblank_farbtastic_script');

function liquidblank_farbtastic_script()
{
		wp_enqueue_script('farbtastic');
		wp_enqueue_style('farbtastic');
		wp_enqueue_script( 'liquidblank-script', get_template_directory_uri() . '/js/farbtasticjs.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'jquery-ui-core','',array('jquery'),'',true);
		wp_enqueue_script( 'jquery-ui-widget');
		wp_enqueue_script( 'jquery-ui-tabs');
		wp_enqueue_style('jqueryuistylesheet', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/cupertino/jquery-ui.css');
		wp_enqueue_style('fontawesome', '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css');

}


function liquidblank_custom_style_head()
{
	$options = get_option('liquidblank_theme_options_group',$liquidblank_defaults_settings);

	if(isset($options['liquidblank_top_nav_text_color']))
		{

			echo "
				<style type='text/css'>
					#topmost-nav {
							background-color:".  $options['liquidblank_top_nav_color'] ." ;
							color: ". $options['liquidblank_top_nav_text_color'] ." ;
						}
				</style>

			";

		}

}


// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';