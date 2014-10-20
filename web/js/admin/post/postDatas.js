var postDatasApp = angular.module('PostDataApp', []);

postDatasApp.service('$postDatas', function(){
    return {
        editOn: {
            zoo: false,
            bn: false,
            jdb: false,
            hdb: false,
            pdb: false
        },
        zoo:{
            category: null,
            tags: []
        },
        bn:{
            category: null,
            tags: []
        },
        jdb:{
            category: null,
            tags: []
        },
        hdb:{
            category: null,
            tags: []
        },
        pdb:{
            category: null,
            tags: []
        }
    };
});
