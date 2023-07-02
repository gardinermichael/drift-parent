<?php
/* Template name: Bundle subscribe page */
get_header();
$page_imageID = get_post_thumbnail_id($pageID);
if ($page_imageID != "") {
    $page_imageURL = wp_get_attachment_image_src($page_imageID, "large");
    $page_imageURL = $page_imageURL[0];

    $attachment = get_post($page_imageID);
    $caption = $attachment->post_excerpt;
    $attachment_url = get_the_post_thumbnail_url( $page_imageID, 'large' );
}
?>

<?php
if ( $image = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) :
	?>
	<style type="text/css">
		.page-subscribe .kudossubscribe form.wpfs-form fieldset.wpfs-form-check-group {
			background-image: url( <?php echo esc_url( $image ); ?> );
		}
	</style>

	<?php
endif;
?>

<div class="the-drift-logo-mb" style="display: none;">
	<a href="<?php echo home_url(); ?>">
	  <img src="<?php echo home_url(); ?>/wp-content/uploads/2020/05/Logo.png">
	</a>
</div>
<section>
	<div class="container-fluid">
	<div class="ab_part d-flex">

	<div class="ab_part_l d-flex">
		<div>
			<a href="<?php echo home_url(); ?>">
				<img src="<?php echo($attachment_url)?>">
			</a>
		</div>

		<div class="ab_part_l d-flex">
			<div class="ab_part_linner kudossubscribe">

			<?php
			if ( $form = get_post_meta( get_the_ID(), 'form_name', true ) ) {
				echo do_shortcode( '[fullstripe_form name="' . $form . '" type="inline_subscription"]' );
			}
			?>
				
			</div>
		</div>
	</div>

	<div class="ab_part_r donate-subscribe_txt">
		<div class="contact01">
			<div class="com_heading">
				<h3 class="entry-title"><strong>BOMB x The Drift Subscription Bundle</strong>
				</h3>
			</div>
			<div class="prose">
				<p><i><span style="font-weight: 400;">A year of art, essays, fiction, poetry, interviews, and more. </span></i></p>
				<p><span style="font-weight: 400;">Shake up your summer reading with a subscription to BOMB and </span><i><span style="font-weight: 400;">The Drift</span></i><span style="font-weight: 400;">! For a limited time, you can subscribe to two leading magazines at a discounted rate. Subscribe today and receive the latest in cultural criticism, fiction, poetry, and more delivered straight to your doorstep.</span></p>
				<p><span style="font-weight: 400;">Your bundled subscription to BOMB and</span><i><span style="font-weight: 400;"> The Drift </span></i><span style="font-weight: 400;">includes:</span></p>
				<ul>
					<li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">One year print + digital subscription to BOMB (4 issues)</span></li>
					<li style="font-weight: 400;" aria-level="1"><span style="font-weight: 400;">One year print + digital subscription to </span><i><span style="font-weight: 400;">The Drift </span></i><span style="font-weight: 400;">(3 issues)</span></li>
				</ul>
				<p><span style="font-weight: 400;">About the magazines:</span></p>
				<p><span style="font-weight: 400;">Founded in 1981, BOMB Magazine delivers the artist’s voice. We publish and preserve artist-generated material, spotlighting artists in conversation and offering unique insight into the creative process. </span></p>
				<p><span style="font-weight: 400;">Founded in June 2020, </span><i><span style="font-weight: 400;">The Drift</span></i><span style="font-weight: 400;"> aims to introduce new work and new ideas by young writers who haven’t yet been absorbed into the media hivemind and don’t feel hemmed in by the boundaries of the existing discourse. Our issues, published three times a year, feature longform essays and cultural criticism, short fiction, poetry, interviews, dispatches, and extremely abbreviated reviews.</span></p>
			</div>
		</div>
	</div>
	</div>
</div>
</section>

<?php
get_footer();
