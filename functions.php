<?php

/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
     * If you're building a theme based on Twenty Seventeen, use a find and replace
     * to change 'twentyseventeen' to the name of your theme in all the template files.
     */
    load_theme_textdomain('twentyseventeen');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    add_image_size('main-image-on-single', 1400, 933);
    add_image_size('twitter-card-sized', 1400, 733, true);

    add_image_size('twentyseventeen-featured-image', 2000, 1200, true);
    add_image_size('issue_backgroun_image', 1400, 200, true);

    add_image_size( 'main-image-on-single', 1400, 933 );
    add_image_size('twitter-card-sized', 1400, 733, true);

    add_image_size('twentyseventeen-thumbnail-avatar', 100, 100, true);

    // Set the default content width.
    $GLOBALS['content_width'] = 525;

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'top'    => __('Top Menu', 'twentyseventeen'),
            'social' => __('Social Links Menu', 'twentyseventeen'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
        )
    );

    /*
     * Enable support for Post Formats.
     *
     * See: https://wordpress.org/support/article/post-formats/
     */
    add_theme_support(
        'post-formats',
        array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio',
        )
    );

    // Add theme support for Custom Logo.
    add_theme_support(
        'custom-logo',
        array(
            'width'      => 250,
            'height'     => 250,
            'flex-width' => true,
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
      */
    add_editor_style(array('assets/css/editor-style.css', twentyseventeen_fonts_url()));

    // Load regular editor styles into the new block-based editor.
    add_theme_support('editor-styles');

    // Load default block styles.
    add_theme_support('wp-block-styles');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Define and register starter content to showcase the theme on new sites.
    $starter_content = array(
        'widgets'     => array(
            // Place three core-defined widgets in the sidebar area.
            'sidebar-1' => array(
                'text_business_info',
                'search',
                'text_about',
            ),

            // Add the core-defined business info widget to the footer 1 area.
            'sidebar-2' => array(
                'text_business_info',
            ),

            // Put two core-defined widgets in the footer 2 area.
            'sidebar-3' => array(
                'text_about',
                'search',
            ),
        ),

        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts'       => array(
            'home',
            'about'            => array(
                'thumbnail' => '{{image-sandwich}}',
            ),
            'contact'          => array(
                'thumbnail' => '{{image-espresso}}',
            ),
            'blog'             => array(
                'thumbnail' => '{{image-coffee}}',
            ),
            'homepage-section' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
        ),

        // Create the custom image attachments used as post thumbnails for pages.
        'attachments' => array(
            'image-espresso' => array(
                'post_title' => _x('Espresso', 'Theme starter content', 'twentyseventeen'),
                'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
            ),
            'image-sandwich' => array(
                'post_title' => _x('Sandwich', 'Theme starter content', 'twentyseventeen'),
                'file'       => 'assets/images/sandwich.jpg',
            ),
            'image-coffee'   => array(
                'post_title' => _x('Coffee', 'Theme starter content', 'twentyseventeen'),
                'file'       => 'assets/images/coffee.jpg',
            ),
        ),

        // Default to a static front page and assign the front and posts pages.
        'options'     => array(
            'show_on_front'  => 'page',
            'page_on_front'  => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),

        // Set the front page section theme mods to the IDs of the core-registered pages.
        'theme_mods'  => array(
            'panel_1' => '{{homepage-section}}',
            'panel_2' => '{{about}}',
            'panel_3' => '{{blog}}',
            'panel_4' => '{{contact}}',
        ),

        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus'   => array(
            // Assign a menu to the "top" location.
            'top'    => array(
                'name'  => __('Top Menu', 'twentyseventeen'),
                'items' => array(
                    'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                    'page_about',
                    'page_blog',
                    'page_contact',
                ),
            ),

            // Assign a menu to the "social" location.
            'social' => array(
                'name'  => __('Social Links Menu', 'twentyseventeen'),
                'items' => array(
                    'link_yelp',
                    'link_facebook',
                    'link_twitter',
                    'link_instagram',
                    'link_email',
                ),
            ),
        ),
    );

    /**
     * Filters Twenty Seventeen array of starter content.
     *
     * @since Twenty Seventeen 1.1
     *
     * @param array $starter_content Array of starter content.
     */
    $starter_content = apply_filters('twentyseventeen_starter_content', $starter_content);

    add_theme_support('starter-content', $starter_content);
}
add_action('after_setup_theme', 'twentyseventeen_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width()
{
    $content_width = $GLOBALS['content_width'];

    // Get layout.
    $page_layout = get_theme_mod('page_layout');

    // Check if layout is one column.
    if ('one-column' === $page_layout) {
        if (twentyseventeen_is_frontpage()) {
            $content_width = 644;
        } elseif (is_page()) {
            $content_width = 740;
        }
    }

    // Check if is single post and there is no sidebar.
    if (is_single() && !is_active_sidebar('sidebar-1')) {
        $content_width = 740;
    }

    /**
     * Filter Twenty Seventeen content width of the theme.
     *
     * @since Twenty Seventeen 1.0
     *
     * @param int $content_width Content width in pixels.
     */
    $GLOBALS['content_width'] = apply_filters('twentyseventeen_content_width', $content_width);
}
add_action('template_redirect', 'twentyseventeen_content_width', 0);

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints($urls, $relation_type)
{
    if (wp_style_is('twentyseventeen-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Blog Sidebar', 'twentyseventeen'),
            'id'            => 'sidebar-1',
            'description'   => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Footer 1', 'twentyseventeen'),
            'id'            => 'sidebar-2',
            'description'   => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Footer 2', 'twentyseventeen'),
            'id'            => 'sidebar-3',
            'description'   => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'twentyseventeen_widgets_init');

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more($link)
{
    if (is_admin()) {
        return $link;
    }

    $link = sprintf(
        '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
        esc_url(get_permalink(get_the_ID())),
        /* translators: %s: Post title. */
        sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen'), get_the_title(get_the_ID()))
    );
    return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'twentyseventeen_excerpt_more');

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection()
{
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'twentyseventeen_javascript_detection', 0);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'twentyseventeen_pingback_header');

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap()
{
    if ('custom' !== get_theme_mod('colorscheme') && !is_customize_preview()) {
        return;
    }

    require_once get_parent_theme_file_path('/inc/color-patterns.php');
    $hue = absint(get_theme_mod('colorscheme_hue', 250));

    $customize_preview_data_hue = '';
    if (is_customize_preview()) {
        $customize_preview_data_hue = 'data-hue="' . $hue . '"';
    } ?>
    <style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
        <?php echo twentyseventeen_custom_colors_css(); ?>
    </style>
<?php
}
add_action('wp_head', 'twentyseventeen_colors_css_wrap');

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url()
{

    $font_families = array();

    $font_families[] = 'Libre+Franklin:wght@100;300;700';
    $font_families[] = 'Lusitana:wght@400;700';
    $font_families[] = 'Montserrat:wght@100;300';
    $font_families[] = 'Raleway:wght@100;300';
    $font_families[] = 'Open+Sans:wght@300;400;700';
    $font_families[] = 'Libre+Baskerville:wght@400;700';
    $font_families[] = 'Roboto:wght@100';

    $query_args = array(
        'family'  => implode('&family=', $font_families),
        'display' => 'swap',
    );

    $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css2');

    return esc_url_raw($fonts_url);
}

add_filter( 'deferred_stylesheets', function( $handles ) {
    $handles[] = 'fonts';
    return $handles;
}, 10, 1 );

function add_onload_to_defered_sheet($html, $handle) {
    $deferred = apply_filters('deferred_stylesheets', array());
    if ( in_array($handle, $deferred) ) {
        $html = str_replace("/>", 'onload="this.media=\'all\'"/>', $html);
    }
    return $html;
}

add_filter('style_loader_tag', 'add_onload_to_defered_sheet', 10, 2);

/**
 * Enqueues scripts and styles.
 */
function twentyseventeen_scripts()
{

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('drift-fonts', twentyseventeen_fonts_url(), array(), time());

    // Theme stylesheet.
    wp_enqueue_style('twentyseventeen-style', get_stylesheet_uri(), array(), '20190507');

    // Theme block stylesheet.
    wp_enqueue_style('twentyseventeen-block-style', get_theme_file_uri('/assets/css/blocks.css'), array('twentyseventeen-style'), '20190105');

    $drift_all_style_path = get_theme_file_path('/assets/css/all.min.css');
    wp_enqueue_style('drift-all-style', get_theme_file_uri('/assets/css/all.min.css'), array(), filemtime($drift_all_style_path));
    $aos_style_path = get_theme_file_path('/assets/css/aos.css');
    wp_enqueue_style('aos-style', get_theme_file_uri('/assets/css/aos.css'), array(), filemtime($aos_style_path));
    $bootstrap_style_path = get_theme_file_path('/assets/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-style', get_theme_file_uri('/assets/css/bootstrap.min.css'), array(), filemtime($bootstrap_style_path));
    $drift_custom_path = get_theme_file_path('/assets/css/custom-updated.css');
    wp_enqueue_style('drift', get_theme_file_uri('/assets/css/custom-updated.css'), array('bootstrap-style'), filemtime($drift_custom_path));
    $fonts_path = get_theme_file_path('/assets/css/fonts.css');
    wp_enqueue_style('fonts', get_theme_file_uri('/assets/css/fonts.css'), array('bootstrap-style'), filemtime($fonts_path), 'print');


    // Load subscribe css for bundle
    if (is_page_template(array('page-templates/mixed_subscribe.php', 'page-templates/bundle_subscribe.php'))) {
        $bundle_style_path = get_theme_file_path('/assets/css/bundle.css');
        wp_enqueue_style('bundle-style', get_theme_file_uri('/assets/css/bundle.css'), array(), filemtime($bundle_style_path));
    }
    if (is_front_page()) {
        // Load owl carousel stylesheet for homepage
        $owl_style_path = get_theme_file_path('/assets/css/owl.carousel.min.css');
        wp_enqueue_style('owl-style', get_theme_file_uri('/assets/css/owl.carousel.min.css'), array(), filemtime($owl_style_path));

        // Load front page specific css
        $home_style_path = get_theme_file_path('/assets/css/home.css');
        wp_enqueue_style('home-style', get_theme_file_uri('/assets/css/home.css'), array(), filemtime($home_style_path));
    }

    // Load the stylesheet for single articles
    if (is_single()) {
        $single_style_path = get_theme_file_path('/assets/css/single.css');
        wp_enqueue_style('single-style', get_theme_file_uri('/assets/css/single.css'), array(), filemtime($single_style_path));
    }

    // Load issue stylesheet for issues plural or singular
    if (get_current_template() == 'issues.php' | is_singular('issue')) {
        $issues_style_path = get_theme_file_path('/assets/css/issue.css');
        wp_enqueue_style('issue-style', get_theme_file_uri('/assets/css/issue.css'), array(), filemtime($issues_style_path));
    }

    // Load the dark colorscheme.
    if ('dark' === get_theme_mod('colorscheme', 'light') || is_customize_preview()) {
        wp_enqueue_style('twentyseventeen-colors-dark', get_theme_file_uri('/assets/css/colors-dark.css'), array('twentyseventeen-style'), '20190408');
    }

    // Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
    if (is_customize_preview()) {
        wp_enqueue_style('twentyseventeen-ie9', get_theme_file_uri('/assets/css/ie9.css'), array('twentyseventeen-style'), '20161202');
        wp_style_add_data('twentyseventeen-ie9', 'conditional', 'IE 9');
    }

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style('twentyseventeen-ie8', get_theme_file_uri('/assets/css/ie8.css'), array('twentyseventeen-style'), '20161202');
    wp_style_add_data('twentyseventeen-ie8', 'conditional', 'lt IE 9');

    // Load the html5 shiv.
    wp_enqueue_script('html5', get_theme_file_uri('/assets/js/html5.js'), array(), '20161020');
    wp_script_add_data('html5', 'conditional', 'lt IE 9');

    wp_enqueue_script('twentyseventeen-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js'), array(), '20161114', true);

    $twentyseventeen_l10n = array(
        'quote' => twentyseventeen_get_svg(array('icon' => 'quote-right')),
    );

    if (has_nav_menu('top')) {
        wp_enqueue_script('twentyseventeen-navigation', get_theme_file_uri('/assets/js/navigation.js'), array('jquery'), '20161203', true);
        $twentyseventeen_l10n['expand']   = __('Expand child menu', 'twentyseventeen');
        $twentyseventeen_l10n['collapse'] = __('Collapse child menu', 'twentyseventeen');
        $twentyseventeen_l10n['icon']     = twentyseventeen_get_svg(
            array(
                'icon'     => 'angle-down',
                'fallback' => true,
            )
        );
    }

    /*wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '20190121', true );*/

    wp_enqueue_script('jquery-scrollto', get_theme_file_uri('/assets/js/jquery.scrollTo.js'), array('jquery'), '2.1.2', true);

    wp_localize_script('twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('bootstrap-script', get_theme_file_uri('/assets/js/bootstrap.min.js'), array('jquery'), '2.3.1', true);
    wp_enqueue_script('aos-script', get_theme_file_uri('/assets/js/aos.js'), array(), '2.3.1', true);
    wp_enqueue_script('aos-config-script', get_theme_file_uri('/assets/js/aos-config.js'), array('aos-script'), '2.3.1', true);
    wp_enqueue_script('imagesloaded-script', get_theme_file_uri('/assets/js/imagesloaded.pkgd.js'), array('jquery'), '2.3.1', true);
    $custom_js_path = get_theme_file_path('/assets/js/custom-js.js');
    wp_enqueue_script('custom-script', get_theme_file_uri('/assets/js/custom-js.js'), array('jquery'), filemtime($custom_js_path), true);

    // owl carousel script for the homepage
    if (is_front_page()) {
        wp_enqueue_script('owl-script', get_theme_file_uri('/assets/js/owl.carousel.min.js'), array('jquery'), '2.3.1', true);
        wp_enqueue_script('carousel-script', get_theme_file_uri('/assets/js/carousel.js'), array('jquery'), '2.3.1', true);
        // hand the template URL to carousel so it knows where to find chevron images
        $template_url = get_bloginfo('template_url');
        wp_localize_script('carousel-script', 'template_url', $template_url);
    }

    global $post;
    if (is_a($post, 'WP_Post') && (is_page_template(array('page-templates/mixed_subscribe.php', 'page-templates/subscribe.php', 'page-templates/donate.php', 'page-templates/subscribe_template.php')) || has_shortcode($post->content, 'fullstripe_form'))) {
        wp_enqueue_script('fullstripe-custom-script', get_theme_file_uri('/assets/js/wpfs-script.js'), array('jquery'), '2.3.2', true);
    }
}
add_action('wp_enqueue_scripts', 'twentyseventeen_scripts');

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function twentyseventeen_block_editor_styles()
{
    // Block styles.
    wp_enqueue_style('twentyseventeen-block-editor-style', get_theme_file_uri('/assets/css/editor-blocks.css'), array(), '20190328');
    // Add custom fonts.
    wp_enqueue_style('twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null);
}
add_action('enqueue_block_editor_assets', 'twentyseventeen_block_editor_styles');

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr($sizes, $size)
{
    $width = $size[0];

    if (740 <= $width) {
        $sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
    }

    if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
        if (!(is_page() && 'one-column' === get_theme_mod('page_options')) && 767 <= $width) {
            $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
        }
    }

    return $sizes;
}
add_filter('wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2);

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag($html, $header, $attr)
{
    if (isset($attr['sizes'])) {
        $html = str_replace($attr['sizes'], '100vw', $html);
    }
    return $html;
}
add_filter('get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
    if (is_archive() || is_search() || is_home()) {
        $attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3);

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template($template)
{
    return is_home() ? '' : $template;
}
add_filter('frontpage_template', 'twentyseventeen_front_page_template');

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args($args)
{
    $args['largest']  = 1;
    $args['smallest'] = 1;
    $args['unit']     = 'em';
    $args['format']   = 'list';

    return $args;
}
add_filter('widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args');

/**
 * Get unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Twenty Seventeen 2.0
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @staticvar int $id_counter
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function twentyseventeen_unique_id($prefix = '')
{
    static $id_counter = 0;
    if (function_exists('wp_unique_id')) {
        return wp_unique_id($prefix);
    }
    return $prefix . (string) ++$id_counter;
}

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path('/inc/custom-header.php');

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 * Customizer additions.
 */
require get_parent_theme_file_path('/inc/customizer.php');

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');

require_once get_template_directory() . '/redux/sample-config.php';
require_once get_template_directory() . '/post_type.php';


//hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_topics_hierarchical_taxonomy', 0);

//create a custom taxonomy name it topics for your posts

function create_topics_hierarchical_taxonomy()
{

    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI

    $labels = array(
        'name' => _x('Authors', 'taxonomy general name'),
        'singular_name' => _x('Author', 'taxonomy singular name'),
        'search_items' =>  __('Search Authors'),
        'all_items' => __('All Authors'),
        'parent_item' => __('Parent Author'),
        'parent_item_colon' => __('Parent Author:'),
        'edit_item' => __('Edit Author'),
        'update_item' => __('Update Author'),
        'add_new_item' => __('Add New Author'),
        'new_item_name' => __('New Author Name'),
        'menu_name' => __('Authors'),
    );

    // Now register the taxonomy

    register_taxonomy('authors', array('post'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'article_author'),
    ));
}

/*404 Page redirect to HOMEPAGE code STARTS here */
if (!function_exists('redirect_404_to_homepage')) {
    add_action('template_redirect', 'redirect_404_to_homepage');

    function redirect_404_to_homepage()
    {
        if (!is_404()) {
            return;
        }

        // Never redirect the bare homepage to itself: if the front page
        // resolves to a 404 (e.g. stale rewrite rules after a deploy),
        // redirecting / -> / loops forever (ERR_TOO_MANY_REDIRECTS). Only skip
        // the true / case — a 404 like /?p=999 can still be redirected to a
        // clean /, since dropping the query string makes the target differ from
        // the request (so it can't loop).
        $home_path = trim((string) wp_parse_url(home_url('/'), PHP_URL_PATH), '/');
        $request_uri = $_SERVER['REQUEST_URI'] ?? '/';
        $request_path = trim((string) wp_parse_url($request_uri, PHP_URL_PATH), '/');
        $request_query = (string) wp_parse_url($request_uri, PHP_URL_QUERY);
        if ($request_path === $home_path && $request_query === '') {
            return;
        }

        wp_safe_redirect(home_url('/'));
        exit;
    }
}

/**
 * Redirect to the homepage all users trying to access feeds STARTS HERE .
 */
function disable_feeds()
{
    wp_redirect(home_url());
    die;
}

// Disable global RSS, RDF & Atom feeds.
// add_action( 'do_feed',      'disable_feeds', -1 );
// add_action( 'do_feed_rdf',  'disable_feeds', -1 );
// add_action( 'do_feed_rss',  'disable_feeds', -1 );
// add_action( 'do_feed_rss2', 'disable_feeds', -1 );
// add_action( 'do_feed_atom', 'disable_feeds', -1 );

// Disable comment feeds.
add_action('do_feed_rss2_comments', 'disable_feeds', -1);
add_action('do_feed_atom_comments', 'disable_feeds', -1);

// Prevent feed links from being inserted in the <head> of the page.
add_action('feed_links_show_posts_feed', '__return_false', -1);
add_action('feed_links_show_comments_feed', '__return_false', -1);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

/* * Redirect to the homepage all users trying to access feeds ENDS HERE . */



/* Redirecting URL */
function redirect_page()
{
    if (
        isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
    ) {
        $protocol = 'https://';
    } else {
        $protocol = 'http://';
    }

    $currenturl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $currenturl_relative = wp_make_link_relative($currenturl);

    switch ($currenturl_relative) {

        case '/author/rpanovka/':
            $urlto = home_url('/');
            break;

        default:
            return;
    }

    if ($currenturl != $urlto) {
        exit(wp_redirect($urlto));
    }
}
add_action('template_redirect', 'redirect_page');

/* Redirect from author page ends here*/

/* Remove WP-JSON api STARTS HERE . */
function remove_json_api()
{

    // Remove the REST API lines from the HTML Header
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    add_filter('embed_oembed_discover', '__return_false');

    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('after_setup_theme', 'remove_json_api');

/* Remove WP-JSON api ENDS HERE . */

add_action("authors_edit_form_fields", 'add_form_fields_example', 10, 2);

function add_form_fields_example($term, $taxonomy)
{
    $content = html_entity_decode($term->description);
    ?>
    <tr valign="top" class="form-field term-description-wrap drift-author-bio-wrap">
        <th scope="row">
            <label for="drift_author_bio_editor">Author Bio</label>
        </th>
        <td>
            <?php
            wp_editor($content, 'drift_author_bio_editor', array(
                'textarea_name' => 'description',
                'media_buttons' => false,
                'textarea_rows' => 12,
                'teeny'         => false,
                'quicktags'     => true,
                'tinymce'       => array(
                    'wpautop'       => true,
                    'forced_root_block' => 'p',
                ),
            ));
            ?>
        </td>
    </tr>
    <?php
}

add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
add_action('login_enqueue_scripts', 'ds_admin_theme_style');
function ds_admin_theme_style()
{
    if (!current_user_can('manage_options')) {
        echo '<style>
           .update-nag, .updated, .error, .is-dismissible { display: none !important; }

        </style>';
    }
}

function pw_load_scripts()
{
    wp_enqueue_script('custom-js', '/wp-content/themes/drift/admin-scripts.js');
}
add_action('admin_enqueue_scripts', 'pw_load_scripts');

function set_paywall_cookie()
{
    $cookie_name = "dpp_stripeaccount_137";
    $cookie_value = "true";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 180), "/"); // 86400 = 1 day
}

add_action('fullstripe_after_subscription_charge', 'set_paywall_cookie', 10, 2);


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts()
{
    echo '<style>
    .taxonomy-authors .form-field.term-slug-wrap,
    .taxonomy-authors .form-field.term-parent-wrap,
    .taxonomy-authors .term-row-head,
    .taxonomy-authors .terms-tfp-wrap {
        display: none !important;
    }

    /* Hide only the default WP description row, not our custom editor row */
    .taxonomy-authors .form-field.term-description-wrap:not(.drift-author-bio-wrap) {
        display: none !important;
    }
    </style>';
}

// Extend front-end search beyond post title/excerpt/body, which is all core
// matches. A post also matches when the search string matches:
//   - one of its 'authors', tag, or category term names
//   - its subtitle ('post_subsitle' meta)
//   - the name of a translator credited on it ('_translator_term_id' meta)
add_filter('posts_search', 'drift_extend_search_matches', 10, 2);

function drift_extend_search_matches($search, $query)
{
    global $wpdb;

    if (is_admin() || !$query->is_main_query() || !$query->is_search() || $search === '') {
        return $search;
    }

    $search_string = trim((string) $query->get('s'));
    if ($search_string === '') {
        return $search;
    }

    $like = '%' . $wpdb->esc_like($search_string) . '%';

    $term_match = $wpdb->prepare(
        "EXISTS (
            SELECT 1
            FROM {$wpdb->term_relationships} drift_tr
            INNER JOIN {$wpdb->term_taxonomy} drift_tt ON drift_tr.term_taxonomy_id = drift_tt.term_taxonomy_id
            INNER JOIN {$wpdb->terms} drift_t ON drift_tt.term_id = drift_t.term_id
            WHERE drift_tr.object_id = {$wpdb->posts}.ID
              AND drift_tt.taxonomy IN ('post_tag', 'category')
              AND drift_t.name LIKE %s
        )",
        $like
    );

    $subtitle_match = $wpdb->prepare(
        "EXISTS (
            SELECT 1
            FROM {$wpdb->postmeta} drift_sm
            WHERE drift_sm.post_id = {$wpdb->posts}.ID
              AND drift_sm.meta_key = 'post_subsitle'
              AND drift_sm.meta_value LIKE %s
        )",
        $like
    );

    $extra_match = drift_search_byline_match_sql($search_string) . ' OR ' . $term_match . ' OR ' . $subtitle_match;

    // Core builds this clause as " AND (<keyword conditions>) AND (post_password = '')".
    // Inject the extra matches as ORs inside the first group so the password
    // and status constraints still apply to posts they match.
    $extended = preg_replace_callback(
        '/^(\s*AND\s*)\(/',
        function ($matches) use ($extra_match) {
            return $matches[1] . '(' . $extra_match . ' OR ';
        },
        $search,
        1,
        $count
    );

    return ($count === 1 && $extended !== null) ? $extended : $search;
}

