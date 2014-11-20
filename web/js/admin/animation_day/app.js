$(function(){

    var $detailsActive = false;
    var $messenger = $("#messenger");
    var $message = $("#message");
    var addScheduleBtns = $(".anim-day-add-btn button");
    var scheduleTpl = $("#schedule_tpl").html();
    $messenger.hide();

    function showMessage(message){
        $message.html(message);
        $messenger.show();
    }

    function hideMessage(){
        $message.empty();
        $messenger.hide();
    }

    function showLoader(parent){
        $(".loader", parent).removeClass("hide").addClass("show");
        $(".anim-schedule-delete", parent).removeClass("show").addClass("hide");
    }
    function hideLoader(parent){
        $(".loader", parent).removeClass("show").addClass("hide");
        $(".anim-schedule-delete", parent).removeClass("hide").addClass("show");
    }
    function disableSelect(parent){
        $("select", parent).prop("disabled", true);
    }
    function enableSelect(parent){
        $("select", parent).prop("disabled", false);
    }

    $(document).on("click","button.anim-day-modify-btn",function(e){
        e.preventDefault();
        var $btn = $(this);
        var $detail = $btn.parents(".anim-day-row:first").nextAll(".anim-day-details:first");
        if($detail.hasClass("active")){
            return true;
        }
        $detailsActive = $(".anim-day-details.active");
        if($detailsActive.length>0){
            $detailsActive.slideUp(300, function(){
                $detailsActive.removeClass("active");
            })
        }
        $detail.slideDown().addClass("active");
    });

    $(document).on("click", ".anim-day-add-btn button", function(e){
        e.preventDefault();
        var $this = $(this);
        var parent = $this.parents(".anim-day-add-form:first");
        var superParent = parent.parents(".anim-day:first");
        var schedules = $(".anim-day-details", superParent);
        var hSelect = $(".anim-day-add-select-hour select", parent);
        var mSelect = $(".anim-day-add-select-min select", parent);
        var aSelect = $(".anim-day-add-select-anim select",parent);
        var loader = $(".loader", parent);
        var tpl = scheduleTpl;

        loader.removeClass("hide").addClass("show");
        $this.removeClass("show").addClass("hide");
        $.post(addScheduleUrl, {dayId: parent.attr("data-id"), hour: hSelect.val(), min: mSelect.val(), animId: aSelect.val()})
            .done(function(response){
                if(response.error === false){
                    tpl = tpl.replace("[[id]]", response["horaire"]["id"]).replace("[[animation]]", response["horaire"]["animation"]);
                    var d = $("<div />");
                    d.html(tpl);
                    schedules.append($(".anim-schedule", d));
                    d = null;
                } else {

                }

                loader.removeClass("show").addClass("hide");
                $this.removeClass("hide").addClass("show");
                showMessage(response.msg);
            })
            .fail(function(jqXHR){
                loader.removeClass("show").addClass("hide");
                $this.removeClass("hide").addClass("show");
                showMessage(jqXHR.status + " " + jqXHR.statusText);
            });

        console.log($this, hSelect.val(), mSelect.val(), aSelect.val());
    });

    $(document).on("click", ".anim-day-add-btn", function(e){
        e.preventDefault();
        var $btn = $(this);
        var $detail = $btn.parents(".anim-day-row:first").nextAll(".anim-day-add:first");
        if($detail.hasClass("show")){
            $detail.slideUp(300, function(){
                $detail.removeClass("show").addClass("hide");
            });

            return true;
        }
        $detail.slideDown(300, function(){
            $detail.addClass("show").removeClass("hide");
        });


    });


    $(document).on("change", ".anim-schedule-hour-select", function(e){
        e.preventDefault();
        if(changeHourUrl == undefined || changeHourUrl == null || changeHourUrl == ""){
            return false;
        }
        var $this = $(this);
        var parent = $this.parents(".anim-schedule:first");
        var id = parent.attr("data-id");
        disableSelect(parent);
        showLoader(parent);
        hideMessage();
        $.post(changeHourUrl, {hour:$this.val(), id:id})
            .done(function(response){

                if(response.error === false){

                } else {

                }
                if(response.msg){
                    showMessage(response.msg);
                }
                enableSelect(parent);
                hideLoader(parent);
            })
            .fail(function( jqXHR, textStatus, errorThrown ){
                showMessage(jqXHR.status + " " + jqXHR.statusText);
                enableSelect(parent);
                hideLoader(parent);
            });

    });

    $(document).on("change", ".anim-schedule-min-select", function(e){
        e.preventDefault();
        if(changeMinUrl == undefined || changeMinUrl == null || changeMinUrl == ""){
            return false;
        }
        var $this = $(this);
        var parent = $this.parents(".anim-schedule:first");
        var id = parent.attr("data-id");
        disableSelect(parent);
        showLoader(parent);
        hideMessage();
        $.post(changeMinUrl, {min:$this.val(), id:id})
            .done(function(response){

                if(response.error === false){

                } else {

                }
                if(response.msg){
                    showMessage(response.msg);
                }
                enableSelect(parent);
                hideLoader(parent);
            })
            .fail(function( jqXHR, textStatus, errorThrown ){
                showMessage(jqXHR.status + " " + jqXHR.statusText);
                enableSelect(parent);
                hideLoader(parent);
            });
    });
});
