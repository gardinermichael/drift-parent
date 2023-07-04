<?php
/* Template name: Bundle subscribe page */
get_header();
?>

<?php
$form = get_post_meta( get_the_ID(), 'form_name', true );
$formID = get_post_meta( get_the_ID(), 'form_id', true );

if ( $image = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) :
	?>
	<style type="text/css">
		.page-subscribe .kudossubscribe form.wpfs-form fieldset.wpfs-form-check-group {
			background-image: url( <?php echo esc_url( $image ); ?> );
		}

		#wpfs-billing-address-country--<?php echo($formID); ?>-button {
			/*aria-disabled:true;*/
			cursor: not-allowed;
		}

		label[for="wpfs-billing-address-country--<?php echo($formID); ?>-button"]::after {
			content: ' (bundle only available in US)'
		}
	</style>

	<script type="text/javascript">
		(function(window, document, undefined) {
			window.onload = init;

			function init(){
				const options = document.querySelectorAll('option');
				options.forEach(option => {
					options.setAttribute('disabled', 'disabled');
				})
			}

		})(window, document, undefined);
	</script>

	<?php
endif;
?>

<div class="the-drift-logo-mb" style="display: none;">
	<a href="<?php echo home_url(); ?>">
		<img src="<?php echo home_url(); ?>/wp-content/uploads/2020/05/Logo.png">
	</a>
</div>
<section>
	<div class="container-fluid max-w-4xl mx-auto mt-16">
	<div class="ab_part d-flex">
		<div class="ab_part_l d-flex sm:px-6">
			<div class="ab_part_linner kudossubscribe">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo(esc_url($image));?>">
				</a>
			<?php
			if ( $form ) {
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