// Escape characters that carry special meaning in a MySQL REGEXP pattern so a
// search string is matched literally. Backslashes here survive $wpdb->prepare:
// it doubles them in the SQL literal and MySQL collapses them back on parse.
function drift_search_regexp_quote($string)
{
    return preg_replace('/[.\\\\+*?()\[\]{}^$|]/', '\\\\$0', $string);
}

// SQL condition matching posts the searched person is credited on, either as
// an 'authors' term or as a translator. Used both to widen the search and to
// rank those posts above ones that merely mention the name in the body.
function drift_search_byline_match_sql($search_string)
{
    global $wpdb;

    // Match the credited name with the same word-boundary semantics as the
    // contributor box in search.php, so a query like "test" boosts a name
    // such as "Test ..." but not "Latest ...". REGEXP keeps the SQL filter
    // in step with the PHP-side check (MySQL 8 supports \b in REGEXP). Only
    // anchor the boundary when the query itself starts with a word character.
    $boundary = preg_match('/^\w/u', $search_string) ? '\\b' : '';
    $regex = $boundary . drift_search_regexp_quote($search_string);

    $author_match = $wpdb->prepare(
        "EXISTS (
            SELECT 1
            FROM {$wpdb->term_relationships} drift_atr
            INNER JOIN {$wpdb->term_taxonomy} drift_att ON drift_atr.term_taxonomy_id = drift_att.term_taxonomy_id
            INNER JOIN {$wpdb->terms} drift_at ON drift_att.term_id = drift_at.term_id
            WHERE drift_atr.object_id = {$wpdb->posts}.ID
              AND drift_att.taxonomy = 'authors'
              AND drift_at.name REGEXP %s
        )",
        $regex
    );

    $translator_match = $wpdb->prepare(
        "EXISTS (
            SELECT 1
            FROM {$wpdb->postmeta} drift_tlm
            INNER JOIN {$wpdb->terms} drift_tl ON drift_tl.term_id = CAST(drift_tlm.meta_value AS UNSIGNED)
            WHERE drift_tlm.post_id = {$wpdb->posts}.ID
              AND drift_tlm.meta_key = '_translator_term_id'
              AND drift_tl.name REGEXP %s
        )",
        $regex
    );

    return '(' . $author_match . ' OR ' . $translator_match . ')';
}

