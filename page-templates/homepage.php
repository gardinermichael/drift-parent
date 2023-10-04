<?php 
/* Template name: Homepage template  */ 
get_header();
$pageID = get_the_id();
?>

<?php

		 $issue_text = get_post_meta($pageID, "issue_text", true);
		 $issue_ID = get_post_meta($pageID, "issue_link", "true");
		 $issue_IDTest = intval($issue_ID);
		 $colorPick = get_post_meta($issue_IDTest, "color_for_current_issue", "true" );

		 $url = get_the_permalink($issue_ID);
		$page_imageID = get_post_thumbnail_id($pageID);


if($page_imageID != "")
{
  $page_imageURL = wp_get_attachment_image_src($page_imageID, "large");	
  $page_imageURL = $page_imageURL[0];
}
else
{
	$page_imageURL = get_bloginfo('template_url')."/assets/images/about.jpg";
}
?>
	<style type="text/css">
		.diff_font a { 
			color: <?php echo $colorPick; ?>;
			font-family: inherit;
		}
		/*.diff_font h4:hover, 
		.diff_font h4:hover a { 
			color: <?php echo $colorPick; ?>;
		}*/
		.ab_part_l{
			flex-wrap: wrap;
		}

		.diff_font {
			max-width: 620px;
			/*padding: 35px 0 0 35px;					 === CHANGED === */
			padding: 0px 0 0 35px;						/* === ADDED 6.1 === */

        }
		.diff_font h4{
			font-size: 25px;
		}

		.sub_don {
			width: 100%;
		    display: flex;
		    flex-wrap: wrap;
		}
		.sub_donl {
			width: 50%;
			text-align: left;
		    padding: 35px 0px 0 52px;
		}

		.sub_donl h4 {
			font-size: 28px;
		    margin: 0 0 10px;
		}

		.sub_donl p {
		    font-size: 16px;
		    line-height: 1.2;
		    font-family: Avenir-Next-Thin;
		}

		.diff_font h4 {
			display: inline;
			font-family: Avenir-Next-Thin;
		}
		
		.diff_font h2 a, .diff_font h2 {
				font-size: 48px;
				font-family: Avenir-Next-Thin;
				font-weight: normal;
        }
		.sub_donl a:hover h4 {
			color: <?php echo $colorPick; ?>;
		}
		.sub_donl a:hover p {
			color: <?php echo $colorPick; ?>;
		}
		
		.arti_span {								/* === ADDED 6.8 === */
			color: <?php echo $colorPick; ?>;
		}

		.signup4mail_Left::before {					/* === ADDED 6.18 === */
			content: "|";
			position: absolute;
			font-size: 52px;
			top: 20px;
			color: <?php echo $colorPick; ?>;
			font-weight: bold;
		}

		.support_heading::before {					/* === ADDED 6.18 === */
			content: "|";
			color: <?php echo $colorPick; ?>;

		}

		.home_mentions ul li::after {				/* === ADDED 6.18 === */
			content: "|";
			color: <?php echo $colorPick; ?>;
		}

		.home_mentions ul li.more_link a {			/* === ADDED 6.18 === */
			color: <?php echo $colorPick; ?>;
		}

		.support_us_pipe {							/* === ADDED 6.18 === */
			color: <?php echo $colorPick; ?>;
		}
	</style>

	<div class="ab_part d-flex main_container_custom">
		<div class="ab_part_l d-flex">
			<div∫ class="ab_part_linner">
				<div class="ab_part_img">
					<?php 
					   $pageID = get_the_id();
					  $thumbID = get_post_thumbnail_id($pageID);
					  if($thumbID == "")
					  {
					  	?>
					  	<img src="<?php bloginfo('template_url'); ?>/assets/images/shot1.png" class="medium">
					  	<?php
					  }
					  else
					  {
					    $thumbURL = wp_get_attachment_image_src($thumbID, "medium");					  	
					    $thumbURL = $thumbURL[0];
					    ?>
					    <img src="<?php echo $thumbURL; ?>">
					    <?php
					  }
					?>					
				</div>
			</div∫>

<!-- 			<div class="sub_don showInDesktop">
				<div class="sub_donl">
					<a href="<?php // echo get_the_permalink(8);?>">
						<h4>SUBSCRIBE</h4>
						<p>Read all of <i>The Drift online and—as soon as the world is up and running again—in</i> print.</p>
					</a>
				</div>
				<div class="sub_donl">
					<a href="<?php // echo get_the_permalink(6);?>">
						<h4>DONATE </h4>
						<p>Help us pay our contributors and keep this new venture afloat.</p>
					</a>
				</div>
			</div> -->
		</div>
		<div class="ab_part_r home_issue_page_text">
