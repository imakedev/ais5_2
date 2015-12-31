//function callTrendFn(){

var rangHour=["1", "2", "3", "4", "6","8", "12", "16", "20", "24"];

//function for tooltip start

function templateFormat2(category,series,value) {
	
	var point=series.substring("1");
	var returnEvent="";
	var paramEvent="";
	var paramAction="";
	var paramVpser="";
	//return point+"-"+category;

	 if($("#paramevent-"+point).val()=="event"){
		 paramEvent+="event";
	 }
	 if($("#paramaction-"+point).val()=="action"){
		 paramAction+="action";
	 }
	 if($("#paramvpser-"+point).val()=="vpser"){
		 paramVpser+="vpser";
	 }
	 //console.log(paramEvent+","+paramAction+","+paramVpser);
	 
	 if((paramVpser!="") || (paramAction!="") || (paramEvent!="")){
		 
		$.ajax({
			url:"/webservice/event.php",
			type:"get",
			dataType:"html",
			async:false,
			data:{
				"paramEvent":paramEvent,"paramAction":paramAction,"paramVpser":paramVpser,
				"paramEvtime":category
				},
			success:function(data){
				//console.log(data);
				
				if(data=="empty"){
					
					returnEvent+= '';	
				}else{
					returnEvent+=data;
				}
			}
		});
		
	 }else{
		 
		 returnEvent+= 'abc';	
	 }
	 $("#tooltip").html(returnEvent);
	 
	
}
function templateFormat(category,series,value) {
	
	//set value in right table
	var point=series.substring("1");
	//console.log($("#trendTabActive").val());
	$("#valuePoint-"+point+"-"+$("#trendTabActive").val()).html(addCommas(value));
	var trendActive=$("#trendTabActive").val();
	if($("#paramScaleTime-"+trendActive+"").val()=="Hour"){
		var dmy="";
		var dmy2="";
		var dd="";
		var mm="";
		var yyyy="";
		var hour="";
		var setDate="";
		category = category.split(" ");
		
		dmy=category[0];
		dmy = dmy.split("/");
		//example convertDateTh 2015-11-17 convert to 17 พฤศจิกายน 2558
		dd=dmy[0];
		mm=dmy[1];
		yyyy=dmy[2];
		hour=category[1];
		dmy2=yyyy+"-"+mm+"-"+dd+" 00:00:00";
		setDate+=convertDateTh(dmy2)+" เวลา "+hour+":00:00 น.";
		
		$("#dateTimeInDataDisplayHour-"+$("#trendTabActive").val()+"").html(setDate);
		
		
		
	}if($("#paramScaleTime-"+trendActive+"").val()=="Second"){
		var dmy="";
		var dmy2="";
		var dd="";
		var mm="";
		var yyyy="";
		var hour="";
		var Minute="";
		var Second="";
		var setDate="";
		console.log("category="+category);
		category = category.split(",");
		
		var  date=category[0];
		 var time=category[1];
		 setDate= setDate+" "+time;
		
		 
		//console.log("date="+date);
		
		//console.log("convertDateHisTh="+convertDateHisTh(date));
		
		$("#dateTimeInDataDisplaySecond-"+$("#trendTabActive").val()+"").html(convertDateHisTh(date));
		
		
		
	}else if($("#paramScaleTime-"+trendActive+"").val()=="Day"){
		var dmy="";
		var dmy2="";
		var dd="";
		var mm="";
		var yyyy="";
		var setDate="";
		dmy = category.split("/");
		dd=dmy[0];
		mm=dmy[1];
		yyyy=dmy[2];
		
		dmy2=yyyy+"-"+mm+"-"+dd+" 00:00:00";
		setDate+=convertDateTh(dmy2);
		
		$("#dateTimeInDataDisplayDay-"+$("#trendTabActive").val()+"").html(setDate);
		
		
		
	}else{
		//data by minute
		$("#timeInDataDisplay-"+$("#trendTabActive").val()).html("เวลา "+category);
		
		
	}
	
	//templateFormat2(category,series,value);
	
	var returnEvent="";
	var paramEvent="";
	var paramAction="";
	var paramVpser="";
	//return point+"-"+category;
/* /ais/serviceTrend/readEventDataTrendByEvent/D1/04/2014-05-01%2000:00:00/2014-10-01%2000:00:00/action */
	 if($("#paramevent-"+point+"-"+$("#trendTabActive").val()).val()=="event"){
		 
		 paramEvent+="event";
		 console.log("event");
		 console.log(point+"-"+$("#trendTabActive").val()+"-"+category);
		 console.log("---");
		 
		 
		 $.ajax({
				url:"/ais/serviceTrend/readEventDataTrendByEvent/D1/04/2014-05-01%2000:00:00/2014-10-01%2000:00:00/event",
				type:"get",
				dataType:"json",
				//async:false,
				success:function(data){
					
					
					
					$//("#tooltip-event-32-88'").html();
					//$("#tooltip").html(returnEvent);
				}
			});
		 
		 
	 }
	 if($("#paramaction-"+point+"-"+$("#trendTabActive").val()).val()=="action"){
		 paramAction+="action";
		 console.log("action");
		 console.log(point+"-"+$("#trendTabActive").val()+"-"+category);
		 console.log("---")
	 }
	 if($("#paramvpser-"+point+"-"+$("#trendTabActive").val()).val()=="vpser"){
		 paramVpser+="vpser";
		 console.log("vpser");
		 console.log(point+"-"+$("#trendTabActive").val()+"-"+category);
		 console.log("---")
	 }
	 
	 /*
	 
	 console.log("1111======");
	 console.log(category);
	 console.log(series);
	 console.log(value);
	 console.log("222======");
	 
	 */
	 //console.log(paramEvent+","+paramAction+","+paramVpser+","+point+","+category);
	 if((paramVpser!="") || (paramAction!="") || (paramEvent!="")){
		 
		 
		// $("#tooltipData").html(paramEvent+","+paramAction+","+paramVpser+","+point+","+category);
		
		 /*
		$.ajax({
			url:"/webservice/event.php",
			type:"get",
			dataType:"html",
			//async:false,
			data:{
				"paramEvent":paramEvent,"paramAction":paramAction,"paramVpser":paramVpser,
				"paramEvtime":category
				},
			success:function(data){
				
				
				if(data=="empty"){
					returnEvent+= '';	
				}else{
					returnEvent+=data;
					
				}
				$("#tooltip").html(returnEvent);
			}
		});
		*/
	 }
	
	 //$("#tooltip").html(returnEvent);
	 // $("#tooltip").html(returnEvent);
	
	 
}
//function for tooltip end
//function tooltip start
function tooltipCustom(paramTrendID){
	
	$("#trendChart-"+paramTrendID+"").mousemove(function(event){
		event.preventDefault();
	    //$("#log").text(event.pageX + ", " + (10+event.pageY));
		
		var htmlTooltip="";
		//setTimeout(function(){
			
		//},2000);
			//console.log(event.pageX);
			if($("#hiddenTooltip").val()=='hiddenTooltip'){
				//console.log("hiddenTooltip");
				$("#tooltip").hide();	
			}else{
				$("#tooltip").html($("#tooltipData").html()).css({"left":((event.pageX)+10)+"px","top":((event.pageY)+10)+"px"}).fadeIn();
			}
	}); 
	
	$("#trendChart-"+paramTrendID+"").mouseleave(function(event){
		event.preventDefault();
		$("#tooltip").hide();
		 
	});
	$("#listPointLeftArea-"+paramTrendID+"").mousemove(function(event){
		event.preventDefault();
		$("#tooltip").hide();
		 
	});
	$("#scaleTimeMenu-"+paramTrendID+"").mousemove(function(event){
		event.preventDefault();
		$("#tooltip").hide();
		 
	});
	$("#footGrachArea").mousemove(function(event){
		event.preventDefault();
		$("#tooltip").hide();
		 
	});
	
	 $("#tooltip").hide();
	 $("body").click(function(){
		 $("#tooltip").hide();
	 });
	
	 
	/*
	$(document).hover(function(e){
		
		
		
			$("#log").text(e.pageX+"-"+e.pageY);
			   var $AX =  e.pageX+10;
			   var $AY = e.pageY+10;
			   
			   var $pos = e.target.id;
			   
			   //หาid ที่ต้องการข้อมูล
			   //var classT = ".tootip#"+$pos;
			   
			   var classT = "#tooltip";
			   //ได้แล้วมาเก็บไว้ในตัวแปรclassT_text
			   var classT_text = $(classT).text();
			   if($.trim(classT_text)!=""){
				   
				$("#tooltip").empty().hide();
				//นำค่าจากตัวแปร classT_text ยัดใส่ id tooltip แล้วทำการแสดงผล
				
				$("#tooltip").append(classT_text).css({"left":$AX+"px","top":$AY+"px"}).fadeIn();
				
			   }
		  },function(){
			  $("#tooltip").hide();
	});
	*/
	
}
//function tooltip end
//$(document).ready(function(){
	
	
	 //startUpFn("Y");
	 
	 $("#creatFlie").click(function(){
		 readJsonFilterFile('2014-05-01 00:00:00','2014-05-01 05:00:00');
	 });
	 
	 
	 
	 //read file json end
	
	 
	//set scale time end
	 //binding kendoDropDrownList
	 function scaleTimeDropDownList(paramTrendID){
		 //alert(paramTrendID);
		 //check selected option
		var val1 = $("#paramScaleTime-"+paramTrendID+"").val();
		$("select#scaleTime-"+paramTrendID+" option").filter(function() {
		    return $(this).val() == val1; 
		}).prop('selected', true);
		
		
	 	
	 	
	 	$("#scaleTime-"+paramTrendID+"").change(function(){
	 		
	 		if($(this).val()=="Second"){
	 			
	 			$(".forSecondFormShow").show();
	 			$(".forSecondFormHide").hide();
	 			
	 			
	 			$("#dateFrom-"+paramTrendID+"").val($("#paramFromDate-"+paramTrendID+"").val());
	 			$("#dateFrom-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM-dd"
	 			 });
	 			$("#dateTo-"+paramTrendID+"").val($("#paramToDate-"+paramTrendID+"").val());
	 			$("#dateTo-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM-dd"
	 			 });
	 			
	 		}else if($(this).val()=="Month"){
	 			
	 			$("#dateFrom-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM"
	 			 });
	 			$("#dateTo-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM"
	 			 });
	 			
	 			$(".forSecondFormShow").hide();
	 			$(".forSecondFormHide").show();
	 			
	 		}else{
	 			
	 			$(".forSecondFormShow").hide();
	 			$(".forSecondFormHide").show();
	 			
	 			
	 			$("#dateFrom-"+paramTrendID+"").val($("#paramFromDate-"+paramTrendID+"").val());
	 			$("#dateFrom-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM-dd"
	 			 });
	 			$("#dateTo-"+paramTrendID+"").val($("#paramToDate-"+paramTrendID+"").val());
	 			$("#dateTo-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM-dd"
	 			 });
	 		}
	 		
	 	});
	 	
	 	$("#scaleTime-"+paramTrendID+"").change();
	}
	 
	
	
	 //date plugin start
	
	
	 
	
	///webservice/PlotGraph.php?starttime=2015-05-0100:00:00&endtime=2015-05-30%2000:00:00&mmunit=04&point=D19,D999&_unit=1
	//test call webservice function
	//[{"EvTime":"2014-05-01 00:00:00","D19":"92.48","D999":"0.00"}]
	
	function createLayoutListPointRight(data,paramTrendID){
		
		
		$("#listPointLeftArea-"+paramTrendID).empty();
		$.each(data,function(index,indexEntry){

			//listLeftPoint.php
			/*parameter pointname,point,tag,unit,max,min,mmunit*/
		
			
			$.ajax({
				url:"/View/listLeftPoint.php",
				type:"get",
				dataType:"html",
				async:false,
				data:{
						"pointname":indexEntry['C'],
						"point":indexEntry['H'],
						"tag":indexEntry['D'],
						"unit":indexEntry['E'],
						"max":indexEntry['F0'],
						"min":indexEntry['F1'],
						"mmunit":1,
						"colorFlatTheme":colorFlatTheme[index],
						"paramTrendID":paramTrendID,
					 },
				
				success:function(data){
					//alert(data);
					
					$("#listPointLeftArea-"+paramTrendID).append(data);
					
				}
			});
		});
		
		
	}
	function callServiceGetPointByTrend(trendno,_unit,mmunit,starttime,endtime){
		
				$.ajax({
					url:"/webservice/TrendName.php",
					type:"get",
					dataType:"json",
					async:false,
					data:{
							"trendno":trendno,
							"_unit":_unit,
							"mmunit":mmunit,
						 },
					
					success:function(data){
							var point="";
							$.each(data,function(index,indexEntry){
								if(index==0){
									point+="D"+indexEntry['point'];
								}else{
									point+=",D"+indexEntry['point'];
								}
								
							});
							$("#paramPoint").remove();
							var paramPoint="";
							paramPoint+="<input type='hidden' id='paramPoint' name='paramPoint' value='"+point+"'>";
							paramPoint+="<input type='hidden' id='paramPointAll' name='paramPointAll' value='"+point+"'>";
							$("body").append(paramPoint);
							
							//createLayoutListPointRight(data);
							//callCreateFileServiceChart(starttime,endtime,point,_unit,mmunit);
							
						}
					});
	}
	
	//function createLi
	$("#btnTest").click(function(){
		//trendno,_unit,mmunit,starttime,endtime
		callServiceGetPointByTrend('100','1','04','2014-05-01 00:00:0','2014-05-01 05:00:00');
	});
	
	
	function callCreateFileServiceChart(starttime,endtime,point,_unit,mmunit,scaleTime,paramTrendID){
		
		
		
		if(scaleTime=="Hour"){
			//alert("scaleTime"+scaleTime);
			createFileServiceChart.createFileByHru(paramTrendID);
			//alert("hello create Hour");
			
		}else if(scaleTime=="Day"){
			
			createFileServiceChart.createFileByDayu(paramTrendID);
			//alert("hello create Day");
			
		}else if(scaleTime=="Month"){
			
			createFileServiceChart.createFileByMonthu(paramTrendID);
			//alert("hello create Day");
			
		}else if(scaleTime=="Second"){
			
			createFileServiceChart.createFileBySecondu(paramTrendID);
			//alert("hello createFileServiceChart");
			
		}else{
			
			$.ajax({
				url:"/webservice/createJsonFile.php",
				type:"get",
				dataType:"json",
				async:false,
				data:{
						"starttime":starttime,
						"endtime":endtime,
						"mmunit":mmunit,
						"point":point,
						"_unit":_unit,
						"paramTrendID":paramTrendID
						
					  
					 },
				
				success:function(data){
			
					if(data=='createJsonSuccess'){
						
						var data2=readJsonFilterFile(startDateTime5HaGoFn(endDatetimeHisFn(endtime)),endDatetimeHisFn(endtime),paramTrendID);
						
						var minute=startDateTime5HaGoFn(endDatetimeHisFn(endtime)).split(" ");
						minute=minute[1];
						$("#startTimeForDisplay-"+paramTrendID+"").val(minute);
						setTimeout(function(){
							
							createTrendChart(getDataByMenute(data2,point),point,"60",paramTrendID);
							
							var lastObject = data2.pop();
							setDefaultPointAndPlan(lastObject,point,paramTrendID);
						},1000);
						
					}
				}
			});
		}
	}
	
	

	//createTrendChart();
	
	//console.log($("#chart>svg>g>g:eq(2)>g>g:eq(0)>path:eq(1)").get());
	/*
	var series1="#chart>svg>g>g:eq(2)>g>g:eq(0)";
	$("#btnPoint1").click(function(){
		//alert("hello");
		//console.log($(series1).get());
		//console.log(series1);
	});
	*/
	
	
	
	
	
	function pointCheckbox(paramPointId){
		var point1="";
		$("input[name='point']").filter(function() {
			point1=$(this).val().split("-");
			point1=point1[2];
			//alert(point1);
		    return point1 ==paramPointId; 
		    
		}).prop('checked', true);

	}
	/*
	var slider = document.getElementById('basic_slider');
	 $("#basic_slider").noUiSlider({
         start: 50,
         behaviour: 'tap',
         connect: 'upper',
         range: {
             'min':  0,
             'max':  100
         }
     });
	*/

	


	//create layout point right start
	function callDataLayoutPointRight(pointId,paramTrendID){
		//alert(pointId);87564,173,172,171
		$.ajax({
			url:"/ais/trendSetting/getPointByPointID/"+pointId,
			//url:"/ais/trendSetting/getPointByPointID/87564,173,172,171",
			type:"get",
			dataType:"json",
			async:false,
			success:function(data){
				//console.log(data);
				createLayoutListPointRight(data,paramTrendID);
			}
		});
	}
	//create layout point right end
	//set scale time start
	
	function getDataFromPointAllEmbed(returnType){
		
		var pointData = $("#paramPointAllEmbed-"+$("#trendTabActive").val()+"").val();
		pointData=pointData.split(",");
		var pointDataId="";
		var pointUnitId="";
		var pointId="";
		var pointDataSub="";
		
		//alert(pointData.length);
		
		for(var i=0;i<pointData.length;i++){
			//alert(pointData[i]);
			pointDataSub=pointData[i].split("-");
			
			
			if(i==0){
				
				pointDataId+=pointDataSub[0];
				pointUnitId+=pointDataSub[1];
				pointId+=pointDataSub[2];
			}else{
				pointDataId+=','+pointDataSub[0];
				pointUnitId+=','+pointDataSub[1];
				pointId+=','+pointDataSub[2];
			}
			
		}
		if(returnType=="pointDataId"){
			return pointDataId;
		}else if(returnType=="pointUnitId"){
			return pointUnitId;
		}else if(returnType=="pointId"){
			return pointId;
		}
		
	}
	
	
	/*
	function initailCreateGraph(){
		 //startUpFn();
		
		var fromDate="";
		var toDate="";
		//fromDate=currentDate()+" 00:00:00";
		//toDate=currentDate()+" 23:59:59";
		
		fromDate="2014-05-17 00:00:00";
		toDate="2014-05-22 23:59:59";

		$(".paramDateEmbed").empty();
		var paramDateEmbed="";
		paramDateEmbed+="<input type='hidden' name='paramFromDate' id='paramFromDate' class='paramDateEmbed' value='"+fromDate+"'>";
		paramDateEmbed+="<input type='hidden' name='paramToDate' id='paramToDate' class='paramDateEmbed' value='"+toDate+"'>";
		$("body").append(paramDateEmbed);

		var pointId =getDataFromPointEmbed("pointId");
		var pointDataId= getDataFromPointEmbed("pointDataId");
		
		
		callDataLayoutPointRight(pointId);
		callCreateFileServiceChart(fromDate,toDate,pointDataId,'1',"0"+$("#paramUnitEmbed").val());
		
		
		setScaleDateTimeFn(fromDate,toDate);
		//alert(setFormatDateTime(toDate));
		
		$("#dateInDataDisplay").html(convertDateTh(toDate));
		
		 //alert("initailCreateGraph");
		
	}
	*/
	//setTimeout(function(){
		  //initailCreateGraph();
	
	//},5000);
	
	 //alert($("#trendTabActive").val());
	
	
	$(document).on("click",".btnScaleTimeCancel",function(event){
	    //$("#btnScaleTimeArea").click();
		$(".btnScaleTimeArea").click();
	});
	 
	 $(document).on("click",".btnScaleTime",function(event){
		
		var paramTrendID=this.id.split("-");
		paramTrendID=paramTrendID[1];
		 
		startUpFn('N',paramTrendID);
		$(".btnScaleTimeArea").click();
		
	 });
	 
	 
	 //read file json start

	 function readJsonFilterFile(startTime,endTime,paramTrendID){
		 //return ("ok");
		 var jsonFilter = new Array();
		 $.ajax({
				url:"/webservice/readFile.php",
				type:"get",
				async:false,
				data:{"paramTrendID":paramTrendID},
				success:function(data){
					//console.log(data);
					
					$.each(data,function(index,indexEntry){
						
						if((toTimestamp(indexEntry['EvTime'])>=toTimestamp(startTime)) && (toTimestamp(indexEntry['EvTime'])<=toTimestamp(endTime))) {
							jsonFilter.push(indexEntry);
							//console.log(indexEntry);
							
						}
						
					});
					
					//console.log(jsonFilter);
					
					
				}
		 });
		 return jsonFilter;
		 
	 }
	 
	
	
	 function dateFromPicker(paramTrendID){
		 
		// $("#dateFromArea-"+paramTrendID+"").html("<input type='text' id='dateFrom-"+paramTrendID+"' value='07/01/2014' class='form-control input-sm' style='width: 100%'>");
		 
		 var dateFrom="";
		// alert($("#paramFromDate-"+paramTrendID+"").val());
		 if($("#paramFromDate-"+paramTrendID+"").val()!=undefined){
			 dateFrom=$("#paramFromDate-"+paramTrendID+"").val();
		 }else{
			 //dateFrom=currentDate();
			 
			 //dateFrom=intervalDelFn(currentDateTime(),'day',1);
			 dateFrom="2014-05-17 00:00:00";
		 }
		//alert(dateFrom);
		 $("#dateFrom-"+paramTrendID+"").val(dateFrom);
		 $("#dateFrom-"+paramTrendID+"").kendoDatePicker({
			 format: "yyyy-MM-dd"
		 });
		 $("#dateFrom-"+paramTrendID+"").show();
	 
	 
	 }
	 function dateToPicker(paramTrendID){
		 
		 //$("#dateToArea-"+paramTrendID+"").html("<input type='text' id='dateTo-"+paramTrendID+"' value='07/01/2014' class='form-control input-sm' style='width: 100%'>");
		 var dateTo="";
		// alert($("#paramToDate").val());
		 if($("#paramToDate-"+paramTrendID+"").val()!=undefined){
			 dateTo=$("#paramToDate-"+paramTrendID+"").val();
		 }else{
			// dateTo=currentDate();
			 dateTo="2014-05-18 00:00:00";
		 }
			 
			 
		 $("#dateTo-"+paramTrendID+"").val(dateTo);
		 $("#dateTo-"+paramTrendID+"").kendoDatePicker({
			 format: "yyyy-MM-dd"
		 });
		 
		 $("#dateTo-"+paramTrendID+"").show();
		 }
	
	 //date plugin end
	 
	 //point seting start
	
	 
	 $(document).on("click",".btnOkSetingPoint",function(event){
		 
		 //alert(this.id); 
		 var id=this.id.split("-");
		 id=id[1];
		 var paramEmbedEvent="";
		 var dataForTooltipUl="";
		 var dataForTooltipLi="";
		 $('input[name="pointEvent"]:checked').each(function() {
			 
			 // alert(id);
			 // alert(this.value);
			  paramEmbedEvent+="<input type='hidden' id='param"+this.value+"-"+id+"-"+$("#trendTabActive").val()+"' class='paramEvent-"+id+"' value='"+this.value+"'>";
			  dataForTooltipLi+="<li id=tooltip-"+this.value+"-"+id+"-"+$("#trendTabActive").val()+"' class='paramEvent-"+id+"'>"+this.value+":</li>";
			  
		 });
		 
		 $("#paramEmbedArea-"+id+"-"+$("#trendTabActive").val()).html(paramEmbedEvent);
		 
		 //Embed Tooltip Area
		 dataForTooltipUl+=$("#showPoin-"+id+"-"+$("#trendTabActive").val()+">.pointName").text()+"<ul id='tooltip-"+id+"-"+$("#trendTabActive").val()+"'>"+dataForTooltipLi+"</ul>";
		 $("ul#tooltip-"+id+"-"+$("#trendTabActive").val()).remove();
		 
		 $("#tooltipData").append(dataForTooltipUl);
		 if($.trim($("#tooltipData").text())!=""){
			 $("#hiddenTooltip").remove();
			 //loadEventForTrend();
			 tooltipCustom($("#trendTabActive").val(),true);
		 }else{
			 $("#hiddenTooltip").remove();
			 $("body").append("<input type='hidden' id='hiddenTooltip' name='hiddenTooltip' value='hiddenTooltip'>");
		 }
		// $(".btnOkSetingPoint").click();
		 $(".popover").popover('hide');
		 
	 });
	 
	 
	 
	 $(document).on("click",".btnCancelSetingPoint",function(event){
		 //$(".popover").popover('hide');
		 $(".btnCancelSetingPoint").click();
	 });
	 
	 //get param embed value
	 $(document).on("click",".btnSetingPoint",function(event){
		 
		 console.log($("#paramaction-"+this.id+"-"+$("#trendTabActive").val()).val());
		 if($("#paramevent-"+this.id+"-"+$("#trendTabActive").val()).val()=="event"){
			$("input#event-"+this.id+"-"+$("#trendTabActive").val()).prop('checked', true);
		 }
		 if($("#paramaction-"+this.id+"-"+$("#trendTabActive").val()).val()=="action"){
			$("input#action-"+this.id+"-"+$("#trendTabActive").val()).prop('checked', true);
		 }
		 if($("#paramvpser-"+this.id+"-"+$("#trendTabActive").val()).val()=="vpser"){
			$("input#vpser-"+this.id+"-"+$("#trendTabActive").val()).prop('checked', true);
		 }

	 });
	 
	 
	 
	 
	
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 //call display expand focus defalut start
	 	//setScaleDateTimeFn();
	 //call display expand focus defalut end
	 	
	 
	
	
	//showPoint/hiddenPoint start
	
	$(document).on("click",".clickHideShowPoint",function(event ){
		var paramTrendID=this.id.split("-");
		paramTrendID=paramTrendID[2];
		//alert(paramTrendID);
	
		if($(this).hasClass("hiddenPoint")){
			$(this).addClass("showPoint");
			$(this).removeClass("hiddenPoint");
	
			paramPointList=$(".showPoint>.pointId-"+paramTrendID+"").text().substring("1");
			//alert("1"+paramPointList);
			//$("#paramPointByShowOrHidden").val(paramPointList);
			
			readJsonShowHiddenPointFn(paramPointList,paramTrendID);
			//console.log($("#paramPoint").get());
			$("#paramPoint").val(paramPointList)
			
		}else{
			
			
			$(this).addClass("hiddenPoint");
			$(this).removeClass("showPoint");
			
			paramPointList=$(".showPoint>.pointId-"+paramTrendID+"").text().substring("1");
			//alert("2"+paramPointList);
			//$("#paramPointByShowOrHidden").val(paramPointList);
			readJsonShowHiddenPointFn(paramPointList,paramTrendID);
			
			//console.log($("#paramPoint").get());
			$("#paramPoint").val(paramPointList)
			
			
		}
		//alert(id);
		
	});
	
	//showPoint/hiddenPoint end
	
	
	 
	 
	 
	 function startUpFn(paramInitail,paramTrendID){
			
			
			
			
			var fromDate="";
			var toDate="";
			if(paramInitail=="Y"){
				
				fromDate="2014-05-17 00:00:00";
				toDate="2014-05-22 23:59:59";
				
			}else{
				
				fromDate=$("#dateFrom-"+paramTrendID+"").val()+" 00:00:00";
				toDate=$("#dateTo-"+paramTrendID+"").val()+" 23:59:59";
			}
			

			$(".paramDateEmbed-"+paramTrendID+"").remove();
			var paramDateEmbed="";
			paramDateEmbed+="<input type='hidden' name='paramFromDate-"+paramTrendID+"' id='paramFromDate-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+fromDate+"'>";
			paramDateEmbed+="<input type='hidden' name='paramToDate-"+paramTrendID+"' id='paramToDate-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+toDate+"'>";
			paramDateEmbed+="<input type='hidden' name='paramScaleTime-"+paramTrendID+"' id='paramScaleTime-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+$("#scaleTime-"+paramTrendID+"").val()+"'>";
			paramDateEmbed+="<input type='hidden' name='paramHour-"+paramTrendID+"' id='paramHour-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+$("#hour-"+paramTrendID+"").val()+"'>";
			paramDateEmbed+="<input type='hidden' name='paramMinate-"+paramTrendID+"' id='paramMinate-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+$("#minute-"+paramTrendID+"").val()+"'>";
			
			$("body").append(paramDateEmbed);

			var pointId =getDataFromPointEmbed("pointId");
			var pointDataId= getDataFromPointEmbed("pointDataId");
			//show layout right
			//alert(pointId);
			callDataLayoutPointRight(pointId,paramTrendID);
			//create file for chart
			
			var scaleTime=$("#paramScaleTime-"+paramTrendID+"").val();
			
			if(scaleTime=='Minute'){
				
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").show();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").hide();
				
			}else if(scaleTime=='Hour'){
				
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").show();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").hide();
				
			}else if(scaleTime=='Day'){
				
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").show();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").hide();
				
			}else if(scaleTime=='Month'){
				
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").show();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").hide();
				
			}else if(scaleTime=='Second'){
				
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").show();
				
			}
			
			callCreateFileServiceChart(fromDate,toDate,pointDataId,'1',"0"+$("#paramUnitEmbed-"+paramTrendID+"").val(),scaleTime,paramTrendID);
			
			//set title between for display
			setScaleDateTimeFn(fromDate,toDate,paramTrendID);
			//show date for left layout
			
			$("#dateInDataDisplay-"+paramTrendID).html(convertDateTh(toDate));
			
			//show structure dashboard trend when load is success.
			$("#trendContentArea").show();
			
				//binding scale time start	
				 $(".btnScaleTimeArea").click("toggle",function(){
					 //alert(this.id);
					 var paramTrendID = this.id.split("-");
					 paramTrendID=paramTrendID[1];
					 //alert(paramTrendID);
					 
					 if($(this).hasClass("clicked")){
						 $(this).removeClass("clicked");
						 $(".k-calendar-container").remove();
						// $(".popover").popover('hide');
					 }else{
						 $(this).addClass("clicked");
						 //$(".popover").popover('show');
						 setTimeout(function(){
							 /*
							 dateFromPicker(paramTrendID);
							 dateToPicker(paramTrendID);
							 */
							 scaleTimeDropDownList(paramTrendID);
						 });
					 }
				 });
				//binding scale time end	 
				
			
				 

					//radio start
					
					 $('.i-checks').iCheck({
				         checkboxClass: 'icheckbox_square-green',
				         radioClass: 'iradio_square-green',
				     });
					 
					
					 $(".showHiddenPoint").on('ifClicked', function (event) {
						 	//alert(this.id);
						 	
						 	var paramTrendID=this.id.split("-");
						 	paramTrendID=paramTrendID[1];
						 	//alert(paramTrendID);
						 	
					        if(this.value=='hiddenPointAll'){
					        	//alert($("#trendTabActive").val());
					        	//alert("1"+paramTrendID);
					        	readJsonHiddenPointAllFn(paramTrendID);
					        	
					        	//$(".list-group-item").addClass("bgGray");
					        }else{
					        	//alert($("#trendTabActive").val());
					        	//alert("2"+paramTrendID);
					        	readJsonShowPointAllFn(paramTrendID);
					        	//$(".list-group-item").removeClass("bgGray");
					        }
					        
					        
					 });
					 
					 $(".showTrendby").on('ifClicked', function (event) {
						 	
						 	//alert(this.id);
						 	var paramTrendID=this.id.split("-");
						 	paramTrendID=paramTrendID[1];
						 	
					        if(this.value=='showbyPointName'){
					 
					        	$(".pointName-"+paramTrendID+"").show();
					        	$(".pointTag-"+paramTrendID+"").hide();
					        	//callServiceGetPointByTrend('100','1','04',$("#paramFromDate").val(),$("#paramToDate").val(),"showByPointName");
					        	
					        	
					        }else{
					        	$(".pointName-"+paramTrendID+"").hide();
					        	$(".pointTag-"+paramTrendID+"").show();
					        	//callServiceGetPointByTrend('100','1','04',$("#paramFromDate").val(),$("#paramToDate").val(),"showByTagName");
					        	
					        }
					        
					        
					 });

					//radio end
					 
					//focus expand start
					 var seek=3;
					 //var seek="";
					 	$("#focus-"+paramTrendID+"").click(function(){
					 		
					 		//alert(paramTrendID);
					 		
					 		if(seek>=0){
					 			
					 			if(seek<=0){
					 				seek=0;
					 			}else{
					 				seek=seek-1;
					 			}
					 			//alert(rangHour[seek]+","+seek);
					 			$("#expandFocus-"+paramTrendID+"").val(rangHour[seek]+" Hour");
					 			$("#scaleTimeMenuLeftArea-"+paramTrendID+"").text(rangHour[seek]+" Hour");
					 			slideScaleFn(paramTrendID,rangHour[seek]);
					 			//readJsonExpandFocusFn(rangHour[seek],paramTrendID);
					 		}
					 		
					 		
					 	});
					 	$("#expand-"+paramTrendID+"").click(function(){
					 		//alert(rangHour.length);
					 		
					 		if(seek<rangHour.length){
					 			
					 			
					 			
					 			if(seek>=9){
					 				seek=9;
					 			}else{
					 				seek=seek+1;
					 			}
					 			//alert(rangHour[seek]+","+seek);
					 			$("#expandFocus-"+paramTrendID+"").val(rangHour[seek]+" Hour");
					 			$("#scaleTimeMenuLeftArea-"+paramTrendID+"").text(rangHour[seek]+" Hour");
					 			slideScaleFn(paramTrendID,rangHour[seek]);
					 			//readJsonExpandFocusFn(rangHour[seek],paramTrendID);
					 		}
					 	});
					 //focus expand end
					 	
					 	
					 	
					 	
						
					 var startTimeDisplay=0;
					//reduce start time start
					$("#reduceStartTime-"+paramTrendID+"").click(function(){
						startTimeDisplay=startTimeDisplay-1;
						//alert(startTimeDisplay);
						readJsonReduceStartTimeDisplayFn(startTimeDisplay,paramTrendID);
						
					});
					
					
			
					//reduce start time end
					
					//increase start time start
					$("#increaseStartTime-"+paramTrendID+"").click(function(){
						startTimeDisplay=startTimeDisplay+1;
						//alert(startTimeDisplay);
						readJsonIncreaseStartTimeDisplayFn(startTimeDisplay,paramTrendID);
						
					});
					
					//increase start time start
					
					
					//reduce start day start
					 var startDayDisplay=0;
					$("#reduceDay-"+paramTrendID+"").click(function(){
						startDayDisplay=startDayDisplay-1;
						readJsonReduceDayDisplayFn(startDayDisplay,paramTrendID);
					});
					
					//reduce start day end
					
					
					//increase start day start
					$("#increaseDay-"+paramTrendID+"").click(function(){
						startDayDisplay=startDayDisplay+1;
						readJsonIncreaseDayDisplayFn(startDayDisplay,paramTrendID);
					});
					
					//increase start day end
					
					//slider start
					slideScaleFn(paramTrendID,'4','Y');
					//slider end
					
					
					
					
					//EDIT POINT START
					$(".editTrendPoint").off("click");
					$(".editTrendPoint").on("click",function(){
						
					
						var paramTrendName=$("#paramTrendNameEmbed").val();
						var paramUnit=$("#paramUnitEmbed").val();
						var paramTrendID=$("#trendTabActive").val();
						
						$("#editTrendName").html(paramTrendName);
						//editUnit
						//check selected option
						var val1 =paramUnit;
						$("select#editUnit option").filter(function() {
						    return $(this).val() == val1; 
						}).prop('selected', true);
					
					 	//$("#editUnit").kendoDropDownList();

						editTrendPointFn(paramTrendID,paramUnit);

						var paramPointId=getDataFromPointEmbed("pointId");
						paramPointId=paramPointId.split(",");
						for(var i=0;i<paramPointId.length;i++){
							//alert(paramPointId[i]);
							pointCheckbox(paramPointId[i]);
						}
						
						
						$("select#editUnit").change(function(){
							editTrendPointFn(paramTrendID,$(this).val());
							
							 $("#paramUnitEmbed-"+paramTrendID+"").remove();
							  var paramUnit="";
							  paramUnit+="<input type='hidden' id='paramUnitEmbed-"+paramTrendID+"' name='paramUnitEmbed-"+paramTrendID+"' value='"+$(this).val()+"'>";
							  $("body").append(paramUnit);
							  
							
						});
						
						
						
						 $("#btnEditPlotGraph").off("click");
						 $("#btnEditPlotGraph").click(function(){
							  // plotGraphFn();
							  // plotGraphFn('Initial','N',$("#paramTrendIDEmbed").val());
							 var paramTrendID = $("#trendTabActive").val();
							 var scale = parseInt($("#scaleTimeMenuLeftArea-"+$("#trendTabActive").val()+"").text());
							  $(".paramPointEmbed-"+paramTrendID+"").remove();
							  
							  //embed point start
							  //var pointChecked = $('input[name=point]:checked');
							  var pointChecked = $(".trend-"+paramTrendID+":checked");
							  console.log(pointChecked);
							  var point="";
							  $.each(pointChecked,function(index,indexEntry){
								 //console.log($(indexEntry).val()); 
								 
								  if(index==0){
										point+="D"+$(indexEntry).val();
									}else{
										point+=",D"+$(indexEntry).val();
									}
							  }); 
							  //alert("2-"+paramTrendID);
							 // alert(point);
							  
							  var paramPoint="";
							  paramPoint+="<input type='hidden' class='paramPointEmbed-"+paramTrendID+"' id='paramPointEmbed-"+paramTrendID+"' name='paramPointEmbed-"+paramTrendID+"' value='"+point+"'>";
							  paramPoint+="<input type='hidden' class='paramPointEmbed-"+paramTrendID+"' id='paramPointAllEmbed-"+paramTrendID+"' name='paramPointAllEmbed-"+paramTrendID+"' value='"+point+"'>";
							  $("body").append(paramPoint);
							  //embed point start
							  var pointId =getDataFromPointEmbed("pointId");
							  callDataLayoutPointRight(pointId,paramTrendID);
							  //alert(scale);
							  slideScaleFn(paramTrendID,scale); 
							  
							  $('#editTrendPointModal').modal('hide');
							  
						 });
						 
						
						
					});
					//EDIT POINT END
					
					 
		}
//});
//}