<?php
/* Template name: Issues page */
get_header();
?>

<?php
$issue_args = [
    "post_type" => "issue",
    "order" => "DESC",
    "orderby" => "date",
    "posts_per_page" => -1
];
$issue_loop = new wp_query($issue_args);

while ($issue_loop->have_posts()):$issue_loop->the_post();

  $pageID = get_the_id();
  $bannerImageID = get_post_thumbnail_id($pageID);
  if ($bannerImageID != "") {
      list($bannerImageURL, $banner_width, $banner_height) = wp_get_attachment_image_src($bannerImageID, "full");
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
  <img src="<?php echo $bannerImageURL; ?>" width="<?php echo $banner_width; ?>" height="<?php echo $banner_height; ?>">
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
   <h1 class="issue_heading"><b><?php echo get_the_title(); ?></b> <br/> <?php if ($current_issue_subtitle != "") {?><span>|</span> <?php echo $articleDate; } ?>
   </h1>
      
<?php

$sectionLoop = get_field('section_acf');
if (is_array($sectionLoop)) /* Check Array */
{ 
    foreach ($sectionLoop as $sectionVal)
    {
        $section_name = $sectionVal["section_name_acf"];
        $add_article = $sectionVal["add_article_acf"];
        $colorPick = get_post_meta($pageID, "color_for_current_issue", true); ?>
    <div class="issue_container">		  	
        <div class="cus_post_hea">
            <h6 style=" <?php if ($colorPick != "") {?>color:  <?php echo $colorPick; } ?>"><?php echo $section_name; ?></h6>
        </div>

        <?php
        $loopNum = 0;
        if (is_array($add_article)) /*Check Array*/
        {
            foreach ($add_article as $articleValue) {
                $loopNum_test++;
                //$issueid = $articleValue["article_link_acf"]->ID;
                $articleID = $articleValue["article_link_2"][0];
                $articlePermalink = get_the_permalink($articleID);
                $issueTitle = get_the_title($articleID); ?>
                <style type="text/css">
                    .issue_container .com_heading01#id_<?php echo $loopNum_test; ?>  a:hover b{ color: <?php echo $colorPick; ?>; }
                </style>
                    <div class="com_heading01" id="id_<?php echo $loopNum_test; ?>">
                        <h4>
                            <a href="<?php echo $articlePermalink; ?>">
                                <b><?php echo $articleValue["title_acf"]; ?></b>​<span class="issues_pipe" style=" <?php if ($colorPick != "") {?>color:  <?php echo $colorPick; } ?>"> | </span><?php echo $articleValue["subtitle_acf"]; ?>
                            </a>
                        </h4>

                <?php
                $post_authors = get_the_terms($articleID, 'authors');
                //print_r($post_authors);
                $loopNum = 0;
                if (is_array($post_authors)) {?>
                    <div class="authors">
                        <?php
                        foreach ($post_authors as $post_author) {
                            $loopNum++;
                            $author_id = $post_author->term_id;

                            $author_link = get_term_link($post_author);
                            $author_name = $post_author->name;
                            $author_description = $post_author->description;

                            if ($loopNum == 1)
                            {
                                ?><a href="<?php echo $articlePermalink; ?>"><?php echo $author_name; ?></a><?php
                            } else
                                {
                                    ?><a href="<?php echo $articlePermalink; ?>"><?php echo $author_name; ?></a><?php
                                }
                            }
                    ?></div><?php
                }?>
                </div><?php
                } } ?>
                </div>
            <?php
            }
} ?>

<?php
$mentionIDs = get_post_meta($pageID, "select_mentions_acf", true);
?>


    <div class="com_heading01">  
        <?php
            if (is_array($mentionIDs)) /*Check Array*/
             {
          foreach ($mentionIDs as $mentionID) {
              ?>
        <style type="text/css">
            .com_heading01 h4#mention_<?php echo $mentionID; ?>   a:hover b{ color: <?php echo $colorPick; ?>; }			
            .com_heading01 h4#mention_<?php echo $mentionID; ?>   a:hover{ color: #303030; ?>; }			
        </style>
        <h6 class="cus_post_hea" style="padding-top: 40px; margin-bottom: 20px; font-family: proxy-nova; font-size: 17px; font-weight: 700; color:<?php echo $colorPick; ?>">MENTIONS</h6>
          <h4 id="mention_<?php echo $mentionID; ?>"><a href="<?php echo get_the_permalink($mentionID); ?>"><b >Extremely Abbreviated Reviews</b>​</a> <span style="color:<?php echo $colorPick; ?>">|</span> <a href="<?php echo get_the_permalink($mentionID); ?>"><?php echo get_the_title($mentionID); ?></a> </h4>
        <?php
          } }
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