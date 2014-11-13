define(["require", "exports"], function (require, exports) {
    var Day = (function () {
        function Day(index, daynum, month, year, evtManager) {
            this.index = index;
            this.daynum = daynum;
            this.month = month;
            this.year = year;
            this.evtManager = evtManager;
            this.realMonth = this.month + 1;
        }
        return Day;
    })();
    exports.Day = Day;
});
//# sourceMappingURL=Day.js.map