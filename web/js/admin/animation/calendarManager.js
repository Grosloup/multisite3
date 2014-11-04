if(typeof deepCopy !== "function"){
    alert("addons.js file is missing !");
}

/*
this.datas = {
    day: day num
    month: month num ( ! 0 - 11 )
    year: year num
    index: day index ( cache ...)
    events: [{color, id, name}, ... ]

    evtManager: current event manager
}
 */

function CalendarManager(elem,evtManager, mediator, options){
    this.options = this.elem = this.$view = null;
    this.mediator = null;
    this.datas = null;
    this.eventManager = evtManager;
    this.curYear = this.curMonth = this.curDate;
    this.animationDaySelector = null;
    this.header = this.title = this.body = this.list = null;
    this.init(elem, mediator, options);
}

CalendarManager.DEFAULTS = {
    AnimationDaySelectorOptions: {},
    viewClass: "cal-manager",
    headerClass: "cal-manager-header",
    bodyClass: "cal-manager-body",
    listClass: "cal-manager-list",
    listRowClass: "cal-manager-list-row",
    deleteBtnClass: "cal-manager-list-row-delete",
    deleteHtml: "<i class='fa fa-times'></i>",
    titleDefaultText: "Séléctionnez une date dans le calendrier"
};

CalendarManager.prototype.init = function(elem, mediator, options){
    this.options = $.extend(true, {}, CalendarManager.DEFAULTS, options || {});
    this.mediator = mediator || {};
    this.mediator.setCalendarManager(this);
    this.elem = elem;
    this.$view = $(elem);
    this.animationDaySelector = new AnimationDaySelector(this.eventManager, this.options.AnimationDaySelectorOptions);
    this.$view.addClass(this.options.viewClass);
    this.build();
    this.attachEvents();
    this.initEvents();
    this.lock();
};

CalendarManager.prototype.attachEvents = function(){
    this.eventManager.attach("ads:day:change", this.addRow.bind(this));
};

CalendarManager.prototype.build = function(){
    this.header = $("<div />", {"class": this.options.headerClass});
    this.title = $("<h6 />", {"text": this.options.titleDefaultText});
    this.header.append(this.title);
    this.body = $("<div />", {"class": this.options.bodyClass});
    this.list = $("<ul />", {"class": this.options.listClass});
    this.body.append(this.animationDaySelector.getView(), this.list);
    this.$view.append(this.header, this.body);
};

CalendarManager.prototype.setTitle = function(){
    this.title.text("Date : " + this.datas.day + "/" + (this.datas.month+1) + "/" +this.datas.year);
};

/**
 *
 * @param {Day} datas
 */
CalendarManager.prototype.buildList = function(datas){
    if(datas !== undefined){
        this.datas = datas;
        this.setTitle();
    }
    var self = this;
    this.list.empty();
    forEach(this.datas.events, function(e,i){
        self.createListRow(e);
    });
    this.unlock();
};

CalendarManager.prototype.createListRow = function(dataObj){
    var li = $("<li />", {"class":this.options.listRowClass, "text": dataObj["name"], "data-lidayid": dataObj["id"]});
    var a = $("<a />",
        {
            "class":this.options.deleteBtnClass,
            "html":this.options.deleteHtml,
            "href":"#",
            "data-delete": "",
            "data-dayid": dataObj["id"]
        });
    li.append(a);
    this.list.append(li);
};

CalendarManager.prototype.removeRow = function(datas){
    var k=null;
    forEach(this.datas.events, function(e,i){
        if(e["id"] == datas.eventId){
            k=i;
        }
    });
    if(k !== null){
        this.datas.events.splice(k,1);
        this.list.find("[data-lidayid='"+ datas.eventId +"']").remove();
    }
};

/**
 *
 * @param {Event} datas
 *  {name, datas:{selected:{color, name, id}}}
 */
CalendarManager.prototype.addRow = function(datas){
    var k=null;
    forEach(this.datas.events, function(e,i){
        if(e["id"] == datas.datas.selected["id"]){
            k=i;
        }
    });
    if(k !== null) return false;
    this.mediator.addEvent(
        {
            day: this.datas.day,
            month: this.datas.month ,
            year: this.datas.year,
            dayType: datas.datas.selected
        }
    );
};

CalendarManager.prototype.addEvent = function(dayType){
    this.datas.events.push(dayType);
    this.buildList();
};

CalendarManager.prototype.lock = function(){
    this.isLocked = true;
    this.animationDaySelector.isLocked = true;
};

CalendarManager.prototype.unlock = function(){
    this.isLocked = false;
    this.animationDaySelector.isLocked = false;
};

CalendarManager.prototype.initEvents = function(){
    var self = this;
    this.body.on("click", "[data-delete]", function(e){
        e.preventDefault();
        if(self.isLocked === true) return false;
        var id = $(this).attr("data-dayid");
        self.eventManager.trigger(new Event("cm:day:removeEvent", {eventId: +id, eventsDay: self.datas}));
    });
};
