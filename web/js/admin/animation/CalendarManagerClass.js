function CalendarManager(elem, options){
    this.elem = this.$view = this.header = this.body = null;
    this.loadedEvents = this.evtList = this.calendar = null;
    this.eventIndex = this.eventSelector = null;
    options = options||{};
    this.init(elem, options);
}

CalendarManager.DEFAULTS = {
    events: [],
    viewClass: "cal-manager",
    headerClass: "cal-manager-header",
    bodyClass: "cal-manager-body",
    footerClass: "cal-manager-footer",
    eventSelectorClass: "cal-manager-event-selector",
    eventSelectorDefaultOptionText: "choisissez une journée type",
    evtListClass: "cal-manager-events-list",
    evtRowClass: "cal-manager-event-row",
    deleteBtnClass: "cal-manager-delete-btn",
    deleteBtnText: "x"
};


CalendarManager.prototype.init = function (elem, options) {
    this.options = $.extend(true, {}, CalendarManager.DEFAULTS, options );
    this.elem = elem;
    this.$view = $(elem);
    console.log(this.options);
    this.$view.addClass(this.options.viewClass);

    this.buildHeader();
    this.buildBody();
    this.buildFooter();

    this.initMouseEvents();
};

CalendarManager.prototype.buildHeader = function(){
    this.header = $("<div />", {"class": this.options.headerClass});
    this.$view.append(this.header);
};

CalendarManager.prototype.buildBody = function(){
    this.body = $("<div />", {"class": this.options.bodyClass});
    var l;
    l = this.options.events.length;
    if(l > 0){
        var i;
        i=0;
        this.eventSelector = $("<select />", {"class": this.options.eventSelectorClass});
        this.eventSelector.append($("<option />", {"text": this.options.eventSelectorDefaultOptionText, "value":""}));
        for(;i<l;i++){
            var opt = $("<option />",
                {
                    "text": this.options.events[i].name,
                    "value": this.options.events[i].id
                }
            );
            this.eventSelector.append(opt);
        }

        this.body.append(this.eventSelector);
    }

    this.evtList = $("<ul />", {"class": this.options.evtListClass});
    this.body.append(this.evtList);
    this.$view.append(this.body);
};

CalendarManager.prototype.buildFooter = function(){
    this.footer = $("<div />", {"class": this.options.footerClass});
    this.$view.append(this.footer);
};

CalendarManager.prototype.loadEvents = function(events, date, cal){
    this.header.html("<h5>" + date + "</h5>");
    this.loadedEvents = events;
    this.eventIndex = parseInt(date.split("/")[2]) - 1;
    if(this.calendar == null){
        this.calendar = cal;
    }
    this.displayEvents();
};

CalendarManager.prototype.createEventRow = function(evt){
    var li = $("<li />", {"class": this.options.evtRowClass});
    li.append($("<span />", {"text" : evt.name}));
    li.append(this.createDeleteBtn(this.eventIndex, evt.id));
    return li;
};

CalendarManager.prototype.displayEvents = function(){
    var self = this;
    this.evtList.empty();
    _.each(this.loadedEvents, function(evt, i){
        self.evtList.append(self.createEventRow(evt));
    });
};

CalendarManager.prototype.addEvent = function(id){
    var k = null;
    id = parseInt(id);
    _.each(this.options.events, function(v,i){
        if(v.id == id){
            k = i;
        }
    });
    if(k !== null){
        this.evtList.append(this.createEventRow(this.options.events[k]));
        this.calendar.loadEvent(this.eventIndex, this.options.events[k]);
    }
};

CalendarManager.prototype.createDeleteBtn = function(idx, evtId){
    return $("<a />",
        {
            "class": this.options.deleteBtnClass,
            "text":this.options.deleteBtnText,
            "href":"#",
            "data-delete":idx,
            "data-deleteid": evtId
        }
    );
};

CalendarManager.prototype.deleteEvent = function(evtId){
    var self = this, k = null;
    _.each(this.loadedEvents, function(v,i){
        if(v.id == evtId){
            k = i;
        }
    });
    if(k !== null){
        this.loadedEvents.splice(k, 1);
    }
};

CalendarManager.prototype.initMouseEvents = function(){
    var self = this;

    if(this.eventSelector != null){
        this.eventSelector.on("change", function(e){
            e.preventDefault();
            var val = $(this).find("option:selected").val();
            if(val != ""){

                self.addEvent(val);
            }
        });
    }

    $(document).on("click", "[data-delete]", function(e){
        e.preventDefault();
        self.deleteEvent($(this).attr("data-deleteid"));
        self.calendar.deleteEvent($(this).attr("data-delete"), "id", $(this).attr("data-deleteid"));
        $(this).parent().remove();
    })
};









