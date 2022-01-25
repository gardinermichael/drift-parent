<?php
/* Template name: Latest article */
get_header(); ?>

<div class="search_container article_container main_container_custom">
<header class="page-header">
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title">
				Latest
			</h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e( 'Nothing Found', 'twentyseventeen' ); ?></h1>
		<?php endif; ?>
	</header><!-- .page-header -->

<div class="search-term-list">


	<?php if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
$temp = $wp_query; // re-sets query
$wp_query = null; // re-sets query
?>
<?php  $args =  $args = array( 'posts_per_page' => 10, 'paged'=> $paged, 'order' => 'DESC',  'post_type'=>'post','order' => 'DESC' );
				$wp_query = new WP_Query();
				$wp_query->query( $args );
				$i=1;
				?>

<?php  while($wp_query->have_posts()) :    $wp_query->the_post();

	  	$postID = get_the_id();
	  	$thumbID = get_post_thumbnail_id($postID);

	  	if($thumbID != "")
	  	{
		  	$thumbURL = wp_get_attachment_image_src($thumbID, "full");
		  	$thumbURL = $thumbURL[0];
	  	}
	?>
	<div class="term-list">
		<div class="row">
			<div class="col-md-6 list-feature-img">
			<?php
			  if($thumbID != "")
			  {
			  	?>
			  	<a href="<?php echo get_the_permalink($postID); ?>">
				  <img src="<?php echo $thumbURL;?>" alt="">
				</a>
			  	<?php
			  }
			  else
			  {
			  	?>
			  	<a href="<?php echo get_the_permalink($postID); ?>">
			  	  <img src="<?php echo get_bloginfo("template_url");?>/assets/images/unnamed.jpg" alt="">
			  	 </a>
			  	<?php
			  }
			?>
			</div>
			<div class="col-md-6 list-feature-info <?php echo "postid-" . $postID ?>">
				<?php
					$pageID = get_the_id();
					$pageTitle = get_the_title();
					$pagePermalink = get_the_permalink();
					$subsitle = get_post_meta($pageID, "post_subsitle", true);
					$date = get_the_date();
					$articleDate = date( 'F j, Y', strtotime( CFS()->get( 'article_date', $pageID ) ) );
					if($articleDate == "" ||  $articleDate ==  "January 1, 1970")
					{
						$articleDate = $date;
					}

					$home_pageID = 109;
				    $currenatPostID = get_the_id();
				    $featuredPosts = get_post_meta($home_pageID, "select_featured_posts", true);

				?>
				<h4 class="article_date"><?php echo $articleDate; ?></h4>
				<h2>
					<a href="<?php echo $pagePermalink; ?>"><?php echo $pageTitle;?></a>
				<?php
					if($subsitle != "")
					{
						if(in_array($currenatPostID, $featuredPosts))
						    {
					          echo "<span style='".$colorPick."'> | </span> <a href='".$pagePermalink."'>".$subsitle."</a>";
						    }
						    else
						    {
                              echo "<span> | </span> <a href='".$pagePermalink."'>".$subsitle."</a>";
						    }

					}
			    ?>
			    </h2>

				<h3>
							<?php
							 $post_authors = get_the_terms( $pageID, 'authors' );
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
					 			 		?><a href="<?php echo $author_link; ?>"><?php echo $author_name;?></a><?php
					 			 	}
					 			 	else
					 			 	{
					 			 		?>, <a href="<?php echo $author_link; ?>"><?php echo $author_name;?></a><?php
					 			 	}
								  }
							}

							/* translators: Search query. */
				                $authorName = single_term_title();
							echo $tresty = get_query_var( 'author' );

							printf( __( $authorName, 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' );
							?>
			</h3>
				<p><?php echo  wp_trim_words( get_the_content(), 70, '...' ); ?></p>
			</div>
		</div>
	</div>
	<?php $i++; endwhile;  ?>
  <div class="page_navigation">
       		<?php
					wp_pagenavi( array('query'=>$wp_query)) ;
					wp_reset_postdata();
	         ?>
             </div>


</div>
</div>

<?php
get_footer();
