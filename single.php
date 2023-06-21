<?php
get_header();
$pageID = get_the_id();
$page_imageID = get_post_thumbnail_id($pageID);

$captionArray = wp_get_attachment_metadata($pageID);
$category = get_the_category();
$issue_no = $category[0]->name . '&nbsp;';

if ($page_imageID != "") {
    $page_imageURL = wp_get_attachment_image_src($page_imageID, "full");
    $page_imageURL = $page_imageURL[0];

    $attachment = get_post($page_imageID);
    $caption = $attachment->post_excerpt;
}

$issue_args = array("post_type" => "issue", "posts_per_page" => -1);
$issue_loop = new wp_query($issue_args);
$article_id_array = array();
while ($issue_loop->have_posts()):$issue_loop->the_post();

    $issueListId =  get_the_id();
    $sectionLoop = get_field('section_acf', $issueListId);

    foreach ($sectionLoop as $sectionVal) {
        $add_article = $sectionVal["add_article_acf"];
        if (is_array($add_article)) /*Check Array*/
        {
       foreach ($add_article as $articleValue) {
           $article_id_array[$issueListId][] = $articleValue["article_link_2"][0];
       }}
    }

endwhile;


foreach ($article_id_array as $key => $article_id_values) {
    if (in_array($pageID, $article_id_values)) {
        $issue_Color_ID = $key;
        $colorPick = get_post_meta($issue_Color_ID, "color_for_current_issue", true);
    }
}

if ($colorPick == "") {
    $colorPick = "#69a7c2";
}

wp_reset_postdata();
wp_reset_query();
$currentPageID = get_the_id();
$breakWidth = get_post_meta($currentPageID, "break_point_on_device_width", true);
if ($breakWidth == "") {
    $breakWidth = "1100";
}
?>

<style type="text/css">
    :root {
        --issue_color: <?php echo $colorPick; ?>;
    }

    <?php if ($breakWidth != "") {?>
    @media(min-width: 768px)and (max-width: <?php echo $breakWidth; ?>px){
        /*.ab_part_r h3 span{ display: none; } */	/* === CHANGED 6.3 === */
        /*.com_heading h3 b{ display: block; }*/	/* === CHANGED 6.3 === */
    }
    <?php } ?>
</style>

    <section class="main_container_custom">
        <div class="container-fluid">
