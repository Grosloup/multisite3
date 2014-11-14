$(function(){
    var uploader = $("#imgUpload");
    console.log(uploader);

    function errorMessage(message){
        uploader.find(".dropzone-message").text(message);
    }
    function loadDone(response){

    }
    function loadFail(response){

    }


    uploader.zpbUploadImage({
        url: uploadUrl || null,
        errorMessage: "",
        loadDone: "",
        loadFail: ""
    });
});
