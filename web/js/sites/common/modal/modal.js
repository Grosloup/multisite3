

(function($,w){
    var defaults = {
        overlay: "overlay",
        onOpen: function(){},
        onClose: function(){}
    };

    function Modal(element, options){
        this.$el = $(element);
        this.options = $.extend({}, defaults, options || {});

        this.init();
    }

    Modal.prototype.init = function(){
        var self = this;
        this.$overlay = $("#" + this.options['overlay']);
        this.$closeBtn = this.$el.find(".modal-close-btn");

        this.$closeBtn.on("click", function(e){
            e.preventDefault();
            self.close();
        });

        this.$overlay.on("click", function(e){
            e.preventDefault();
            self.close();
        });

        $(w).on("resize", function(){
            if(self.$el.is(":visible")){
                self.position();
            }
        });
    };

    Modal.prototype.open = function(callback){
        this.$overlay.show();
        this.$el.show();
        this.position();
        this.options.onOpen();

        if(callback && $.isFunction(callback)){
            callback();
        }
    };

    Modal.prototype.close = function(callback){
        this.$overlay.hide();
        this.$el.hide();
        this.options.onClose();
        if(callback && $.isFunction(callback)){
            callback();
        }
    };

    Modal.prototype.position = function(){
        var w, h, wW, wH;
        w = this.$el.width();
        h = this.$el.height();
        wW = $(window).width();
        wH = $(window).height();
        this.$el.css("left", ((wW - w)/2) + "px");
        this.$el.css("top", ((wH - h)/2) + "px");
    };

    $.fn.zpbModal = function(options){
        var body = $("body");
        if($("> #overlay", body).length < 1){
            body.prepend($("<div id='overlay' />"));
        }

        return this.each(function(){
            if(!$.data(this, "zpbModal")){
                $.data(this, "zpbModal", new Modal(this, options));
            }
        });
    };


})(jQuery, this);
