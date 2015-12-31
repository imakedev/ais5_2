var createHtmlForGridEventFn = function(data){
	var htmlTableGridEvent="";
	htmlTableGridEvent +="<table id=\"gridEventList\">";
    htmlTableGridEvent +="<colgroup>";
        htmlTableGridEvent +="<col style=\"width:100%\"/>";
    htmlTableGridEvent +="</colgroup>";
    htmlTableGridEvent +="<thead>";
       htmlTableGridEvent +=" <tr>";
            htmlTableGridEvent +="<th data-field=\"field1\"><b>Event</b></th>";
        htmlTableGridEvent +="</tr>";
  htmlTableGridEvent +="  </thead>";
    htmlTableGridEvent +="<tbody id='gridPlantow47DataArea'>";
    
    	$.each(data,function(index,indexEntry){
    		//alert(indexEntry['sys_date']);
    		//alert(indexEntry['ois_event']);
    		
    		 htmlTableGridEvent +="<tr>";
    		 	htmlTableGridEvent +="<td>"+indexEntry['ois_event']+"</td>";
             htmlTableGridEvent +=" </tr>";
    		
    	});
       
     
   htmlTableGridEvent +=" </tbody>";
htmlTableGridEvent +="</table>";
	$("#gridPlantow47Area").html(htmlTableGridEvent);
	//$("#gridEventList")
};

