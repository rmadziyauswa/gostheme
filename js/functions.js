/**
 * Theme functions file
 *
 *
 */
( function( $ ) {

	function showItem(item)
	{
		//change display from none to block
		$(item).show();
	}


	function hideItem(item)
	{
				//change display from block to none

		$(item).hide();
	}


	$("ul li").hover(function(){



			if($(this).children(".sub-menu").length>0)
			{
				var submenu = $(this).children(".sub-menu")[0];
				showItem(submenu);
			}


	},function(){

		if($(this).children(".sub-menu").length>0)
			{
				var submenu = $(this).children(".sub-menu")[0];
				hideItem(submenu);
			}

	});


} )( jQuery );
