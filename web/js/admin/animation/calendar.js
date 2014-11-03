if(typeof deepCopy !== "function"){
    alert("addons.js file is missing !");
}


function Calendar(elem, evtManager, mediator, options){
    this.options = this.elem = this.$view = null;
    this.mediator = null;
    this.header = this.body = this.eventLayer = null;
    this.eventManager = evtManager;
    this.yearSelector = this.monthSelector = null;
    this.datas = null;
    this.isLocked = null;
    this.today = this.curYear = this.curMonth = this.curDate = null;
    this.loader = null;
    this.days = null;
    this.init(elem, mediator, options);
}

Calendar.DEFAULTS = {
    yearSelectorOptions: {},
    monthSelectorOptions: {},
    days: ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"],
    calClassPrefix : "cal-",
    viewClass: "cal",
    headerClass: "cal-header",
    bodyClass: "cal-body",
    eventLayerClass: "cal-event-layer",
    prevYearBtnClass: "cal-prev-year-btn",
    prevYearBtnHtml: "<i class='fa fa-chevron-left'></i>",
    nextYearBtnClass: "cal-next-year-btn",
    nextYearBtnHtml: "<i class='fa fa-chevron-right'></i>",
    yearSelectorClass: "cal-year-select",
    errorMessageClass: "cal-error-message",
    rowClass: "cal-row",
    bodyRowClass: "cal-body-row",
    bodyCellClass: "cal-body-cell",
    calCellTodayClass: "cal-cell-today",
    dayClass: "cal-day",
    emptyCellClass: "cal-empty-cell",
    cellClass: "cal-cell"
};

Calendar.prototype.init = function(elem, mediator, options){
    this.options = $.extend(true, {}, Calendar.DEFAULTS, options || {});
    this.mediator = mediator || {};
    this.mediator.setCalendar(this);
    this.elem = elem;
    this.$view = $(elem);
    this.$view.addClass(this.options.viewClass);
    this.isLocked = true;
    this.today = new Date();
    this.curMonth = this.today.getMonth();
    this.curYear = this.today.getFullYear();
    this.curDate = this.today.getDate();
    this.days = [];
    this.build();
    this.attachEvents();
    this.initMouseEvents();
};

Calendar.prototype.attachEvents = function(){
    this.eventManager.attach("ys:year:select", this.yearSelect.bind(this));
    this.eventManager.attach("ys:year:change", this.yearChange.bind(this));
    this.eventManager.attach("ms:month:change", this.monthChange.bind(this));
};


Calendar.prototype.build = function(){
    var i, l;
    // ###################################### header
    this.header = $("<div />", {"class": this.options.headerClass});
    this.loader = new Loader();
    this.monthSelector = new MonthSelector(this.eventManager, this.options.monthSelectorOptions);
    this.yearSelector = new YearSelector(this.eventManager, this.options.yearSelectorOptions);
    this.errorMessenger = $("<div />", {"class": this.options.errorMessageClass});
    this.header.append(
        this.monthSelector.getView(this.curMonth),
        this.yearSelector.getView(this.curYear),
        this.loader.get(true),
        this.errorMessenger.hide()
    );
    this.lock();
    this.loader.show();

    // ###################################### body
    this.body = $("<div />", {"class": this.options.bodyClass});
    this.eventLayer = $("<div />", {"class": this.options.eventLayerClass});
    this.buildBody();
    this.buildEventLayer();
    this.$view.append(this.header, this.body, this.eventLayer);
    this.mediator.getEvents(this.curYear, this.curMonth);
};

Calendar.prototype.lock = function(){
    this.isLocked = true;
    this.monthSelector.isLocked = true;
    this.yearSelector.isLocked = true;
};

Calendar.prototype.unlock = function(){
    this.isLocked = false;
    this.monthSelector.isLocked = false;
    this.yearSelector.isLocked = false;
};

Calendar.prototype.buildBody = function(){
    var firstDay, firstDayNum, numDaysInMonth, lastDay, numWeeks, calClass;
    firstDay = new Date(this.curYear, this.curMonth, 1);
    firstDayNum = this.getReelDay(firstDay);
    numDaysInMonth = this.getNumDaysInMonth(this.curYear, this.curMonth);
    lastDay = new Date(this.curYear, this.curMonth, numDaysInMonth);
    numWeeks = 2 + (numDaysInMonth - (this.getNumDaysFirstWeek(firstDayNum) + this.getReelDay(lastDay)))/7;
    calClass = this.options.calClassPrefix + numWeeks;
    this.$view.removeClass(this.options.calClassPrefix + "4 " + this.options.calClassPrefix + "5 " + this.options.calClassPrefix + "6");
    this.$view.addClass(calClass);
    this.emptyBody();
    var w= 0, d= 0, dayCounter = 1, dayNum = 1;
    for(;w<numWeeks;w++){
        var row = this.createBodyRow();
        d=0;
        for(;d<7;d++){
            var cell = this.createBodyCell();
            if(dayCounter >= firstDayNum && dayCounter < (numDaysInMonth + firstDayNum)){
                var day = this.createBodyDay(dayNum + '');
                cell.append(day);
                cell.attr("data-cellindex", dayNum-1);
                if(
                    this.curYear == this.today.getFullYear() &&
                    this.curMonth == this.today.getMonth() &&
                    dayNum == this.today.getDate()
                ){
                    cell.addClass(this.options.calCellTodayClass);
                }
                dayNum++;
            } else {
                cell.addClass(this.options.emptyCellClass);
            }
            dayCounter++;
            row.append(cell);
        }
        this.body.append(row);
    }
};

