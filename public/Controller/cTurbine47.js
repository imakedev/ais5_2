
var getPointPlanTown = function(data){
	var point="";
	var pointList="";
	$.each(data,function(index,indexEntry){
		//console.log(indexEntry);
		point= indexEntry.split(",");
		point=point[1];
		
		if(index==0){
			pointList+=""+point+"";
		}else{
			pointList+=","+point+"";
		}
		
		
	});
	//console.log("--- pointListPlanTown4 ---");
	return pointList;
}
//console.log(getPointPlanTown(planTown4));




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
    htmlTableGridEvent +="<tbody id='gridTurbine47DataArea'>";
    
    	$.each(data,function(index,indexEntry){
    		//alert(indexEntry['sys_date']);
    		//alert(indexEntry['ois_event']);
    		
    		 htmlTableGridEvent +="<tr>";
    		 	htmlTableGridEvent +="<td>"+indexEntry['ois_event']+"</td>";
             htmlTableGridEvent +=" </tr>";
    		
    	});
       
     
   htmlTableGridEvent +=" </tbody>";
htmlTableGridEvent +="</table>";
	$("#gridTurbine47Area").html(htmlTableGridEvent);
	//$("#gridEventList")
};






var countLogicPoint=0;
var logicPointTurbine47 = {
		
		
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
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 75) ||(parseFloat(paramDataPoint).toFixed(2)> 115)){
				//$("#point1").hml("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				//alert("trip point1");
				tripFn("Y",0);
			}else{
				tripFn("N",0);
			}
			/*logic trip point end*/
			
				$("#point0").html(parseFloat(paramDataPoint).toFixed(2));	
		
		},
		point1(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 75) ||(parseFloat(paramDataPoint).toFixed(2)> 115)){
				//$("#point1").hml("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				//alert("trip point1");
				tripFn("Y",1);
			}else{
				tripFn("N",1);
			}
			/*logic trip point end*/
			
				$("#point1").html(parseFloat(paramDataPoint).toFixed(2));	
		
		},point2(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 105) ||(parseFloat(paramDataPoint).toFixed(2)>300)){
				//$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				tripFn("Y",2);
			}else{
				tripFn("N",2);
			}
			/*logic trip point end*/
			$("#point2").html("<font class='displaynone' color='red'>2,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point3(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -1) ||(parseFloat(paramDataPoint).toFixed(2)> 2)){
				//$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				tripFn("Y",3);
			}else{
				tripFn("N",3);
			}
			/*logic trip point end*/
			$("#point3").html("<font class='displaynone' color='red'>3,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point4(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -1) ||(parseFloat(paramDataPoint).toFixed(2)> 2)){
				//$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				tripFn("Y",4);
			}else{
				tripFn("N",4);
			}
			/*logic trip point end*/
			$("#point4").html("<font class='displaynone' color='red'>4,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point5(paramDataPoint){
			
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 75) ||(parseFloat(paramDataPoint).toFixed(2)> 200)){
				//$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				tripFn("Y",5);
			}else{
				tripFn("N",5);
			}
			/*logic trip point end*/
			
			$("#point5").html("<font class='displaynone' color='red'>5,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point6(paramDataPoint){
			
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 75) ||(parseFloat(paramDataPoint).toFixed(2)> 200)){
				tripFn("Y",6);
			}else{
				tripFn("N",6);
			}
			/*logic trip point end*/

			$("#point6").html("<font class='displaynone' color='red'>6,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point7(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 100)){
				tripFn("Y",7);
			}else{
				tripFn("N",7);
			}
			/*logic trip point end*/
			$("#point7").html("<font class='displaynone' color='red'>7,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point8(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -100) ||(parseFloat(paramDataPoint).toFixed(2)> 200)){
				tripFn("Y",8);
			}else{
				tripFn("N",8);
			}
			/*logic trip point end*/
			$("#point8").html("<font class='displaynone' color='red'>8,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
			
		},point9(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -100) ||(parseFloat(paramDataPoint).toFixed(2)> 200)){
				tripFn("Y",9);
			}else{
				tripFn("N",9);
			}
			/*logic trip point end*/
			$("#point9").html("<font class='displaynone' color='red'>9,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point10(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -100) ||(parseFloat(paramDataPoint).toFixed(2)> 200)){
				tripFn("Y",10);
			}else{
				tripFn("N",10);
			}
			/*logic trip point end*/
			$("#point10").html("<font class='displaynone' color='red'>10,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point11(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 100) ||(parseFloat(paramDataPoint).toFixed(2)> 600)){
				tripFn("Y",11);
			}else{
				tripFn("N",11);
			}
			/*logic trip point end*/
			$("#point11").html("<font class='displaynone' color='red'>11,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point12(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 250)){
				tripFn("Y",12);
			}else{
				tripFn("N",12);
			}
			/*logic trip point end*/
			$("#point12").html("<font class='displaynone' color='red'>12,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point13(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 250)){
				tripFn("Y",13);
			}else{
				tripFn("N",13);
			}
			/*logic trip point end*/
			$("#point13").html("<font class='displaynone' color='red'>13,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point14(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 250)){
				tripFn("Y",14);
			}else{
				tripFn("N",14);
			}
			/*logic trip point end*/
			$("#point14").html("<font class='displaynone' color='red'>14,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point15(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 250)){
				tripFn("Y",15);
			}else{
				tripFn("N",15);
			}
			/*logic trip point end*/
			$("#point15").html("<font class='displaynone' color='red'>15,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point16(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 250)){
				tripFn("Y",16);
			}else{
				tripFn("N",16);
			}
			/*logic trip point end*/
			$("#point16").html("<font class='displaynone' color='red'>16,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point17(paramDataPoint){
			
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 50) ||(parseFloat(paramDataPoint).toFixed(2)> 500)){
				tripFn("Y",17);
			}else{
				tripFn("N",17);
			}
			/*logic trip point end*/
			
			$("#point17").html("<font class='displaynone' color='red'>17,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point18(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 100)){
				tripFn("Y",18);
			}else{
				tripFn("N",18);
			}
			/*logic trip point end*/
			$("#point18").html("<font class='displaynone' color='red'>18,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		}
}




