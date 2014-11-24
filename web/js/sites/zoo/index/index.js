requirejs.config({
    baseUrl: "/js/sites",
    paths: {
        jquery: "../vendor/jquery-2.1.1.min",
        waypoints: "../vendor/waypoints.min",
        waypoints_sticky: "../vendor/waypoints-sticky.min",
        scrollTo: "../vendor/jquery.scrollTo.min",
        modal: "common/modal/Modal.min",
        Carousel: "common/carousel/Carousel.min",
        Slide: "common/carousel/Slide.min",
        nanoScroller: "../vendor/jquery.nanoscroller.min"
    }
});
require(["jquery","waypoints_sticky", "scrollTo", "nanoScroller"], function($){
    $(function(){
        $("#stickytop").waypoint('sticky');
        $(".nano").nanoScroller({
            alwaysVisible: true,
            sliderMaxHeight: 50,
            sliderMinHeight: 50
        });
        $("#menu-toggler").on("click", function(e){
            e.preventDefault();
            $.scrollTo( this.hash, 300);

        });
    });
});
require(["jquery","Carousel"], function($,app){
    $(function(){
        var hCarousel = app.Carousel.initHeaderCarousel($("#hCarousel"), {
            duration: sliderDuration || 3000,
            fadeTransionTime: 800,
            auto: true,
            hasNavigation: false
        });
    });
});

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
