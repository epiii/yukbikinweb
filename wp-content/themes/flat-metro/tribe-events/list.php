<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views 
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } 
 get_header(); ?>


  <div class="l-main">
    <header class="l-header row" role="banner">
      <div class="row menu-row">
        <div class="large-5 columns">
          <h1 class="site-name"><a title="Flat Metro Home" rel="home" href=" <?php echo home_url(); ?> "><?php bloginfo(); ?></a></h1>
        </div>
        <div class="large-7 columns menu-button text-right">
        <?php echo header_menu() ?></div>
      </div>
    </header>
    <div class="page-title">
      <div class="row">
        <div class="large-8 columns">
          <!-- List Title -->
          <?php do_action( 'tribe_events_before_the_title' ); ?>
          <h2> <?php echo tribe_get_events_title() ?></h2>
          <?php do_action( 'tribe_events_after_the_title' ); ?> 
        </div>
        <div class="large-4 columns"><?php wd_breadcrumb(); ?></div>
      </div>
    </div> 
       
    <main class="row l-main" role="main">
      
      
      
<?php do_action( 'tribe_events_before_template' ); ?>



<!-- Main Events Content -->
<?php tribe_get_template_part( 'list/content' ); ?>

<div class="tribe-clear"></div>

<?php do_action( 'tribe_events_after_template' ) ?>