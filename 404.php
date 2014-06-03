<?php


get_header(); ?>


	<div id="primary">
		<div id="content" role="main">

			<header class="page-header">
				<h1><?php _e( 'Not Found', 'liquidblank' ); ?></h1>
			</header>

			<div>
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'liquidblank' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php

get_sidebar();
get_footer();
