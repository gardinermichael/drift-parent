<?php
/* Template name: Donate form page */
get_header();
?>

<div class="the-drift-logo-mb" style="display: none;">
	<a href="<?php echo home_url(); ?>">
	  <img src="<?php echo home_url(); ?>/wp-content/uploads/2020/05/Logo.png">
	</a>
</div>
<section>
	<div class="container-fluid high-title-container">
		<div class="high-title">
				<div class="com_heading">
					<h3 class="entry-title"><strong><?php the_title(); ?></strong>
					<?php
					if ( $subsitle = get_post_meta( get_the_ID(), 'subsitle', true ) ) {
						echo "<span class='line_gray'>|</span> " . $subsitle;
					}
					?>
					</h3>
				</div>
		</div>
		<div class="ab_part d-flex">
			<div class="ab_part_l d-flex">
				<div class="ab_part_linner">
					<?php
					echo do_shortcode( '[drift_subscriptions_donate_form]' );
					?>
				</div>
			</div>
			<div class="ab_part_r donate-subscribe_txt">
				<div class="contact01">
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
</section>

<?php
get_footer();