// Rank pieces written (or translated) by a matching contributor above posts
// that only mention the search string in their text.
add_filter('posts_orderby', 'drift_search_authored_first_orderby', 10, 2);

function drift_search_authored_first_orderby($orderby, $query)
{
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return $orderby;
    }

    $search_string = trim((string) $query->get('s'));
    if ($search_string === '') {
        return $orderby;
    }

    $authored_first = '(CASE WHEN ' . drift_search_byline_match_sql($search_string) . ' THEN 0 ELSE 1 END) ASC';

    return $orderby ? $authored_first . ', ' . $orderby : $authored_first;
}

// Change # of posts per page for search queries
add_action('pre_get_posts', 'manage_posts_per_page');

function manage_posts_per_page($query)
{
    if (is_admin()) {
        return;
    }
    // Check if this is a search
    if ($query->is_search()) {
        $query->set('posts_per_page', 10);
    }
    // Or an 'authors' (i.e. contributor)
    else if (array_key_exists('authors', $query->query)) {
        $query->set('posts_per_page', 5);
    }
}

function get_current_template($echo = false)
 {
     if (!isset($GLOBALS['current_theme_template']))
         return false;
     if ($echo)
         echo $GLOBALS['current_theme_template'];
     else
         return $GLOBALS['current_theme_template'];
 }


 // This dreadful technology is necessary ... for some reason. Still trying to diagnose why, but I think the issues page isn't properly set up as a page in some way
