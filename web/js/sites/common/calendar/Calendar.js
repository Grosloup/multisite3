/// <reference path="../../../../dts/require.d.ts" />
/// <reference path="../../../../dts/jquery.d.ts" />
define(["require", "exports", "jquery", "Event", "Day"], function (require, exports, $, E, D) {
    var Calendar = (function () {
        function Calendar(element, mediator, evtManager, options) {
            this.element = element;
            this.mediator = mediator;
            this.evtManager = evtManager;
            this.isLocked = true;
            this.options = {};
            this.options = $.extend(true, {}, Calendar.DEFAULTS, options || {});
            this.mediator.set(this.options["mediatorName"], this);
            this.init();
        }
        Calendar.prototype.init = function () {
            this.today = new Date();
            this.curYear = this.today.getFullYear();
            this.curMonth = this.today.getMonth();
            this.curDate = this.today.getDate();
            this.$view = $("<div/>", { "class": this.options["elemDefaultClass"] });
            this.build();
            this.attachEvents();
            this.initMouseEvents();
        };
        Calendar.prototype.build = function () {
            this.buildHeader();
            this.body = $("<div/>", { "class": this.getClass("bodyClass") });
            this.$view.append(this.body);
            this.buildBaseLayer();
            this.evtLayer = $("<div/>", { "class": this.getClass("evtLayerClass") });
            this.$view.append(this.evtLayer);
            this.buildEventLayer();
            this.element.append(this.$view);
            this.unlock();
            this.evtManager.trigger(new E.Event("c:state:ready", { day: this.curDate, month: this.curMonth, year: this.curYear, target: this }));
        };
        Calendar.prototype.buildHeader = function () {
            this.header = $("<div/>", { "class": this.getClass("headerClass") });
            this.monthSelector = this.mediator.getMonthSelector();
            this.loader = this.mediator.getLoader();
            // loader !!
            this.headerRow = $("<div/>", { "class": this.getClass(this.options["headerRowClass"]) });
            this.headerRow.append(this.monthSelector.getElement());
            this.header.append(this.headerRow);
            this.$view.append(this.header);
        };
        Calendar.prototype.buildBaseLayer = function () {
            var firstDay, firstDayNum, numDaysInMonth, lastDay, numWeeks, calClass;
            firstDay = new Date(this.curYear, this.curMonth, 1);
            firstDayNum = this.getRealDay(firstDay);
            numDaysInMonth = this.getNumDaysInMonth(this.curYear, this.curMonth);
            lastDay = new Date(this.curYear, this.curMonth, numDaysInMonth);
            numWeeks = 2 + (numDaysInMonth - (this.getNumDaysFirstWeek(firstDayNum) + this.getRealDay(lastDay))) / 7;
            calClass = this.getClass("") + numWeeks;
            this.$view.removeClass(this.getClass("") + "4 " + this.getClass("") + "5 " + this.getClass("") + "6");
            this.$view.addClass(calClass);
            this.emptyBody();
            var w = 0, d = 0, dayCounter = 1, dayNum = 1;
            for (; w < numWeeks; w++) {
                var row = this.createBodyRow();
                d = 0;
                for (; d < 7; d++) {
                    var cell = this.createBodyCell();
                    if (dayCounter >= firstDayNum && dayCounter < (numDaysInMonth + firstDayNum)) {
                        var day = this.createBodyDay(dayNum + '');
                        cell.append(day);
                        cell.attr("data-cellindex", (dayNum - 1).toString());
                        if (this.curYear == this.today.getFullYear() && this.curMonth == this.today.getMonth() && dayNum == this.today.getDate()) {
                            cell.addClass(this.getClass("calCellTodayClass"));
                        }
                        dayNum++;
                    }
                    else {
                        cell.addClass(this.getClass("emptyCellClass"));
                    }
                    dayCounter++;
                    row.append(cell);
                }
                this.body.append(row);
            }
        };
        Calendar.prototype.buildEventLayer = function () {
            var firstDay, firstDayNum, numDaysInMonth, lastDay, numWeeks;
            firstDay = new Date(this.curYear, this.curMonth, 1);
            firstDayNum = this.getRealDay(firstDay);
            numDaysInMonth = this.getNumDaysInMonth(this.curYear, this.curMonth);
            lastDay = new Date(this.curYear, this.curMonth, numDaysInMonth);
            numWeeks = 2 + (numDaysInMonth - (this.getNumDaysFirstWeek(firstDayNum) + this.getRealDay(lastDay))) / 7;
            this.emptyEventLayer();
            var w = 0, d = 0, dayCounter = 1, dayNum = 1;
            for (; w < numWeeks; w++) {
                var row = this.createEvtLayerRow();
                d = 0;
                for (; d < 7; d++) {
                    var cell;
                    if (dayCounter >= firstDayNum && dayCounter < (numDaysInMonth + firstDayNum)) {
                        cell = this.createEvtLayerCell(true);
                        cell.attr("data-cellindex", dayNum - 1);
                        cell.attr("data-celldate", this.curYear + "/" + (this.curMonth + 1) + "/" + dayNum);
                        var day = new D.Day(dayNum - 1, dayNum, this.curMonth, this.curYear, this.evtManager);
                        cell.data = { "day": day };
                        dayNum++;
                    }
                    else {
                        cell = this.createEvtLayerCell(false);
                    }
                    dayCounter++;
                    row.append(cell);
                }
                this.evtLayer.append(row);
            }
        };
        Calendar.prototype.attachEvents = function () {
            this.evtManager.addEvent("ms:month:up", this.changeMonth, this);
            this.evtManager.addEvent("ms:month:down", this.changeMonth, this);

            console.log(this.evtManager);
        };
        Calendar.prototype.changeMonth = function (event) {
            console.log(event);
            this.curMonth = event["month"];
            this.curYear = event["year"];
            this.refresh();
        };
        Calendar.prototype.dispatchDatas = function (datas) {
        };
        Calendar.prototype.showError = function (message, status) {
            // display error
        };
        Calendar.prototype.initMouseEvents = function () {
            var self;
            self = this;
            $(document).on("click", "[data-cell]", function (e) {
                e.preventDefault();
                if (self.isLocked) {
                    return false;
                }
                var $this = $(this);
                var datas = {
                    index: $this.attr("cellindex"),
                    date: $this.attr("celldate"),
                    day: this.data.day.daynum,
                    month: this.data.day.month,
                    year: this.data.day.year,
                    target: self
                };
                self.evtManager.trigger(new E.Event("c:day:click", datas));
            });
        };
        Calendar.prototype.lock = function () {
            //loader show
            this.isLocked = true;
            this.monthSelector.lock();
        };
        Calendar.prototype.unlock = function () {
            //loader hide
            this.isLocked = false;
            this.monthSelector.unlock();
        };
        Calendar.prototype.refresh = function () {
            this.lock();
            this.emptyBody();
            this.emptyEventLayer();
            this.buildBaseLayer();
            this.buildEventLayer();
            this.unlock();
        };
        Calendar.prototype.emptyBody = function () {
            this.body.empty();
        };
        Calendar.prototype.emptyEventLayer = function () {
            this.evtLayer.empty();
        };
        Calendar.prototype.getMonthName = function (index) {
            this.monthSelector["getMonthName"](index || this.curMonth);
        };
        Calendar.prototype.createBodyRow = function () {
            return $("<div/>", { "class": this.getClass("bodyRowClass") });
        };
        Calendar.prototype.createBodyCell = function () {
            return $("<div/>", { "class": this.getClass("bodyCellClass") });
        };
        Calendar.prototype.createBodyDay = function (text) {
            return $("<div/>", { "class": this.getClass("bodyDayClass"), "text": text });
        };
        Calendar.prototype.createEvtLayerRow = function () {
            return $("<div/>", { "class": this.getClass("evtLayerRowClass") });
        };
        Calendar.prototype.createEvtLayerCell = function (active) {
            var cell = $("<div/>", { "class": this.getClass("evtLayerCellClass") });
            if (active != undefined && active === true) {
                cell.addClass(this.getClass("evtLayerCellEnabledClass"));
                cell.attr("data-cell", "");
            }
            else {
                cell.addClass(this.getClass("evtLayerCellDisabledClass"));
            }
            return cell;
        };
        Calendar.prototype.getClass = function (classname) {
            var cp = this.options["classPrefix"] || "";
            var cn = this.options[classname] || "";
            return cp + cn;
        };
        Calendar.prototype.getNumDaysInMonth = function (month, year) {
            return new Date(year, month + 1, 0).getDate();
        };
        Calendar.prototype.getRealDay = function (date) {
            var d = date.getDay();
            if (d === 0) {
                d = 7;
            }
            return d;
        };
        Calendar.prototype.getNumDaysFirstWeek = function (d) {
            return 8 - d;
        };
        Calendar.DEFAULTS = {
            mediatorName: "calendar",
            elemDefaultClass: "calendar",
            classPrefix: "cal-",
            loaderClassName: "loader",
            days: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
            headerClass: "header",
            headerRowClass: "header-row",
            headerDayRowClass: "header-row-day",
            headerDayCellClass: "header-cell-day",
            headerDayCellTemplate: "<span class='show-only-md'>[[longday]]</span><span class='hide-only-md'>[[shortday]]</span>",
            bodyClass: "body",
            bodyRowClass: "body-row",
            bodyCellClass: "body-cell",
            bodyDayClass: "body-day",
            calCellTodayClass: "cell-today",
            emptyCellClass: "empty-cell",
            evtLayerClass: "event-layer",
            evtLayerRowClass: "event-layer-row",
            evtLayerCellClass: "event-layer-cell",
            evtLayerCellEnabledClass: "cell-enabled",
            evtLayerCellDisabledClass: "cell-disabled"
        };
        return Calendar;
    })();
    exports.Calendar = Calendar;
});
//# sourceMappingURL=Calendar.js.map
