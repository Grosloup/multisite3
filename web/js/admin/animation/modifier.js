angular.module('Modifier',[])

    .factory('ModifierService', function(){
        return {
                'calendar':null,
                'currentYear': '',
                'currentMonth': '',
                'currentDay': '',
                'currentIndex': null
            };

    });
