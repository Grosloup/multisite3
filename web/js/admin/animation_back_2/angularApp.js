var app = angular.module('App', []);
app
    .config(['$interpolateProvider', function($interpolateProvider){
        $interpolateProvider.startSymbol('{$').endSymbol('$}');
    }])
    .config(['$httpProvider', function($httpProvider){
        $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    }]);
