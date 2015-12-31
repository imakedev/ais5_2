//$(document).ready(function(){
//	$("#gridTagConfigList").kendoGrid({
//       // height: 400,
//        sortable: true,
//       // groupable: true,
//        sortable: true,
//        pageable: {
//            refresh: true,
//            pageSizes: true,
//            buttonCount: 5
//        },
//    });
//});

/* btn Add in TagConfig */
function addBtn() {
    $('#empNo').attr('readonly', false);
    $('#tagId').val('');
    $('#tagDescription').val('');
    $('#tag4').val('');
    $('#tag5').val('');
    $('#tag6').val('');
    $('#tag7').val('');
    $('#tagTitle').val('');

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

    $('#modalAddEditTag').modal();
}

/* btn Add in TagConfig */
function editBtn(index) {
    //alert(index);
    var data = $('#gridTagListbody').children()[index].children;
    $('#tagId').val(data[1].childNodes[0].data);
    $('#tagDescription').val(data[2].childNodes[0].data);
    $('#tag4').val(data[3].childNodes[0].data);
    $('#tag5').val(data[4].childNodes[0].data);
    $('#tag6').val(data[5].childNodes[0].data);
    $('#tag7').val(data[6].childNodes[0].data);
    $('#tagTitle').val(data[7].childNodes[0].data);

    $('#mm04L').val(data[8].childNodes[0].data);
    $('#mm04P').val(data[9].childNodes[0].data);
    $('#mm04M').val(data[10].childNodes[0].data);
    $('#mm04B').val(data[11].childNodes[0].data);

    $('#mm05L').val(data[12].childNodes[0].data);
    $('#mm05P').val(data[13].childNodes[0].data);
    $('#mm05M').val(data[14].childNodes[0].data);
    $('#mm05B').val(data[15].childNodes[0].data);

    $('#mm06L').val(data[16].childNodes[0].data);
    $('#mm06P').val(data[17].childNodes[0].data);
    $('#mm06M').val(data[18].childNodes[0].data);
    $('#mm06B').val(data[19].childNodes[0].data);

    $('#mm07L').val(data[20].childNodes[0].data);
    $('#mm07P').val(data[21].childNodes[0].data);
    $('#mm07M').val(data[22].childNodes[0].data);
    $('#mm07B').val(data[23].childNodes[0].data);

    $('#modalAddEditTag').modal();
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