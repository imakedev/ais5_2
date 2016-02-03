$(document).ready(function(){
    /*
	$("#gridCalList").kendoGrid({
       // height: 400,
		scrollable: false,
        sortable: true,
       // groupable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
    });
    */
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
	var calculationSelectionHidden=$("#calculationSelectionHidden").val();

	$('select[name="calculationSelection"]').val(calculationSelectionHidden);
	var sortBy_hidden=$("#sortBy_hidden").val();
	var orderBy_hidden=$("#orderBy_hidden").val();
	//var design_trend_B_hidden=$("#design_trend_B_hidden").val();
	$('select[name="sortBy"]').val(sortBy_hidden)
	$('select[name="orderBy"]').val(orderBy_hidden)
	//$('select[name="design_trend_B"]').val(design_trend_B_hidden)
});
function doDelete(urlDel){
	var isValid =confirm_del();
	if(isValid)
		window.location.href =urlDel//Will take you to Google.
	else
		return isValid;
}
function deleteBtn() {
	var isValid = false;
	var str="";
	var length = document.getElementsByName('checkbox[]').length;
	for (var i = 0; i < length; i++) {
		var cbx = document.getElementsByName('checkbox[]')[i];
		if (cbx.checked) {
			isValid = true;
			//break;
			str=str+cbx.value+"_";
		}
	}

	if (isValid) {
		isValid = confirm_del();
	}

	if(isValid){
		$('input[name="checkboxs_hidden"]').val(str);
		document.getElementById("deleteSlectForm").submit();
	}

	return isValid;
}