var tripFnRed1="";
var tripFnGreen1="";
function tripFn1(pramTrip){
	$("#paramEmbedTripFn1").remove();
	$("#paramTripArea").append("<input type='hidden' id='paramEmbedTripFn1' class='paramTripAlarmEmbed' value='"+pramTrip+"'>");
	
	//alert(pramTrip);
	//$("#point1").css({"color":"red"});
		if(pramTrip!="N"){
			clearTimeout(tripFnRed1);
			clearTimeout(tripFnGreen1);
			
			tripFnRed1= setTimeout(function(){
				console.log("trip=red");
				$("#point1").css({"color":"#ff0000"});
			},1000);
			 tripFnGreen1= setTimeout(function(){
				$("#point1").css({"color":"#00ff00"});
				console.log("trip=green");
				tripFn1($("#paramEmbedTripFn1").val());
				
				
			},2000);
			 
			 
		}else{
			
			clearTimeout(tripFnRed1);
			clearTimeout(tripFnGreen1);
		 
		
		}
	
	
}
function tripFn2(){
	//$("#point1").css({"color":"red"});
	var tripFnRed="";
	var tripFnGreen="";
	tripFnRed=setTimeout(function(){
		console.log("trip=red");
		$("#point17").css({"color":"#ff0000"});
	},1000);
	tripFnGreen=setTimeout(function(){
		$("#point17").css({"color":"#00ff00"});
		console.log("trip=green");
		tripFn2();
		clearTimeout(tripFnRed);
		clearTimeout(tripFnGreen);
	},2000);
	
	
}
var tripFnRed5="";
var tripFnGreen5="";
function tripFn5(pramTrip){
	//$("#point1").css({"color":"red"});
	$("#paramEmbedTripFn5").remove();
	$("#paramTripArea").append("<input type='hidden' id='paramEmbedTripFn5' class='paramTripAlarmEmbed' value='"+pramTrip+"'>");
	
	
	if(pramTrip!="N"){
		clearTimeout(tripFnRed5);
		clearTimeout(tripFnGreen5);
		tripFnRed5=tripFnRed=setTimeout(function(){
			console.log("trip=red");
			$("#point5").css({"color":"#ff0000"});
		},1000);
		tripFnGreen5=tripFnGreen=setTimeout(function(){
			$("#point5").css({"color":"#00ff00"});
			console.log("trip=green");
			
			//clearTimeout(tripFnRed5);
			//clearTimeout(tripFnGreen5);
			tripFn5($("#paramEmbedTripFn5").val());
			//clearTimeout(tripFnRed);
			//clearTimeout(tripFnGreen);
			
		},2000);
		
		
	}else{
		
		clearTimeout(tripFnRed);
		clearTimeout(tripFnGreen);

	}
	
	
	
}
function tripFn6(){
	//$("#point1").css({"color":"red"});
	var tripFnRed="";
	var tripFnGreen="";
	tripFnRed=setTimeout(function(){
		console.log("trip=red");
		$("#point6").css({"color":"#ff0000"});
	},1000);
	tripFnGreen=setTimeout(function(){
		$("#point6").css({"color":"#00ff00"});
		console.log("trip=green");
		tripFn6();
		clearTimeout(tripFnRed);
		clearTimeout(tripFnGreen);
	},2000);
	
}
function tripFn23(){
	//$("#point1").css({"color":"red"});
	var tripFnRed="";
	var tripFnGreen="";
	tripFnRed= setTimeout(function(){
		console.log("trip=red");
		$("#point23").css({"color":"#ff0000"});
	},1000);
	tripFnGreen=setTimeout(function(){
		$("#point23").css({"color":"#00ff00"});
		console.log("trip=green");
		tripFn23();
		clearTimeout(tripFnRed);
		clearTimeout(tripFnGreen);
	},2000);
	
}
//tripFn();
var countLogicPoint=0;
var logicPointPlantow47 = {
		
		
		
		setDateTime(EvTime){
			
			$("#disPlayDateTimeArea").html(EvTime);	
			
		},
		point1(paramDataPoint){
			if(parseFloat(paramDataPoint).toFixed(2)< 1){
				
				$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				tripFn1("Y");
			
			}else{
				tripFn1("N");
				$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			}
		
		},point2(paramDataPoint){
		
			$("#point2").html("<font class='displaynone' color='red'>2,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point3(paramDataPoint){
			
			$("#point3").html("<font class='displaynone' color='red'>3,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point4(paramDataPoint){
			
			$("#point4").html("<font class='displaynone' color='red'>4,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point5(paramDataPoint){
			
			if(parseFloat(paramDataPoint).toFixed(2)< 1.5){
				
				$("#point5").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				
				tripFn5("Y");
				
			}else{
				tripFn5("N");
				$("#point5").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			}	
			
			//$("#point5").html("<font class='displaynone' color='red'>5,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point6(paramDataPoint){
			
			if(parseFloat(paramDataPoint).toFixed(2)< 6){
				
				$("#point6").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				
				//tripFn6();
				
			}else{
			$("#point6").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			}

			//$("#point6").html("<font class='displaynone' color='red'>6,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point7(paramDataPoint){
			
			$("#point7").html("<font class='displaynone' color='red'>7,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point8(paramDataPoint){
			
			$("#point8").html("<font class='displaynone' color='red'>8,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
			
		},point9(paramDataPoint){
			
			$("#point9").html("<font class='displaynone' color='red'>9,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point10(paramDataPoint){
			
			$("#point10").html("<font class='displaynone' color='red'>10,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point11(paramDataPoint){
			
			$("#point11").html("<font class='displaynone' color='red'>11,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point12(paramDataPoint){
			
			$("#point12").html("<font class='displaynone' color='red'>12,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point13(paramDataPoint){
			
			$("#point13").html("<font class='displaynone' color='red'>13,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point14(paramDataPoint){
			
			$("#point14").html("<font class='displaynone' color='red'>14,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point15(paramDataPoint){
			
			$("#point15").html("<font class='displaynone' color='red'>15,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point16(paramDataPoint){
			
			$("#point16").html("<font class='displaynone' color='red'>16,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point17(paramDataPoint){
			
			if(parseFloat(paramDataPoint).toFixed(2)< 50){
				
			$("#point17").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
				//tripFn2();
				
			}else{
			$("#point17").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			}
			
			//$("#point17").html("<font class='displaynone' color='red'>17,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point18(paramDataPoint){
			
			$("#point18").html("<font class='displaynone' color='red'>18,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point19(paramDataPoint){
			
			$("#point19").html("<font class='displaynone' color='red'>19,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point20(paramDataPoint){
			
			$("#point20").html("<font class='displaynone' color='red'>20,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},
		point21(paramDataPoint){
			
			$("#point21").html("<font class='displaynone' color='red'>21,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		
		},point22(paramDataPoint){
		
			$("#point22").html("<font class='displaynone' color='red'>22,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point23(paramDataPoint){
			
			if(parseFloat(paramDataPoint).toFixed(2)<70){
				
				$("#point23").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				
				//tripFn23();
				
			}else{
			$("#point23").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			}

			//$("#point23").html("<font class='displaynone' color='red'>23,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point24(paramDataPoint){
			
			$("#point24").html("<font class='displaynone' color='red'>24,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point25(paramDataPoint){
			
			$("#point25").html("<font class='displaynone' color='red'>25,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point26(paramDataPoint){
			
			$("#point26").html("<font class='displaynone' color='red'>26,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point27(paramDataPoint){
			
			$("#point27").html("<font class='displaynone' color='red'>27,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point28(paramDataPoint){
			
			//$("#point28").html("<font class='displaynone' color='red'>28,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
			
		},point29(paramDataPoint){
			
			//$("#point29").html("<font class='displaynone' color='red'>29,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point30(paramDataPoint){
			
			//$("#point30").html("<font class='displaynone' color='red'>30,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point31(paramDataPoint){
			
			//$("#point31").html("<font class='displaynone' color='red'>31,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point32(paramDataPoint){
			
			//$("#point32").html("<font class='displaynone' color='red'>32,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point33(paramDataPoint){
			
			$("#point33").html("<font class='displaynone' color='red'>33,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point34(paramDataPoint){
			
			$("#point34").html("<font class='displaynone' color='red'>34,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point35(paramDataPoint){
			
			$("#point35").html("<font class='displaynone' color='red'>35,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point36(paramDataPoint){
			
			$("#point36").html("<font class='displaynone' color='red'>36,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point37(paramDataPoint){
			
			$("#point37").html("<font class='displaynone' color='red'>37,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point38(paramDataPoint){
			
			$("#point38").html("<font class='displaynone' color='red'>38,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point39(paramDataPoint){
			
			$("#point39").html("<font class='displaynone' color='red'>39,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point40(paramDataPoint){
			
			$("#point40").html("<font class='displaynone' color='red'>40,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point41(paramDataPoint){
			
			$("#point41").html("<font class='displaynone' color='red'>41,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point42(paramDataPoint){
			
			$("#point42").html("<font class='displaynone' color='red'>42,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point43(paramDataPoint){
			
			$("#point43").html("<font class='displaynone' color='red'>43,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point44(paramDataPoint){
			
			$("#point44").html("<font class='displaynone' color='red'>44,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point45(paramDataPoint){
			
			$("#point45").html("<font class='displaynone' color='red'>45,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		}
}




function setDataOnDashboardPlantow47(data){
	
	logicPointPlantow47.setDateTime("<center><b>ข้อมูลวันที่ "+convertDateHisTh(data['EvTime'])+"</b></center>");
	logicPointPlantow47.point1(data['D1']);
	logicPointPlantow47.point2(data['D2']);
	logicPointPlantow47.point3(data['D3']);
	logicPointPlantow47.point4(data['D4']);
	logicPointPlantow47.point5(data['D5']);
	logicPointPlantow47.point6(data['D6']);
	logicPointPlantow47.point7(data['D7']);
	logicPointPlantow47.point8(data['D8']);
	logicPointPlantow47.point9(data['D9']);
	logicPointPlantow47.point10(data['D10']);
	
	logicPointPlantow47.point11(data['D11']);
	logicPointPlantow47.point12(data['D12']);
	logicPointPlantow47.point13(data['D13']);
	logicPointPlantow47.point14(data['D14']);
	logicPointPlantow47.point15(data['D15']);
	logicPointPlantow47.point16(data['D16']);
	logicPointPlantow47.point17(data['D17']);
	logicPointPlantow47.point18(data['D18']);
	logicPointPlantow47.point19(data['D19']);
	logicPointPlantow47.point20(data['D20']);
	
	logicPointPlantow47.point21(data['D21']);
	logicPointPlantow47.point22(data['D22']);
	logicPointPlantow47.point23(data['D23']);
	logicPointPlantow47.point24(data['D24']);
	logicPointPlantow47.point25(data['D25']);
	logicPointPlantow47.point26(data['D26']);
	logicPointPlantow47.point27(data['D27']);
	logicPointPlantow47.point28(data['D28']);
	logicPointPlantow47.point29(data['D29']);
	logicPointPlantow47.point30(data['D30']);
	
	logicPointPlantow47.point31(data['D31']);
	logicPointPlantow47.point32(data['D32']);
	logicPointPlantow47.point33(data['D33']);
	logicPointPlantow47.point34(data['D34']);
	logicPointPlantow47.point35(data['D35']);
	logicPointPlantow47.point36(data['D36']);
	logicPointPlantow47.point37(data['D37']);
	logicPointPlantow47.point38(data['D38']);
	logicPointPlantow47.point39(data['D39']);
	logicPointPlantow47.point40(data['D40']);
	
	logicPointPlantow47.point41(data['D41']);
	logicPointPlantow47.point42(data['D42']);
	logicPointPlantow47.point43(data['D43']);
	logicPointPlantow47.point44(data['D44']);
	logicPointPlantow47.point45(data['D45']);

	
	
}	
var plantow47={
		//alert("hello jquery");
		disPlayDateTimeFn(paramDate){
			
			$("#disPlayDateTimeArea").html("<center><b>ข้อมูลวันที่  "+convertDateHisTh(paramDate+" 00:00:00")+"</b></center>");

		},
		readDataEventPCVFn(paramPcv,paramUnit,paramEmpId){
			 var jsonFilter = new Array();
			$.ajax({
				url:"/ais/processView/readDataEventPCVPlantow47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					console.log(data);
					
					var paramSpanTime = (parseInt($("#paramSpanTimeEmbed").val())/2);
					var paramFromDate2=intervalDelFn($("#paramToDateEmbed").val(),'minute',paramSpanTime);
					var paramToDate2=intervalAddFn($("#paramToDateEmbed").val(),'minute',paramSpanTime);
					/*
					alert(paramSpanTime);
					alert(paramFromDate2);
					alert(paramToDate2);
					*/
					$.each(data,function(index,indexEntry){
						//Test start
						paramFromDate2='2014-05-01 00:00:00';
						paramToDate2='2014-05-01 02:00:00'
						//Test End
						if((toTimestamp(indexEntry['sys_date'])>=toTimestamp(paramFromDate2)) && (toTimestamp(indexEntry['sys_date'])<=toTimestamp(paramToDate2))) {
							jsonFilter.push(indexEntry);
							//console.log(indexEntry);
							
						}
						
					});
					console.log("jsonFilter");
					console.log(jsonFilter);
					
					createHtmlForGridEventFn(jsonFilter);
					bindingGridlistEventFn();
					
				}
			});
		},
		readDataPCVFn(paramPcv,paramUnit,paramEmpId,paramIndexDate){
			//alert(paramIndexDate);
			var jsonFilter = new Array();
			/*
			alert(paramPcv);
			alert(paramUnit);
			alert(parmEmpId);
			alert(paramIndexDate);
			*/
			// TEST->http://localhost:9999/ais/processView/readDataPCVPlantow47/Plantow47/4/3
			$.ajax({
				url:"/ais/processView/readDataPCVPlantow47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					
				if(data==''){
					alert('data is empty');
					return false;
				}
					
				if((paramIndexDate!="") && (paramIndexDate!=undefined)){
					//console.log("--1");
					//console.log(parseInt(paramIndexDate));
					var paramMax=data.length;
					var paramStart=data.length;
					//console.log("--2"+data.length);
					
					$.each(data,function(index,indexEntry){
							//console.log(index+"="+(parseInt(paramIndexDate)-1));
						if(index==(parseInt(paramIndexDate)-1)){
							//slideFucusExpressFn(paramIndexDate,paramMax);
							//console.log("--2");
							console.log(indexEntry);
							setDataOnDashboardPlantow47(indexEntry);
							
						}
					});
				}else{
					
					var paramMax=data.length;
					var paramStart=data.length;
					var lastObject=data;
					lastObject = lastObject.pop();
					slideFucusExpressFn(paramStart,paramMax);
					setDataOnDashboardPlantow47(lastObject);
				}
					/*
					$.each(data,function(index,indexEntry){
						
						if(toTimestamp(indexEntry['EvTime'])==toTimestamp(lastObject['EvTime'])) {
							jsonFilter.push(indexEntry);
							//console.log(indexEntry);
							
						}
						
					});
					*/
					
				}
			 //console.log(jsonFilter);
			});

		},
		createDataPCVFn(paramPcv,paramUnit,paramEmpId,paramFromDate,paramToDate){
			/*
			alert(paramPcv);
			alert(paramUnit);
			alert(parmEmpId);
			alert(paramFromDate);
			alert(paramToDate);
			*/
			
			//{paramPCV}/{paramUnit}/{parmEmpId}/{paramFromDate}/{paramToDate}
			
			
			$.ajax({
				url:"/ais/processView/createDataPCVPlantow47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"/"+paramFromDate+"/"+paramToDate+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					
					if(data=='createJsonSuccess'){
						
						plantow47.readDataPCVFn(paramPcv,paramUnit,paramEmpId,'');
						
					}
					console.log(data);
					
					//setDataOnDashboardPlantow47(data[0]);
				}
			});
			
			
		},
		createDataEventPCVFn(paramPcv,paramUnit,paramEmpId,paramFromDate,paramToDate){
			
			
			//{paramPCV}/{paramUnit}/{parmEmpId}/{paramFromDate}/{paramToDate}
			
			
			$.ajax({
				url:"/ais/processView/createDataEventPCVPlantow47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"/"+paramFromDate+"/"+paramToDate+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					
					if(data=='createJsonSuccess'){
						
						//plantow47.readDataPCVPlantow47Fn(paramPcv,paramUnit,paramEmpId,'');
						plantow47.readDataEventPCVFn(paramPcv,paramUnit,paramEmpId);
						
					}
					console.log(data);
					
					//setDataOnDashboardPlantow47(data[0]);
				}
			});
			
			
		}
		
		
		
		
	}	
//plantow47
var mainPlantow47Fn = function(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate){

//test read processViewJson-Plantow47-4-3.txt
	plantow47.createDataPCVFn(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate);	


	plantow47.createDataEventPCVFn(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate);


	plantow47.disPlayDateTimeFn(paramToDate);

}