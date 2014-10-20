function TagCreator(http,configs){
    this.http = http;
    this.configs = configs || {};
}
TagCreator.prototype.get = function(){
    return new Tags(this.http, this.configs);
};

angular.module('TagFactory', ['$configs'])
    .factory('$tags', ['$http','configs',function($http, configs){

        return new TagCreator($http, configs);
    }]);
