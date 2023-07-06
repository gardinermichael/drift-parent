<?php 
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
	$page_imageURL = get_bloginfo('template_url')."/assets/images/unnamed.jpg";
}
?>

<?php 
	$issue_args = array("post_type" => "issue", "posts_per_page" => -1);
	$issue_loop = new wp_query($issue_args);
	$article_id_array = array();
	while($issue_loop->have_posts()):$issue_loop->the_post();

		$issueListId =  get_the_id();	
		$sectionLoop = get_field('select_mentions_acf', $issueListId);	
		if(!empty($sectionLoop))
		{
			foreach($sectionLoop as $sectionSingle)
			{
	            $article_id_array[$issueListId][] = $sectionSingle->ID;
			}
		}
	endwhile;
	wp_reset_postdata();
	wp_reset_query();

foreach($article_id_array as $key => $article_id_values)
{
   if( in_array($pageID, $article_id_values) )
   {
     $issue_Color_ID = $key;   	
     $colorPick = get_post_meta($issue_Color_ID, "color_for_current_issue", true);
   }
}


if($colorPick == "")
{
	$colorPick = "#69a7c2";
}
?>


	<style type="text/css">
		.mission{
		    max-width: 660px;
    		margin: 80px auto 0px;
    		padding: 0px;
		}	

		.mission p {
		    font-size: 20px;
		    font-family: Adobe-Caslon;
		}
		
		.about_o {
			flex-wrap: wrap;
		}
		
		.about_l h4 span{
			color: <?php echo $colorPick; ?>;
			display: inline;
		}

		.about_r{
			width: 50%;	
		    max-width: 480px;
			padding:  0px 0 0 50px;
		}
		.about_r p a{
			color: #909090;
			font-family: Adobe-Caslon;
		}
		.about_r p{
			font-size: 20px;
		    line-height: 1.4;
			font-family: Adobe-Caslon;
		}

		.about_o {
			flex-wrap: wrap;
		}
		.about_l{
			width: 50%;
			padding: 0 40px 0;
		}
		.about_l h4 {
	font-size: 28px;
	margin: 0px;
	font-family: proxy-nova;
	display: block;
	text-align: right !important;
}
	.about_l h6 {
	font-size: 16px;
	color: <?php echo $colorPick; ?>;
	font-family: proxy-nova;
	display: block;
	text-align: right;
}




		.about_r{
			width: 50%;	
		    max-width: 480px;
			padding:  0px 0 0 50px;
		}
		.about_r p a{
			color: #909090;
			font-family: Adobe-Caslon;
		}
		.about_r h4{
			    font-size: 28px;
			    color: <?php echo $colorPick; ?>;
			    font-family: 'Roboto', sans-serif;
			    text-align: right;
			    margin: 0 0 60px;
			    font-weight: 100 !important;
		}
		.about_r p{
			font-size: 20px;
		    line-height: 1.4;
		    margin: 0;
			font-family: Adobe-Caslon;
		}
		.marb65 {margin-bottom: 65px;}
		.about_outer {	
			padding-top: 80px;
			border-top : none;
	}

	@media (max-width: 767px) {
		.about_l {
			padding: 0 !important;
			text-align: left !important;
		}
		.single-mention .about_r {
			text-align: left !important;
			padding-top: 15px !important;
		}
		.single-mention h4 span {
		    display: inline !important;
		}
	}

	</style>


	<div class="ab_part d-flex">
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
				<h3><b>Mentions</b> <span style="color:<?php echo $colorPick; ?>"> | </span> <?php echo get_the_title(); ?> </b>​				
			 </h3>
			</div>
			<div class="men_content">
				<?php 
				  while(have_posts()):the_post();
				    the_content(); 
				  endwhile;
				?>				
			</div>
			</div>
		</div>
	</div>

	<?php 
	  $pageID = get_the_id();
	   $content_loop = CFS()->get( 'content_loop', $pageID );			  	
	   if(!empty($content_loop))
	   {
	?>				
	<section class="mission_outer">
		<div class="container">
			<div class="about_outer">
				<?php 
				  foreach($content_loop as $m_content)
				  {
				     $men_con_title = $m_content["men_con_title"];				  	
				     $men_con_subtitle = $m_content["men_con_subtitle"];				  	
				     $mention_content = $m_content["mention_content"];				  	
				     $mention_category = $m_content["mention_category"];				  	
				?>
				<div class="about_o d-flex">
					<div class="about_l">
						<?php if($men_con_title != ""){ ?>
						     <h4><?php echo $men_con_title; ?> <span>|</span></h4>
					     <?php } ?>

					     <?php if($men_con_subtitle != ""){ ?>
						   <h6><?php echo $men_con_subtitle; ?></h6>
						<?php } ?>

					</div>
					
					<div class="about_r">
						<?php if($mention_content != ""){ ?>
							<p><?php echo $mention_content; ?></p>
						<?php } ?>

						<?php if($mention_content != ""){ ?>
						   <h4><?php echo $mention_category; ?></h4>
						<?php } ?>
					</div>

				</div>
			<?php } ?>




			</div>
		</div>
	</section>

<?php 
}
	get_footer();