<?php
/* Template name: Subscribe page */
get_header();

$page_imageID = get_post_thumbnail_id($pageID);
if ($page_imageID == "") {
    $page_imageURL = wp_get_attachment_image_src($page_imageID, "full");
    $page_imageURL = $page_imageURL[0];
} else {
    $page_imageURL = get_bloginfo('template_url')."/assets/images/subscribe-box-bg.png";
}
?>

<style type="text/css">

	label[for='wpfs-same-billing-and-shipping-address--ZTI4NGY']:before {
		background: #909090 !important;
		box-shadow: none !important;
	}

</style>
<div class="the-drift-logo-mb" style="display: none;">
    <a href="<?php echo home_url(); ?>">
      <img src="<?php echo home_url(); ?>/wp-content/uploads/2020/05/Logo.png">
    </a>
</div>
<section>
	<div class="container-fluid">
	<div class="ab_part d-flex">

		<div class="ab_part_l d-flex">
			<div class="ab_part_linner kudossubscribe">

				<?php
                echo do_shortcode('[fullstripe_form name="subscribe" type="inline_subscription"]');
                ?>

			</div>
		</div>

<?php
                $pageID = get_the_id();
                $subsitle = get_post_meta($pageID, "subsitle", true);
                ?>
		<div class="ab_part_r donate-subscribe_txt">
			<div class="contact01">
				<div class="com_heading">
					<h3><b> Subscribe </b>​<?php if ($subsitle != "") {
                    echo "<span class='line_gray'>|</span> ".$subsitle;
                }?> </h3>
				</div>
				<?php
             while (have_posts()):the_post();
                the_content();
             endwhile;
            ?>
			</div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript">
	jQuery(document).ready(function(){

			jQuery("#submit--MGJjOTB").on("click", function(){
				setTimeout(function(){
				        if(jQuery(".wpfs-form-message--correct").is(':visible') )
				        {
				        	jQuery("#submit--MGJjOTB").addClass("disableButton");
				        }
				}, 6000);
			});
		jQuery("#wpfs-card-holder-name--MGJjOTB").change(function(){
			var full_name22 = jQuery(this).val();
			jQuery("#wpfs-billing-name--MGJjOTB").val(full_name22);
		});

	jQuery('.custom_1').html('<span class="constrained">One-year print & digital</span><strong>$50</strong>');
	jQuery('.custom_2').html('<span class="constrained">One-year digital</span><strong>$30</strong>');
	jQuery('.custom_4').html('<span class="constrained">Institutional print & digital</span><strong>$90</strong>');
    jQuery('.custom_5').html('<span class="constrained">International print & digital</span><strong>$90</strong>');
	jQuery('.custom_3').html('<span class="constrained">Lifetime digital</span><strong>$300</strong>');
	//console.log(jQuery('.wpfs-form-check').find('.wpfs-form-check-label').html());
	});

</script>
<style type="text/css">
/*.page-template-subscribe .kudossubscribe form.wpfs-form fieldset.wpfs-form-check-group {
    background: url(<?php echo $page_imageURL; ?>) !important;
    }*/
	#wpfs-billing-address-panel--MGJjOTB > div:last-child, #wpfs-billing-address-panel--MGJjOTB > div:nth-child(1)
	{
		display: none;
	}
	.kudossubscribe form .wpfs-form-actions a {
    display: none;
}
label[for="wpfs-card-holder-name--MGJjOTB"]::before {
    content: "Full name";
    font-size: 18px !important;
}
/*label[for="wpfs-plan--MGJjOTB--1"]::before {
    content: "Lifetime $300";
    font-size: 18px !important;
}*/
label[for="wpfs-billing-address-line-1--MGJjOTB"]::before {
    content: "Billing address";
    font-size: 18px !important;
}
label[for="wpfs-card-holder-name--MGJjOTB"], label[for="wpfs-billing-address-line-1--MGJjOTB"]{
    font-size: 0px !important;
}
label[for='wpfs-same-billing-and-shipping-address--MGJjOTB']:before {
    background: #909090 !important;
    box-shadow: none !important;
}
</style>
<?php
get_footer();
?>
