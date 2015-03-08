<?php
/**
 * sanctuary functions and definitions
 *
 * @package sanctuary
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'sanctuary_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sanctuary_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sanctuary, use a find and replace
	 * to change 'sanctuary' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sanctuary', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		}

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sanctuary' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside'
	) );

	// Set up the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'sanctuary_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '',
	// ) ) );
}
endif; // sanctuary_setup
add_action( 'after_setup_theme', 'sanctuary_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sanctuary_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sanctuary' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'sanctuary_widgets_init' );


function themeslug_filter_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'themeslug_filter_front_page_template' );

/**
 * Enqueue scripts and styles.
 */
function sanctuary_scripts() {
	wp_enqueue_style( 'sanctuary-style', get_stylesheet_uri() );

	wp_enqueue_style( 'sanctuary-google-fonts', 'http://fonts.googleapis.com/css?family=Arvo:400,700|Open+Sans:400,700|Open+Sans+Condensed:300');

	wp_enqueue_style( 'sanctuary-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

	wp_enqueue_script( 'sanctuary-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'sanctuary-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sanctuary_scripts' );

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

if(!function_exists('sanctuary_register_stylesheets')) {
function sanctuary_register_stylesheets() {
	wp_register_style('flexslider_css',  get_template_directory_uri().'/js/woothemesFlexSlider/flexslider.css', array(), '2.1', 'screen');
	wp_enqueue_style('flexslider_css');
	}
	add_action('wp_enqueue_scripts', 'sanctuary_register_stylesheets');
	}

if(!function_exists('sanctuary_register_javascripts')) {
function sanctuary_register_javascripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js', array(), '1.8.2');
	wp_enqueue_script( 'jquery');

	wp_register_script('flexslider', get_template_directory_uri().'/js/woothemesFlexSlider/jquery.flexslider.js', array('jquery'), '2.1');
	wp_enqueue_script('flexslider');

	wp_register_script('theme_demo', get_template_directory_uri().'/js/theme-demo.js', array('jquery', 'flexslider'), '1.0');
	wp_enqueue_script('theme_demo');

	}

add_action('wp_enqueue_scripts', 'sanctuary_register_javascripts');
}
