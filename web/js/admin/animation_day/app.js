$(function(){

    var $detailsActive = false;

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


    $(document).on("change", ".anim-schedule-hour-select", function(e){
        e.preventDefault();
        var $this = $(this);
        var parent = $this.parents(".anim-schedule:first");
        var id = parent.attr("data-id");
        disableSelect(parent);
        showLoader(parent);



    });

    $(document).on("change", ".anim-schedule-min-select", function(e){
        e.preventDefault();
        var $this = $(this);
        var parent = $this.parents(".anim-schedule:first");
        var id = parent.attr("data-id");
        disableSelect(parent);
        showLoader(parent);

    });
});
