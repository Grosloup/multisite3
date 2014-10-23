var pdbEditApp = angular.module("PdbEditApp",['PostDataApp', 'CategoryFactory','TagFactory']);

pdbEditApp.controller("PdbController", ['$scope','$window','$postDatas','$categories','$tags', function($scope,$window, $postDatas,$categories,$tags){
    var target = "pdb";
    function refreshCategories(){
        $scope.cat_selected = $postDatas[target].category;
    }
    function refreshTags(){
        $scope.post_tags = $postDatas[target].tags;
    }
    function refreshEditOn(){
        $scope["editOn_"+target] = $postDatas["editOn"][target];
    }
    refreshEditOn();
    refreshCategories();
    refreshTags();

    var Categories = $categories.get();
    var Tags = $tags.get();
    Categories.initialize($window["initialsCategotries_" + target]);

    Tags.initialize($window["initialsCategotries_" + target]);

    $scope.categories = Categories.all();
    $scope.new_cat_name = "";
    $scope.cat_is_saving = false;

    $scope.tags = Tags.all();
    $scope.new_tag_name = "";
    $scope.tag_is_saving = false;

    $scope.newCatForPost = function(){
        if($scope.new_cat_name == ""){
            return;
        }
        $scope.cat_is_saving = true;
        var entity = new CategoryEntity({name: $scope.new_cat_name, target:target});
        $scope.new_cat_name = "";
        Categories.save(entity, function(data, status, headers, config){
            if(data.error == false){

                $postDatas[target].category = Categories.$save(data.category);
                refreshCategories();
                $scope.cat_is_saving = false;
            }
        }, function(data, status, headers, config){
            // server error status code 400 500
        });
    };

    $scope.addTag = function(tag){
        $scope.post_tags.push(tag);

        var idx;
        angular.forEach($scope.tags,function(el,i){
            if(el.id == tag.id){
                idx = i;
            }
        });
        $scope.tags.splice(idx, 1);
    };

    $scope.removeTag = function(tag){

        $scope.tags.push(tag);
        var idx;
        $scope.post_tags.forEach(function(el,i){
            if(el.id == tag.id){
                idx = i;
            }
        });
        $scope.post_tags.splice(idx, 1);
    };

    $scope.newTag = function(){
        if($scope.new_tag_name == ""){
            return;
        }
        $scope.tag_is_saving = true;
        var entity = new TagEntity({name: $scope.new_tag_name, target:target});
        $scope.new_tag_name = "";
        Tags.save(entity,
            function(data, status, headers, config){
                if(data.error == false){
                    var t = Tags.$save(data.tag);
                    $scope.addTag(t);
                }
                $scope.tag_is_saving = false;
            },
            function(data, status, headers, config){
                // server error status code 400 500
            }
        );

    };

    $scope.$watch('editOn_'+target, function(val){
        $postDatas.editOn[target] = val;
    }, true);

    $scope.$watch("cat_selected", function(value){
        $postDatas[target].category = value;
    }, true);

    $scope.$watchCollection("post_tags", function(value){
        $postDatas[target].tags = value;

    }, true);
}]);
