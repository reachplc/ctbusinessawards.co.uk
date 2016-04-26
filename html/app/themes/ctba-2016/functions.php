<?php

/**
 * Fix for ACF not being able to handle symlinks
 * @TODO Remove when fixed or ACF is removed
 */
add_action( 'init', 'acf_hook', 0 );  // We use the 0 to bypass priority

function acf_hook() {
	if ( function_exists( 'acf' ) ) {
		acf()->settings['dir'] = WP_CONTENT_URL. '/plugins/advanced-custom-fields/';
	}
}

/**
 * ctba-2016 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ctba-2016
 */

if ( ! function_exists( 'ctba_2016_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ctba_2016_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ctba-2016, use a find and replace
		 * to change 'ctba-2016' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ctba-2016', get_template_directory() . '/languages' );

		/**
		 * Let the end user add a custom logo via the WordPress admin
		 */
		add_theme_support( 'custom-logo' );

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
			'primary' => esc_html__( 'Primary', 'ctba-2016' ),
			'social'  => __( 'Social Links Menu', 'ctba-2016' ),
			'nominate'  => __( 'Nominate Menu', 'ctba-2016' ),
			'events'  => __( 'Events Sites', 'ctba-2016' ),
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

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ctba_2016_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}
	endif;

	add_action( 'after_setup_theme', 'ctba_2016_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ctba_2016_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ctba_2016_content_width', 640 );
}
add_action( 'after_setup_theme', 'ctba_2016_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ctba_2016_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ctba-2016' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ctba_2016_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ctba_2016_scripts() {

	wp_enqueue_style( 'ctba-2016-fonts', '//fast.fonts.net/cssapi/2896c3ef-2b78-4bc2-9652-3329e9098a71.css', array(), '1.0.0', 'all' );

	wp_enqueue_style( 'ctba-2016-style', get_stylesheet_uri(), array( 'ctba-2016-fonts' ), '1.0.0' );

	wp_enqueue_script( 'ctba-2016-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'ctba-2016-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ctba_2016_scripts' );

/**
 * Declare the custom image sizes we need to create
 */
function ctba_define_media_sizes() {

	// Main Logo
	add_image_size( 'logo-master', 528, 328, false );

	// Partner Logo
	add_image_size( 'logo-partner', 400, 300, false );

	// Judge profile image
	add_image_size( 'profile-judge', 480, 600, array( 'center', 'top' ) );

}

add_action( 'after_setup_theme', 'ctba_define_media_sizes' );

function add_query_vars_login( $vars ){
	$vars[] = 'status';
	return $vars;
}

add_filter( 'query_vars', 'add_query_vars_login' );

/**
 * Redirect failed login to referrer page
 */

function my_front_end_login_fail( $username ) {
	// Check if referer is present
	if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
		$referrer = esc_url( $_SERVER['HTTP_REFERER'] );
	}
	// if there's a valid referrer, and it's not the default log-in screen
	if ( ! empty( $referrer ) && ! strstr( $referrer,'wp-login' ) && ! strstr( $referrer,'wp-admin' ) ) {
		wp_redirect( esc_url_raw( add_query_arg( array( 'status' => 'failed' ), $referrer ) ) );
		exit;
	}
}

add_action( 'wp_login_failed', 'my_front_end_login_fail' );

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
