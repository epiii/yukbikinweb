<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

  <div id="primary" class="site-content row">
    <header class="l-header row" role="banner">
      <div class="row menu-row">
        <div class="large-5 columns">
          <h1 class="site-name"><a title="Flat Metro Home" rel="home" href=" <?php echo home_url(); ?> "><?php bloginfo() ?></a></h1>
        </div>
        <div class="large-7 columns menu-button text-right">
        <?php echo header_menu() ?></div>
      </div>
    </header>
    <div id="content" role="main">

      <article id="404-page" class="large-6 large-offset-3 small-12 small-offset-0 post error404 no-results not-found">
        
        <h2 class="sad-smile">:(</h2>
        
        <header class="entry-header">
          <h3 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentytwelve' ); ?></h3>
        </header>

        <div class="entry-content">
          <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentytwelve' ); ?></p>
          
          <?php get_search_form(); ?>
        </div><!-- .entry-content -->
      </article><!-- #post-0 -->

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_footer(); ?>