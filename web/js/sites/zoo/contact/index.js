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

require(["jquery", "modal"], function($, m){

    (function($,m){
        $.fn.zpbModal = function(options){
            var body = $("body");
            if($("> #overlay", body).length < 1){
                body.prepend($("<div id='overlay' />"));
            }

            return this.each(function(){
                if(!$.data(this, "zpbModal")){
                    $.data(this, "zpbModal", new m.Modal(this, options));
                }
            });
        };
    })($,m);
    $(function(){


        function selectInterloc(value){
            var options = $("#info_zoo_contact_form_interlocutor").find("option");
            options.attr("selected", false);
            options.each(function(){
                if($(this).val() === value){
                    $(this).attr("selected", true);
                }
            });
        }
        var $modal = $(".modal");
        $modal.zpbModal();
        var modal = $modal.data("zpbModal");
        $(".contact").on("click", function(e){
            e.preventDefault();
            selectInterloc($(this).data("id"));
            modal.open();
        })
    })
});