<?php
$type_of_titles = get_post_meta($pageID, "type_of_titles", true);
if ($type_of_titles == "Style 2") {
    $coverClasss = "headong0022_cover";
    $coverheading2 = "headong0022";
} else {
    $coverClasss = "";
    $coverheading2 = "";
}
?>

    <div class="ab_part <?php echo $coverClasss; ?> d-flex">
        <?php
          if ($page_imageID != "") {
              ?>
        <div class="ab_part_l d-flex">
            <div class="ab_part_linner">
                <div class="ab_part_img">
<?php
                    $pageID = get_the_id();
              $date = get_the_date();
              $articleDate = date('F j, Y', strtotime(CFS()->get('article_date', $pageID)));
              if ($articleDate == "" || $articleDate ==  "January 1, 1970") {
                  $articleDate = $date;
              }

              $issue_args = array("post_type" => "issue", "posts_per_page" => -1);
              $issue_loop = new wp_query($issue_args);
              $article_id_array = array();
              while ($issue_loop->have_posts()):$issue_loop->the_post();

              $issueListId =  get_the_id();
              $sectionLoop = get_field('section_acf', $issueListId);
              foreach ($sectionLoop as $sectionVal) {
                  $add_article = $sectionVal["add_article_acf"];
                  if (is_array($add_article)) /*Check Array*/
        {
                       foreach ($add_article as $articleValue) {
                           if ($articleValue["article_link_2"][0] == $pageID) {
                               $article_id_array[$issueListId][] = $articleValue["article_link_2"][0];
                           }
                       }}
              }

              endwhile;

              if (!empty($article_id_array)) {
                  foreach ($article_id_array as $issue_key => $currentPost) {
                      $issue_keyID = $issue_key;
                  }
              } ?>
                 <div class="postDate mobile_version">
                    <b class="issue_title"><?php echo $issue_no; ?>	<span>|</span></b>
                        <?php echo $articleDate;

              wp_reset_postdata();
              wp_reset_query(); ?>
                </div>

                    <img src="<?php echo $page_imageURL; ?>">
                    <?php
                        if ($caption != "") {
                            echo "<p class='caption'>".$caption."</p>";
                        } ?>
                </div>
            </div>
        </div>
     <?php
     $singleFull = " ";
          } else {
         $singleFull = " ab_partFULL ";
     }
   ?>
        <div class="ab_part_r <?php echo $singleFull; ?>">

            <div class="contact01 <?php echo $coverheading2; ?>">


                <?php


                 if ($type_of_titles == "Style 2") {
                     $pageID = get_the_id();
                     $subsitle = get_post_meta($pageID, "post_subsitle", true);
                     $date = get_the_date();
                     $articleDate = date('F j, Y', strtotime(CFS()->get('article_date', $pageID)));
                     if ($articleDate == "" || $articleDate ==  "January 1, 1970") {
                         $articleDate = $date;
                     }

                     $issue_args = array("post_type" => "issue", "posts_per_page" => -1);
                     $issue_loop = new wp_query($issue_args);
                     $article_id_array = array();
                     while ($issue_loop->have_posts()):$issue_loop->the_post();

                     $issueListId =  get_the_id();
                     $sectionLoop = get_field('section_acf', $issueListId);
                     foreach ($sectionLoop as $sectionVal) {
                         $add_article = $sectionVal["add_article_acf"];
                         if (!empty($add_article)) {
                             foreach ($add_article as $articleValue) {
                                 if ($articleValue["article_link_2"][0] == $pageID) {
                                     $article_id_array[$issueListId][] = $articleValue["article_link_2"][0];
                                 }
                             }
                         }
                     }

                     endwhile;

                     if (!empty($article_id_array)) {
                         foreach ($article_id_array as $issue_key => $currentPost) {
                             $issue_keyID = $issue_key;
                         }
                     } ?>
<!-- COPIED fROM ABOVE-->
                <div class="postDate desktop_version">

                <b class="issue_title"><?php echo $issue_no; ?></b> |
                        <?php echo $articleDate; ?>
                </div>

                <h1>
                    <span>	<?php echo $subsitle; ?> </span>
                    <?php
                    wp_reset_postdata();
                     wp_reset_query();
                     echo get_the_title(); ?>
                </h1>

                <h6>
                    <?php
                     $post_authors = get_the_terms($pageID, 'authors');
                     $loopNum = 0;

                     if (is_array($post_authors)) { //ADDED


                         foreach ($post_authors as $post_author) {
                             $loopNum++;
                             $author_id = $post_author->term_id;
                             $author_link = get_term_link($post_author);
                             $author_name = $post_author->name;
                             $author_description = $post_author->description;

                             if ($loopNum == 1) {
                                 ?>
                              <a href="<?php echo $author_link; ?>"><?php echo $author_name; ?></a><?php
                             } else {
                                 ?>, <a href="<?php echo $author_link; ?>"><?php echo $author_name; ?></a><?php
                             }
                         }
                     } ?></h6>

                <?php
                 } else {
                     ?>

            <div class="com_heading">
                <?php
                    $pageID = get_the_id();
                     $subsitle = get_post_meta($pageID, "post_subsitle", true);

                     $date = get_the_date();
                     $articleDate = date('F j, Y', strtotime(CFS()->get('article_date', $pageID)));
                     if ($articleDate == "" || $articleDate ==  "January 1, 1970") {
                         $articleDate = $date;
                     }


                     $issue_args = array("post_type" => "issue", "posts_per_page" => -1);
                     $issue_loop = new wp_query($issue_args);
                     $article_id_array = array();
                     while ($issue_loop->have_posts()):$issue_loop->the_post();

                     $issueListId =  get_the_id();
                     $sectionLoop = get_field('section_acf', $issueListId);
                     foreach ($sectionLoop as $sectionVal) {
                         $add_article = $sectionVal["add_article_acf"];
                         if (is_array($add_article)) /*Check Array*/
        {
                       foreach ($add_article as $articleValue) {
                           if ($articleValue["article_link_2"][0] == $pageID) {
                               $article_id_array[$issueListId][] = $articleValue["article_link_2"][0];
                           }
                       }}
                     }

                     endwhile;

                     if (!empty($article_id_array)) {
                         foreach ($article_id_array as $issue_key => $currentPost) {
                             $issue_keyID = $issue_key;
                         }
                     } ?>
                <?php //this section is different for some reason in poems??>

                <div class="postDate desktop_version">
                    <b class="issue_title">
                        <?php echo $issue_no; ?>
                        </b>
                    <span class="single_article_pipe" style="color:#ccc;">|</span>
                    <?php echo $articleDate; ?>
                </div>
                <h3>
                    <b>
                  <?php
                    $home_pageID = 109;
                     $currenatPostID = get_the_id();
                     $featuredPosts = get_post_meta($home_pageID, "select_featured_posts", true);

                     if ($subsitle != "") {
                         if (in_array($currenatPostID, $featuredPosts)) {
                             $spanText =  "<span style='color: ".$colorPick."'> | </span>".$subsitle;
                         } else {
                             $spanText =  "<span> | </span>".$subsitle;
                         }
                     } ?>
                    <?php
                        wp_reset_postdata();
                     wp_reset_query();
                     echo get_the_title(); ?></b>​<?php echo $spanText; ?></h3>
            </div>

            <div class="article_editor" style="margin-top: 65px;">
                    <?php
                     $post_authors = get_the_terms($pageID, 'authors');
                     $loopNum = 0;
                     if (is_array($post_authors)) {
                         foreach ($post_authors as $post_author) {
                             $loopNum++;
                             $author_id = $post_author->term_id;

                             $author_link = get_term_link($post_author);
                             $author_name = $post_author->name;

                             $author_description = $post_author->description;

                             if ($loopNum == 1) {
                                 ?><a href="<?php echo $author_link; ?>"><?php echo $author_name; ?></a><?php
                             } else {
                                 ?>, <a href="<?php echo $author_link; ?>"><?php echo $author_name; ?></a><?php
                             }
                         }
                     } ?>
            </div>

    <?php
                 } ?>

            </div>
        </div>
    </div>
