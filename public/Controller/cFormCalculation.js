$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var cal_slelect_b_hidden=$("#cal_slelect_b_hidden").val();
	var cal_slelect_e_hidden=$("#cal_slelect_e_hidden").val();
	var cal_h_hidden=$("#cal_h_hidden").val();
	$('select[name="cal_slelect_b"]').val(cal_slelect_b_hidden)
	$('select[name="cal_slelect_e"]').val(cal_slelect_e_hidden)
	$('select[name="cal_h"]').val(cal_h_hidden)


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
function doAddMmpoint(){
	var mmtrend_table_B= $("#mmtrend_table_B").val();
	var point_ids_input=$('input[name="point_ids_input[]"]:checked').val();
	//alert(point_ids_input+","+mmtrend_table_B)
	var obj={
		"key":point_ids_input,
		//"H":mmtrend_point_h,
		"type":mmtrend_table_B
	}
	$.ajax({
		url: "/ajax/addmmpoint/doAdd",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		console.log(data);
		var formula = jQuery.parseJSON(data.formula);
		var formula_result='';
		if(mmtrend_table_B=='0' || mmtrend_table_B=='-1'|| mmtrend_table_B=='1'){
			formula_result=formula.G;
		}else{
			formula_result="U0"+obj.type+"D"+obj.key;
		}
		var cal_g_old=$("#cal_g").val();
		//alert(cal_g_old)
		$("#cal_g").val(cal_g_old+" "+formula_result);
		$("#modalAddPoint").modal('hide')
		//alert(formula_result)
		//$("#point_list_section").html(str);
	});
}
function changeRate(){
	var cal_g_old=$("#cal_g").val();
	$("#cal_g").val("ChangeRate@"+cal_g_old);
}
function showAddConstant(){

	var obj= {
		"constantType": "0"
	}
	$.ajax({
		url: "/ajax/constant/search",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		console.log(data);
		var constantM = jQuery.parseJSON(data.constantM);
		var str=""+
			" <table id=\"editable\" "+
			" class=\"table table-striped table-bordered table-hover  dataTable\" "+
			" role=\"grid\" aria-describedby=\"editable_info\"> "+
			"   <thead> "+
			"   <th class=\"\" tabindex=\"0\" "+
			" aria-controls=\"editable\" rowspan=\"1\" "+
			" colspan=\"1\" style=\"width: 40%;\" "+
			" aria-label=\"Browser: activate to sort column ascending\"> "+
			"   Constant Name "+
			" </th> "+
			" <th class=\"\" tabindex=\"0\" "+
			" aria-controls=\"editable\" rowspan=\"1\" "+
			" colspan=\"1\" style=\"width: 20%;\" "+
			" aria-label=\"Platform(s): activate to sort column ascending\"> "+
			"   Type "+
			"   </th> "+
			"   <th class=\"\" tabindex=\"0\"  "+
			" aria-controls=\"editable\" rowspan=\"1\" "+
			" colspan=\"1\" style=\"width: 15%;\" "+
			" aria-label=\"Platform(s): activate to sort column ascending\"> "+
			"   Value "+
			"   </th> "+
			"   <th class=\"\" tabindex=\"0\" "+
			" aria-controls=\"editable\" rowspan=\"1\" "+
			" colspan=\"1\" style=\"width: 25%;\" "+
			" aria-label=\"Platform(s): activate to sort column ascending\"> "+
			"    "+
			"   </th> "+
			"   </tr> "+
			"   </thead> "+
			"   <tbody> ";
		var empId=$("#empId").val();
		if(constantM!=null && constantM.length>0) {
			for (var i = 0; i < constantM.length; i++) {
				str = str +
					"    <td>"+constantM[i].A+"</td> "+
					"    <td>";
						if(empId==constantM[i].C){
							str = str +"My Constant";
						}else{
							str = str +"Standard Consant";
						}
				str=str+" </td> ";
				str = str +"    <td>"+constantM[i].B+"</td> "+
					" <td>" +
					"<a onclick=\"selectConstant('"+constantM[i].ZZ+"')\" "+
					" class=\"btn btn-primary  btn-xs\">Select</a> | "+
					"<a id=\"btnEdit\" onclick=\"addOrEditConstant('"+constantM[i].ZZ+"')\" " +
					" class=\"btn btn-dropbox btn-xs\"><i style=\"color: #47a447;\" class=\"glyphicon glyphicon-edit\"></i>" +
					"</a>| "+
					"<a onclick=\"doDeleteConstant('"+constantM[i].ZZ+"')\"  " +
					"class=\"btn btn-dropbox btn-xs\"><i class=\"glyphicon glyphicon-trash text-danger\"></i></a>" +
					"</td> "+
					"  </tr> ";
			}
		}
		str=str+" </tbody> "+
			" </table> ";

		$("#constantListArea").html(str);
		$("#add_edit_constant").hide();
		$("#modalConstant").modal();
	});

}
function searchConstant(){
	var constantType= $("#constantType").val();
	var obj={
		"constantType":constantType
	}
	var empLevel=parseInt($("#empLevel").val());
	//alert(constantType)
	$.ajax({
		url: "/ajax/constant/search",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		console.log(data);
		var constantM = jQuery.parseJSON(data.constantM);
		var str=""+
			" <table id=\"editable\" "+
			" class=\"table table-striped table-bordered table-hover  dataTable\" "+
			" role=\"grid\" aria-describedby=\"editable_info\"> "+
			"   <thead> "+
			"   <th class=\"\" tabindex=\"0\" "+
			" aria-controls=\"editable\" rowspan=\"1\" "+
			" colspan=\"1\" style=\"width: 40%;\" "+
			" aria-label=\"Browser: activate to sort column ascending\"> "+
			"   Constant Name "+
			" </th> "+
			" <th class=\"\" tabindex=\"0\" "+
			" aria-controls=\"editable\" rowspan=\"1\" "+
			" colspan=\"1\" style=\"width: 20%;\" "+
			" aria-label=\"Platform(s): activate to sort column ascending\"> "+
			"   Type "+
			"   </th> "+
			"   <th class=\"\" tabindex=\"0\"  "+
			" aria-controls=\"editable\" rowspan=\"1\" "+
			" colspan=\"1\" style=\"width: 15%;\" "+
			" aria-label=\"Platform(s): activate to sort column ascending\"> "+
			"   Value "+
			"   </th> "+
			"   <th class=\"\" tabindex=\"0\" "+
			" aria-controls=\"editable\" rowspan=\"1\" "+
			" colspan=\"1\" style=\"width: 25%;\" "+
			" aria-label=\"Platform(s): activate to sort column ascending\"> "+
			"    "+
			"   </th> "+
			"   </tr> "+
			"   </thead> "+
			"   <tbody> ";
		var empId=$("#empId").val();
		if(constantM!=null && constantM.length>0) {
			for (var i = 0; i < constantM.length; i++) {
				str = str +
					"    <td>"+constantM[i].A+"</td> "+
					"    <td>";
				if(empId==constantM[i].C){
					str = str +"My Constant";
				}else{
					str = str +"Standard Consant";
				}
				str=str+" </td> ";
				str = str +"    <td>"+constantM[i].B+"</td> "+
					" <td>" +
					"<a onclick=\"selectConstant('"+constantM[i].ZZ+"')\" "+
			" class=\"btn btn-primary  btn-xs\">Select</a> ";
				if(empLevel>=254 || empId==constantM[i].C){
					str=str+"| <a id=\"btnEdit\" onclick=\"addOrEditConstant('"+constantM[i].ZZ+"')\" " +
					" class=\"btn btn-dropbox btn-xs\"><i style=\"color: #47a447;\" class=\"glyphicon glyphicon-edit\"></i>" +
					"</a>| "+
					"<a onclick=\"doDeleteConstant('"+constantM[i].ZZ+"')\"  " +
					"class=\"btn btn-dropbox btn-xs\"><i class=\"glyphicon glyphicon-trash text-danger\"></i></a>" +
					"</td> ";
				}

				str = str +"  </tr> ";
			}
		}
		str=str+" </tbody> "+
			" </table> ";

		$("#constantListArea").html(str);
		$("#add_edit_constant").hide();
	});
}
function selectConstant(kk_id){

	var obj={
		"kk_id":kk_id,
	}
	$.ajax({
		url: "/ajax/constant/get",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		console.log(data);
		var constantM = jQuery.parseJSON(data.constantM);
		var old_cal_value=$("#cal_g").val();
		$("#cal_g").val(old_cal_value+" CONSTANT@"+constantM.A);
		$("#modalConstant").modal('hide');
	});
}
function addOrEditConstant(kk_id){
	$("#A_value").val("");
	$("#B_value").val("");
	$("#ZZ_value").val("");
	if(kk_id!=''){
		var obj={
			"kk_id":kk_id,
		}
		$.ajax({
			url: "/ajax/constant/get",
			method: "POST",
			data: obj
		}).done(function(data, status, xhr) {
			console.log(data);
			var constantM = jQuery.parseJSON(data.constantM);
			//alert(constantM.ZZ)
			//searchConstant();
			$("#A_value").val(constantM.A);
			//alert(A_value)
			$("#B_value").val(constantM.B);
			$("#ZZ_value").val(constantM.ZZ);
		});
	}
	$("#add_edit_constant").show();

}
function doDeleteConstant(kk_id){

	if(kk_id!=''){
		var obj={
			"kk_id":kk_id,
		}
		$.ajax({
			url: "/ajax/constant/delete",
			method: "POST",
			data: obj
		}).done(function(data, status, xhr) {
			console.log(data);
			searchConstant();
		});
	}

}
function doSubmitConstant(){
	var A_value= $("#A_value").val().toUpperCase();
	//alert(A_value)
	var B_value= $("#B_value").val();
	var ZZ_value=$("#ZZ_value").val();
	var obj={
		"ZZ":ZZ_value,
		"A":A_value,
		"B":B_value
	}
	$.ajax({
		url: "/ajax/constant/post",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		console.log(data);
		searchConstant();
	});
}
function searchAddMmpoint(mmtrend_table_B_selected){
	//alert(mmtrend_table_B_selected)
	var keyword=$("#keyword").val();
	//var mode=$("#mmtrend_mode").val();
	//var mmtrend_point_zz=$("#mmtrend_point_zz").val();
	//var mmtrend_point_h= $("#mmtrend_point_h").val();
	var mmtrend_table_B= $("#mmtrend_table_B").val();
	/*if(mmtrend_table_B_selected=='')
	 mmtrend_table_B_selected= $('select[id="mmtrend_table_B"]').val();
	 */

	//var xxx=$('select[id="mmtrend_table_B"] option:selected').val();
	//alert(mmtrend_table_B+","+mmtrend_table_B_selected+","+xxx);
	//return false;
	var obj={
		"keyword":keyword,
		//"H":mmtrend_point_h,
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
	if(mmtrend_table_B=='0' || mmtrend_table_B=='-1' || mmtrend_table_B=='1') {
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
		url: "/ajax/addmmpoint/search",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		console.log(data);
		if(mmtrend_table_B=='0' || mmtrend_table_B=='-1' || mmtrend_table_B=='1'){
			var mmpointM = jQuery.parseJSON(data.mmpointM);
			// alert(mmpointM.length)
			if(mmpointM!=null && mmpointM.length>0) {
				for (var i = 0; i < mmpointM.length; i++) {
					str = str +
						" <tr class=\"gradeA odd\" role=\"row\"> "+
						"  <td class=\"sorting_1\"> ";
					var checked_str="";
					/*
					if(mmpointM[i].A==mmtrend_point_h){
						checked_str="checked";
					}
					*/
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
					/*
					if(mmpointM[i].A==mmtrend_point_h){
						checked_str="checked";
					}
					*/
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
function  displayAddPoint(){
	/*
	$("#mmtrend_mode").val(mode)
	$("#mmtrend_point_zz").val(id)
	$("#mmtrend_point_h").val(h_id)
	//alert($("#mmtrend_point_zz").val())
	var obj={
		"ZZ":id,
		"G":$("#mmtrend_zz").val()

	}
	//alert(id)
	$.ajax({
		url: "/ajax/mmtrend/get",
		method: "GET",
		data: obj
	}).done(function(data, status, xhr) {
		console.log(data);
		var mmtrendM = jQuery.parseJSON(data.mmtrendM);
		var mmnamesM = jQuery.parseJSON(data.mmnameM);
		var mmpointM = jQuery.parseJSON(data.mmpointM);
		$("#mmpoint_table_G0").val('');
		$("#mmpoint_table_G1").val('');
		$("#mmpoint_table_F").val('');

		var mmtrend_tilte="แก้ใข";
		if(mode=='add')
			mmtrend_tilte="เพิ่ม";
		$("#button_mmtrend_mode_section").html(mmtrend_tilte);
		//alert(mmtrendM.F0)
		if(mmtrendM !=null ){
			$("#mmpoint_table_G0").val(mmtrendM.F0);
			$("#mmpoint_table_G1").val(mmtrendM.F1);
			$("#mmpoint_table_F").val(mmtrendM.E);
			$("#mmtrend_group_b").val(mmtrendM.B);
		}
		//  alert(mmnamesM.A)
		$("#mmtrend_tilte_section").html(mmtrend_tilte+" Point ไปที่ "+mmnamesM.A);
		$("#modalAddPoint").modal()
		$("#keyword").val('');
		searchMmpoint('');
	});
	*/
	$("#modalAddPoint").modal()
	$("#keyword").val('');
	searchAddMmpoint('');
}
function callback(data){
	console.log(data);
	alert(data.patternM.pattern)
}
function localJsonpCallback(data){
	console.log(data);
	alert("localJsonpCallback")
	alert(data.formula.length)
}

function previewFomala(){
	var cal_g=jQuery.trim( $("#cal_g").val().replace(/ /g,"") );
	var str=cal_g;
	$("#formula_tilte_section").html("<b>Formula : </b>"+str)

		//alert(str)
	 var myRegexp ="";
	 var match  = "";
	var constant_array=[];
	var unit_array=[];
	// find Constant
	// str="sing(CONSTANT@XXD)+4-CONSTANT@XXXXXX*3";
	 myRegexp = /(CONSTANT@[\w]+)/g;
	 match  = myRegexp.exec(str);
	 //alert(match)
	//match = myRegexp.exec(myString);
	while (match != null) {
		// matched text: match[0]
		// match start: match.index
		// capturing group n: match[n]
		//alert(match[1])
		//alert(match[1].replace(/CONSTANT@/g,""));
		var constantValue={
			"name":match[1].replace(/CONSTANT@/g,""),
			"result":""
		}
		constant_array.push(constantValue)
		match = myRegexp.exec(str);
	}
	//alert(constant_array);

	// find Unit or Cal Value
	 //str = "sin(U04D122+U07D123*5)";
	 myRegexp = /(U[0-9]{1,2})(D[0-9]{1,4})/g;
	 match  = myRegexp.exec(str);
	while (match != null) {
		//alert("unit["+match[1]+"] , value["+match[2]+"]")
		var unitValue={
			"unit":match[1],
			"value":match[2],
			"result":""
		}
		unit_array.push(unitValue);
		match = myRegexp.exec(str);
	}
	//alert(unit_array);
	if(constant_array.length==0 && unit_array.length==0){
		nomalFormula(str);
	}else{
		var obj={
			"constant_array":constant_array,
			"unit_array":unit_array,
		}
		$.ajax({
			url: "/ajax/calculation/extract",
			method: "POST",
			data: obj
		}).done(function(data, status, xhr) {
			console.log(data);
			var constant_arrayResults = jQuery.parseJSON(data.constant_array);
			var unit_arrayResults = jQuery.parseJSON(data.unit_array);

			if(constant_arrayResults!=null && constant_arrayResults.length>0){
				for(var i=0;i<constant_arrayResults.length;i++){
					var re = new RegExp("CONSTANT@"+constant_arrayResults[i].name,"g");
					str=str.replace(re,constant_arrayResults[i].result)
				}
			}
			if(unit_arrayResults!=null && unit_arrayResults.length>0){
				for(var i=0;i<unit_arrayResults.length;i++){
					var re = new RegExp(unit_arrayResults[i].unit+unit_arrayResults[i].value,"g");
					str=str.replace(re,unit_arrayResults[i].result)
				}
			}
			// replace ; with ,
			str=str.replace(/;/g,",")
			str=str.replace(/:/g,",")
			//alert("new->"+str)

			var formulas={
				"formula":[
					{"key":"1","value":str.toLowerCase(),"time":"99"} // ,
						// {"key":"3","value":"(300/3)*20"}
				],
				"callBackName":"callBackFormula"
			}
			// get data from formala
			$.ajax({
				url:"http://10.249.99.107:8080/steamtable/rest/calculation",
				//url: "http://localhost:3000/v1/calculation",
				method: "GET",
				dataType: "jsonp",
				jsonp: "callBackFormula",
				data: formulas
			});
		});

	}
	//alert(constant_array.length)
	//alert(unit_array.length)



	/*
	$.ajax({
		url: "http://localhost:3000/v1/extract",
		//url:"http://query.yahooapis.com/v1/public/yql",
		method: "GET",
		//crossDomain: true,
		dataType: "jsonp",
		jsonp: "jsonp",
		data: obj
	});
	*/
}
function nomalFormulaBK(str){
	var formulas={
		"formula":[
			{"key":"1","value":str.toLowerCase()} // ,

		]//,
		//"callBackName":"callBackFormula"
	}
	$.ajax({
		//url:"http://10.249.99.107:8080/steamtable/rest/calculation",
		url: "http://localhost:3000/v1/calculation",
		method: "POST",
		// dataType: "jsonp",
		// jsonp: "callBackFormula",
		data: formulas
	});

}
function nomalFormula(str){
	var formulas={
		"formula":[
				{"key":"1","value":str.toLowerCase()} // ,

		],
		"callBackName":"callBackFormula"
	}
	$.ajax({
		url:"http://10.249.99.107:8080/steamtable/rest/calculation",
		//url: "http://localhost:3000/v1/calculation",
		method: "POST",
		dataType: "jsonp",
		jsonp: "callBackFormula",
		data: formulas
	});

}
function callBackFormula(data){
	var resultMessage=data.formula[0].result;
	if(data.formula[0].status=='ERROR'){
		resultMessage="<span style='color: red;'>"+data.formula[0].result+"</span>";
	}
	$("#extract_section").html("<b>Extract : </b>"+data.formula[0].value)
	$("#result_section").html("<b>Result : </b>"+resultMessage);
	$("#myModalFormula").modal()
	console.log(data);
	//alert(data.formula.length)
	//alert(data.formula[0].key +" value="+data.formula[0].value)
	//var formula=jQuery.parseJSON(data);
	//alert("x")
}
function doClone(){
	var cal_a=$("#cal_a").val();
	//alert(cal_a)
	window.location.href="/ais/formCalculation/clone/"+cal_a;
}
function testCallDataSec(){
	//2015/12/30/0820152300006
	//0520140420/05201404200021.dat
	/*
	endTime	
	2015-12-11 11:12:00
	formulas[]	
	U04D3
	formulas[]	
	U04D4
	formulas[]	
	U04D7
	formulas[]	
	 U04D1+ U04D2+Enthalpy(U04D2;U04D2)
	key[]	
	U04D3
	key[]	
	U04D4
	key[]	
	U04D7
	key[]	
	DC508
	server	
	47
	startTime	
	2015-12-11 11:8:0
	trendID	
	3041
	*/
	var obj2={
			"key":["U04D3","U04D4","U04D7","DC508"],
			"formulas":["U04D3","U04D4","U04D7","U04D1+ U04D2+Enthalpy(U04D2;U04D2)"],
			"startTime":"2015-12-30 00:08:00",
			"endTime":"2015-12-30 00:09:00",
			"url":"http://10.249.91.96/trendSecond47/", // ok
			"server":"47",
			"trendID":"88",
		}
	var obj={
		"key":["U04D1","DC102"],
		//"formulas":["(U08D122+U08D122)*U08D123","U08D122+U08D123+CONSTANT@XXXXXX"],
		"formulas":["U04D1","U04D1+U04D2"],
		
		/*
		"startTime":"2014-05-20 00:02:00",
		"endTime":"2014-05-20 00:02:00",
		*/
		/*
		"startTime":"2014-04-20 00:21:00",
		"endTime":"2014-04-20 00:21:00",
		*/
		"startTime":"2015-12-30 00:06:00",
		"endTime":"2015-12-30 00:06:00",
		//"url":"http://localhost/",
		//"url":"http://10.249.91.207/trendSecond813/",
		//"server":"813"
		"url":"http://10.249.91.96/trendSecond47/", // ok
		"server":"47",
		
	}

	$.ajax({
		url: "/ajax/secdata",
		method: "POST",
		data: obj2
	}).done(function(data, status, xhr) {
		console.log(data.dataWithTimes);
		
		console.log("111data111");
		console.log(data);
		
		//var sources = jQuery.parseJSON(data.sources);
		//var dataWithTimes =data.dataWithTimes;
		var dataWithTimes = jQuery.parseJSON(data.dataWithTimes);
		

			var data2={
				//"formula1":data.dataWithTimes,
				"formula":dataWithTimes,
				"trendID":"88"
			}
			alert("---data2---");
			console.log(data2);
			$.ajax({
				url: "/ajax/postFormula",
				method: "POST",
				data: data2
			}).done(function(data22, status, xhr) {

				console.log(data22);
			});



	});
}
function testCallPostFormula(){

	var obj={
		key:["88-c102","88-c103","88-U04D260"],
		startTime:"2014-05-01 00:00:00",
		endTime:"2014-05-01 00:05:00",
		scaleType:"minute",
		//scaleType:"month",
		server:"47",
		trendID:"88",
		formulas:["U04D123+ U04D2+Enthalpy(U04D2;U04D2)","U04D123+U04D122","U04D260"]
	}

	$.ajax({
		url:"/ajax/executeCalculation",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		console.log(data);
		var results = jQuery.parseJSON(data);
		//console.log(results.formula[0].key);
	});
}
function testCallPostFormula(){

	var obj={
		key:["DC102","DC103","U04D260"],
		startTime:"2014-05-01 00:00:00",
		endTime:"2014-05-01 00:05:00",
		scaleType:"minute",
		//scaleType:"month",
		server:"47",
		trendID:"88",
		formulas:["U04D123+ U04D2+Enthalpy(U04D2;U04D2)","U04D123+U04D122","U04D260"]
	}

	$.ajax({
		url:"/ajax/executeCalculation",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		//console.log(data);
		$obj=eval("("+data+")");
		if($obj=='createJsonSuccess'){

			 $.ajax({
					url:"/ajax/readData/minute/88",
					type:"get",
					async:false,
					dataType:"json",
					success:function(data){



						var jsonData="";
						jsonData+="[";
						$i=0;
						$.each(data,function(index,indexEntry){

							console.log(index);

							if((toTimestamp(index)>=toTimestamp("2014-05-01 00:00:00")) && (toTimestamp(index)<=toTimestamp("2014-05-01 00:03:00"))) {




									if($i==0){
										jsonData+="{";
									}else{
										jsonData+=",{";
									}
									$j=0;
									$.each(indexEntry,function(index2,indexEntry2){

										if($j==0){
											jsonData+="\""+index2+"\":\""+indexEntry2+"\"";
										}else{
											jsonData+=",\""+index2+"\":"+indexEntry2+"";
										}

										$j++;
									});

									jsonData+="}";
									$i++;


							}
						});

						jsonData+="]";

						console.log(jsonData);
					}
			 });

		}
		//$.each(data)
		//var results = jQuery.parseJSON(data);
		//console.log(results.formula[0].key);
	});
}
