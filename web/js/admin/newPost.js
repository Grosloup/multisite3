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
        url: '/xhr/upload/img',
        deleteImgUrl: '/xhr/supprimer/img',

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
    $("textarea[data-editor]").each(function(){
        var textarea = $(this);
        var mode = textarea.data('editor') || 'html';
        var size = textarea.data('editorsize') || 'medium';
        var height = (size == "small") ? 250 : (size == "medium") ? 400 : (size == "large") ? 600 : 800;
        var options = {
            position: 'absolute',
            width: textarea.width(),
            height: height,
            'class': textarea.attr('class')
        };
        var editorDiv = $("<div/>", options);
        editorDiv.insertBefore(textarea);
        textarea.css('display','none');
        var editor = ace.edit(editorDiv[0]);
        editor.getSession().setValue(textarea.val());
        editor.setTheme('ace/theme/merbivore');
        editor.getSession().setMode('ace/mode/'+mode);
        editor.getSession().setUseWrapMode(true);
        editor.getSession().setWrapLimitRange(80,80);
        editor.renderer.setPrintMarginColumn(80);
        editor.setOption('enableEmmet', true);
        editor.getSession().on('change', function(e){
            textarea.val(editor.getSession().getValue());
        });
    });




    var addTagBtn, tagsContainer, counter;
    addTagBtn = $("#addTagBtn");
    tagsContainer = $("#tagsContainer");
    counter = tagsContainer.children().length;
    function buildTagForm(idx){
        var template =
             "<div class='form-row' id='post_form_tags_"+idx+"_name_parent'>"
                +"<div class='form-field'>"
                     +"<div class='row'>"
                         +"<div class='column-10'>"
                            +"<input type='text' id='post_form_tags_"+idx+"_name' name='post_form[tags]["+idx+"][name]'/>"
                         +"</div>"
                         +"<div class='column-2'>"
                            +"<button class='removeTagBtn btn btn-primary' data-target='post_form_tags_"+idx+"_name_parent'><i class='fa fa-minus'></i></button>"
                         +"</div>"
                     +"</div>"
                +"</div>"
            +"</div>";
        return $(template);
    }
    addTagBtn.on("click", function(e){
        e.preventDefault();
        tagsContainer.append(buildTagForm(counter++));
        return false;
    });
    $("body").on("click", ".removeTagBtn", function(e){
        e.preventDefault();
        var target = $("#" + $(this).data("target")) || null;
        if(target){
            target.remove();
        }
    });

    var dropzone;
    dropzone = $("#dropzone");
    dropzone.uploadFile();


});











