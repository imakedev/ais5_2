//$(document).ready(function(){
//	$("#gridUserList").kendoGrid({
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

/* btn Add in addUser */
function addBtn() {
    $('#empNo').attr('readonly', false);
    $('#empNo').val('');
    $('#empTitle').val('');
    $('#empFirstName').val('');
    $('#empLastName').val('');
    $('#empPriority').val('');
    $('#empId').val('');
    $('#modalAddEditUser').modal();
}

/* btn Add in addUser */
function editBtn(index) {
   // alert(index);
    var data = $('#gridUserListBody').children()[index].children;
    $('#empNo').attr('readonly', true);
    $('#empNo').val(data[1].childNodes[0].data);
    $('#empTitle').val(data[2].childNodes[0].data);
    var firstName = data[3].childNodes[0].data.split("   ")[0];
    var lastName = data[3].childNodes[0].data.split("   ")[1];
    $('#empFirstName').val(firstName);
    $('#empLastName').val(lastName);
    $('#empPriority').val(data[4].childNodes[0].data);
    $('#empId').val(data[0].children[1].value);
    $('#modalAddEditUser').modal();
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
function doDelete(urlDel){
    var isValid =confirm_del();
    if(isValid)
        window.location.href =urlDel//Will take you to Google.
    else
      return isValid;
}
function doDeleteUser(){
    var ids=[];
    var id="";
    var mode = $("#mmtrend_group_mode").val();
    if(mode=='deleteAll') {

        var length = document.getElementsByName('checkbox[]').length;
        for (var i = 0; i < length; i++) {
            var cbx = document.getElementsByName('checkbox[]')[i];
            if (cbx.checked) {
                ids.push(cbx.value)
            }
        }
        if (ids.length == 0) {
            $("#myModalDelete").modal('hide')
            return false;
        }
    }else{
        id=$("#mmtrend_group_b").val();
    }
    var obj={
        "mode":mode,
        "ZZ":id,
        "ids":ids
    }

    $.ajax({
        url: "/ajax/mmname/delete",
        method: "DELETE",
        data: obj
    }).done(function(data, status, xhr) {
        location.reload()
        $("#myModalDelete").modal('hide')
    });
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