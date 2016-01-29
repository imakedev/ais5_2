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
    htmlTableGridEvent +="<tbody>";
    
    	$.each(data,function(index,indexEntry){
    		//alert(indexEntry['sys_date']);
    		//alert(indexEntry['ois_event']);
    		
    		 htmlTableGridEvent +="<tr>";
    		 	htmlTableGridEvent +="<td>"+indexEntry['ois_event']+"</td>";
             htmlTableGridEvent +=" </tr>";
    		
    	});
       
     
   htmlTableGridEvent +=" </tbody>";
htmlTableGridEvent +="</table>";
	$("#gridFgdArea").html(htmlTableGridEvent);
	//$("#gridEventList")
};
var logicPointFgd = {
		
		pointClearTripRedFn(){
			clearTripRedFn((tripFnRed));
		},
		pointClearTripGreenFn(){
			clearTripGreenFn((tripFnGreen));
		},
		setDateTime(EvTime){
			
			$("#disPlayDateTimeArea").html(EvTime);	
			
		},
		point0(paramDataPoint){
			
			$("#point0").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
		},
		point1(paramDataPoint){
			
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
			
		},
		point11(paramDataPoint){
			
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
			
		}
}




function setDataOnDashboardFgd(data){
	
	logicPointFgd.setDateTime("<center><b>ข้อมูลวันที่ "+convertDateHisTh(data['EvTime'])+"</b></center>");
	
	logicPointFgd.pointClearTripRedFn();
	logicPointFgd.pointClearTripGreenFn();
	logicPointFgd.point0(data['D32']);
	logicPointFgd.point1(data['D276']);
	logicPointFgd.point2(data['D220']);
	logicPointFgd.point3(data['D1']);
	logicPointFgd.point4(data['D219']);
	logicPointFgd.point5(data['D285']);
	logicPointFgd.point6(data['D284']);
	logicPointFgd.point7(data['D1']);
	logicPointFgd.point8(data['D1']);
	logicPointFgd.point9(data['D362']);
	logicPointFgd.point10(data['D1']);
	logicPointFgd.point11(data['D355']);
	logicPointFgd.point12(data['D365']);
	logicPointFgd.point13(data['D357']);
	logicPointFgd.point14(data['D1']);
	logicPointFgd.point15(data['D358']);
	logicPointFgd.point16(data['D354']);
	logicPointFgd.point17(data['D359']);
	logicPointFgd.point18(data['D360']);
	logicPointFgd.point19(data['D361']);
	logicPointFgd.point20(data['D1']);
	logicPointFgd.point21(data['D363']);

	
	
}	
var fgd={
		//alert("hello jquery");
		disPlayDateTimeFn(paramDate){
			
			$("#disPlayDateTimeArea").html("<center><b>ข้อมูลวันที่  "+convertDateHisTh(paramDate+" 00:00:00")+"</b></center>");

		},
		readDataEventPCVFn(paramPcv,paramUnit,paramEmpId){
			 var jsonFilter = new Array();
			$.ajax({
				url:"/ais/processView/readDataEventPCVFGD/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"",
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
			// TEST->http://localhost:9999/ais/processView/readDataPCVFGD/FGD/4/3
			$.ajax({
				url:"/ais/processView/readDataPCVFGD/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"",
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
							setDataOnDashboardFgd(indexEntry);
							
						}
					});
				}else{
					
					var paramMax=data.length;
					var paramStart=data.length;
					var lastObject=data;
					lastObject = lastObject.pop();
					slideFucusExpressFn(paramStart,paramMax);
					setDataOnDashboardFgd(lastObject);
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
				url:"/ais/processView/createDataPCVFGD/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"/"+paramFromDate+"/"+paramToDate+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					
					if(data=='createJsonSuccess'){
						
						fgd.readDataPCVFn(paramPcv,paramUnit,paramEmpId,'');
						
					}
					console.log(data);
					
					//setDataOnDashboardFgd(data[0]);
				}
			});
			
			
		},
		createDataEventPCVFn(paramPcv,paramUnit,paramEmpId,paramFromDate,paramToDate){
			
			
			//{paramPCV}/{paramUnit}/{parmEmpId}/{paramFromDate}/{paramToDate}
			
			
			$.ajax({
				url:"/ais/processView/createDataEventPCVFGD/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"/"+paramFromDate+"/"+paramToDate+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					
					if(data=='createJsonSuccess'){
						
						//fgd.readDataPCVFGDFn(paramPcv,paramUnit,paramEmpId,'');
						 fgd.readDataEventPCVFn(paramPcv,paramUnit,paramEmpId);
						
					}
					console.log(data);
					
					//setDataOnDashboardFgd(data[0]);
				}
			});
			
			
		}
		
		
		
		
	}	
var mainFGDFn = function(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate){

//test read processViewJson-FGD-4-3.txt
fgd.createDataPCVFn(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate);	


fgd.createDataEventPCVFn(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate);


fgd.disPlayDateTimeFn(paramToDate);

}