require(["jquery"], function($){
    (function($, w){

        $.fn.jqLegender = function(o){

            var defaults = {};
            var opts = $.extend({}, defaults, o||{});

            return this.each(function(){
                var $this = $(this),
                    legend = $this.find(".jqlegend"),
                    title = legend.find(".title"),
                    legendHeight = legend.height(),
                    titleHeight = title.height();

                function update(){
                    legend.css("top", ($this.height() - titleHeight) + "px");
                }



                $this.on("mouseover", function(e){
                    legend.css("top", ($this.height() - legendHeight) + "px");

                });
                $this.on("mouseout", function(e){
                    legend.css("top",  ($this.height() - titleHeight) + "px");

                });

                $(w).on("resize", function(){
                    update();
                });

                update();
            });
        }
    }
    )($, this);
    $(function(){
        $(".jqlegender").jqLegender();

    });
});
