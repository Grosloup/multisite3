

    function Calendar($target, callback){
        this.calendrier = $('#' + $target);
        this.container = this.calendrier.find(".cal-body");
        this.nextBtn = this.calendrier.find('.nextMonth');
        this.prevBtn = this.calendrier.find('.prevMonth');
        this.title = this.calendrier.find('.cal-title');
        this.today = new Date();
        this.month = this.today.getMonth();
        this.year  = this.today.getFullYear();
        this.monthes = ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];
        this.callback = callback || this.noop;
        this.init();
        this.build();
        this.initEvents();
    }

    Calendar.prototype.init = function(){
        var todayString = this.today.getDate() + "-" + (this.month + 1) + "-" + this.year;
        this.callback(todayString);
    };

    Calendar.prototype.noop = function(){};

    Calendar.prototype.createRow = function(){
        return $('<div />', {'class': 'cal-row'});
    };

    Calendar.prototype.createCell = function(){
        return $('<div />', {'class': 'cal-cell','data-cell':''});
    };

    Calendar.prototype.createDay = function(text, date){
        return $('<span />', {'class':'cal-day', 'text':text, 'data-date': date});
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
      return this.monthes[this.month];
    };

    Calendar.prototype.build = function () {
        this.firstDay = new Date(this.year, this.month, 1);
        this.firstDayNum = this.getReelDay(this.firstDay);
        this.numDaysInMonth = this.getNumDaysInMonth(this.today.getFullYear(), this.today.getMonth());
        this.lastDay = new Date(this.today.getFullYear(), this.today.getMonth(),this.numDaysInMonth);

        this.numWeeks = 2 + (this.numDaysInMonth - (this.getNumDaysFirstWeek(this.firstDayNum) + this.getReelDay(this.lastDay)))/7;
        var calClass = "cal-" + this.numWeeks;
        this.calendrier.removeClass('cal-4 cal-5 cal-6');
        this.calendrier.addClass(calClass);
        var w= 0, d= 0, dayCounter = 1, dayNum = 1;
        this.container.empty();
        for(;w<this.numWeeks;w++){
            var row = this.createRow();
            d=0;
            for(;d<7;d++){
                var cell = this.createCell();
                if(dayCounter >= this.firstDayNum && dayCounter < (this.numDaysInMonth + this.firstDayNum)){
                    var dDate = dayNum + "-" + (this.month + 1) + "-" + this.year;
                    var day = this.createDay(dayNum + '', dDate);
                    cell.append(day);
                    cell.addClass('cal-cell-hover');
                    dayNum++;
                }
                dayCounter++;
                row.append(cell);
            }
            this.container.append(row);
        }
        this.title.text(this.monthes[this.month] + " " + this.year);
    };

    Calendar.prototype.nextMonth = function(){
        this.month += 1;
        if(this.month == 12){
            this.month = 0;
            this.year += 1;
        }
        this.today = new Date(this.year, this.month, 1);
        this.build();
    };

    Calendar.prototype.prevMonth = function(){
        this.month -= 1;
        if(this.month === -1){
            this.month = 11;
            this.year -= 1;
        }
        this.today = new Date(this.year, this.month, 1);
        this.build();
    };

    Calendar.prototype.initEvents = function(){
        var self = this;
        this.prevBtn.on("click", function(e){
            e.preventDefault();
            self.prevMonth();
            self.title.text(self.getMonthName() + " " + self.year);
        });
        this.nextBtn.on("click", function(e){
            e.preventDefault();
            self.nextMonth();
            self.title.text(self.getMonthName() + " " + self.year);
        });
        $(document).on("click", "[data-cell]", function(e){
            e.preventDefault();
            var data = $(this).find('.cal-day').data('date') || null;
            self.callback(data);
        });
    };




