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

			// Check collision with top of element
			var found_issue = false;
			var family = document.elementsFromAbsolutePoint(quote_x, quote_y);
		    jQuery(family).each(function ()
		    {
				if (!this.isSameNode(this_link) && this.classList.contains("margin_block"))
				{				
					jQuery(this).css("cssText", "margin-top: " + (parseInt(jQuery(this).css("margin-top")) + jQuery(this).height() + 20) + "px !important;");
					found_issue = true;
				}
			});

			if (found_issue) { index = -1;} // Reset loop
			else
			{
			// Check collision with bottom of element
		    var family = document.elementsFromAbsolutePoint(quote_x, quote_y_bottom);
		    jQuery(family).each(function ()
		    {
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
		jQuery(this).before("<blockquote class='margin_block'><p><a href='"+anchorLink+"'target="+anchorTarget+">"+anchorTitle+"</a></p></blockquote>");
	}

	setTimeout(
		function() 
		{
		fixQuoteSpacing();
		}, 1000);
	});

	

jQuery(".big-image").parent("figure").addClass("bigfigure");

jQuery("#other_amount").on("change paste keyup", function(){
	var other_amount = jQuery(this).val();
	jQuery("#wpfs-custom-amount-unique--ZjFiZTB").val(other_amount).trigger("change");
	//jQuery("#wpfs-custom-amount-unique--ZjFiZTB").trigger("change");
	jQuery("#wpfs-custom-amount-unique--ZjFiZTB").prop("disabled", false);
});

jQuery("#wpfs-card-holder-name--ZjFiZTB").change(function(){
	var full_name = jQuery(this).val();
   jQuery("#wpfs-billing-name--ZjFiZTB").val(full_name);	
});


jQuery("#wpfs-card-holder-name--ZTI4NGY").change(function(){
	var full_name2 = jQuery(this).val();
	jQuery("#wpfs-billing-name--ZTI4NGY").val(full_name2);
});

jQuery("#wpfs-address-switcher--ZTI4NGY").removeClass("wpfs-form-check-group");

	jQuery('button.navbar-toggle').click(function(){
		jQuery('.only_mobile_show').toggle();
	});
	jQuery('body').find('.wpfs-selectmenu-menu').children('#wpfs-custom-amount--ZjFiZTB-menu').html('<li class="ui-menu-item" id="ui-id-1" tabindex="-1" role="option"><div class="menu-item-wrapper ui-menu-item-wrapper ui-state-selected">10</div></li><li class="ui-menu-item" id="ui-id-2" tabindex="-1" role="option"><div class="menu-item-wrapper ui-menu-item-wrapper">25</div></li><li class="ui-menu-item" id="ui-id-3" tabindex="-1" role="option"><div class="menu-item-wrapper ui-menu-item-wrapper">50</div></li><li class="ui-menu-item" id="ui-id-4" tabindex="-1" role="option"><div class="menu-item-wrapper ui-menu-item-wrapper">100</div></li><li class="ui-menu-item ui-state-focus" id="ui-id-5" tabindex="-1" role="option"><div class="menu-item-wrapper ui-menu-item-wrapper">250</div></li><li class="ui-menu-item" id="ui-id-6" tabindex="-1" role="option"><div class="menu-item-wrapper ui-menu-item-wrapper">Other</div></li>');
	jQuery('input[type=radio][name=same]').change(function() {
		var selectid = jQuery(this).data('selectid');
	
		jQuery('body').find('.wpfs-selectmenu-menu').children().children('#'+selectid).trigger('click');

		jQuery('#wpfs-custom-amount--ZjFiZTB').val(this.value).trigger('change');
		jQuery('#wpfs-custom-amount--ZjFiZTB-button').attr( 'aria-activedescendant', selectid);
		jQuery('#wpfs-custom-amount--ZjFiZTB-button').attr( 'aria-labelledby', selectid);
		jQuery('#wpfs-custom-amount--ZjFiZTB-button').children('.ui-selectmenu-text').text(this.value);

	});

	jQuery('.ab_part_linner button[type="submit"]').html("Subscribe now");
	jQuery('.ab_part_linner .form01 button[type="submit"]').html("Donate now!");
});



