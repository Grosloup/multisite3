var evtManager = new EventManager();
var cacheManager = new CacheManager();
var calMediator = new CalendarMediator(evtManager, cacheManager);
var calOpts = {};
var calManagerOpts = {
    AnimationDaySelectorOptions: {
        animationDays: animationDays
    }
};
var calendar = new Calendar(document.querySelector("#calendrier"),evtManager, calMediator, calOpts);
var calManager= new CalendarManager(document.querySelector("#calendrierManager"),evtManager, calMediator, calManagerOpts);

