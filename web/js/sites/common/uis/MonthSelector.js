define(["require", "exports", "jquery", "Event"], function (require, exports, $, E) {
    var MonthSelector = (function () {
        function MonthSelector(curMonth, curYear, evtManager, options) {
            this.curMonth = curMonth;
            this.curYear = curYear;
            this.evtManager = evtManager;
            this.isLocked = false;
            this.options = {};
            this.options = $.extend(true, {}, MonthSelector.DEFAULTS, options || {});
            this.init();
        }
        MonthSelector.prototype.init = function () {
            this.build();
            this.initMouseEvents();
        };
        MonthSelector.prototype.build = function () {
            var l, i;
            l = this.options["monthes"].length;
            i = 0;
            this.elem = $("<div/>", { "class": this.options["elemClass"] });
            this.selector = $("<select/>");
            for (; i < l; i++) {
                var opt = $("<option/>", { "value": i.toString(), "text": this.options["monthes"][i] });
                this.selector.append(opt);
            }
            this.year = $("<span/>", { "text": this.curYear, "class": this.options["yearClass"] });
            this.refresh();
            this.prevBtn = $("<a/>", { "class": this.options["prevBtnClass"], "href": "#", "html": "&lt;" });
            this.nextBtn = $("<a/>", { "class": this.options["nextBtnClass"], "href": "#", "html": "&gt;" });
            this.elem.append([
                this.prevBtn,
                this.selector,
                this.year,
                this.nextBtn
            ]);
        };
        MonthSelector.prototype.lock = function () {
            this.isLocked = true;
        };
        MonthSelector.prototype.unlock = function () {
            this.isLocked = false;
        };
        MonthSelector.prototype.getValue = function () {
            return this.selector.val();
        };
        MonthSelector.prototype.setValue = function (val) {
            this.selector.val(val);
        };
        MonthSelector.prototype.getElement = function () {
            return this.elem;
        };
        MonthSelector.prototype.refresh = function (index) {
            if (index != undefined) {
                this.curMonth = index;
            }
            this.selector.val(this.curMonth.toString());
            this.year.text(this.curYear.toString());
        };
        MonthSelector.prototype.initMouseEvents = function () {
            var self;
            self = this;
            this.prevBtn.on("click", function (e) {
                console.log("click prev");
                e.preventDefault();
                if (self.isLocked === true) {
                    return false;
                }
                self.curMonth -= 1;
                if (self.curMonth < 0) {
                    self.curMonth = 11;
                    self.curYear -= 1;
                }
                self.refresh();
                self.evtManager.trigger(new E.Event("ms:month:down", { month: self.curMonth, year: self.curYear, target: this }));
            });
            this.nextBtn.on("click", function (e) {
                e.preventDefault();
                if (self.isLocked === true) {
                    return false;
                }
                console.log("click next");
                self.curMonth += 1;
                if (self.curMonth > 11) {
                    self.curMonth = 0;
                    self.curYear += 1;
                }
                self.refresh();
                self.evtManager.trigger(new E.Event("ms:month:up", { month: self.curMonth, year: self.curYear, target: this }));
            });
        };
        MonthSelector.prototype.getMonthName = function (index) {
            return this.options["monthes"][index];
        };
        MonthSelector.DEFAULTS = {
            monthes: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
            prevBtnClass: "ms-prev-btn",
            nextBtnClass: "ms-next-btn",
            elemClass: "ms-selector",
            yearClass: "ms-year"
        };
        return MonthSelector;
    })();
    exports.MonthSelector = MonthSelector;
});
//# sourceMappingURL=MonthSelector.js.map
