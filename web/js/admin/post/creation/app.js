$(function(){

    //#################### editeur

    $("textarea[data-editor]").each(function(){
        var textarea = $(this);
        var mode = textarea.data('editor') || 'html';
        var size = textarea.data('editorsize') || 'medium';
        var height = (size == "small") ? 100 : (size == "medium") ? 400 : (size == "large") ? 600 : 800;
        var options = {
            position: 'absolute',
            width: textarea.width(),
            height: height,
            'class': textarea.attr('class')
        };
        var editorDiv = $("<div/>", options);
        editorDiv.insertBefore(textarea);
        textarea.css('display','none');
        var editor = ace.edit(editorDiv[0]);
        editor.getSession().setValue(textarea.val());
        editor.setTheme('ace/theme/merbivore');
        editor.getSession().setMode('ace/mode/'+mode);
        editor.getSession().setUseWrapMode(true);
        editor.getSession().setWrapLimitRange(80,80);
        editor.renderer.setPrintMarginColumn(80);
        editor.setOption('enableEmmet', true);
        editor.getSession().on('change', function(e){
            textarea.val(editor.getSession().getValue());
        });

        editor.on("change", function(){
            if(textarea.attr("id") == "new_post_form_excerpt"){
                $("#excerpt-char-counter").text(editor.getSession().getValue().length);
            }
        });

    });


    //#################### img upload
    var bandeau, squarre,fb;
    bandeau = $("#dropzone-img-bandeau");
    squarre = $("#dropzone-img-squarre ");
    fb = $("#dropzone-img-fb");

    function errorMessageBandeau(message){
        bandeau.find(".dropzone-message").text(message);
    }

    function loadDoneBandeau(response){
        $("#post_form_bandeau").val(response.pdfId);
        bandeau.find(".dropzone-message").text(response.msg);
    }

    function loadFailBandeau(response){
        bandeau.find(".dropzone-message").text(response.msg);
    }

    function errorMessageSquarre(message){
        squarre.find(".dropzone-message").text(message);
    }

    function loadDoneSquarre(response){
        $("#post_form_squarreThumb").val(response.pdfId);
        squarre.find(".dropzone-message").text(response.msg);
    }

    function loadFailSquarre(response){
        squarre.find(".dropzone-message").text(response.msg);
    }

    function errorMessageFb(message){
        fb.find(".dropzone-message").text(message);
    }

    function loadDoneFb(response){
        $("#post_form_fbThumb").val(response.pdfId);
        fb.find(".dropzone-message").text(response.msg);
    }

    function loadFailFb(response){
        fb.find(".dropzone-message").text(response.msg);
    }

    bandeau.zpbUploadImage({
        url: uploadImageUrl || '',
        errorMessage: errorMessageBandeau,
        loadDone: loadDoneBandeau,
        loadFail: loadFailBandeau
    });

    squarre.zpbUploadImage({
        url: uploadImageUrl || '',
        errorMessage: errorMessageSquarre,
        loadDone: loadDoneSquarre,
        loadFail: loadFailSquarre
    });

    fb.zpbUploadImage({
        url: uploadImageUrl || '',
        errorMessage: errorMessageFb,
        loadDone: loadDoneFb,
        loadFail: loadFailFb
    });

    imgUploaderBandeau = bandeau.data("zpbUploadImage");
    imgUploaderSquarre = squarre.data("zpbUploadImage");
    imgUploaderFb = fb.data("zpbUploadImage");
});
