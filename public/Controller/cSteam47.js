

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
    htmlTableGridEvent +="<tbody id='gridSteam47DataArea'>";
    
    	$.each(data,function(index,indexEntry){
    		//alert(indexEntry['sys_date']);
    		//alert(indexEntry['ois_event']);
    		
    		 htmlTableGridEvent +="<tr>";
    		 	htmlTableGridEvent +="<td>"+indexEntry['ois_event']+"</td>";
             htmlTableGridEvent +=" </tr>";
    		
    	});
       
     
   htmlTableGridEvent +=" </tbody>";
htmlTableGridEvent +="</table>";
	$("#gridSteam47Area").html(htmlTableGridEvent);
	//$("#gridEventList")
};
var logicPointSteam47 = {
		
		pointClearTripRedFn(){
			clearTripRedFn((tripFnRed));
		},
		pointClearTripGreenFn(){
			clearTripGreenFn((tripFnGreen));
		},
		
		setDateTime(EvTime){
			
			$("#disPlayDateTimeArea").html(EvTime);	
			
		},point0(paramDataPoint){
			
			$("#point0").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		
		},point1(paramDataPoint){
			
			$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		
		},point2(paramDataPoint){
		
			$("#point2").html("<font class='displaynone' color='red'>2,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point3(paramDataPoint){
			
			$("#point3").html("<font class='displaynone' color='red'>3,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point4(paramDataPoint){
			
			$("#point4").html("<font class='displaynone' color='red'>4,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point5(paramDataPoint){
			
			$("#point5").html("<font class='displaynone' color='red'>5,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point6(paramDataPoint){
			
			$("#point6").html("<font class='displaynone' color='red'>6,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
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
			
			$("#point17").html("<font class='displaynone' color='red'>17,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point18(paramDataPoint){
			
			$("#point18").html("<font class='displaynone' color='red'>18,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point19(paramDataPoint){
			
			$("#point19").html("<font class='displaynone' color='red'>19,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point20(paramDataPoint){
			
			$("#point20").html("<font class='displaynone' color='red'>20,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point21(paramDataPoint){
			
			$("#point21").html("<font class='displaynone' color='red'>21,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point22(paramDataPoint){
			
			$("#point22").html("<font class='displaynone' color='red'>22,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point23(paramDataPoint){
			
			$("#point23").html("<font class='displaynone' color='red'>23,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point24(paramDataPoint){
			
			$("#point24").html("<font class='displaynone' color='red'>24,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point25(paramDataPoint){
			
			$("#point25").html("<font class='displaynone' color='red'>25,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point26(paramDataPoint){
			
			$("#point26").html("<font class='displaynone' color='red'>26,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point27(paramDataPoint){
			
			$("#point27").html("<font class='displaynone' color='red'>27,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point28(paramDataPoint){
			
			$("#point28").html("<font class='displaynone' color='red'>28,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point29(paramDataPoint){
			
			$("#point29").html("<font class='displaynone' color='red'>29,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point30(paramDataPoint){
			
			$("#point30").html("<font class='displaynone' color='red'>30,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point31(paramDataPoint){
			
			$("#point31").html("<font class='displaynone' color='red'>31,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point32(paramDataPoint){
			
			$("#point32").html("<font class='displaynone' color='red'>32,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point33(paramDataPoint){
			
			$("#point33").html("<font class='displaynone' color='red'>33,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		}
}




function setDataOnDashboardStream47(data){
	
	logicPointSteam47.setDateTime("<center><b>ข้อมูลวันที่ "+convertDateHisTh(data['EvTime'])+"</b></center>");
	logicPointSteam47.pointClearTripRedFn();
	logicPointSteam47.pointClearTripGreenFn();
	logicPointSteam47.point0(data['D32']);
	logicPointSteam47.point1(data['D260']);
	logicPointSteam47.point2(data['D267']);
	logicPointSteam47.point3(data['D98']);
	logicPointSteam47.point4(data['D99']);
	logicPointSteam47.point5(data['D101']);
	logicPointSteam47.point6(data['D105']);
	logicPointSteam47.point7(data['D107']);
	logicPointSteam47.point8(data['D103']);
	logicPointSteam47.point9(data['D96']);
	logicPointSteam47.point10(data['D93']);
	logicPointSteam47.point11(data['D109']);
	logicPointSteam47.point12(data['D108']);
	logicPointSteam47.point13(data['D55']);
	logicPointSteam47.point14(data['D56']);
	logicPointSteam47.point15(data['D52']);
	logicPointSteam47.point16(data['D119']);
	logicPointSteam47.point17(data['D54']);
	logicPointSteam47.point18(data['D53']);
	logicPointSteam47.point19(data['D218']);
	logicPointSteam47.point20(data['D282']);
	logicPointSteam47.point21(data['D114']);
	logicPointSteam47.point22(data['D113']);
	logicPointSteam47.point23(data['D112']);
	logicPointSteam47.point24(data['D115']);
	logicPointSteam47.point25(data['D116']);
	logicPointSteam47.point26(data['D117']);
	logicPointSteam47.point27(data['D118']);
	logicPointSteam47.point28(data['D273']);
	logicPointSteam47.point29(data['D1']);
	logicPointSteam47.point30(data['D107']);
	logicPointSteam47.point31(data['D106']);
	logicPointSteam47.point32(data['D111']);
	logicPointSteam47.point33(data['D110']);

	
	
}	
var stream47={
		//alert("hello jquery");
		disPlayDateTimeFn(paramDate){
			
			$("#disPlayDateTimeArea").html("<center><b>ข้อมูลวันที่  "+convertDateHisTh(paramDate+" 00:00:00")+"</b></center>");

		},
		readDataEventPCVFn(paramPcv,paramUnit,paramEmpId){
			 var jsonFilter = new Array();
			$.ajax({
				url:"/ais/processView/readDataEventPCVSteam47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"",
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
			// TEST->http://localhost:9999/ais/processView/readDataPCVSteam47/steam47/4/3
			$.ajax({
				url:"/ais/processView/readDataPCVSteam47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
				//console.log(data);
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
							setDataOnDashboardStream47(indexEntry);
							
						}
					});
				}else{
					
					var paramMax=data.length;
					var paramStart=data.length;
					var lastObject=data;
					lastObject = lastObject.pop();
					slideFucusExpressFn(paramStart,paramMax);
					setDataOnDashboardStream47(lastObject);
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
				url:"/ais/processView/createDataPCVSteam47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"/"+paramFromDate+"/"+paramToDate+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					
					if(data=='createJsonSuccess'){
						
						stream47.readDataPCVFn(paramPcv,paramUnit,paramEmpId,'');
						
					}
					console.log(data);
					
					//setDataOnDashboardStream47(data[0]);
				}
			});
			
			
		},
		createDataEventPCVFn(paramPcv,paramUnit,paramEmpId,paramFromDate,paramToDate){
			
			
			//{paramPCV}/{paramUnit}/{parmEmpId}/{paramFromDate}/{paramToDate}
			
			
			$.ajax({
				url:"/ais/processView/createDataEventPCVSteam47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"/"+paramFromDate+"/"+paramToDate+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					
					if(data=='createJsonSuccess'){
						
						//stream47.readDataPCVSteam47Fn(paramPcv,paramUnit,paramEmpId,'');
						 stream47.readDataEventPCVFn(paramPcv,paramUnit,paramEmpId);
						
					}
					console.log(data);
					
					//setDataOnDashboardStream47(data[0]);
				}
			});
			
			
		}
		
		
		
		
	}	
var mainSteam47Fn = function(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate){

//test read processViewJson-steam47-4-3.txt
stream47.createDataPCVFn(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate);	


stream47.createDataEventPCVFn(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate);


stream47.disPlayDateTimeFn(paramToDate);

}