<article id="post-<?php the_ID(); ?>">
	<?php
		// Page thumbnail and title.
		<?php get_the_post_thumbnail(); ?>
		the_title( '<header><h1>', '</h1></header><!-- .entry-header -->' );
	?>

	<div>
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div><span>' . __( 'Pages:', 'liquidblank' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );

			edit_post_link( __( 'Edit', 'liquidblank' ), '<span class="edit-link">', '</span>' );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
