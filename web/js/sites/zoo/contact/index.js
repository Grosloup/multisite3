require(["jquery", "modal"], function($, m){

    (function($,m){
        $.fn.zpbModal = function(options){
            var body = $("body");
            if($("> #overlay", body).length < 1){
                body.prepend($("<div id='overlay' />"));
            }

            return this.each(function(){
                if(!$.data(this, "zpbModal")){
                    $.data(this, "zpbModal", new m.Modal(this, options));
                }
            });
        };
    })($,m);
    $(function(){


        function selectInterloc(value){
            var options = $("#info_zoo_contact_form_interlocutor").find("option");
            options.attr("selected", false);
            options.each(function(){
                if($(this).val() === value){
                    $(this).attr("selected", true);
                }
            });
        }
        var $modal = $(".modal");
        $modal.zpbModal();
        var modal = $modal.data("zpbModal");
        $(".contact").on("click", function(e){
            e.preventDefault();
            selectInterloc($(this).data("id"));
            modal.open();
        })
    })
});