add_filter('template_include', 'var_template_include', 1000);
function var_template_include($t)
{
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function custom_login() {
    $drift_all_style_path = get_theme_file_path('/assets/css/login.css');
    $logo = get_theme_file_uri() . '/assets/images/login/drift_logo_login.png';
    echo('<style type="text/css">:root { --login-logo-url: url(' . $logo . ') }</style>');
    wp_enqueue_style('drift-login-style', get_theme_file_uri('/assets/css/login.css'), array(), filemtime($drift_all_style_path));
}
add_action('login_head', 'custom_login');


/**
 * Translators
 */
function drift_sync_translator_term_meta($post_id)
{
    if (!function_exists('get_field') || !is_numeric($post_id)) {
        return;
    }

    $post_id = (int) $post_id;

    if ($post_id <= 0 || wp_is_post_revision($post_id)) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (get_post_type($post_id) !== 'post') {
        return;
    }

    $translator_ids = get_field('translators', $post_id, false);

    if (!is_array($translator_ids)) {
        $translator_ids = empty($translator_ids) ? array() : array($translator_ids);
    }

    $translator_ids = array_values(array_unique(array_map('intval', array_filter($translator_ids))));

    delete_post_meta($post_id, '_translator_term_id');

    foreach ($translator_ids as $term_id) {
        add_post_meta($post_id, '_translator_term_id', $term_id, false);
    }
}
add_action('acf/save_post', 'drift_sync_translator_term_meta', 20);

function drift_get_translator_terms($post_id)
{
    $term_ids = array_map('intval', get_post_meta($post_id, '_translator_term_id', false));
    $terms = array();

    foreach ($term_ids as $term_id) {
        $term = get_term($term_id, 'authors');

        if ($term && !is_wp_error($term)) {
            $terms[] = $term;
        }
    }

    return $terms;
}

function drift_get_author_archive_query($term_id)
{
    $term_id = (int) $term_id;

    $visible_statuses = array('publish');
    if (is_user_logged_in() && current_user_can('read_private_posts')) {
        $visible_statuses[] = 'private';
    }

    // Start with anything attached to the author term.
    $written_ids = get_objects_in_term($term_id, 'authors');
    if (is_wp_error($written_ids) || !is_array($written_ids)) {
        $written_ids = array();
    }

    $written_ids = array_map('intval', $written_ids);
    $written_ids = array_values(array_unique(array_filter($written_ids)));

    // Normalize authored IDs down to visible standard posts only.
    if (!empty($written_ids)) {
        $written_ids = get_posts(array(
            'post_type'           => 'post',
            'post_status'         => $visible_statuses,
            'fields'              => 'ids',
            'posts_per_page'      => -1,
            'ignore_sticky_posts' => true,
            'post__in'            => $written_ids,
            'orderby'             => 'date',
            'order'               => 'DESC',
        ));
    }

    // Pull translated posts from helper meta.
    $translated_ids = get_posts(array(
        'post_type'           => 'post',
        'post_status'         => $visible_statuses,
        'fields'              => 'ids',
        'posts_per_page'      => -1,
        'ignore_sticky_posts' => true,
        'meta_query'          => array(
            array(
                'key'     => '_translator_term_id',
                'value'   => (string) $term_id,
                'compare' => '=',
            ),
        ),
        'orderby'             => 'date',
        'order'               => 'DESC',
    ));

    if (!is_array($translated_ids)) {
        $translated_ids = array();
    }

    $written_ids = array_map('intval', $written_ids);
    $translated_ids = array_map('intval', $translated_ids);

    $post_ids = array_values(array_unique(array_merge($written_ids, $translated_ids)));

    if (empty($post_ids)) {
        $post_ids = array(0);
    }

    return new WP_Query(array(
        'post_type'           => 'post',
        'post_status'         => $visible_statuses,
        'posts_per_page'      => 5,
        'paged'               => max(1, (int) get_query_var('paged'), (int) get_query_var('page')),
        'ignore_sticky_posts' => true,
        'post__in'            => $post_ids,
        'orderby'             => 'date',
        'order'               => 'DESC',
    ));
}


/**
 * Allow full HTML in authors taxonomy descriptions.
 */
function drift_allow_html_in_author_descriptions()
{
    if (!is_admin()) {
        return;
    }

    $screen = function_exists('get_current_screen') ? get_current_screen() : null;

    if (!$screen || $screen->taxonomy !== 'authors') {
        return;
    }

    remove_filter('pre_term_description', 'wp_filter_kses');
    remove_filter('term_description', 'wp_kses_data');
}
add_action('current_screen', 'drift_allow_html_in_author_descriptions');

add_filter('auth_cookie_expiration', function ($expiration, $user_id, $remember) {
    $day = defined('DAY_IN_SECONDS') ? DAY_IN_SECONDS : 86400;

    if ($remember) {
        return 180 * $day;
    }

    return $expiration;
}, 10, 3);

/**
 * Cache busting for archive/index pages on WP Engine.
 *
 * WPE's Varnish auto-purges the single post URL on publish but misses the
 * archive/index pages the post appears on (home, category, tag, author tax,
 * date archives, custom post type archives). These hooks purge those URLs
 * surgically so the site stays fast while editors see fresh listings.
 */

function drift_collect_archive_urls_for_post($post)
{
    if (!$post instanceof WP_Post) {
        $post = get_post($post);
    }
    if (!$post) {
        return array();
    }

    $urls = array(home_url('/'));

    // With a static front page, the blog index is a separate posts page, not
    // home_url('/') — purge it too so the main post listing stays fresh.
    if (get_option('show_on_front') === 'page') {
        $page_for_posts = (int) get_option('page_for_posts');
        if ($page_for_posts) {
            $blog_url = get_permalink($page_for_posts);
            if ($blog_url) {
                $urls[] = $blog_url;
            }
        }
    }

    foreach ((array) get_the_category($post->ID) as $term) {
        $link = get_term_link($term);
        if (!is_wp_error($link)) {
            $urls[] = $link;
        }
    }

    $tags = get_the_tags($post->ID);
    if (is_array($tags)) {
        foreach ($tags as $term) {
            $link = get_term_link($term);
            if (!is_wp_error($link)) {
                $urls[] = $link;
            }
        }
    }

    $author_terms = wp_get_post_terms($post->ID, 'authors');
    if (is_array($author_terms)) {
        foreach ($author_terms as $term) {
            $link = get_term_link($term);
            if (!is_wp_error($link)) {
                $urls[] = $link;
            }
        }
    }

    $translator_term_ids = array_map('intval', get_post_meta($post->ID, '_translator_term_id', false));
    foreach (array_unique(array_filter($translator_term_ids)) as $term_id) {
        $link = get_term_link($term_id, 'authors');
        if (!is_wp_error($link)) {
            $urls[] = $link;
        }
    }

    $year = get_the_time('Y', $post);
    $month = get_the_time('m', $post);
    if ($year) {
        $urls[] = get_year_link($year);
        if ($month) {
            $urls[] = get_month_link($year, $month);
        }
    }

    if ($post->post_type !== 'post') {
        $type_archive = get_post_type_archive_link($post->post_type);
        if ($type_archive) {
            $urls[] = $type_archive;
        }
    }

    // Template-driven listing pages. These post types have no usable archive
    // (issue/mention have no has_archive) or appear on extra index pages, so
    // purge every published Page built on the relevant template:
    //  - post: page-templates/latest_articles.php (WP_Query over post_type=post)
    //  - issue: issues.php, plus mentions.php (mentions.php loops every issue's
    //    select_mentions_acf and color)
    //  - mention: mentions.php
    $listing_templates = array(
        'post'    => array('page-templates/latest_articles.php'),
        'issue'   => array('page-templates/issues.php', 'page-templates/mentions.php'),
        'mention' => array('page-templates/mentions.php'),
    );
    if (isset($listing_templates[$post->post_type])) {
        foreach ($listing_templates[$post->post_type] as $template) {
            foreach (drift_get_template_page_urls($template) as $page_url) {
                $urls[] = $page_url;
            }
        }
    }

    return array_values(array_unique(array_filter($urls)));
}

/**
 * Return permalinks of published Pages that use a given page template, e.g.
 * 'page-templates/issues.php'. Used to purge template-driven listing pages that
 * stand in for CPTs registered without has_archive.
 */
function drift_get_template_page_urls($template)
{
    // Cache per request: this can be called several times on one save (e.g.
    // pre_post_update then save_post) for the same template.
    static $cache = array();
    if (isset($cache[$template])) {
        return $cache[$template];
    }

    $page_ids = get_posts(array(
        'post_type'        => 'page',
        'post_status'      => 'publish',
        'numberposts'      => -1,
        'fields'           => 'ids',
        'meta_key'         => '_wp_page_template',
        'meta_value'       => $template,
        'suppress_filters' => true,
    ));

    $urls = array();
    foreach ($page_ids as $page_id) {
        $link = get_permalink($page_id);
        if ($link) {
            $urls[] = $link;
        }
    }

    $cache[$template] = $urls;
    return $urls;
}

function drift_purge_urls(array $urls)
{
    // WPE exposes the purge helper as the static method
    // WpeCommon::purge_varnish_cache_url(). PHP resolves class and method
    // names case-insensitively, so this guard also covers stacks that declare
    // the class as `wpecommon`.
    if (!is_callable(array('WpeCommon', 'purge_varnish_cache_url'))) {
        return;
    }

    // De-dupe purges across the whole request: several hooks (transition,
    // save_post, set_object_terms) can target the same URL on one save.
    static $already_purged = array();

    foreach ($urls as $url) {
        if (!$url || isset($already_purged[$url])) {
            continue;
        }
        $already_purged[$url] = true;
        WpeCommon::purge_varnish_cache_url($url);
    }
}

/**
 * Stash/recall the archive URLs a post appeared on *before* an update, so we
 * can purge the archives it has just left (old category/tag/author/date) on
 * top of the ones it now belongs to. Pass $urls to store, omit to recall (and
 * clear) the stored set.
 */
function drift_remembered_archive_urls($post_id, array $urls = null)
{
    static $store = array();

    $post_id = (int) $post_id;

    if ($urls !== null) {
        $store[$post_id] = $urls;
        return $urls;
    }

    $remembered = isset($store[$post_id]) ? $store[$post_id] : array();
    unset($store[$post_id]);

    return $remembered;
}

function drift_purge_archives_for_post($post)
{
    if (!$post instanceof WP_Post) {
        $post = get_post($post);
    }
    if (!$post) {
        return;
    }

    // Purge each post only once per request: a single update can fire
    // transition_post_status, save_post and publish_future_post together.
    static $purged_posts = array();
    if (isset($purged_posts[$post->ID])) {
        return;
    }
    $purged_posts[$post->ID] = true;

    $urls = array_merge(
        drift_collect_archive_urls_for_post($post),
        drift_remembered_archive_urls($post->ID)
    );
    $urls = array_values(array_unique(array_filter($urls)));

    if (!empty($urls)) {
        drift_purge_urls($urls);
    }

    delete_transient('twentyseventeen_categories');
}

/**
 * Trigger for posts *leaving* publish: unpublish, trash, or going private.
 *
 * Publishing and publish-to-publish updates are handled by the save_post hook
 * below instead. transition_post_status fires *before* save_post (and therefore
 * before acf/save_post syncs _translator_term_id), so purging here on a publish
 * save would run with stale meta and trip the per-post guard, blocking the
 * later, correct purge. Handle only the removal transitions, which save_post
 * (post_status === 'publish') can't catch, here.
 */
add_action('transition_post_status', function ($new_status, $old_status, $post) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!$post instanceof WP_Post || wp_is_post_revision($post->ID)) {
        return;
    }
    if (!in_array($post->post_type, array('post', 'issue', 'mention'), true)) {
        return;
    }
    if ($old_status !== 'publish' || $new_status === 'publish') {
        return;
    }

    drift_purge_archives_for_post($post);
}, 10, 3);

