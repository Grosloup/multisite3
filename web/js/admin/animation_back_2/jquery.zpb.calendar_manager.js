(function($,w){

    $.fn.zpbCalendarManager = function(options){

        return this.each(function(){
            if(!$(this).data('zpbCalendarManager')){
                $(this).data('zpbCalendarManager', new CalendarManager(this, options));
            }
        });
    }
})(jQuery, window);
