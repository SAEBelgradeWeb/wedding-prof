<?php
/**
 * wedding-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wedding-theme
 */

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
