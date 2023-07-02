<?php
/* Template name: Bundle subscribe page */
get_header();
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
			<div class="ab_part_linner kudossubscribe">

			<?php
			if ( $form = get_post_meta( get_the_ID(), 'form_name', true ) ) {
				echo do_shortcode( '[fullstripe_form name="' . $form . '" type="inline_subscription"]' );
			}
			?>
				
			</div>
		</div>

		<div class="ab_part_r donate-subscribe_txt">
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