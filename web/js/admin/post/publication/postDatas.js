var postDatasApp = angular.module('PostDataApp', []);

postDatasApp.service('$postDatas', ['$window',function($window){
    if($window.postDatas !== undefined){
        return $window.postDatas;
    }
    return {
        postId: $window.postId || null,
        editOn: {
            zoo: false,
            bn: false,
            jdb: false,
            hdb: false,
            pdb: false
        },
        zoo:{
            name: "ZooParc de Beauval",
            category: null,
            tags: []
        },
        bn:{
            name: "Beauval Nature",
            category: null,
            tags: []
        },
        jdb:{
            name: "Les Jardins de Beauval",
            category: null,
            tags: []
        },
        hdb:{
            name: "Les Hameaux de Beauval",
            category: null,
            tags: []
        },
        pdb:{
            name: "Les Pagodes de Beauval",
            category: null,
            tags: []
        }
    };
}]);
