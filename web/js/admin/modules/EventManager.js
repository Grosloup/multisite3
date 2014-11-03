if(typeof deepCopy !== "function"){
    alert("addons.js file is missing !");
}
function Event(name, datas){
    this.name = name;
    this.datas = datas || {};
}

function EventManager(){
    this.events = {};
}

EventManager.prototype.attach = function(evtname, listener){
    if(!has(this.events, evtname)){
        this.events[evtname] = [];
    }

    this.events[evtname].push(listener);
};

EventManager.prototype.trigger = function(evt){
    if(!(evt instanceof Event) || !has(this.events, evt["name"])){
        return;
    }

    forEach(this.events[evt["name"]], function(listener, i){
        listener(evt);
    });
};