/**
 * Primary trigger for publishes and updates of live posts.
 *
 * Runs at priority 99 — after acf/save_post (priority 20) has synced
 * _translator_term_id and after core has written terms — so the collected
 * archive set reflects the post's final state. Covers manual publish,
 * publish-to-publish edits, and ACF/CFS meta-only saves on live posts.
 */
add_action('save_post', function ($post_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    }
    if (!$post instanceof WP_Post || $post->post_status !== 'publish') {
        return;
    }
    if (!in_array($post->post_type, array('post', 'issue', 'mention'), true)) {
        return;
    }

    drift_purge_archives_for_post($post);
}, 99, 3);

/**
 * Edge case: author/translator term edits.
 *
 * Editing an 'authors' term (bio, name, description) doesn't touch any post,
 * so transition_post_status never fires — but the author archive page renders
 * that bio and stays cached. Purge the term's archive URL on edit.
 */
add_action('edited_authors', function ($term_id, $tt_id) {
    $link = get_term_link((int) $term_id, 'authors');
    if (is_wp_error($link)) {
        return;
    }

    drift_purge_urls(array($link, home_url('/')));
}, 10, 2);

/**
 * Edge case: scheduled posts whose archives were cached while empty.
 *
 * future_to_publish flows through transition_post_status above, but adding
 * an explicit 'publish_future_post' handler ensures the purge fires even if
 * a plugin short-circuits the transition action.
 */
