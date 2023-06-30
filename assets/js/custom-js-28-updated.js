jQuery(document).ready(function($){
	$(".share_text em a").each(function(){
		var article_foo_anchor = $(this).children().html();
		var start_issue = article_foo_anchor.includes('ISSUE');  
		if(start_issue == true)
		{
			var i;
			for(i=1; i < 11; i++)
			{
				var checkIssueNumber = article_foo_anchor.includes('ISSUE '+i);
				if(checkIssueNumber == true)
				{
					$(this).children().html("ISSUE "+i);
					$(this).attr("href", "https://www.thedriftmag.com/issues/#Issue "+i);
				}
			}
		}
		else
		{
		//	alert("Not found Issue");
		}
	});
});

(function() {
  'use strict';
  var api;
  api = function(x,y) {
    var elm, scrollX, scrollY, newX, newY;
    /* stash current Window Scroll */
    scrollX = window.pageXOffset;
    scrollY = window.pageYOffset;
    /* scroll to element */
     window.scrollTo(x,y);

    /* calculate new relative element coordinates */
    newX = x - window.pageXOffset;
    newY = y - window.pageYOffset;
    /* grab the element */
    elm = document.elementsFromPoint(newX,newY);
    /* revert to the previous scroll location */
    	window.scrollTo(scrollX,scrollY);
    /* returned the grabbed element at the absolute coordinates */
    return elm;
  };
  this.document.elementsFromAbsolutePoint = api;
}).call(this);

function fixQuoteSpacing()
{
	jQuery(".margin_block").each(function()
	{
		var this_link = this;
		var rect = jQuery(this).offset();
		var quote_x = rect.left;
		var quote_y = rect.top;
		var quote_y_bottom = rect.top + jQuery(this).height();

		//console.log(this_link, quote_y, quote_y_bottom)

			// Check collision with top of element
			// This first branch of the code won't work because it adds a top margin to the element that is already on top
			var found_issue = false;
			var family = document.elementsFromAbsolutePoint(quote_x, quote_y);
			jQuery(family).each(function ()
			{
				if (!this.isSameNode(this_link) && this.classList.contains("margin_block"))
				{
					console.log(rect, jQuery(this).offset())
					jQuery(this).css("cssText", "margin-top: " + (parseInt(jQuery(this).css("margin-top")) + jQuery(this).height() + 20) + "px !important;");
					found_issue = true;
				}
			});

			if (found_issue) { index = -1;} // Reset loop
			else
			{
			// Check collision with bottom of element
			// This code is goofy because it adds a top margin equal to the height+20 ... when that's uncorrelated to the amount of overlap
			var family = document.elementsFromAbsolutePoint(quote_x, quote_y_bottom);
			jQuery(family).each(function ()
			{
				console.log(rect, jQuery(this).offset())
				if (!this.isSameNode(this_link) && this.classList.contains("margin_block"))
				{
					jQuery(this).css("cssText", "margin-top: " + (parseInt(jQuery(this).css("margin-top")) + jQuery(this).height() + 20) + "px !important;");
					found_issue = true;
				}
			});
			}

			if (found_issue) { index = -1; } // Reset loop
	});

}

jQuery(window).on("load", function(){ // jQuery(document).ready(function(){

	jQuery(".single .mission_inner a").each(function(){
	var anchorTitle = jQuery(this).attr("title");	
	var anchorLink = jQuery(this).attr("href");
	var anchorTarget = "_blank";

	if(anchorTitle != "" && anchorTitle != undefined)
	{
		if (anchorLink == undefined) { // a margin block used for translations, not actual hyperlinks
			jQuery(this).before("<blockquote class='margin_block'><p>"+anchorTitle+"</p></blockquote>");
		} else {
			jQuery(this).before("<blockquote class='margin_block'><p><a href='"+anchorLink+"'target="+anchorTarget+">"+anchorTitle+"</a></p></blockquote>");
		}
	}

	setTimeout(
		function() 
		{
		fixQuoteSpacing();
		}, 1000);
	});

	jQuery(".big-image").parent("figure").addClass("bigfigure");
});

//jQuery(window).resize(fixQuoteSpacing)