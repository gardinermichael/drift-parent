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
    add_editor_style(array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ));

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
    if (is_single() && ! is_active_sidebar('sidebar-1')) {
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
    if ('custom' !== get_theme_mod('colorscheme') && ! is_customize_preview()) {
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
function twentyseventeen_fonts_url() {

    $font_families = array();

    $font_families[] = 'Libre+Franklin:wght@100;300;700';
    $font_families[] = 'Lusitana:wght@400;700';
    $font_families[] = 'Montserrat:wght@100;300';
    $font_families[] = 'Raleway:wght@100;300';
    $font_families[] = 'Open+Sans:wght@300;400;700';
    $font_families[] = 'Libre+Baskerville:wght@400;700';
    $font_families[] = 'Roboto:wght@100';

    $query_args = array(
        'family'  => implode( '&family=', $font_families ),
        'display' => 'swap',
    );

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );

    return esc_url_raw($fonts_url);
}

/**
 * Enqueues scripts and styles.
 */
function twentyseventeen_scripts() {

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'drift-fonts', twentyseventeen_fonts_url(), array(), time() );

    // Theme stylesheet.
    wp_enqueue_style('twentyseventeen-style', get_stylesheet_uri(), array(), '20190507');

    // Theme block stylesheet.
    wp_enqueue_style('twentyseventeen-block-style', get_theme_file_uri('/assets/css/blocks.css'), array( 'twentyseventeen-style' ), '20190105');

    wp_enqueue_style( 'drift-all-style', get_theme_file_uri( '/assets/css/all.min.css' ), array(), time() );
    wp_enqueue_style( 'aos-style', get_theme_file_uri( '/assets/css/aos.css' ), array(), time() );
    wp_enqueue_style( 'bootstrap-style', get_theme_file_uri( '/assets/css/bootstrap.min.css' ), array(), time() );
    wp_enqueue_style( 'owl-style', get_theme_file_uri( '/assets/css/owl.carousel.min.css' ), array(), time() );
    // wp_enqueue_style( 'drift-style', get_theme_file_uri( '/assets/css/custom_77.css' ), array(), time() );
    wp_enqueue_style( 'drift', get_theme_file_uri( '/assets/css/custom-updated.css' ), array( 'bootstrap-style' ), time() );

    // Load subscribe css for bundle
    if (is_page_template(array('page-templates/subscribe.php', 'page-templates/bundle_subscribe.php'))) {
        wp_enqueue_style('subscribe-style', get_theme_file_uri('/assets/css/subscribe.css'), array(), time());

        if (is_page_template('page-templates/bundle_subscribe.php')) {
            wp_enqueue_style('bundle-style', get_theme_file_uri('/assets/css/bundle.css'), array(), time());
        }
    }

    // Load the dark colorscheme.
    if ('dark' === get_theme_mod('colorscheme', 'light') || is_customize_preview()) {
        wp_enqueue_style('twentyseventeen-colors-dark', get_theme_file_uri('/assets/css/colors-dark.css'), array( 'twentyseventeen-style' ), '20190408');
    }

    // Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
    if (is_customize_preview()) {
        wp_enqueue_style('twentyseventeen-ie9', get_theme_file_uri('/assets/css/ie9.css'), array( 'twentyseventeen-style' ), '20161202');
        wp_style_add_data('twentyseventeen-ie9', 'conditional', 'IE 9');
    }

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style('twentyseventeen-ie8', get_theme_file_uri('/assets/css/ie8.css'), array( 'twentyseventeen-style' ), '20161202');
    wp_style_add_data('twentyseventeen-ie8', 'conditional', 'lt IE 9');

    // Load the html5 shiv.
    wp_enqueue_script('html5', get_theme_file_uri('/assets/js/html5.js'), array(), '20161020');
    wp_script_add_data('html5', 'conditional', 'lt IE 9');

    wp_enqueue_script('twentyseventeen-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js'), array(), '20161114', true);

    $twentyseventeen_l10n = array(
        'quote' => twentyseventeen_get_svg(array( 'icon' => 'quote-right' )),
    );

    if (has_nav_menu('top')) {
        wp_enqueue_script('twentyseventeen-navigation', get_theme_file_uri('/assets/js/navigation.js'), array( 'jquery' ), '20161203', true);
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

    wp_enqueue_script('jquery-scrollto', get_theme_file_uri('/assets/js/jquery.scrollTo.js'), array( 'jquery' ), '2.1.2', true);

    wp_localize_script('twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap-script', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), '2.3.1', true );
	wp_enqueue_script( 'owl-script', get_theme_file_uri( '/assets/js/owl.carousel.min.js' ), array( 'jquery' ), '2.3.1', true );
	wp_enqueue_script( 'aos-script', get_theme_file_uri( '/assets/js/aos.js' ), array(), '2.3.1', true );
    wp_enqueue_script( 'aos-config-script', get_theme_file_uri( '/assets/js/aos-config.js' ), array( 'aos-script' ), '2.3.1', true );
	wp_enqueue_script( 'imagesloaded-script', get_theme_file_uri( '/assets/js/imagesloaded.pkgd.js' ), array( 'jquery' ), '2.3.1', true );
	// wp_enqueue_script( 'custom-script', get_theme_file_uri( '/assets/js/custom_js_28.js' ), array( 'jquery' ), '2.3.1', true );
    wp_enqueue_script( 'custom-script', get_theme_file_uri( '/assets/js/custom-js-28-updated.js' ), array( 'jquery' ), '2.3.1', true );

    global $post;
    if( is_a( $post, 'WP_Post' ) && ( is_page_template( array( 'page-templates/subscribe.php', 'page-templates/donate.php', 'page-templates/subscribe_template.php' ) ) || has_shortcode( $post->content, 'fullstripe_form' ) ) ) {
        wp_enqueue_script( 'fullstripe-custom-script', get_theme_file_uri( '/assets/js/wpfs-script.js' ), array( 'jquery' ), '2.3.1', true );
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
        if (! (is_page() && 'one-column' === get_theme_mod('page_options')) && 767 <= $width) {
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
require_once get_template_directory() . '/post_type.php';/*


add_action('admin_enqueue_scripts','wptuts53021_load_admin_script');
function wptuts53021_load_admin_script( $hook ){
    wp_enqueue_script(
        'wptuts53021_script', //unique handle
        get_template_directory_uri().'/admin-scripts.js', //location
        array('jquery')  //dependencies
     );
}*/



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
    'rewrite' => array( 'slug' => 'article_author' ),
  ));
}
function get_first_paragraph()
{
    global $post;
    
    $str = wpautop(get_the_content());
    $str = substr($str, 0, strpos($str, '</p>') + 4);
    $str = strip_tags($str, '<a><strong><em>');

    return '<p>' . $str . '</p>';
}



