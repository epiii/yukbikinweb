<?php
if( !function_exists('wd_get_tile_html')){
  function wd_get_tile_html( $position , $col_number=null ){
    global $wd_tiles;
    $link = '';  
    $page_title = '';
    $output = '';
    $color = '';
    
    if( isset($wd_tiles[$position]['color']) ){
      $color = $wd_tiles[$position]['color'];
    }
    
    if(!isset($wd_tiles[$position]['tile size'])){
      wd_dsm($position);
      wd_dsm($wd_tiles);
    }
    
    
    switch ($wd_tiles[$position]['tile size']) {
      case 'medium':
        $output = wd_get_medium_tile( $position , $col_number );       
        break;
        
      case 'wide':
        $output = wd_get_wide_tile($position, $col_number);

        break;

      case 'big':
        wd_get_big_tile( $position, $col_number);
        break;
        
      case 'small':
        wd_get_small_tile( $position );
        break;
        
        
      default:        
        break;
    }
    

                
    return $output;
  }
}


//--------------wide tile ---------------------
if( !function_exists('wd_get_wide_tile')){
  
  function wd_get_wide_tile( $position, $col_number){ 
    global $wd_tiles;
  //  wd_dsm($wd_tiles);
    
    switch ($wd_tiles[$position]['id']) {
      
      case 'feature_blog_post':
        if( $col_number == 1 ){ ?>
          <div class='twelve large-6 columns space featured blog-box medium'>
        <?php }else{ ?>
          <div class='twelve large-12 columns space featured blog-box medium'> 
        <?php } ?>
            <div class='color-$position'>                    
              <?php query_posts('category_name=featured');
                if(have_posts()):
                  the_post(); ?>
                  <span class='box-title anim'><?php isset($wd_tiles[$position]['title']) ? print $wd_tiles[$position]['title'] : print __('Featuread Posts', THEME_NAME); ?></span>
                  <span class='featured-image'><?php print the_post_thumbnail( '780x380' );   ?></span>
                  <span class='featured-box-title'><a href='<?php echo the_permalink(); ?>' ><?php echo the_title(); ?></a></span>
                <?php  else: ?>
                  <p><?php echo __('There\'s no featuread posts yet, please create posts in "featured" category  ', THEME_NAME) ?></p>
                <?php  endif; ?>
            </div>
          </div>
        <?php break; 
      
      case 'featured_project':
        if( $col_number == 1 ){ ?>
          <div class='twelve large-6 columns space featured blog-box medium'>
        <?php }else{ ?>
          <div class='twelve large-12 columns space featured blog-box medium'> 
        <?php } ?>
            <div class='color-$position'>                    
              <?php  $loop = new WP_Query( array( 'post_type' => 'portfolio' ));
                if(have_posts()):
                  the_post(); ?>
                  <span class='box-title anim'><?php isset($wd_tiles[$position]['title']) ? print $wd_tiles[$position]['title'] : print __('Featuread Projects', THEME_NAME); ?></span>
                  <span class='featured-image'><?php print the_post_thumbnail( '780x380' );   ?></span>
                  <span class='featured-box-title'><a href='<?php echo the_permalink(); ?>' ><?php echo the_title(); ?></a></span>
                <?php  else: ?>
                  <p><?php echo __('There\'s no featuread posts yet, please create project in "featured" category  ', THEME_NAME) ?></p>
                <?php  endif; ?>
            </div>
          </div>
        <?php break; 
            
          case 'testimonials':
          if ($col_number==1){
            print "<div class='twelve large-6 columns space testimonials-box medium'>
                <div class='color-$position'>
                  <span class='box-title anim'>". __('Testimonials', THEME_NAME) ."</span>
                  <ul class='testimonials'>";
                  $loop = new WP_Query( array( 'post_type' => 'testimonials', 'posts_per_page' => 10 ) );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        
            print  "<li>
                      <blockquote> ";
                          the_excerpt();  
            print        "<cite>"; the_title(); 
            print       "</cite>
                      </blockquote>
                    </li>";
                   endwhile;
            print "</ul>
                </div>
              </div>";
              }else{
            print "<div class='twelve large-12 columns space testimonials-box medium'>
                <div class='color-$position'>
                  <span class='box-title anim'>". __('Testimonials', THEME_NAME) ."</span>
                  <ul class='testimonials'>";
                  $loop = new WP_Query( array( 'post_type' => 'testimonials', 'posts_per_page' => 10 ) );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        
            print  "<li>
                      <blockquote> ";
                          the_excerpt();  
            print        "<cite>"; the_title(); 
            print       "</cite>
                      </blockquote>
                    </li>";
                   endwhile;
            print "</ul>
                </div>
              </div>";
              }
              
            break;
            
          case 'boss_pic':
          if ($col_number==1){
            print "<div class='twelve large-6 columns space featured medium'>
                <div class='color-$position'>";
                
                $loop = new WP_Query( array( 'post_type' => 'team-member', 'posts_per_page' => 10 ) );
                while ( $loop->have_posts() ) : $loop->the_post();
                  if(get_post_meta(get_the_ID(),'is_boss',true) == "1"){                           
                   print "<a href='#Team'>
                          <span class='box-title anim'>" . __('Our Team', THEME_NAME) . "</span>
                          <span class='featured-image'>";
                          
                    $post_thumbnail_id = get_post_meta(get_the_ID(), 'pciture', true);
                    print wp_get_attachment_image( $post_thumbnail_id, '780x380' ); 
                          
                    print "</span>
                        </a>";
                  }  
                 endwhile;
             print "</div>
              </div>";
              }else{
               print "<div class='twelve large-12 columns space featured medium'>
                <div class='color-$position'>";
                
                $loop = new WP_Query( array( 'post_type' => 'team-member', 'posts_per_page' => 10 ) );
                while ( $loop->have_posts() ) : $loop->the_post();
                  if(get_post_meta(get_the_ID(),'is_boss',true) == "1"){                           
                   print "<a href='#Team'>
                          <span class='box-title anim'>" . __('Our Team', THEME_NAME) . "</span>
                          <span class='featured-image'>";
                          
                    $post_thumbnail_id = get_post_meta(get_the_ID(), 'pciture', true);
                    print wp_get_attachment_image( $post_thumbnail_id, '780x380' ); 
                          
                    print "</span>
                        </a>";
                  }  
                 endwhile;
             print "</div>
              </div>"; 
              }
              
            break;
            
          case 'next_event':
            if ($col_number == 1){
            ?><div class='twelve large-6 columns space next-event-box medium'>
        <div class='color-<?php echo$position ?>'>
          <?php if (class_exists('TribeEvents')): ?>
            <span class="box-title"><i class="fa-calendar fa "></i></span>
            <span class="box-title anim"> &nbsp;  &nbsp;  &nbsp; <?php echo __( 'Next Events', THEME_NAME ); ?></span>
                                       
               <?php  
               
               $args = array(
                'post_type' => 'tribe_events',
                'nopaging' => 1,
                'post_status' => 'publish',
                'posts_per_page' => 10
              );
               $loop = new WP_Query( $args );
               //wd_dsm($loop);
               if($loop->found_posts > 0 ) { ?> 
                <ul class="testimonials rslides events"> 
                  <?php while ( $loop->have_posts() ) : $loop->the_post();  ?>      
                     <li>
                       <?php
                        $datetime = '';
                        if(isset($loop->query_vars['start_date']) && !empty($loop->query_vars['start_date'])){
                          $datetime  = new DateTime(get_post_meta(get_the_ID(), '_EventStartDate', true));
                        }                    
                        ?>
                      <h2 class="events_day">
                        <?php if(!empty($datetime)) echo $datetime->format('d'); ?>
                        <span><?php if(!empty($datetime)) echo $datetime->format('l'); ?></span>
                        </h2>
                      <a class="events_title" href="<?php the_permalink()  ?>"><?php the_title();  ?> </a>
                    </li> 
                  <?php endwhile; ?>
                 </ul>
                <?php }else {  ?>
                  
                  <p class="p-t-10"> <?php print __("There is no next event to show.", THEME_NAME); ?> </p>
                  <p><i class="fa fa-info-circle fa-3"></i></p>
                  
               <?php }?>              
              
            <?php else: ?>
              <p class="p-t-10"> <?php print __('The plugin "The Events Calendar" should be actived to use this tile, please enable it.', THEME_NAME); ?> </p>
              <p><i class="fa fa-exclamation-triangle fa-3"></i></p>
            <?php endif; ?>
        </div>
      </div> <?php           
             }else{
              ?><div class='twelve large-12 columns space next-event-box medium'>
        <div class='color-<?php echo$position ?>'>
          <?php if (class_exists('TribeEvents')): ?>
            <span class="box-title"><i class="fa-calendar fa "></i></span>
            <span class="box-title anim"> &nbsp;  &nbsp;  &nbsp; <?php echo __( 'Next Events', THEME_NAME ); ?></span>
                                       
               <?php  
               
               $args = array(
                'post_type' => 'tribe_events',
                'nopaging' => 1,
                'post_status' => 'publish',
                'posts_per_page' => 10
              );
               $loop = new WP_Query( $args );
               //wd_dsm($loop);
               if($loop->found_posts > 0 ) { ?> 
                <ul class="testimonials rslides events"> 
                  <?php while ( $loop->have_posts() ) : $loop->the_post();  ?>      
                     <li>
                       <?php
                        $datetime = '';
                        if(isset($loop->query_vars['start_date']) && !empty($loop->query_vars['start_date'])){
                          $datetime  = new DateTime(get_post_meta(get_the_ID(), '_EventStartDate', true));
                        }                    
                        ?>
                      <h2 class="events_day">
                        <?php if(!empty($datetime)) echo $datetime->format('d'); ?>
                        <span><?php if(!empty($datetime)) echo $datetime->format('l'); ?></span>
                        </h2>
                      <a class="events_title" href="<?php the_permalink()  ?>"><?php the_title();  ?> </a>
                    </li> 
                  <?php endwhile; ?>
                 </ul>
                <?php }else {  ?>
                  
                  <p class="p-t-10"> <?php print __("There is no next event to show.", THEME_NAME); ?> </p>
                  <p><i class="fa fa-info-circle fa-3"></i></p>
                  
               <?php }?>              
              
            <?php else: ?>
              <p class="p-t-10"> <?php print __('The plugin "The Events Calendar" should be actived to use this tile, please enable it.', THEME_NAME); ?> </p>
              <p><i class="fa fa-exclamation-triangle fa-3"></i></p>
            <?php endif; ?>
        </div>
      </div> <?php
             } 
            break;
          
          case 'twitter':
            if ($col_number == 1){  ?>
                <div class='twelve small-12 large-6 columns twitter-feed-box space'>
                  <div class='color-<?php echo $position; ?>'>
                    <span class='box-title'><i class='fa-twitter fa '></i> <?php echo __('Latest Tweets', THEME_NAME); ?></span>
                    <?php echo wd_get_tweets_tile(); ?>
                  </div>
                </div>
              <?php }else {  ?>
                <div class='twelve small-12 columns twitter-feed-box space'>
                  <div class='color-<?php echo $position; ?>'>
                    <span class='box-title'><i class='fa-twitter fa '></i> <?php echo __('Latest Tweets', THEME_NAME); ?></span>
                    <?php echo wd_get_tweets_tile(); ?>
                  </div>
                </div>
             <?php }
            break;
        }
  }
}

