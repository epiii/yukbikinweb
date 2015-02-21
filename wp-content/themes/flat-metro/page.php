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
        <?php
				wp_reset_query();
				while(have_posts()):the_post(); ?>
          <article typeof="sioc:Post sioct:BlogPost" class="node node-blog node-promoted view-mode-full" id="node-15">
            <?php  the_post_thumbnail( 'blog-thumb' );  ?>
              <h2 class="node-title" datatype="" property="dc:title">
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" 
                  rel="bookmark"><?php the_title(); ?></a>
              </h2>
            <div class="body field">
            	<?php the_content() ?>
            </div>
            <?php
          if(get_the_tag_list()) {?>
            <div class="field field-name-field-blog-tags field-type-taxonomy-term-reference field-label-above field-wrapper clearfix">
            	<h2 class="field-label">Tags: </h2>
              <?php   echo get_the_tag_list('<ul class="links"><li class="taxonomy-term-reference-0">', '</li><li class="taxonomy-term-reference-0">', '</li></ul>'); ?>
  
            </div>
          <?php } ?>
          <?php if (comments_open()){
                 comments_template(); 
                } ?> 
        </article>
        <?php endwhile;?>
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