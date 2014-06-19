<?php


get_header(); ?>


		<div id="content" role="main">
			
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					get_template_part( 'content', get_post_format() );


					liquidblank_prevnext() ; // Previous/next post navigation.

					?>

					

						 <?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content -->

<?php
get_sidebar();
get_footer();
