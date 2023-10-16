<?php 
/* Template name: About */ 
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
	$page_imageURL = get_bloginfo('template_url')."/assets/images/about.jpg";
}
?> 
	<style type="text/css">
		.mission{
		    max-width: 660px;
    		margin: 65px auto 0px;
    		padding: 0px;
		}	
		.submit_span {
			font-size: 23px;
		    position: relative;
		    top: 4px;
		    vertical-align: top;
		    display: inline;;
        }
		.mission_outer .mission{}
		.mission p{
		    font-size: 18px;
		    margin-bottom: 30px;
		}
		.about_outer{
			border-top : 1px solid rgba(0,0,0,0.3);
			margin-bottom: 80px;
    		padding-top: 0;
    		margin-top: 90px;
		}
		.about_outer:last-child {
			margin-bottom: 0;
		}
		.about_o {
			flex-wrap: wrap;
		}
		.about_l{
			width: 50%;
			padding: 0 40px 0;
		}
		.about_l h4{
			font-size: 29px;
    		text-align: right;
    		font-family: proxy-nova;
    		line-height: 1;
		}
		.about_l h4 span {
		    color: #909090;
		    display: inline;
		    font-size: 19px;
		    line-height: normal;
		    font-family: Avenir-Next-Thin, Arial, sans-serif;
		    vertical-align: top;
		    position: relative;
		    top: 1px;
		}
		.about_r{
			width: 50%;	
		    max-width: 480px;
			padding:  0px 0 0 50px;
		}
		.about_r p a {
			color: #909090;
			display: inline-block;
			margin-top: 4px;
			position: relative;
			top: -2px;
		}

		.about_r h3 {
			padding-bottom: 55px;
			padding-top: 0;
    		margin-top: 105px;
		}
		.about_r p {
			font-size: 18px;
		    line-height: 1.4;
		}
		.about_r h3 b {
	    	font-family: Adobe-Caslon;
		}

	</style>


	<div class="ab_part d-flex main_container_custom">
		<div class="ab_part_l d-flex">
			<div class="ab_part_linner">
				<div class="ab_part_img">
					<img src="<?php echo $page_imageURL; ?>">
				</div>
			</div>
		</div>
		<div class="ab_part_r">
			<div class="contact01">
			<div class="com_heading">
				<?php 
					$pageID = get_the_id();
					$subsitle = get_post_meta($pageID, "subsitle", true);
				?>
				<h3><b> <?php echo get_the_title(); ?> </b>​
				<?php 
					if($subsitle != "")
					{
	                   echo "<span class='line_gray'>|</span> ".$subsitle;
					}
			    ?>
			 </h3>
			</div>
			</div>
		</div>
	</div>

	<section class="mission_outer">
		<div class="container">
			<div class="mission">
                <?php 
				 while(have_posts()):the_post();
				 	the_content();
				 endwhile;
			    ?>	
			</div>
		</div>
	</section>

	<section >
		<div class="container">
<?php 
 $about_options =  CFS()->get( 'about_content_section', $pageID );
 if ($about_options) {
	$sizeofAbout = sizeof($about_options);
	$loopNum = 0;
	foreach($about_options as $about_option)
	{ 
		$loopNum++;
		if($loopNum == $sizeofAbout)
		{
			$contact_id = "contact_".$loopNum;
		}
		else
		{
			$contact_id = "";
		}
		$a_heading = $about_option["heading_line"];
		$about_subtitle = $about_option["about_subtitle"];
		$submit_content = $about_option["submit_content"];
	?>			
				<div class="about_outer" id="<?php echo $contact_id; ?>">

					<?php 
					if($a_heading != "" || $about_subtitle != "")
					{
					?>
					<div class="about_o d-flex">
						<div class="about_l">
							
						</div>
						<div class="about_r submit_heading">
							<h3 id="contact"> 
								<?php if($a_heading != ""){?><b> <?php echo $a_heading; ?> </b> <?php } ?> 
								<?php if($about_subtitle != ""){ echo "<span class='submit_span'>|</span> ".$about_subtitle; } ?> 
							</h3>
						</div>
					</div>
				<?php  }  ?>


				<?php 
					foreach($submit_content as $content_value)
					{
						$about_title = $content_value["about_title"];
						$about_text = $content_value["about_text"];
				?>
					<div class="about_o d-flex">

						<div class="about_l">

							<?php if($about_title != "") {  ?>
							<h4><?php echo $about_title; ?> <span>|</span></h4>
							<?php } ?>

						</div>

						<div class="about_r">
							<?php 
							if($about_text != "")
							{
							?>
							<p>
								<?php echo $about_text; ?>						   		
							</p>
						<?php } ?>

						</div>
						
					</div>
				<?php } ?>
					
				</div>
	<?php   } ?>
<?php }?>


		</div>
	</section>


<?php 
	get_footer();