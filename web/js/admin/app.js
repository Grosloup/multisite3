

(function($, window, d){

    $.fn.sidebarDropdown = function(options){

        var defaults = {
            'folderId': '',
            'unfolderId': ''
        };
        var o = $.extend({}, defaults, options || {});
        var $this = this;
        if(o.folderId != ''){
            $("#" + o.folderId).on('click', function(e){
                e.preventDefault();
                $this.addClass('open');
                $this.find('ul:first').slideDown(200);
            });
        }

        if(o.unfolderId != ''){
            $("#" + o.unfolderId).on('click', function(e){
                e.preventDefault();
                $this.removeClass('open');
                $this.find('ul:first').slideUp(200);
            });
        }

        return this.each(function(){
            var $this = $(this);
            var link = $this.find('a:first');
            var target = $this.find('ul:first');
            link.on('click', function(e){
                e.preventDefault();
                $this.toggleClass('open');
                target.slideToggle(200);
            });
        });
    };

    $.fn.dialog = function(options){

        var defaults = {'timeout': 0};
        var o = $.extend({}, defaults, options || {});

        return this.each(function(){
            var $this = $(this);
            if(o.timeout){
                window.setTimeout(function(){
                    $this.fadeOut(function(){
                        $this.remove();
                    });
                }, o.timeout);
            }
            var $close = $this.find('.dialog-close');
            $close.on('click', function(e){
                e.preventDefault();
                $this.fadeOut(function(){
                    $this.remove();
                });
            });
        });
    };

})(jQuery, this, document);



$(function(){
    $('#sidebar-toggle').on('click', function(e){
        e.preventDefault();
        $('body').toggleClass('close-sidebar');
    });
    $('.nano').nanoScroller();
    $('.sidebar-dropdown').sidebarDropdown({'folderId': 'menus-tools-fold', 'unfolderId': 'menus-tools-unfold'});
    $('.dialog').dialog({'timeout': 5000});
});
