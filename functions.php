<?php
/**
 * slouchy functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package slouchy
 */

if ( ! function_exists( 'slouchy_setup' ) ) :
  function slouchy_setup() {

    load_theme_textdomain( 'slouchy', get_template_directory() . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );

    add_theme_support( 'post-formats', array(
      'aside',
      'image',
      'video',
      'quote',
      'link',
    ) );

    add_theme_support( 'custom-background', apply_filters( 'slouchy_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    ) ) );

    register_nav_menus( array(
      'primary' => esc_html__( 'Primary Menu', 'slouchy' ),
      'mobile'  => esc_html__( 'Mobile Menu', 'slouchy' )
    ) );
  }
endif; // slouchy_setup
add_action( 'after_setup_theme', 'slouchy_setup' );

// init widgets
function slouchy_widgets_init() {
  register_sidebars( 4, array(
    'id'=>'footer-sidebar', 
    'name'=>'Footer Sidebar %d', 
    'before_widget'=>'<aside>',
    'after_widget'=>'</aside>'
  ) );
}
add_action( 'widgets_init', 'slouchy_widgets_init' );

// enqueue styles and scripts
function mithy_scripts() {
  wp_enqueue_style( 'mithy-style', get_stylesheet_uri() );
  wp_enqueue_script( 'user-script', get_template_directory_uri() . '/js/user.js', array('jquery'), '20151005', true ); 

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'mithy_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';