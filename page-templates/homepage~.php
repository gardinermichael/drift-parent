<?php
/* Template name: Homepage 3 */
get_header();
$pageID = get_the_id();

$issue_text = get_post_meta($pageID, "issue_text", true);
$issue_ID = get_post_meta($pageID, "issue_link", "true");
$colorPick = get_post_meta($issue_ID, "color_for_current_issue", "true");

$url = get_the_permalink($issue_ID);
?>
<style type="text/css">
    :root {
        --issue_color: <?php echo($colorPick); ?>
    }
</style>

<div class="ab_part d-flex main_container_custom">
    <div class="ab_part_l d-flex">
        <div class="ab_part_linner">
            <div class="ab_part_img">
                <?php
                $pageID = get_the_id();
                $thumbID = get_post_thumbnail_id($pageID);
                if ($thumbID == "") {
                ?>
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/shot1.png">
                <?php
                } else {
                    list($thumbURL, $width, $height) = wp_get_attachment_image_src($thumbID, "full");
                ?>
                    <a href="<?php echo ($url);?>"><img fetchpriority="high" src="<?php echo $thumbURL; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></a>
                <?php
                }
                ?>
            </div>
        </div>

    </div>
    <div class="ab_part_r home_issue_page_text">
        <h4>
            <?php
            $issueArgs = array("post_type" => "issue");
            $issueLoop = new wp_query($issueArgs);
            while ($issueLoop->have_posts()) : $issueLoop->the_post();
                $issuePostID = get_the_id();
                if ($issuePostID == $issue_ID) {
                    echo get_the_content();
                }
            endwhile;
            ?>
        </h4>
        <?php
        if ($issue_text != "") {
            $url = get_the_permalink(14);
        ?>
        <h2 class="read_now">
            <a href="<?php echo $url; ?>"><?php echo $issue_text; ?></a>
        </h2>
        <?php } ?>
    </div>
</div>

<section class="mission_outer">
    <div class="container">
        <div class="mission">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>
<div class="signup4mail mt_wrap">
    <div class="signup4mail_BG">
        <div class="row custom_wrap">
            <div class="col-md-1"></div>
            <div class="signup4mail_Left">
                <a href="https://newsletter.thedriftmag.com/welcome" target="_blank" rel="noopener noreferrer"><h3><u>Sign up</u> for our newsletter to read more from <i>The Drift</i>.</h3></a>
            </div>
        </div>
    </div>
</div>
<div class="latestArticle_Heading">
    <h1>Latest</h1>
</div>
<?php
$postArgs = array("post_type" => "post", "posts_per_page" => "3", "order" => "desc", "orderby" => "date");
$postLoop = new wp_query($postArgs);
?>
<div class="row latest_articles">

    <?php
    while ($postLoop->have_posts()) : $postLoop->the_post();
        $postID = get_the_id();
        $postLink = get_the_permalink($postID);
        $postTitle = get_the_title($postID);
        $post_imageID = get_post_thumbnail_id($postID, 'large');

        if ($post_imageID) {
            list($post_imageURL, $width, $height) = wp_get_attachment_image_src($post_imageID, "large");
        } else {
            $post_imageURL = get_bloginfo("template_url") . "/assets/images/support.png";
        }

        $postSubtitle = get_post_meta($postID, "post_subsitle", true);
        //$article_editor_name = get_post_meta($postID, "article_editor_name", true);

        $post_authors = get_the_terms($postID, 'authors');
        $loopNum = 0;
        if (is_array($post_authors)) {
            foreach ($post_authors as $post_author) {
                $loopNum++;
                $author_id = $post_author->term_id;

                $author_link = get_term_link($post_author);
                $author_name = $post_author->name;
                $author_description = $post_author->description;

                if ($loopNum == 1) {
                    $article_editor_name = $post_author->name;
                }
            }
        }
    ?>
        <div class="col-md-4 single_article  <?php echo "postid-" . $postID; ?>">

            <div class="article_feaImage ">
                <a href="<?php echo $postLink; ?>">
                    <img src="<?php echo $post_imageURL; ?>" width="<?php echo($width);?>" height="<?php echo($height);?>">
                </a>
            </div>

            <div class="article_heading">
                <h4>
                    <a href="<?php echo $postLink; ?>">
                        <strong><?php echo $postTitle; ?></strong>
                        <?php
                        if ($postSubtitle != "") {
                        ?>
                            <span class="article_span">|</span> <?php echo $postSubtitle; ?>
                        <?php
                        }
                        ?>
                    </a>
                </h4>
            </div>

            <?php
            if ($article_editor_name != "") {
            ?>
                <div class="article_sub_heading">
                    <strong><a href="<?php echo $postLink; ?>"><?php echo $article_editor_name; ?></a></strong>
                </div>
            <?php } ?>

        </div>
    <?php endwhile; ?>
    <div class="seeMoreLink latestArticleMore">
        <a href="<?php echo get_the_permalink(323); ?>">
            See more
        </a>
    </div>
