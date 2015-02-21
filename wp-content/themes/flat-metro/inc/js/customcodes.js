(function() {
    //------------------- Portfolio -------------------------------------------------------------------  
    tinymce.create('tinymce.plugins.portfolio', {
        init : function(ed, url) {
          
          ed.addCommand('mcethemedelta', function() {
                ed.windowManager.open({
                    // call content via admin-ajax, no need to know the full plugin path
                    file: ajaxurl + '?action=webdevia_tinymce&shortcode=portfolio',
                    width: 500 + ed.getLang('wd-shortcode.delta_width', 0),
                    height: 210 + ed.getLang('wd-shortcode.delta_height', 0),
                    inline: 1
                }, {
                    plugin_url: url // Plugin absolute URL
                });
            });

            // Register example button
            ed.addButton('wd-shortcode', {
                title: 'Add Portfolio',
                cmd: 'mcethemedelta',
                image: url + '/portfolio.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('wd-shortcode', n.nodeName == 'IMG');
            });
            
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('portfolio', tinymce.plugins.portfolio);
    
    //------------------- Portfolio -------------------------------------------------------------------
    tinymce.create('tinymce.plugins.pricingtable', {
        init : function(ed, url) {
          ed.addButton('pricingtable', {
              title : 'Add a Pricing Table',
              image : url+'/pricingtable.png',
              onclick : 
                function() {
                  ed.selection.setContent('<ul class="pricing-table">\
                          <li class="title">Standard</li>\
                          <li class="price">$99.99</li>\
                          <li class="description">An awesome description</li>\
                          <li class="bullet-item">1 Database</li>\
                          <li class="bullet-item">5GB Storage</li>\
                          <li class="bullet-item">20 Users</li>\
                          <li class="cta-button"><a class="button" href="#">Buy Now</a></li>\
                        </ul>');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('pricingtable', tinymce.plugins.pricingtable);
    
    //------------------- Blog -------------------------------------------------------------------
    tinymce.create('tinymce.plugins.blog', {
        init : function(ed, url) {
          ed.addButton('blog', {
              title : 'Add a Blog',
              image : url+'/blog.png',
              onclick : 
                function() {
                  ed.windowManager.open({
                    // call content via admin-ajax, no need to know the full plugin path
                    file: ajaxurl + '?action=webdevia_tinymce&shortcode=blog',
                    width: 500 + ed.getLang('wd-shortcode.delta_width', 0),
                    height: 500 + ed.getLang('wd-shortcode.delta_height', 0),
                    inline: 1
                }, {
                    plugin_url: url // Plugin absolute URL
                });
              }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('blog', tinymce.plugins.blog);
    
    //------------------- button -------------------------------------------------------------------
    tinymce.create('tinymce.plugins.wdbutton', {
        init : function(ed, url) {
          ed.addButton('wdbutton', {
              title : 'Add a Button',
              image : url+'/button.png',
              onclick : function() {
                ed.selection.setContent('[wdbutton]' + ed.selection.getContent() + '[/wdbutton]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('wdbutton', tinymce.plugins.wdbutton);
    
    //------------------- Alert Box -------------------------------------------------------------------
    tinymce.create('tinymce.plugins.alertbox', {
        init : function(ed, url) {
          ed.addButton('alertbox', {
              title : 'Add an Alert Box',
              image : url+'/alertbox.png',
              onclick : function() {
                ed.selection.setContent('[alertbox]' + ed.selection.getContent() + '[/alertbox]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('alertbox', tinymce.plugins.alertbox);
    
      
    
})();