</div>
</section>

    <section class="mission_outer">
        <div class="container-fluid">
            <div class="mission">
                <div class="mission_inner">
                    <div class="mission_inner_body">
                        <?php
                        while (have_posts()):the_post();
                            the_content();
                        endwhile;
                        ?>
                    </div>
                </div>

                <?php if( have_rows('corrections') ): ?>
                    <div class="mission_inner">
                        <?php
                        $loopNum = 0;
                        while ( have_rows('corrections') ) : the_row();
                            $loopNum++;
                            $correction_text = get_sub_field('correction');
                            $correction_anchor = "correction" . $loopNum;?>
                            <?php echo $correction_text;?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                 <?php
                 wp_reset_postdata();
                 wp_reset_query();
                  $pageID = get_the_id();
                     $post_authors = get_the_terms($pageID, 'authors');
                      $loopNum = 0;
                if (is_array($post_authors)) {
                    foreach ($post_authors as $post_author) {
                        $loopNum++;
                        $author_id = $post_author->term_id;

                        $author_link = get_term_link($post_author);
                        $author_name = $post_author->name;
                        $author_description = $post_author->description;

                        if ($loopNum == 1) {
                            $author_description = $post_author->description;
                        } else {
                            $author_description = " "; //ADDED
                        }
                    }
                }

                     $about_editor = get_post_meta($pageID, "about_editor", true);

                ?>
                    <div class="article_editor">
                        <?php
                          // echo $about_editor;
                        ?>
                        <?php  echo wpautop($author_description); ?>
                    </div>
                <?php


                $share_text = get_post_meta($pageID, "share_text", true);
                if ($share_text != "") {
                    ?>
                    <div class="share_text_container">
                      <!--<h5>Share</h5>-->
                    <div class="share_text">
                          <?php if (function_exists('ADDTOANY_SHARE_SAVE_KIT')) {
                        ADDTOANY_SHARE_SAVE_KIT(array(
        'buttons' => array( 'facebook', 'twitter', 'email' ),
    ));
                    } ?>
                        <?php echo 	$share_text; ?>
                      </div>
                    </div>
                    <?php
                }
                ?>

            </div>

