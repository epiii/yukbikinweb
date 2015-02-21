<?php 

function portfolio_Code($atts) {
  
  $atts = shortcode_atts(
            array(
              'columns' => 3,
              'itemperpage' => 16,
              'category'  => ''
            ), 
            $atts);
            
  extract( shortcode_atts( array(
    'columns' => 3,
    'itemperpage' => 16,
    'category'  => ''
  ), $atts ) );
  
  $category = (is_array(unserialize($category))) ? array_values(unserialize($category)) : '';
  
  ob_start(); ?>
  
  <div class="row portfolio-page">    
    <div class="hide" id="project-info"></div>
    <ul class="small-block-grid-1 large-block-grid-<?php echo $columns; ?>">
      
      <?php 
      $tax_query = ($category != '') ? array('taxonomy' => 'projet', 'field' => 'term_id', 'terms' => $category)   :   '';
      
      $loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $itemperpage,
                                  'tax_query' => array(
                                    $tax_query
                                  )));
        if($loop->have_posts()) :                         
          while ( $loop->have_posts() ) : $loop->the_post();  ?>      
           <li class="article portfolio-item" id="<?php the_ID();  ?>">
            <figure>
              <?php  the_post_thumbnail( 'project-thumb' );  ?>  
              <figcaption class="text-center">
              <h3><?php the_title(); ?></h3>
              </figcaption>
            </figure>
            <span class="plus-icon flipOutX"><i class="fa-plus fa"></i></span>
          </li>            
          <?php  endwhile;
        else:
          echo "<br><br><br>";
          echo _e('No posts found in this category');
        endif;?> 
    </ul>
  </div>
<?php return ob_get_clean();
}
add_shortcode( 'portfolio', 'portfolio_Code' );