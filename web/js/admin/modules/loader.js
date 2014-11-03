function Loader(){
    this.container = $("<div />", {"class": "loader"});
    this.loader = $("<div />", {"class": "facebookG"});
    this.bar1 = $("<div />", {"class": "blockG_1 facebook_blockG"});
    this.bar2 = $("<div />", {"class": "blockG_2 facebook_blockG"});
    this.bar3 = $("<div />", {"class": "blockG_3 facebook_blockG"});
    this.loader.append(this.bar1, this.bar2, this.bar3);
    this.container.append(this.loader);
}

Loader.prototype.get = function(hide){
    if(hide === true){
        this.hide();
    }
    return this.container;
};

Loader.prototype.hide = function(){
    this.container.hide();
};

Loader.prototype.show = function(){
    this.container.show();
};
