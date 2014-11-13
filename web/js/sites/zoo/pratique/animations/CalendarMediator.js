/// <reference path="../../../../dts/require.d.ts" />
/// <reference path="../../../../dts/jquery.d.ts" />
define(["require", "exports", "jquery", "MonthSelector"], function (require, exports, $, Sel) {
    var CalendarMediator = (function () {
        function CalendarMediator(evtManager, options) {
            this.evtManager = evtManager;
            this.calendar = null;
            this.animations = null;
            this.shows = null;
            this.options = {};
            this.options = $.extend(true, {}, CalendarMediator.DEFAULTS, options || {});
            this.init();
        }
        CalendarMediator.prototype.init = function () {
            this.attachEvents();
        };
        CalendarMediator.prototype.attachEvents = function () {
            this.evtManager.addEvent("c:state:ready", this.loadEvents, this);
            this.evtManager.addEvent("c:day:click", this.loadEvents, this);
        };
        CalendarMediator.prototype.loadEvents = function (event) {
            var cached = this.getCache(event["year"], event["month"], event["day"]);
            var self = this;
            //event["target"]["lock"]();
            if (cached !== null) {
                event["target"]["dispatchDatas"](cached);
                //anims
                this.animations.dispatchDatas(cached);
                //spect
                this.shows.dispatchDatas(cached);
            }
            else {
                this.httpGet(this.makeGetUrl(event)).done(function (data, textStatus, jqXHR) {
                    if (data["error"] === false) {
                        //event["target"]["dispatchDatas"](data["datas"]);
                        //self.setCache(event["year"], event["month"], event["day"], data["datas"]);
                    }
                    else {
                        //event["target"]["showError"](data["message"], textStatus);
                    }

                    event["target"]["unlock"]();
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    event["target"]["showError"]();
                    event["target"]["unlock"]();
                });
            }
        };
        CalendarMediator.prototype.makeGetUrl = function (datas) {
            var url = this.options["getUrl"].replace("[[year]]", datas["year"]).replace("[[month]]", datas["month"]).replace("[[day]]", datas["day"]);
            return this.options["baseUrl"] + url;
        };
        CalendarMediator.prototype.set = function (name, obj) {
            if (this.hasOwnProperty(name) == true && this[name] == null) {
                this[name] = obj;
            }
        };
        CalendarMediator.prototype.getMonthSelector = function () {
            return new Sel.MonthSelector(this.calendar.curMonth, this.calendar.curYear, this.evtManager);
        };
        CalendarMediator.prototype.getLoader = function () {
            return {};
        };
        CalendarMediator.prototype.httpGet = function (url, datas) {
            return $.get(url, datas || {});
        };
        CalendarMediator.prototype.setCache = function (year, month, day, datas) {
            var CM = CalendarMediator;
            month += 1;
            var yearS = year + "";
            var monthS = month + "";
            var dayS = day + "";
            if (!CM.CACHE.hasOwnProperty(year + "")) {
                CM.CACHE[yearS] = {};
                CM.CACHE[yearS][monthS] = {};
                CM.CACHE[yearS][monthS][dayS] = datas;
            }
            else {
                if (!CM.CACHE[yearS].hasOwnProperty(monthS)) {
                    CM.CACHE[yearS][monthS] = {};
                    CM.CACHE[yearS][monthS][dayS] = datas;
                }
                else {
                    CM.CACHE[yearS][monthS][dayS] = datas;
                }
            }
        };
        CalendarMediator.prototype.getCache = function (year, month, day) {
            var CM = CalendarMediator;
            month += 1;
            var yearS = year + "";
            var monthS = month + "";
            var dayS = day + "";
            if (CM.CACHE.hasOwnProperty(yearS) && CM.CACHE[yearS].hasOwnProperty(monthS) && CM.CACHE[yearS][monthS].hasOwnProperty(dayS)) {
                return CM.CACHE[yearS][monthS][dayS];
            }
            return null;
        };
        CalendarMediator.DEFAULTS = {
            baseUrl: "",
            getUrl: ""
        };
        CalendarMediator.CACHE = {};
        return CalendarMediator;
    })();
    exports.CalendarMediator = CalendarMediator;
});
//# sourceMappingURL=CalendarMediator.js.map
