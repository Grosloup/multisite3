var recapApp = angular.module('RecapApp', ['PostDataApp','$configs']);

recapApp.controller('RecapController', ['$scope','$postDatas','configs','$http', function($scope, $postDatas,configs,$http){
    $scope.datas = $postDatas;

    $scope.post_is_saving = false;
    $scope.display_errors = false;
    $scope.display_results = false;
    $scope.errors = {messages:[]};
    var saveUrl = configs.urls.base + configs.urls.post.base + configs.urls.post.save;

    function validatePost(datas){
        var countTarget= 0, countCategoryErrors = 0;
        angular.forEach(datas["editOn"], function(e,i){
            //
            if(e){
                countTarget++;
            }
        });
        if(countTarget<1){
            $scope.errors.messages.push("Aucun site séléctionné !");
            return false;
        }

        angular.forEach(datas["editOn"], function(e,i){
            //
            if(e && datas[i].category == null){
                // erreur => doit au moins avoir une catécorie
                $scope.errors.messages.push("Pour éditer votre article sur " + datas[i]["name"] + " vous devez séléctionner une catégorie.");
                countCategoryErrors++;
            }
        });
        if(countCategoryErrors>0){
            return false;
        }


        return true;
    }

    $scope.save = function(){
        $scope.errors = {messages:[]};
        $scope.display_results = false;
        $scope.display_errors = false;
        if(validatePost($scope.datas) == false){
            $scope.display_errors = true;
            return;
        }
        $scope.post_is_saving = true;

        $http.post(saveUrl, $scope.datas)
            .success(function(data, status, headers, config){
                if(data.error == false){
                    $scope.display_results = true;

                } else {
                    $scope.errors.messages = data.messages;
                    $scope.display_errors = true;

                }
                $scope.post_is_saving = false;
            })
            .error(function(data, status, headers, config, statusText){
                $scope.errors.messages = ["Error " + status ];
                $scope.post_is_saving = false;
                $scope.display_errors = true;
            });
    }
}]);
