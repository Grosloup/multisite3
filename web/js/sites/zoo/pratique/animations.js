/// <reference path="../../../dts/require.d.ts" />
/// <reference path="../../../dts/jquery.d.ts" />
/// <reference path="../../../dts/jquery.scrollTo.d.ts" />
requirejs.config({
    baseUrl: "/js/sites",
    paths: {
        jquery: "../vendor/jquery-2.1.1.min",
        waypoints: "../vendor/waypoints.min",
        waypoints_sticky: "../vendor/waypoints-sticky.min",
        scrollTo: "../vendor/jquery.scrollTo.min",
        Carousel: "common/carousel/Carousel.min",
        Slide: "common/carousel/Slide.min",
        Event: "common/event/Event",
        EventManager: "common/event/EventManager",
        MonthSelector: "common/uis/MonthSelector",
        Calendar: "common/calendar/Calendar",
        Day: "common/calendar/Day",
        CalendarMediator: "zoo/pratique/animations/CalendarMediator",
        Program: "zoo/pratique/animations/Program"
    }
});
require(["waypoints_sticky", "scrollTo"], function () {
    $(function () {
        $("#stickytop").waypoint('sticky');
        var topMenuDropdowns = $("#multisite-menu-nav li.dropdown");
        $("#menu-toggler").on("click", function (e) {
            e.preventDefault();
            $.scrollTo(this.hash, 300);
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
require(["jquery", "Carousel"], function ($, app) {
    $(function () {
        var hCarousel = app.Carousel.initHeaderCarousel($("#hCarousel"), {
            duration: sliderDuration || 3000,
            fadeTransionTime: 800,
            auto: true,
            hasNavigation: false
        });
    });
});
require(["jquery", "CalendarMediator", "EventManager", "Calendar", "Program"], function ($, CM, EM, C, P) {
    $(function () {
        var mediatorOptions = {};
        var calendarOptions = {};
        var showsOptions = {
            elemType: "shows",
            mediatorName: "shows"
        };
        var animationsOptions = {
            elemType: "animations",
            mediatorName: "animations",
            headerTitleText: "<h3>Animations</h3>"
        };
        var calendarElement = $("#calendar");
        var animationsElement = $("#animations");
        var showsElement = $("#shows");

        var evtManager = new EM.EventManager();
        var mediator = new CM.CalendarMediator(evtManager, mediatorOptions);

        var animations = new P.Program(animationsElement, mediator, evtManager, animationsOptions);
        var shows = new P.Program(showsElement, mediator, evtManager, showsOptions);
        var calendar = new C.Calendar(calendarElement, mediator, evtManager, calendarOptions);
    });
});
//# sourceMappingURL=animations.js.map
