<?php
/**
 * The template for displaying posts with a tag used to promote a package on the front page.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>

<?php
$tag_title = single_tag_title();
$tag_posts = new WP_Query(array('tag' => $tag_title, 'posts_per_page' => 10));
?>

<div class="search_container">
<header class="page-header">
		<?php if ( $tag_posts->have_posts() ) : ?>
			<h1 class="page-title">
			<?php
			printf($tag_title);
			?>
			</h1>
		<?php else : ?>	
			<h1 class="page-title"><?php _e( 'No Results.', 'twentyseventeen' ); ?></h1>	
		<?php endif; ?>
	</header><!-- .page-header -->

<div class="search-term-list">
	<?php 
	  while($tag_posts->have_posts()):$tag_posts->the_post();
	  	$postID = get_the_id();
	  	$thumbID = get_post_thumbnail_id($postID);
	  	
	  	if($thumbID != "")
	  	{
		  	$thumbURL = wp_get_attachment_image_src($thumbID, "full");	  	
		  	$thumbURL = $thumbURL[0];
	  	}

	  if($thumbID != "")
	  {
	  	$featuredDIV = 'col-md-8';
	  }	
	  else
	  {
	  	$featuredDIV = 'col-md-12';
	  }
	?>
	<div class="term-list">
		<div class="row">
      
    <?php
	  if($thumbID != "")
	  {
	?>
			<div class="col-md-4 list-feature-img">
				<a href="<?php echo get_the_permalink(); ?>">				
				   <img src="<?php echo $thumbURL;?>" alt="">	
				</a>
			</div>
    <?php } ?>
			<div class="<?php echo $featuredDIV; ?> list-feature-info">
				<?php 
					$pageID = get_the_id();
					$pageTitle = get_the_title();
					$pagePermalink = get_the_permalink();
					$subsitle = get_post_meta($pageID, "post_subsitle", true);
				?>
				<h2>
					<a href="<?php echo $pagePermalink; ?>"><?php echo $pageTitle;?></a>
				<?php 
					if($subsitle != "")
					{
	                   echo "<span> | </span> <a href='".$pagePermalink."'>".$subsitle."</a>";
					}
			    ?>
			    </h2>
				 
				<h3>
							<?php
							 $post_authors = get_the_terms( $pageID, 'authors' );
							 $loopNum = 0;
								if (is_array($post_authors)){ //ADDED
					 			 foreach($post_authors as $post_author)
					 			 {
					 			 	$loopNum++;
					 			 	$author_id = $post_author->term_id;
					 			 	
					 			 	$author_link = get_term_link($post_author);
					 			 	$author_name = $post_author->name;
					 			 	$author_description = $post_author->description;
					 			 	
					 			 	if($loopNum == 1)
					 			 	{
					 			 		?><a href="<?php echo $pagePermalink; ?>"><?php echo $author_name;?></a><?php
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
<?php endwhile; ?>

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