<div class="diff_font">
		<?php 		
		  $text_loops = get_field('h_loop',$issue_ID);		
			 $text_line = $text_loop["text"];
			 $article_linkID = $text_loop["article_link"];
			 $article_link = get_the_permalink($article_linkID);
?>
		  		<h4>
		  			<?php 
		  			$issueArgs = array("post_type" => "issue");
		  			$issueLoop = new wp_query($issueArgs);		  			
			  			while($issueLoop->have_posts()):$issueLoop->the_post();
			  				$issuePostID = get_the_id();
			  				if($issuePostID == $issue_ID)
			  			    {
			  			       echo get_the_content();			  			    	
			  				}
			  			endwhile;		  		  			  
		  			?>
		  		</h4>
		  	<?php



		if($issue_text != "")
		{
			$url = get_the_permalink(14);
		?> 
			   <a href="<?php echo $url; ?>" class="issue_moreButt"> 
			   	    <h2  style=" color:  #000 !important; "> <?php echo $issue_text; ?>   </h2>
			   </a>		 
         <?php } ?>
			</div>

		</div>


<div class="sub_don showInMobile">
				<div class="sub_donl">
					<a href="<?php echo get_the_permalink(8);?>">
						<h4>SUBSCRIBE</h4>
						<p>Read all of <i>The Drift online and—as soon as the world is up and running again—in</i> print.</p>
					</a>
				</div>
				<div class="sub_donl">
					<a href="<?php echo get_the_permalink(6);?>">
						<h4>DONATE </h4>
						<p>Help us pay our contributors and keep this new venture afloat.</p>
					</a>
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




<div class="signup4mail mt_wrap">
	<div class="signup4mail_BG">
		<div class="row custom_wrap">
				<div class="col-md-1"></div>
				<div class="col-md-5 signup4mail_Left"><h3>Sign up for our email list</h3></div>
				<div class="col-md-5 signup4mail_Right">
            <!-- Begin Mailchimp Signup Form -->
				<div id="mc_embed_signup">
					<form action="https://thedriftmag.us8.list-manage.com/subscribe/post?u=b3dad736fbc8f8c2b410b2885&amp;id=5567f7ab89" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					    <div id="mc_embed_signup_scroll">
							<div class="mc-field-group news_l d-flex">	
								<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="email address here">
								<input type="submit" value="SUBMIT" name="subscribe" id="mc-embedded-subscribe" class="button">
							</div>
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none">Thanks for Joining. </div>
							</div>
							<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						    <div style="position: absolute; left: -5000px;" aria-hidden="true">
						    	<input type="text" name="b_b3dad736fbc8f8c2b410b2885_5567f7ab89" tabindex="-1" value="">
						    </div>
						</div>
					</form>
				</div>
				<script type='text/javascript' src='//www.thedriftmag.com/wp-content/drift-child/inc/mc-validate.js'></script>
				<script type='text/javascript'>
				(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true)
				;</script>
				<!--End mc_embed_signup-->					
					
				</div>
				<div class="col-md-1"></div>
		</div>
	</div>
</div>

<div class="latestArticle_Heading"><h1>Latest</h1></div>
<?php 
  $postArgs = array("post_type" => "post", "posts_per_page" => "3", "order" => "desc", "orderby" => "date");
  $postLoop = new wp_query($postArgs);
