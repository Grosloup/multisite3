var app = angular.module("PostApp", []);
app.config(["$interpolateProvider", function($interpolateProvider){
    $interpolateProvider.startSymbol("{$").endSymbol("$}");
}]);
app.service("TagsSrv", function(){
    var datas = {
        tags: [
            {id: 1, name: "tag_tag_1"},
            {id: 2, name: "tag_2"},
            {id: 3, name: "tag_tag_3"},
            {id: 4, name: "tag_4"},
            {id: 5, name: "tag_tag_5"},
            {id: 6, name: "tag_6"}
        ],
        auto:["tag_tag_1","tag_2","tag_tag_3","tag_4","tag_tag_5","tag_6"]
    };
    return datas;
});

app.directive("tagInput", function(){

    return {
        restrict: "A",
        link: function(scope, element, attrs){
            scope.iptWidth = 20;
            scope.$watch(attrs.ngModel, function(value){
                if(value != undefined){
                    var tmpEl = $("<span>"+ value +"</span>").appendTo("body");
                    scope.iptWidth = tmpEl.width() + 15;
                    tmpEl.remove();
                }
            });

            element.bind("keydown", function(e){
                if(e.which == 9){
                    e.preventDefault();
                }
                if(e.which == 8){

                    scope.$apply(attrs.deleteTag);
                }

            });

            element.bind("keyup", function(e){
                var key = e.which;
                if(key == 9 || key == 13){
                    e.preventDefault();
                    scope.$apply(attrs.newTag);
                }
            });

        }
    }
});

app.controller("TagCtrl", ["$scope","TagsSrv", function($scope,TagsSrv){
    $scope.initTags = TagsSrv.tags;
    $scope.tags = angular.copy($scope.initTags);
    $scope.autocomplete = TagsSrv.auto;
    $scope.tagText = '';
    console.log($scope.autocomplete);

    $scope.addTag = function () {
        if($scope.tagText == 0){
            return;
        }
        $scope.tags.push({name: $scope.tagText});
        $scope.initTags.push({name: $scope.tagText});

        console.log($scope.autocomplete.indexOf($scope.tagText));

        if($scope.autocomplete.indexOf($scope.tagText) != -1){

            $scope.autocomplete.push($scope.tagText);
        }

        $scope.tagText = '';
    };

    $scope.deleteTag = function(key){
        if($scope.tags.length > 0 && $scope.tagText.length == 0 && key === undefined){
            $scope.tags.pop();
        } else if(key !== undefined){
            $scope.tags.splice(key, 1);
        }
    };
}]);