add_action('publish_future_post', function ($post_id) {
    $post = get_post($post_id);
    if ($post && in_array($post->post_type, array('post', 'issue', 'mention'), true)) {
        drift_purge_archives_for_post($post);
    }
}, 10, 1);

/**
 * Edge case: relationships removed from an already-published post.
 *
 * When an editor changes a live post's category, tag, author/translator, or
 * publish date, drift_purge_archives_for_post() only knows the post's *new*
 * state — the archive it just left (e.g. the old category or author page, or
 * the previous date archive rendered by taxonomy-authors.php) would stay
 * cached and keep showing the moved/removed post. pre_post_update fires before
 * the row, terms and meta are rewritten, so snapshot the pre-update archive
 * URLs here; drift_purge_archives_for_post() then purges them alongside the new
 * ones on the subsequent save_post/transition.
 */
add_action('pre_post_update', function ($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    }

    $post = get_post($post_id);
    if (!$post instanceof WP_Post || $post->post_status !== 'publish') {
        return;
    }
    if (!in_array($post->post_type, array('post', 'issue', 'mention'), true)) {
        return;
    }

    drift_remembered_archive_urls($post_id, drift_collect_archive_urls_for_post($post));
}, 10, 1);

/**
 * Edge case: taxonomy relationship changes (both editors).
 *
 * In the block editor terms are written *after* save_post fires, so the new (or
 * just-removed) term archive can be missed by the post-level purge above.
 * set_object_terms fires whenever a relationship actually changes and exposes
 * both the old and new term_taxonomy_ids — purge the archives of every term
 * that was added or removed so both the old and new listings refresh.
 */
add_action('set_object_terms', function ($object_id, $terms, $tt_ids, $taxonomy, $append, $old_tt_ids = array()) {
    if (!in_array($taxonomy, array('category', 'post_tag', 'authors'), true)) {
        return;
    }

    $post = get_post($object_id);
    if (!$post instanceof WP_Post || $post->post_status !== 'publish' || !in_array($post->post_type, array('post', 'issue', 'mention'), true)) {
        return;
    }

    $changed = array_unique(array_merge(
        array_diff((array) $old_tt_ids, (array) $tt_ids),
        array_diff((array) $tt_ids, (array) $old_tt_ids)
    ));
    if (empty($changed)) {
        return;
    }

    $urls = array(home_url('/'));
    foreach ($changed as $tt_id) {
        $term = get_term_by('term_taxonomy_id', (int) $tt_id);
        if ($term && !is_wp_error($term)) {
            $link = get_term_link($term);
            if (!is_wp_error($link)) {
                $urls[] = $link;
            }
        }
    }

    drift_purge_urls($urls);
}, 10, 6);
