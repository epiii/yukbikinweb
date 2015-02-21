<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 * 
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }


 get_header(); ?>



    <header class="l-header row" role="banner">
      <div class="row menu-row">
        <div class="large-5 columns">
          <h1 class="site-name"><a title="Flat Metro Home" rel="home" href=" <?php echo home_url(); ?> "><?php bloginfo(); ?></a></h1>
        </div>
        <div class="large-7 columns menu-button text-right">
        <?php echo header_menu() ?></div>
      </div>
    </header>

      
<?php $event_id = get_the_ID(); ?>

<div class="row">
  <main id="tribe-events-content" class="tribe-events-single large-9 columns">
  
  	<p class="tribe-events-back right"><a href="<?php echo tribe_get_events_link() ?>"> <?php _e( '&laquo; All Events', 'tribe-events-calendar' ) ?></a></p>
  
  	<!-- Notices -->
  	<?php tribe_events_the_notices() ?>
  
  
  	<!-- Event header -->
  	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
  		<!-- Navigation -->
  		<h3 class="tribe-events-visuallyhidden"><?php _e( 'Event Navigation', 'tribe-events-calendar' ) ?></h3>
  		<ul class="tribe-events-sub-nav">
  			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '&laquo; %title%' ) ?></li>
  			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% &raquo;' ) ?></li>
  		</ul><!-- .tribe-events-sub-nav -->
  	</div><!-- #tribe-events-header -->
  
  	<?php while ( have_posts() ) :  the_post(); ?>
  		<div id="post-<?php the_ID(); ?>" <?php post_class('vevent'); ?>>
  			<!-- Event featured image -->
  			<?php echo tribe_event_featured_image( get_the_ID(), 'blog-thumb' ); ?>
  
    <div class="tribe-events-schedule updated published tribe-clearfix">
      <h3><?php echo tribe_events_event_schedule_details(); ?></h3>
      <?php echo tribe_events_event_recurring_info_tooltip(); ?>
      <?php  if ( tribe_get_cost() ) :  ?>
        <span class="tribe-events-divider">|</span>
        <span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
      <?php endif; ?>
    </div>
    
        <?php the_title( '<h2 class="tribe-events-single-event-title node-title">', '</h2>' ); ?>
  
  			<!-- Event content -->
  			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
  			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
  				<?php the_content(); ?>
  			</div><!-- .tribe-events-single-event-description -->
  			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
  
  			<!-- Event meta -->
  			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
    				<?php echo tribe_events_single_event_meta() ?>
  			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
  			</div><!-- .hentry .vevent -->
  		<?php if( get_post_type() == TribeEvents::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
  	<?php endwhile; ?>
  
  	<!-- Event footer -->
      <div id="tribe-events-footer">
  		<!-- Navigation -->
  		<!-- Navigation -->
  		<h3 class="tribe-events-visuallyhidden"><?php _e( 'Event Navigation', 'tribe-events-calendar' ) ?></h3>
  		<ul class="tribe-events-sub-nav">
  			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '&laquo; %title%' ) ?></li>
  			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% &raquo;' ) ?></li>
  		</ul><!-- .tribe-events-sub-nav -->
  	</div><!-- #tribe-events-footer -->
  
  </main><!-- #tribe-events-content -->
  
  <?php get_sidebar(); ?>

</div>