//---------------big tile ---------------------
if( !function_exists('wd_get_big_tile')){
  function wd_get_big_tile( $position, $col_number = null ){ 
    global $wd_tiles;
    
    switch ($wd_tiles[$position]['id']) {
      case 'custom_text':  ?> 

          <div class="twelve large-12 columns space big">
            <div class="color-<?php echo $position ?>  text-left p-all-20">
               <?php echo do_shortcode($wd_tiles[$position]['content']); ?>
            </div>
          </div> 
        
        <?php 
        break;
      
      case 'portfolio_slider':  ?> 
        
        <div class="twelve large-12 columns space work-box big">
          <div>
            <span class="box-title anim"><?php echo __( 'Featured Projects', THEME_NAME ); ?></span>
            <div class="projects-slider <?php if($col_number == 1 ) echo "big-slider"; ?>">
              <ul>                          
               <?php  $loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 10 ) );
                while ( $loop->have_posts() ) : $loop->the_post();
                  if(get_post_meta(get_the_ID(),'wd_show_in_slider',true) == "on"){  ?>      
                   <li>
                    <a href="<?php the_permalink()  ?>">
                      <?php 
                      if($col_number == 1 ){
                        the_post_thumbnail('big-slider');  
                      }else{
                        the_post_thumbnail('400x400');                        
                      } ?>
                    </a>
                  </li> 
                 <?php  }
                endwhile; ?>              
              </ul>
            </div>
          </div>
        </div> 
     <?php    
        break;
      case 'blog_slider':  ?> 
        
        <div class="twelve large-12 columns space <?php if($col_number == 1 ) echo "big-column"; else echo "work-box";  ?> big">
          <div>
            <span class="box-title anim"><?php echo __( 'Featured Posts', THEME_NAME ); ?></span>
            <div class="projects-slider <?php if($col_number == 1 ) echo "big-slider"; ?>">
              <ul>                          
               <?php  $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 10 ) );
                while ( $loop->have_posts() ) : $loop->the_post();
                   //$the_post_thumbnail = the_post_thumbnail();
                  //if( $the_post_thumbnail != NULL ){  ?>      
                   <li>
                    <a href="<?php the_permalink()  ?>">
                      <?php 
                      if($col_number == 1 ) {
                        the_post_thumbnail( 'big-slider' ); 
                      }else{
                        the_post_thumbnail( '4004x400' );
                      } 
                      ?> 
                    </a>
                  </li> 
                 <?php  //}
                endwhile; ?>              
              </ul>
            </div>
          </div>
        </div> 
     <?php    
        break;
        //------------------slider video --------
        case 'slider_video':  ?> 
        
        <div class="twelve large-12 columns space  big <?php if($col_number == 1 ) echo "big-column"; else echo "work-box";  ?> ">
          <div>
            <!--<span class="box-title anim"><?php //echo __( 'Featured Projects', THEME_NAME ); ?></span>-->
            <div class="projects-slider2 projects-slider ">
               <ul>                        
               <?php  $loop = new WP_Query( array( 'post_type' => 'slider_video', 'posts_per_page' => 10 ) );
                while ( $loop->have_posts() ) : $loop->the_post(); ?>
                  <li>

                       <?php 
                       
                          if(get_post_meta(get_the_ID(), 'slider_type', true) == 'Image slider'){
                            $post_thumbnail_id = get_post_meta(get_the_ID(), 'picture', true);
                            if($col_number == 1 ) { 
                              print wp_get_attachment_image( $post_thumbnail_id, 'big-slider' ); 
                            }else{
                              print wp_get_attachment_image( $post_thumbnail_id, '400x400' ); 
                            } 
                            
                           ?><a href="<?php echo get_post_meta(get_the_ID(), 'url', true); ?>">
                           <span class="box-title anim">
                                  <?php echo get_post_meta(get_the_ID(), 'description', true); ?>
                           </span></a>
                           <?php
                       
                             }else{
                              echo the_content() ; ?>
                               <a href="<?php echo get_post_meta(get_the_ID(), 'url', true); ?>">
                               <span class="box-title anim">
                                      <?php echo get_post_meta(get_the_ID(), 'description', true); ?>
                               </span></a>
                               <?php
                             } 
                        ?>
                  </li>
                  
                <?php endwhile; ?>              
              </ul>
            </div>
          </div>
        </div> 
     <?php    
        
    }
  }
}
              
