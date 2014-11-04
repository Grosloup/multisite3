if(typeof deepCopy !== "function"){
    alert("addons.js file is missing !");
}

function AnimationDaySelector(evtManager, options){
    this.$view = this.options = null;
    this.evtManager = evtManager;
    this.selector = null;
    this.isLocked = null;
    this.init(options)
}

AnimationDaySelector.DEFAULTS = {
    animationDays: [],
    viewClass: "animation-days-selector",
    selectorClass: "cal-animation-days-select",
    emptyOptionText: "Ajoutez une journée type"
};

AnimationDaySelector.prototype.init = function(options){
    this.isLocked = true;
    this.options = $.extend(true, {}, AnimationDaySelector.DEFAULTS, options||{});

    this.build();
    this.initEvents();
};

AnimationDaySelector.prototype.build = function(){
    var self = this;
    this.$view = _c("div", {"class": this.options.viewClass});
    this.selector = _c("select", {"class": this.options.selectorClass});
    var opt = _c("option", {"text": this.options.emptyOptionText, "value": ""});
    this.selector.appendChild(opt);
    forEach(this.options.animationDays, function(d,i){
       var opt = _c("option", {"text": d.name, "value": i});
        self.selector.appendChild(opt);
    });
    this.$view.appendChild(this.selector);
};

AnimationDaySelector.prototype.getView = function(){
    return this.$view;
};

AnimationDaySelector.prototype.initEvents = function(){
    var self = this;
    this.selector.addEventListener("change", function(e){
        if(self.isLocked === true){
            return false;
        }
        var val = e.target.value;
        if(val != ""){
            var selected = self.options.animationDays[+val];
            self.evtManager.trigger(new Event("ads:day:change", {"selected": selected}));
        }
        return false;
    }, false);
};
