if(typeof deepCopy !== "function"){
    alert("addons.js file is missing !");
}
function Day(index,month,year, evtManager){
    this.evtManager = evtManager;
    this.index = index;
    this.day = this.index+1;
    this.month = month;
    this.year = year;
    this.events = [];
}

Day.prototype.addEvent = function(evt){
    this.events.push(evt);
    this.evtManager.trigger(
        new Event(
            "day:evt:add",
            {
                "index": this.index,
                "day": this.day,
                "month": this.month,
                "year": this.year,
                "event": evt
            }
        )
    );
};

Day.prototype.removeEvent = function(evtId){
    var k = null;
    forEach(this.events, function(e,i){
        if(has(e,"id") && e["id"] == evtId){
            k = i;
        }
    });
    if(k !== null){
        this.events.splice(i,1);
        this.evtManager.trigger(
            new Event(
                "day:evt:remove",
                {
                    "index": this.index,
                    "day": this.day,
                    "month": this.month,
                    "year": this.year,
                    "event": evt
                }
            )
        );
    }
};

Day.prototype.length = function(){
    return this.events.length;
};

Day.prototype.getView = function(idx){
    return $("<div />",
        {
            "class":"cal-event-marker",
            "data-eventid": this.events[idx]["id"]
        }
    ).css("background-color", this.events[idx]["color"]);
};
