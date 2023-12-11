<?php
/* Template name: Solo checkout page */
get_header();
?>

<section class="mission_outer">
    <div class="container-fluid">
        <div class="mission">
            <div class="mission_inner">
                <div class="mission_inner_body">
                    <?php
                    while ( have_posts() ) :
						the_post();
						the_content();
					endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();