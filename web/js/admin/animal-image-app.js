(function($,w,d){
    jQuery.event.props.push( "dataTransfer" );

    $.fn.animalImageUploader = function(o){
        var defaults = {
            url: "/uploads",
            type: "hd",
            target: null,
            element: null,
            droparea: '.dropzone-in',
            droploader: '.dropzone-loader',
            progressbar: '.dropzone-innerbar',
            hover: 'hover',
            legend: 'Déposez votre image ici',
            allow: ['image/jpeg'],
            maxSize: 6000000,
            message: '.dropzone-message'
        };

        var opts = $.extend({}, defaults, o||{});

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
            xhr.setRequestHeader('X-File-AnimalId',zone.data('id'));

            xhr.send(file);
        }

        this.each(function(){
            var $this = $(this), legend = $this.find(".dropzone-legend");
            legend.text(opts.legend);
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
                    $(this).removeClass(opts.hover);
                    if($this.data('droppable')){
                        upload(e.dataTransfer.files, $this, 0, opts);
                    }

                }
            });
        });
    }

})(jQuery,this,document);

$(function(){
    var hdDropZone = $("#hd-drop");
    var wpDropZone = $("#wallpaper-drop");
    var frontDropZone = $("#front-drop");

    hdDropZone.animalImageUploader({
        url: "",
        type: "hd",
        target: "",
        element: "li"
    });
    wpDropZone.animalImageUploader({
        url: "",
        type: "wallpaper",
        target: "",
        element: "li"
    });
    frontDropZone.animalImageUploader({
        url: "",
        type: "front",
        target: "",
        element: "li"
    });
});