//--------------- medium  tile-------------------
if( !function_exists('wd_get_medium_tile')){
  function wd_get_medium_tile( $position , $col_number ){
    global $wd_tiles;
    $id         = $wd_tiles[$position]['id'];
    $color      = $wd_tiles[$position]['color'];
    $page_title = get_the_title( $id );
    
    $link       = '#' . mb_convert_encoding(str_replace(' ', '', $page_title), "EUC-JP", "auto");
    $output     = '';
    
    
    switch ($wd_tiles[$position]['tile type']) {
      case 'page':
            if($col_number==1){
              $output = "<div class='six small-6 large-3 columns contact-box space'>
                  <div class='color-$position'>";
            }else {
              $output = "<div class='six small-6 columns contact-box space'>
                  <div class='color-$position'>";   

            }
            if( current_user_can('administrator') ){
              $output .= "<a class='edit-box' href='". home_url() ."/wp-admin/post.php?post=$id&action=edit'> Edit</a>";
            }
              $output .= "<a href='$link'> <span class='box-title'>" . $page_title ."</span>
                    <br/>
                    <i class='". get_post_meta($id, 'wd_icon', true). " fa fa-4x'></i> </a>
                  </div>
                </div>"; 
        break;
        
      case 'social':
        switch ($wd_tiles[$position]['id']) {
          case 'facebook':
          if($col_number==1){
            $output = "<div class='six small-3 columns contact-box space'>
                        <div class='color-$position'>
                          <a href='". get_option($wd_tiles[$position]['id']) ."'> <span class='box-title'>facebook" . $page_title ."</span>
                          <br/>
                          <i class='fa-facebook fa fa-4x'></i> </a>
                        </div>
                      </div>"; 
                    }else{
                      $output = "<div class='six small-6 columns contact-box space'>
                        <div class='color-$position'>
                          <a href='". get_option($wd_tiles[$position]['id']) ."'> <span class='box-title'>facebook" . $page_title ."</span>
                          <br/>
                          <i class='fa-facebook fa fa-4x'></i> </a>
                        </div>
                      </div>"; 
                    }
                    
            break;
          case 'twitter':
          if($col_number==1){
            $output = "<div class='six small-3 columns contact-box space'>
                        <div class='color-$position'>
                          <a href='". get_option($wd_tiles[$position]['id']) ."'> <span class='box-title'>twitter" . $page_title ."</span>
                          <br/>
                          <i class='fa-twitter fa fa-4x'></i> </a>
                        </div>
                      </div>";
                    }else{
                      $output = "<div class='six small-6 columns contact-box space'>
                        <div class='color-$position'>
                          <a href='". get_option($wd_tiles[$position]['id']) ."'> <span class='box-title'>twitter" . $page_title ."</span>
                          <br/>
                          <i class='fa-twitter fa fa-4x'></i> </a>
                        </div>
                      </div>";
                    }
            break;

          
          }        
        break;
    }
    return $output;
  }
}
              