</div>
<hr />

<?php
$featuredPackage = get_post_meta($pageID, "package_description", true);
//$packageTagName = get_post_meta($pageID, "package_tag", true);
//$packageTag = get_term_by('name', $packageTagName, 'post_tag');
$featuredPosts = get_post_meta($pageID, "featured_package_posts", true);
if ($featuredPackage) {
?>
<div class="latestArticle_Heading">
<h1><?php echo($featuredPackage); ?></h1>
</div>
<div class="row latest_articles">

    <?php
    foreach ($featuredPosts as $featuredPost) {
        $postID = $featuredPost;
        $postLink = get_the_permalink($postID);
        $postTitle = get_the_title($postID);
        $post_imageID = get_post_thumbnail_id($postID);

        if ($post_imageID) {
            list($post_imageURL, $width, $height) = wp_get_attachment_image_src($post_imageID, "large");
        } else {
            $post_imageURL = get_bloginfo("template_url") . "/assets/images/dummy.jpg";
        }

        $postSubtitle = get_post_meta($postID, "post_subsitle", true);


        $post_authors = get_the_terms($postID, 'authors');
        $loopNum = 0;

        if (is_array($post_authors)) {
            foreach ($post_authors as $post_author) {
                $loopNum++;
                $author_id = $post_author->term_id;

                $author_link = get_term_link($post_author);
                $author_name = $post_author->name;
                $author_description = $post_author->description;

                if ($loopNum == 1) {
                    $article_editor_name = $post_author->name;
                }
            }
        }
    ?>
        <div class="col-md-4 single_article <?php echo "postid-" . $postID; ?>">
            <div class="article_feaImage">
                <a href="<?php echo $postLink; ?>">
                    <img src="<?php echo $post_imageURL; ?>" width="<?php echo($width);?>" height="<?php echo($height);?>">
                </a>
            </div>

            <div class="article_heading">
                <h4>
                    <a href="<?php echo $postLink; ?>">
                        <strong><?php echo $postTitle; ?></strong>
                        <?php
                        if ($postSubtitle != "") {
                        ?>
                            <span class="article_span">|</span> <?php echo $postSubtitle; ?>
                        <?php
                        }
                        ?>
                    </a>
                </h4>
            </div>

            <?php
            if ($article_editor_name != "") {
            ?>
                <div class="article_sub_heading">
                    <strong><a href="<?php echo $postLink; ?>"><?php echo $article_editor_name; ?></a></strong>
                </div>
            <?php } ?>

        </div>
    <?php } ?>
</div>
<hr class="mob-hide-line" />

<?php
}
?>

<?php
wp_reset_postdata();
wp_reset_query();
$pageID = get_the_id();
$mentionHeading = get_post_meta($pageID, "mention_heading", true);
$mentionSubHeading = get_post_meta($pageID, "mention_subheading", true);
?>

<div class="latestArticle_Heading">
    <?php if ($mentionHeading != "") { ?>
        <h1><?php echo $mentionHeading; ?></h1>
    <?php } ?>

    <?php if ($mentionSubHeading != "") { ?>
        <p><?php echo $mentionSubHeading; ?></p>
    <?php } ?>

</div>
<div class="home_mentions">
    <div class="row custom_wrap home_mentions_wrap">
        <ul class="home_mentions">
            <?php
            $mention_text_loop = CFS()->get("mention_text_loop", $pageID);
            foreach ($mention_text_loop as $mention_text) {

                $mention_textValue = $mention_text["mention_text"];
                $mention_link  = $mention_text["mention_link"];
                $mention_is_italic = array_key_exists("Italic", $mention_text["mention_style"]);
                $men_textValue_filtered = filter_var($mention_textValue, FILTER_UNSAFE_RAW);

                if ($mention_link == "") {
                    //$mention_link = "#";
                    $mention_link = esc_url(site_url("/mentions/#$mention_textValue"));
                    //$mention_link = esc_url("/mentions/#$men_textValue_filtered");
                }
                if ($mention_is_italic) {
                    $mentionClass = " mention_italic ";
                } else {
                    $mentionClass = "";
                }
            ?>
                <li class="<?php echo $mentionClass; ?>"><a href="<?php echo $mention_link; ?>"><?php echo $mention_textValue; ?></a></li>
            <?php }
            ?>


            <li class="more_link"><a href="<?php echo esc_url(site_url('/mentions')); ?>">More</a></li>
        </ul>
    </div>
