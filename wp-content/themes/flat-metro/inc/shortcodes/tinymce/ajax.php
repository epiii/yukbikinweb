<?php
/**
 *
 * @return string folder content
 */
add_action('wp_ajax_webdevia_tinymce', 'webdevia_ajax_tinymce');
/**
 * Call TinyMCE window content via admin-ajax
 *
 * @since 1.7.0
 * @return html content
 */
function webdevia_ajax_tinymce() {
    if (!current_user_can('edit_pages') && !current_user_can('edit_posts')) // check for rights
        die(__("You are not allowed to be here"));

    include_once( dirname(dirname(__FILE__)) . '/tinymce/window.php');
}