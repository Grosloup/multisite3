/// <reference path="../../../../dts/require.d.ts" />
/// <reference path="../../../../dts/jquery.d.ts" />
/// <reference path="CalendarMediator.ts" />
/// <reference path="../../../../sites/common/event/EventManager.ts" />
define(["require", "exports", "jquery"], function (require, exports, $) {
    var Program = (function () {
        function Program(elem, mediator, evtManager, options) {
            this.elem = elem;
            this.mediator = mediator;
            this.evtManager = evtManager;
            this.options = {};
            this.header = null;
            this.headerTitle = null;
            this.headerDate = null;
            this.body = null;
            this.list = null;
            this.options = $.extend(true, {}, Program.DEFAULTS, options || {});
            this.init();
        }
        Program.prototype.init = function () {
            this.mediator.set(this.options["mediatorName"], this);
            this.build();
            this.attachEvents();
            this.initMouseEvents();
        };
        Program.prototype.build = function () {
            this.buildHeader();
            this.buildBody();
            this.elem.append(this.body);
        };
        Program.prototype.buildHeader = function () {
            this.header = $("<div/>", { "class": this.getClass("headerClass") });
            this.headerTitle = $("<div/>", { "class": this.getClass("headerTitleClass"), "html": this.options["headerTitleText"] });
            this.header.append(this.headerTitle);
            this.headerDate = $("<div/>", { "class": this.getClass("headerDateClass") });
            this.header.append(this.headerDate);
            this.elem.append(this.header);
        };
        Program.prototype.buildBody = function () {
            this.body = $("<div/>", { "class": this.getClass("bodyClass") });
        };
        Program.prototype.attachEvents = function () {
        };
        Program.prototype.dispatchDatas = function (datas) {
            var self = this;
            this.setDate(datas["metas"]["year"], datas["metas"]["month"], datas["metas"]["day"]);
            this.emptyBody();
            if (datas[this.options["elemType"]]["datas"].length > 0) {
                this.list = this.createList();
                $.each(datas[this.options["elemType"]]["datas"], function (i, e) {
                    self.list.append(self.createListRow(e));
                });
                this.body.append(this.list);
            }
            else {
                var m = $("<p/>", { "class": this.getClass("messageClass"), "html": datas[this.options["elemType"]]["message"] });
                this.body.append(m);
            }
        };
        Program.prototype.setDate = function (year, month, day) {
            var d = (day < 10) ? "0" + day : day.toString();
            var m = (month < 10) ? "0" + month : month.toString();
            this.headerDate.html(this.options["headerDateTemplate"].replace("[[date]]", d + "/" + m + "/" + year));
        };
        Program.prototype.unsetDate = function () {
            this.headerDate.empty();
        };
        Program.prototype.unloadDatas = function () {
            this.unsetDate();
            this.emptyBody();
        };
        Program.prototype.createList = function () {
            return $("<ul/>", { "class": this.getClass("listClass") });
        };
        Program.prototype.createListRow = function (datas) {
            var html = this.options["liTemplate"].replace("[[hourClass]]", this.getClass("hourClass")).replace("[[nameClass]]", this.getClass("nameClass")).replace("[[placeClass]]", this.getClass("placeClass")).replace("[[hour]]", datas["hour"]).replace("[[name]]", datas["name"]).replace("[[place]]", datas["place"]);
            return $("<li/>", { "class": this.getClass("listRowClass"), "html": html });
        };
        Program.prototype.showError = function (message, status) {
        };
        Program.prototype.initMouseEvents = function () {
        };
        Program.prototype.emptyBody = function () {
            this.body.empty();
        };
        Program.prototype.getClass = function (classname) {
            var cp = this.options["classPrefix"] || "";
            var cn = this.options[classname] || "";
            return cp + cn;
        };
        Program.DEFAULTS = {
            mediatorName: "shows",
            elemType: "shows",
            elemDefaultClass: "shows",
            classPrefix: "shows-",
            headerClass: "header",
            headerTitleText: "<h3>Spectacles</h3>",
            headerTitleClass: "header-title",
            headerDateClass: "header-date",
            headerDateTemplate: "<p>[[date]]</p>",
            messageClass: "message",
            bodyClass: "body",
            listClass: "list",
            listRowClass: "list-row",
            hourClass: "list-row-hour",
            nameClass: "list-row-name",
            placeClass: "list-row-place",
            liTemplate: "<span class=\'[[hourClass]]\'>[[hour]]</span> <span class=\'[[nameClass]]\'>[[name]]</span> <span class=\'[[placeClass]]\'>[[place]]</span>"
        };
        return Program;
    })();
    exports.Program = Program;
});
//# sourceMappingURL=Program.js.map