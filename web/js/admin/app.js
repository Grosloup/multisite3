

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
    var overlay, popup, closePopupBtn, popupInner, popupHeader;
    overlay = $("<div id='overlay' />");
    popup = $("<div id='popup' class='card has-fixed-actions'><div class='card-header' id='popup-header'>Message</div><div id='popup-inner'></div><div class='card-actions fixed-bottom'><a class='btn btn-flat' href='' id='close-popup'>fermer</a></div></div>");
    $('body').prepend(overlay);
    overlay[0].style.position = 'fixed';
    overlay[0].style.top = 0 + 'px';
    overlay[0].style.left = 0 + 'px';
    overlay[0].style.right = 0 + 'px';
    overlay[0].style.bottom = 0 + 'px';
    overlay[0].style.backgroundColor = 'rgba(0,0,0,0.6)';
    overlay[0].style.zIndex = 99999;
    overlay[0].style.display = 'none';
    popup[0].style.width = 500 + 'px';
    popup[0].style.minHeight = 150 + 'px';
    popup[0].style.position = 'absolute';
    popup[0].style.zIndex = 100000;
    popup[0].style.top = 100 + 'px';
    popup[0].style.display = 'none';
    closePopupBtn = popup.find("a#close-popup");
    popupInner = popup.find("#popup-inner");
    popupHeader = popup.find("#popup-header");
    overlay.after(popup);


    function positionPopup()
    {
        popup.css('left',(( $(window).width() - popup.width())/2)+'px');
        popup.css('top',(( $(window).height() - popup.height())/2)+'px');
    }

    function openPopup(){
        overlay[0].style.display = 'block';
        popup[0].style.display = 'block';
        positionPopup();
    }

    function closePopup(){
        overlay[0].style.display = 'none';
        popup[0].style.display = 'none';
        popupInner.text('');
        popupHeader.text('');
    }


    $('#sidebar-toggle').on('click', function(e){
        e.preventDefault();
        $('body').toggleClass('close-sidebar');
    });
    $('.nano').nanoScroller();
    $('.sidebar-dropdown').sidebarDropdown({'folderId': 'menus-tools-fold', 'unfolderId': 'menus-tools-unfold'});
    $('.dialog').dialog({'timeout': 5000});
    $('li.sidebar-dropdown.active').addClass('open').find("ul:first").slideDown(200);

    $('[data-action="open-popup"]').on('click', function(e){
        e.preventDefault();
        popupInner.text($(this).data('message'));
        popupHeader.text($(this).data('header') || "Message");
        openPopup();
    });
    overlay.on('click', function(e){
        e.preventDefault();
        closePopup();
    });
    closePopupBtn.on('click', function(e){
        e.preventDefault();
        closePopup();
    });
});
