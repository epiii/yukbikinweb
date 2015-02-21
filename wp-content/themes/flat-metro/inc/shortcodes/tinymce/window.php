<?php
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-widget');
wp_enqueue_script('jquery-ui-position');
wp_enqueue_script('jquery');
global $wp_scripts;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Webdevia Shortcodes</title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
    <script language="javascript" type="text/javascript" 
      src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>

    <script language="javascript" type="text/javascript" 
      src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>

    <script language="javascript" type="text/javascript" 
      src="<?php echo get_template_directory_uri() . '/inc/shortcodes/tinymce/shortcodes.js'; ?>"></script>
    <base target="_self" />
    <?php wp_print_scripts(); ?>
  </head>

  <body id="link">
    
    <?php 
    if( isset($_GET['shortcode'])): ?>
      <input type="hidden" name="shortcode-name" id="shortcode-name" value="<?php echo $_GET['shortcode']; ?>"/>   <?php  
      switch ($_GET['shortcode']) {
        case 'portfolio': 
          $terms = get_terms( array('projet'), array('hide_empty' => FALSE) ); 
          ?>
        
          <form name="wd_shortcodes" action="#">
            <table border="0" cellpadding="4" cellspacing="0">
              <tr>
                <td><?php _e("Project Categoties", THEME_NAME); ?>:</td>
                <td><small>
                  <?php foreach ($terms as $key => $term) { ?>
                    <label class="portoflio-category">
                      <input type="checkbox" checked="checked" name="portoflio-category" value="<?php echo $term->term_id; ?>"> <?php echo $term->name; ?></label>
                  <?php } ?>
                  </small>
                </td>
              </tr>              
              <tr>
                  <td><?php _e("Items Per Page", THEME_NAME); ?>:</td>
                  <td><input type="text" name="item-per-page" value="9" id="item-per-page"/></td>
              </tr> 
              
              <tr>
                  <td><?php _e("Columns", THEME_NAME); ?>:</td>
                  <td>
                    <select id="columns">
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4" selected>4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                    </select></td>
              </tr>
            </table>
            <br/><br/>
            <div>
              <div style="float: left">
                <input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", THEME_NAME); ?>" onClick="tinyMCEPopup.close();" />
              </div>
      
              <div style="float: right">
                <input type="submit" id="insert" name="insert" value="<?php _e("Insert", THEME_NAME); ?>" onClick="insertshortcode();" />
              </div>
            </div>
          </form> 

          <?php break; 
          
          
        /********************************************  Blog *************************************************************/  
        case 'blog': 
          $terms = get_terms( array('category') ); 
          ?>
        
          <form name="wd_shortcodes" action="#">
            <table border="0" cellpadding="4" cellspacing="0">
              <tr>
                <td><?php _e("Blog Categoties", THEME_NAME); ?>:</td>
                <td>
                  <?php foreach ($terms as $key => $term) { ?>
                    <label class="blog-category">
                      <input type="checkbox" checked="checked" name="blog-category" value="<?php echo $term->term_id; ?>"> <?php echo $term->name; ?></label> <br>
                  <?php } ?>
                </td>
              </tr>              
              <tr>
                  <td><?php _e("Items Per Page", THEME_NAME); ?>:</td>
                  <td><input type="text" name="item-per-page" value="12" id="item-per-page"/></td>
              </tr> 
              
              <tr>
                  <td><?php _e("Columns", THEME_NAME); ?>:</td>
                  <td>
                    <select id="columns">
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4" selected>4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                    </select></td>
              </tr>
            </table>
            <br/><br/>
            <div>
              <div style="float: left">
                <input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", THEME_NAME); ?>" onClick="tinyMCEPopup.close();" />
              </div>
      
              <div style="float: right">
                <input type="submit" id="insert" name="insert" value="<?php _e("Insert", THEME_NAME); ?>" onClick="insertshortcode();" />
              </div>
            </div>
          </form> 

          <?php break;      
        default:
          break;
      }
      ?>
      
    
    <?php endif; ?>
    
  </body>
</html>