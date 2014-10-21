var recapApp = angular.module('RecapApp', ['PostDataApp']);

recapApp.controller('RecapController', ['$scope','$postDatas', function($scope, $postDatas){
    $scope.datas = $postDatas;
}]);
