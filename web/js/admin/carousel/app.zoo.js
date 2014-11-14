$(function(){
    var uploader = $("#imgUpload");


    function errorMessage(message){
        uploader.find(".dropzone-message").text(message);
    }
    function loadDone(response){
        uploader.find(".dropzone-message").text(response.msg);
    }
    function loadFail(response){
        uploader.find(".dropzone-message").text(response.msg);
    }


    uploader.zpbUploadImage({
        url: uploadUrl || null,
        maxSize: 250000,
        errorMessage: errorMessage,
        loadDone: loadDone,
        loadFail: loadFail
    });
});
