<?php 


if(!function_exists('wd_adding_projet_slider_boxes')){
  function wd_adding_projet_slider_boxes( $post_type, $post ) {
    add_meta_box( 
        'option',
        __( 'slider box' , THEME_NAME),
        'wd_project_meta_box',
        'portfolio',
        'normal',
        'default'
    );
  }
  add_action( 'add_meta_boxes', 'wd_adding_projet_slider_boxes', 5, 2 );
}


if(!function_exists('wd_project_meta_box')){
  function wd_project_meta_box() { ?>
    <form method="POST" action="">
      
    <?php   $selected = (get_post_meta(get_the_ID(),'wd_show_in_slider', true) == "on") ? $selected = "checked" : ""; ?>
    
      <label>
        <input type="checkbox" name="wd_show_in_slider" <?php  echo $selected ?> />
        <?php echo __('Show pictures of this project in Homepage slider', THEME_NAME) ?></label>
      
    </form>
    <?php
  }  
}


if( ! function_exists('slider_save_data')) {
 function slider_save_data() {
  if(isset($_POST['wd_show_in_slider'])){
    update_post_meta(get_the_ID(), 'wd_show_in_slider',$_POST['wd_show_in_slider'],true);
  }
  
 }
 add_action('save_post_portfolio', 'slider_save_data');
}
