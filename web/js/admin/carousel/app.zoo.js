$(function(){
    var uploader = $("#imgUpload");
    var sortable = $("#sort-slide");


    function errorMessage(message){
        uploader.find(".dropzone-message").text(message);
    }
    function loadDone(response){
        uploader.find(".dropzone-message").text(response.msg);
    }
    function loadFail(response){
        uploader.find(".dropzone-message").text(response.msg);
    }

    var messageReposition = $(".slide-message .message");

    uploader.zpbUploadImage({
        url: uploadUrl || null,
        maxSize: 250000,
        errorMessage: errorMessage,
        loadDone: loadDone,
        loadFail: loadFail
    });


    $(document).on("click", ".slide-delete-btn", function(e){
        e.preventDefault();
        if(window.confirm("Vous allez supprimer une image, confirmez")){
            loader.removeClass("hide");
            var url = deleteSlideUrl;
            $.get(url, {imgId: $(this).attr("data-id")}).done(function(response){
                if(response.error === false ){

                } else {

                }
                loader.addClass("hide");
                window.setTimeout(function(){
                    messageReposition.text("");
                }, 5000);
            }).fail(function(response){
                messageReposition.text(response.msg);
                loader.addClass("hide");
            });
        }
        return false;

    });


    var loader = $(".slide-message .loader");

    sortable.sortable({
        handle: ".slide-handle",
        cursor: "move",
        placeholder: "phantom",
        update: function(evt,ui){
            var it = ui.item;
            var list = ui.item.parent("ul");
            var id = parseInt(it.attr("id"));
            var pos = 0;

            list.find("li").each(function(){
                $(this).find(".slide-position").text(pos);
                pos++;
            });
            var position = parseInt(it.find(".slide-position").text());
            sortable.sortable("disable");
            console.log(id, position);
            loader.removeClass("hide");
            $.post(updatePosUrl, {id: id, position: position})
                .done(function(response){
                    messageReposition.text("");
                    if(response.error === false){
                        messageReposition.text(response.msg);
                    } else {
                        messageReposition.text(response.msg);
                    }
                    sortable.sortable("enable");
                    loader.addClass("hide");
                    window.setTimeout(function(){
                        messageReposition.text("");
                    }, 5000);
                })
                .fail(function(response){
                    messageReposition = "Une erreur est survenue !";
                    loader.addClass("hide");
                });
        }
    });
});
