( function( $ ) {
	// Responsive videos
	var all_videos = $( '.entry-content' ).find( 'iframe[src*="player.vimeo.com"], iframe[src*="youtube.com"], iframe[src*="youtube-nocookie.com"], iframe[src*="dailymotion.com"],iframe[src*="kickstarter.com"][src*="video.html"], object, embed' ),
		container = $( '#boxes' );

	all_videos = all_videos.not( 'object object' );

	all_videos.each( function() {
		var video = $(this);

		if ( video.parents( 'object' ).length )
			return;

		if ( ! video.prop( 'id' ) )
			video.attr( 'id', 'rvw' + Math.floor( Math.random() * 999999 ) );

		video
			.wrap( '<div class="responsive-video-wrapper" style="padding-top: ' + ( video.attr( 'height' ) / video.attr( 'width' ) * 100 ) + '%" />' )
			.removeAttr( 'height' )
			.removeAttr( 'width' );
	} );

	// Masonry
	if ( theme_js_vars['loader'] ) {
		container.imagesLoaded( function() {
			container.masonry().css( 'visibility', 'visible' );
		} );
	}

	// Mobile menu
	$( '#mobile-menu' ).on( 'click', 'a', function() {
		if ( $(this).hasClass( 'left-menu' ) )
			$( 'body' ).toggleClass( 'left-menu-open' );
		else if ( $(this).hasClass( 'mobile-search' ) )
			$( '#drop-down-search' ).slideToggle( 'fast' );
	} );

	$( '#site-navigation' ).on( 'click', '.sub-menu-parent > a', function(e) {
		e.preventDefault();
		$(this).toggleClass( 'open' ).parent().find( '.sub-menu:first' ).slideToggle();
	} );

	var id = $( '#secondary' );
	Harvey.attach( 'screen and (max-width:768px)', {
      	setup: function() {
      		id.addClass( 'offcanvas' );
      	},
      	on: function() {
      		id.addClass( 'offcanvas' );
      	},
      	off: function() {
      		id.removeClass( 'offcanvas' );
      		$( 'body' ).removeClass( 'left-menu-open' );
			$( '#drop-down-search' ).hide();
      	}
    } );

	// Image anchor
	$( 'a:has(img)' ).addClass('image-anchor');

	// Shortcode
	if ( theme_js_vars['carousel'] )
		$( '.carousel' ).carousel();

	if ( theme_js_vars['tooltip'] )
		$( 'a[rel="tooltip"]' ).tooltip();

	if ( theme_js_vars['tabs'] ) {
		$( '.nav-tabs a' ).click( function(e) {
			e.preventDefault();
			$(this).tab( 'show' );
		} );
	}

	$( 'a[href="#"]' ).click( function(e) {
		e.preventDefault();
	});
} )( jQuery );