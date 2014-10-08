(function($, w){
    var tabs_default = {
        btnSelector : '._tab',
        panelSelector: '._tab-panel',
        activeClass: 'active'
    };
    $.fn.tabs = function(o){
        var opts = $.extend({}, tabs_default, o || {});
        return this.each(function(){
            var $el = $(this);
            var $tabs = $el.find(opts.btnSelector);
            var panels = $(opts.panelSelector);

            $tabs.each(function(){
                var target = $($(this).data("target"));
                $(this).on("click", function(e){
                    e.preventDefault();
                    panels.removeClass(opts.activeClass);
                    target.addClass(opts.activeClass);
                    $tabs.removeClass("active");
                    $(this).addClass("active");
                });
            });
        });
    }
})(jQuery, this);
