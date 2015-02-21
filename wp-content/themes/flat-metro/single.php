<?php get_header();?>

<?php
  ////////////////////*    AJAX Request     *////////////////
  if( ! empty( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) &&
  strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ]) == 'xmlhttprequest' ) { ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <div id="content">
        <i class="fa-times fa back"></i>
        <div class="row">
          <div class="large-11 columns">
            <h2 class="project-title"><?php the_title(); ?></h2>  </div>
          <div class="large-6 columns">
            <div class="project-images">
              <div class="item-list">
                <ul class="">
                  <li>
                      <?php  the_post_thumbnail( 'project-thumb' );  ?> 
                  </li>
                </ul>
              </div>
            </div>  
          </div>
          <div class="large-6 columns project-content">
            <?php the_content(); ?>
          </div>
          
        </div>
      </div> 
      <?php endwhile; 
    
  }else{ 
   ////////////////////*    Standard Request     *////////////////   ?>      
  <div class="l-main">
  	<header class="l-header row" role="banner">
      <div class="row menu-row">
        <div class="large-5 columns">
          <h1 class="site-name"><a title="Flat Metro Home" rel="home" href=" <?php echo home_url(); ?> "><?php bloginfo();?></a></h1>
        </div>
        <div class="large-7 columns menu-button text-right">
        <?php echo header_menu() ?></div>
      </div>
    </header>
    
    <div class="page-title">
      <div class="row">
        <div class="large-8 columns"><h2><?php the_title(); ?> </h2> </div>
        <div class="large-4 columns"><?php wd_breadcrumb(); ?></div>
      </div>
    </div>
    
    <main class="row l-main" role="main">
      <div class="large-9 main columns" id="content">
        <?php
  			wp_reset_query();
  			while(have_posts()):the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php if ( has_post_thumbnail() ) { ?>
            <?php  the_post_thumbnail( 'blog-thumb' );  ?>
          <?php } ?>
          <h2 class="post-title">
            <?php if( get_post_type() == 'post' && has_post_thumbnail() ): ?>
              <div class="user-picture">
              <?php echo get_avatar( get_the_author_meta('email'), 60); ?>
              </div>
            <?php endif; ?>
          </h2>
          <div class="body field">
          	<?php the_content() ?>
          </div>
          <div class="post-info"> 
              <span class="post-date"><i class="fa-calendar fa"></i> <?php the_date(); ?></span>
              <span class="post-author"><i class="fa-user fa"></i> <?php the_author() ?></span>
              
              <?php if(has_tag()){ ?>
                <span class="post-tags"><i class="fa-tag fa"></i> <?php the_tags() ?></span>
              <?php } ?>
              
              <?php if(has_category()){ ?>
                <span class="post-categories"><i class="fa-folder fa"></i> Categories: <?php the_category() ?></span>
              <?php } ?>
          </div>
           
          <?php if (comments_open()){
                  comments_template( '', true ); 
                } ?>
          
        </article>
        <?php endwhile; ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', THEME_NAME ), 'after' => '</div>' ) ); ?>
      </div>
      <?php get_sidebar(); ?>
    </main>
  </div>
  <?php get_footer();
} ?>