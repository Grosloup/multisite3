(function($,w,d){
    $.fn.alertBox = function(options){
        var defaults = {
            'timer' : 3000,
            'top' : 100
        };
        var opts = $.extend({}, defaults, options || {});
        var top = opts.top;

        function position(el, idx ){
            el.css('top',top + 'px');
            el.css('left',(($(w).width() - el.width()) / 2) + 'px');
            top += el.height() + 15;
        }

        return this.each(function(idx){
            var $this = $(this);
            var close = $this.find('a.alert-close');
            position($this, idx);
            close.on('click', function(e){
                e.preventDefault();

                $this.remove();
            });

            if(opts.hasOwnProperty('timer') && opts.timer != null){
                w.setTimeout(function(){
                    $this.fadeOut( opts.timer, function(){
                        $this.remove();
                    })
                }, opts.timer);
            }
        });
    }
})(jQuery, this, document);

$(function(){
    $('[data-message=""]').alertBox();
});
