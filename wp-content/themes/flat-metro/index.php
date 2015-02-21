<?php get_header(); ?>


  <div class="l-main">
    <header class="l-header row" role="banner">
      <div class="row menu-row">
        <div class="large-5 columns site-name-div">
          <h1 class="site-name"><a title="Flat Metro Home" rel="home" href=" <?php echo home_url(); ?> "><?php bloginfo() ?></a></h1>
          <?php if(get_bloginfo('description') !=  ''): ?>
            <span> <?php echo get_bloginfo('description'); ?> </span>
          <?php endif; ?>
        </div>
        <div class="large-7 columns menu-button text-right">
        <?php echo header_menu() ?></div>
      </div>
    </header>
    
    
    <div class="page-title">
      <div class="row">
        <div class="large-8 columns">
          <h2>
          <?php if(is_category()){ 
              echo __('Category Archives', THEME_NAME); 
              echo ": ". strip_tags ( category_description() );
            }elseif( is_tag() ) {
              echo __('Tag Archives', THEME_NAME);
            }elseif( is_year() ){
              echo __('Yearly Archives', THEME_NAME);
            }elseif( is_month() ){
              echo __('Monthly Archives', THEME_NAME);
            }elseif( is_date() ){
              echo __('Daily Archives', THEME_NAME);
            }elseif( is_author() ){
              echo __('Author Archives', THEME_NAME);
            }
            if(is_archive() && !is_category())
              echo ':' ?>
            <?php 
            if(!is_category()){
               the_title(); 
             }?> 
          </h2> 
        </div>
        <div class="large-4 columns"><?php wd_breadcrumb(); ?></div>
      </div>
    </div>
    
    
    <main class="row l-main" role="main">
      <div class="large-9 main columns small-display" id="content">
        <?php
        wp_reset_query();
        while(have_posts()): the_post(); ?>
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
                <a href="<?php print get_permalink(); ?>"> <button class="small right"><?php echo __("Read more", THEME_NAME); ?></button> </a>
              </div>
          </div> 
        </article>
        <?php endwhile;?>
        <?php wd_content_nav( 'nav-below' ); ?>
      </div>
 
      <?php get_sidebar(); ?>
    </main>
  </div>

<?php get_footer(); ?>