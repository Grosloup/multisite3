var isArray = function(elem){
    return toString.call(elem) === '[object Array]';
};

var isObject = function(elem){
    var t = typeof elem;
    return t === "function" || t === "object" && !!elem;
};

var has = function(o, p){
    return !!o && hasOwnProperty.call(o, p);
};

var deepCopy = function(obj){
    var out, i;
    if (isArray(obj)) {
        out = []; i = 0; var len = obj.length;
        for ( ; i < len; i++ ) {
            out[i] = deepCopy(obj[i]);
        }
        return out;
    }
    if (isObject(obj)) {
        out = {};
        for ( i in obj ) {
            if(has(obj, i)){
                out[i] = deepCopy(obj[i]);
            }
        }
        return out;
    }
    return obj;
};

var create = _c = function(tagname, o){
    var el = document.createElement(tagname);

    for(p in o){
        if(has(o, p)){
            if(p == "id"){
                el.id = o[p];
            }
            else if(p == "class"){
                el.classList.add(o[p]);
            }
            else if(p == "text"){
                el.textContent = o[p];
            }
            else if(p == "html"){
                el.innerHTML = o[p];
            }
            else if(p == "value"){
                el.setAttribute("value", o[p]);
            }
            else if(p == "href"){
                el.href = o[p];
            }
            else {
                el.setAttribute(p, o[p]);
            }
        }
    }

    return el;
};



var forEach = function(elem, iterator){
    if(elem == null) return elem;

    if(isArray(elem)){
        var i, l;
        l = elem.length; i=0;
        for(;i<l;i++){
            iterator(elem[i], i, elem);
        }
    } else {
        var p;
        for(p in arr){
            if(has(elem, p)){
                iterator(elem[p], p, elem);
            }
        }
    }
};

var findById = function(oList, id, idName){
    var result = [], _id = idName || "id";
    forEach(oList, function(e){
        if(has(e,_id) && e[_id] === id){
            result.push(e);
        }
    });
    return result;
};
