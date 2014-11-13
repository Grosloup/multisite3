define(["require", "exports", "jquery"], function (require, exports, $) {
    var Event = (function () {
        function Event(name, datas) {
            this.name = name;
            var self = this;
            $.each(datas, function (k, v) {
                self[k] = v;
            });
        }
        return Event;
    })();
    exports.Event = Event;
});
//# sourceMappingURL=Event.js.map