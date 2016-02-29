//$(document).ready(function(){
//
//	$("#gridPointConfigList").kendoGrid({
//       // height: 400,
//        sortable: true,
//       // groupable: true,
//        pageable: {
//            refresh: true,
//            pageSizes: true,
//            buttonCount: 5
//        }
//    });
//});

/* btn Add in pointConfig */
function addBtn() {
    $('#poiId').val('');
    $('#poiAtom').val('');
    $('#poiUnit').val('');
    $('#poiMax').val('');
    $('#poiMin').val('');
    $('#modalPointConFig').modal();
}

/* btn Add in pointConfig */
function editBtn(index) {
    var data = $('#gridPointListbody').children()[index].children;
    var obj={
        "key":data[1].childNodes[0].data
    };
    $.ajax({
        url: "/ajax/mmpoint/get",
        method: "POST",
        data: obj
    }).done(function(dataCallBack, status, xhr) {
        console.log(dataCallBack);
        var mmpointM = jQuery.parseJSON(dataCallBack.mmpointM);
        $('#avgVal').val(mmpointM.E);
        var val = document.getElementById("avgVal").value
        if (val == 'Yes') {
            document.getElementById("avg").checked = true;
        } else {
            document.getElementById("avg").checked = false;
        }
        $('#poiId').val(data[1].childNodes[0].data)
        if (mmpointM.F!=null) {
            $('#poiUnit').val(mmpointM.F);
        }

        if (mmpointM.G0!=null) {
            $('#poiMax').val(mmpointM.G0);
        }

        if (mmpointM.G1!=null) {
            $('#poiMin').val(mmpointM.G1);
        }
        $.ajax({
            url: "/ajax/mmtag/get",
            method: "POST",
            data: obj
        }).done(function(dataCallBack2, status, xhr) {
            console.log(dataCallBack2);
            var mmtagM = jQuery.parseJSON(dataCallBack2.mmtagM);
            var strSelect="<select id=\"poiAtom\" name=\"poiAtom\" class=\"form-control \">";

            if(mmtagM!=null){
                if(mmtagM.D=='ANALOG'){
                    strSelect=strSelect+"<option value=\"Value\">Value</option>";
                    strSelect=strSelect+"<option value=\"Alarm\">Alarm</option>";
                }else if(mmtagM.D=='DIGITAL'){
                    strSelect=strSelect+"<option value=\"Status\">Status</option>";
                }else{
                    strSelect=strSelect+"<option value=\"Value\">Value</option>";
                    strSelect=strSelect+"<option value=\"Alarm\">Alarm</option>";
                }
            }else{
                strSelect=strSelect+"<option value=\"Value\">Value</option>";
                strSelect=strSelect+"<option value=\"Alarm\">Alarm</option>";
            }
            strSelect=strSelect+"</select>";
            $("#poiAtomSelect").html(strSelect);
            //alert(mmtagM.D)
            //  $("#poiAtom").val();
            if (mmpointM.D!=null) {
                $('#poiAtom').val(mmpointM.D);
            }
            $('#modalPointConFig').modal();
        });

    });


   // alert(data[8].childNodes.length)
    /*
    if (data[8].childNodes.length > 0) {
        $('#avgVal').val(data[8].childNodes[0].data);
        var val = document.getElementById("avgVal").value
        if (val == 'Yes') {
            document.getElementById("avg").checked = true;
        } else {
            document.getElementById("avg").checked = false;
        }
    }
    if (data[1].childNodes.length > 0) {
        $('#poiId').val(data[1].childNodes[0].data);
    }


    if (data[9].childNodes.length > 0) {
        $('#poiUnit').val(data[9].childNodes[0].data);
    }

    if (data[10].childNodes.length > 0) {
        $('#poiMax').val(data[10].childNodes[0].data);
    }

    if (data[11].childNodes.length > 0) {
        $('#poiMin').val(data[11].childNodes[0].data);
    }
    */
   // alert($('#poiId').val())
    /*
    var obj={
        "key":$('#poiId').val()
    };
    */


}

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
    //return isValid;
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