function my_nav_wrap()
{
    global $theme_option;
    $issue_color = $theme_option["issue_color"];



    $facebook_url = $theme_option["facebook_url"];
    $twitter_url = $theme_option["twitter_url"];
    $instagram_url = $theme_option["instagram_url"];

    $youtube_url = $theme_option["youtube_url"];
    $linkedin_url = $theme_option["linkedin_url"];
    $pinterest_url = $theme_option["pinterest_url"];
    $gplus_url = $theme_option["gplus_url"];

    if ($facebook_url != "") {
        $socialHTML .= '<li><a href="'.$facebook_url.'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>';
    }

    if ($twitter_url != "") {
        $socialHTML .= '<li><a href="'.$twitter_url.'" target="_blank"><i class="fab fa-twitter"></i></a></li>';
    }

    if ($instagram_url != "") {
        $socialHTML .= '<li><a href="'.$instagram_url.'" target="_blank"><i class="fab fa-instagram"></i></a></li>';
    }

    if ($youtube_url != "") {
        $socialHTML .= '<li><a href="'.$youtube_url.'" target="_blank"><i class="fab fa-youtube"></i></a></li>';
    }

    if ($linkedin_url != "") {
        $socialHTML .= '<li><a href="'.$linkedin_url.'" target="_blank"><i class="fab fa-linkedin"></i></a></li>';
    }

    if ($pinterest_url != "") {
        $socialHTML .= '<li><a href="'.$pinterest_url.'" target="_blank"><i class="fab fa-pinterest"></i></a></li>';
    }

    if ($gplus_url != "") {
        $socialHTML .= '<li><a href="'.$gplus_url.'" target="_blank"><i class="fab fa-google-plus-square"></i></a></li>';
    }
    $socialHTML .=  '<li id="menu-item-294" class="drift_search_link menu-item menu-item-type-custom menu-item-object-custom menu-item-294"><a><i class="fa fa-search"></i></a></li>';

    // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
  
    // open the <ul>, set 'menu_class' and 'menu_id' values
    $wrap  = '<ul id="%1$s" class="%2$s">';
  
  
    // get nav items as configured in /wp-admin/
    $wrap .= '%3$s';
  
  
    // the static link
    $wrap .= '<li><ul class="social_icons">'.$socialHTML.'</ul></li>';
    // close the <ul>
    $wrap .= '</ul>';

    // return the result
    return $wrap;
}

