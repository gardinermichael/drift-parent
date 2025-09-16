<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */
if (!class_exists('Redux_Framework_sample_config')) {
    class Redux_Framework_sample_config {
        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;
        public function __construct() {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }
        public function initSettings() {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();
            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();
            // Create the sections and fields
            $this->setSections();
            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }
        /**
          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.
         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            
        }
        /**
          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.
          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html('Section via hook', 'drift'),
                'desc' => esc_html('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'drift'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
            return $sections;
        }
        /**
          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            $args['dev_mode'] = false;
            return $args;
        }
        /**
          Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';
            return $defaults;
        }
        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);
                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }
        public function setSections() {
            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();
           
            ob_start();
            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';
            $customize_title = sprintf(__('Customize “%s”', 'drift'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class, 'drift'); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title, 'drift'); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','drift'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot, 'drift'); ?>" alt="<?php esc_attr_e('Current theme preview','drift'); ?>" />
                <?php endif; ?>
                <h4><?php echo $this->theme->display('Name'); ?></h4>
                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html('By %s', 'drift'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html('Version %s', 'drift'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html('Tags', 'drift') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . esc_html('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.','drift') . '</p>', __('//codex.wordpress.org/Child_Themes', 'drift'), $this->theme->parent()->display('Name'));
            }
            ?>
                </div>
            </div>
            <?php
            $item_info = ob_get_contents();
            ob_end_clean();
            $sampleHTML = '';
           $plugin_path =  plugin_dir_url("redux-framework/sample"); 
            if (file_exists($plugin_path . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once ABSPATH . '/wp-admin/includes/file.php';
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents($plugin_path . '/info-html.html');
            }
			
			 
            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => esc_html('General Settings', 'drift'),                
                'fields'    => array(
                                        array(
                                            'id'        => 'logo_image',
                                            'type'      => 'media',
                                            'url'       => true,
                                            'title'     => esc_html('Logo Image', 'drift'),
                                            'subtitle'  => esc_html('Upload a  logo image here', 'drift'),
                                            'default'   => array('url' => get_template_directory_uri().'/assets/images/logo.png')
                                        ),     
                                       array(
                                            'id'        => 'site_description',
                                            'type'      => 'textarea',                        
                                            'title'     => __('Enter site description in one line here.', 'drift')                                            
                                        ),  
                                		array(
                                    			'id'        => 'favicon',
                                    			'type'      => 'media',
                                    			'url'       => true,
                                    			'title'     => esc_html('Custom Favicon', 'drift'),
                                    			'subtitle'  => esc_html('Upload your Favicon here,  preferred size is  16x16 or 32x32px', 'drift'), 
                                    			'default'   => array('url' => get_template_directory_uri().'/images/backgrounds/favicon.png')
                              		  ),
                                                                         
                                  ),
            );


            $this->sections[] = array(
                'icon'      => 'el el-twitter',
                'title'     => esc_html('Social Media', 'drift'), 
				 'subtitle'  => esc_html('Remove # if you do not want to show any option', 'drift') ,                
                'fields'    => array(
				     array(
                        'id'        => 'twitter_url',
                        'type'      => 'text',                        
                        'title'     => __('Enter Twitter Url', 'drift'),
                        'subtitle'  => __('Put Your Twitter Url Here', 'drift'),                        
                        'default'   => '#'
                    ),
					 array(
                        'id'        => 'facebook_url',
                        'type'      => 'text',                        
                        'title'     => esc_html('Enter Facebook Url', 'drift'),
                        'subtitle'  => esc_html('Put Your Facebook Url Here', 'drift'),                        
                        'default'   => '#'
                    ),
					
					 array(
                        'id'        => 'gplus_url',
                        'type'      => 'text',                        
                        'title'     => esc_html('Enter Google Plus Url', 'drift'),
                        'subtitle'  => esc_html('Put Your Google Plus Url Here', 'drift'),                        
                        'default'   => '#'
                    ),
					 array(
                        'id'        => 'pinterest_url',
                        'type'      => 'text',                        
                        'title'     => esc_html('Enter Pinterest Url', 'drift'),
                        'subtitle'  => esc_html('Put Your Pinterest Url Here', 'drift'),                        
                        'default'   => '#'
                    ),
					 array(
                        'id'        => 'instagram_url',
                        'type'      => 'text',         
                        'title'     => esc_html('Enter Instagram Url', 'drift'),
                        'subtitle'  => esc_html('Put Your Instagram Url Here', 'drift'),                        
                        'default'   => ''
                    ),
					 array(
                        'id'        => 'youtube_url',
                        'type'      => 'text',         
                        'title'     => esc_html('Enter Youtube Url', 'drift'),
                        'subtitle'  => esc_html('Put Your Youtube Url Here', 'drift'),                        
                        'default'   => ''
                    ),
					 array(
                        'id'        => 'linkedin_url',
                        'type'      => 'text',         
                        'title'     => esc_html('Enter LinkedIn Url', 'drift'),
                        'subtitle'  => esc_html('Put Your LinkedIn Url Here', 'drift'),                        
                        'default'   => ''
                    ),
                
                ),
            );
            
            // Import Export
            $this->sections[] = array(
                'title'     => esc_html('Import / Export', 'drift'),
                'desc'      => esc_html('Import and Export your Redux Framework settings from file, text or URL.', 'drift'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
           
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html('Theme Information', 'drift'),
                'desc'      => esc_html('<p class="description">This is the Description. Again HTML is allowed</p>', 'drift'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );
        }
        public function setHelpTabs() {
            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html('Theme Information 1', 'drift'),
                'content'   => esc_html('<p>This is the tab content, HTML is allowed.</p>', 'drift')
            );
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html('Theme Information 2', 'drift'),
                'content'   => esc_html('<p>This is the tab content, HTML is allowed.</p>', 'drift')
            );
            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html('<p>This is the sidebar content, HTML is allowed.</p>', 'drift');
        }
        /**
          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'theme_option',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html('Theme Options', 'drift'),
                'page_title'        => esc_html('Theme Options', 'drift'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyByw9j_PY1meWfxVmujxzrc7HhsQMvg_e4', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE
                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );
            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => '//github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => '//www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => '//twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => '//www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );
            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
               // $this->args['intro_text'] = sprintf(esc_html('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'drift'), $v);
            } else {
              //  $this->args['intro_text'] = esc_html('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'drift');
            }
            // Add content after the form.
           // $this->args['footer_text'] = esc_html('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'drift');
        }
    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}
/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;
/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation
          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */
        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;