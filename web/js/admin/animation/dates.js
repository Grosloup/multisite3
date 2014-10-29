angular.module('Dates',[])

.service('DatesService', function(){

        return {
            datas: {
                'year': null,
                'month': null,
                'days': []
            }

        };

    });
