$(function(){
    var uploader = $("#imgUpload");
    var sortable = $("#sort-slide");


    function errorMessage(message){
        uploader.find(".dropzone-message").text(message);
    }
    function loadDone(response){
        uploader.find(".dropzone-message").text(response.msg);

        var html = "<div class='slide'>" +
            "<div class='slide-element slide-handle'></div>" +
            "<div class='slide-element slide-position'>[[position]]</div>" +
            "<div class='slide-element slide-img'>" +
            "<img src='[[url]]' />" +
            "</div>" +
            "<div class='slide-element slide-activate'>" +
            "<label><input type='checkbox' data-id='[[id]]' class='slide-activate-ipt'> activée</label>" +
            "</div>" +
            "<div class='slide-element slide-delete'>" +
            "<a href='' class='slide-delete-btn'  data-id='[[id]]'><i class='fa fa-trash-o'></i></a>" +
            "</div>" +
            "</div>";

        html = html.replace(/\[\[id\]\]/g, response["slide"]["id"])
            .replace("[[position]]", response["slide"]["position"])
            .replace("[[url]]", response["slide"]["url"]);
        var li = $("<li>", {id: response["slide"]["id"]});
        li.html(html);
        sortable.append(li);
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
            var id = $(this).attr("data-id");
            var slide = $(this).parents("li#" + id);
            $.get(url, {imgId: id}).done(function(response){
                if(response.error === false ){
                    slide.remove();
                    messageReposition.text(response.msg);
                } else {
                    messageReposition.text(response.msg);
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

    $(document).on("change", ".slide-activate-ipt", function(e){
        e.preventDefault();
        loader.removeClass("hide");
        var url, id = $(this).attr("data-id");
        if($(this).is(":checked")){
            url = activateUrl;
        } else {
            url = desActivateUrl;
        }

        $.get(url, {imgId: id})
            .done(function(response){
                messageReposition.text(response.msg);
                loader.addClass("hide");
                window.setTimeout(function(){
                    messageReposition.text("");
                }, 5000);
            })
            .fail(function(response){
                messageReposition.text(response.msg);
                loader.addClass("hide");
            });
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
