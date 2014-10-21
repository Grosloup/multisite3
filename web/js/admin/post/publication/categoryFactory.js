
function CategoryCreator(http,configs){
    this.http = http;
    this.configs = configs || {};
}
CategoryCreator.prototype.get = function(){
    return new Categories(this.http, this.configs);
};

angular.module('CategoryFactory', ['$configs'])
    .factory('$categories', ['$http','configs',function($http, configs){

        return new CategoryCreator($http, configs);
}]);
