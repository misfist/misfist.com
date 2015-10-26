/* == GRIDZ THEME JAVASCRIPT == */

jQuery(document).ready(function() {    
    /* Dropdown Menu */
    jQuery('.primary-menu ul li').hover(function() {
        jQuery(this).find('ul:first').hide().fadeIn(300);
    },
    function() {
        jQuery(this).find('ul:first').fadeOut(300);
    });
    jQuery('.primary-menu li').has('ul').addClass('has-bottom-child');
    jQuery('.primary-menu li li').has('ul').removeClass('has-bottom-child').addClass('has-right-child');
    
    var searchshow = false;
    jQuery("#search-button").click(function() {
	if(!searchshow) {
	    jQuery("#header #searchform").animate({"width": "170px"}, 500);
	    jQuery("#header #s").val("");
	    searchshow = true;
	} else {
	    jQuery("#header #searchform").animate({"width": "0px"}, 500);
	    jQuery("#header #s").val("");
	    searchshow = false;
	}
    });
    
    /* Responsive dropdown */
    var menushow = true;
    jQuery("#select-menu-item a").click(function() {
	if(menushow) {
	    jQuery("#select-menu-item").parent("ul").children("li").not("#select-menu-item").slideDown(500);
	    menushow = false;
	} else {
	    jQuery("#select-menu-item").parent("ul").children("li").not("#select-menu-item").slideUp(500);
	    menushow = true;
	}
    });
    
    /* Smooth Scroll */
    jQuery(window).bind('scroll', function(){
	if(jQuery(this).scrollTop() > 200) {
	    jQuery("#scroll-up").fadeIn(400);
	} else {
	    jQuery('#scroll-up').hide();
	}
    });
    jQuery('#scroll-up').click(function() {
	jQuery('html,body').animate({scrollTop:jQuery('#header').offset().top}, 1000);
	return false;
    });

    /* Miscallaneous Effects */
    jQuery("#wp-calendar td#today").wrapInner('<span>');
	
    /* Last Child Fix for IE 8 browsers */
    jQuery("*:last-child").removeClass("last").addClass("last");
    
    /* Safari Margin Hack */
    var width = jQuery("#grid-container").width();
    var marginSide = width * 0.006;
    var marginBottom = width * 0.015;
    if(navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
	jQuery("article.grid").css("margin-left", marginSide + "px");
	jQuery("article.grid").css("margin-right", marginSide + "px");
	jQuery("article.grid").css("margin-bottom", marginBottom + "px");
    };
});