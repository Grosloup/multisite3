if(typeof deepCopy !== "function"){
    alert("addons.js file is missing !");
}

function CalendarMediator(evtManager, cacheManager, options ){
    this.cacheManager = cacheManager;

    if(!has(this.cacheManager.caches, "calendar")){
        this.cacheManager.caches["calendar"] ={};
    }

    this.calendar = this.calManager = null;
    this.eventManager = evtManager;
    this.options = $.extend(true, {}, CalendarMediator.DEFAULTS, options || {});

    this.attachEvents();
}

CalendarMediator.prototype.attachEvents = function(){
    this.eventManager.attach("c:day:click", this.passDayToManager.bind(this));
    this.eventManager.attach("cm:day:removeEvent", this.removeEvent.bind(this));
};

CalendarMediator.prototype.passDayToManager = function(event){
    if(!event.datas["day"] instanceof Day){
        return false;
    }
    this.calManager.buildList(event.datas["day"]);
};

CalendarMediator.DEFAULTS = {
    baseUrl: "/animations/api/days",
    removeEventBaseUrl: "/animations/api/days",
    addEventBaseUrl: "/animations/api/days",
    datasIndexName: "days"
};

CalendarMediator.prototype.setCalendar = function(c){
    this.calendar = c;
};

CalendarMediator.prototype.setCalendarManager = function(c){
    this.calManager = c;
};

/**
 *
 * @param datas
 *  {day,month,year,dayType}
 *  @see calendarManager.js addRow
 */
CalendarMediator.prototype.addEvent = function(datas){
    var url, self = this;
    this.calendar.lock();
    this.calManager.lock();
    self.calendar.loader.show();
    url = this.options.addEventBaseUrl + "/" + datas.dayType["id"] + "/" + datas.year + "/" + (datas.month+1) + "/" + datas.day;
    $.post(
        url,
        {}
    ).done(function(response){
            if(response.error === false){
                //calManager create row et add datas
                self.calManager.addEvent(datas.dayType);
                //cache add datas
                self.cacheManager.caches["calendar"][datas.year][datas.month][datas.day-1].push(datas.dayType);
                //calendar refresh
                self.calendar.refresh();
            } else {
                self.calendar.showError(response.message);
            }
            self.calendar.loader.hide();
            self.calendar.unlock();
            self.calManager.unlock();
        }).fail(function(response){
            self.calendar.showError(response.status + " " + response.statusText);
            self.calendar.loader.hide();
            self.calendar.unlock();
            self.calManager.unlock();
        });
};


CalendarMediator.prototype.removeEvent = function(datas){
    var self = this;
    this.calendar.lock();
    this.calManager.lock();
    self.calendar.loader.show();
    var url;
    url = this.options.removeEventBaseUrl + "/" + datas.datas.eventId + "/" + datas.datas.eventsDay.year + "/" + (datas.datas.eventsDay.month+1) + "/" + datas.datas.eventsDay.day;
    $.ajax({
        type: "DELETE",
        url: url,
        data: {}
    }).done(
        function(response){
            if(response.error === false){
                self.calManager.removeRow(datas.datas);
                var k = null;
                forEach(self.cacheManager.caches["calendar"][datas.datas.eventsDay.year][datas.datas.eventsDay.month][datas.datas.eventsDay.index], function(e,i){
                    if(e["id"] == datas.datas.eventId){
                        k = i;
                    }
                });
                if(k !== null){
                    self.cacheManager.caches["calendar"][datas.datas.eventsDay.year][datas.datas.eventsDay.month][datas.datas.eventsDay.index].splice(k,1);
                }
                self.calendar.refresh();
            } else {
                self.calendar.showError(response.message);
            }
            self.calendar.loader.hide();
            self.calendar.unlock();
            self.calManager.unlock();
        }
    ).fail(
        function (response){
            self.calendar.showError(response.status + " " + response.statusText);
            self.calendar.loader.hide();
            self.calendar.unlock();
            self.calManager.unlock();
        }

    );
};


CalendarMediator.prototype.getEvents = function(year, month){

    if(has(this.cacheManager.caches["calendar"], year)){
        if(has(this.cacheManager.caches["calendar"][year], month)){
            if(this.cacheManager.caches["calendar"][year][month].length > 0){
                this.calendar.loadEvents(this.cacheManager.caches["calendar"][year][month]);
                return false;
            }
        } else {
            this.cacheManager.caches["calendar"][year][month] = [];
        }
    } else {
        this.cacheManager.caches["calendar"][year] = {};
        this.cacheManager.caches["calendar"][year][month] = [];
    }
    var url = this.options.baseUrl, self = this;

    url = url + "/" + year + "/" + (month+1);
    $
        .get(
            url,
            {}
        )
        .done(function (response) {
            if(response.error === false){
                self.cacheManager.caches["calendar"][year][month] = response[self.options.datasIndexName];
                self.calendar.loadEvents(response[self.options.datasIndexName]);
            } else {
                self.calendar.showError(response.message);
            }
        })
        .fail(function(response){
            self.calendar.showError(response.status + " " + response.statusText);
        });
};

