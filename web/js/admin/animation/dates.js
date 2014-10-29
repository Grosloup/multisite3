angular.module('dates',[])

.service('DatesService', function(){

        return {
            dates: {
                'year': null,
                'month': null,
                'days': []
            }

        };

    });
