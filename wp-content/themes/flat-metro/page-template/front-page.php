<?php
/*
Template Name: Start Screan
*/
?>


<?php get_header(); ?>

<div id="spaces-main" class="pt-perspective">
  <section class="page-section home-page">
    <div class="row metro-panel">
      <div class="large-12 columns">
        <div class="row menu-row">
          <div class="large-8 columns">
            <h1 class="site-name">
              
              <?php if(get_option('wd_show_logo') == 'on' && get_option('wd_logo') != ''): ?>
                <a href=" <?php echo home_url(); ?> " title="Home" rel="home" id="logo"> 
                  <img src="<?php print get_option('wd_logo'); ?>" height="<?php echo get_custom_header() -> height; ?>" width="<?php echo get_custom_header() -> width; ?>" alt="Home" />
               </a>
               <?php endif; ?>
               <a href=" <?php echo home_url(); ?> "><?php bloginfo(); ?></a>
            </h1>
          </div>
          <div class="large-4 columns menu-button text-right">
            <a class="showMenu"><i class="fa-bars fa icon-x back"></i></a>
            <a class="showMenu search"><i class="fa-search fa icon-x back"></i></a>
          </div>
        </div>
        <div class="row">
          <?php global $wd_tiles; ?>
          

          <div id="before-tiles" class="large-12 columns">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('before-tiles')) : endif; ?>         
          </div>
           
                     
          <div class="four large-<?php if(wd_is_third($wd_tiles)) echo "4"; else echo "8"; ?> columns">
            <div class="row">
              <?php //wd_dsm($wd_tiles)
              foreach ($wd_tiles as $key => $tile) {
                if ( isset($tile['column']) && $tile['column'] == 1) {
                  if(wd_is_third($wd_tiles)){
                    print wd_get_tile_html( $key );
                  }else{
                    print wd_get_tile_html( $key , 1 );
                  }
                }
              }
              ?>           
            </div>
          </div>           
          <div class="four large-4 columns">
            <div class="row">
              <?php 
              foreach ($wd_tiles as $key => $tile) {
                if ( isset($tile['column']) && $tile['column'] == 2) {
                  print wd_get_tile_html( $key ); 
                }
              }
              ?>           
            </div>
          </div> 
          
          <?php if(wd_is_third($wd_tiles)){ ?>
            <div class="four large-4 columns">
              <div class="row">
                <?php 
                foreach ($wd_tiles as $key => $tile) {
                  if ( isset($tile['column']) && $tile['column'] == 3) {
                    print wd_get_tile_html( $key ); 
                  }
                }
                ?>           
              </div>
            </div>
          <?php } ?>
          
          <div id="after-tiles" class="large-12 columns">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('after-tiles')) : endif; ?>         
          </div>
                    
        </div>
        <div class="copyright"> <?php 
          $copyright = get_option('wd_copyright');
          $copyright = (!empty($copyright)) ?  get_option('wd_copyright') : '&copy; 2013 Flat Metro All rights reserved.';
          echo $copyright; ?></div>
      </div>
    </div>
  </section>      
  
  <?php
  /////// Generate Section  //////////
  foreach ($wd_tiles as $key => $wd_tile) {
    switch ($wd_tile['tile size']) {
      case 'medium':
        if($wd_tile['tile type'] == "page")
          print wd_get_section( $wd_tile['id'] );
        break;
    }
  } ?>
</div>

<?php get_footer();