<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header();

// Surface contributor pages whose name or bio matches the search, since
// taxonomy archives can never appear among post results. Computed before the
// header so the "No Results." heading can account for contributor matches.
// Uses the raw query: get_search_query() HTML-escapes, which would make names
// like O'Connor miss.
$drift_search_string = trim(get_search_query(false));
$drift_matching_authors = array();

if ($drift_search_string !== '') {
	$drift_author_matches = array();

	// The LIKE lookups match anywhere in a word ("test" matches "latest"),
	// so require the query to start at a word boundary in the name or bio.
	// Only prepend \b when the query itself starts with a word character;
	// otherwise (e.g. ".net", "@handle") the boundary would never match.
	$drift_boundary = preg_match('/^\w/u', $drift_search_string) ? '\b' : '';
	$drift_word_pattern = '/' . $drift_boundary . preg_quote($drift_search_string, '/') . '/iu';

	foreach (array('name__like', 'description__like') as $drift_match_field) {
		$drift_found = get_terms(array(
			'taxonomy'        => 'authors',
			$drift_match_field => $drift_search_string,
			'hide_empty'      => false,
			// Fetch a wide candidate pool: the LIKE lookup also returns
			// mid-word hits that the word-boundary filter below drops, so a
			// small cap here could starve out genuine matches that sort later.
			'number'          => 100,
		));

		if (is_wp_error($drift_found)) {
			continue;
		}

		foreach ($drift_found as $drift_found_term) {
			// Bios may contain HTML, so strip tags before matching to avoid
			// false positives on markup (tag names, attributes, URLs).
			$drift_bio_text = $drift_found_term->name . ' ' . wp_strip_all_tags($drift_found_term->description);
			if (!preg_match($drift_word_pattern, $drift_bio_text)) {
				continue;
			}

			$drift_author_matches[$drift_found_term->term_id] = $drift_found_term;
		}
	}

	$drift_matching_authors = array_slice(array_values($drift_author_matches), 0, 10);
}
?>
<div class="search_container">
<header class="page-header">
		<?php if ( have_posts() || !empty($drift_matching_authors) ) : ?>
			<h1 class="page-title">
			<?php
			/* translators: Search query. */
			printf( __( 'Results for: "%s"', 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' );
			?>
			</h1>
		<?php else : ?>

		<div class="searchPage_Form_container">
			<div class="searchPage_Form">
				<i class="fa fa-search search_icon_custom"></i>
				<button class="searchPage_Form_Button">Submit</button>
				<input type="text" name="" class="searchPage_Form_Box" placeholder="Search here...">
			</div>
	    </div>

			<h1 class="page-title"><?php _e( 'No Results.', 'twentyseventeen' ); ?></h1>



		<?php endif; ?>
	</header><!-- .page-header -->

<?php
if (!empty($drift_matching_authors)) :
?>
<div class="search-author-matches">
	<h2>Contributors</h2>
	<ul>
	<?php
	foreach ($drift_matching_authors as $drift_matching_author) :
		$drift_author_link = get_term_link($drift_matching_author);
		if (is_wp_error($drift_author_link)) {
			continue;
		}
	?>
		<li><a href="<?php echo esc_url($drift_author_link); ?>"><?php echo esc_html($drift_matching_author->name); ?></a></li>
	<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>

<div class="search-term-list">
	<?php 
	  while(have_posts()):the_post();
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
								if (is_array($post_authors)){
								 $is_first_author = true;
					 			 foreach($post_authors as $post_author)
					 			 {
					 			 	$author_link = get_term_link($post_author);
					 			 	$author_name = $post_author->name;

					 			 	if (is_wp_error($author_link)) {
					 			 		continue;
					 			 	}

					 			 	if(!$is_first_author)
					 			 	{
					 			 		echo ', ';
					 			 	}
					 			 	?><a href="<?php echo esc_url($author_link); ?>"><?php echo esc_html($author_name);?></a><?php
					 			 	$is_first_author = false;
					 			 }
							}
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