<div class="more_from_issue">
    <?php

$issue_args = array("post_type" => "issue", "posts_per_page" => -1);
$issue_loop = new wp_query($issue_args);
$article_id_array = array();
while ($issue_loop->have_posts()):$issue_loop->the_post();

    $issueListId =  get_the_id();
    $sectionLoop = get_field('section_acf', $issueListId);
    foreach ($sectionLoop as $sectionVal) {
        $add_article = $sectionVal["add_article_acf"];
        if (!empty($add_article)) {
            foreach ($add_article as $articleValue) {
                $article_id_array[$issueListId][] = $articleValue["article_link_2"][0];
            }
        }
    }

endwhile;
/*

echo "<pre>";
  print_r($article_id_array);
echo "</pre>";
*/

      $more_issues_heading = get_post_meta($pageID, "more_issues_heading", true);
      if ($more_issues_heading != "") {
          ?>
    <h1><span class="more_heading_pipe">l</span> <?php echo $more_issues_heading; ?></h1>
<?php
      } ?>
<?php
$select_issues = get_post_meta($pageID, "select_issues", true);
$issueID_Array = array();
 if (is_array($select_issues)) {
     foreach ($select_issues as $select_issue) {
         $issueID = $select_issue;
         $issueID_Array[] = $issueID;
         $issue_permalink = get_the_permalink($issueID);
         $article_editor_name = get_post_meta($issueID, "article_editor_name", true);


         $post_authors = get_the_terms($issueID, 'authors');
         $loopNum = 0;
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




         $post_subsitle = get_post_meta($issueID, "post_subsitle", true);
         $post_sitle = get_the_title($issueID);
         $issueImageID = get_post_thumbnail_id($issueID); ?>
    <div class="com_heading01">
        <?php
          if ($issueImageID != "") {
              $moreIssueFull_Class = " ";
              $issueImageImageURL = wp_get_attachment_image_src($issueImageID, "full");
              $issueImageImageURL = $issueImageImageURL[0]; ?>
            <div class="moreissue_left">
            <a href="<?php echo $issue_permalink; ?>">
              <img src="<?php echo $issueImageImageURL; ?>">
            </a>
            </div>
        <?php
          } else {
              $moreIssueFull_Class = " moreIssueFull ";
          } ?>


        <div class="moreissue_right <?php echo $moreIssueFull_Class . ' postid-' . $issueID; ?>">
            <h4>
                <b><a href="<?php echo $issue_permalink; ?>"><?php echo $post_sitle; ?></a></b>​ <?php if ($post_subsitle != "") {?><span class="singleArtiIssue_pipe"> |</span><a href="<?php echo $issue_permalink; ?>" class="mr-subtitle"><?php echo $post_subsitle; ?></a><?php } ?>
            </h4>
            <?php if ($article_editor_name!= "") {?>
                <p><a href="<?php echo $issue_permalink; ?>" class="moreAuhor"><?php echo $article_editor_name; ?></a></p>
            <?php } ?>
            <!-- <div class="text-treview"><?php  // echo  wp_trim_words( get_the_content(), 35, '...' );?></div>		 -->
        </div>
    </div>
<?php
     }
 } ?>

</div>


        </div>
    </section>


<?php
    get_footer();
