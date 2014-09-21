(function($,w,d){
    jQuery.event.props.push( "dataTransfer" );
    var uploadOptions = {
        multiple: false,
        droparea: '.dropzone-in',
        droploader: '.dropzone-loader',
        progressbar: '.dropzone-innerbar',
        actions: '.dropzone-actions',
        message: '.dropzone-message',
        deleteBtn: '.dropzone-delete-btn',
        hover: 'hover',
        legend: 'Déposez votre image ici',
        allow: ['image/jpeg', 'image/gif', 'image/png'],
        maxSize: 4500000,
        url: '/xhr/upload/resto/img',
        deleteImgUrl: '/xhr/supprimer/resto/img',
        targetId : null
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
                dropin.after(response.html);
                dropin.hide();
                message.text(response.msg);
                progressBar.width(0+"%");
                progressBar.parent().hide();
                actions.removeClass("hide").addClass('show');
                zone.data('droppable', false);
                if(opts.targetId){
                    $(opts.targetId).val(response.imgId);
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

        xhr.setRequestHeader('X-File-Id',zone.data('longid'));

        xhr.send(file);
    }

    $.fn.uploadFile = function(options){
        var opts = $.extend({}, uploadOptions, options || {});

        this.each(function(){
            var $this = $(this), legend = $this.find(".dropzone-legend");
            var deleteBtn = $this.find(opts.deleteBtn);
            var progressBar = $this.find(opts.progressbar);
            var message = $this.find(opts.message);
            var actions = $this.find(opts.actions);
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
                    $(this).removeClass(opts.hover);
                    if($this.data('droppable')){
                        upload(e.dataTransfer.files, $this, 0, opts);
                    }

                }
            });

            deleteBtn.on("click", function(e){
                e.preventDefault();
                var img = $this.find("img");
                var id = img.data("id");

                $this.data('droppable', true);
                if(id){
                    $.get(opts.deleteImgUrl + '/' + id).done(function(resp){
                        if(resp.error){
                            message.text('Une erreur est survenue !');
                        } else {
                            img.remove();
                            progressBar.parent().show();
                            message.text('');
                            actions.removeClass("show").addClass("hide");
                            dropin.show();
                        }
                    }).fail(function(){
                        message.text('Une erreur est survenue !');
                    });
                }
            });
        });

    }
})(jQuery, this, document);

$(function(){
    var imgChooser = $("#image-chooser");
    var iptName = $("#resto_form_name");
    var iptFilename = $("#filename");
    var addImgBtn = $("#addImgBtn");
    var targetId = "#resto_form_imgId";
    var errorBlock = $("#error");
    var target = $(targetId);
    imgChooser.hide();

    iptName.on('keyup', function(e){
        e.preventDefault();
        var val = iptName.val();

        if(val){
            if(!imgChooser.is(":visible")){
                imgChooser.show();
            }

        } else {
            if(imgChooser.is(":visible")){
                imgChooser.hide();
            }
        }
    });

    var dropzone;
    dropzone = $("#dropzone");
    dropzone.uploadFile({targetId: targetId});

    addImgBtn.on('click', function(e){
        e.preventDefault();
        var filename = iptFilename.val();
        if(filename){
            $.post('/xhr/get-img-id', {filename: filename})
                .done(function(response){
                    if(response.error){
                        error.text(response.msg);
                    } else {
                        target.val(response.imgId);
                        error.text("Image trouvée");
                    }
                })
                .fail(function(){
                    error.text("Un problème est survenu !");
                });
        }
    })
});
