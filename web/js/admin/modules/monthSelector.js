
if(typeof deepCopy !== "function"){
    alert("addons.js file is missing !");
}

function MonthSelector(evtManager, options) {
    this.$view = this.options = this.index = null;
    this.prevMonthBtn = this.nextMonthBtn = this.monthSelector = null;
    this.isLocked = null;
    this.eventManager = evtManager;
    this.init(options);
}

MonthSelector.DEFAULTS = {
    viewClass: "month-selector",
    monthes: ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],
    prevMonthBtnClass: "cal-prev-month-btn",
    prevMonthBtnHtml: "<i class='fa fa-chevron-left'></i>",
    nextMonthBtnClass: "cal-next-month-btn",
    nextMonthBtnHtml: "<i class='fa fa-chevron-right'></i>",
    monthSelectorClass: "cal-month-select"
};

MonthSelector.prototype.init = function(options){
    this.options = $.extend(true, {}, MonthSelector.DEFAULTS, options || {});
    this.isLocked = true;
    this.build();
    this.initEvents();
};

MonthSelector.prototype.build = function(){
    this.$view = $("<div />", {"class": this.options.viewClass});
    this.prevMonthBtn = $("<button />", {"class": this.options.prevMonthBtnClass,"html":this.options.prevMonthBtnHtml});
    this.monthSelector = $("<select />", {"class": this.options.monthSelectorClass});
    var self = this;
    forEach(this.options.monthes, function(e,i){
        var opt  = $("<option />", {"text": e, "value":i});
        if(self.index !== null && self.index == i){
            opt.attr("selected", "selected");
        }
        self.monthSelector.append(opt);
    });
        this.nextMonthBtn = $("<button />", {"class": this.options.nextMonthBtnClass,"html":this.options.nextMonthBtnHtml});
    this.$view.append(this.prevMonthBtn, this.monthSelector, this.nextMonthBtn);
    this.isLocked = false;
};

MonthSelector.prototype.select = function(idx){
    if(idx !== undefined){
        this.index = +idx;
    }
    this.monthSelector[0].value = this.index;
    this.isLocked = false;
    this.eventManager.trigger(new Event("ms:month:change", {month: this.index}));
};

MonthSelector.prototype.getView = function(curMonth){
    if(curMonth !== null || curMonth !== undefined){
        this.select(+curMonth);
    }
    return this.$view;
};

MonthSelector.prototype.getMonthName = function(){
    return this.options.monthes[this.index];
};

MonthSelector.prototype.initEvents = function(){
    var self = this;
    this.prevMonthBtn.on("click", function(e){
        e.preventDefault();
        if(self.index === null || self.isLocked){
            return;
        }
        self.isLocked = true;
        self.index -= 1;
        if(self.index < 0){
            self.index = 11;
            self.eventManager.trigger(new Event("ms:year:change", {year: -1}));
        }
        self.select();
    });

    this.nextMonthBtn.on("click", function(e){
        e.preventDefault();
        if(self.index === null || self.isLocked){
            return;
        }
        self.isLocked = true;
        self.index += 1;
        if(self.index > 11){
            self.index = 0;
            self.eventManager.trigger(new Event("ms:year:change", {year: +1}));
        }
        self.select();
    });

    this.monthSelector[0].addEventListener("change", function(evt){
        if(self.index === null || self.isLocked){
            return;
        }
        self.index = parseInt(evt.target.value);
        self.eventManager.trigger(new Event("ms:month:change", {month: self.index}));
        return false;
    }, false);

};
