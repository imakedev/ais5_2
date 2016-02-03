var createHtmlGridTrendList = function(){
	var tableHTML="";	
	tableHTML+="<table id=\"gridTrendList\" class=\"displaynone\">";
	tableHTML+="<colgroup>";
		//tableHTML+="<col style=\"width:85%\"/>";
		tableHTML+="<col />";
   tableHTML+="</colgroup>";
	   tableHTML+="<thead>";
	   tableHTML+="<tr>";
		 tableHTML+="<th data-field=\"field2\"><b>Trend Name</b></th>";
		// tableHTML+="<th data-field=\"field5\"><b></b></th>";
	   tableHTML+="</tr>";
    tableHTML+="</thead>";
	tableHTML+="<tbody id='trendDataArea'>";
    
	tableHTML+="</tbody>";
	tableHTML+="</table>";
	
	$("#gridTrendListArea").html(tableHTML);
}
var createHtmlGridPointList=function(){
	var tableHTML="";
	tableHTML+="<table id=\"gridPointList\" class=''>";
	   tableHTML+=" <colgroup>";
	       tableHTML+=" <col style=\"width:3%\"/>";
	       tableHTML+=" <col style=\"width:5%\"/>";
	        tableHTML+="<col style=\"width:5%\" />";
	        tableHTML+="<col style=\"width:25%\" />";
	        tableHTML+="<col style=\"width:25%\" />";
	       tableHTML+=" <col style=\"width:10%\" />";
	       tableHTML+=" <col style=\"width:10%\" />";
	       tableHTML+=" <col style=\"width:10%\" />";
	       
	    tableHTML+="</colgroup>";
	    tableHTML+="<thead>";
	       tableHTML+=" <tr>";
	           tableHTML+=" <th data-field=\"field1\">";
	           tableHTML+=" </th>";
	           tableHTML+=" <th data-field=\"field2\"><b>Point</b></th>";
	           tableHTML+=" <th data-field=\"field3\"><b>MM Unit</b></th>";
	            tableHTML+="<th data-field=\"field4\"><b>Point Name</b></th>";
	            tableHTML+="<th data-field=\"field5\"><b>Tag Name</b></th>";
	            tableHTML+="<th data-field=\"field6\"><b>Unit</b></th>";
	            tableHTML+="<th data-field=\"field7\"><b>Max</b></th>";
	          tableHTML+="  <th data-field=\"field8\"><b>Min</b></th>";
	       tableHTML+=" </tr>";
	   tableHTML+=" </thead>";
	    tableHTML+="<tbody id='pointDataArea'>";
	    
	   tableHTML+="</tbody>";
	   tableHTML+="</table>";
	   
	   $("#gridPointListArea").html(tableHTML);
	   
	   
}
var bindGridTrendList = function(){
	

	

	$("#gridTrendList").kendoGrid({
        height: 300,
		//scrollable: false,
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
    });
}
var bindGridPoinList = function(){
		$("#gridPointList").kendoGrid({
			height: 300,
			//scrollable: false,
	        sortable: true,
	        pageable: {
	            refresh: true,
	            pageSizes: true,
	            buttonCount: 5
	        },
	    });
}
	/*
	$("#gridPointList").kendoGrid({
	       // height: 400,
			scrollable: false,
	        sortable: true,
	        pageable: {
	            refresh: true,
	            pageSizes: true,
	            buttonCount: 5
	        },
	    });
	*/
	
	var dropDownList = function(data,name){
		var dropDownListHTML='';
		dropDownListHTML+="<select id='"+name+"' class='form-control input-sm pull-right'>";
		
		dropDownListHTML+="<option value='All'>";
		dropDownListHTML+="All Trend";
		dropDownListHTML+="</option>";
		
		dropDownListHTML+="<option value='All'>";
		dropDownListHTML+="All Trend";
		dropDownListHTML+="</option>";
		
		$.each(data,function(index,indexEntry){
			//console.log(indexEntry);
			
			dropDownListHTML+="<option value='"+indexEntry['B']+"'>";
			dropDownListHTML+=indexEntry['group_name'];
			dropDownListHTML+="</option>";
			
		});
		dropDownListHTML+="</select>";
		return dropDownListHTML;
	};
	var trendGroud = {
		listAllTrendGroud:function(){
			
			$.ajax({
				url:'/ais/trendSetting/getAllTrendGroup',
				dataType:'json',
				async:false,
				success:function(data){
					$("#listAllTrendGroupArea").html(dropDownList(data,"listAllTrendGroup"));
					//$("#listAllTrendGroup").val("900002");
				}
			});
		}
		
		
	};
	
	
	var editTrendPointFn=function(trendID,unitID){
		
		var tableTrendHTML="";
		$.ajax({
			url:"/ais/trendSetting/getPointByTrend/"+trendID+"/"+unitID+"",
			dataType:'json',
			async:false,
			success:function(data){
				
				//console.log(data);
				var tableHTML="";
				
				tableHTML+="<table id=\"editGridPointList\" class=''>";
				   tableHTML+=" <colgroup>";
				       tableHTML+=" <col style=\"width:3%\"/>";
				       tableHTML+=" <col style=\"width:5%\"/>";
				        tableHTML+="<col style=\"width:5%\" />";
				        tableHTML+="<col style=\"width:25%\" />";
				        tableHTML+="<col style=\"width:25%\" />";
				       tableHTML+=" <col style=\"width:10%\" />";
				       tableHTML+=" <col style=\"width:10%\" />";
				       tableHTML+=" <col style=\"width:10%\" />";
				       
				    tableHTML+="</colgroup>";
				    tableHTML+="<thead>";
				       tableHTML+=" <tr>";
				           tableHTML+=" <th data-field=\"field1\">";
				           tableHTML+=" </th>";
				           tableHTML+=" <th data-field=\"field2\"><b>Point</b></th>";
				           tableHTML+=" <th data-field=\"field3\"><b>MM Unit</b></th>";
				            tableHTML+="<th data-field=\"field4\"><b>Point Name</b></th>";
				            tableHTML+="<th data-field=\"field5\"><b>Tag Name</b></th>";
				            tableHTML+="<th data-field=\"field6\"><b>Unit</b></th>";
				            tableHTML+="<th data-field=\"field7\"><b>Max</b></th>";
				          tableHTML+="  <th data-field=\"field8\"><b>Min</b></th>";
				       tableHTML+=" </tr>";
				   tableHTML+=" </thead>";
				    tableHTML+="<tbody id='editPointDataArea'>";
				    
				   tableHTML+="</tbody>";
				   tableHTML+="</table>";
				   
				   $("#editTrendPointArea").html(tableHTML);
				
				$.each(data,function(index,indexEntry){
					
							tableTrendHTML+=" <tr>";

					            tableTrendHTML+="<td>";
					            tableTrendHTML+="<div class='listCheckbox listPoint'><input type='checkbox' name='point' class='trend-"+trendID+"' id='trend-"+trendID+"' value='"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'></div>";
					            tableTrendHTML+="</td>";
					            tableTrendHTML+="<td>"+indexEntry['A']+"</td>";
					            tableTrendHTML+="<td>"+indexEntry['B']+"</td>";
					            tableTrendHTML+="<td>"+indexEntry['C']+"</td>";
					            tableTrendHTML+="<td>"+indexEntry['D']+"</td>";
					            tableTrendHTML+=" <td>"+indexEntry['E']+"</td>";
					            tableTrendHTML+="<td>"+indexEntry['F0']+"</td>";
					            tableTrendHTML+=" <td>"+indexEntry['F1']+"</td>";

					        tableTrendHTML+="</tr>";

				});
				
				$("#editPointDataArea").html(tableTrendHTML);
				
				$("#editGridPointList").kendoGrid({
			        sortable: true,
			        pageable: {
			            refresh: true,
			            pageSizes: true,
			            buttonCount: 5
			        },
			    });
				
			}
		});
		
	}
	var getPointListFn=function(trendID,unitID){
		$.ajax({
			url:"/ais/trendSetting/getPointByTrend/"+trendID+"/"+unitID+"",
			dataType:'json',
			async:false,
			success:function(data){
				
				console.log(data);
				
				var tableTrendHTML="";
				$.each(data,function(index,indexEntry){
					
							tableTrendHTML+=" <tr>";

					            tableTrendHTML+="<td>";
					            tableTrendHTML+="<div class='listCheckbox listPoint'><input type='checkbox' name='point' value='"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'></div>";
					            tableTrendHTML+="</td>";
					            tableTrendHTML+="<td>"+indexEntry['A']+"</td>";
					            tableTrendHTML+="<td>"+indexEntry['B']+"</td>";
					            tableTrendHTML+="<td>"+indexEntry['C']+"</td>";
					            tableTrendHTML+="<td>"+indexEntry['D']+"</td>";
					            tableTrendHTML+=" <td>"+indexEntry['E']+"</td>";
					            tableTrendHTML+="<td>"+indexEntry['F0']+"</td>";
					            tableTrendHTML+=" <td>"+indexEntry['F1']+"</td>";

					        tableTrendHTML+="</tr>";
			        
					
				});
				//alert(tableTrendHTML);
				//createHtmlGridTrendList();
				createHtmlGridPointList();
				$("#pointDataArea").html(tableTrendHTML);
				bindGridPoinList();
				
				//alert(tableTrendHTML);
				
				
			}
		});
	}
	
	var trendFn={
			getTrendByGroupFn:function(groupId,groupName){
				//alert(groupId);
				$.ajax({
					url:'/ais/trendSetting/getTrendByGroup/'+groupId+"/"+groupName,
					dataType:'json',
					//data:{"groupId":groupId},
					async:false,
					success:function(data){
						
					var tableTrendHTML="";
						
						$.each(data,function(index,indexEntry){
							
						  tableTrendHTML+=" <tr>";
									//tableTrendHTML+="<td>";
									
									//tableTrendHTML+="<div class='listCheckbox'><input type='radio'  name='trend' value='"+indexEntry['ZZ']+"'></div>";
									//tableTrendHTML+="</td>";
									tableTrendHTML+="<td>"+indexEntry['A']+"";
									
									//tableTrendHTML+="<td>";
									tableTrendHTML+="<span class='displaynone'>"+indexEntry['A']+"</span>";
									tableTrendHTML+="<a id='choosePoint-"+indexEntry['ZZ']+"' href=\"#\" class=\"btn btn-primary pull-right btn-sm choosePoint\">Choose Point </a>";
									tableTrendHTML+="</td>";
							            
							tableTrendHTML+="</tr>";
					        
							
						});
						//alert(tableTrendHTML);
						$("#trendDataArea").html(tableTrendHTML);
						//alert(tableTrendHTML);
						
						

					}
				});
				
				
				//manage start
				
					bindGridTrendList();
					$("#gridTrendList").show();
					$("#bgParam").show();
					$(".choosePoint").click(function(){
						
						var trendID = this.id.split("-");
						trendID=trendID[1];
						
						if(trendID==$("#paramTrendIDEmbed-"+trendID).val()){
							alert("This trend is already");
							return false;
							
						}else{
							
						var unitHtml="";
						unitHtml+="<select class=\"form-control input-sm unit\" id=\"unit-"+trendID+"\" name=\"unit-"+trendID+"\">";
							unitHtml+="<option selected value='All'>All Unit</option>";
							unitHtml+="<option selected value='4'>MM04</option>";
			                unitHtml+="<option value='5'>MM05</option>";
			                unitHtml+="<option value='6'>MM06</option>";
			                unitHtml+="<option value='7'>MM07</option>";
		                unitHtml+="</select> ";
		                $("#listAllUnitArea").html(unitHtml);
		                setTimeout(function(){
		                	$("#listAllUnitArea").show();
		                },1000);
		                
						 //binding event change select mm
						   $(".unit").off("change");
						   $(".unit").on("change",function(){
							   
							  var trendID=this.id.split("-");
							  trendID=trendID[1];
							  //alert(trendID);
							  //alert($(this).val());
							  //getPointListFn($("#paramTrendIDEmbed-"+trendID).val(),$(this).val());
							  getPointListFn(trendID,$(this).val());
							  $("#paramUnitEmbed-"+trendID).remove();
							  var paramPoint="";
							  paramPoint+="<input type='hidden' id='paramUnitEmbed-"+trendID+"' class='paramUnitEmbed' name='paramUnitEmbed-"+trendID+"' value='"+$(this).val()+"'>";
							  $("body").append(paramPoint);
							  
							  
						   });
						  
						   
						  //binding event plot graph
						
						
						
						
					
						//alert(trendID);
						var unitID=$("#unit-"+trendID).val();
						//alert(unitID);
					
						
						/*
						$("#paramTrendIDEmbed-"+trendID).remove();
						$("body").append("<input type='hidden' id='paramTrendIDEmbed-"+trendID+"' class='paramTrendIDEmbed' value='"+trendID+"'>");
						*/
						
						 $("#paramUnitEmbed-"+trendID).remove();
						  var paramPoint="";
						  paramPoint+="<input type='hidden' id='paramUnitEmbed-"+trendID+"' class='paramUnitEmbed' name='paramUnitEmbed-"+trendID+"' value='"+unitID+"'>";
						  $("body").append(paramPoint);
						  
						
						getPointListFn(trendID,unitID);
						console.log("-----------");
						//console.log($(this).parent().prev().text());
						var trendName=$(this).prev().text();
						$("#trendName").html(trendName);
						
						$(".paramTrendNameEmbed").remove();
						$("body").append("<input type='hidden' name='paramTrendNameEmbed-"+trendID+"' id='paramTrendNameEmbed-"+trendID+"' class='paramTrendNameEmbed' value='"+trendName+"'>");
						
						//show element
						$("#trendNameArea").show();
						var htmlBtnPlotGraph="";
						htmlBtnPlotGraph="<div class='col-xs-12'><buton id=\"btnPlotGraph-"+trendID+"\" class=\"btn btn-primary  btn-sm pull-right btnPlotGraph\">Plot Graph </buton></div>";
						$("#btnPlotGraphArea").html(htmlBtnPlotGraph);
						$("#btnPlotGraphArea").show();
						
						
						
						
						$(".btnPlotGraph").off("click");
						$(".btnPlotGraph").on("click",function(){
						   var trendID=this.id.split("-");
						   trendID=trendID[1];
						   //check value in check box is not null start
						   //validationPoint();
						   //check value in check box is not null end
						   //alert(trendID);
						   plotGraphFn('Initial','N',trendID);
						   

							
							$("#paramTrendIDEmbed-"+trendID).remove();
							$("body").append("<input type='hidden' id='paramTrendIDEmbed-"+trendID+"' class='paramTrendIDEmbed' value='"+trendID+"'>");
							
						   
						});
						   
						}
						return false;

					});
			
				
				//manage end
			},
			getTrendByTrendNameGroupFn:function(TrendNameGroup){
				
				
			}
			
	};
	
	var validationPoint = function(){
		  var pointChecked = $('input[name=point]:checked');
		  
		 
		  //console.log(pointChecked);
		  
	}
	$(document).ready(function(){
		   $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		   //setTimeout(function(){
			   
			   trendGroud.listAllTrendGroud(); 
		  // },1000);
		  
		   
		  //binding change list group trend start
			   
			   $("#listAllTrendGroup").change(function(){
				   $("#searhTrend").val("");
			   });
			  
		  //binding change list group trend end   
		   $("#btnSearchByGroup").click(function(){
			 //  alert($("#listAllTrendGroup").val());
			   createHtmlGridTrendList();
			   
			   trendFn.getTrendByGroupFn($("#listAllTrendGroup").val(),$("#searhTrend").val()); 
			   
			   //alert($("#searhTrend").val());
			   
			   
		   });
		
		   
		   //TEST GRAPH START
		  
			 $("#testGraph").click(function(){
				//set parameter for test data start
			   $("#paramUnitEmbed").remove();
			   	var paramPoint="";
				paramPoint+="<input type='hidden' id='paramUnitEmbed-88' name='paramUnitEmbed-88' value='4'>";
				$("body").append(paramPoint);
				
				$("#paramTrendIDEmbed").remove();
				$("body").append("<input type='hidden' id='paramTrendIDEmbed' class='' value='88'>");

				$("#trendName").html("SH-RH Temperature Control(Test Graph)");
				
				$("#paramScaleTime").remove();
				$("body").append("<input type='hidden' name='paramScaleTime-88' id='paramScaleTime-88' class='paramDateEmbed' value='Minute'>");
				
				
				$("#paramTrendNameEmbed").remove();
				$("body").append("<input type='hidden' id='paramTrendNameEmbed-88' class='' value='SH-RH Temperature Control'>");
				
				
				plotGraphFn("Initial","Y",$("#paramTrendIDEmbed").val());
				

				
				//set parameter for test data end
			 }); 
				
			   
	
		 //TEST GRAPH START
		  
		
		
	});
	
	
