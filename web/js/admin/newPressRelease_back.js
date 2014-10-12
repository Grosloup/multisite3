(function($,w, d){

    jQuery.event.props.push( "dataTransfer" );
    var uploadPdfOptions = {
        multiple: false,
        droparea: '.dropzone-in',
        droploader: '.dropzone-loader',
        progressbar: '.dropzone-innerbar',
        actions: '.dropzone-actions',
        message: '.dropzone-message',
        deleteBtn: '.dropzone-delete-btn',
        hover: 'hover',
        legend: 'Déposez votre pdf ici',
        allow: ['application/pdf'],
        maxSize: 4500000,
        url: '',
        deleteImgUrl: '',
        institution: '',
        targetId : null,
        lang: 'fr'
    };

    function upload(files, zone, idx, opts){
        var file = files[idx], message= zone.find(opts.message);
        if(!'size' in file){
            message.text("L'élément déposé n'est pas un fichier");
            return false;
        }
        if(file.size > opts.maxSize){
            message.text("L'élément déposé est trop lourd");
            return false;
        }
        if(opts.allow.indexOf(file.type) < 0 ){
            message.text("L'élément déposé n'est pas du bon type");
            return false;
        }
        var dropin = zone.find(opts.droparea);
        var progressBar = zone.find(opts.progressbar);
        var actions = zone.find(opts.actions);
        var xhr = new XMLHttpRequest();

        function loadFunc(e){
            var response = $.parseJSON(e.target.responseText);
            if(response.error){
                message.text(response.msg);
                progressBar.width(0+"%");
                zone.data('droppable', true);
            } else {
                dropin.hide();
                message.text(response.msg);
                progressBar.width(0+"%");
                progressBar.parent().hide();
                zone.data('droppable', false);
                if(opts.targetId){
                    $(opts.targetId).val(response.pdfFilename);
                }
            }
        }
        function progressFunc(e){
            if(e.lengthComputable){
                var percent = Math.round((e.loaded/ e.total) * 100) + "%";
                progressBar.width(percent);
            }
        }
        xhr.addEventListener("load", loadFunc, false);
        xhr.upload.addEventListener("progress", progressFunc, false);
        xhr.open('post', opts.url, true);
        xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
        xhr.setRequestHeader('Content-Type','multipart/form-data');
        xhr.setRequestHeader('X-File-Name',file.name);
        xhr.setRequestHeader('X-File-Type',file.type);
        xhr.setRequestHeader('X-File-Size',file.size);
        xhr.setRequestHeader('X-File-Lang',opts.lang);
        if(opts.institution){
            xhr.setRequestHeader('X-File-Institution', opts.institution);
        }
        xhr.send(file);
    }

    $.fn.uploadPdf = function(options){
        var opts = $.extend({}, uploadPdfOptions, options || {});
        this.setInstitution = function(id){
            opts.institution = id;
        };
        return this.each(function(){



            var $this = $(this), legend = $this.find(".dropzone-legend");
            var progressBar = $this.find(opts.progressbar);
            var message = $this.find(opts.message);
            var dropin = $this.find(opts.droparea);
            legend.text(opts.legend);
            $this.data('droppable', true);
            $this.on({
                dragenter: function(e){
                    e.preventDefault();
                },
                dragover: function(e){
                    e.preventDefault();
                    $(this).addClass(opts.hover);
                },
                dragleave: function(e){
                    e.preventDefault();
                    $(this).removeClass(opts.hover);
                },
                drop: function(e){
                    e.preventDefault();
                    if(opts.institution != null){
                        message.text("");
                        $(this).removeClass(opts.hover);
                        if($this.data('droppable')){
                            upload(e.dataTransfer.files, $this, 0, opts);
                        }
                    } else {
                        $(this).removeClass(opts.hover);
                        message.text("Choisissez une institution !");
                    }


                }
            });
        });
    }
})(jQuery, this, document);
$(function(){
    var pdfFr = $("#dropzone-pdf-fr");
    var pdfEn = $("#dropzone-pdf-en");

    var uploadfr = {
        url: pdfUploadUrl,
        institution: null,
        targetId: "#press_release_form_pdfFr"
    };

    var uploaden = {
        url: pdfUploadUrl,
        institution: null,
        targetId: "#press_release_form_pdfEn",
        lang: 'en'
    };
    var uploadPdfFr = pdfFr.uploadPdf(uploadfr);
    console.log(uploadPdfFr);
    var uploadPdfEn = pdfEn.uploadPdf(uploaden);

    $("#press_release_form_institution").on("change", function(e){
        e.preventDefault();
        var id = $(this).find("option:selected").val();
        if(id != null){
            uploadPdfFr.setInstitution(id);
            uploadPdfEn.setInstitution(id);
        }

    });


});
