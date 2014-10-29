var zpbCalendarApp = angular.module('ZpbCalendarApp', ['configs', 'dates']);

zpbCalendarApp.controller('CalendarController', ['$scope','$configs','$http','DatesService', function($scope, $configs, $http, DatesService){
    $scope.openDayTitleText = '';

    $scope.getDatas = function(cal){
        var url = $configs.urls.base  + cal.year + '/' + (cal.month + 1);
        $http.get(url)
            .success(function(response){
                DatesService.dates = response;
                cal.build(DatesService.dates['days']);
                cal.toggleLoader();
                cal.enableBtns();
            })
            .error(function(d){
                cal.toggleLoader();
            });
    };

    $scope.startCalendar = function(cal){
        cal.toggleLoader();

        cal.createMarker = function(v){
            var marker =  $('<div />', {'class': 'color-marker'});
            marker.css('background-color', v['color']);
            return marker;
        };
        $scope.getDatas(cal);
    };

    $scope.prevMonth = function(cal){
        cal.toggleLoader();
        $scope.openDayTitleText = '';
        //openDayBody.empty();
        $scope.getDatas(cal);
    };

    $scope.nextMonth = function(cal){
        cal.toggleLoader();
        $scope.openDayTitleText = '';
        //openDayBody.empty();
        $scope.getDatas(cal);
    };

    $scope.newDay = function(data, idx){

    }

}]);

zpbCalendarApp.directive('zpbCalendar', function(){
    return {
        restrict: 'A',
        link: function(scope, elem, attrs){
            angular.element(elem).zpbCalendar({
                startCb: scope.startCalendar,
                nextMonthCb: scope.prevMonth,
                prevMonthCb: scope.nextMonth,
                dayClickCb: scope.newDay
            });

        }
    }
});
