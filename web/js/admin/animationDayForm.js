$(function(){

    $("#animation_day_form_color").colorpicker(
        {
            parts: 'inline',
            showOn: 'both',
            showNoneButton: true,
            buttonColorize: true,
            buttonImage: '/js/vendor/colorpicker/images/ui-colorpicker.png',
            regional: 'fr',
            colorFormat: 'HEX',
            color:'#4DB6AC'}
    );

    var counter, protoHolder, proto, addAnim, horaires;
    counter = 0;
    protoHolder = $("#animation_day_form_schedules");
    proto = protoHolder.data("prototype");
    addAnim = $("#addAnim");
    horaires = $("#horaires");

    function buildSelectAnimation(idx){
        var name = "animation_day_form[schedules]["+idx+"][animation]";
        var id = "animation_day_form_schedules_"+idx+"_animation";
        var select = $(proto).find("select:last");
        select.attr("name", name).attr("id", id);
        return select;
    }

    function buildSelectHour(idx){
        var name = "animation_day_form[schedules]["+idx+"][timetable][hour]";
        var select = $("<select name='"+name+"'></select>");
        for(var i=8; i<21; i++){
            var text = (i<10) ? "0" + i : i + "";
            var option = $("<option value='"+i+"'>"+text+"</option>");
            select.append(option);
        }
        return select;
    }

    function buildSelectMin(idx){
        var name = "animation_day_form[schedules]["+idx+"][timetable][minute]";
        var select = $("<select name='"+name+"' required='required'></select>");
        var multiple = 15;
        var cycles = 60 / multiple;
        for(var i=0; i<cycles; i++){
            var text = ((i*multiple)<10) ? "0" + (i*multiple) : (i*multiple) + "";
            var option = $("<option value='"+(i*multiple)+"'>"+text+"</option>");
            select.append(option);
        }
        return select;
    }

    function buildAnimRow(){
        var idx;

        idx = counter++;

        var min = buildSelectMin(idx);
        var hou = buildSelectHour(idx);
        var ani = buildSelectAnimation(idx);
        var deleteBtn = $("<a href='' class='btn btn-flat delete-horaire'><i class='fa fa-trash-o'></i></a>");
        var row = $("<div class='form-row'></div>");
        var rowInner = $("<div class='form-field-inline'></div>");
        horaires.append(row.append(rowInner.append(hou,min, ani).append(deleteBtn)));
    }

    addAnim.on("click", function(e){
        e.preventDefault();
        buildAnimRow();
    });

    $("body").on("click", "a.delete-horaire", function(e){
        e.preventDefault();
        $(this).parent().parent().remove();
    });



});
