$(function(){

    var validObj = {
        title: false,
        body: false,
        excerpt: false,
        fb: false,
        square: false,
        bandeau: false
    };
    var editBtn = $("#new_post_form_publish"), iptTitle = $("#new_post_form_title");

    function enableEdition(){
        if(
            validObj.title === true &&
            validObj.body === true &&
            validObj.excerpt === true &&
            validObj.fb === true &&
            validObj.square === true &&
            validObj.bandeau === true
        ){
            editBtn.attr("disabled", false);
        } else {
            editBtn.attr("disabled", "disabled");
        }
    }

    enableEdition();

    //#################### title

    iptTitle.on("keyup", function(e){
        validObj.title = ( $(this).val().length > 0);
        enableEdition();
    });

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
                var el = editor.getSession().getValue().length;
                $("#excerpt-char-counter").text(el);
                validObj.excerpt = (el > 0);
                enableEdition();
            }
            if(textarea.attr("id") == "new_post_form_body"){
                validObj.body = (editor.getSession().getValue().length > 0);
                enableEdition();
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
        validObj.bandeau = true;
        enableEdition();
    }

    function loadFailBandeau(response){
        bandeau.find(".dropzone-message").text(response.msg);
        validObj.bandeau = false;
        enableEdition();
    }

    function errorMessageSquarre(message){
        squarre.find(".dropzone-message").text(message);
    }

    function loadDoneSquarre(response){
        $("#post_form_squarreThumb").val(response.pdfId);
        squarre.find(".dropzone-message").text(response.msg);
        validObj.square = true;
        enableEdition();
    }

    function loadFailSquarre(response){
        squarre.find(".dropzone-message").text(response.msg);
        validObj.square = false;
        enableEdition();
    }

    function errorMessageFb(message){
        fb.find(".dropzone-message").text(message);
    }

    function loadDoneFb(response){
        $("#post_form_fbThumb").val(response.pdfId);
        fb.find(".dropzone-message").text(response.msg);
        validObj.fb = true;
        enableEdition();
    }

    function loadFailFb(response){
        fb.find(".dropzone-message").text(response.msg);
        validObj.fb = false;
        enableEdition();
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
