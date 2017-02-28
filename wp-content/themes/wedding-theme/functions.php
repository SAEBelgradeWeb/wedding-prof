<?php
/**
 * wedding-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wedding-theme
 */
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */
class MyTheme_Customize {
    /**
     * This hooks into 'customize_register' (available as of WP 3.4) and allows
     * you to add new sections and controls to the Theme Customize screen.
     *
     * Note: To enable instant preview, we have to actually write a bit of custom
     * javascript. See live_preview() for more.
     *
     * @see add_action('customize_register',$func)
     * @param \WP_Customize_Manager $wp_customize
     * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
     * @since MyTheme 1.0
     */
    public static function register ( $wp_customize ) {
        //1. Define a new section (if desired) to the Theme Customizer
        $wp_customize->add_section( 'mytheme_options',
            array(
                'title' => __( 'MyTheme Options', 'mytheme' ), //Visible title of section
                'priority' => 35, //Determines what order this appears in
                'capability' => 'edit_theme_options', //Capability needed to tweak
                'description' => __('Allows you to customize some example settings for MyTheme.', 'mytheme'), //Descriptive tooltip
            )
        );

        //2. Register new settings to the WP database...
        $wp_customize->add_setting( 'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
            array(
                'default' => '#2BA6CB', //Default setting/value to save
                'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
                'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
                'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
            )
        );

        //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
        $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
            $wp_customize, //Pass the $wp_customize object (required)
            'mytheme_link_textcolor', //Set a unique ID for the control
            array(
                'label' => __( 'Link Color', 'mytheme' ), //Admin-visible name of the control
                'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                'settings' => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
                'priority' => 10, //Determines the order this control appears in for the specified section
            )
        ) );

        //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
        $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
        $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
    }

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     * @since MyTheme 1.0
     */
    public static function header_output() {
        ?>
        <!--Customizer CSS-->
        <style type="text/css">
            <?php self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?>
            <?php self::generate_css('body', 'background-color', 'background_color', '#'); ?>
            <?php self::generate_css('a', 'color', 'link_textcolor'); ?>
        </style>
        <!--/Customizer CSS-->
        <?php
    }

    /**
     * This outputs the javascript needed to automate the live settings preview.
     * Also keep in mind that this function isn't necessary unless your settings
     * are using 'transport'=>'postMessage' instead of the default 'transport'
     * => 'refresh'
     *
     * Used by hook: 'customize_preview_init'
     *
     * @see add_action('customize_preview_init',$func)
     * @since MyTheme 1.0
     */
    public static function live_preview() {
        wp_enqueue_script(
            'mytheme-themecustomizer', // Give the script a unique ID
            get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
            array(  'jquery', 'customize-preview' ), // Define dependencies
            '', // Define a version (optional)
            true // Specify whether to put in footer (leave this true)
        );
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     *
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
        $return = '';
        $mod = get_theme_mod($mod_name);
        if ( ! empty( $mod ) ) {
            $return = sprintf('%s { %s:%s; }',
                $selector,
                $style,
                $prefix.$mod.$postfix
            );
            if ( $echo ) {
                echo $return;
            }
        }
        return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'MyTheme_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'MyTheme_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'MyTheme_Customize' , 'live_preview' ) );


if ( ! function_exists( 'wedding_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wedding_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wedding-theme, use a find and replace
	 * to change 'wedding-theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wedding-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header' => esc_html__( 'Header', 'wedding-theme' ),
		'footer' => esc_html__( 'Footer', 'wedding-theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wedding_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_image_size('slider', 1156, 407, true);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'wedding_theme_setup' );




/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wedding_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wedding_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'wedding_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wedding_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wedding-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wedding-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wedding_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wedding_theme_scripts() {

	wp_enqueue_style('font1', "http://fonts.googleapis.com/css?family=Droid+Sans:400,700");
	wp_enqueue_style('font2', "http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700");
	wp_enqueue_style('style', get_template_directory_uri() . "/styles/style.css");
	wp_enqueue_style('inner', get_template_directory_uri() . "/styles/inner.css");
	wp_enqueue_style('layout', get_template_directory_uri() . "/styles/layout.css");
	wp_enqueue_style('flexslider', get_template_directory_uri() . "/styles/flexslider.css");
	wp_enqueue_style('color', get_template_directory_uri() . "/styles/color.css");
	wp_enqueue_style('prettyPhoto', get_template_directory_uri() . "/styles/prettyPhoto.css");


	wp_enqueue_style( 'wedding-theme-style', get_stylesheet_uri() );

    wp_enqueue_script(
        'mytheme-themecustomizer',			//Give the script an ID
        get_template_directory_uri().'/js/theme-customizer.js',//Point to file
        array( 'jquery','customize-preview' ),	//Define dependencies
        '',						//Define a version (optional)
        true						//Put script in footer?
    );

	wp_enqueue_script( 'wedding-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wedding-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('jquery-171' ,get_template_directory_uri() . "/js/jquery-1.7.1.min.js", [], "", true );
	wp_enqueue_script('hoverIntent' ,get_template_directory_uri() . "/js/hoverIntent.js", [], "", true );
	wp_enqueue_script('superfish' ,get_template_directory_uri() . "/js/superfish.js", [], "", true );
	wp_enqueue_script('supersubs' ,get_template_directory_uri() . "/js/supersubs.js", [], "", true );
	wp_enqueue_script('tinynav' ,get_template_directory_uri() . "/js/tinynav.min.js", [], "", true );
	wp_enqueue_script('custom' ,get_template_directory_uri() . "/js/custom.js", [], "", true );
	wp_enqueue_script('flexslider' ,get_template_directory_uri() . "/js/jquery.flexslider-min.js", [], "", true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wedding_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
