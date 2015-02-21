<?php 


include_once (dirname (__FILE__) . '/tinymce/tinymce.php');
require_once (dirname (__FILE__) . '/tinymce/ajax.php');



add_action('init', 'add_button');

function add_button() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') ) {
     add_filter('mce_external_plugins', 'add_plugin');
     add_filter('mce_buttons',          'register_button');
   }
}

function register_button($buttons) {
   array_push($buttons, "quote");
   array_push($buttons, "portfolio");
   array_push($buttons, "blog");
   array_push( $buttons, 'mygallery' );
   array_push( $buttons, 'pricingtable' );
   array_push( $buttons, 'alertbox' );
   array_push( $buttons, 'wdbutton' );
   return $buttons;
}

function add_plugin($plugin_array) {
   $plugin_array['quote'] = get_template_directory_uri() . '/inc/js/customcodes.js';
   $plugin_array['portfolio'] = get_template_directory_uri() . '/inc/js/customcodes.js';
   $plugin_array['blog'] = get_template_directory_uri() . '/inc/js/customcodes.js';
   $plugin_array['mygallery'] = get_template_directory_uri() . '/inc/js/customcodes.js';
   $plugin_array['pricingtable'] = get_template_directory_uri() . '/inc/js/customcodes.js';
   $plugin_array['alertbox'] = get_template_directory_uri() . '/inc/js/customcodes.js';
   $plugin_array['wdbutton'] = get_template_directory_uri() . '/inc/js/customcodes.js';
   return $plugin_array;
}



add_shortcode("pricingtable", "pricingtable");
function pricingtable( $atts, $content = null ) {
  $atts = shortcode_atts(
          array(
            'columns' => 3,
            'itemperpage' => 16
          ), 
          $atts);
            
  extract( shortcode_atts( array(
    'columns' => 3,
    'itemperpage' => 16,
  ), $atts ) );
  
  
    return '<div class="right text">"'. do_shortcode($content) .'"</div>
    <ul class="pricing-table">
      <li class="title">Standard</li>
      <li class="price">$99.99</li>
      <li class="description">An awesome description</li>
      <li class="bullet-item">1 Database</li>
      <li class="bullet-item">5GB Storage</li>
      <li class="bullet-item">20 Users</li>
      <li class="cta-button"><a class="button" href="#">Buy Now</a></li>
    </ul>';
}

add_shortcode("wdbutton", "wdbutton");
function wdbutton( $atts, $content = null ) {
    return '<a href="#" class="button">'.$content.'"</a>';
}

add_shortcode("quote", "quote");
function quote( $atts, $content = null ) {
    extract( shortcode_atts( array(
    'author' => 3
      ), $atts ) );
    return '<blockquote>"'. do_shortcode($content) .'"<cite>' . $author . '</cite></blockquote>';
}

add_shortcode("alertbox", "alertbox");
function alertbox( $atts, $content = null ) {
    return '<div data-alert class="alert-box">
             ' . do_shortcode($content) . '
              <a href="#" class="close">&times;</a>
            </div>';
}



//--------------------------blog pages-----------------------
function blog_Code($atts) {
  
    $atts = shortcode_atts(
            array(
              'columns' => 3,
              'itemperpage' => 16,
              'category'  => '',
            ), 
            $atts);
            
  extract( shortcode_atts( array(
    'columns' => 3,
    'itemperpage' => 16,
    'category'  => '',
  ), $atts ) );
  
  $category = (is_array(unserialize($category))) ? array_values(unserialize($category)) : '';
  
  ob_start(); ?>
  
  <div class="row  blog-page">
    <div class="view view-blog view-id-blog">
      <div class="view-content"><!-- Poste -->
         <ul id="i-scroll" class="small-block-grid-1 large-block-grid-<?php echo $columns; ?>">            
        <?php 
      $tax_query = ($category != '') ? array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category)   :   '';
      
      $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $itemperpage,
                                  'tax_query' => array(
                                    $tax_query
                                  )));
        
        while ( $loop->have_posts() ) : $loop->the_post();  ?>  
            <li class="">        
              <article class="article">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'blog-thumb' ); ?></a>
                <div class="post-body">
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <p> <?php echo wp_trim_words( get_the_content(), 20 ); ?> </p>
                </div>
                </article>         
              </li>
          <?php endwhile; ?>        
        </ul>
      </div>
      <div class="more-link">  </div>
    </div>    
  </div>
  
  <?php return ob_get_clean();
}
add_shortcode( 'blog', 'blog_Code' ); ?>