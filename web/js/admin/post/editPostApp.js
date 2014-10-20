var editPostApp = angular.module('EditPostApp', ['ZooEditApp','BnEditApp','JdbEditApp','HdbEditApp','PdbEditApp', 'RecapApp']);

editPostApp.config(['$interpolateProvider',"$httpProvider", function($interpolateProvider, $httpProvider){
    $interpolateProvider.startSymbol('{$').endSymbol('$}');
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
}]);


