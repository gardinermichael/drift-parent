<?php 
/* Template name: Donate page */
get_header();
$pageID = get_the_id();
$page_imageID = get_post_thumbnail_id($pageID);
if($page_imageID != "")
{
  $page_imageURL = wp_get_attachment_image_src($page_imageID, "full");	
  $page_imageURL = $page_imageURL[0];
}
else
{
	$page_imageURL = get_bloginfo('template_url')."/assets/images/support.png";
}
?>

<div class="the-drift-logo-mb" style="display: none;">
    <a href="<?php echo home_url(); ?>">
      <img src="<?php echo home_url(); ?>/wp-content/uploads/2020/05/Logo.png">
    </a>                     	   	 	       
</div>

<section>
	<div class="container-fluid">
	<div class="ab_part d-flex">

		<div class="ab_part_l d-flex">
			<div class="ab_part_linner">
				<div class="ab_part_img donate_img">

					<img src="<?php echo $page_imageURL;?>">
					<div class="ab_part_img_abu">
						<div class="ab_part_img_inner d-flex">
						<div>
							<input type="radio" name="same" id="ten" class="custom_radio_button" value="10" data-selectID="ui-id-1" checked>
							<label for="ten"> $10</label>
						</div>
						<div>
							<input type="radio" name="same" id="two"  class="custom_radio_button" value="25"  data-selectID="ui-id-2">
							<label for="two"> $25</label>
						</div>
						<div>
							<input type="radio" name="same" id="thr"  class="custom_radio_button" value="50" data-selectID="ui-id-3">
							<label for="thr"> $50</label>
						</div>
						<div>
							<input type="radio" name="same" id="four"  class="custom_radio_button" value="100" data-selectID="ui-id-4">
							<label for="four"> $100</label>
						</div>
						<div>
							<input type="radio" name="same" id="five"  class="custom_radio_button" value="250" data-selectID="ui-id-5">
							<label for="five"> $250</label>
						</div>
						<div>
							<input type="radio" name="same" id="six"  class="custom_radio_button" value="Other" data-selectID="ui-id-6">
							<label for="six"> Other amount</label>							
							<input type="text" id="other_amount" value="" onkeypress="javascript:return isNumber(event)" >
						</div>
						</div>
					</div>
				</div>
				
				

				<div class="form01">
					<!-- <h4>Customer Information</h4> -->
					<!-- <img src="<?php //bloginfo('template_url'); ?>/assets/images/support.png"> -->
					<?php
				    echo do_shortcode('[fullstripe_form name="donate" type="inline_payment"]');
				    //echo do_shortcode('[fullstripe_form name="donation" type="inline_payment"]');
				    ?>
<!-- 					<form class="com_inf">
						<h4> Customer Information </h4>
						<input type="" name="" placeholder="First Name">
						<input type="" name="" placeholder="Last Name">
						<input type="" name="" placeholder="Email Address">
						<input type="" name="" placeholder="Mailing Address">
						<input type="" name="" placeholder="Mailing Address line 2">
						<input type="" name="" placeholder="City">
						<input type="" name="" placeholder="State">
						<input type="" name="" placeholder="Zip Code">
						<input type="" name="" placeholder="City">

						<h4> Billing Information </h4>
						<input type="" name="" placeholder="Credit card">
						<input type="" name="" placeholder="CVV">
						<input type="" name="" placeholder="Expiration(00/00)">
						<a class="but63">Donate now!</a>
					</form>
 -->				</div> 
			</div>
		</div>


		<div class="ab_part_r donate-subscribe_txt">
			<div class="contact01">
				<?php 
				$pageID = get_the_id();
				$subsitle = get_post_meta($pageID, "subsitle", true);
				?>
			<div class="com_heading">
				<h3><b><?php echo get_the_title(); ?></b>​
			<?php if($subsitle != "")
			{
				echo "<span class='line_gray'>&nbsp;|&nbsp;</span>".$subsitle;
			}?>
				
			</h3>
			</div>

			<?php 
			 while(have_posts()):the_post();
			 	the_content();
			 endwhile;
			?>		
			
			</div>
		</div>
	</div>
</div>
</section> 
<script type="text/javascript"> 
 function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;
        return true;
    }  
 
	jQuery(document).ready(function(){ 

jQuery("#submit--OWI3MGQ").on("click", function(){
	setTimeout(function(){
	        if(jQuery(".wpfs-form-message--correct").is(':visible') )
	        {
	        	jQuery("#submit--OWI3MGQ").addClass("disableButton");	        	
	        } 
	}, 6000);
});





		var tenDollar = jQuery("#ten").val();
		jQuery('input[name="wpfs-custom-amount-unique"]').val(tenDollar);

	jQuery("#other_amount").on("mousedown", function(){
			jQuery('label[for="six"]').trigger("click");			
	});

		jQuery("#wpfs-card-holder-name--OWI3MGQ").change(function(){
			var fullName = jQuery(this).val();
			jQuery("#wpfs-billing-name--OWI3MGQ").val(fullName);
		});

		jQuery('.custom_radio_button').click(function(){
			if (jQuery(this).val() == 'Other') 
			{
				jQuery("#other_amount").val('');
				jQuery('#wpfs-custom-amount-unique--OWI3MGQ').val('');
			}
			else
			{
				jQuery('#wpfs-custom-amount-unique--OWI3MGQ').val(jQuery(this).val()); 
			}
		});
		jQuery("#other_amount").change(function(){
			var radioValue = jQuery(".custom_radio_button:checked"). val();
			if(radioValue == 'Other')
			{
				var other_amount = jQuery(this).val();
				jQuery("#wpfs-custom-amount-unique--OWI3MGQ").val(other_amount);
			}
			
			// jQuery("#wpfs-custom-amount-unique--ZjFiZTB").val(other_amount);
			// jQuery("#wpfs-custom-amount-unique--ZjFiZTB").removeAttr("disabled");
		});
	});
</script>
<?php 
get_footer();
?>