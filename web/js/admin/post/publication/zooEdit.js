var zooEditApp = angular.module("ZooEditApp",['PostDataApp', 'CategoryFactory','TagFactory']);

/*var testCategories = [{id:1, name:"cat 1", slug:"cat-1", target: "zoo"},{id:2, name:"cat-2", slug:"cat 2", target: "zoo"},{id:3, name:"cat 3", slug:"cat-3", target: "zoo"}];
var testTags = [{id:1, name:"tag 1", slug:"tag-1", target: "zoo"},{id:2, name:"tag-2", slug:"tag 2", target: "zoo"},{id:3, name:"tag 3", slug:"tag-3", target: "zoo"}];*/

zooEditApp.controller('ZooController',['$scope','$window','$postDatas','$categories','$tags', function($scope,$window, $postDatas,$categories,$tags){
    var target = "zoo";
    function refreshCategories(){
        $scope.cat_selected = $postDatas[target].category;
    }
    function refreshTags(){
        $scope.post_tags = $postDatas[target].tags;
    }
    refreshCategories();
    refreshTags();

    $scope["editOn_"+target] = false;
    var Categories = $categories.get();
    var Tags = $tags.get();
    Categories.initialize($window["initialsCategotries_" + target]);
    //Categories.initialize(testCategories);

    Tags.initialize($window["initialsCategotries_" + target]);
    //Tags.initialize(testTags);

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
