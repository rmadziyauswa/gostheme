<?php
/**
 * The Footer Sidebar
 *
 */

if ( ! is_active_sidebar( 'sidebar-3' ) ) {
	return;
}
?>

<div id="supplementary">
	<div id="footer-sidebar" role="complementary">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</div><!-- #footer-sidebar -->
</div><!-- #supplementary -->
