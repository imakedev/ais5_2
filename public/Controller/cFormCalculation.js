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
function submitCalculation(){
	$("#cal_g_hidden").val($("#cal_g").val());
	document.getElementById('calculationForm').submit()

}
function searchMmpoint(mmtrend_table_B_selected){
	//alert(mmtrend_table_B_selected)
	var keyword=$("#keyword").val();
	var mode=$("#mmtrend_mode").val();
	var mmtrend_point_zz=$("#mmtrend_point_zz").val();
	var mmtrend_point_h= $("#mmtrend_point_h").val();
	var mmtrend_table_B= $("#mmtrend_table_B").val();
	/*if(mmtrend_table_B_selected=='')
	 mmtrend_table_B_selected= $('select[id="mmtrend_table_B"]').val();
	 */
	//alert(mode+","+mmtrend_point_h+","+mmtrend_table_B+","+mmtrend_table_B_selected);
	var obj={
		"keyword":keyword,
		"H":mmtrend_point_h,
		"P":mmtrend_table_B
	}
	//alert(id)
	var str=""+
		" <table id=\"editable\" "+
		" class=\"table table-striped table-bordered table-hover  dataTable\" "+
		" role=\"grid\" aria-describedby=\"editable_info\"> "+
		"   <thead> "+
		"   <tr role=\"row\"> "+
		"   <th class=\"\" tabindex=\"0\" aria-controls=\"\" "+
		" rowspan=\"1\" colspan=\"1\" style=\"width: 0%;\" "+
		" aria-sort=\"\" aria-label=\"\"> "+
		"  "+
		"   </th> "+
		"   <th class=\"\" tabindex=\"0\" "+
		" aria-controls=\"editable\" rowspan=\"1\" "+
		" colspan=\"1\" style=\"width: 20%;\" "+
		" aria-label=\"Browser: activate to sort column ascending\"> "+
		"   Point Name "+
		" </th> "+
		" <th class=\"\" tabindex=\"0\" "+
		" aria-controls=\"editable\" rowspan=\"1\" "+
		" colspan=\"1\" style=\"width: 13%;\" "+
		" aria-label=\"Platform(s): activate to sort column ascending\"> "+
		"   Tag4 "+
		"   </th> "+
		"   <th class=\"\" tabindex=\"0\"  "+
		" aria-controls=\"editable\" rowspan=\"1\" "+
		" colspan=\"1\" style=\"width: 13%;\" "+
		" aria-label=\"Platform(s): activate to sort column ascending\"> "+
		"   Tag5 "+
		"   </th> "+
		"   <th class=\"\" tabindex=\"0\" "+
		" aria-controls=\"editable\" rowspan=\"1\" "+
		" colspan=\"1\" style=\"width: 13%;\" "+
		" aria-label=\"Platform(s): activate to sort column ascending\"> "+
		"   Tag6 "+
		"   </th> "+
		"   <th class=\"\" tabindex=\"0\" "+
		" aria-controls=\"editable\" rowspan=\"1\" "+
		" colspan=\"1\" style=\"width: 13%;\" "+
		" aria-label=\"Platform(s): activate to sort column ascending\"> "+
		"   Tag7 "+
		"   </th> "+
		"   <th class=\"\" tabindex=\"0\" "+
		" aria-controls=\"editable\" rowspan=\"1\" "+
		" colspan=\"1\" style=\"width: 5%;\" "+
		" aria-label=\"Platform(s): activate to sort column ascending\"> "+
		"   Unit "+
		"   </th> "+
		"   <th class=\"\" tabindex=\"0\" "+
		" aria-controls=\"editable\" rowspan=\"1\" "+
		" colspan=\"1\" style=\"width: 5%;\" "+
		" aria-label=\"Platform(s): activate to sort column ascending\"> "+
		"   Max "+
		"   </th> "+
		"   <th class=\"\" tabindex=\"0\" "+
		" aria-controls=\"editable\" rowspan=\"1\" "+
		" colspan=\"1\" style=\"width: 5%;\" "+
		" aria-label=\"Platform(s): activate to sort column ascending\"> "+
		"   Min "+
		"   </th> "+
			/*
			 "   <th class=\"\" tabindex=\"0\" "+
			 " aria-controls=\"editable\" rowspan=\"1\" "+
			 " colspan=\"1\" style=\"width: 5%;\" "+
			 " aria-label=\"Platform(s): activate to sort column ascending\"> "+
			 "   Data "+
			 "   </th> "+
			 */
		"   </tr> "+
		"   </thead> "+
		"   <tbody> ";
	if(mmtrend_table_B=='0' || mmtrend_table_B=='-1') {
		str = "" +
			" <table id=\"editable\" " +
			" class=\"table table-striped table-bordered table-hover  dataTable\" " +
			" role=\"grid\" aria-describedby=\"editable_info\"> " +
			"   <thead> " +
			"   <tr role=\"row\"> " +
			"   <th class=\"\" tabindex=\"0\" aria-controls=\"\" " +
			" rowspan=\"1\" colspan=\"1\" style=\"width: 0%;\" " +
			" aria-sort=\"\" aria-label=\"\"> " +
			"  " +
			"   </th> " +
			"   <th class=\"\" tabindex=\"0\" " +
			" aria-controls=\"editable\" rowspan=\"1\" " +
			" colspan=\"1\" style=\"width: 20%;\" " +
			" aria-label=\"Browser: activate to sort column ascending\"> " +
			"   Point Name " +
			" </th> " +
			" <th class=\"\" tabindex=\"0\" " +
			" aria-controls=\"editable\" rowspan=\"1\" " +
			" colspan=\"1\" style=\"width: 13%;\" " +
			" aria-label=\"Platform(s): activate to sort column ascending\"> " +
			"   Tag name " +
			"   </th> " +
			"   <th class=\"\" tabindex=\"0\"  " +
			" aria-controls=\"editable\" rowspan=\"1\" " +
			" colspan=\"1\" style=\"width: 13%;\" " +
			" aria-label=\"Platform(s): activate to sort column ascending\"> " +
			"   MM " +
			"   </th> " +
			"   <th class=\"\" tabindex=\"0\" " +
			" aria-controls=\"editable\" rowspan=\"1\" " +
			" colspan=\"1\" style=\"width: 13%;\" " +
			" aria-label=\"Platform(s): activate to sort column ascending\"> " +
			"   Formula " +
			"   </th> " +

			"   <th class=\"\" tabindex=\"0\" " +
			" aria-controls=\"editable\" rowspan=\"1\" " +
			" colspan=\"1\" style=\"width: 5%;\" " +
			" aria-label=\"Platform(s): activate to sort column ascending\"> " +
			"   Unit " +
			"   </th> " +
			"   <th class=\"\" tabindex=\"0\" " +
			" aria-controls=\"editable\" rowspan=\"1\" " +
			" colspan=\"1\" style=\"width: 5%;\" " +
			" aria-label=\"Platform(s): activate to sort column ascending\"> " +
			"   Max " +
			"   </th> " +
			"   <th class=\"\" tabindex=\"0\" " +
			" aria-controls=\"editable\" rowspan=\"1\" " +
			" colspan=\"1\" style=\"width: 5%;\" " +
			" aria-label=\"Platform(s): activate to sort column ascending\"> " +
			"   Min " +
			"   </th> " +
				/*
				 "   <th class=\"\" tabindex=\"0\" "+
				 " aria-controls=\"editable\" rowspan=\"1\" "+
				 " colspan=\"1\" style=\"width: 5%;\" "+
				 " aria-label=\"Platform(s): activate to sort column ascending\"> "+
				 "   Data "+
				 "   </th> "+
				 */
			"   </tr> " +
			"   </thead> " +
			"   <tbody> ";
	}
	$.ajax({
		url: "/ajax/mmpoint/search",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		console.log(data);
		if(mmtrend_table_B=='0' || mmtrend_table_B=='-1'){
			var mmpointM = jQuery.parseJSON(data.mmpointM);
			// alert(mmpointM.length)
			if(mmpointM!=null && mmpointM.length>0) {
				for (var i = 0; i < mmpointM.length; i++) {
					str = str +
						" <tr class=\"gradeA odd\" role=\"row\"> "+
						"  <td class=\"sorting_1\"> ";
					var checked_str="";
					if(mmpointM[i].A==mmtrend_point_h){
						checked_str="checked";
					}
					str = str +
						"  <input type=\"radio\" name=\"point_ids_input[]\" "+checked_str+" value=\""+mmpointM[i].A+"\"> "+
							//  " class=\"i-checks\"> "+
						"     </td> "+
						"    <td>"+mmpointM[i].C+"</td> "+
						"    <td>"+mmpointM[i].D+"</td> "+
						" <td>"+mmpointM[i].B+"</td> "+
						" <td>"+mmpointM[i].G+"</td> "+
						" <td>"+mmpointM[i].E+"</td> "+
						" <td>"+mmpointM[i].F0+"</td> "+
						" <td>"+mmpointM[i].F1+"</td> "+

							// " <td>435</td> "+
						"  </tr> ";
				}
			}
		}else{
			var mmpointM = jQuery.parseJSON(data.mmpointM);
			// alert(mmpointM.length)
			if(mmpointM!=null && mmpointM.length>0) {
				for (var i = 0; i < mmpointM.length; i++) {
					str = str +
						" <tr class=\"gradeA odd\" role=\"row\"> "+
						"  <td class=\"sorting_1\"> ";
					var checked_str="";
					if(mmpointM[i].A==mmtrend_point_h){
						checked_str="checked";
					}
					str = str +
						"  <input type=\"radio\" name=\"point_ids_input[]\" "+checked_str+" value=\""+mmpointM[i].A+"\"> "+
							//  " class=\"i-checks\"> "+
						"     </td> "+
						"    <td>"+mmpointM[i].B+"</td> "+
						"    <td>"+mmpointM[i].C4+"</td> "+
						" <td>"+mmpointM[i].C5+"</td> "+
						" <td>"+mmpointM[i].C6+"</td> "+
						" <td>"+mmpointM[i].C7+"</td> "+
						" <td>"+mmpointM[i].F+"</td> "+
						" <td>"+mmpointM[i].G0+"</td> "+
						" <td>"+mmpointM[i].G1+"</td> "+
							// " <td>435</td> "+
						"  </tr> ";
				}
			}
		}

		str=str+" </tbody> "+
			" </table> ";

		$("#point_list_section").html(str);
	});

}