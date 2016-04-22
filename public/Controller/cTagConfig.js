//$(document).ready(function(){
//	$("#gridTagConfigList").kendoGrid({
//       // height: 400,
//        sortable: true,
//       // groupable: true,
//        pageable: {
//            refresh: true,
//            pageSizes: true,
//            buttonCount: 5
//        },
//    });
//});

/* btn Add in TagConfig */
function addBtn(mmplant) {
    resetError();
    //alert(mmplant)
    $('#empNo').attr('readonly', false);
    $('#tagId').val('');
    $('#tagDescription').val('');
    $('#tagTitle').val('');
    //alert(parseInt('04'))
    var names=[];
    if(mmplant=='1'){
         names=['04','05','06','07'];
    }else if(mmplant=='2'){
        names=['08','09','10','11','12','13'];
    }else if(mmplant=='3'){
        names=['08','09','10','11','12','13'];
    }
    for(var i=0;i<names.length;i++){
        $('#tag'+parseInt(names[i])).val('');
        $('#mm'+names[i]+'L').val('');
        $('#mm'+names[i]+'P').val('');
        $('#mm'+names[i]+'M').val('');
        $('#mm'+names[i]+'B').val('');
        //$('#mm04L').val('');
    }
    /*
    $('#tag4').val('');
    $('#tag5').val('');
    $('#tag6').val('');
    $('#tag7').val('');


    $('#mm04L').val('');
    $('#mm04P').val('');
    $('#mm04M').val('');
    $('#mm04B').val('');

    $('#mm05L').val('');
    $('#mm05P').val('');
    $('#mm05M').val('');
    $('#mm05B').val('');

    $('#mm06L').val('');
    $('#mm06P').val('');
    $('#mm06M').val('');
    $('#mm06B').val('');

    $('#mm07L').val('');
    $('#mm07P').val('');
    $('#mm07M').val('');
    $('#mm07B').val('');
    */
    $('#header_label').html("Add New Tag Data");
    $("#modalAddEditTagMode").val('add');
    $('#modalAddEditTag').modal();
}

/* btn Add in TagConfig */
function editBtn(mmplant,index) {
    resetError();
    //alert(index);
    //alert(mmplant)
    var data = $('#gridTagListbody').children()[index].children;
    $('#tagId').val(data[1].childNodes[0].data);
    var obj={
        "key":data[1].childNodes[0].data
    };
   // alert(data[1].childNodes[0].data)
    $.ajax({
        url: "/ajax/mmtag/get",
        method: "POST",
        data: obj
    }).done(function(dataCallBack, status, xhr) {
        console.log(dataCallBack);
        var mmtagM = jQuery.parseJSON(dataCallBack.mmtagM);
        $('#tagDescription').val(mmtagM.B);
        if(mmplant=='1'){
            names=['04','05','06','07'];
        }else if(mmplant=='2'){
            names=['08','09','10','11','12','13'];
        }else if(mmplant=='3'){
            names=['08','09','10','11','12','13'];
        }

        for(var i=0;i<names.length;i++){
            var unit='C'+parseInt(names[i])
           // alert(mmtagM[unit])
            $('#tag'+parseInt(names[i])).val(mmtagM[unit]);
        }
        //$('#tagTitle').val(data[index++].childNodes[0].data);
        var signs=['L','P','M','B']
        var efgh_array = ['E','F','G','H'];
        for(var i=0;i<names.length;i++){
            for(var j=0;j<signs.length;j++){
                var efgh=efgh_array[j]+parseInt(names[i])
                $('#mm'+names[i]+signs[j]).val(mmtagM[efgh]);
            }

        }

        $('#header_label').html("Edit Tag Data");
        $("#modalAddEditTagMode").val('edit');
        $('#modalAddEditTag').modal();

    });
    /*
    $('#tagDescription').val(data[2].childNodes[0].data);
    var index=3;
    var names=[];

    for(var i=0;i<names.length;i++){
        $('#tag'+parseInt(names[i])).val(data[index++].childNodes[0].data);
    }

    $('#tagTitle').val(data[index++].childNodes[0].data);
    var signs=['L','P','M','B']
    for(var i=0;i<names.length;i++){
        for(var j=0;j<signs.length;j++){
            $('#mm'+names[i]+signs[j]).val(data[index++].childNodes[0].data);
        }

    }
     $('#modalAddEditTag').modal();
    */


}
/*
function deleteBtn() {
    var isValid = false;
    var length = document.getElementsByName('checkbox[]').length;
    for (var i = 0; i < length; i++) {
        var cbx = document.getElementsByName('checkbox[]')[i];
        if (cbx.checked) {
            isValid = true;
            break;
        }
    }

    if (isValid) {
        isValid = confirm_del();
    }

    return isValid;
}
*/
function deleteBtn() {
    var isValid = false;
    var length = document.getElementsByName('checkbox[]').length;
    for (var i = 0; i < length; i++) {
        var cbx = document.getElementsByName('checkbox[]')[i];
        if (cbx.checked) {
            isValid = true;
            break;
        }
    }

    if (isValid) {
        isValid = confirm_del();
    }
    if(isValid)
        document.getElementById("formDelete").submit();
   // return isValid;
}