function setDataOnDashboardTurbine47(data){
	
	logicPointTurbine47.pointClearTripRedFn();
	logicPointTurbine47.pointClearTripGreenFn();
	logicPointTurbine47.setDateTime("<center><b>ข้อมูลวันที่ "+convertDateHisTh(data['EvTime'])+"</b></center>");
	logicPointTurbine47.point0(data['D32']);
	logicPointTurbine47.point1(data['D152']);
	logicPointTurbine47.point2(data['D153']);
	logicPointTurbine47.point3(data['D146']);
	logicPointTurbine47.point4(data['D147']);
	logicPointTurbine47.point5(data['D76']);
	logicPointTurbine47.point6(data['D77']);
	logicPointTurbine47.point7(data['D159']);
	logicPointTurbine47.point8(data['D160']);
	logicPointTurbine47.point9(data['D158']);
	logicPointTurbine47.point10(data['D157']);
	logicPointTurbine47.point11(data['D156']);
	logicPointTurbine47.point12(data['D169']);
	logicPointTurbine47.point13(data['D145']);
	logicPointTurbine47.point14(data['D148']);
	logicPointTurbine47.point15(data['D1']);
	logicPointTurbine47.point16(data['D1']);
	logicPointTurbine47.point17(data['D1']);
	logicPointTurbine47.point18(data['D1']);

	
	
	
}	
var Turbine47={
		//alert("hello jquery");
		disPlayDateTimeFn(paramDate){
			
			$("#disPlayDateTimeArea").html("<center><b>ข้อมูลวันที่  "+convertDateHisTh(paramDate+" 00:00:00")+"</b></center>");

		},
		readDataEventPCVFn(paramPcv,paramUnit,paramEmpId){
			 var jsonFilter = new Array();
			$.ajax({
				url:"/ais/processView/readDataEventPCVTurbine47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					//console.log(data);
					
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
						paramToDate2='2014-05-01 02:00:00';
						//Test End
						if((toTimestamp(indexEntry['sys_date'])>=toTimestamp(paramFromDate2)) && (toTimestamp(indexEntry['sys_date'])<=toTimestamp(paramToDate2))) {
							jsonFilter.push(indexEntry);
							//console.log(indexEntry);
							
						}
						
					});
					//console.log("jsonFilter");
					//console.log(jsonFilter);
					
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
			// TEST->http://localhost:9999/ais/processView/readDataPCVTurbine47/Turbine47/4/3
			$.ajax({
				url:"/ais/processView/readDataPCVTurbine47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"",
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
							//console.log(indexEntry);
							setDataOnDashboardTurbine47(indexEntry);
							
						}
					});
				}else{
					
					var paramMax=data.length;
					var paramStart=data.length;
					var lastObject=data;
					lastObject = lastObject.pop();
					slideFucusExpressFn(paramStart,paramMax);
					setDataOnDashboardTurbine47(lastObject);
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
				url:"/ais/processView/createDataPCVTurbine47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"/"+paramFromDate+"/"+paramToDate+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					
					if(data=='createJsonSuccess'){
						
						Turbine47.readDataPCVFn(paramPcv,paramUnit,paramEmpId,'');
						
					}
					//console.log(data);
					
					//setDataOnDashboardTurbine47(data[0]);
				}
			});
			
			
		},
		createDataEventPCVFn(paramPcv,paramUnit,paramEmpId,paramFromDate,paramToDate){
			
			
			//{paramPCV}/{paramUnit}/{parmEmpId}/{paramFromDate}/{paramToDate}
			
			
			$.ajax({
				url:"/ais/processView/createDataEventPCVTurbine47/"+paramPcv+"/"+paramUnit+"/"+paramEmpId+"/"+paramFromDate+"/"+paramToDate+"",
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					
					if(data=='createJsonSuccess'){
						
						//Turbine47.readDataPCVTurbine47Fn(paramPcv,paramUnit,paramEmpId,'');
						Turbine47.readDataEventPCVFn(paramPcv,paramUnit,paramEmpId);
						
					}
					//console.log(data);
					
					//setDataOnDashboardTurbine47(data[0]);
				}
			});
			
			
		}
		
		
		
		
	}	
//Turbine47
var mainTurbine47Fn = function(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate){

//test read processViewJson-Turbine47-4-3.txt
	Turbine47.createDataPCVFn(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate);	


	Turbine47.createDataEventPCVFn(paramPcv,paramUnit,parmEmpId,paramFromDate,paramToDate);


	Turbine47.disPlayDateTimeFn(paramToDate);

}