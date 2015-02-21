<?php
/*/////////////////////////////   Global Variables  //////////////////////////////////////*/
$themename = "Flat_metro";
$themefolder = "falt-metro";

define ('THEME_NAME', $themename );
define ('theme_version' , 1 );

load_theme_textdomain( THEME_NAME, get_template_directory().'/languages' );


global $wd_tiles;
if( !(get_option('tiles') === FALSE) ) { 
  $wd_tiles = get_option('tiles');
}else {
  $wd_tiles = array();
}

/*---------------------------------- Includes -------------------------------------------------------*/
define( 'ACF_LITE', true );
include_once('lib/advanced-custom-fields/acf.php');


// Webdeiva tools
include_once( 'inc/tools.php' );
/*** Theme settings Panel */
require_once('inc/panel.php');
include_once( 'inc/menu-header.php' );
/*** Custom post types */
include_once ('inc/post-types.php');
/*** Meta Boxes  */
include_once ('inc/meta-boxes/box-icon.php');
include_once ('inc/meta-boxes/projet-slider.php');
/*** Shortcodes */
include_once( 'inc/shortcodes/wd_blog.php' );
include_once( 'inc/shortcodes/wd_portfolio.php' );
include_once( 'inc/shortcodes/wd_team.php' );

include_once( 'inc/section-pages.php' );



/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/lib/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 */
function my_theme_register_required_plugins() {

  /*** Array of plugin arrays. Required keys are name and slug. */
  $plugins = array(

    array(
      'name'            => 'Webdevia Latest Tweets',
      'slug'            => 'wd-tweets',
      'source'          => get_stylesheet_directory() . '/lib/plugins/wd-tweets.zip', 
      'required'        => true,
      'version'         => '',
      'force_activation'    => true,
      'force_deactivation'  => true,
    ),
    array(
      'name'                => 'Webdevia Latest Tweets',
      'slug'                => 'wd-ajax-load',
      'source'              => get_stylesheet_directory() . '/lib/plugins/wd-ajax-load.zip', // The plugin source
      'required'            => true,
      'force_activation'    => true,
      'force_deactivation'  => true,
    ),
    array(
      'name'    => 'Font Awesome 4 Menus',
      'slug'    => 'font-awesome-4-menus',
      'required'  => true,
      'force_activation'    => true,
    ),
  );

  $config = array(
    'domain'          => THEME_NAME,          // Text domain - likely want to be the same as your theme.
    'default_path'    => '',                          // Default absolute path to pre-packaged plugins
    'parent_menu_slug'  => 'themes.php',        // Default parent menu slug
    'parent_url_slug'   => 'themes.php',        // Default parent URL slug
    'menu'            => 'install-required-plugins',  // Menu slug
    'has_notices'       => true,                        // Show admin notices or not
    'is_automatic'      => false,             // Automatically activate plugins after installation or not
    'message'       => '',              // Message to output right before the plugins table
    'strings'         => array(
      'page_title'                            => __( 'Install Required Plugins', THEME_NAME ),
      'menu_title'                            => __( 'Install Plugins', THEME_NAME ),
      'installing'                            => __( 'Installing Plugin: %s', THEME_NAME ), // %1$s = plugin name
      'oops'                                  => __( 'Something went wrong with the plugin API.', THEME_NAME ),
      'notice_can_install_required'           => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_install_recommended'      => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
      'notice_can_activate_required'          => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_activate_recommended'     => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
      'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
      'install_link'                  => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
      'activate_link'                 => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
      'return'                                => __( 'Return to Required Plugins Installer', THEME_NAME ),
      'plugin_activated'                      => __( 'Plugin activated successfully.', THEME_NAME ),
      'complete'                  => __( 'All plugins installed and activated successfully. %s', THEME_NAME ), // %1$s = dashboard link
      'nag_type'                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
    )
  );

  tgmpa( $plugins, $config );
}





add_action( 'init', 'wd_add_editor_styles' );
/**
* Apply theme's stylesheet to the visual editor.
*
* @uses add_editor_style() Links a stylesheet to visual editor
* @uses get_stylesheet_uri() Returns URI of theme stylesheet
*/
function wd_add_editor_styles() {
 
  add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
 
}






/*------------------------------- Create Featured Category -------------------------------------------*/
$arg = array('description' => "Featured Category", 'parent' => "cat_ID");
$new_cat_id = wp_insert_term("featured", "category", $arg);


/*------------------------------- Theme Supported Features -------------------------------------------*/
if(function_exists('add_theme_support')){
  add_theme_support('post-thumbnails');
  add_theme_support('custom-background');
  
  add_theme_support('automatic-feed-links');
  
  add_theme_support( 'woocommerce' );
}
  