//$("#checkAll").change(function () {
//    $("input:checkbox").prop('checked', $(this).prop("checked"));
//});

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#checkAll').click(function (event) {
        if(this.checked){
            $('.ck').each(function(){
                this.checked = true;
            });
        }else{
            $('.ck').each(function(){
                this.checked = false;
            });
        }
    });
    var sortBy_hidden=$("#sortBy_hidden").val();
    var orderBy_hidden=$("#orderBy_hidden").val();
    $('select[name="sortBy"]').val(sortBy_hidden)
    $('select[name="orderBy"]').val(orderBy_hidden);
});

function validateForm() {
    var isValid = true;
    if ($('#empNo').val() == '') {
        isValid = false;
    }
}
function resetError(){
    $('#tagDescription').removeClass("have_error");
    $('input[name^="tag"]').removeClass("have_error");
    $('input[name^="mm"]').removeClass("have_error");
}
function renderError(error_init){
    for(var i=0;i<error_init.length;i++){
        var key=error_init[i]["key"];
        if(key.indexOf('mm')!=-1){
            $('input[name^="'+key+'"]').addClass("have_error");
        }else
            $("#"+error_init[i]["key"]).addClass("have_error");
    }
}
function validateTag(){
    resetError();
    //alert('validateTag')
    var tagDescription=jQuery.trim($("#tagDescription").val());
    var mode=$("#modalAddEditTagMode").val();
    var tagId=$("#tagId").val();
    var modalAddEditTag_user_mmplant=$("#modalAddEditTag_user_mmplant").val();
    //alert("modalAddEditTag_user_mmplant"+modalAddEditTag_user_mmplant)
    if(tagDescription.length==0){
        alert("กรุณากรอก Description");
        //$("#tagDescription").focus();
        $('#tagDescription').addClass("have_error");
        return false;
    }else{
        // validate TagName
        var obj={
            "mode":mode,
            "type":'tagname',
            "tagname":tagDescription, // 'H2 gas pressure'
            "A":tagId // 'H2 gas pressure'
        };
        $.ajax({
            url: "/ajax/mmtag/validate",
            method: "POST",
            data: obj
        }).done(function(dataCallBack, status, xhr) {
            console.log(dataCallBack);
            var count = jQuery.parseJSON(dataCallBack.count);
            var error_init = jQuery.parseJSON(dataCallBack.error_init);
            if(count>0){
                alert("Description ซ้ำ. กรุณาระบุใหม่ ");
                //$("#tagDescription").focus();
                renderError(error_init);

                return false;
            }else{
                if(modalAddEditTag_user_mmplant=='1'){
                    names=['04','05','06','07'];
                }else if(modalAddEditTag_user_mmplant=='2'){
                    names=['08','09','10','11','12','13'];
                }else if(modalAddEditTag_user_mmplant=='3'){
                    names=['08','09','10','11','12','13'];
                }
                var signs=['L','P','M','B']
                var efgh_array = ['E','F','G','H'];
                var values_array=[];
                // tag4 , mm04L , mm04P , mm04M , mm04B
               // values_array.push("")
                for(var i=0;i<names.length;i++){
                    var values_inner_array=[];
                    for(var j=0;j<signs.length;j++){
                        //var efgh=efgh_array[j]+parseInt(names[i])
                       // $('#mm'+names[i]+signs[j]).val(mmtagM[efgh]);
                        //alert($('#mm'+names[i]+signs[j]).val());
                        var mmValue=jQuery.trim($('#mm'+names[i]+signs[j]).val());
                        if(mmValue.length==0)
                            mmValue="0";
                        values_inner_array.push(mmValue);
                    }
                    var tagValue=jQuery.trim($("#tag"+parseInt(names[i])).val());
                    if(tagValue.length>0) {
                        var values = {
                            name: parseInt(names[i]),
                            value:tagValue,
                            key: values_inner_array
                        }
                        values_array.push(values)
                    }
                }
                 obj={
                    "mode":mode,
                    "type":'LPMB',
                    "tagname":tagDescription, // 'H2 gas pressure'
                    "A":tagId, // 'H2 gas pressure'
                     "modalAddEditTag_user_mmplant":modalAddEditTag_user_mmplant,
                     "values":values_array
                };
                $.ajax({
                    url: "/ajax/mmtag/validate",
                    method: "POST",
                    data: obj
                }).done(function(dataCallBack2, status, xhr) {
                    console.log(dataCallBack2);
                    var count2 = jQuery.parseJSON(dataCallBack2.count);
                    var error_init2 = jQuery.parseJSON(dataCallBack2.error_init);
                    if(count2>0){
                        alert("Tag Name หรือ LPMB ซ้ำ. กรุณาระบุใหม่ ");
                        //$("#tagDescription").focus();
                        renderError(error_init2);
                        return false;
                    }else{
                        var tagForm = document.getElementById("tagForm");
                        //alert(tagForm)
                        tagForm.submit();
                    }

                });

            }

        });
    }

    /*
    var tagForm = document.getElementById("tagForm");
    //alert(tagForm)
    tagForm.submit();
    */
}