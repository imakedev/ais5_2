$(document).ready(function(){



	var cal_slelect_b_hidden=$("#cal_slelect_b_hidden").val();
	var cal_slelect_e_hidden=$("#cal_slelect_e_hidden").val();
	var cal_h_hidden=$("#cal_h_hidden").val();
	$('select[name="cal_slelect_b"]').val(cal_slelect_b_hidden)
	$('select[name="cal_slelect_e"]').val(cal_slelect_e_hidden)
	$('select[name="cal_h"]').val(cal_h_hidden)
	$("#btnAddPoint").click(function(){
	
		$.ajax({
			url:"/Model/listPoint.php",
			type:"html",
			success:function(data){
				//alert(data);
				$("#pointListArea").html(data);
				
				
				$("#gridPointList").kendoGrid({
				       // height: 400,
						scrollable: false,
				      
				        sortable: true,
				        /*
				        pageable: {
				            refresh: true,
				            pageSizes: true,
				            buttonCount: 5
				        },
				        */
				 });
				 
			}
		});
	});
		
		
	//gridConstantList
	$("#btnConstant").click(function(){
		
		$.ajax({
			url:"Model/listConstant.php",
			type:"html",
			success:function(data){
				//alert(data);
				$("#constantListArea").html(data);
				
				
				$("#gridConstantList").kendoGrid({
				       // height: 400,
						scrollable: false,
				       // groupable: true,
				        sortable: true,
				      /*
				        pageable: {
				            refresh: true,
				            pageSizes: true,
				            buttonCount: 5
				        },
				        */
				 });
				 
			}
		});
		//listConstant.php
		
	});
});
function clearCalculation(){
	$("#cal_g").val('');
}
function addFormula(){
	var cal_select=$('input[name="cal"]:checked').val();
	//alert(cal_select)
	var old_cal_value=$("#cal_g").val();
	var select_value=$("#"+cal_select).val();
//	alert(select_value);
	$("#cal_g").val(old_cal_value+select_value);
}