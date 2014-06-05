<article id="post-<?php the_ID(); ?>" >
	<?php get_the_post_thumbnail(); ?>

	<header >
		
		
		<?php
			

			if ( is_single() ) :
				the_title( '<h1>', '</h1>' );
			else :
				the_title( '<h1><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>
		<div>
			
			<?php 

				
				echo "Category : ";
				the_category(' ,');

			?>
		</div>
		<br />
		<div class="entry-meta">
			<?php
				if ( 'post' == get_post_type() )
					echo "<span class='date-link'>";
						the_date();
					echo "</span>";

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'liquidblank' ), __( '1 Comment', 'liquidblank' ), __( '% Comments', 'liquidblank' ) ); ?></span>
			<?php
				endif;

				edit_post_link( __( 'Edit', 'liquidblank' ), '<span class="edit-link">', '</span>' );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->


	<br />


	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>') );
			wp_link_pages( array(
				'before'      => '<div><span>' . __( 'Pages:', 'liquidblank' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags( '<footer><span>', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
