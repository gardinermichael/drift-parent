<?php

/* Template name: Issues page */
get_header();
global $theme_option;
$issue_color = $theme_option["issue_color"];
?>

<style type="text/css">
    .com_heading01 .cfs-hyperlink span {
        color: #000;
    }

    .page-template-issues .com_heading01 {
        margin-bottom: 20px;
    }

    h4 {
        font-size: 22px;
        letter-spacing: 0px;
        font-weight: 400;
        line-height: 1.2;
        position: relative;
        padding: 0px 0 0px;
        text-align: left;
        color: #303030;
        margin: 0;
        font-family: proxy-nova;
    }

    .com_heading01 span {
        font-family: Adobe-Caslon;
        font-size: 22px;
        position: relative;
        top: -3px;
        color: <?php echo $issue_color; ?>;
        font-weight: 600;
    }

    .com_heading01 h4 b {
        font-weight: 600;
        font-family: Adobe-Caslon;

    }

    .com_heading01 p {
        font-size: 17px;
        letter-spacing: 0px;
        line-height: 1.6em;
        margin-bottom: 25px;
    }

    .cus_post_hea h6 {
        font-size: 17px;
        letter-spacing: 0px;
        line-height: 1.6em;
        margin-bottom: 20px;
        color: <?php echo $issue_color; ?>;
        font-weight: 700;
        text-transform: uppercase;
        font-family: proxy-nova;
    }

    .bredcrum01 {
        position: relative;
        height: 120px;
        background-repeat: no-repeat;
        background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2020/04/bredcrum01.png ');
        background-size: cover;
        background-position: center;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    .bredcrum01::after {
        display: block;
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.50);

    }

    .bredcrum01 .container {
        position: relative;
        z-index: 99;
    }

    .bredcrum01 h2 {
        font-size: 50px;
        font-weight: 700;
        font-family: Adobe-Caslon;
        line-height: 1em;
        margin: 0;
        padding: 10px 0 0 0;
        color: #303030;
    }

    .bredcrum01 h4 {
        font-size: 25px;
        font-weight: 500;
        font-family: proxy-nova;
        line-height: 1em;
        margin: 0 0 5px 0;
        padding: 0;
        color: #303030;
    }

    .issue_container {
        /*margin-top: 25px;*/
        margin-top: 60px;
        /* =========== ADDED 5.28 ============== */
    }

    .cus_post_outer {
        margin-bottom: 50px;
    }

    @media (max-width: 320px) {}
</style>

<?php
$issue_args = [
    "post_type" => "issue",
    "order" => "DESC",
    "orderby" => "date",
    "posts_per_page" => -1
];
$issue_loop = new wp_query($issue_args);

while ($issue_loop->have_posts()) : $issue_loop->the_post(); // the main loop over issues

    $pageID = get_the_id();
    $bannerImageID = get_post_thumbnail_id($pageID);

    if ($bannerImageID != "") {
        $bannerImageURL = wp_get_attachment_image_src($bannerImageID, "full");
        $bannerImageURL = $bannerImageURL[0];
    }

    $issue_subtitle = get_post_meta($pageID, "issue_subtitle_acf", true);
    /* $issue_bgCropID = get_post_meta($pageID, "heading_backgroun_image", true);
  if($issue_bgCropID != "")
  {
    $bannerImageURL = wp_get_attachment_image_src($issue_bgCropID, "full");
    $bannerImageURL = $bannerImageURL[0];
  }  */
