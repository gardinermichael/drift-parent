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
	// the minimum padding between blocks (or the top block and the header) in pixels
	var min_padding = 4;
	// for a fixed width each margin block has a known height based on its line breaks
	// and no margin block may be placed above the maximum y of the page
	// the site container is the area below the header, start with that as max y
	var min_y = 0;
	jQuery(".site_container").each(function()
	{
		var container_top = jQuery(this).offset().top;
		if (container_top > min_y) {
			min_y = container_top
		}
	});
	// sort margin blocks by y position of their top: we want higher ones to stay higher
	// and we will only need to deal with adjacent blocks 
	const blocks = []
	jQuery(".margin_block").each(function()
	{
		var rect = jQuery(this).offset();
		const block_data = [this, rect.top];
		blocks.push(block_data);
	});

	blocks.sort(function(a, b)
	{
		// index 1 == top is our sort key
		if (a[1] < b[1])
		{
			return -1;
		}
		if (a[1] > b[1])
		{
			return 1;
		}
		return 0;
	});

	var lower_block = null;
	blocks.forEach(function(block)
	{
		// if this is the first block we've seen, it's our "bottom" block of 2, and we move on
		// in the next iteration it will be pushed to top status

		if (lower_block === null)
		{
			[lower_block, _] = block;
			return 0;
		}
		// if we have a low block and have proceeded to iterate, we move our old lower block to be the top block
		// and introduce the new block as the lower block
		higher_block = lower_block;

		// don't trust the block top y that we used for sorting, because top ys can be changed in this loop
		// so we want to calculate offsets relative to CURRENT height (we will fetch this parameter later)
		[lower_block, _] = block;
		lower_height = jQuery(lower_block).height();
		lower_top = jQuery(lower_block).offset().top;

		higher_height = jQuery(higher_block).height();
		higher_top = jQuery(higher_block).offset().top;

		//console.log(lower_block);
		//console.log(higher_block);

		var higher_bottom = higher_top + higher_height;
		var overlap = higher_bottom - lower_top;
		if (overlap < -1*min_padding)
		{
			return 0;
		}

		higher_height_portion = higher_height/(higher_height+lower_height);
		//console.log(higher_height_portion);
		//jQuery(higher_block).css("cssText", "margin-bottom: " + Math.floor(overlap+min_padding)/2 + "px !important;");
		higher_adjustment = Math.floor(overlap+min_padding)*higher_height_portion;
		lower_adjustment = higher_adjustment/higher_height_portion*(1-higher_height_portion);

		//higher_adjustment = Math.floor(overlap+min_padding)/2;
		//lower_adjustment = higher_adjustment;

		//console.log(min_y, higher_top, higher_adjustment);
		if (higher_top-higher_adjustment > min_y)
		{
			jQuery(higher_block).offset({top: higher_top-higher_adjustment});
			jQuery(lower_block).offset({top: lower_top+lower_adjustment});
			min_y = higher_bottom-higher_adjustment;
		}
		else
		{
			higher_adjustment=0;
			lower_adjustment = overlap+min_padding;
			jQuery(lower_block).offset({top: lower_top+lower_adjustment});
			min_y = higher_bottom;
		}
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
		}, 200);
	});

	jQuery(".big-image").parent("figure").addClass("bigfigure");
});


jQuery(window).resize(function()
{
	jQuery(".margin_block").each(function() {
		var current_style = this.getAttribute('style');
		if (!(current_style === null))
		{
			var st = current_style.split(';').map(function (a) {
				return a.toLowerCase().indexOf('top')>-1 ? '':a;
			}).join(';');
			this.setAttribute('style', st);
			//console.log('TEST: top property == '+ jQuery(this).css('top') + ', style attribute == ' + jQuery(this).attr('style'));
			jQuery(this).removeAttr('style');
		}
	});
	fixQuoteSpacing();
});
