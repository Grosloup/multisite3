angular.module('$configs', [])
.value(
    "configs",
    {
        urls: {
            "base": "/actualites/api",
            categories: {
                "base":"/post/categories",
                "save": "",
                "update": "",
                "get": "/",
                "getAll": "",
                "delete": "/"
            },
            tags: {
                "base": "/post/tags",
                "save": "",
                "update": "",
                "get": "/",
                "getAll": "",
                "delete": "/"
            }
        }
    }
);