?>
    <div class="row issues_container">
        <div class=" col-md-6 issue_div_left">
            <img src="<?php echo $bannerImageURL; ?>">
        </div>

        <div class=" col-md-6 issue_div_right">
            <section class="cus_post_outer">
                <div class="container">

                    <div class="cus_post">
                        <?php
                        $date = get_the_date('F j, Y');
                        $articleDate = date('F j, Y', strtotime(CFS()->get('current_issue_date', $pageID)));
                        if ($articleDate == "" || $articleDate ==  "January 1970") {
                            $articleDate = $date;
                        }

                        $current_issue_subtitle = get_post_meta($pageID, "current_issue_subtitle", true);
                        ?>
                        <a id="<?php echo get_the_title(); ?>"></a> <!-- TESTING HYPERLINK from HomePage Issues -->
                        <h1 class="issue_heading"><b><?php echo get_the_title(); ?></b> <br /> <?php if ($current_issue_subtitle != "") { ?><span>|</span> <?php echo $articleDate;
                                                                                                                                                        } ?>
                        </h1>

                        <?php

                        $sectionLoop = get_field('section_acf');
                        if (is_array($sectionLoop)) { /* Check Array */
                            foreach ($sectionLoop as $sectionVal) {
                                $section_name = $sectionVal["section_name_acf"];
                                $add_article = $sectionVal["add_article_acf"];
                                $colorPick = get_post_meta($pageID, "color_for_current_issue", true); ?>
                                <div class="issue_container">
                                    <div class="cus_post_hea">
                                        <h6 style=" <?php if ($colorPick != "") { ?>color:  <?php echo $colorPick;
                                                                                        } ?>"><?php echo $section_name; ?></h6>
                                    </div>

                                    <?php
                                    $loopNum = 0;
                                    if (is_array($add_article)) /*Check Array*/ {
                                        foreach ($add_article as $articleValue) {
                                            $loopNum_test++;
                                            //$issueid = $articleValue["article_link_acf"]->ID;
                                            $issueid = $articleValue["article_link_2"][0];

                                            $issuePermalink = get_the_permalink($issueid);
                                            $issueTitle = get_the_title($issueid); ?>
                                            <style type="text/css">
                                                .issue_container .com_heading01#id_<?php echo $loopNum_test; ?>a:hover b {
                                                    color: <?php echo $colorPick; ?>;
                                                }
                                            </style>
                                            <div class="com_heading01" id="id_<?php echo $loopNum_test; ?>">
                                                <h4>
                                                    <a href="<?php echo $issuePermalink; ?>"><b><?php echo $articleValue["title_acf"]; ?></b>​<span class="issues_pipe" style=" <?php if ($colorPick != "") { ?>color:  <?php echo $colorPick;
                                                                                                                                                                                                                    } ?>">|</span><?php echo $articleValue["subtitle_acf"]; ?></a>
                                                </h4>


                                                <?php $post_authors = get_the_terms($issueid, 'authors');
                                                $loopNum = 0;
                                                if (is_array($post_authors)) {
                                                ?>
                                                    <div class="authors">
                                                        <?php
                                                        foreach ($post_authors as $post_author) {
                                                            $loopNum++;
                                                            $author_id = $post_author->term_id;

                                                            $author_link = get_term_link($post_author);
                                                            $author_name = $post_author->name;
                                                            $author_description = $post_author->description;

                                                            if ($loopNum == 1) {
                                                        ?><a href="<?php echo $issuePermalink; ?>"><?php echo $author_name; ?></a><?php
                                                                                                                                } else {
                                                                                                                                    ?><a href="<?php echo $issuePermalink; ?>"><?php echo $author_name; ?></a><?php
                                                                                                                                                                                                            }
                                                                                                                                                                                                        } ?></div><?php
                                                                                                                                                                                                                } ?>
                                            </div>
                                    <?php
                                        }
                                    } ?>

                                </div>
                        <?php
                            }
                        } ?>

                        <?php
                        $mentionIDs = get_post_meta($pageID, "select_mentions_acf", true);
                        ?>


                        <div class="com_heading01">
                            <?php
                            if (is_array($mentionIDs)) /*Check Array*/ {
                                foreach ($mentionIDs as $mentionID) {
                            ?>
                                    <style type="text/css">
                                        .com_heading01 h4#mention_<?php echo $mentionID; ?>a:hover b {
                                            color: <?php echo $colorPick; ?>;
                                        }

                                        .com_heading01 h4#mention_<?php echo $mentionID; ?>a:hover {
                                            color: #303030;
                                            ?>;
                                        }
                                    </style>
                                    <h6 class="cus_post_hea" style="padding-top: 40px; margin-bottom: 20px; font-family: proxy-nova; font-size: 17px; font-weight: 700; color:<?php echo $colorPick; ?>">MENTIONS</h6>
                                    <h4 id="mention_<?php echo $mentionID; ?>"><a href="<?php echo get_the_permalink($mentionID); ?>"><b>Extremely Abbreviated Reviews</b>​</a> <span style="color:<?php echo $colorPick; ?>">|</span> <a href="<?php echo get_the_permalink($mentionID); ?>"><?php echo get_the_title($mentionID); ?></a> </h4>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
<?php
endwhile;
?>

<?php
get_footer();
?>