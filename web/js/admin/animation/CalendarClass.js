
if(!window.deepCopy){
    var deepCopy = function(ojb){
        if (Object.prototype.toString.call(obj) === '[object Array]') {
            var out = [], i = 0, len = obj.length;
            for ( ; i < len; i++ ) {
                out[i] = deepCopy(obj[i]);
            }
            return out;
        }
        if (typeof obj === 'object') {
            var out = {}, i;
            for ( i in obj ) {
                out[i] = deepCopy(obj[i]);
            }
            return out;
        }
        return obj;
    }
}




function Calendar(elem, options){
    this.today = this.currentMonth = this.currentYear = this.currentDay = null;
    this.events = this.prevBtn = this.nextBtn = null;
    this.selectedEvent = this.messenger = this.messengerBody =  this.overlay = null;
    this.hasNavBtns = false;
    this.clickEventEnabled = false;
    options = options||{};
    this.init(elem, options);
}

Calendar.DEFAULTS = {
    baseUrl: "/",
    navButtons: true,
    navPrevBtnOpts: {"html": "&laquo;", "class": "cal-btn cal-prev-btn"},
    navNextBtnOpts: {"html": "&raquo;", "class": "cal-btn cal-prev-btn"},
    calClassPrefix:"cal-",
    headRowClass : "cal-head-row",
    headCellClass : "cal-head-cell",
    rowClass: "cal-row",
    bodyRowClass: "cal-body-row",
    bodyCellClass: "cal-body-cell",
    calCellTodayClass: "cal-cell-today",
    dayClass: "cal-day",
    emptyCellClass: "cal-empty-cell",
    cellClass: "cal-cell",
    bodyClass: "cal-body",
    evtLayerClass: "cal-evt-layer",
    overlayClass: "cal-overlay",
    overlayHideClass: "hide",
    messengerClass: "cal-messenger",
    messengerBodyClass: "cal-messenger-body",
    monthes: ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],
    days: ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"],
    mouseClickCb: _.noop,
    prevBtnClickCb: _.noop,
    nextBtnClickCb: _.noop,
    createEventView: _.noop, // 1 argument isUnique => 1 événement (true) à representer ou une collection (false)
    removeEventViews: _.noop,
    removeAllEventViews: _.noop,
    deleteEventCb: _.noop
};

Calendar.prototype.init = function(elem, options){
    this.elem = elem;
    this.$view = $(elem);
    this.$view.addClass("cal");
    this.options = $.extend(true, {}, Calendar.DEFAULTS, options );

    this.today = new Date();
    this.currentMonth = this.today.getMonth();
    this.currentYear = this.today.getFullYear();
    this.currentDay = this.today.getDate();


    this.buildHeader();
    this.buildBody();
    this.build();
    this.buildEvtLayer();
    this.buildEventLayer();
    this.buildMessenger();
    this.initEvents();
    this.initMouseEvents();

    this.clickEventEnabled = true;
};

Calendar.prototype.buildMessenger = function(){
    this.overlay = $("<div />", {"class":this.options.overlayClass + " " + this.options.overlayHideClass});
    $("body").append(this.overlay);

    this.messenger = $("<div />", {"class": this.options.messengerClass});
    this.messengerBody = $("<div />", {"class": this.options.messengerBodyClass});
    this.messenger.append(this.messengerBody);
    this.overlay.append(this.messenger);
};

Calendar.prototype.displayMessage = function(message){
    this.messengerBody.empty();
    this.messengerBody.html(message);
    this.overlay.removeClass(this.options.overlayHideClass);
};

Calendar.prototype.eraseMessage = function(){
    this.messengerBody.empty();
    this.overlay.addClass(this.options.overlayHideClass);
};

Calendar.prototype.build = function(){
    var firstDay, firstDayNum, numDaysInMonth, lastDay, numWeeks, calClass;
    firstDay = new Date(this.currentYear, this.currentMonth, 1);
    firstDayNum = this.getReelDay(firstDay);
    numDaysInMonth = this.getNumDaysInMonth(this.currentYear, this.currentMonth);
    lastDay = new Date(this.currentYear, this.currentMonth, numDaysInMonth);
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
                    this.currentYear == this.today.getFullYear() &&
                    this.currentMonth == this.today.getMonth() &&
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

Calendar.prototype.buildEvtLayer = function(){
    this.evtLayer = $("<div />", {"class":this.options.evtLayerClass});
    this.$view.append(this.evtLayer);
};

Calendar.prototype.buildEventLayer = function(){
    var firstDay, firstDayNum, numDaysInMonth, lastDay, numWeeks;
    firstDay = new Date(this.currentYear, this.currentMonth, 1);
    firstDayNum = this.getReelDay(firstDay);
    numDaysInMonth = this.getNumDaysInMonth(this.currentYear, this.currentMonth);
    lastDay = new Date(this.currentYear, this.currentMonth, numDaysInMonth);
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
                cell.attr("data-celldate", this.currentYear + "/" + (this.currentMonth+1) + "/" +dayNum);
                dayNum++;
            } else {
                cell = this.createCell(false);
            }
            dayCounter++;
            row.append(cell);
        }
        this.evtLayer.append(row);
    }
};

