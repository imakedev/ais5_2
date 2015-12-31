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
					$("#listAllTrendGroup").val("900002");
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
						
						var unitID=$("#unit").val();
						$("#paramTrendIDEmbed").remove();
						$("body").append("<input type='hidden' id='paramTrendIDEmbed' class='' value='"+trendID+"'>");
						
						
						 $(".paramUnitEmbed").remove();
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
						$("#btnPlotGraphArea").show();
						$("#listAllUnitArea").show();

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
		 //binding event change select mm
		   $("#unit").change(function(){

			  getPointListFn($("#paramTrendIDEmbed").val(),$(this).val());
			  
			  $("#paramUnitEmbed").remove();
			  var paramPoint="";
			  paramPoint+="<input type='hidden' id='paramUnitEmbed' name='paramUnitEmbed' value='"+$(this).val()+"'>";
			  $("body").append(paramPoint);
			  
			  
		   });
		  
		   
		  //binding event plot graph
		   
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
		   
		   $(".btnPlotGraph").click(function(){
			   
			   //check value in check box is not null start
			   //validationPoint();
			   //check value in check box is not null end
			   plotGraphFn('Initial','N',$("#paramTrendIDEmbed").val());
		   });
		
		
	});
	
	
