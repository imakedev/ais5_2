//$(document).ready(function(){
//
//	$("#gridPointConfigList").kendoGrid({
//       // height: 400,
//        sortable: true,
//       // groupable: true,
//        sortable: true,
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
    $('#avgVal').val(data[8].childNodes[0].data);
    var val = document.getElementById("avgVal").value
        if(val == 'Yes') {
            document.getElementById("avg").checked = true;
        }else{
            document.getElementById("avg").checked = false;
        }

    $('#poiId').val(data[1].childNodes[0].data);
    $('#poiAtom').val(data[7].childNodes[0].data);
    $('#poiUnit').val(data[9].childNodes[0].data);
    $('#poiMax').val(data[10].childNodes[0].data);
    $('#poiMin').val(data[11].childNodes[0].data);
    $('#modalPointConFig').modal();
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

    return isValid;
}

//$("#checkAll").change(function () {
//    $("input:checkbox").prop('checked', $(this).prop("checked"));
//});

$(document).ready(function(){
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
});

function validateForm() {
    var isValid = true;
    if ($('#empNo').val() == '') {
        isValid = false;
    }
}