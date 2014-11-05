$(function(){
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    function resizeHeader(){
        var imgHeaderWidth = imgHeader.width();
        imgHeader.css("left", -((imgHeaderWidth - $(window).width())/2) + "px");
    }

    function changeImg(){
        var imgIndex, imgName;

        imgName = "header_[[imgIndex]].jpg";
        imgIndex = getRandomInt(1,11);
        if(imgIndex < 10){
            imgIndex = "0" + imgIndex;
        }
        return imgName.replace("[[imgIndex]]", imgIndex);

    }

    $("#stickytop").waypoint('sticky');

    $("#menu-toggler").on("click", function(e){
        e.preventDefault();
        $.scrollTo( this.hash, 300);

    });
    var imgHeader;
    imgHeader = $("#img-header");
    imgHeader.attr("src", "/img/sites/common/headers/" + changeImg());

    resizeHeader();

    $(window).on("resize", function(e){
        e.preventDefault();
        resizeHeader();
    });
});
