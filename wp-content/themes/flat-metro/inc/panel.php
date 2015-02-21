<?php 



if( !function_exists( 'wd_get_tile_info' ) ){
  function wd_get_tile_info( $value, $color = NULL, $column = NULL, $content = NULL, $title = NULL , $tile_img_bg = NULL ){
    $output = array();
    $dash_position = strpos($value, '-');
    $type = substr( $value, 0, $dash_position );
    
    switch ($type) {
      case 'page':
        $output['tile size'] = "medium";
        $output['tile type'] = "page";
        $output['id']        = substr( $value, $dash_position + 1 );;
        break;
        
      case 'social':
        $output['tile size'] = "medium";
        $output['tile type'] = "social";
        $output['id']        = substr( $value, $dash_position + 1 );
        break;
        
      case 'wide':
        $output['tile size'] = "wide";
        $output['tile type'] = "wide";
        $output['id']        = substr( $value, $dash_position + 1 );
        $output['title']     = $title;
        break;  
        
      case 'big':
        $output['tile size'] = "big";
        
        if(isset($output['content'])){
          $output['tile type'] = "custom";
        }else{
          $output['tile type'] = "big";          
        }        
        
        $output['id']        = substr( $value, $dash_position + 1 );
        $output['title']     = $title;
        break;
      
      default:          
        break;
    } 
    
    if( isset($color)) {  
      $output['color'] = $color;
    }
    if( isset($tile_img_bg)) {  
      $output['wdtile_bg'] = $tile_img_bg;
    }
    
    if( isset($column)) {  
      $output['column'] = $column;
    }
    
    if( isset($content)) {  
      $output['content'] = $content;
    }
    
    return $output;
  }
}


/*///////////////////////////////// Register Panel Scripts and Styles /////////////////////////////////////////*/
function wd_admin_register() {
   
  wp_register_script( 'wd-admin-main', get_template_directory_uri() . '/inc/js/script.js', 
              array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-tabs', 
              'jquery-ui-droppable', 'jquery-ui-sortable' ) , false , false );   
  wp_register_style( 'wd-style', get_template_directory_uri().'/inc/css/style.css', array(), '20120208', 'all' ); 

  if ( isset( $_GET['page'] ) && $_GET['page'] == 'option panel' ) {


  }
  wp_enqueue_script( 'wd-admin-main' );
  wp_enqueue_style( 'wd-style' );

}
add_action( 'admin_enqueue_scripts', 'wd_admin_register' ); 



if(!function_exists('wd_load_color_picker')){
  add_action( 'load-widgets.php', 'wd_load_color_picker' );
  function wd_load_color_picker() {      
      wp_enqueue_style( 'wp-color-picker' );          
      wp_enqueue_script( 'wp-color-picker' );      
  }
}




/*///////////////////////////////// Theme Options /////////////////////////////////////////*/
if(!function_exists('wd_panel_option')){
  add_action('admin_menu','wd_panel_option');  
  function wd_panel_option(){
  	
    add_theme_support( 'custom-header' );  
    
    add_theme_page('Flat-Metro Options', 'Flat-Metro Options', 'edit_theme_options', 'flat-metro-theme-option' , 'wd_theme_option');
  }
}


