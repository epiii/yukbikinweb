<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js"  <?php language_attributes(); ?> >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo get_option('wd_favicon'); ?>" />
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>

    <?php  wp_head(); ?>
    
  </head>
  <body  <?php body_class(); ?>>
    
    <?php $show_menu_onhover = get_option('wd_on_hover_show_menu');  
          $show_menu_inleft  = get_option('wd_show_menu_inleft'); 
    ?>
    
    <nav class="vertical-menu close 
        <?php 
        if( $show_menu_onhover == 'on') echo "on-hover-show "; 
        if( $show_menu_inleft == 'on')  echo "in-left ";  
        ?> ">
      <a class="showMenu"><i class="remove back"></i></a>
      
      <h3 class="text-center">
        <?php if(get_option('wd_show_logo') == 'on' && get_option('wd_logo') != ''): ?>
          <a href=" <?php echo home_url(); ?> " title="Home" rel="home" id="logo"> 
            <img src="<?php print get_option('wd_logo'); ?>" height="<?php echo get_custom_header() -> height; ?>" width="<?php echo get_custom_header() -> width; ?>" alt="Home" />
          </a>
         <?php endif; ?>
         <a href=" <?php echo home_url(); ?> "><?php bloginfo(); ?></a>
      </h3>
      
      <?php get_search_form() ?>
      <br/>
      <br/>
      
      <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu-list' ) ); ?>
      <ul class="social-icons inline-list">
        <?php if(get_option('flickr') != ''): ?>
          <li class="flickr"><a href="<?php echo get_option('flickr') ?>"><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?> 
        
        <?php if(get_option('google_plus') != ''): ?>
         <li class="google_plus"><a href="<?php echo get_option('google_plus') ?>"><i class="fa fa-google-plus"></i></a></li>
        <?php endif; ?>
        
        <?php if(get_option('twitter') != ''): ?>
          <li class="twitter"><a href="<?php echo get_option('twitter') ?>"><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>
        
        <?php if(get_option('facebook') != ''): ?>        
          <li class="facebook"><a href="<?php echo get_option('facebook') ?>"><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>        
      </ul>
    </nav>