$(function(){

    var saveBtn, savePublishBtn, bandeau, squarre,
        articleState,addTagBtn, tagsContainer, counter, form,
        fb, imgUploaderBandeau, imgUploaderSquarre, imgUploaderFb,
        targets, catSelector;

    articleState = {
        hasTitle: false,
        hasBody: false,
        hasTarget: false,
        hasCategory: false,
        hasExcerpt: false,
        checkNums: 0
    };

    $("textarea[data-editor]").each(function(){
        var textarea = $(this);
        var mode = textarea.data('editor') || 'html';
        var size = textarea.data('editorsize') || 'medium';
        var height = (size == "small") ? 250 : (size == "medium") ? 400 : (size == "large") ? 600 : 800;
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
            if(textarea.attr("id") == "post_form_body"){
                articleState.hasBody = (editor.getSession().getValue() != "");
            }
            if(textarea.attr("id") == "post_form_excerpt"){
                articleState.hasExcerpt = (editor.getSession().getValue() != "");
            }
            articleStateChange();
        })
    });

    addTagBtn = $("#addTagBtn");
    tagsContainer = $("#tagsContainer");
    counter = tagsContainer.children().length;
    function buildTagForm(idx){
        var template =
            "<div class='form-row' id='post_form_tags_"+idx+"_name_parent'>"
            +"<div class='form-field'>"
            +"<div class='row'>"
            +"<div class='column-10'>"
            +"<input type='text' id='post_form_tags_"+idx+"_name' name='post_form[tags]["+idx+"][name]'/>"
            +"</div>"
            +"<div class='column-2'>"
            +"<button class='removeTagBtn btn btn-primary' data-target='post_form_tags_"+idx+"_name_parent'><i class='fa fa-minus'></i></button>"
            +"</div>"
            +"</div>"
            +"</div>"
            +"</div>";
        return $(template);
    }
    addTagBtn.on("click", function(e){
        e.preventDefault();
        tagsContainer.append(buildTagForm(counter++));
        return false;
    });
    $("body").on("click", ".removeTagBtn", function(e){
        e.preventDefault();
        var target = $("#" + $(this).data("target")) || null;
        if(target){
            target.remove();
        }
    });
    form = $("form[name='post_form']");
    targets = $("#post_form_targets").find("input[type='checkbox']");
    catSelector = $("#post_form_category");
    saveBtn = $("#post_form_save");
    savePublishBtn = $("#post_form_save_publish");
    saveBtn.attr("disabled", true);
    savePublishBtn.attr("disabled", true);
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
        url: '{{ path("zpb_admin_posts_img_upload") }}',
        errorMessage: errorMessageBandeau,
        loadDone: loadDoneBandeau,
        loadFail: loadFailBandeau
    });

    squarre.zpbUploadImage({
        url: '{{ path("zpb_admin_posts_img_upload") }}',
        errorMessage: errorMessageSquarre,
        loadDone: loadDoneSquarre,
        loadFail: loadFailSquarre
    });

    fb.zpbUploadImage({
        url: '{{ path("zpb_admin_posts_img_upload") }}',
        errorMessage: errorMessageFb,
        loadDone: loadDoneFb,
        loadFail: loadFailFb
    });

    imgUploaderBandeau = bandeau.data("zpbUploadImage");
    imgUploaderSquarre = squarre.data("zpbUploadImage");
    imgUploaderFb = fb.data("zpbUploadImage");

    function articleStateChange(){
        if(articleState.hasTitle === true && saveBtn.attr("disabled") == "disabled"){
            saveBtn.attr("disabled", false);
        }
        if(
            articleState.hasTitle === true
            && articleState.hasBody === true
            && articleState.hasTarget === true
            && articleState.hasCategory === true
            && articleState.hasExcerpt === true
            && savePublishBtn.attr("disabled") == "disabled"
        ){
            savePublishBtn.attr("disabled", false);
        }
    }
    $("#post_form_title").on("change", function(e){
        articleState.hasTitle = ($(this).val().length > 0);
        articleStateChange();
    });
    targets.on("change", function(e){
        e.preventDefault();
        if($(this).is(":checked")){
            articleState.hasTarget = true;
            articleState.checkNums++;
        } else {
            articleState.checkNums--;
            if(articleState.checkNums<0){
                articleState.checkNums = 0;
            }
            if(articleState.checkNums == 0){
                articleState.hasTarget = false;
            }
        }
        articleStateChange();
    });

    catSelector.on("change", function(e){
        var sel = $(this).find("option:selected");
        articleState.hasCategory = (sel.val() != "");
        articleStateChange();
    });

});