if(!function_exists('wd_theme_option')){
  function wd_theme_option() {
    
    wp_enqueue_media(); 
    
    global $wd_tiles; 
    
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style( 'wp-color-picker' );
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {   
        $('.wd-color-picker').wpColorPicker();
        
        
        // detect the change
        $('.wd-color-picker').bind("change keyup paste input",function() {
            $(this).parent().parent().parent().css('background', "#F00");
        });
        
        $('.iris-square-value').on('mousedown', function(e) {
          //alert('clicked');
        }).on('mouseup', function(e) {
          $(this).parent().parent().parent().parent().parent().parent().css('background', $(this).parent().parent().parent().parent().parent().find('.wd-color-picker').val() );
        })
        
       $('.option-item.tile .iris-square-value').each(function( index ) { 
        $(this).parent().parent().parent().parent().parent().parent().css('background', $(this).parent().parent().parent().parent().parent().find('.wd-color-picker').val() );
       });
        
      //---------------logo script-----------  
      jQuery('#wd_upload_btn').click(function(){
      wp.media.editor.send.attachment = function(props, attachment){
        jQuery('#wd_logo_filed').val(attachment.url);
      }   

      
      wp.media.editor.open(this);
      
      return false;
      });
      //------favicon script-----    
      jQuery('#wd_upload_favicon').click(function(){
      wp.media.editor.send.attachment = function(props, attachment){
        jQuery('#wd_favicon_filed').val(attachment.url);
      }
      wp.media.editor.open(this);
      
      return false;
      });
      //------tile baground image-----    
      jQuery('.wd_tile-bg').click(function(){
      	var that = this;
	      wp.media.editor.send.attachment = function(props, attachment){
	        jQuery(that).val(attachment.url);
	      }
	      wp.media.editor.open(this);
	      
	      return false;
      });
    //-------------------------------------
        
        
        $('.option-item.big.tile select').change(function () {
         var optionSelected = $(this).find("option:selected");
         var valueSelected  = optionSelected.val();
         
         if( valueSelected == 'big-custom_text'){
          $(this).parent().find('textarea').show();
         }else{
          $(this).parent().find('textarea').hide();
         }
        });
    });             
    </script>
    <?php  
    // Get lsit of Start screens layouts 
    $start_screans = wd_get_start_screens();
    
  
    if(isset($_POST['wd_start_screan'])){
      update_option('wd_start_screan', $_POST['wd_start_screan']);
    }
  
    $sreen_index = get_option('wd_start_screan');
    if(is_numeric($sreen_index)){ 
       $current_start_screan = $start_screans[$sreen_index];
    }else {
       $current_start_screan = $start_screans[0];
    }
       
  
       
    $wide_tiles = array( 
      'twitter'           => "Latest Tweets", 
      'testimonials'      => "Testimonials", 
      'feature_blog_post' => "Feature Blog Post", 
      'featured_project'  => "Featured Project" ,
      'boss_pic'          => "Boss Picture linked to team page" , 
      'next_event'        => "Next Event" );
       
    $big_tiles = array( 
      'portfolio_slider' => "Portfolio Slider", 
      'blog_slider'      => "Blog Post Slider", 
      //'gallery_slider'   => "Gallery Slider", 
      'slider_video'   => "Slider",
      'custom_text'      => "Custom Text" ); 
   
    
  	if(!empty($_POST)){	      
  	    
  	  // create tile array to save
      $tiles = array();
      $tiles[] = '';

      foreach ($current_start_screan as $key => $value) {
        //if(isset($_POST['tile-'. $key])){
          $column = (isset($_POST['column-'. $key])) ? $_POST['column-'. $key] : NULL;
          $color  = (isset($_POST['color-'. $key]))  ? $_POST['color-'. $key]  : NULL;
          $tile_img_bg  = (isset($_POST['tile-bg-'. $key]))  ? $_POST['tile-bg-'. $key]  : NULL;
          $title  = (isset($_POST['title-'. $key]))  ? $_POST['title-'. $key]  : NULL;
          $the_tile  = (isset($_POST['tile-'. $key]))  ? $_POST['tile-'. $key]  : NULL;
         
          
          $content  = (isset($_POST['content-'. $key]))  ? str_replace("\\", '', $_POST['content-'. $key])  : NULL;
          
          
          $tiles[] = wd_get_tile_info( $the_tile, $color, $column, $content, $title ,$tile_img_bg ) ;
       
        //}
      }
      unset($tiles[0]);
      
      // save the tiles array
      update_option('tiles', $tiles );   
      $wd_tiles = get_option('tiles');
      
      
      if(isset($_POST['wd_show_logo']))
        update_option('wd_show_logo', $_POST['wd_show_logo']); 
      else
        update_option('wd_show_logo', ''); 
      
      
      if(isset($_POST['wd_on_hover_show_menu']))
        update_option('wd_on_hover_show_menu', $_POST['wd_on_hover_show_menu']); 
      else
        update_option('wd_on_hover_show_menu', ''); 
            
      if(isset($_POST['wd_show_menu_inleft']))
        update_option('wd_show_menu_inleft', $_POST['wd_show_menu_inleft']); 
      else
        update_option('wd_show_menu_inleft', ''); 
      
  
  
      if( isset($_POST['settings']['_wd_logo']) && $_POST['settings']['_wd_logo'] != "" )    
        update_option('wd_logo', $_POST['settings']['_wd_logo']);  
      
      update_option('wd_favicon', $_POST['settings']['_wd_favicon']);
      if( isset($_POST['settings']['_wd_tilebg']) )
			 update_option('wd_tilebg', $_POST['settings']['_wd_tilebg']);

      update_option('wd_menu_bg',      $_POST['wd_menu_bg']);
      
      update_option('wd_menu_ahover_bg',  $_POST['wd_menu_ahover_bg']);
      update_option('wd_menu_submenu_bg', $_POST['wd_menu_submenu_bg']);
      
      update_option('wd_copyright', $_POST['wd_copyright']);
      
      update_option('twitter', $_POST['twitter']);
      update_option('facebook', $_POST['facebook']);
      update_option('flickr', $_POST['flickr']);
      update_option('google_plus', $_POST['google_plus']);
      
      
      
      update_option('wd_lt_twitter_user', $_POST['wd_lt_twitter_user']);   
      update_option('wd_lt_consumer_key', $_POST['wd_lt_consumer_key']);    
      update_option('wd_lt_consumer_secret', $_POST['wd_lt_consumer_secret']);    
      update_option('wd_lt_oauth_token', $_POST['wd_lt_oauth_token']);    
      update_option('wd_lt_oauth_token_secret', $_POST['wd_lt_oauth_token_secret']);
      
  
  		} ?>
  	
  	
  	
  	
  
  <h2><?php echo __('Theme Options', THEME_NAME); ?></h2>
  
  <?php if(!empty($_POST)): ?>
    <div id="message" class="updated fade">
      <p><?php echo __('Configuration updated!!', THEME_NAME); ?> </p>
    </div>
  <?php endif;  ?>    
      
      
  <div class="wd-cpanel">
    <form id="wd-Panel"  method="POST" action="">
      <div id="tabs">
        <ul>
          <li><a href="#tabs-0"><?php echo __('General Settings', THEME_NAME); ?></a></li>
          <li><a href="#tabs-1"><?php echo __('Start Screan Tiles', THEME_NAME); ?></a></li>
          <li><a href="#tabs-2"><?php echo __('Social Icons', THEME_NAME); ?></a></li>
          <li><a href="#tabs-3"><?php echo __('Latest Tweets Configuration', THEME_NAME); ?></a></li>
        </ul>
        <div id="tabs-0"> 
          <table class="form-table">
            <tbody>
              <tr valign="top">
                <th scope="row">
                  <label><input type="checkbox" <?php if(get_option('wd_on_hover_show_menu') == 'on') print 'checked'; ?>  name="wd_on_hover_show_menu" value="on" id="wd_on_hover_show_menu"/><?php echo __('Show Menu on Hover',THEME_NAME)?></label> 
                <td></td>
              </tr>
              <tr valign="top">
                <th scope="row" colspan="2">
                  <label><input type="checkbox" <?php if(get_option('wd_show_menu_inleft') == 'on') print 'checked'; ?>  name="wd_show_menu_inleft" value="on" id="wd_show_menu_inleft"/><?php echo __('Show Menu on the Left Side',THEME_NAME)?></label>                  
               </th>
              </tr>
              <tr valign="top">
                <th scope="row"><?php echo __('Menu Background Color:',THEME_NAME)?></th>
                <td><?php $wd_menu_bg = get_option('wd_menu_bg'); ?>
                  <input name="wd_menu_bg" type="text" value="<?php print $wd_menu_bg; ?>" class="wd-color-picker" data-default-color="#C0392B"></td>
              </tr>
              <tr valign="top">
                <th scope="row"><?php echo __('Menu link hover background:',THEME_NAME)?></th>
                <td><?php $wd_menu_ahover_bg = get_option('wd_menu_ahover_bg'); ?>
                  <input name="wd_menu_ahover_bg" type="text" value="<?php print $wd_menu_ahover_bg; ?>" class="wd-color-picker" data-default-color="#C0392B"></td>
              </tr>
              <tr valign="top">
                <th scope="row"><?php echo __('Sub-Menu link background:',THEME_NAME)?></th>
                <td><?php $wd_menu_submenu_bg = get_option('wd_menu_submenu_bg'); ?>
                  <input name="wd_menu_submenu_bg" type="text" value="<?php print $wd_menu_submenu_bg; ?>" class="wd-color-picker" data-default-color="#C0392B"></td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  <h3>Logo:</h3>
                  <label><input type="checkbox" <?php if(get_option('wd_show_logo') == 'on') print 'checked'; ?>  name="wd_show_logo" value="on" id="wd_show_logo"/><?php echo __('Show The Logo',THEME_NAME)?></label>  
                <td></td>
              </tr>
              <tr valign="top">
                <th scope="row">
                  <input type="text" name="settings[_wd_logo]" id="wd_logo_filed" />
                  <input class="button" name="_unique_name_button" id="wd_upload_btn" value="Upload" />
                </th>
                <td> <?php 
                $wd_logo = get_option('wd_logo');
                if(!empty($wd_logo)): ?> <img src="<?php print $wd_logo; ?>" style="max-height: 100px;" /> <?php endif;  ?></td>
              </tr>
              <!--favicon-->
                <tr valign="top">
                <th scope="row">
                  <h3>fivicon:</h3>
                  <input type="text" name="settings[_wd_favicon]" id="wd_favicon_filed" />
                  <input class="button" name="_unique_name_favicon" id="wd_upload_favicon" value="Upload" />
                </th>
                <td> <?php 
                $wd_favicon = get_option('wd_favicon');
                if(!empty($wd_favicon)): ?> <img src="<?php print $wd_favicon; ?>" style="max-height: 100px;" /> <?php endif;  ?></td>
              </tr>

              <!-- *************** -->
              <tr valign="top">
                <th scope="row">
                  <label for="blogdescription"><?php echo __('Footer Copyright text' , THEME_NAME); ?></label></th>
                  <?php 
                  $copyright = get_option('wd_copyright');
                  $copyright = (!empty($copyright)) ?  get_option('wd_copyright') : '&copy; 2013 Flat Metro All rights reserved.'; ?>
                <td><input type="text" class="wd_txt_big" name="wd_copyright" placeholder="Footer Copyright text" value="<?php echo $copyright; ?>"></td>
              </tr>
          
            </tbody>
          </table>
          
        </div>
        <div id="tabs-1">
          <h3><?php echo __('Select a Layout', THEME_NAME ) ?>:</h3>
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="0" <?php if($sreen_index == '0') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-0.png"/> </label> 
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="1" <?php if($sreen_index == '1') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-1.png"/> </label>
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="2" <?php if($sreen_index == '2') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-2.png"/> </label>
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="3" <?php if($sreen_index == '3') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-3.png"/> </label>
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="4" <?php if($sreen_index == '4') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-4.png"/> </label>
            <!-- modefie -->
          <label class="wd_start_screan-l"> 
            <input type="radio" name="wd_start_screan" class="wd_start_screan" value="5" <?php if($sreen_index == '5') print 'checked'; ?>>
            <img src="<?php print get_template_directory_uri(); ?>/images/screen-5.png"/> </label>
          <!--  -->
          
          <br/> 
          
          <h3><?php echo __('Tiles Settings:', THEME_NAME ) ?></h3>
          <div style="background: url('http://localhost/wordpress/wp-content/uploads/2014/04/img0.jpg'); overflow: hidden; padding: 80px 15px;">
            <?php           
            $pages_id = wd_get_page_id(); 
            $old_column = 1;
             
            foreach ($current_start_screan as $tile_postion => $tile) {
              if( $tile_postion == 1 || $tile['column'] != $old_column  ) {
                if( $tile_postion != 1 || $tile['column'] != $old_column  ) {
                  echo "</div> ";
                } ?> 
                <div class="large-4 columns">
                <?php $old_column = $tile['column'];
              }
                if( isset($tile['type']) && $tile['type'] == 'medium') : ?>
                  <div class="option-item medium tile tile-<?php echo $tile_postion ?>">
                    <div class="label"><span><?php echo 'Position '. $tile_postion ?></span></div>
                    <select name="tile-<?php echo $tile_postion ?>"> 
                      <optgroup label="Pages">            <?php           
                      
                      foreach ( $pages_id as $key => $page_id ) { 
                        ( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $page_id) ? ($selected = 'selected=selected') : $selected = ''; ?>              
                        <option value="page-<?php print $page_id ?>" <?php echo $selected ?> ><?php print get_the_title($page_id) ?></option>   <?php               
                      } ?>
                      </optgroup>
                      <optgroup label="Social Icons">
                        <option value="social-facebook">Facebook</option>
                        <option value="social-twitter">Twitter</option>
                      </optgroup>
                    </select>
                 
                    <?php $color = isset($wd_tiles[$tile_postion]['color']) ? $wd_tiles[$tile_postion]['color'] : '#1BA1E2'; ?>
                    <input name="color-<?php echo $tile_postion ?>"   type="text" value="<?php print $color; ?>" class="wd-color-picker" data-default-color="#C0392B">
                   
                   
                    <?php  $tile_background = isset( $tiles[$tile_postion]['wdtile_bg'] ) ? $tiles[$tile_postion]['wdtile_bg'] : ''; ?>
                    <input type="text" name="tile-bg-<?php echo $tile_postion ?>"  class="wd_tile-bg" value="<?php print $tile_background; ?>"/>
                    <!-- <input class="button" name="_unique_tile-bg-<?php echo $tile_postion ?>" class="wd_tile-bg-btn" value="Upload" />-->
                    <input name="column-<?php echo $tile_postion ?>"  type="hidden" value="<?php print $tile['column']; ?>">
                    
                  </div> 
                <?php endif; ?>
    
    
    
                <?php if( isset($tile['type']) && $tile['type'] == 'wide') : ?>
                  <div class="option-item wide tile tile-<?php echo $tile_postion ?>">
                    <div class="label"><span><?php echo 'Position '. $tile_postion ?></span></div>
                    <select name="tile-<?php echo $tile_postion ?>">             <?php
                      
                      foreach ( $wide_tiles as $key => $wide_tile ) : 
                        ( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key) ? ($selected = 'selected = "selected"') : $selected = ''; ?>               
                        <option value="wide-<?php print $key ?>" <?php echo $selected ?> ><?php print $wide_tile ?></option>    <?php               
                      endforeach; ?>
                      
                    </select>
                    <input name="color-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['color']; ?>" class="wd-color-picker" data-default-color="#C0392B">
                    <input name="column-<?php echo $tile_postion ?>" type="hidden" value="<?php print $tile['column']; ?>">
                    
                     <?php foreach ( $wide_tiles as $key => $wide_tile ) : 
                        if( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key): 
                        
                        $wide_tile = isset($wd_tiles[$tile_postion]['title']) ? $wd_tiles[$tile_postion]['title'] : $wide_tile;
                        ?>               
                        <div>Title: <input name="title-<?php echo $tile_postion ?>" type="text" value="<?php print $wide_tile; ?>"> </div>           
                     <?php endif;
                     endforeach; ?>
                     
                  </div> 
                <?php endif; ?>
    
    
    
                <?php if( isset($tile['type']) && $tile['type'] == 'big') : ?>
                  <div class="option-item big tile tile-<?php echo $tile_postion ?>">
                    <div class="label"><span><?php echo 'Position '. $tile_postion ?></span></div>
                    <select name="tile-<?php echo $tile_postion ?>">             <?php
                      
                      foreach ( $big_tiles as $key => $big_tile ) { 
                        ( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key) ? ($selected = 'selected = "selected"') : $selected = ''; ?>              
                        <option value="big-<?php print $key ?>" <?php echo $selected ?> ><?php print $big_tile ?></option>   <?php               
                      } ?>
                      
                    </select>
                    <input name="color-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['color']; ?>" class="wd-color-picker" data-default-color="#C0392B">
                    <input name="column-<?php echo $tile_postion ?>" type="hidden" value="<?php print $tile['column']; ?>">
    
                    
                    <textarea name="content-<?php echo $tile_postion ?>" rows="5" cols="40"
                      <?php if( $selected == '' ): ?> style="display: none;" <?php endif; ?>><?php 
                      
                      if(isset($wd_tiles[$tile_postion]['content'])) 
                        print $wd_tiles[$tile_postion]['content'] ?>
                    </textarea>
                    
                    <?php foreach ( $wide_tiles as $key => $wide_tile ) : 
                        if( isset($wd_tiles[$tile_postion]['id']) && $wd_tiles[$tile_postion]['id'] == $key): ?>               
                        <div>Title: <input name="tile-title-<?php echo $tile_postion ?>" type="text" value="<?php print $wd_tiles[$tile_postion]['title'] ?>"> </div>           
                     <?php endif;
                     endforeach; ?>
                      
                    <div class="cleafix"></div>
                  </div> 
                <?php endif;
            } 
            echo "</div> "; ?>
          </div>
          <div style="clear: both;"><br/><br/><br/></div>
        </div>
        
        <div id="tabs-2">
            <h3><?php echo __('Social pages' ,THEME_NAME); ?></h3>
            
            <table class="form-table">
              <tbody>
                <tr valign="top">
                  <th scope="row">
                    <label for="blogname">Twitter</label></th>
                  <td><input type="text" name="twitter" placeholder="Your twitter profile link" value="<?php echo get_option('twitter'); ?>"></td>
                </tr>
                
                <tr valign="top">
                  <th scope="row">
                    <label for="blogdescription">Facebook</label></th>
                  <td><input type="text" name="facebook" placeholder="Your Facebook page link" value="<?php echo get_option('facebook'); ?>"></td>
                </tr>                
                <tr valign="top">
                  <th scope="row">
                    <label for="blogdescription">Flickr</label></th>
                  <td><input type="text" name="flickr" placeholder="Your Flickr page link" value="<?php echo get_option('flickr'); ?>"></td>
                </tr>                
                <tr valign="top">
                  <th scope="row">
                    <label for="blogdescription">Google Plus</label></th>
                  <td><input type="text" name="google_plus" placeholder="Your Google Plus page link" value="<?php echo get_option('google_plus'); ?>"></td>
                </tr>
  
              </tbody>
            </table>
        </div>
        
        <div id="tabs-3">
          <table class="form-table">
            <tbody>
              <tr valign="top"><th scope="row"><label for="wd_lt_twitter_user"><?php echo __('Twitter Username', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_twitter_user'); ?>" name="wd_lt_twitter_user"></td>
              </tr>
              <tr valign="top"><th scope="row"><label for="wd_lt_consumer_key"><?php echo __('Consumer Key', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_consumer_key'); ?>" name="wd_lt_consumer_key"></td>
              </tr>
              <tr valign="top"><th scope="row"><label for="wd_lt_consumer_secret"><?php echo __('Consumer Secret', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_consumer_secret'); ?>" name="wd_lt_consumer_secret"></td>
              </tr>
              <tr valign="top"><th scope="row"><label for="wd_lt_oauth_token"><?php echo __('oAuth Token', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_oauth_token'); ?>" name="wd_lt_oauth_token"></td>
              </tr>
              <tr valign="top"><th scope="row"><label for="wd_lt_oauth_token_secret"><?php __('oAuth Token Secret', THEME_NAME ) ?></label></th><td>
                <input type="text" class="wd_txt_big" value="<?php echo get_option('wd_lt_oauth_token_secret'); ?>" value="<?php echo get_option('facebook'); ?>" name="wd_lt_oauth_token_secret"></td>
              </tr>
            </tbody>
          </table>
          
          <p>To get those information:</p>
          
            <ol class="wd_txt_desc" style="display: block;">
              <li>Go to the <a target="_blank" href="https://dev.twitter.com/apps/new">Twitter Developer Center</a> 
                to create an app, and create an account if necessary (you can use your Twitter account)</li>
              <li>Give it a name, description and website, at least, and validate</li>
              <li>In the next page, find the 4 informations (consumer key, consumer secret, oauth token and oauth token secret).</li>
              <li>Write them in the fields below (they are big strings of characters).</li>
            </ol>
          
        </div>
      </div>
      <div class="eight columns"> <p><button  type="submit" name="search" value="Update Options" class="button success" />Update Options</button></p></div>   
    </form>
  </div>
  
  	
  <div style="clear: both;">
    <br/><br/><br/><br/><br/><br/>
  </div>
  
  
  <div class="wb-item">
    <div class="icon-themes">
  
  	</div>
  </div>
  <?php
  }
}


function wd_get_start_screens(){   
  $start_screans = array();
  
  $start_screans[] = array( 
    1  => array('type' => 'wide',   'column' => '1'),
    2  => array('type' => 'wide',   'column' => '1'),
    3  => array('type' => 'medium', 'column' => '1'),
    4  => array('type' => 'medium', 'column' => '1'),
    
    5  => array('type' => 'big',    'column' => '2'),
    6  => array('type' => 'medium', 'column' => '2'),
    7  => array('type' => 'medium', 'column' => '2'),
    
    8  => array('type' => 'medium', 'column' => '3'),
    9  => array('type' => 'medium', 'column' => '3'),
    10 => array('type' => 'medium', 'column' => '3'),
    11 => array('type' => 'medium', 'column' => '3'),
    12 => array('type' => 'wide',   'column' => '3'),
     );
  $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'wide',   'column' => '1'),
    4  => array('type' => 'wide',   'column' => '1'),
    
    5  => array('type' => 'big',    'column' => '2'),
    6  => array('type' => 'medium', 'column' => '2'),
    7  => array('type' => 'medium', 'column' => '2'),
    
    8  => array('type' => 'wide',   'column' => '3'),
    9  => array('type' => 'medium', 'column' => '3'),
    10 => array('type' => 'medium', 'column' => '3'),
    11 => array('type' => 'medium', 'column' => '3'),
    12 => array('type' => 'medium', 'column' => '3'),
     );
  $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'wide',   'column' => '1'),
    4  => array('type' => 'wide',   'column' => '1'),
    
    5  => array('type' => 'medium', 'column' => '2'),
    6  => array('type' => 'medium', 'column' => '2'),
    7  => array('type' => 'big',    'column' => '2'),
    
    8  => array('type' => 'wide',   'column' => '3'),
    9  => array('type' => 'medium', 'column' => '3'),
    10 => array('type' => 'medium', 'column' => '3'),
    11 => array('type' => 'medium', 'column' => '3'),
    12 => array('type' => 'medium', 'column' => '3'),
     );
     
  $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'medium', 'column' => '1'),
    4  => array('type' => 'medium', 'column' => '1'),
    5  => array('type' => 'wide',   'column' => '1'),
    
    6  => array('type' => 'big',    'column' => '2'),
    7  => array('type' => 'medium', 'column' => '2'),
    8  => array('type' => 'medium', 'column' => '2'),
    
    9  => array('type' => 'big',    'column' => '3'),
   10  => array('type' => 'medium', 'column' => '3'),
   11 => array('type' => 'medium',  'column' => '3'),
     );
     
  $start_screans[] = array( 
    1  => array('type' => 'medium', 'column' => '1'),
    2  => array('type' => 'medium', 'column' => '1'),
    3  => array('type' => 'medium', 'column' => '1'),
    4  => array('type' => 'medium', 'column' => '1'),
    5  => array('type' => 'medium', 'column' => '1'),
    6  => array('type' => 'medium', 'column' => '1'),
    
    7  => array('type' => 'big',    'column' => '2'),
    8  => array('type' => 'medium', 'column' => '2'),
    9  => array('type' => 'medium', 'column' => '2'),
    
   10  => array('type' => 'wide',    'column' => '3'),
   11  => array('type' => 'medium', 'column' => '3'),
   12  => array('type' => 'medium', 'column' => '3'),
   13  => array('type' => 'medium', 'column' => '3'),
   14  => array('type' => 'medium', 'column' => '3'),
   );
  //----------------------
  $start_screans[] = array( 
    1  => array('type' => 'big',   'column' => '1'),
    2  => array('type' => 'wide',   'column' => '1'),
    3  => array('type' => 'medium', 'column' => '1'),
    4  => array('type' => 'medium', 'column' => '1'),
    
    
    5  => array('type' => 'wide', 'column' => '2'),
    6  => array('type' => 'medium', 'column' => '2'),
    7 => array('type' => 'medium', 'column' => '2'),
    8 => array('type' => 'medium', 'column' => '2'),
    9 => array('type' => 'medium',   'column' => '2'),
     );
  //----------------------------------------------
   return $start_screans;
 }

//-----  Test if the tiles array has third column --------------
 function wd_is_third($wd_tiles){
   
    $array_keys = array_keys($wd_tiles);    
    $last_key = end( $array_keys );
    
    if( isset( $wd_tiles[ $last_key ] )){
      
      if( $wd_tiles[ $last_key ]['column'] == 3 ){
        return true;
      }else{
        return false;
      }
      
    }else{
        return false;
      }
 }
?>