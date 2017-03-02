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
	add_image_size('about', 126, 126, true);

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

    register_sidebar( array(
        'name'          => esc_html__( 'Home page', 'wedding-theme' ),
        'id'            => 'homepage',
        'description'   => esc_html__( 'Add widgets here.', 'wedding-theme' ),
        'before_widget' => '<div class="one_third columns">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
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

function register_custom_post_types() {

        $labels = array(
            'name'                  => _x( 'About them', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'About them', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'About them', 'text_domain' ),
            'name_admin_bar'        => __( 'About', 'text_domain' ),
            'archives'              => __( 'Item Archives', 'text_domain' ),
            'attributes'            => __( 'Item Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
            'all_items'             => __( 'All Items', 'text_domain' ),
            'add_new_item'          => __( 'Add New Item', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Item', 'text_domain' ),
            'edit_item'             => __( 'Edit Item', 'text_domain' ),
            'update_item'           => __( 'Update Item', 'text_domain' ),
            'view_item'             => __( 'View Item', 'text_domain' ),
            'view_items'            => __( 'View Items', 'text_domain' ),
            'search_items'          => __( 'Search Item', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Featured Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
            'items_list'            => __( 'Items list', 'text_domain' ),
            'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'About Them', 'text_domain' ),
            'description'           => __( 'About newlyweds', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'            => array( ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        register_post_type( 'about-them', $args );


}


function shorten_excerpt($content, $limit = 100) {
    $no_char = strlen($content);
    $content = substr($content, 0, $limit);
    $add = ($no_char > $limit) ? "..." : "";
    return $content . $add;
}

add_action('init', 'register_custom_post_types');
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


class Features_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'features_widget', // Base ID
            esc_html__( 'Features Widget', 'wedding-theme' ), // Name
            array( 'description' => esc_html__( 'A text with title and icon', 'wedding-theme' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        echo $args['before_widget'];
        echo '<img src="' . get_template_directory_uri() . '/images/icons/'.$instance['icon'] . '" alt=""/>';
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        echo $instance['body'];
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
        $body = ! empty( $instance['body'] ) ? $instance['body'] : esc_html__( '', 'text_domain' );
        $icon = ! empty( $instance['icon'] ) ? $instance['icon'] : esc_html__( 'icon5.png', 'text_domain' );
        ?>
        <p>

            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>

            <label for="<?php echo esc_attr( $this->get_field_id( 'body' ) ); ?>"><?php esc_attr_e( 'Text:', 'text_domain' ); ?></label>
            <textarea class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'body' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'body' ) ); ?>" cols="30" rows="10"><?php echo esc_attr( $body ); ?></textarea>
        </p>
        <p>

            <label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><?php esc_attr_e( 'Icon:', 'text_domain' ); ?></label>

            <select name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" class="widefat" >
                <option value="icon5.png" <?= $icon == 'icon5.png' ? "selected" : ""; ?>>Nail</option>
                <option value="icon6.png" <?= $icon == 'icon6.png' ? "selected" : ""; ?>>Rocket</option>
                <option value="icon7.png" <?= $icon == 'icon7.png' ? "selected" : ""; ?>>Box</option>
            </select>

        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['body'] = ( ! empty( $new_instance['body'] ) ) ? strip_tags( $new_instance['body'] ) : '';
        $instance['icon'] = ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : '';

        return $instance;
    }

} // class Foo_Widget

// register Foo_Widget widget
function register_features_widget() {
    register_widget( 'Features_Widget' );
}
add_action( 'widgets_init', 'register_features_widget' );