?>
<div class="row latest_articles">

	<?php 
	    while($postLoop->have_posts()):$postLoop->the_post(); 
	    	$postID = get_the_id(); 
	    	$postLink = get_the_permalink($postID);
	    	$postTitle = get_the_title($postID);	    	
	    	$post_imageID = get_post_thumbnail_id($postID);

	    	if($post_imageID != "")
	    	{
		    	$post_imageURL = wp_get_attachment_image_src($post_imageID, "medium");
		    	$post_imageURL = $post_imageURL[0];
	    	}
	    	else
	    	{
	    	   $post_imageURL = get_bloginfo("template_url")."/assets/images/dummy.jpg";
	    	}

	    	 	$postSubtitle = get_post_meta($postID, "post_subsitle", true); 
	    	 	//$article_editor_name = get_post_meta($postID, "article_editor_name", true); 

	    	 	$post_authors = get_the_terms( $postID, 'authors' );
					  $loopNum = 0;
					  if (is_array($post_authors))
					  {
					  foreach($post_authors as $post_author) 
		 			 {
		 			 	$loopNum++;
		 			 	$author_id = $post_author->term_id;
		 			 	
		 			 	$author_link = get_term_link($post_author);
		 			 	$author_name = $post_author->name;
		 			 	$author_description = $post_author->description;
		 			 	
		 			 	if($loopNum == 1)
		 			 	{
		 			 		$article_editor_name = $post_author->name;
		 			 	}
		 			 	
					  }
					}
	?>
		<div class="col-md-4 single_article">

				<div class="arti_feaImage">
					<a href="<?php echo $postLink; ?>">
						<img src="<?php echo $post_imageURL; ?>">
					</a>
				</div>	

				<div class="arti_heading">
					<h4>
						<a href="<?php echo $postLink; ?>">
							<strong><?php echo $postTitle; ?></strong> 
							<?php 
							if($postSubtitle != "")
							{
								?>
								 <span class="arti_span">|</span> <?php echo $postSubtitle; ?>
								<?php
							}
							?>							
						</a>
					</h4>
				</div>

				<?php 
				  if($article_editor_name != "")
				  {
				?>
	                <div class="arti_sub_heading">
						<strong><a href="<?php echo $postLink; ?>"><?php echo $article_editor_name; ?></a></strong>
					</div>
			    <?php } ?>

		</div>
     <?php endwhile; ?>
	<div class="seeMoreLink latestArticleMore">
		<a href="<?php echo get_the_permalink(323); ?>">
		See more
	</a>
	</div>
</div>
<hr/>

<?php
	wp_reset_postdata();			
	wp_reset_query();
  $pageID = get_the_id();
  $mentionHeading = get_post_meta($pageID, "mention_heading", true);
  $mentionSubHeading = get_post_meta($pageID, "mention_subheading", true);
?>

<div class="latestArticle_Heading">
	<?php if($mentionHeading != ""){?>
	   <h1><?php echo $mentionHeading; ?></h1>
    <?php } ?>

	<?php if($mentionSubHeading != ""){?>
	   <p><?php echo $mentionSubHeading; ?></p>
    <?php } ?>
	
</div>
<div class="home_mentions">
	<div class="row custom_wrap home_mentions_wrap">
		<ul class="home_mentions">
			<?php 
		             $mention_text_loop = CFS()->get("mention_text_loop", $pageID);
		            foreach($mention_text_loop as $mention_text)
		             {
		             	
		             	$mention_textValue = $mention_text["mention_text"];
		             	$mention_link  = $mention_text["mention_link"];
						$mention_mention_style = $mention_text["mention_style"]["Italic"];
						$men_textValue_filtered = filter_var($mention_textValue, FILTER_SANITIZE_STRING);

		             	if($mention_link == "")
		             	{
							 //$mention_link = "#";
							 $mention_link = esc_url(site_url("/mentions/#$mention_textValue"));
						   //$mention_link = esc_url("/mentions/#$men_textValue_filtered");	             		
		             	}
		             	if($mention_mention_style == "Italic")
		             	{
		             		$mentionClass = " mention_italic ";
		             	}             	
		             	else
		             	{
		             	    $mentionClass = "";             		
		             	}
					?>
					    <li class="<?php echo $mentionClass; ?>"><a href="<?php echo $mention_link; ?>"><?php echo $mention_textValue; ?></a></li>				
				    <?php } 
 		    ?>  
 		

			<li class="more_link"><a href="<?php echo esc_url(site_url('/mentions')); ?>">More</a></li>
		</ul>
	</div>
</div>

	<?php 
		wp_reset_query();
		wp_reset_postdata();
	  $pageID = get_the_id();
	  $supportText = get_post_meta($pageID, "support_us_text", true);

	  if($supportText != ""){
	?>
	<div class="signup4mail mt_wrap">
			<div class="row custom_wrap">
					<div class="col-md-3 support_heading"><h3>Support us</h3></div>
					<div class="col-md-5 support_content">    
					 <?php echo wpautop($supportText); ?>
					</div>

					<div class="col-md-4 support_subheadings">    
					<h3> <a href="<?php echo get_the_permalink(8);?>">Subscribe</a> <span class="support_us_pipe">|</span> <a href="<?php echo get_the_permalink(6);?>">Donate</a> </h2>      								
					</div>
			</div>
	</div>
<?php } ?>



<div class="latestArticle_Heading"><h1>Featured</h1></div>
<?php 
   $featuredPosts = get_post_meta($pageID, "select_featured_posts", true);
