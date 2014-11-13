//// <reference path="../../../../dts/require.d.ts" />
/// <reference path="../../../../dts/jquery.d.ts" />
define(["require", "exports"], function (require, exports) {
    var EventManager = (function () {
        function EventManager() {
            this.events = {};
        }
        EventManager.prototype.addEvent = function (eventname, listener, context) {
            if (!this.events.hasOwnProperty(eventname)) {
                this.events[eventname] = [];
            }
            this.events[eventname].push({
                fn: listener,
                context: context
            });
        };
        EventManager.prototype.trigger = function (event) {
            if (!event.hasOwnProperty("name") || !this.events.hasOwnProperty(event.name)) {
                return false;
            }
            $.each(this.events[event.name], function (i, e) {
                e["fn"].call(e["context"], event);
            });
        };
        return EventManager;
    })();
    exports.EventManager = EventManager;
});
//# sourceMappingURL=EventManager.js.map