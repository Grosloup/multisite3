(function($,w){

    $.fn.zpbCalendar = function(options){

        return this.each(function(){
            if(!$(this).data('zpbCalendar')){
                $(this).data('zpbCalendar', new Calendar(this, options));
            }
        });
    }
})(jQuery, window);
