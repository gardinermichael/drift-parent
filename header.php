<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php
$pageID = get_the_id();
wp_head();
?>
</head>

<body <?php echo body_class(); ?>>
    <div class="page-container">
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