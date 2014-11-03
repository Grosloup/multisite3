;(function($, w){



    var Calendar = function(target, options){
        this.view =
        this.container =
        this.today =
        this.month =
        this.btns =
        this.prevBtn =
        this.nextBtn =
        this.monthTitle =
        this.yearTitle =
        this.loader =
        this.year = null;

        this.initialize(target, options);
    };

    Calendar.noop = function(){};

    Calendar.DEFAULTS = {
        monthes: ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],
        rowClass: 'cal-row',
        cellClass: 'cal-cell',
        dayClass: 'cal-day',
        calClassPrefix:'cal-',
        testTarget: /^\.|#.+/,
        bodyClass: 'cal-body',
        calCellHoverClass: 'cal-cell-hover',
        calCellTodayClass: 'cal-cell-today',
        btnsClass: 'calBtn',
        prevBtnClass: 'prevBtn',
        nextBtnClass: 'nextBtn',
        monthTitleClass: 'cal-title-month',
        yearTitleClass: 'cal-title-year',
        loaderClass: 'cal-loader',
        startCb: null,
        afterBuildCb: Calendar.noop,
        beforeBuildCb: Calendar.noop,
        buildDayCb: Calendar.noop,
        buildRowCb: Calendar.noop,
        buildCellCb: Calendar.noop,
        dayClickCb: Calendar.noop,
        prevMonthCb: null,
        nextMonthCb: null
    };

    Calendar.prototype.initialize = function (target, options) {
        this.options = $.extend({}, Calendar.DEFAULTS, options);
        if(typeof target === 'string'){
            if(!this.options.testTarget.test(target)){
                target = "#"+target;
            }
        }

        this.view = $(target);
        this.container = this.find(this.options.bodyClass);
        this.btns = this.find(this.options.btnsClass);
        this.enableBtns();
        this.prevBtn = this.find(this.options.prevBtnClass);
        this.nextBtn = this.find(this.options.nextBtnClass);
        this.monthTitle = this.find(this.options.monthTitleClass);
        this.yearTitle = this.find(this.options.yearTitleClass);
        this.loader = this.find(this.options.loaderClass);
        this.remember = new Date();
        this.today = new Date();
        this.month = this.today.getMonth();
        this.year  = this.today.getFullYear();

        if(this.options.startCb === null){
            this.build();
        } else {
            this.options.startCb(this);
        }


        this.initEvents();
    };

    Calendar.prototype.find = function (classname) {
        return this.view.find('.' + classname);
    };

    Calendar.prototype.createRow = function(){
        return $('<div />', {'class': this.options.rowClass});
    };

    Calendar.prototype.createCell = function(){
        return $('<div />', {'class': this.options.cellClass,'data-cell':''});
    };

    Calendar.prototype.createDay = function(text, date){
        return $('<span />', {'class':this.options.dayClass, 'text':text, 'data-date': date});
    };

    Calendar.prototype.getNumDaysInMonth = function(y,m){
        return new Date(y, m+1, 0).getDate();
    };

    Calendar.prototype.getReelDay = function(date){
        var d = date.getDay();
        if(d === 0){
            d = 7;
        }
        return d;
    };

    Calendar.prototype.getNumDaysFirstWeek = function(d){
        return 8 - d;
    };

    Calendar.prototype.getMonthName = function(){
        return this.options.monthes[this.month];
    };

    Calendar.prototype.remove = function () {
        this.container.empty();
    };

    Calendar.prototype.setTitles = function () {
        this.monthTitle.text(this.getMonthName());
        this.yearTitle.text(this.year);
    };

    Calendar.prototype.toggleLoader = function(){
        if(this.loader.hasClass("show")){
            this.loader.removeClass("show");
            this.loader.addClass("hide");
        } else {
            this.loader.addClass("show");
            this.loader.removeClass("hide");
        }
    };

    Calendar.prototype.enableBtns = function(){
        this.btns.attr('disabled',false);
    };

    Calendar.prototype.disableBtns = function(){
        this.btns.attr('disabled',true);
    };

    Calendar.prototype.createMarker = function(color){
        var marker =  $('<div />', {'class': 'color-marker'});
        marker.css('background-color', color);
        return marker;
    };

    Calendar.prototype.removeMarker = function(idx){
        console.log(idx);
    };

    Calendar.prototype.build = function (datas) {
        this.options.beforeBuildCb(this);
        var self = this;
        var firstDay = new Date(this.year, this.month, 1);
        var firstDayNum = this.getReelDay(firstDay);
        var numDaysInMonth = this.getNumDaysInMonth(this.today.getFullYear(), this.today.getMonth());
        var lastDay = new Date(this.today.getFullYear(), this.today.getMonth(),numDaysInMonth);

        var numWeeks = 2 + (numDaysInMonth - (this.getNumDaysFirstWeek(firstDayNum) + this.getReelDay(lastDay)))/7;
        var calClass = this.options.calClassPrefix + numWeeks;
        this.view.removeClass(this.options.calClassPrefix + "4 " + this.options.calClassPrefix + "5 " + this.options.calClassPrefix + "6");
        this.view.addClass(calClass);
        this.setTitles();
        this.remove();

        var w= 0, d= 0, dayCounter = 1, dayNum = 1;

        for(;w<numWeeks;w++){
            var row = this.createRow();
            this.options.buildRowCb(row);
            d=0;
            for(;d<7;d++){
                var cell = this.createCell();
                this.options.buildCellCb(cell);
                if(dayCounter >= firstDayNum && dayCounter < (numDaysInMonth + firstDayNum)){
                    var dDate = this.year + "/" + (this.month + 1) + "/" + dayNum;
                    cell.attr('data-cellindex', dayNum-1);
                    var day = this.createDay(dayNum + '', dDate);
                    if(datas){
                        if(datas[dayNum-1].length > 0){
                            $.each(datas[dayNum-1], function(i,v){
                                var marker = self.createMarker(v);
                                cell.append(marker);
                            });
                        }
                    }
                    this.options.buildDayCb(day);
                    cell.append(day);
                    cell.addClass(this.options.calCellHoverClass);
                    if(
                        this.year == this.remember.getFullYear() &&
                        this.month == this.remember.getMonth() &&
                        dayNum == this.remember.getDate()
                    ){
                        cell.addClass(this.options.calCellTodayClass);
                    }
                    dayNum++;
                }
                dayCounter++;
                row.append(cell);
            }
            this.container.append(row);
        }
        this.btns.attr('disabled',false);
        this.options.afterBuildCb(this);
    };

    Calendar.prototype.prevMonth = function () {
        this.month -= 1;
        if(this.month === -1){
            this.month = 11;
            this.year -= 1;
        }
        this.today = new Date(this.year, this.month, 1);
        if(this.options.prevMonthCb === null){
            this.build();
        } else {
            this.options.prevMonthCb(this);
        }
    };

    Calendar.prototype.nextMonth = function () {
        this.month += 1;
        if(this.month == 12){
            this.month = 0;
            this.year += 1;
        }
        this.today = new Date(this.year, this.month, 1);
        if(this.options.nextMonthCb === null){
            this.build();
        } else {
            this.options.nextMonthCb(this);
        }

    };

    Calendar.prototype.initEvents = function () {
        var self = this;
        this.prevBtn.on("click", function(e){
            e.preventDefault();
            self.prevMonth();
            self.disableBtns();
        });

        this.nextBtn.on("click", function(e){
            e.preventDefault();
            self.nextMonth();
            self.disableBtns();
        });

        $(document).on("click", "[data-cell]", function(e){
            e.preventDefault();
            var date = $(this).find('.' + self.options.dayClass).data('date') || null;
            var idx = $(this).data('cellindex');
            self.options.dayClickCb(date, idx);
        });
    };

    $.fn.zpbCalendar = function(options){

        return this.each(function(){

            if(!$.data(this, "zpbCalendar")){
                $.data(this, "zpbCalendar", new Calendar(this, options));
            }
        });
    }



})(jQuery, this);