Calendar.prototype.buildEventLayer = function(){
    var firstDay, firstDayNum, numDaysInMonth, lastDay, numWeeks;
    firstDay = new Date(this.curYear, this.curMonth, 1);
    firstDayNum = this.getReelDay(firstDay);
    numDaysInMonth = this.getNumDaysInMonth(this.curYear, this.curMonth);
    lastDay = new Date(this.curYear, this.curMonth, numDaysInMonth);
    numWeeks = 2 + (numDaysInMonth - (this.getNumDaysFirstWeek(firstDayNum) + this.getReelDay(lastDay)))/7;
    this.emptyEvtLayer();
    var w= 0, d= 0, dayCounter = 1, dayNum = 1;
    for(;w<numWeeks;w++) {
        var row = this.createRow();
        d = 0;
        for (; d < 7; d++) {
            var cell;
            if (dayCounter >= firstDayNum && dayCounter < (numDaysInMonth + firstDayNum)) {
                cell = this.createCell(true);
                cell.attr("data-cellindex", dayNum-1);
                cell.attr("data-celldate", this.curYear + "/" + (this.curMonth+1) + "/" +dayNum);
                var day = new Day(dayNum-1, this.curMonth, this.curYear, this.eventManager);
                this.days.push(day);
                cell.data("day", day);
                dayNum++;
            } else {
                cell = this.createCell(false);
            }
            dayCounter++;
            row.append(cell);
        }
        this.eventLayer.append(row);
    }
};

Calendar.prototype.refresh = function(){
    this.errorMessenger.text("");
    this.errorMessenger.hide();
    this.loader.show();
    this.days = [];
    this.lock();
    this.buildBody();
    this.buildEventLayer();
    this.mediator.getEvents(this.curYear, this.curMonth);
};

Calendar.prototype.createBodyDay = function(text){
    return $('<span />', {'class':this.options.dayClass, 'text':text});
};
Calendar.prototype.getNumDaysInMonth = function(y,m){
    return new Date(y, m+1, 0).getDate();
};
Calendar.prototype.getReelDay = function(date){
    var d = date.getDay();
    if(d === 0){
        d = 7;
    }
    return d;
};
Calendar.prototype.getNumDaysFirstWeek = function(d){
    return 8 - d;
};
Calendar.prototype.getMonthName = function(){
    return this.monthSelector.getMonthName();
};
Calendar.prototype.emptyBody = function () {
    this.body.empty();
};
Calendar.prototype.emptyEvtLayer = function () {
    this.eventLayer.empty();
};

Calendar.prototype.createRow = function(classname){
    return $('<div />', {'class': classname||this.options.rowClass});
};

Calendar.prototype.createBodyRow = function(classname){
    return $('<div />', {'class': classname||this.options.bodyRowClass});
};

Calendar.prototype.createBodyCell = function(){
    return $('<div />', {'class': this.options.bodyCellClass});
};

Calendar.prototype.createCell = function(active){
    var d = $('<div />', {'class': this.options.cellClass});
    if(active){
        d.addClass("cal-cell-enabled");
        d.attr("data-cell", "");
    } else {
        d.addClass("cal-cell-disabled");
    }
    return d;
};

Calendar.prototype.yearSelect = function(evt){
    this.curYear = evt.datas["year"];
    this.refresh();
};

Calendar.prototype.yearChange = function(evt){
    this.curYear = evt.datas["year"];
};

Calendar.prototype.monthChange = function(evt){
    this.curMonth = evt.datas["month"];
    this.refresh();
};

Calendar.prototype.loadEvents = function(eventDays){
    var self = this;
    forEach(eventDays, function(e,i){
        self.days[i].events = e;
        var bodyCell = self.body[0].querySelector("[data-cellindex='"+i+"']");
        forEach(self.days[i].events, function(ev, j){
            bodyCell.appendChild(self.days[i].getView(j)[0]);
        });
    });
    this.loader.hide();
    this.unlock();
};

Calendar.prototype.showError = function(message){
    this.loader.hide();
    this.unlock();
    this.errorMessenger.text(message);
    this.errorMessenger.show();
};

Calendar.prototype.initMouseEvents = function(){
    var self = this;
    $(document).on("click", "[data-cell]", function(e){
        e.preventDefault();
        if(self.isLocked === true) return false;
        var day = deepCopy($(this).data("day"));
        self.eventManager.trigger(new Event("c:day:click",{day : day}));
    })
};
