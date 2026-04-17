<?php 
get_header();
$term = get_queried_object();
$author_query = drift_get_author_archive_query($term->term_id);
?>
<div class="search_container">
<header class="page-header">
<h1 class="page-title">
	<?php
		$authorName = single_term_title('', false);
		echo esc_html($authorName);
	?>

	<?php
		$termID = get_queried_object()->term_id;
		$terDesc = get_term($termID)->description;
		if ($terDesc != "") {
	?>
		<span class="author_desc"><?php echo $terDesc; ?></span>
	<?php
		}
	?>
</h1>
</header><!-- .page-header -->

<div class="search-term-list">
<?php 
while($author_query->have_posts()): $author_query->the_post();
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
			<div class="col-md-4 list-feature-img"><?php 
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
			  	   <img src="<?php site_url(); ?>/wp-content/uploads/2020/04/image_2020_04_27T22_53_34_995Z.png" alt="">			
			  	</a>
			  	<?php
			  }
			?>
			</div>
			<div class="col-md-8 list-feature-info">
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
					<a href="<?php echo $pagePermalink; ?>">
							<?php
							/* translators: Search query. */
				                $authorName = single_term_title();
							    $tresty = get_query_var( 'author' );							
							    printf( __( $authorName, 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' );
							?>
			        </a>		        
		        </h3>
				<p><?php echo  wp_trim_words( get_the_content(), 70, '...' ); ?></p>
			</div>
		</div>
	</div>

<?php
endwhile;
?>

<div class="page_navigation">
	<?php
		wp_pagenavi( array('query' => $author_query) );
		wp_reset_postdata();
	?>
</div>
	
	</div>

</div>
</div>
<?php 
get_footer();