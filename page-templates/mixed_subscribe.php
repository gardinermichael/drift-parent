<?php
/* Template name: Mixed subscribe page */
get_header();
?>

<?php
if ( $image = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) :
	?>
	<style type="text/css">
		form.wpfs-form fieldset.wpfs-form-check-group {
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
<?php
// Query BOMB bundle subscription page for first section
$bundle_id = get_page_by_path("/bomb-x-the-drift-subscription-bundle");
$bundle_content = $bundle_id->post_content;
$bundle_subsitle = get_post_meta( $bundle_id, 'subsitle', true );
$bundle_image = get_the_post_thumbnail_url( $bundle_id, 'large' )

?>
<section>
	<div class="container-fluid max-w-4xl mx-auto mt-16">
	<div class="ab_part d-flex">
		<div class="ab_part_l d-flex sm:px-6">
			<div class="ab_part_linner kudossubscribe">
				<a href="<?php echo(get_permalink($bundle_id)); ?>">
					<img src="<?php echo(esc_url($bundle_image));?>">
				</a>
			</div>
		</div>

		<div class="ab_part_r flex">
			<div class="contact01">
				<div class="com_heading">
					<h3 class="entry-title"><strong><?php echo(get_the_title($bundle_id)); ?></strong>
					<?php
					if ( $bundle_subsitle ) {
						echo "<span class='line_gray'>|</span> " . $bundle_subsitle;
					}
					?>
					</h3>
				</div>
				<div class="prose">
				<?php
					echo($bundle_content);
				?>
				</div>
                <div class="wp-block-button"><a href="<?php echo(get_permalink($bundle_id)); ?>" class="wp-block-button__link wp-element-button">BUY THE BUNDLE</a></div>
			</div>
		</div>
	</div>
</div>
</section>
<section>
	<div class="container-fluid max-w-4xl mx-auto mt-16">
	<div class="ab_part d-flex">
		<div class="ab_part_l d-flex sm:px-6">
			<div class="ab_part_linner kudossubscribe">
			<?php
			if ( $form = get_post_meta( get_the_ID(), 'form_name', true ) ) {
				echo do_shortcode( '[fullstripe_form name="' . $form . '" type="inline_subscription"]' );
			}
			?>
			</div>
		</div>

		<div class="ab_part_r flex">
			<div class="contact01">
				<div class="com_heading">
					<h3 class="entry-title"><strong><?php the_title(); ?></strong>
					<?php
					if ( $subsitle = get_post_meta( get_the_ID(), 'subsitle', true ) ) {
						echo "<span class='line_gray'>|</span> " . $subsitle;
					}
					?>
					</h3>
				</div>
				<div class="prose">
				<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

<?php
get_footer();