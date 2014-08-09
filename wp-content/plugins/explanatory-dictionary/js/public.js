(function ($) {
	"use strict";
	$(function () {
		// Place your public-facing JavaScript here
		
		$(".explanatory-dictionary-highlight").mouseenter(function(e){
			var tooltip = $("#explanatory-dictionary-tooltip").clone();
			if( tooltip.is(":animated") == false ) {
				$(this).append(tooltip);
				// load the content in
				var definitionTarget = $(this).attr('data-definition');
				
				var contentTooltip = tooltip.children(".explanatory-dictionary-tooltip-content");
				contentTooltip.empty();
				$("#explanatory-dictionary-page-definitions dt." + definitionTarget).clone().appendTo(contentTooltip);
				$("#explanatory-dictionary-page-definitions dd." + definitionTarget).clone().appendTo(contentTooltip);				
				
				// fade in
				tooltip.fadeIn(200);
				
				// fade out
				$(this).click(function(){
					tooltip.fadeOut(200);
				});
				
				tooltip.click(function(){
					$(this).fadeOut(200);
				});
			}
		}).mouseleave(function(){
			$(this).children("#explanatory-dictionary-tooltip").fadeOut(200).remove();
		});

		
	});
}(jQuery));