<?php get_header(); ?>

<div class="pt-perspective box1">
  <div class="row l-main">
  	<header class="l-header row" role="banner">
  
            <!--.top-bar -->
        <div class="row menu-row">
          <div class="large-5 columns">
            <h1 class="site-name"><a title="Flat Metro Home" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">Flat Metro</a></h1>
          </div>
          <div class="large-7 columns menu-button text-right">
          <?php echo header_menu() ?></div>
        </div> 
        <!--/.top-bar -->
      
      <!-- Title, slogan and menu -->
          <!-- End title, slogan and menu -->
  
    </header>
  
    <main class="row l-main" role="main">
      <div class="large-9 main columns small-display search-result">
      <?php
				 wp_reset_query();
				if(have_posts()): 
  				while(have_posts()):the_post(); ?>          
          <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="large-4 columns p-all-0">
              <?php  the_post_thumbnail( 'blog-small-thumb' );  ?> 
            </div>
            <?php } ?>
            
            <div class="<?php if( has_post_thumbnail() ) echo "large-8"; else echo "large-12"; ?> columns p-all-0">
              <h2 class="post-title" datatype="" property="dc:title">
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" 
                  rel="bookmark"><?php the_title(); ?></a>
              </h2>
              <div class="post-info"> 
                <span class="post-date"><i class="fa-calendar fa"></i> <?php the_date(); ?></span>
                <span class="post-author"><i class="fa-user fa"></i><?php the_author() ?></span>
                <span class="post-tags"><i class="fa-calendar fa"></i><?php the_tags() ?></span>
              </div>
                
              <div class="body field">
                <?php  the_excerpt() ?>
              </div>
              <div>
                <button class="small right"><?php echo __("Read more", THEME_NAME); ?></button>
              </div>
          </div> 
        </article>
          <?php endwhile;
        else : ?>
      	 <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
				<?php endif; ?>
     </div>
       
       <?php get_sidebar(); ?>
    </main>
  </div>
</div>
<?php get_footer(); ?>