Calendar.prototype.buildHeader = function(){
    var row, i;
    if(this.options.navButtons === true){
        row = this.createRow(this.options.headRowClass);
        this.prevBtn = this.createButton(this.options.navPrevBtnOpts);
        this.nextBtn = this.createButton(this.options.navNextBtnOpts);
        row.append(this.prevBtn, this.nextBtn);
        this.$view.append(row);
        this.hasNavBtns = true;
    }
    row = this.createRow(this.options.headRowClass);
    i = 0;
    for(;i<7;i++){
        var cell = $("<div />", {"class": this.options.headCellClass, "text":this.options.days[i]});
        row.append(cell);
    }
    this.$view.append(row);
};

Calendar.prototype.createButton = function(opt){
  var btn;
    btn = $("<button />");
    if(_.has(opt, "text")){
        btn.text(opt["text"]);
    }
    if(_.has(opt, "html")){
        btn.html(opt["html"]);
    }
    if(_.has(opt, "class")){
        btn.addClass(opt["class"]);
    }
    return btn;
};

Calendar.prototype.buildBody = function(classname){
    this.body = $("<div />", {"class": classname||this.options.bodyClass});
    this.$view.append(this.body);

};

Calendar.prototype.find = function (selector) {
    if(selector.charAt(0) == "#"){
        this.$view.find(selector);
    }
    return this.$view.find('.' + selector);
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

Calendar.prototype.getCell = function (idx) {
    var dataIndex, cell;
    dataIndex = "[data-cellindex='"+idx+"']";
    cell = this.body.find(dataIndex);
    return cell;
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
    return this.options.monthes[this.currentMonth];
};

Calendar.prototype.emptyBody = function () {
    this.body.empty();
};

Calendar.prototype.emptyEvtLayer = function () {
    this.evtLayer.empty();
};

Calendar.prototype.initEvents = function () {
    var numDaysInMonth, i;
    numDaysInMonth = this.getNumDaysInMonth(this.currentYear, this.currentMonth);
    i=0;
    this.events = [];
    for(;i<numDaysInMonth;i++){
        this.events.push([]);
    }
};

Calendar.prototype.loadEvent = function (idx, evt) {
    this.events[idx].push(evt);
    this.options.createEventView(true, this, idx);
};

Calendar.prototype.loadEvents = function(events){
    this.events = events;
    this.options.createEventView(false, this);
};

// efface tous les événement dans une cellule
Calendar.prototype.unloadEvents = function (idx) {
    this.events[idx] = [];
    this.options.removeEventViews(false, this, idx);
};


// efface un événement dans une cellule
Calendar.prototype.unloadEvent = function (idx, prop, value) {
    var self = this, k = null;
    _.each(this.events[idx], function(v,i){
        if(_.has(v, prop) &&  _.isEqual(v[prop], value) ){
            k=i;
        }
    });
    if(k !== null){
        this.events[idx].splice(k, 1);
    }

    //this.options.removeEventViews(true, this, idx, value);
};

Calendar.prototype.deleteEvent = function(idx, prop, value){

    this.options.deleteEventCb(idx, prop, value, this);

};

Calendar.prototype.unloadAllEvents = function(){
    this.events = [];
    this.options.removeAllEventViews(this);
};

Calendar.prototype.getEvents = function(idx){
    return this.events[idx];
};

Calendar.prototype.getAllEvents = function(){
    return this.events;
};

Calendar.prototype.getSelectedEvent = function(){
    return this.selectedEvent;
};

Calendar.prototype.nextMonth = function () {
    this.currentMonth += 1;
    if(this.currentMonth > 11){
        this.currentMonth = 0;
        this.currentYear += 1;
    }
    this.rebuild();
};

Calendar.prototype.prevMonth = function () {
    this.currentMonth -= 1;
    if(this.currentMonth < 0){
        this.currentMonth = 11;
        this.currentYear -= 1;
    }
    this.rebuild();
};

Calendar.prototype.rebuild = function(){
    this.build();
    this.buildEventLayer();
    this.initEvents();
};

Calendar.prototype.disableBtns = function(){
    if(!this.hasNavBtns){
        return;
    }
    this.prevBtn.attr("disabled", "disabled");
    this.nextBtn.attr("disabled", "disabled");
};

Calendar.prototype.enableBtns = function(){
    if(!this.hasNavBtns){
        return;
    }
    this.prevBtn.attr("disabled", false);
    this.nextBtn.attr("disabled", false);
};

Calendar.prototype.disableCellClick = function(){
    this.clickEventEnabled = false;
};

Calendar.prototype.enableCellClick = function(){
    this.clickEventEnabled = true;
};

Calendar.prototype.initMouseEvents = function(){
    var self = this;

    if(this.hasNavBtns === true){
        if(this.prevBtn !== null){
            this.prevBtn.on("click", function(e){
                e.preventDefault();
                self.prevMonth();
                self.options.prevBtnClickCb(this, self, e);
            });
        }
        if(this.nextBtn !== null){
            this.nextBtn.on("click", function(e){
                e.preventDefault();
                self.nextMonth();
                self.options.nextBtnClickCb(this, self, e);
            });
        }
    }

    $(document).on("click", "[data-cell]", function(e){
        e.preventDefault();
        if(!self.clickEventEnabled){
            return;
        }
        var index = $(this).data("cellindex");
        if(index !== null){
            self.selectedEvent = self.events[index];
        }
        var copy = [];
        _.each(self.selectedEvent, function(v){
            copy.push(_.clone(v));
        });
        self.options.mouseClickCb(this, self.selectedEvent, e);
    });
};













