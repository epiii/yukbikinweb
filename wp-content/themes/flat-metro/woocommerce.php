<?php get_header(); 

$show_sidebar = TRUE;

if(get_post_meta(get_the_ID(),'wd_show_sidebar',true) == "0"){ 
  $show_sidebar = FALSE;
}
?>


<div class="pt-perspective box1">
  <div class="row l-main">
  	<header class="l-header row" role="banner">
      <div class="row menu-row">
        <div class="large-5 columns">
          <h1 class="site-name"><a title="Flat Metro Home" rel="home" href=" <?php echo home_url(); ?> "><?php bloginfo(); ?></a></h1>
        </div>
        <div class="large-7 columns menu-button text-right">
        <?php echo header_menu() ?></div>
      </div>
    </header>
    <main class="row l-main <?php if($show_sidebar) echo "sbar"; ?>" role="main">
      <div class="<?php if($show_sidebar): echo "large-9"; else: echo "large-12"; endif; ?> main columns">
        <a id="main-content"></a>

				<?php woocommerce_content(); ?>
        
      </div>
 
      <?php
      
      if($show_sidebar): 
        get_sidebar(); 
      endif;
      ?>
    </main>
  </div>
</div>
<?php get_footer(); ?>