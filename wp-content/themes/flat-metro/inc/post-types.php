<?php 
//----------------------- Custom type Testimonials -----------------
if( ! function_exists('webdevia_testimonials_posttype')):
  function webdevia_testimonials_posttype() {
    register_post_type( 'testimonials',
      array(
        'labels' => array(
          'name' => __( 'Testimonials', THEME_NAME ),
          'singular_name' => __( 'testimonial', THEME_NAME ),
          'add_new' => __( 'Add New Testimonial', THEME_NAME ),
          'add_new_item' => __( 'Add New Testimonial', THEME_NAME ),
          'edit_item' => __( 'Edit Testimonial', THEME_NAME ),
          'new_item' => __( 'Add New Testimonial', THEME_NAME ),
          'view_item' => __( 'View Testimonial', THEME_NAME ),
          'search_items' => __( 'Search Testimonial', THEME_NAME ),
          'not_found' => __( 'No Testimonials found', THEME_NAME ),
          'not_found_in_trash' => __( 'No Testimonials found in trash', THEME_NAME )
        ),
        'public' => true,
        'supports' => array( 'title', 'excerpt'),
        'capability_type' => 'post',
        'rewrite' => array("slug" => "testimonials"), // Permalinks format
        'menu_position' => 5
      )
    );
  }
  add_action( 'init', 'webdevia_testimonials_posttype' );
endif;


//----------------------- Custom type portfolio -----------------
if( ! function_exists('webdevia_portfolio_posttype')): 
  function webdevia_portfolio_posttype() {
    register_post_type( 'portfolio',
      array(
        'labels' => array(
          'name' => __( 'Portfolio', THEME_NAME ),
          'singular_name' => __( 'portfolio', THEME_NAME ),
          'add_new' => __( 'Add New Portfolio Item', THEME_NAME ),
          'add_new_item' => __( 'Add New Portfolio Item', THEME_NAME ),
          'edit_item' => __( 'Edit portfolio', THEME_NAME ),
          'new_item' => __( 'Add New Portfolio Item', THEME_NAME ),
          'view_item' => __( 'View Portfolio Item', THEME_NAME ),
          'search_items' => __( 'Search Portfolio Item', THEME_NAME ),
          'not_found' => __( 'No Portfolio Item found', THEME_NAME ),
          'not_found_in_trash' => __( 'No Portfolio Item found in trash', THEME_NAME )
        ),
        'public' => true,
        'supports' => array( 'title', 'thumbnail', 'comments','editor'),
        'capability_type' => 'post',
        'rewrite' => array("slug" => "portfolio"), // Permalinks format
        'menu_position' => 5
      )
    );
    register_taxonomy( 'projet', 'portfolio', array( 'hierarchical' => true,
                               'label' => 'categories', 
                               'query_var' => true, 
                               'rewrite' => true ) );
  }
  add_action( 'init', 'webdevia_portfolio_posttype' );
endif;

//----------------------- Custom type Team Member -----------------
if( ! function_exists('webdevia_teammember_posttype')): 
  function webdevia_teammember_posttype() {
    register_post_type( 'team-member',
      array(
        'labels' => array(
          'name' => __( 'Team Members', THEME_NAME ),
          'singular_name' => __( 'team member', THEME_NAME ),
          'add_new' => __( 'Add New Team Member', THEME_NAME ),
          'add_new_item' => __( 'Add New Team Member', THEME_NAME ),
          'edit_item' => __( 'Edit Team Member', THEME_NAME ),
          'new_item' => __( 'Add New Team Member', THEME_NAME ),
          'view_item' => __( 'View Team Member', THEME_NAME ),
          'search_items' => __( 'Search Team Member', THEME_NAME ),
          'not_found' => __( 'No Team Member found', THEME_NAME ),
          'not_found_in_trash' => __( 'No Team Member found in trash', THEME_NAME )
        ),
        'public' => true,
        'supports' => array( 'title'),
        'capability_type' => 'post',
        'rewrite' => array("slug" => "team-member"), // Permalinks format
        'menu_position' => 5
      )
    );
    /*register_taxonomy( 'projet', 'portfolio', array( 'hierarchical' => true,
                               'label' => 'categories', 
                               'query_var' => true, 
                               'rewrite' => true ) );*/
  }
  add_action( 'init', 'webdevia_teammember_posttype' );
endif;



//----------------------- Custom type Slider -----------------
if( ! function_exists('webdevia_slidervideo_posttype')){
  function webdevia_slidervideo_posttype() {
    register_post_type( 'slider_video',
      array(
        'labels' => array(
          'name' => __( 'slider' ),
          'singular_name' => __( 'slider' )
        ),
      'public' => true,
      'has_archive' => true,
      )
    );
  }
  add_action( 'init', 'webdevia_slidervideo_posttype' );
}




if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_information',
    'title' => 'Information',
    'fields' => array (
      array (
        'key' => 'field_5319df9acce0e',
        'label' => 'Job Title',
        'name' => 'job_title',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5319e2214b6ff',
        'label' => 'Picture',
        'name' => 'pciture',
        'type' => 'image',
        'save_format' => 'object',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
      array (
        'key' => 'field_5319e260fe394',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'formatting' => 'br',
      ),
      array (
        'key' => 'field_532d7d9b756d0',
        'label' => 'Is Boss',
        'name' => 'is_boss',
        'type' => 'true_false',
        'instructions' => 'If this checked the picture of this member will be use in the homepage.',
        'message' => '',
        'default_value' => 0,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'team-member',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}


//  --------- slider--------------
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_slider-type',
    'title' => 'Slider type',
    'fields' => array (
      array (
        'key' => 'field_53739de6b0509',
        'label' => 'Slider Type',
        'name' => 'slider_type',
        'type' => 'radio',
        'required' => 1,
        'choices' => array (
          'Image slider' => 'Image slider',
          'Video slider' => 'Video slider',
        ),
        'other_choice' => 0,
        'save_other_choice' => 0,
        'default_value' => '',
        'layout' => 'vertical',
      ),

      array (
        'key' => 'field_53739e2ab050a',
        'label' => 'Picture',
        'name' => 'picture',
        'type' => 'image',
        'save_format' => 'object',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
      array (
        'key' => 'field_53839139766c1',
        'label' => 'description',
        'name' => 'description',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => 'Description',
        'maxlength' => '',
        'formatting' => 'br',
      ),
      array (
        'key' => 'field_5379cb721f3c6',
        'label' => 'URL',
        'name' => 'url',
        'type' => 'text',
        'default_value' => 'http://',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'slider_video',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}









?>