</div>

<?php
wp_reset_query();
wp_reset_postdata();
$pageID = get_the_id();
$supportText = get_post_meta($pageID, "support_us_text", true);

if ($supportText != "") {
?>
    <div class="signup4mail mt_wrap">
        <div class="row custom_wrap">
            <div class="col-md-3 support_heading">
                <h3>Support us</h3>
            </div>
            <div class="col-md-5 support_content">
                <?php echo wpautop($supportText); ?>
            </div>

            <div class="col-md-4 support_subheadings">
                <h3> <a href="<?php echo get_the_permalink(8); ?>">Subscribe</a> <span class="support_us_pipe">|</span> <a href="<?php echo get_the_permalink(6); ?>">Donate</a> </h2>
            </div>
        </div>
    </div>
<?php } ?>

<div class="latestArticle_Heading">
    <h1>Featured</h1>
</div>
<?php
$featuredPosts = get_post_meta($pageID, "select_featured_posts", true);
?>
<div class="row latest_articles">

    <?php
    foreach ($featuredPosts as $featuredPost) {
        $postID = $featuredPost;
        $postLink = get_the_permalink($postID);
        $postTitle = get_the_title($postID);
        $post_imageID = get_post_thumbnail_id($postID);

        if ($post_imageID) {
            list($post_imageURL, $width, $height) = wp_get_attachment_image_src($post_imageID, "large");
        } else {
            $post_imageURL = get_bloginfo("template_url") . "/assets/images/dummy.jpg";
        }

        $postSubtitle = get_post_meta($postID, "post_subsitle", true);


        $post_authors = get_the_terms($postID, 'authors');
        $loopNum = 0;

        if (is_array($post_authors)) {
            foreach ($post_authors as $post_author) {
                $loopNum++;
                $author_id = $post_author->term_id;

                $author_link = get_term_link($post_author);
                $author_name = $post_author->name;
                $author_description = $post_author->description;

                if ($loopNum == 1) {
                    $article_editor_name = $post_author->name;
                }
            }
        }
        //$article_editor_name = get_post_meta($postID, "article_editor_name", true);
    ?>
        <div class="col-md-4 single_article <?php echo "postid-" . $postID; ?>">

            <div class="article_feaImage">
                <a href="<?php echo $postLink; ?>">
                    <img src="<?php echo $post_imageURL; ?>" width="<?php echo($width);?>" height="<?php echo($height);?>">
                </a>
            </div>

            <div class="article_heading">
                <h4>
                    <a href="<?php echo $postLink; ?>">
                        <strong><?php echo $postTitle; ?></strong>
                        <?php
                        if ($postSubtitle != "") {
                        ?>
                            <span class="article_span">|</span> <?php echo $postSubtitle; ?>
                        <?php
                        }
                        ?>
                    </a>
                </h4>
            </div>

            <?php
            if ($article_editor_name != "") {
            ?>
                <div class="article_sub_heading">
                    <strong><a href="<?php echo $postLink; ?>"><?php echo $article_editor_name; ?></a></strong>
                </div>
            <?php } ?>

        </div>
    <?php } ?>
    <div class="seeMoreLink featuredArticleMore">
        <a href="<?php echo get_the_permalink(323); ?>">See more</a>
    </div>
</div>
<hr class="mob-hide-line" />

<?php
$issue_args = array("post_type" => "issue", "posts_per_page" => "-1", "order" => "DESC", "orderby" => "date");
$issue_loop = new wp_query($issue_args);
?>

<div class="latestArticle_Heading td-issues-head">
    <h1>Issues</h1>
</div>

<div class="home_issues">
    <?php
    $issue_ID = get_post_meta($pageID, "issue_link", "true");
    $issue_number = get_post_meta($issue_ID, "issue_number", "true");
    ?>
    <div class="owl-carousel">
        <?php
        while ($issue_loop->have_posts()) : $issue_loop->the_post();
            $issuePostID =  get_the_id();
            $issuePostPermalink = get_the_permalink($issuePostID);

            $issuePostImageID = get_post_thumbnail_id($issuePostID);
            if ($issuePostImageID != "") {
                $issuePostImageURL = wp_get_attachment_image_src($issuePostImageID, "large");
                $issuePostImageURL = $issuePostImageURL[0];
            } else {
                $issuePostImageURL = get_bloginfo("template_url") . "/assets/images/dummy.jpg";
            }
            ?>
            <a href="<?php echo $issuePostPermalink; ?>"><img src="<?php echo $issuePostImageURL; ?>"></a>
        <?php endwhile;?>
    </div>
</div>

<?php
get_footer();
