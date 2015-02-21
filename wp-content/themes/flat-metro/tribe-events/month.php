<?php
/**
 * Month View Template
 * The wrapper template for month view. 
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } 
 get_header(); ?>


  <div class="row l-main">
    <header class="l-header row" role="banner">
      <div class="row menu-row">
        <div class="large-5 columns">
          <h1 class="site-name"><a title="Flat Metro Home" rel="home" href=" <?php echo home_url(); ?> "><?php bloginfo('description'); ?></a></h1>
        </div>
        <div class="large-7 columns menu-button text-right">
        <?php echo header_menu() ?></div>
      </div>
    </header>
    <main class="row l-main" role="main">
      




<!-- Main Events Content -->
<?php tribe_get_template_part( 'month/content' ); ?>

<div class="tribe-clear"></div>

<?php do_action( 'tribe_events_after_template' ) ?>
