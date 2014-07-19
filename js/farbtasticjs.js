/**
 * Theme functions file
 *
 *
 */
( function( $ ) {



	//farbtatsic for top nav menu
	$('#topnav_color_picker').hide();

	$('#topnav_color_picker').farbtastic('#txtliquidblank_top_nav_color');

	$('#txtliquidblank_top_nav_color').click(function(){

		$('#topnav_color_picker').slideToggle();
	});



	$('#top_nav_text_color_picker').hide();

	$('#top_nav_text_color_picker').farbtastic('#txtliquidblank_top_nav_text_color');

	$('#txtliquidblank_top_nav_text_color').click(function(){

		$('#top_nav_text_color_picker').slideToggle();
	});



	//farbtatsic for main navigational menu
	$('#liquidblank_menu_color_picker').hide();

	$('#liquidblank_menu_color_picker').farbtastic('#txtliquidblank_menu_nav_color');

	$('#txtliquidblank_menu_nav_color').click(function(){

		$('#liquidblank_menu_color_picker').slideToggle();
	});


		$('#liquidblank_menu_text_color_picker').hide();

	$('#liquidblank_menu_text_color_picker').farbtastic('#txtliquidblank_menu_nav_text_color');

	$('#txtliquidblank_menu_nav_text_color').click(function(){

		$('#liquidblank_menu_text_color_picker').slideToggle();
	});




	//some jquery ui tabs for thme options page
	$('#tabs').tabs();





} )( jQuery );
