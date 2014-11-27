requirejs.config({
    baseUrl: "/js/sites",
    paths: {
        jquery: "../vendor/jquery-2.1.1.min",
        waypoints: "../vendor/waypoints.min",
        waypoints_sticky: "../vendor/waypoints-sticky.min",
        scrollTo: "../vendor/jquery.scrollTo.min",
        modal: "common/modal/Modal.min",
        Carousel: "common/carousel/Carousel.min",
        Slide: "common/carousel/Slide.min"
    }
});
require(["waypoints_sticky", "scrollTo"], function(){
    $(function(){
        $("#stickytop").waypoint('sticky');
        var topMenuDropdowns = $("#multisite-menu-nav li.dropdown");
        $("#menu-toggler").on("click", function(e){
            e.preventDefault();
            $.scrollTo( this.hash, 300);
        });
        topMenuDropdowns.on("click", function(e){
            e.preventDefault();
            e.stopPropagation();
            if($(this).hasClass("open")){
                $(this).removeClass("open");
            } else{
                topMenuDropdowns.removeClass("open");
                $(this).addClass("open");
            }
        });
        $(document).on("click", function(e){
            topMenuDropdowns.removeClass("open");
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
    $(function(){
        $(".faq-question").on("click", function(e){
            e.preventDefault();
            var response = $(this).next(".faq-response");

            if(response.hasClass("is-hide")){
                $(this).addClass("is-active");
                response.slideDown(200, function(){
                    response.removeClass("is-hide").addClass("is-shown");
                });
            } else {
                $(this).removeClass("is-active");
                response.slideUp(200, function(){
                    response.removeClass("is-shown").addClass("is-hide");
                });
            }
        })
    });
});
