$(function(){
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
    });




    var addTagBtn, tagsContainer, counter;
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
});