//--------------- small tile-------------------
if( !function_exists('wd_get_small_tile')){
  function wd_get_small_tile( $position ){
    global $wd_tiles;
    $id         = $wd_tiles[$position]['id'];
    $color      = $wd_tiles[$position]['color'];
    $page_title = get_the_title( $id );
    $link       = '#' . urlencode( $page_title );
    $output     = '';
    
    switch ($wd_tiles[$position]['id']) {
      case 'facebook':
        $output = "<div class='six small-3 columns contact-box space'>
                    <div class='color-$position'>
                      <a href='". get_option($wd_tiles[$position]['id']) ."'> <span class='box-title'>facebook" . $page_title ."</span>
                      <br/>
                      <i class='fa-facebook fa fa-4x'></i> </a>
                    </div>
                  </div>"; 
        break;
      case 'twitter':
        $output = "<div class='six small-3 columns contact-box space'>
                    <div class='color-$position'>
                      <a href='". get_option($wd_tiles[$position]['id']) ."'> <span class='box-title'>twitter" . $page_title ."</span>
                      <br/>
                      <i class='fa-twitter fa fa-4x'></i> </a>
                    </div>
                  </div>"; 
        break;
      
      }        

    return $output;
  }
}



//------------------------------------------------------
if( ! function_exists('wd_contenu_pages') ){
  function wd_contenu_pages( $post_id ){
    $page_data = get_page( $post_id );   
    $output=apply_filters('the_content', $page_data->post_content);
    return $output;
  }
}



function wd_get_section( $post_id ){
  $str=str_replace(' ', '', get_the_title( $post_id ));
  $link = mb_convert_encoding($str, "EUC-JP", "auto");
            
  $sec = '<section class="page-section '. $link .'-page page-section-'.$post_id.'">
            <div class="row menu-row">
              <div class="large-1 go-back">
                <i class="fa-arrow-left fa icon-x back" onclick="window.history.back()"></i> 
              </div>
              <div class="large-7 columns p-l-0">
              <h2>           
                '.get_the_title( $post_id ).'</h2>  
              </div>
              <div class="large-4 columns menu-button text-right">
                '.header_menu().'
              </div>
            </div>
              <div class="row clear-fix">' . wd_contenu_pages( $post_id ) . 
             '</div>
          </section>';
          
  return $sec;
}
?>