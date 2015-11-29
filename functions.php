<?php
/**
 * slouchy functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package slouchy
 */

if ( ! function_exists( 'slouchy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function slouchy_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on slouchy, use a find and replace
   * to change 'slouchy' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'slouchy', get_template_directory() . '/languages' );

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

  // This theme uses wp_nav_menu() in two locations.
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary Menu', 'slouchy' ),
    'mobile'  => esc_html__( 'Mobile Menu', 'slouchy' )
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
  add_theme_support( 'custom-background', apply_filters( 'slouchy_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
}
endif; // slouchy_setup
add_action( 'after_setup_theme', 'slouchy_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function slouchy_widgets_init() {

  register_sidebar( array(
    'name'          => esc_html__( 'Page Sidebar', 'slouchy' ),
    'id'            => 'page-sidebar',
    'description'   => '',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebars(4, array('id'=>'footer-sidebar', 'name'=>'Footer Sidebar %d', 'before_widget'=>'<aside>','after_widget'=>'</aside>'));
}
add_action( 'widgets_init', 'slouchy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function slouchy_scripts() {
  wp_enqueue_style( 'slouchy-style', get_stylesheet_uri() );
  wp_enqueue_script( 'app-script', get_template_directory_uri() . '/app.js', '', '20151005', true ); 

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'slouchy_scripts' );

/**
 * Remove admin bar from view
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';