?>
<div class="row latest_articles">

	<?php 
	    foreach($featuredPosts as $featuredPost)
	    {
	    	$postID = $featuredPost; 
	    	$postLink = get_the_permalink($postID);
	    	$postTitle = get_the_title($postID);	    	
	    	$post_imageID = get_post_thumbnail_id($postID);

	    	if($post_imageID != "")
	    	{
		    	$post_imageURL = wp_get_attachment_image_src($post_imageID, "medium");
		    	$post_imageURL = $post_imageURL[0];
	    	}
	    	else
	    	{
	    	   $post_imageURL = get_bloginfo("template_url")."/assets/images/dummy.jpg";
	    	}

	    	 	$postSubtitle = get_post_meta($postID, "post_subsitle", true); 


                     $post_authors = get_the_terms( $postID, 'authors' );
					  $loopNum = 0;

					  if (is_array($post_authors))
					  {
		 			 foreach($post_authors as $post_author)
		 			 {
		 			 	$loopNum++;
		 			 	$author_id = $post_author->term_id;
		 			 	
		 			 	$author_link = get_term_link($post_author);
		 			 	$author_name = $post_author->name;
		 			 	$author_description = $post_author->description;
		 			 	
		 			 	if($loopNum == 1)
		 			 	{
		 			 		$article_editor_name = $post_author->name;
		 			 	}
		 			 	
					  }
					}
	    	 	//$article_editor_name = get_post_meta($postID, "article_editor_name", true); 
	?>
		<div class="col-md-4 single_article">

				<div class="arti_feaImage">
					<a href="<?php echo $postLink; ?>">
						<img src="<?php echo $post_imageURL; ?>">
					</a>
				</div>	

				<div class="arti_heading">
					<h4>
						<a href="<?php echo $postLink; ?>">
							<strong><?php echo $postTitle; ?></strong> 
							<?php 
							if($postSubtitle != "")
							{
								?>
								 <span class="arti_span">|</span> <?php echo $postSubtitle; ?>
								<?php
							}
							?>							
						</a>
					</h4>
				</div>

				<?php 
				  if($article_editor_name != "")
				  {
				?>
	                <div class="arti_sub_heading">
						<strong><a href="<?php echo $postLink; ?>"><?php echo $article_editor_name; ?></a></strong>
					</div>
			    <?php } ?>

		</div>
     <?php } ?>
	<div class="seeMoreLink featuredArticleMore">
		<a href="<?php echo get_the_permalink(323); ?>">See more</a>
	</div>     
</div>
<hr class="mob-hide-line" />
<?php 
  $issue_args = array("post_type" => "issue", "posts_per_page" => "4");
  $issue_loop = new wp_query($issue_args);
?>

<div class="latestArticle_Heading td-issues-head">
	<h1>Issues</h1>
</div>
<div class="home_issues">
	<div class="row custom_wrap home_mentions_wrap">		
		   		<ol class="issues_list_ul row">
		   			<?php 
		   			  while($issue_loop->have_posts()):$issue_loop->the_post();
		   			  	$issuePostID =  get_the_id();
		   			  	$issuePostPermalink = get_the_permalink($issuePostID);
					
						/* ********TESTING hyperlink ******/
						$issue_title = get_the_title(); 
						$issue_hyper_link = esc_url(site_url("/issues/#$issue_title")); 
						/* *** END TESTING hyperlink ****/

		   			  	$issuePostImageID = get_post_thumbnail_id($issuePostID);
		   			  	if($issuePostImageID != "")
		   			  	{
		   			  	  $issuePostImageURL = wp_get_attachment_image_src($issuePostImageID, "medium");
		   			  	  $issuePostImageURL = $issuePostImageURL[0];
		   			  	}
		   			  	else
		   			  	{
		   			  		$issuePostImageURL = get_bloginfo("template_url")."/assets/images/dummy.jpg";
		   			  	}
		   			?>
		   			   <li class="col-md-3 issues_image">
						   <!-- ORIGINAL hyperlink 
		   			   	   <a href="<?php echo $issuePostPermalink; ?>"><img src="<?php echo $issuePostImageURL; ?>"></a> -->
						   <!--TESTING hyperlink -->
						   <a href="<?php echo $issue_hyper_link; ?>"><img src="<?php echo $issuePostImageURL; ?>"></a> 
		   			   	</li>
		   		   <?php endwhile; ?>
		   		</ol>		   			
	</div>

	<div class="nextIssues">
			<a href="<?php echo get_the_permalink(14); ?>" class="issuesMoreIcon">
   				     <img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/angle-right.png">
			</a>
	</div>

</div>

<?php 
	get_footer();