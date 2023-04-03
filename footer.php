<?php
global $theme_option;
  $logo_url = $theme_option["logo_image"];
  $logo = $logo_url["url"];

  $site_description = $theme_option["site_description"];


if ($logo_url == "") {
    $logo = get_bloginfo()."/assets/images/f-loog.png";
}

    $facebook_url = $theme_option["facebook_url"];
    $twitter_url = $theme_option["twitter_url"];
    $instagram_url = $theme_option["instagram_url"];

    $youtube_url = $theme_option["youtube_url"];
    $linkedin_url = $theme_option["linkedin_url"];
    $pinterest_url = $theme_option["pinterest_url"];
    $gplus_url = $theme_option["gplus_url"];

    $pageID = get_the_id();
?> 
<?php
 if (true) {
     $footer_style = get_post_meta($pageID, "footer_style", true);
     if ($footer_style == "" || $footer_style == "Style-1") {
         ?>


<div class="signup4mail mt_wrap footer_style_new">
	<div class="signup4mail_BG">
		<div class="row ">
				<div class="col-md-2 footerNewLogo">
					<picture>
						<source
						media="(min-width: 1010px)"
						srcset="
							<?php echo get_theme_file_uri() . '/assets/images/drift_logo_large_1x.png'; ?> 1x, 
							<?php echo get_theme_file_uri() . '/assets/images/drift_logo_large_2x.png'; ?> 2x, 
							<?php echo get_theme_file_uri() . '/assets/images/drift_logo_large_3x.png'; ?> 3x"
						type="image/png" >
						<img
						src="<?php _($logo) ?>"
						type="image/png"
						alt="The Drift Magazine">
					</picture>
				</div>
				<div class="col-md-8 footerNew_middle">
					<div class="footerNew_middle_inner">
                    <h4>Sign up for our email list</h4>
		            <!-- Begin Mailchimp Signup Form -->
						<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
						<style type="text/css">
							#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
							/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
							   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
						</style>
						<div id="mc_embed_signup">
							<form action="https://thedriftmag.us8.list-manage.com/subscribe/post?u=b3dad736fbc8f8c2b410b2885&amp;id=5567f7ab89" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="novalidate">
							    <div id="mc_embed_signup_scroll">
									<div class="mc-field-group news_l d-flex">	
										<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="email address here" aria-required="true">
										<input type="submit" value="SUBMIT" name="subscribe" id="mc-embedded-subscribe" class="button">
									</div>
									<div id="mce-responses" class="clear">
										<div class="response" id="mce-error-response" style="display: none; opacity: 1;"></div>
										<div class="response" id="mce-success-response" style="display: none; opacity: 1;">Thanks for Joining. </div>
									</div>
									<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
								    <div style="position: absolute; left: -5000px;" aria-hidden="true">
								    	<input type="text" name="b_b3dad736fbc8f8c2b410b2885_5567f7ab89" tabindex="-1" value="">
								    </div>
								</div>
							</form>
						</div>
						<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
						<script type="text/javascript">
						(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true)
						;</script>
						<!--End mc_embed_signup-->					
					</div>	
				</div>


				<div class="col-md-2 footerNewSocials">
					
		                  <ul class="social_icons">
							<?php if ($facebook_url != "") {?>
								  	<li><a href="<?php echo $facebook_url; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<?php } ?>
								
								<?php if ($twitter_url != "") {?>
								  	<li><a href="<?php echo $twitter_url; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
								<?php } ?>
								
								<?php if ($instagram_url != "") {?>
								  	<li><a href="<?php echo $instagram_url; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
								<?php } ?>
								
								<?php if ($youtube_url != "") {?>
								  	<li><a href="<?php echo $youtube_url; ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
								<?php } ?>
								
								<?php if ($linkedin_url != "") {?>
								  	<li><a href="<?php echo $linkedin_url; ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
								<?php } ?>
								
								<?php if ($pinterest_url != "") {?>
								  	<li><a href="<?php echo $pinterest_url; ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li>
								<?php } ?>
								
								<?php if ($gplus_url != "") {?>
								  	<li><a href="<?php echo $gplus_url; ?>" target="_blank"><i class="fab fa-google-plus-square"></i></a></li>
								<?php } ?>
					   </ul>

				</div>
		</div>
	</div>
</div>

<div class="footerFullMenu ">
	<div class="row">
	   <div class="col-md-9 footerFullMenu">
	   	<?php
          wp_nav_menu(array("menu" => "Footer Full Menu", "container" => "", "menu_id" => "footerFullMenu")); ?>
	   </div>
	   <div class="col-md-3 copyrightDiv">
	   	   <span class="copyrightSpan">Copyright &copy; The Drift <?php echo date('Y'); ?></span>
	   </div>
    </div>
</div>


		<?php
     } elseif ($footer_style == "Style-2") {
         ?>
<!-- footer Footer Container
================================================== -->
<section class="footer_outer">
	<div class="footer_back"></div>
	<div class="container-fluid">
		<div class="footer_inner">
		<div class="f_logo">
			<img src="<?php echo $logo; ?>">
			<?php
              if ($site_description != "") {
                  echo "<p>".nl2br($site_description)."</p>";
              } ?>			
		</div>

		<?php
         $pageID = get_the_id();
         if ($pageID != 51) {
             ?>	

		<div class="sig_up">
			<div class="sig_up_inner">
			<p>sign up for our email list:</p>
	<!-- Begin Mailchimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="https://thedriftmag.us8.list-manage.com/subscribe/post?u=b3dad736fbc8f8c2b410b2885&id=5567f7ab89" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">

<div class="mc-field-group news_l d-flex">	
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="email address here">
	<input type="submit" value="SUBMIT" name="subscribe" id="mc-embedded-subscribe" class="button">
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_b3dad736fbc8f8c2b410b2885_5567f7ab89" tabindex="-1" value=""></div>
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->


			</div>
		</div>
<?php
         } ?>

		<div class="f_three d-flex ">

				<?php
                $pageID = get_the_id();
         wp_nav_menu(array("menu" => "Footer menu", "container" => "", "menu_class" => "d-flex f_menu nav" )); ?>

				<ul class="social_icons">
					<?php if ($facebook_url != "") {?>
						  	<li><a href="<?php echo $facebook_url; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<?php } ?>
						
						<?php if ($twitter_url != "") {?>
						  	<li><a href="<?php echo $twitter_url; ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<?php } ?>
						
						<?php if ($instagram_url != "") {?>
						  	<li><a href="<?php echo $instagram_url; ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<?php } ?>
						
						<?php if ($youtube_url != "") {?>
						  	<li><a href="<?php echo $youtube_url; ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
						<?php } ?>
						
						<?php if ($linkedin_url != "") {?>
						  	<li><a href="<?php echo $linkedin_url; ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
						<?php } ?>
						
						<?php if ($pinterest_url != "") {?>
						  	<li><a href="<?php echo $pinterest_url; ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li>
						<?php } ?>
						
						<?php if ($gplus_url != "") {?>
						  	<li><a href="<?php echo $gplus_url; ?>" target="_blank"><i class="fab fa-google-plus-square"></i></a></li>
						<?php } ?>
			   </ul>
		</div>

		</div>
	</div>
</section>

<?php
     }
 } ?>
</div>
<!-- End Footer Container
================================================== -->
<!-- Scripts
================================================== -->


<script>


    // AOS.init({
    // 	once: true,
    //     delay: 0,
    //     duration: 1000
    // });

jQuery(document).ready(function(){
/*
 setTimeout(function()
 {
 	 jQuery(".loaderImage").hide();
    jQuery('.site_container').fadeIn(1000);		
    
 },1000);*/
 

	jQuery(".card_row").each(function(){
	var count = $(this).children().length;
	if(count == 4){
		jQuery(this).addClass("with-four");;
	}
	});

jQuery(".subsRadio li span label").on("click", function(){
	jQuery(".subsRadio li span label").removeClass("active");
	jQuery(this).addClass("active");
});



});

</script>

<script type="text/javascript">
jQuery(document).ready(function(){

jQuery(".searchPage_Form_Button").on("click", function(){
	var newSearchBox = jQuery(".searchPage_Form_Box").val();	
	jQuery(".orig").val(newSearchBox);
	jQuery(".promagnifier").trigger("click");
});

/* On scroll header sticky starts code */
	jQuery(window).scroll(function(){
	  if (jQuery(window).scrollTop() >= 1) {
	  	jQuery('.main_container_custom').addClass('padding_top');
	    jQuery('.menu_box_two').addClass('fixed');
	    jQuery('#tf-hide-mob').addClass('fixed');	    
	   }
	   else {
	   	jQuery('.main_container_custom').removeClass('padding_top');
	    jQuery('.menu_box_two').removeClass('fixed');	    
	    jQuery('#tf-hide-mob').removeClass('fixed');	    
	   }
	});
/* On scroll header sticky starts code */



		var sectionID =jQuery(".sectionID").attr("data-value");
		setTimeout(function()
		{
		if(sectionID != "")
		{
		      jQuery('html, body').animate({    	
			        scrollTop: jQuery("#"+sectionID).offset().top
			    }, 500);
		}


		}, 1000);



		        jQuery(".drift_search_link a").click(function(){		        	
		        jQuery(".drift_searchForm").slideToggle();
		        jQuery("#ajaxsearchlite1 input[type='search']").focus();
		        jQuery("#ajaxsearchlite3 input[type='search']").focus();
		        jQuery("#ajaxsearchlite4 input[type='search']").focus();
		    });
});
</script>
<script type="text/javascript">
	jQuery(document).ready(function(e){
/*
jQuery('form[class="search-form"]').submit(function(){
	var searchValue = jQuery(this).children('input[type="search"]').val();
	jQuery('#ajaxsearchlite1 input[type="search"]').val(searchValue);
	jQuery('#ajaxsearchlite1 input[type="submit"]').trigger("click");
	return false;
});*/

jQuery("#mc-embedded-subscribe").on("click", function(){

	 jQuery("#mce-success-response").hide();
	 
	setTimeout(function(){	

		if(jQuery("#mce-error-response").is(':visible') || jQuery(".mce_inline_error").is(':visible'))
		{
		  jQuery("#mce-success-response").hide();			
		}
		else
		{
		   jQuery("#mce-success-response").show();
		}
	},200);

	setTimeout(function()
	{
			jQuery("#mce-EMAIL").focusout();
	}, 1000);
});
//$("#mc-embedded-subscribe").is(':visible');


    jQuery(".mob-search").click(function(e){
    	e.preventDefault();
        jQuery(".drift_searchForm").slideDown();
          jQuery("#ajaxsearchlite3 input[type='search']").focus();
        return false;
    });

    jQuery(".seach-mobile-view i").click(function(e){
    	e.preventDefault();
        jQuery(".drift_searchForm").slideDown();
          jQuery("#ajaxsearchlite3 input[type='search']").focus();
          jQuery("#ajaxsearchlite4 input[type='search']").focus();
        return false;
    });
});

	    jQuery(document).on("click", function(event){
	        var $trigger = jQuery(".drift_searchForm, .drift_search_link, .drift_search_link a");
	        if($trigger !== event.target && !$trigger.has(event.target).length){
	             jQuery(".drift_searchForm").slideUp();
	        }    	

	                
    });

</script>
<script type="text/javascript">
	const elementClicked = document.querySelector(".openMobMenuIcon");
	const elementYouWantToShow = document.querySelector("#myMobileNav");

	elementClicked.addEventListener('click', ()=>{
	elementYouWantToShow.classList.toggle('main-nav-open');
	});
</script>

<script>
jQuery(document).ready(function(e){
	jQuery(".openMobMenuIcon").on("click", function(){
		jQuery("#myMobileNav").addClass("mob_menu_open");

		jQuery("#myMobileNav > .closebtn").on("click", function(){
		    jQuery("#myMobileNav").removeClass("mob_menu_open");
	    });

	});

	

      /*  var rightSideHeight = jQuery(".page-template-homepage .ab_part_r .diff_font").height();
		console.log(rightSideHeight);
		rightSideHeight = rightSideHeight + 50;
		jQuery(".page-template-homepage .ab_part_img").height(rightSideHeight+"px");

	jQuery(window).resize(function(){
		var rightSideHeight = jQuery(".page-template-homepage .ab_part_r .diff_font").height();
		console.log(rightSideHeight);
		rightSideHeight = rightSideHeight + 50;
		jQuery(".page-template-homepage .ab_part_img").height(rightSideHeight+"px");
	});*/

   jQuery("#mce-EMAIL").on("keyup", function(){
     jQuery(this).addClass("active_email");
   });
   
jQuery("#mce-EMAIL").on("focus", function(){
				
		  jQuery("div.mce_inline_error").css("opacity","0");
		  jQuery("div#mce-error-response").css("opacity","0");
		  jQuery("div#mce-success-response").css("opacity","0");
          jQuery(this).addClass("unfocus_email");
});

   
jQuery("#mce-EMAIL").on("focusout", function(){
   jQuery(this).removeClass("unfocus_email");
   	  jQuery("div.mce_inline_error").css("opacity","1");
	  jQuery("div#mce-error-response").css("opacity","1");
	  jQuery("div#mce-success-response").css("opacity","1");
});


   jQuery("#mce-EMAIL").on("change", function(){
   	 jQuery(this).removeClass("active_email");   	 
   });

    jQuery(".seach-mobile-view a").click(function(e){
    	e.preventDefault();
        jQuery(".drift_searchForm").slideToggle();
        jQuery("#search-form-1").focus();
        jQuery("#ajaxsearchlite4 input[type='search']").focus();
        return false;
    });
});
</script>
<script type="text/javascript">
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 1){  
      jQuery('.td-site-mobile-header').addClass("sticky");
    }
    else{
      jQuery('.td-site-mobile-header').removeClass("sticky");
    }

  });
</script>

<?php wp_footer(); ?>
</body>
</html>