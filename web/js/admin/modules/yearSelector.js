if(typeof deepCopy !== "function"){
    alert("addons.js file is missing !");
}

function YearSelector(evtManager, options) {
    this.$view = this.options = this.index = null;
    this.prevYearBtn = this.nextYearBtn = this.yearSelector = null;
    this.max = this.min = null;
    this.isLocked = null;
    this.eventManager = evtManager;
    this.init(options);
}

YearSelector.DEFAULTS = {
    range: 5,
    viewClass: "year-selector",
    prevYearBtnClass: "cal-prev-year-btn",
    prevYearBtnHtml: "<i class='fa fa-chevron-left'></i>",
    nextYearBtnClass: "cal-next-year-btn",
    nextYearBtnHtml: "<i class='fa fa-chevron-right'></i>",
    yearSelectorClass: "cal-year-select"
};

YearSelector.prototype.init = function(options){
    this.options = $.extend(true, {}, YearSelector.DEFAULTS, options || {});
    this.isLocked = true;
    this.build();
    this.attachEvents();
    this.initEvents();
};

YearSelector.prototype.attachEvents = function(){
    this.eventManager.attach("ms:year:change", this.refresh.bind(this));
};

YearSelector.prototype.build = function(){
    this.$view = $("<div />", {"class": this.options.viewClass});
    this.prevYearBtn = $("<button />", {"class": this.options.prevYearBtnClass,"html":this.options.prevYearBtnHtml});
    this.yearSelector = $("<select />", {"class": this.options.yearSelectorClass});
    this.nextYearBtn = $("<button />", {"class": this.options.nextYearBtnClass,"html":this.options.nextYearBtnHtml});
    this.$view.append(this.prevYearBtn, this.yearSelector, this.nextYearBtn);
    this.isLocked = true;
};



YearSelector.prototype.getView = function(curYear){
    curYear = +curYear;
    this.min = curYear -this.options.range;
    this.max = curYear + this.options.range -1;
    var i;
    i = -this.options.range;
    for(;i<this.options.range; i++){
        var opt  = $("<option />", {"text": (curYear + i)+"", "value":(curYear + i)});
        this.yearSelector.append(opt);

    }
    this.select(curYear);
    return this.$view;
};

YearSelector.prototype.select = function(idx){
    if(idx !== undefined){
        this.index = +idx;
    }
    this.yearSelector[0].value = this.index;
    this.isLocked = false;
    this.eventManager.trigger(new Event("ys:year:select", {year: this.index}));
};

YearSelector.prototype.change = function(idx){
    if(idx !== undefined){
        this.index = +idx;
    }
    this.yearSelector[0].value = this.index;
    this.isLocked = false;
    this.eventManager.trigger(new Event("ys:year:change", {year: this.index}));
};

YearSelector.prototype.initEvents = function(){
    var self = this;
    this.prevYearBtn.on("click", function(e){
        e.preventDefault();
        if(self.index === null || self.isLocked === true){
            return false;
        }
        self.isLocked = true;
        self.index -= 1;
        if(self.index < self.min){
            self.index = self.min;
        }
        self.select();
    });

    this.nextYearBtn.on("click", function(e){
        e.preventDefault();
        if(self.index === null || self.isLocked === true){
            return false;
        }
        self.isLocked = true;
        self.index += 1;
        if(self.index > self.max){
            self.index = self.max;
        }
        self.select();
    });

    this.yearSelector[0].addEventListener("change", function(evt){
        if(self.index === null || self.isLocked === true){
            return false;
        }
        self.index = parseInt(evt.target.value);
        self.eventManager.trigger(new Event("ys:year:change", {year: self.index}));
        return false;
    }, false);

};

YearSelector.prototype.refresh = function(evt){
    if(!(evt instanceof Event)){
        return;
    }
    this.isLocked = true;
    this.index = this.index + evt.datas["year"];
    if(this.index > this.max){
        this.index = this.max;
    }
    if(this.index < this.min){
        this.index = this.min;
    }

    this.change();

};
