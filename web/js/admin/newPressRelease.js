(function($,w){

    jQuery.event.props.push( "dataTransfer" );
    var pdfDefaults = {
        hover: 'hover',
        progressBar: '.dropzone-innerbar',
        url: null,
        lang: 'fr',
        maxSize: 6000000,
        allow: ['application/pdf'],
        errorMessage: function(message){},
        loadDone: function(response){},
        loadFail: function(response){}
    };

    function PdfUploader(el, options){
        this.$el = $(el);
        this.options = $.extend({}, pdfDefaults, options || {});
        this.init();
    }

    PdfUploader.prototype.dragenter = function(e){
        e.preventDefault();
    };

    PdfUploader.prototype.dragover = function(e){
        e.preventDefault();
        var self = $(this).data("zpbUploadPdf");
        $(this).addClass(self.options.hover);
    };

    PdfUploader.prototype.dragleave = function(e){
        e.preventDefault();
        var self = $(this).data("zpbUploadPdf");
        $(this).removeClass(self.options.hover);
    };

    PdfUploader.prototype.drop = function(e){
        e.preventDefault();
        var self = $(this).data("zpbUploadPdf");
        $(this).removeClass(self.options.hover);
        self.options.errorMessage('');
        if(self.isDroppable === true){
            self.isDroppable = false;
            self.upload(e.dataTransfer.files);
        } else {
            if(self.institution == null){
                self.options.errorMessage('Choisissez une institution !');
            }
        }
    };

    PdfUploader.prototype.upload = function(files){
        var file = files[0];
        var self = this;
        if(!'size' in file){
            this.options.errorMessage('');
            this.options.errorMessage('L\'élément déposé n\'est pas un fichier');
            return false;
        }
        if(this.options.allow.indexOf(file.type)<0){
            this.options.errorMessage('');
            this.options.errorMessage('L\'élément déposé n\'est pas du bon type');
            return false;
        }
        if(file.size > this.options.maxSize){
            this.options.errorMessage('');
            this.options.errorMessage('L\'élément déposé est trop lourd');
            return false;
        }

        function load(e){
            var response = $.parseJSON(e.target.responseText);
            self.isDroppable = true;
            if(!response.error){
                self.options.loadDone(response);
            } else {
                self.options.loadFail(response);
            }
        }

        function progress(e){
            if(e.lengthComputable){
                var percent = Math.round((e.loaded/ e.total) * 100) + "%";
                self.progressBar.width(percent);
            }
        }

        this.xhr = new XMLHttpRequest();

        this.xhr.upload.addEventListener("progress", progress, false);

        this.xhr.open('post', this.options.url, true);

        this.xhr.onreadystatechange = function (e) {
            if(self.xhr.readyState == 4){
                self.isDroppable = true;
                if(self.xhr.status == 200){
                    var response = $.parseJSON(e.target.responseText);
                    if(!response.error){
                        self.options.loadDone(response);
                    } else {
                        self.options.loadFail(response);
                    }
                } else {
                    self.options.errorMessage('');
                    self.options.errorMessage(self.xhr.status + " " + self.xhr.statusText);
                }
            }
        };
        this.xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
        this.xhr.setRequestHeader('Content-Type','multipart/form-data');
        this.xhr.setRequestHeader('X-File-Name',file.name);
        this.xhr.setRequestHeader('X-File-Type',file.type);
        this.xhr.setRequestHeader('X-File-Size',file.size);
        this.xhr.setRequestHeader('X-File-Institution', this.institution);
        this.xhr.setRequestHeader('X-File-Lang', this.options.lang);
        this.xhr.send(file);

    };

    PdfUploader.prototype.setInstitution = function(institution){
        if(institution){
            this.institution = institution;
            this.isDroppable = true;
        }
    };



    PdfUploader.prototype.init = function(){
        var el = this.$el;
        var self = this;
        this.isDroppable = false;
        this.institution = null;
        this.progressBar = el.find(this.options.progressBar);
        el.on({
            dragenter: self.dragenter,
            dragover: self.dragover,
            dragleave: self.dragleave,
            drop: self.drop
        });
    };

    var imageDefaults = {
        hover: 'hover',
        progressBar: '.dropzone-innerbar',
        url: null,
        maxSize: 200000,
        allow: ['image/jpg', 'image/gif', 'image/png'],
        errorMessage: function(message){},
        loadDone: function(response){},
        loadFail: function(response){}
    };

    function ImageUploader(el, options){
        this.$el = $(el);
        this.options = $.extend({}, imageDefaults, options || {});
        this.init();
    }

    ImageUploader.prototype.init = function(){
        var el = this.$el;
        var self = this;
        this.isDroppable = false;

        this.progressBar = el.find(this.options.progressBar);
        el.on({
            dragenter: self.dragenter,
            dragover: self.dragover,
            dragleave: self.dragleave,
            drop: self.drop
        });
    };

    ImageUploader.prototype.dragenter = function(e){
        e.preventDefault();
    };

    ImageUploader.prototype.dragover = function(e){
        e.preventDefault();
        var self = $(this).data("zpbUploadImage");
        $(this).addClass(self.options.hover);
    };

    ImageUploader.prototype.dragleave = function(e){
        e.preventDefault();
        var self = $(this).data("zpbUploadImage");
        $(this).removeClass(self.options.hover);
    };

    ImageUploader.prototype.drop = function(e){
        e.preventDefault();
        var self = $(this).data("zpbUploadImage");
        $(this).removeClass(self.options.hover);
        self.options.errorMessage('');
        if(self.isDroppable === true){
            self.isDroppable = false;
            self.upload(e.dataTransfer.files);
        }
    };

    ImageUploader.prototype.upload = function(files){
        var file = files[0];
        var self = this;
        if(!'size' in file){
            this.options.errorMessage('');
            this.options.errorMessage('L\'élément déposé n\'est pas un fichier');
            return false;
        }
        if(this.options.allow.indexOf(file.type)<0){
            this.options.errorMessage('');
            this.options.errorMessage('L\'élément déposé n\'est pas du bon type');
            return false;
        }
        if(file.size > this.options.maxSize){
            this.options.errorMessage('');
            this.options.errorMessage('L\'élément déposé est trop lourd');
            return false;
        }

        function load(e){
            var response = $.parseJSON(e.target.responseText);
            self.isDroppable = true;
            if(!response.error){
                self.options.loadDone(response);
            } else {
                self.options.loadFail(response);
            }
        }

        function progress(e){
            if(e.lengthComputable){
                var percent = Math.round((e.loaded/ e.total) * 100) + "%";
                self.progressBar.width(percent);
            }
        }

        this.xhr = new XMLHttpRequest();

        this.xhr.upload.addEventListener("progress", progress, false);

        this.xhr.open('post', this.options.url, true);

        this.xhr.onreadystatechange = function (e) {
            if(self.xhr.readyState == 4){
                self.isDroppable = true;
                if(self.xhr.status == 200){
                    var response = $.parseJSON(e.target.responseText);
                    if(!response.error){
                        self.options.loadDone(response);
                    } else {
                        self.options.loadFail(response);
                    }
                } else {
                    self.options.errorMessage('');
                    self.options.errorMessage(self.xhr.status + " " + self.xhr.statusText);
                }
            }
        };
        this.xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
        this.xhr.setRequestHeader('Content-Type','multipart/form-data');
        this.xhr.setRequestHeader('X-File-Name',file.name);
        this.xhr.setRequestHeader('X-File-Type',file.type);
        this.xhr.setRequestHeader('X-File-Size',file.size);
        this.xhr.send(file);

    };



    $.fn.zpbUploadPdf = function(options){
        if(!options.url){
            console.error('url non définie !');
        } else {
            return this.each(function(){
                if(!$.data(this, "zpbUploadPdf")){
                    $.data(this, "zpbUploadPdf", new PdfUploader(this, options));
                }
            });
        }
    };

    $.fn.zpbUploadImage = function(options){
        if(!options.url){
            console.error('url non définie !');
        } else {
            return this.each(function(){
                if(!$.data(this, "zpbUploadImage")){
                    $.data(this, "zpbUploadImage", new ImageUploader(this, options));
                }
            });
        }
    }

})(jQuery, this);


