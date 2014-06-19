<?php


get_header(); ?>

<div id="main-content">

	
		<div id="content" class="site-content" role="main">

		<?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post();

				
					get_template_part( 'content', get_post_format() );

				endwhile;
				// Previous/next post navigation.
				liquidblank_pagination();


			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>

		</div><!-- #content -->

	
</div><!-- #main-content -->

<?php
get_sidebar();
get_sidebar('footer');
get_footer();
