var createHtmlGridTrendList = function(){
	var tableHTML="";	
	tableHTML+="<table id=\"gridTrendList\" class=\"displaynone\">";
	tableHTML+="<colgroup>";
		//tableHTML+="<col style=\"width:85%\"/>";
		tableHTML+="<col />";
   tableHTML+="</colgroup>";
	   tableHTML+="<thead>";
	   tableHTML+="<tr>";
		 tableHTML+="<th class='listTrend' data-field=\"field2\"><b>Trend Name</b></th>";
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
        dataSource: {
        	pageSize: 10,
        },
        
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
	        dataSource: {
	        	pageSize: 10,
	        },
	        
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
		
		
		
		$.each(data,function(index,indexEntry){
			//console.log(indexEntry);
			if(index==0){
				dropDownListHTML+="<option value='"+indexEntry['B']+"' selected>";
				dropDownListHTML+=indexEntry['group_name'];
				dropDownListHTML+="</option>";
			}else{
				dropDownListHTML+="<option value='"+indexEntry['B']+"'>";
				dropDownListHTML+=indexEntry['group_name'];
				dropDownListHTML+="</option>";
			}
			
			
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
					//alert("test");
							tableTrendHTML+=" <tr>";
																					//<input type="checkbox" value="260-4-6131" name="point" id="point-260-4-6131" class="point">
					            tableTrendHTML+="<td>";
					            //tableTrendHTML+="<div class='listCheckbox listPoint'><input type='checkbox' name='point' class='trend-"+trendID+"' id='trend-"+trendID+"' value='"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'></div>";
					           
					            
					            if(indexEntry['I']!=0){
					            	tableTrendHTML+="<div class='listCheckbox listPoint'><input type='checkbox' class='pointEdit-"+trendID+"' id='pointEdit-"+indexEntry['I']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'  name='pointEdit-"+trendID+"' value='C"+indexEntry['I']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"-"+indexEntry['FORMULA']+"'></div>";	
					            }else{
					            	tableTrendHTML+="<div class='listCheckbox listPoint'><input type='checkbox' name='pointEdit-"+trendID+"' class='pointEdit-"+trendID+"' id='pointEdit-"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"' value='"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'></div>";
					            }
					            
					           
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
				
				
				//loop data for checked start
				
				 var objectPoint= $(".pointEdit-"+trendID).get();
				 //console.log("objectPoint2222222");
				 console.log(objectPoint);
				 var objectPointPrePlot=$(".paramPointEmbedPrePlot-"+trendID+"").get();
				// console.log("objectPointPrePlot2222222");
				 console.log(objectPointPrePlot);
				 $.each(objectPointPrePlot,function(index,indexEntry){
		
					 $.each(objectPoint,function(index2,indexEntry2){
						 //alert("1="+$(indexEntry2).val());
						 //alert("2="+$(indexEntry).val());
						 if($(indexEntry2).val()==$(indexEntry).val()){
							 
							 //alert($(indexEntry2).val());
							 console.log("#point-"+$(indexEntry2).val());
							 
							 var getCalID="";
							 var getCalIDArray=$(indexEntry2).val().split("-");
							 getCalID=getCalIDArray[0]+"-"+getCalIDArray[1]+"-"+getCalIDArray[2];
							// alert(getCalID);
							 
							 $("#pointEdit-"+getCalID).attr('checked',true);
						 }
						 
					 });

				 });
				 
				//loop data for checked end
				
				//embed point id for plot graph start
				$(document).off("click",".pointEdit-"+trendID);
				$(document).on("click",".pointEdit-"+trendID,function(){
					 //alert($(this).val());
					 var pointIDArray = $(this).val().split("-");
					 var pointID=pointIDArray[0];
					 
					 if($(this).prop( "checked" )==true){
						 
						  var paramPoint="";
						  paramPoint+="<input type='hidden' class='paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"' id='paramPointEmbedPrePlot-"+$(this).val()+"' name='paramPointEmbedPrePlot-"+$(this).val()+"' value='"+$(this).val()+"'>";
						  $("body").append(paramPoint);
						  
					 }else{
						 $("#paramPointEmbedPrePlot-"+$(this).val()+"").remove();
					 }
					
				});
				
				//embed point id for plot graph end	 
				
				
				
				$("#editGridPointList").kendoGrid({
					
					
					height: 200,
					//scrollable: false,
			        sortable: true,
			        dataSource: {
			        	pageSize: 10,
			        },
			        
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
				
				//console.log(data);
				
				var tableTrendHTML="";
				
				
				//var pointPrePlot=$(".paramPointEmbedPrePlot-"+trendID).val();
				/*
				$.each(pointPrePlot,function(index1,indexEntry1){
					alert(indexEntry1);
				});
				*/
				
				$.each(data,function(index,indexEntry){
					
					
							
							tableTrendHTML+=" <tr>";

					            tableTrendHTML+="<td>";
					            if(indexEntry['I']!=0){
					            	//tableTrendHTML+="<div class='listCheckbox listPoint'><input type='checkbox' class='point' id='point-C"+indexEntry['I']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'  name='point' value='"+indexEntry['FORMULA']+"'></div>";
					            	tableTrendHTML+="<div class='listCheckbox listPoint'><input type='checkbox' class='point' id='point-C"+indexEntry['I']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'  name='point' value='C"+indexEntry['I']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"-{"+indexEntry['FORMULA']+"'></div>";
					            	//tableTrendHTML+="<div class='listCheckbox listPoint'><input type='checkbox' class='point' id='point-C"+indexEntry['I']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'  name='point' value='"+indexEntry['FORMULA']+"'></div>";	
					            }else{
					            	tableTrendHTML+="<div class='listCheckbox listPoint'><input type='checkbox' class='point' id='point-"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'  name='point' value='"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'></div>";
					            }
					            
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
				
				
				 
				
				
				//setTimeout(function(){
					
				
				//loop data for checked start
				 var objectPoint= $(".point").get();
				 console.log(objectPoint);
				 var objectPointPrePlot=$(".paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"").get();
				 $.each(objectPointPrePlot,function(index,indexEntry){
					 //alert($(indexEntry).val());
					 
					 
					
					 
					 $.each(objectPoint,function(index2,indexEntry2){
						 //alert("indexEntry2="+$(indexEntry2).val()+"="+$(indexEntry).val());
						// alert("indexEntry="+$(indexEntry).val());
						 if($(indexEntry2).val()==$(indexEntry).val()){
							 //alert("ok");
							 //alert("#point-"+$(indexEntry2).val());
							 
							 console.log("#point-"+$(indexEntry2).val());
							 
							 //$("#point-"+$(indexEntry2).val()).addClass("test");
							 var getCalID="";
							 var getCalIDArray=$(indexEntry2).val().split("-");
							 getCalID=getCalIDArray[0]+"-"+getCalIDArray[1]+"-"+getCalIDArray[2];
							 
							 $("#point-"+getCalID).attr('checked',true);
							 //point-260-4-6131
							// console.log($("#point-"+$(indexEntry2).val()));
						 }
						 
					 });
					 
					
				 });
				//loop data for checked end
				 bindGridPoinList();
				//},1000);
				
				 
				
				 
				
				//alert(tableTrendHTML);
				
				
			}
		});
	}
	var bindChoosePointFn=function(){

		
		
		$(document).on("click",".choosePoint",function(){
			
			
			$('#pointAll').prop('checked' , false);
			$('#pointCompare').prop('checked' , false);
			
			
			$(".displayPoint").show();
			var trendID = this.id.split("-");
			trendID=trendID[1];
			
			$(".paramPointEmbedPrePlot-"+trendID+"").remove();
			$("#paramTrendIDEmbedPrePlot").remove();
			$("body").append("<input type='hidden' id='paramTrendIDEmbedPrePlot' class='paramTrendIDEmbedPrePlot' value='"+trendID+"'>");
			
			
			
			if(trendID==$("#paramTrendIDEmbed-"+trendID).val()){
				alert("This trend is already");
				return false;
				
			}else{
			var unitHtml="";
			$.ajax({
				url:'/ais/trendSetting/getMMPlant',
				dataType:'json',
				async:false,
				success:function(data){
					//alert(data);
					//console.log(data);
					if(data==1){
					/*
					unitHtml+="<select class=\"form-control input-sm unit\" id=\"unit-"+trendID+"\" name=\"unit-"+trendID+"\">";
						unitHtml+="<option selected value='All'>All Unit</option>";
						unitHtml+="<option value='4'>MM04</option>";
		                unitHtml+="<option value='5'>MM05</option>";
		                unitHtml+="<option value='6'>MM06</option>";
		                unitHtml+="<option value='7'>MM07</option>";
		            unitHtml+="</select> ";
		            */
						unitHtml+="<input type='radio' id='unitAll-"+trendID+"' class='unit-"+trendID+"' checked='checked' name='unit-"+trendID+"' value='All'>All Unit &nbsp;";
						unitHtml+="<input type='radio' id='unitMM04-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='4'>MM04 &nbsp;";
						unitHtml+="<input type='radio' id='unitMM05-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='5'>MM05 &nbsp;";
						unitHtml+="<input type='radio' id='unitMM06-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='6'>MM06 &nbsp;";
						unitHtml+="<input type='radio' id='unitMM07-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='7'>MM07 &nbsp;";
					}else{
						unitHtml+="<input type='radio' id='unitAll-"+trendID+"' class='unit-"+trendID+"' checked='checked' name='unit-"+trendID+"' value='All'>All Unit &nbsp;";
						unitHtml+="<input type='radio' id='unitMM08-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='8'>MM08 &nbsp;";
						unitHtml+="<input type='radio' id='unitMM09-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='9'>MM09 &nbsp;";
						unitHtml+="<input type='radio' id='unitMM010-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='10'>MM10 &nbsp;";
						unitHtml+="<input type='radio' id='unitMM011-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='11'>MM11 &nbsp;";
						unitHtml+="<input type='radio' id='unitMM012-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='12'>MM12 &nbsp;";
						unitHtml+="<input type='radio' id='unitMM013-"+trendID+"' class='unit-"+trendID+"' name='unit-"+trendID+"' value='13'>MM13 &nbsp;";
					/*
					unitHtml+="<select class=\"form-control input-sm unit\" id=\"unit-"+trendID+"\" name=\"unit-"+trendID+"\">";
						unitHtml+="<option selected value='All'>All Unit</option>";
						unitHtml+="<option value='8'>MM08</option>";
		                unitHtml+="<option value='9'>MM09</option>";
		                unitHtml+="<option value='10'>MM10</option>";
		                unitHtml+="<option value='11'>MM11</option>";
		                unitHtml+="<option value='12'>MM12</option>";
		                unitHtml+="<option value='13'>MM13</option>";
		            unitHtml+="</select> ";
		            */
		            
					}
				}
			});
			
			
			
            
            $("#listAllUnitArea").html(unitHtml);
            setTimeout(function(){
            	$("#listAllUnitArea").show();
            },1000);
            
			 //binding event change select mm
            $(".unit-"+trendID).off("click");
			   $(".unit-"+trendID).on("click",function(){
				  //alert($(this).val());
				   $("#pointAll").prop("checked",false);
				   $("#pointCompare").prop("checked",false);
				   var trendID="";
					  trendID=$("#paramTrendIDEmbedPrePlot").val();
				  
				  /*
				  alert(trendID);
				  alert($(this).val());
				  */
				 // alert($(this).val());
				  if("undefined"==$(this).val()){
					  getPointListFn(trendID,"All");
				  }else{
					  getPointListFn(trendID,$(this).val());
				  }
				  
				  
				  $("#paramUnitEmbed-"+trendID).remove();
				  var paramPoint="";
				  paramPoint+="<input type='hidden' id='paramUnitEmbed-"+trendID+"' class='paramUnitEmbed' name='paramUnitEmbed-"+trendID+"' value='"+$(this).val()+"'>";
				  $("body").append(paramPoint);
				  
				  
			   });
			   
            /*
			   $(".unit").off("change");
			   $(".unit").on("change",function(){
				   
				  var trendID=this.id.split("-");
				  trendID=trendID[1];
				  
				  //getPointListFn($("#paramTrendIDEmbed-"+trendID).val(),$(this).val());
				  getPointListFn(trendID,$(this).val());
				  $("#paramUnitEmbed-"+trendID).remove();
				  var paramPoint="";
				  paramPoint+="<input type='hidden' id='paramUnitEmbed-"+trendID+"' class='paramUnitEmbed' name='paramUnitEmbed-"+trendID+"' value='"+$(this).val()+"'>";
				  $("body").append(paramPoint);
				  
				  
			   });
			  */
			   
			  //binding event plot graph
			
			
			
			
		
			//alert(trendID);
			var unitID=$(".unit-"+trendID).val();
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
			
			//console.log($(this).parent().prev().text());
			var trendName=$(this).prev().text();
			$("#trendName").html(trendName);
			
			$(".paramTrendNameEmbed").remove();
			$("body").append("<input type='hidden' name='paramTrendNameEmbed-"+trendID+"' id='paramTrendNameEmbed-"+trendID+"' class='paramTrendNameEmbed' value='"+trendName+"'>");
			
			//show element
			$("#trendNameArea").show();
			$("#pointCompareArea").show();
			$("#pointAllArea").show();
			
			var htmlBtnPlotGraph="";
			htmlBtnPlotGraph="<div class='col-xs-12'><buton id=\"btnPlotGraph-"+trendID+"\" class=\"btn btn-primary  btn-sm pull-right btnPlotGraph\">Plot Graph </buton></div>";
			$("#btnPlotGraphArea").html(htmlBtnPlotGraph);
			$("#btnPlotGraphArea").show();
			
			
			
			
			$(".btnPlotGraph").off("click");
			$(".btnPlotGraph").on("click",function(){
				
				
			   var trendID=this.id.split("-");
			   trendID=trendID[1];
			   
			   var countPointArray=$("input.point:checked").get();
				 //alert(countPointArray.length);
				 if(countPointArray.length<1){
					 alert("เลือก point ด้วยครับ");
					 return false;
				 }
			   
			   
			   //Delete  paramPointEmbedPrePlot start
			   //$(".paramPointEmbedPrePlot-"+trendID+"").remove();
			   //Delete  paramPointEmbedPrePlot end
			   
			   //check value in check box is not null start
			   //validationPoint();
			   //check value in check box is not null end
			   //alert(trendID);
			   plotGraphFn('Initial','N',trendID);
			   

				
				$("#paramTrendIDEmbed-"+trendID).remove();
				$("body").append("<input type='hidden' id='paramTrendIDEmbed-"+trendID+"' class='paramTrendIDEmbed' value='"+trendID+"'>");
				
				//not delelte paramPointEmbedPrePlot
				//$(".paramPointEmbedPrePlot-"+trendID+"").remove();
			   
			});
			   
			}
			return false;

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
						
						
						

					}
				});
				
				
				//manage start
				
					bindGridTrendList();
					$("#gridTrendList").show();
					$("#bgParam").show();
					
					// binding ChoosePoint Fn Start//
					bindChoosePointFn();
					// binding ChoosePoint Fn End//
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
			   
			   $(".displayPoint").hide();
			   createHtmlGridTrendList();
			   trendFn.getTrendByGroupFn($("#listAllTrendGroup").val(),$("#searhTrend").val()); 
			   
			   //alert($("#searhTrend").val());
			   
			   
		   });
		   setTimeout(function(){
			   $("#btnSearchByGroup").click();
		   },1000);
		   
		   
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
		  
		//point compare start
		 $(document).on("click","#pointCompare",function(){

			     $('#pointAll').prop('checked' , false);
				 $('input.point').prop('checked' , false);
				 $(".paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()).remove();

			 
		 });
		//point compare end
		//all point start
		 $(document).on("click","#pointAll",function(){
			 
			 $('#pointCompare').prop('checked' , false);
			 
			 $(".paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()).remove();
			 
			 	if($("#pointAll").is(':checked')==true){
			 		
			 		$('input.point').prop('checked' , true);
			 		var countPointArray=$("input.point:checked").get();
			 		 if(countPointArray.length>12){
						 alert("เลือกได้สูงสุด 12 Point");
						 return false;
					 }
			 		 
			 		$.each(countPointArray,function(index,indexEntry){
			 				
			 				if(index<12){
			 					
				 				var paramPoint="<input type='hidden' class='paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"' id='paramPointEmbedPrePlot-"+$(indexEntry).val()+"' name='paramPointEmbedPrePlot-"+$(indexEntry).val()+"' value='"+$(indexEntry).val()+"'>";
							  	$("body").append(paramPoint);
							  	
			 				}
			 				
			 		});
				 
				 
			 	}else{
			 		
			 		$('input.point').prop('checked' , false);
			 		$(".paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()).remove();
			 	 
			 	}

			 
		 });
		//all point start end
		 
		 
		 //embed point id for plot graph start
		$(document).on("click",".point",function(){
			// alert($(this).val());

			$('#pointAll').prop('checked' , false);
			var countPointArray=$("input.point:checked").get();
			 if(countPointArray.length>12){
				 alert("ไม่ควรเลือก Point เกิน 12 Point");
				 return false;
			 }
			
			//alert($("#pointCompare").is(':checked'));
			 if($("#pointCompare").is(':checked')==true){
				 //alert("commpare checked");
				 var countPointArray=$("input.point:checked").get();
				 //alert(countPointArray.length);
				 if(countPointArray.length>1){
					 alert("compare point เลือกได้แค่ 1 point");
					 return false;
				 }else if(countPointArray.length==1){
					 var paramPoint="";
					  //alert($(countPointArray).val());
					 
					 var compareDataIDArray=$(countPointArray).val().split("-");
					  //alert(compareDataIDArray[0]);
					  
					  $.ajax({
						 url:"/ais/trendSetting/getPointCompareByTrendIDAndPointID/"+$("#paramTrendIDEmbedPrePlot").val()+"/"+compareDataIDArray[0]+"",
						 type:"get",
						 dataType:"json",
						 async:false,
						 success:function(data){
							 /*
							 console.log("test----test");
							 console.log(data);
							 */
							 $.each(data,function(index,indexEntry){
								 
								 
								 paramPoint+="<input type='hidden' class='paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"' id='paramPointEmbedPrePlot-"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"' name='paramPointEmbedPrePlot-"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"' value='"+indexEntry['H']+"-"+indexEntry['B']+"-"+indexEntry['ZZ']+"'>";
							 });
						 }
					  });
					  
					 /*
					  paramPoint+="<input type='hidden' class='paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"' id='paramPointEmbedPrePlot-"+compareDataIDArray[0]+"-4-"+compareDataIDArray[2]+"' name='paramPointEmbedPrePlot-"+compareDataIDArray[0]+"-4-"+compareDataIDArray[2]+"' value='"+compareDataIDArray[0]+"-4-"+compareDataIDArray[2]+"'>";
					  paramPoint+="<input type='hidden' class='paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"' id='paramPointEmbedPrePlot-"+compareDataIDArray[0]+"-5-"+compareDataIDArray[2]+"' name='paramPointEmbedPrePlot-"+compareDataIDArray[0]+"-5-"+compareDataIDArray[2]+"' value='"+compareDataIDArray[0]+"-5-"+compareDataIDArray[2]+"'>";
					  paramPoint+="<input type='hidden' class='paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"' id='paramPointEmbedPrePlot-"+compareDataIDArray[0]+"-6-"+compareDataIDArray[2]+"' name='paramPointEmbedPrePlot-"+compareDataIDArray[0]+"-6-"+compareDataIDArray[2]+"' value='"+compareDataIDArray[0]+"-6-"+compareDataIDArray[2]+"'>";
					  paramPoint+="<input type='hidden' class='paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"' id='paramPointEmbedPrePlot-"+compareDataIDArray[0]+"-7-"+compareDataIDArray[2]+"' name='paramPointEmbedPrePlot-"+compareDataIDArray[0]+"-7-"+compareDataIDArray[2]+"' value='"+compareDataIDArray[0]+"-7-"+compareDataIDArray[2]+"'>";
					  $("body").append(paramPoint);
					  */
					  $("body").append(paramPoint);
					 
				 }
			 }
			 var pointIDArray = $(this).val().split("-");
			 var pointIDByCalArray=this.id;
			 var pointIDByCal="";
			 var pointIDByCalArray2="";
			 var pointIDByCal2="";
			 
			 var pointID=pointIDArray[0];
			 var pointIDNotFormula="";
			 
			 /*
			 pointIDByCal=pointIDByCalArray.substring(6,7);
			 //alert(pointIDByCal);
			 if(pointIDByCal=="C"){
				 //7-4-88333
				 //C512-4-88339
				 pointIDByCalArray2=pointIDByCalArray.split("-");
				 pointIDNotFormula2=pointIDByCalArray2[1]+"-"+pointIDByCalArray2[2]+"-"+pointIDByCalArray2[3];
				 pointIDNotFormula=pointIDNotFormula2;
				 
			 }else{
				 pointIDNotFormula=$(this).val().split("-");
				 pointIDNotFormula=pointIDNotFormula[0]+"-"+pointIDNotFormula[1]+"-"+pointIDNotFormula[2];
			 }
			 */
			 
			 pointIDNotFormula=$(this).val().split("-");
			 pointIDNotFormula=pointIDNotFormula[0]+"-"+pointIDNotFormula[1]+"-"+pointIDNotFormula[2];
			 
			 
			 pointIDNotFormula=ClearTrim(pointIDNotFormula);
			 //alert(pointIDNotFormula);
			 
			 if($(this).prop( "checked" )==true){
				 if($("#pointCompare").is(':checked')==false){
					  var paramPoint="";
						 //alert(pointIDNotFormula);
					  paramPoint+="<input type='hidden' class='paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"' id='paramPointEmbedPrePlot-"+pointIDNotFormula+"' name='paramPointEmbedPrePlot-"+pointIDNotFormula+"' value='"+$(this).val()+"'>";
					  $("body").append(paramPoint);
				 }
			 }else{
				 if($("#pointCompare").is(':checked')==true){
					 $(".paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()).remove();
				 }else{
					 $("#paramPointEmbedPrePlot-"+pointIDNotFormula+"").remove();
				 }
				 
			 }
			 
			 //console.log("-----");
			 //console.log($(".paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"").get());
			 /*
			 var objectPointPrePlot=$(".paramPointEmbedPrePlot-"+$("#paramTrendIDEmbedPrePlot").val()+"").get();
			 
			 $.each(objectPointPrePlot,function(index,indexEntry){
				 alert($(indexEntry).val());
			 });
			 */
			 
			
		});
		//embed point id for plot graph end	 
			
		
	});
	
	
