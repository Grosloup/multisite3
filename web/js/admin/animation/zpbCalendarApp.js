var zpbCalendarApp = angular.module('ZpbCalendarApp', ['AnimationDaysApp','Configs', 'Dates', 'Modifier']);

zpbCalendarApp.controller(
    'ModifierController',
    ['$scope','ModifierService','DatesService','$animationDays',
        function($scope,ModifierService, DatesService, $animationDays){
            $scope.modifier = ModifierService;
            $scope.dates = [];
            $scope.index = null;

            $scope.remove = function(d){
                angular.forEach($scope.dates, function(v,k){
                    if(v["id"] == d["id"]){
                        //$scope.dates.splice(k,1);
                        DatesService.datas.days[$scope.index].splice(k,1);
                        $scope.modifier.calendar.removeMarker($scope.index);
                    }
                });
            };

            $scope.$watch("modifier", function(val){
                if(val.currentIndex != null){
                    $scope.index = val.currentIndex;
                    $scope.dates = DatesService.datas.days[val.currentIndex];

                }
            }, true);
        }
    ]
);

zpbCalendarApp.controller(
    'CalendarController',
    ['$scope','$configs','$http','DatesService','ModifierService',
        function($scope, $configs, $http, DatesService,ModifierService){
            $scope.modifier = ModifierService;
            $scope.dates = DatesService;
            $scope.isLoading = false;
            $scope.getDatas = function(cal){
                var url = $configs.urls.base  + cal.year + '/' + (cal.month + 1);
                $scope.modifier.currentMonth = '';
                $scope.modifier.currentYear = '';
                $scope.modifier.currentDay = '';
                $scope.modifier.currentIndex = null;
                $http.get(url)
                    .success(function(response){
                        DatesService.datas = response;
                        cal.build(DatesService.datas['days']);
                        $scope.isLoading = false;
                        $scope.modifier.currentMonth = cal.getMonthName();
                        $scope.modifier.currentYear = cal.year;
                        $scope.modifier.currentDay = '';
                        $scope.modifier.currentIndex = null;
                    })
                    .error(function(d){
                        $scope.isLoading = false;
                    });
            };

            $scope.startCalendar = function(cal){
                //$scope.modifier.calendar = cal;
                $scope.isLoading = true;
                cal.createMarker = function(v){
                    var marker =  $('<div />', {'class': 'color-marker'});
                    marker.css('background-color', v['color']);
                    return marker;
                };
                $scope.getDatas(cal);
            };

            $scope.prevMonth = function(cal){
                $scope.isLoading = true;
                $scope.getDatas(cal);
            };

            $scope.nextMonth = function(cal){
                $scope.isLoading = true;
                $scope.getDatas(cal);
            };

            $scope.dayClick = function(date, idx){
                var today = date.split("/");
                $scope.$apply(function(){
                    $scope.modifier.currentDay = today[2];
                    $scope.modifier.currentIndex = idx;
                });

            };

            $scope.$watch("dates", function(val){

            });



        }
    ]
);

zpbCalendarApp.directive('zpbCalendar', function(){
    return {
        restrict: 'A',
        link: function(scope, elem, attrs){
            angular.element(elem).zpbCalendar({
                startCb: scope.startCalendar,
                nextMonthCb: scope.prevMonth,
                prevMonthCb: scope.nextMonth,
                dayClickCb: scope.dayClick
            });

        }
    }
});
