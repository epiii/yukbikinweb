jQuery(document).ready(function($) {
  
  var curent_sreen = '';
  function wd_add_ckeckbox_class(){
    curent_sreen = $("input:radio[name='wd_start_screan']:checked").val();
    $( "input[name='wd_start_screan']" ).parent().removeClass('selected');
    
    $( "input[value='" + curent_sreen + "'][name='wd_start_screan']" ).parent().addClass('selected');
  }

    
  jQuery( "#tabs" ).tabs({ active: 1 });
   
  // reload the form when the checkbox is changed
  wd_add_ckeckbox_class();
  $('.wd_start_screan').click( function(e){
    if (curent_sreen != $(this).val() ){
      wd_add_ckeckbox_class();
      $(this).closest('form').submit();    
    }      
  });
    
    
    
    if (typeof wp.media !== 'undefined'){
    
      var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;
  
    $('.uploader .button').click(function(e) {
      var send_attachment_bkp = wp.media.editor.send.attachment;
      var button = $(this);
      var id = button.attr('id').replace('_button', '');
      _custom_media = true;
      wp.media.editor.send.attachment = function(props, attachment){
        if ( _custom_media ) {
          $("#"+id).val(attachment.url);
        } else {
          return _orig_send_attachment.apply( this, [props, attachment] );
        };
      };
  
      wp.media.editor.open(button);
      return false;
    });
  
    $('.add_media').on('click', function(){
      _custom_media = false;
    });
  
  }
  
  
  
   
});
