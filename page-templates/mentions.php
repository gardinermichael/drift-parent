<?php
/* Template name: Mentions */
get_header();
?>

<?php
	$issue_args = array("post_type" => "issue", "posts_per_page" => -1);
	$issue_loop = new wp_query($issue_args);
	$article_id_array = array();
	while($issue_loop->have_posts()):$issue_loop->the_post();

		$issueListId =  get_the_id();
		$sectionLoop = get_field('select_mentions_acf', $issueListId);
		if (is_array($sectionLoop)) /* Check Array */
		{
		foreach($sectionLoop as $sectionSingle)
		{
            $article_id_array[$issueListId][] = $sectionSingle->ID;
		}}
	endwhile;
	wp_reset_postdata();
	wp_reset_query();
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
			display: inline !important;
		}

		.about_r{
			width: 50%;
		    max-width: 480px;
			/*padding:  0px 0 0 50px;*/
			padding:  0px 15px 15px 50px; /* === CHANGED 6.4 ===*/
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
		.about_l h4{
			font-size: 28px;
    		margin: 0px;
    		font-family: proxy-nova;
    		display: inline;
		}
		.about_l h6{
			font-size: 16px;
			font-family: proxy-nova;
			display: inline;
		}




		.about_r{
			width: 50%;
		    max-width: 480px;
			/*padding:  0px 0 0 50px;*/ /* === CHANGED 6/4 === */
		}
		.about_r p a{
			color: #909090;
			font-family: Adobe-Caslon;
		}
		.about_r h4{
			    /* font-size: 28px; */
			    color: <?php echo $colorPick; ?>;
			    /* font-family: 'Roboto', sans-serif;
			    text-align: right;
			    margin: 0 0 60px;
			    font-weight: 100 !important; */
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
	}

	@media (max-width: 767px) {
		.about_l {
			/*padding: 0 !important;*/			/* === CHANGED 6.4 === */
			text-align: left !important;
		}
		.single-mention .about_r {
			text-align: left !important;
			padding-top: 15px !important;
		}
		.page-template-mentions .about_r {
			text-align: left !important;
			padding-top: 15px !important;
			padding-right: 20px !important;
			padding-left: 20px !important;
		}
		.single-mention h4 span {
		    display: inline !important;
		}
	}

	</style>


	<?php if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
$temp = $wp_query; // re-sets query
$wp_query = null; // re-sets query

 $args = array( 'posts_per_page' => 2, 'paged'=> $paged, 'order' => 'DESC',  'post_type'=>'mention','order' => 'DESC' );
				$wp_query = new WP_Query();
				$wp_query->query( $args );
				$i=1;
while($wp_query->have_posts()):$wp_query->the_post();
$colorPick = "";
$pageID = get_the_id();

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
				<h3><b>Mentions</b> <span style="color:<?php echo $colorPick; ?>" > | </span> <?php echo get_the_title(); ?> </b>​
			 </h3>
			</div>
			<div class="men_content">
				<?php
				    the_content();
				?>
			</div>
			</div>
		</div>


	</div>

	<div class="ab_part_mobile">
				<?php
				    the_content();
				?>
		</div>
	<?php
	  $pageID = get_the_id();
	   $content_loop = CFS()->get( 'content_loop', $pageID );
	   if(!empty($content_loop))
	   {
	?>
	<section class="mission_outer">
		<div class="container mentions_container">
			<div class="about_outer">
				<?php
				  foreach($content_loop as $m_content)
				  {
				     $men_con_title = $m_content["men_con_title"];
				     $men_con_subtitle = $m_content["men_con_subtitle"];
				     $mention_content = $m_content["mention_content"];
					 $mention_category = $m_content["mention_category"];
					 $men_con_title_filtered = filter_var($men_con_title, FILTER_SANITIZE_STRING);

				?>

				<div>				<!-- === ADDED 6.1 (a tag & id)=== -->
				<a id="<?php echo $men_con_title_filtered; ?>"
				   href="#<?php echo $men_con_title_filtered; ?>" style="padding-top: 175px"></a>
				</div>

<!-- 				</div> -->
				<div class="about_o d-flex">
					<div class="about_l">
						<?php if($men_con_title != ""){ ?>
							<a id="<?php echo $men_con_title_filtered; ?>" href="#<?php echo $men_con_title_filtered; ?>"></a>
						     <h4><?php echo $men_con_title; ?> <span style="color:<?php echo $colorPick; ?>">|</span></h4>
					     <?php } ?>

					     <?php if($men_con_subtitle != ""){ ?>
						   <h6  style="color:<?php echo $colorPick; ?>"><?php echo $men_con_subtitle; ?></h6>
						<?php } ?>
					</div>

					<div class="about_r">
						<?php if($mention_content != ""){ ?>
							<p><?php echo $mention_content; ?></p>
						<?php } ?>

						<?php if($mention_content != ""){ ?>
						   <h4  style="color:<?php echo $colorPick; ?>"><?php echo $mention_category; ?></h4>
						<?php } ?>
					</div>

				</div>
			<?php } ?>




			</div>
		</div>
	</section>

<?php
}
?>
<?php $i++; endwhile;  ?>
  <div class="page_navigation">
       		<?php
					wp_pagenavi( array('query'=>$wp_query)) ;
					wp_reset_postdata();
	         ?>
             </div>
<?php
	get_footer();
