<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

</head>

<body <?php echo body_class(); ?>>
    <div class="page-container">

<style type="text/css">
#mc_embed_signup .mc-field-group input#mce-EMAIL {
    color: #303030;
}

.mce_inline_error {
    font-family: proxy-nova;
}

.com_heading h3 b {
    font-weight: 600;
  }

.cus_post_outer .container,
.bredcrum01 .container {
    max-width: 900px;
}

@media (max-width: 1023px) {
    .td-site-mobile-header {
        display: block !important;
    }
}

@media print {
    .hed-wrap,
    .td-site-mobile-header,
    .more_from_issue,
    .footer_style_new,
    .footerFullMenu {
        display: none;
    }

    .td-site-mobile-header,
    .container.no-print {
        display: none !important;
        height: 1px !important;
    }

    .no-print .td-mobile-logo,
    .no-print .td-mobile-menus {
        display: none !important;
    }

    section.mission_outer {
        margin-bottom: 6rem;
    }

    .mission_outer > .container-fluid {
        padding-bottom: 10rem;
    }
}
</style>

<?php
$pageID = get_the_id();
?>

<div class="site_container">
    <div class="content-wrap">
        <header class="hed-wrap">
            <div class="desktop_new_menu">
                <div class="desktop-logo">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_theme_file_uri() . '/assets/images/drift_logo_large_2x.png'; ?>" type="image/png" alt="The Drift Magazine" width="272" height="130">
                    </a>
                </div>
                <?php
                wp_nav_menu(array("menu" => "Navigation Menu", "menu_id" => "navigation_menu", ""));
                ?>
                <div class="drift_searchForm">
                    <?php echo get_search_form();?>
                </div>
            </div>
        </header>
        <header class="td-site-mobile-header-blocking-box hidden">
        </header>
        <header class="td-site-mobile-header" style="display: none;">
            <div class="container no-print">
                <div class="td-mobile-logo">
                    <a href="<?php echo home_url(); ?>">
                        <img
                        src="<?php echo get_theme_file_uri() . '/assets/images/drift_logo_mobile_2x.png'; ?>"
                        type="image/png"
                        alt="The Drift Magazine"
                        width="209"
                        height="100">
                    </a>
                </div>
                <div class="td-mobile-menus">
                    <div class="seach-mobile-view">
                        <a href="javascript:void(0);"><i class="fa fa-search"></i></a>
                    </div>
                    <span onclick="openMobileNav()" class="openMobMenuIcon">&#9776;</span>
                </div>
                <div class="drift_searchForm" style="display: none;"><?php echo get_search_form();?></div>
                <div id="myMobileNav" class="td-overlay-box">
                    <div class="td-overlay-content">
                        <?php
                        wp_nav_menu(array('menu' => 'Mobile Menu',));
                        ?>
                    </div>
                </div>
            </div>
        </header>