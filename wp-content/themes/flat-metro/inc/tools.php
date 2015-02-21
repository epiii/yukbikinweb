<?php 

if(! function_exists('wd_dsm')){
  function wd_dsm($var){
    print "<pre>" . print_r($var, true) . "</pre>";
  }
}


function wd_url_text($text, $blank = false){
  
  $target = '';
  
  if($blank){
    $target = '_blank';
  }
  
  return preg_replace('@(http)?(s)?(://)?(([-\w]+\.)+([^\s]+)+[^,.\s])@', '<a href="http$2://$4" target="'.$target.'">$1$2$3$4</a>', $text);

}


/**
 * Get Post By Meta Tag
 */
if( !function_exists('wd_get_posts_by_meta_key')){
  function wd_get_posts_by_meta_key($key, $value = null, $post_type = 'page', $fields = null){
    global $wpdb;
    $querystr = "SELECT ";
    
    if(is_array($fields)){
      foreach ($fields as $key => $field) {
        if ($field === end($fields)){
          $querystr .= $field . ' ';
        }else {
          $querystr .= $field . ', ';
        }        
      }
    }else{
      $querystr .= "$wpdb->posts.post_title, $wpdb->posts.ID , $wpdb->postmeta.* ";
    }
    $querystr .= "FROM $wpdb->posts, $wpdb->postmeta
                  WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
                  AND $wpdb->posts.post_status = 'publish'
                  AND $wpdb->posts.post_type = '$post_type'
                  AND $wpdb->postmeta.meta_key = '$key'";    
    if( $value != null){
      $querystr .= "AND $wpdb->postmeta.meta_value = '$value'";
    }              
    $querystr .= "ORDER BY $wpdb->posts.post_date DESC";   

    return $wpdb->get_results($querystr, OBJECT); 
   
   }
}





if ( ! function_exists( 'wd_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function wd_content_nav( $html_id ) {
  global $wp_query;

  $html_id = esc_attr( $html_id );

  if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
      <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
      <div class="nav-previous left"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
      <div class="nav-next right"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
    </nav><!-- #<?php echo $html_id; ?> .navigation -->
  <?php endif;
}
endif;


if ( ! function_exists( 'wd_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wd_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 *
 * @return void
 */
function wd_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
    // Display trackbacks differently than normal comments.
  ?>
  <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
  <?php
      break;
    default :
    // Proceed with normal comments.
    global $post;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <header class="comment-meta comment-author vcard">
        <?php
          echo get_avatar( $comment, 44 );
          printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
            get_comment_author_link(),
            // If current post author is also comment author, make it known visually.
            ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
          );
          printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
            esc_url( get_comment_link( $comment->comment_ID ) ),
            get_comment_time( 'c' ),
            /* translators: 1: date, 2: time */
            sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
          );
        ?>
      </header><!-- .comment-meta -->

      <?php if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
      <?php endif; ?>

      <section class="comment-content comment">
        <?php comment_text(); ?>
        <?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
      </section><!-- .comment-content -->

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
    </article><!-- #comment-## -->
  <?php
    break;
  endswitch; // end comment_type check
}
endif;

if(!function_exists("wd_breadcrumb")){
  function wd_breadcrumb() {
    global $post;
    echo '<ul id="breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo home_url();
        echo '">';
        echo 'Home';
        echo '</a></li><li class="separator"> / </li>';
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li class="separator"> / </li><li> ');
            if (is_single()) {
                echo '</li><li class="separator"> / </li><li>';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator">/</li>';
                }
                echo $output;
                echo '<strong title="'.$title.'"> '.$title.'</strong>';
            } else {
                echo '<li><strong> '.get_the_title().'</strong></li>';
            }
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive ";  echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for ";  echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
  }
}