/*404 Page redirect to HOMEPAGE code STARTS here */
if (!function_exists('redirect_404_to_homepage')) {
    add_action('template_redirect', 'redirect_404_to_homepage');

    function redirect_404_to_homepage()
    {
        if (is_404()):
            wp_safe_redirect(home_url('/'));
        exit;
        endif;
    }
}
/*404 Page redirect to HOMEPAGE code STARTS here */


/* Search Page redirect to HOMEPAGE code STARTS here *//*
add_action('template_redirect', 'bwp_template_redirect');
function bwp_template_redirect()
{
global $wp_query, $post;

if (is_author() || is_attachment() || is_day() || is_search() || is_multi_author() )
{
wp_redirect(get_option('home'));
exit;
}

if (is_feed())
{
$author = get_query_var('author_name');
$attachment = get_query_var('attachment');
$attachment = (empty($attachment)) ? get_query_var('attachment_id') : $attachment;
$day = get_query_var('day');
$search = get_query_var('s');

if (!empty($author) || !empty($attachment) || !empty($day) || !empty($search))
{
$wp_query->set_404();
$wp_query->is_feed = false;
}
}
}*/
/* Search Page redirect to HOMEPAGE code ENDS here */




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
    if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
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
    ?>
    <tr valign="top">
        <th scope="row">Author Bio</th>
        <td>
            <?php wp_editor(html_entity_decode($term->description), 'description', array('media_buttons' => false)); ?>
            <script>
                jQuery(window).ready(function(){
                    jQuery('label[for=description]').parent().parent().remove();
                });
            </script>
        </td>
    </tr>
    <?php
}

add_action('template_redirect', 'redirect_cpt_singular_posts');
    function redirect_cpt_singular_posts()
    {
        if (is_singular('issue')) {
            $Issues_pageURL  = get_the_permalink(14);
            wp_redirect($Issues_pageURL, 302);
            exit;
        }
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
    $cookie_name = "dpp_stripeaccount";
    $cookie_value = "true";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 180), "/"); // 86400 = 1 day
}

add_action('fullstripe_after_subscription_charge', 'set_paywall_cookie', 10, 2);


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts()
{
    echo '<style>
    .taxonomy-authors  .form-field.term-slug-wrap,
    .taxonomy-authors  .form-field.term-parent-wrap,
    .taxonomy-authors .term-row-head,
    .taxonomy-authors  .terms-tfp-wrap,
    .taxonomy-authors .term-description-wrap p
    {display:none !important;}    


.taxonomy-authors .term-description-wrap label[for="tag-description"]{ font-size:0;}
.taxonomy-authors .term-description-wrap label[for="tag-description"]:after {
    content: "Author Bio";
    font-size: 13px;
}


  </style>';
}

// Change # of posts per page for search queries
add_action( 'pre_get_posts', 'manage_posts_per_page' );

function manage_posts_per_page( $query ){
  if ( is_admin() ){
    return;
  }
  // Check if this is a search
  if ( $query->is_search() ) {
    $query->set( 'posts_per_page', 10 );
  }
  // Or an 'authors' (i.e. contributor)
  else if ( array_key_exists('authors', $query->query) ) {
    $query->set( 'posts_per_page', 5 );
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

 // As admin, show template being loaded for debugging & development purposes
add_action( 'wp_footer', 'mark_which_template' );

function mark_which_template() {
    if ( is_super_admin() ) {
        global $template;
        print_r( $template );
        print_r(get_current_template());
    }
}
