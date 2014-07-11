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

}

add_action( 'after_setup_theme', 'liquidblank_setup' );


function liquidblank_widgets_init() {

	require get_template_directory() . '/inc/widgets.php';

	liquidblank_register_sidebar('Left Sidebar','sidebar-1','Main sidebar that appears on the left.');
	liquidblank_register_sidebar('Right Sidebar','sidebar-2','Main sidebar that appears on the right.');
	liquidblank_register_sidebar('Footer Sidebar Left','sidebar-3','Left Footer Sidebar');
	liquidblank_register_sidebar('Footer Sidebar Center','sidebar-4','Center Footer Sidebar');
	liquidblank_register_sidebar('Footer Sidebar Right','sidebar-5','Right Footer Sidebar');

}


function liquidblank_register_sidebar($sidebar_name,$sidebar_id,$sidebar_description)
{
		register_sidebar( array(
		'name'          => __( $sidebar_name, 'liquidblank' ),
		'id'            => $sidebar_id,
		'description'   => __( $sidebar_description, 'liquidblank' ),
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

		$options = get_option('liquidblank_theme_options_group');

		$footer_text = "Copyright ". date("Y")." ". get_bloginfo('name').".Goscustom Theme By <a href='http://www.kozmikinc.com'>Kozmik</a>";
	
		if(isset($options['liquidblank_footer_text']))
		{
			$footer_text = $options['liquidblank_footer_text'];
			
		}

		echo $footer_text;

	}

	function liquidblank_share_post()
	{
		$options = get_option('liquidblank_theme_options_group');

		$perma = get_permalink();
		$title = get_the_title();

		if(isset($options['liquidblank_share_facebook']))
		{	

			echo "
			<a href='http://www.facebook.com/sharer.php?u=$perma' target='_blank'>
			 	<i class='icon-facebook icon-2x'></i>
			</a>
			";

		}


		if(isset($options['liquidblank_share_twitter']))
		{	

			echo "
			<a href='http://twitter.com/share?url=$perma&text=$title' target='_blank'>
			 	<i class='icon-twitter icon-2x'></i>
			</a>
			";

		}



		if(isset($options['liquidblank_share_google_plus']))
		{	

			echo "
				
			<a href='https://plus.google.com/share?url=$perma' target='_blank'>
			 	<i class='icon-google-plus-sign icon-2x'></i>
			</a>

			";

		}

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
				<form action='options.php' method='post'>

				<ul>
					<li><a href="#top_nav_div">Navigation Options</a></li>
					<li><a href="#primary_nav_div">Social Options</a></li>
					<li><a href="#copyright_div">Copyright Text</a></li>
					<li><a href="#scripts_div">Scripts And Custom Styles</a></li>
					<li><a href="#contacts_div">Contact Details</a></li>
				</ul>


				<div id="top_nav_div">

					<!-- <form action="options.php" method="post"> -->

						<?php settings_fields('liquidblank_theme_options_group'); ?>
						<?php do_settings_sections(__FILE__); ?>
						<!-- <?php submit_button(); ?> -->

					<!-- </form> -->
				</div>


				<div id="primary_nav_div">

						<!-- <form action='options.php' method='post'> -->

						<?php settings_fields('liquidblank_theme_options_group'); ?>
						<?php do_settings_sections('my-theme-page#primary_nav_div'); ?>
						<!-- <?php submit_button(); ?> -->

					<!-- </form> -->

					</div>
				<div id="copyright_div">
					<!-- <form action='options.php' method='post'> -->

						<?php settings_fields('liquidblank_theme_options_group'); ?>
						<?php do_settings_sections('my-theme-page#copyright_div'); ?>
						<!-- <?php submit_button(); ?> -->

					<!-- </form> -->


				</div>


				<div id="scripts_div">

						<?php settings_fields('liquidblank_theme_options_group'); ?>
						<?php do_settings_sections('my-theme-page#scripts_div'); ?>


				</div>


				<div id="contacts_div">


						 <?php settings_fields('liquidblank_theme_options_group'); ?>
						 <?php do_settings_sections('my-theme-page#contacts_div'); ?>

						


				</div>

			</div>

			<?php submit_button(); ?>
</form>

		</div>	

		<?php
	}
	


	function SpitOutSettings()
	{
		$options = get_option('liquidblank_theme_options_group');

		foreach ($options as $key => $value) {
			

			echo $key. "=" . $value . "<br />";
		}

	}




	function register_liquidblank_theme_settings()
	{
		register_setting('liquidblank_theme_options_group','liquidblank_theme_options_group','validate_setting');
		
		//Colors Navigational Settings
		add_settings_section('liquidblank_style_colors','Customize Theme Colors','customise_theme_colors',__FILE__);
		add_settings_field('liquidblank_custom_favicon','Path to your custom favicon (Include http://)','fn_custom_favicon',__FILE__,'liquidblank_style_colors');
		add_settings_field('liquidblank_use_top_nav_menu','Do you want to use the top most navigational menu','fn_use_top_nav_menu',__FILE__,'liquidblank_style_colors');
		add_settings_field('liquidblank_top_nav_color','Topmost Navigational Menu Background Color','top_nav_color_setting',__FILE__,'liquidblank_style_colors');
		add_settings_field('liquidblank_top_nav_text_color','Topmost Navigational Menu Text Color','top_nav_text_color_setting',__FILE__,'liquidblank_style_colors');
		add_settings_field('liquidblank_menu_color','Main Navigational Menu Background Color','main_nav_color_setting',__FILE__,'liquidblank_style_colors');
		add_settings_field('liquidblank_menu_text_color','Main Navigational Menu Text Color','main_nav_text_color_setting',__FILE__,'liquidblank_style_colors');
		//custom fonts
		add_settings_field('liquidblank_menu_font','The font to use on navigational menus','fn_menu_font',__FILE__,'liquidblank_style_colors');
		add_settings_field('liquidblank_body_font','The font to use for your content','fn_body_font',__FILE__,'liquidblank_style_colors');

	
		//footer options
		add_settings_section('liquidblank_footer_options','Options for your footer area','customise_footer_area','my-theme-page#copyright_div');
		add_settings_field('liquidblank_footer_text','Footer text for the copyright area','fn_footer_text','my-theme-page#copyright_div','liquidblank_footer_options');
	


		//Social Options
		add_settings_section('liquidblank_social_options','Social Options','custome_social_options','my-theme-page#primary_nav_div');
		add_settings_field('liquidblank_facebok_url','Facebook URL','fn_facebook_url','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_twitter_url','Twitter URL','fn_twitter_url','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_googleplus_url','Google Plus URL','fn_googleplus_url','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_pinterest_url','Pinterest URL','fn_pinterest_url','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_flickr_url','Flickr URL','fn_flickr_url','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_share_facebook','Do you want to allow sharing posts to Facebook','fn_share_facebook','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_share_twitter','Do you want to allow sharing posts to Twitter','fn_share_twitter','my-theme-page#primary_nav_div','liquidblank_social_options');
		add_settings_field('liquidblank_share_google_plus','Do you want to allow sharing posts to Google Plus','fn_share_google_plus','my-theme-page#primary_nav_div','liquidblank_social_options');

		//scripts/styles options
		add_settings_section('liquidblank_scripts_options','Add Custom CSS & Scripts','customise_scripts_area','my-theme-page#scripts_div');
		add_settings_field('liquidblank_custom_css','Custom CSS','fn_custom_css','my-theme-page#scripts_div','liquidblank_scripts_options');
		add_settings_field('liquidblank_analytics_code','Google Analytics Code','fn_analytics_code','my-theme-page#scripts_div','liquidblank_scripts_options');
	


		//contact details options
		add_settings_section('liquidblank_contact_options','Contact Details For Your Contacts Page','customise_contacts_area','my-theme-page#contacts_div');
		add_settings_field('liquidblank_contact_address','Your Physical Address','fn_contact_address','my-theme-page#contacts_div','liquidblank_contact_options');
		add_settings_field('liquidblank_contact_phone','Your Phone Number','fn_contact_phone','my-theme-page#contacts_div','liquidblank_contact_options');
		add_settings_field('liquidblank_contact_email','Your Email Address','fn_contact_email','my-theme-page#contacts_div','liquidblank_contact_options');
		add_settings_field('liquidblank_contact_map_code','Your Google Map Emded Code','fn_contact_map_code','my-theme-page#contacts_div','liquidblank_contact_options');
	



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



		function customise_scripts_area() 
		{
			
		}

		function customise_contacts_area() 
		{
			
		}

	function validate_setting($input)
	{
		return $input;
	}



		function fn_share_facebook()
	{
		$options = get_option('liquidblank_theme_options_group');

		$checked = $options['liquidblank_share_facebook'] ? "checked='checked'" : "";


		if(isset($options['liquidblank_share_facebook']))
		{
			
			echo "			
			<input type='checkbox' id='chkliquidblank_share_facebook' name='liquidblank_theme_options_group[liquidblank_share_facebook]' $checked />
			";
		
			
		}
		else
		{
			
			echo "			
			<input type='checkbox' id='chkliquidblank_share_facebook' name='liquidblank_theme_options_group[liquidblank_share_facebook]' $checked />
			";
		}



		
	}



			function fn_share_twitter()
	{
		$options = get_option('liquidblank_theme_options_group');

		$checked = $options['liquidblank_share_twitter'] ? "checked='checked'" : "";


		if(isset($options['liquidblank_share_twitter']))
		{
			
			echo "			
			<input type='checkbox' id='chkliquidblank_share_twitter' name='liquidblank_theme_options_group[liquidblank_share_twitter]' $checked />
			";
		
			
		}
		else
		{
			
		
			echo "			
			<input type='checkbox' id='chkliquidblank_share_twitter' name='liquidblank_theme_options_group[liquidblank_share_twitter]' $checked />
			";
		
		}



		
	}



			function fn_share_google_plus()
	{
		$options = get_option('liquidblank_theme_options_group');

		$checked = $options['liquidblank_share_google_plus'] ? "checked='checked'" : "";


		if(isset($options['liquidblank_share_google_plus']))
		{
			
			echo "			
			<input type='checkbox' id='chkliquidblank_share_google_plus' name='liquidblank_theme_options_group[liquidblank_share_google_plus]' $checked />
			";
		
			
		}
		else
		{
			
		
			echo "			
			<input type='checkbox' id='chkliquidblank_share_google_plus' name='liquidblank_theme_options_group[liquidblank_share_google_plus]' $checked />
			";
		
		}



		
	}



	$google_fonts = array(
		"Roboto" => "Roboto",
		"Oswald" => "Oswald",
		 "Arvo" => "Arvo",
		 "Merriweather" => "Merriweather",
		 "Play" => "Play"
	);



	function fn_body_font()
	{

		global $google_fonts;


		$options = get_option('liquidblank_theme_options_group');

		
		if(isset($options['liquidblank_body_font']))
		{
			
			echo "			
			<select id='cboliquidblank_body_font' name='liquidblank_theme_options_group[liquidblank_body_font]'>

			";

			foreach ($google_fonts as $key => $value) {

				$selected = ($options['liquidblank_body_font']==$value ? "selected='selected'" : "");
				
				echo "<option value='$key' $selected>$value</option>";
			}


			echo "</select>";
		
			
		}
		else
		{

				echo "			
			<select id='cboliquidblank_body_font' name='liquidblank_theme_options_group[liquidblank_body_font]'>

			";

			foreach ($google_fonts as $key => $value) {

				
				echo "<option value='$key'>$value</option>";
			}


			echo "</select>";

		}



		
	}




	function fn_menu_font()
	{

		global $google_fonts;


		$options = get_option('liquidblank_theme_options_group');

		
		if(isset($options['liquidblank_menu_font']))
		{
			
			echo "			
			<select id='cboliquidblank_menu_font' name='liquidblank_theme_options_group[liquidblank_menu_font]'>

			";

			foreach ($google_fonts as $key => $value) {

				$selected = ($options['liquidblank_menu_font']==$value ? "selected='selected'" : "");
				
				echo "<option value='$key' $selected>$value</option>";
			}


			echo "</select>";
		
			
		}
		else
		{

				echo "			
			<select id='cboliquidblank_menu_font' name='liquidblank_theme_options_group[liquidblank_menu_font]'>

			";

			foreach ($google_fonts as $key => $value) {

				
				echo "<option value='$key'>$value</option>";
			}


			echo "</select>";

		}



		
	}



	function fn_use_top_nav_menu()
	{
		$options = get_option('liquidblank_theme_options_group');

		$checked = $options['liquidblank_use_top_nav_menu'] ? "checked='checked'" : "";

		// echo "Status ( $checked )";

		if(isset($options['liquidblank_use_top_nav_menu']))
		{
			
			echo "			
			<input type='checkbox' id='chkliquidblank_use_top_nav_menu' name='liquidblank_theme_options_group[liquidblank_use_top_nav_menu]' $checked />
			";
		
			
		}
		else
		{

				echo "			
			<input type='checkbox' id='chkliquidblank_use_top_nav_menu' name='liquidblank_theme_options_group[liquidblank_use_top_nav_menu]' $checked />
			";
		}



		
	}





	function fn_custom_favicon()
	{
		$options = get_option('liquidblank_theme_options_group');

		if(isset($options['liquidblank_custom_favicon']))
		{
			echo "			
			<input type='text' id='txtliquidblank_custom_favicon' name='liquidblank_theme_options_group[liquidblank_custom_favicon]' value='{$options['liquidblank_custom_favicon']}' />
		
			";
		
			
		}
		else
		{
			echo "			
			<input type='text' id='txtliquidblank_custom_favicon' name='liquidblank_theme_options_group[liquidblank_custom_favicon]' value='' />
		
			";


		}



		
	}




	function top_nav_color_setting()
	{
		$options = get_option('liquidblank_theme_options_group');

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
		$options = get_option('liquidblank_theme_options_group');

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
		$options = get_option('liquidblank_theme_options_group');


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
		$options = get_option('liquidblank_theme_options_group');

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
			$options = get_option('liquidblank_theme_options_group');

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
			$options = get_option('liquidblank_theme_options_group');

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
			$options = get_option('liquidblank_theme_options_group');

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
			$options = get_option('liquidblank_theme_options_group');

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
			$options = get_option('liquidblank_theme_options_group');

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
			$options = get_option('liquidblank_theme_options_group');

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




		function fn_custom_css()
		{
			$options = get_option('liquidblank_theme_options_group');

			if(isset($options['liquidblank_custom_css']))
			{

				echo "
					<textarea id='txtliquidblank_custom_css' name='liquidblank_theme_options_group[liquidblank_custom_css]'> {$options['liquidblank_custom_css']} </textarea>
				";


			}
			else
			{

					echo "
					<textarea id='txtliquidblank_custom_css' name='liquidblank_theme_options_group[liquidblank_custom_css]'>  </textarea>
				";
			}
		}




		function fn_analytics_code()
		{
			$options = get_option('liquidblank_theme_options_group');

			if(isset($options['liquidblank_analytics_code']))
			{

				echo "
					<textarea id='txtliquidblank_analytics_code' name='liquidblank_theme_options_group[liquidblank_analytics_code]'> {$options['liquidblank_analytics_code']} </textarea>
				";


			}
			else
			{

					echo "
					<textarea id='txtliquidblank_analytics_code' name='liquidblank_theme_options_group[liquidblank_analytics_code]'>  </textarea>
				";
			}
		}


			function fn_contact_address()
		{
			$options = get_option('liquidblank_theme_options_group');

			if(isset($options['liquidblank_contact_address']))
			{

				echo "
					<textarea id='txtliquidblank_contact_address' name='liquidblank_theme_options_group[liquidblank_contact_address]'> {$options['liquidblank_contact_address']} </textarea>
				";


			}
			else
			{

					echo "
					<textarea id='txtliquidblank_contact_address' name='liquidblank_theme_options_group[liquidblank_contact_address]'>  </textarea>
				";
			}
		}


			function fn_contact_map_code()
		{
			$options = get_option('liquidblank_theme_options_group');

			if(isset($options['liquidblank_contact_map_code']))
			{

				echo "
					<textarea id='txtliquidblank_contact_map_code' name='liquidblank_theme_options_group[liquidblank_contact_map_code]'> {$options['liquidblank_contact_map_code']} </textarea>
				";


			}
			else
			{

				echo "
					<textarea id='txtliquidblank_contact_map_code' name='liquidblank_theme_options_group[liquidblank_contact_map_code]'>  </textarea>
				";
			}
		}



		function fn_contact_email()
		{
			$options = get_option('liquidblank_theme_options_group');

			if(isset($options['liquidblank_contact_email']))
			{

				echo "
					<input type='text' id='txtliquidblank_contact_email' name='liquidblank_theme_options_group[liquidblank_contact_email]' value='{$options['liquidblank_contact_email']}' />
				";


			}
			else
			{

				echo "
					<input type='text' id='txtliquidblank_contact_email' name='liquidblank_theme_options_group[liquidblank_contact_email]' value='' />
				";
			}
		}



		function fn_contact_phone()
		{
			$options = get_option('liquidblank_theme_options_group');

			if(isset($options['liquidblank_contact_phone']))
			{

				echo "
					<input type='text' id='txtliquidblank_contact_phone' name='liquidblank_theme_options_group[liquidblank_contact_phone]' value='{$options['liquidblank_contact_phone']}' />
				";


			}
			else
			{

					echo "
					<input type='text' id='txtliquidblank_contact_phone' name='liquidblank_theme_options_group[liquidblank_contact_phone]' value='' />
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
		wp_enqueue_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');

}


function liquidblank_custom_style_head()
{
	$options = get_option('liquidblank_theme_options_group');

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



/**
* Shortcode plugin for font awesome
*Called in posts as [lbfa icon="facebook" sizeclass="icnon-4x"]
*
*
**/

function liquidblank_font_awesome($atts)
{
	$a = shortcode_atts(
		array(
			'icon' => '',
			'sizeclass' => ''
			),$atts
		);

	//the font awesome icon
	$icon = $a['icon'];
	$sizeclass = $a['sizeclass'];

	//the output string to output in html
	$spit_string = "<i class='icon-" . $icon . " " . $sizeclass ."'></i>";

	return $spit_string;
}

add_shortcode('lbfa','liquidblank_font_awesome');




/**
* Shortcode plugin for youtube embed videos
*Called in posts as [lbyoutube vid="fohqH-GeN6w" width="560" height="315"]
* vid is the youtube video idea from the url e.g. https://www.youtube.com/watch?v=vQbiZ96UZ9M i.e. the number after v=
*
**/

function liquidblank_embed_youtube($atts)
{
	$a = shortcode_atts(
		array(
			'vid' => '',
			'width' => '560',
			'height' => '315'
			),$atts
		);

	//the video parameters video,width,height
	$vid = $a['vid'];
	$width = $a['width'];
	$height = $a['height'];

	//the output string to output in html
	$spit_string = "<iframe width='". $width."' height='". $height ."' src='//www.youtube.com/embed/". $vid ."' frameborder='0' allowfullscreen></iframe>";

	return $spit_string;
}

add_shortcode('lbyoutube','liquidblank_embed_youtube');




/**
* Shortcode plugin for google maps embed 
*Called in posts as [lbmap address="20 Sea Cottage Drive, Noordhoek,Cape Town, South Africa" width="560" height="315"]
* Outputs something like
*<iframe
 * width="600"
  *height="450"
 * frameborder="0" style="border:0"
  *src="https://www.google.com/maps/embed/v1/place?key=AIzaSyABHP4EHBkLfGeR2GTqWV0J1d0U9GM8k4I
   * &q=20 Sea Cottage Drive, Noordhoek,Cape Town, South Africa">
*</iframe>
**/

function liquidblank_embed_google_map($atts)
{
	$a = shortcode_atts(
		array(
			'address' => '',
			'width' => '600',
			'height' => '450'
			),$atts
		);

	//the map parameters address,width,height
	$address = $a['address'];
	$width = $a['width'];
	$height = $a['height'];

	//the output string to output in html
	$spit_string = "<iframe width='". $width."' height='". $height ."' src='https://www.google.com/maps/embed/v1/place?key=AIzaSyABHP4EHBkLfGeR2GTqWV0J1d0U9GM8k4I&q=". $address ."' frameborder='0'></iframe>";

	return $spit_string;
}

add_shortcode('lbmap','liquidblank_embed_google_map');




/**
* Shortcode plugin for login form
*[lblogin]
*
*
**/

function liquidblank_login_form()
{
	$args = array(
		'echo' => true, 
		'form_id' => 'login_form', 
		'remember' => true
		);

	if(!is_user_logged_in())
	{
		wp_login_form($args);
	}
	else
	{
		wp_loginout(get_home_url());
	}

}

add_shortcode('lblogin','liquidblank_login_form');




// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';