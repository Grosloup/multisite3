$(function(){
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    function resizeHeader(img){
        var imgHeaderWidth = img.width();
        img.css("left", -((imgHeaderWidth - $(window).width())/2) + "px");
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
    var imgHeader, siteHeader, img, $imgHeader;
    siteHeader = $("#site-header");
    imgHeader = new Image();
    $imgHeader = $(imgHeader);
    $imgHeader.load(function(){
        $imgHeader.attr("id", "img-header");
        siteHeader.append($imgHeader);
        resizeHeader($imgHeader);
    }).attr("src", "/img/sites/common/headers/" + changeImg());

    $(window).on("resize", function(e){
        e.preventDefault();
        resizeHeader($imgHeader);
    });
});
