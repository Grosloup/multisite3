$(function () {

    var calendrier = $("#calendrier"),
        calInfos = $("#calInfos"),
        unloadAll = $("#unloadAll"),
        calMsg = $("#calMsg"),
        evtManager = $("#event_manager");

    evtManager.zpbCalendarManager({
        events: window.animationDays || []
    });

    calendrier.zpbCalendar({
        baseUrl: "/animations/api/days",
        mouseClickCb: function (el, event, e) {
            cal_manager.loadEvents(event, $(el).attr("data-celldate"), calendar);

        },
        prevBtnClickCb: function (el, cal, e) {
            var url = cal.options.baseUrl + "/" + cal.currentYear + "/" + (calendar.currentMonth + 1);
            calMsg.text("");
            cal.disableBtns();
            cal.disableCellClick();
            cal.displayMessage("Loading...");
            $.get(url).done(function (response) {

                cal.loadEvents(response.days);
                cal.enableBtns();
                cal.enableCellClick();
                cal.eraseMessage();
            }).fail(function (response) {
                cal.enableBtns();
                cal.enableCellClick();
                calMsg.text(response.status + " " + response.statusText);
                cal.eraseMessage();
            });
            calInfos.text(cal.getMonthName() + " " + cal.currentYear);
        },
        nextBtnClickCb: function (el, cal, e) {
            var url = cal.options.baseUrl + "/" + cal.currentYear + "/" + (calendar.currentMonth + 1);
            calMsg.text("");
            cal.disableBtns();
            cal.disableCellClick();
            cal.displayMessage("Loading...");
            $.get(url).done(function (response) {
                    cal.loadEvents(response.days);
                    cal.enableBtns();
                    cal.enableCellClick();
                    cal.eraseMessage();
                }
            ).fail(function (response) {
                    cal.enableBtns();
                    cal.enableCellClick();
                    calMsg.text(response.status + " " + response.statusText);
                    cal.eraseMessage();
                }
            );
            calInfos.text(cal.getMonthName() + " " + cal.currentYear);
        },
        createEventView: function (isUnique, cal, idx) {
            if (isUnique === true) {
                if (_.isNumber(idx) && !_.isNaN(idx)) {
                    var cell = cal.getCell(idx);
                    cell.find(".cal-event-marker").remove();
                    _.each(cal.events[idx], function (e) {
                        var marker = $("<div />", {"class": "cal-event-marker", "data-eventid": e.id});
                        marker.css("backgroundColor", e.color);
                        cell.append(marker);
                    });
                }

            } else {
                _.each(cal.events, function (evt, i) {
                    var cell = cal.getCell(i);
                    _.each(evt, function (e) {
                        var marker = $("<div />", {"class": "cal-event-marker", "data-eventid": e.id});
                        marker.css("backgroundColor", e.color);
                        cell.append(marker);
                    });
                });
            }
        },
        removeEventViews: function (isUnique, cal, idx, eId) {
            var cell;
            idx = parseInt(idx);
            cell = cal.getCell(idx);
            if (isUnique === true) {
                var marker = cell.find("[data-eventid='" + eId + "']");

                $.ajax({
                    url: cal.options.baseUrl + "/" + eId + "/" + cal.currentYear + "/" + (cal.currentMonth + 1) + "/" + (idx + 1) ,
                    type: "DELETE"
                }).done(function(response){
                    if(!response.error){
                        marker.remove();
                    }
                }).fail({});
            } else {
                var markers = cell.find(".cal-event-marker");
                markers.remove();
            }

        },
        deleteEventCb: function(idx, prop, eId, cal){
            var cell, marker;
            idx = parseInt(idx);
            cell = cal.getCell(idx);
            marker = cell.find("[data-eventid='" + eId + "']");
            $.ajax({
                url: cal.options.baseUrl + "/" + eId + "/" + cal.currentYear + "/" + (cal.currentMonth + 1) + "/" + (idx + 1) ,
                type: "DELETE"
            }).done(function(response){
                if(response.error === false){
                    marker.remove();
                    cal.unloadEvent(idx, prop, eId);
                } else {

                    var d = cal.currentYear + "/" + (cal.currentMonth + 1) + "/" + (idx + 1);
                    cal.selectedEvent = cal.events[idx];
                    console.log(cal.events[idx], d, cal.selectedEvent, cal.events[idx]);
                    cal_manager.loadEvents(cal.selectedEvent, d);
                    console.log(cal_manager.loadedEvents);
                }
            }).fail(function(response){
                var d = cal.currentYear + "/" + (cal.currentMonth + 1) + "/" + (idx + 1);
                cal.selectedEvent = cal.events[idx];
                cal_manager.loadEvents(cal.selectedEvent, d);
            });


        },
        removeAllEventViews: function (cal) {
            var markers;
            markers = cal.find("cal-event-marker");
            markers.remove();
        }
    });

    var calendar = calendrier.data("zpbCalendar");
    var cal_manager = evtManager.data("zpbCalendarManager");

    var baseUrl = "/animations/api/days/";


    //initialise calendrier
    calInfos.text(calendar.getMonthName() + " " + calendar.currentYear);
    calendar.disableBtns();
    calendar.disableCellClick();
    calendar.displayMessage("Loading...");
    $.get(baseUrl + calendar.currentYear + "/" + (calendar.currentMonth + 1)).done(function (response) {
        calendar.loadEvents(response.days);
        calendar.enableBtns();
        calendar.enableCellClick();
        calendar.eraseMessage();

        cal_manager.loadEvents(calendar.getEvents(calendar.currentDay - 1), calendar.currentYear + "/" + (calendar.currentMonth + 1) + "/" + calendar.currentDay, calendar);

    }).fail(function () {
        calendar.enableBtns();
        calendar.enableCellClick();
        calendar.eraseMessage();
    });

    unloadAll.on("click", function (e) {
        e.preventDefault();
        calendar.unloadAllEvents();
    })


});