add_image_size( 'blog-thumb',       800, 380, true );
add_image_size( 'blog-small-thumb', 280, 220, true );
add_image_size( 'project-thumb',    500, 380, true );
add_image_size( '400x400',          400, 400, true );
add_image_size( '400x300',          400, 300, true );
add_image_size( '780x380',          780, 380, true );
add_image_size( 'big-slider',       760, 322, true );


/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
  $content_width = 625;
  
//----------------------------------------
$defaults = array(
    'default-color' => '#3498DB',
    'default-image' => '',
    'wp-head-callback' => '_custom_background_cb',
    'admin-head-callback' => '',
    'admin-preview-callback' => ''
  );
add_theme_support( 'custom-background', $defaults );


// This theme uses wp_nav_menu() in two locations.  
register_nav_menus( array(  
  'primary' => __( 'Primary Navigation', THEME_NAME ),   
) );

//add the sidebar
if(function_exists('register_sidebar')) {
  register_sidebar(array('name'=>'sidebar',
    'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
    'after_widget' => '</div>',
    'before_title'=>'<h2 class="block-title">',
    'after_title'=>'</h2>'
  ));
  register_sidebar(array(
    'name' => 'Before Tiles',
    'id'   => 'before-tiles',
    'description'   => 'Put here widget you want to show before the tiles in start screen. note that you can also use shortcodes.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));
  register_sidebar(array(
    'name' => 'After Tiles',
    'id'   => 'after-tiles',
    'description'   => 'Put here widget you want to show after the tiles in start screen. note that you can also use shortcodes.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));
}
// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');
  
  
/*/////////////////////////////   Add classes for body  //////////////////////////////////////*/
add_filter('body_class','wd_body_classes');
function wd_body_classes($classes) {
  $classes[] = 'html front logged-in one-sidebar sidebar-second page-node';
  return $classes;
} 
/*/////////////////////////////   Add classes for Post  //////////////////////////////////////*/
add_filter('post_class','wd_post_classes');
function wd_post_classes($classes) {
  $classes[] = 'node node-blog clearfix';
  return $classes;
}



/*
 *  Return IDs of all pages with "show in star sreen" checked
 */ 
if( !function_exists('wd_get_page_id')){ 
  function wd_get_page_id(){
    $ids   = array();
    $pages = array();
    $pages = wd_get_posts_by_meta_key('wd_show_in_start', "1");
        
    foreach ($pages as $key => $page) {
      $ids[] = $page->ID;
    }    
    return $ids;
  }
}



/**
 * Add tiles links to the primary navigation
 */
if( !function_exists('wd_add_tiles_link')){
  function wd_add_tiles_link( $items, $args ){
    if($args->theme_location == 'primary'){      
      $tiles = wd_get_posts_by_meta_key('wd_show_in_start', '1');
      
      global $wd_tiles;
      $exist_in_screen = FALSE;
      
      $items .= '<li><a href="'. home_url() .'/#home">
                          <i class="fa-home fa"></i>'. __('Home', THEME_NAME) .'</a></li>';

      foreach ($tiles as $key => $tile) {
        // look if the tile of this page is display in the start screen
        foreach ($wd_tiles as $key => $wd_tile) {
          if( $wd_tile['tile type'] == 'page' && $wd_tile['id'] == $tile->ID ){
            $exist_in_screen = TRUE;
          }
        }
    
        if( $exist_in_screen ){                        
            $items .= '<li><a href="'. home_url() .'/#'. mb_convert_encoding(str_replace(' ', '', $tile->post_title), "EUC-JP", "auto") .'">
                          <i class="'. get_post_meta( $tile->ID , 'wd_icon', true ) .' fa color--'. $tile->ID .'  "></i>'. 
                          $tile->post_title .'</a></li>';
        }
      }
    }
    return $items;
  }
  add_filter( 'wp_nav_menu_items', 'wd_add_tiles_link', 10, 2);
}
 




if(!function_exists('wd_generate_styles')){
  
  function wd_generate_styles() {
   /* Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).*/
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );
  
   
  /*** Google fonts ****/
  wp_enqueue_style('google-fonts','http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' ); 
  
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  if ( ! is_plugin_active( 'font-awesome-4-menus/n9m-font-awesome-4.php' ) ) {
    wp_enqueue_style('font-awesome',  "//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
  }


  wp_enqueue_style('foundation',      get_template_directory_uri() . "/css/foundation.min.css");
  wp_enqueue_style('animations',      get_template_directory_uri() . "/css/animations.css");

  wp_enqueue_style('custom-style',    get_template_directory_uri() . '/style.css');
  if(is_child_theme()){
    wp_enqueue_style('shild-custom-style',    get_stylesheet_uri() );
  }
  
  wp_enqueue_style('responsiveslides',get_template_directory_uri() . "/css/responsiveslides.css");
  wp_enqueue_style('reponsive',       get_template_directory_uri() . "/css/reponsive.css");
  wp_enqueue_style('animate-custom',  get_template_directory_uri() . "/css/animate-custom.css");
  wp_enqueue_style('woocommerce',     get_template_directory_uri() . "/css/woocommerce.css");
  
  
  
  
  wp_enqueue_script('custom.modernizr', get_template_directory_uri() . "/js/vendor/custom.modernizr.js", array( 'jquery' ) );
  wp_enqueue_script('foundation',       get_template_directory_uri() . "/js/foundation.min.js", array( 'jquery' ) );
  wp_enqueue_script('modernizr-custom', get_template_directory_uri() . "/js/modernizr.custom.js", array( 'jquery' ) );
  wp_enqueue_script('foundation-section', get_template_directory_uri() . "/js/foundation/foundation.section.js", array( 'jquery' ) );
  wp_enqueue_script('responsiveslides', get_template_directory_uri() . "/js/responsiveslides.js", array( 'jquery' ) );
  wp_enqueue_script('scripts',          get_template_directory_uri() . "/js/scripts.js", array( 'jquery' ) );
  
   
  
  global $wd_tiles;
  $custom_css = '';
  
  foreach ($wd_tiles as $key => $wd_tile) {
    if(isset($wd_tile['color'])){
      $custom_css .= " .color-$key {
        background-color: " . $wd_tile['color'] . ";
      }";
    }
  }
  
  foreach ($wd_tiles as $key => $wd_tile) {
    if(isset($wd_tile['wdtile_bg'])){
      $custom_css .= " .color-$key {
        background-image: url('" . $wd_tile['wdtile_bg'] . "');
      }";
    }
  }
    
    
  $pages = wd_get_posts_by_meta_key('wd_show_in_start', "1");
      
  foreach ($pages as $key => $page) {
    $ids[] = $page->ID;
    
    $wd_page_bg_img = get_post_meta($page->ID, 'wd_page_bg_img', true);
    $wd_page_bg_img = wp_get_attachment_image_src( $wd_page_bg_img, 'full' );
  
    $custom_css .= " .page-section-".$page->ID.", .menu-list li a .color--".$page->ID." {
      background-color: " . get_post_meta($page->ID, 'wd_page_color_bg', true) . ";
      background-image: url($wd_page_bg_img[0]);
      color:      " . get_post_meta($page->ID, 'wd_page_color', true) . ";
    }";
    
    $wd_page_bg_img = "";
  } 
  
  
  global $wp_query;
  $thePageID = $wp_query->post->ID;
  
  $wd_page_bg_img = get_post_meta($thePageID, 'wd_page_bg_img', true);
  $wd_page_bg_img = wp_get_attachment_image_src( $wd_page_bg_img, 'full' ); 
  
  $custom_css .= ".page-section.home-page {
      background: url($wd_page_bg_img[0]) " . get_post_meta($thePageID, 'wd_page_color_bg', true) . ";
      color:      " . get_post_meta($thePageID, 'wd_page_color', true) . ";
      background-size: cover;
    }";
  
  if( !isset($_GET['op']) || $_GET['op'] != "Search" ){  
    $custom_css .= ".site-name a,
      .showMenu,
      .showMenu a,
      a {
        color:      " . get_post_meta($thePageID, 'wd_page_color', true) . ";
      } ";
  }
  
  // set link color to page text color if the page should be displed in the startscreen
  $wd_show_in_start = get_post_meta($thePageID, 'wd_show_in_start');
  if( $wd_show_in_start == 1 ){
    $custom_css .= "a {
        color:      " . get_post_meta($thePageID, 'wd_page_color', true) . ";
      } ";
  }
    
  
  // Menu Background
  $custom_css .= ".vertical-menu {
    background:      " . get_option('wd_menu_bg') . ";
  } 
  .vertical-menu .menu-list a:hover, 
  .vertical-menu .menu-list a.active {
    background: " . get_option('wd_menu_ahover_bg') . ";
  }
  .vertical-menu li ul, .vertical-menu li ul li ul {
    background: " . get_option('wd_menu_submenu_bg') . ";
  }";
        
   wp_add_inline_style( 'custom-style', $custom_css );
   
  }
  add_action( 'wp_enqueue_scripts', 'wd_generate_styles' );  
}

