var paramTrendID="";
var paramUrlSecond="";

var paramServer="";

var user_mmplant="";
var emp_id="";
$.ajax({
	url:"/ais/processView/getEmpID_userMMplant",
	type:"get",
	dataType:"json",
	async:false,
	success:function(data){
		
		//alert(data[0]);
		//alert(data[1]);
		user_mmplant=data[1];
		emp_id=data[0];
		
	}
});

$.ajax({
	url:'/ais/trendSetting/getMMPlant',
	dataType:'json',
	async:false,
	success:function(data){
		//alert(data);
		if(data==1){
			paramServer="47";
			paramUrlSecond="http://10.249.91.96/trendSecond47/";
		}else if(data==2){
			paramServer="813";
			paramUrlSecond="http://10.249.91.207/trendSecond813/";
		}else{
			paramServer="47";
			paramUrlSecond="http://10.249.91.96/trendSecond47/";
		}
	}
		
});

function callPostFormula(){

	var obj={
		key:"88-c102",
		startTime:"2014-05-01 00:00:00",
		endTime:"2014-05-01 00:05:00",
		scaleType:"minute",
		//scaleType:"month",
		server:paramServer,
        value:"U04D123+ U04D2+Enthalpy(U04D2;U04D2)"
	}

	$.ajax({
		url:"/ajax/executeCalculation",
		method: "POST",
		data: obj
	}).done(function(data, status, xhr) {
		
		//console.log(data);
		var dataObj=eval("("+data+")");
		
		//var results = jQuery.parseJSON(data);
		console.log(dataObj['formula'][0]);
		
		var jsonData="";
		jsonData+="[";
		$.each(dataObj['formula'],function(index,indexEntry){
			var calID=indexEntry['key'].split("-");
			calID=calID[2];
			if(index==0){
					if(indexEntry['status']=='OK'){
						jsonData+="{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":"+indexEntry['result']+"}";
					}else{
						jsonData+="{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":0}";
					}
				
			}else{
				if(indexEntry['status']=='OK'){
					jsonData+=",{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":"+indexEntry['result']+"}";
				}else{
					jsonData+=",{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":0}";
				}
			}
		
			
		});
		jsonData+="]";
		console.log(jsonData);
		console.log(eval("("+jsonData+")"));
		alert(jsonData);
		
	});
}

//function calculation start

function createFomala(startTime,endTime,formalaData,trendID,calID){

	var cal_g=jQuery.trim(formalaData.replace(/ /g,""));
	var dataLoop="";
	var str=cal_g;
	var myRegexp ="";
	var match  = "";
	var constant_array=[];
	var unit_array=[];

	 myRegexp = /(CONSTANT@[\w]+)/g;
	 match  = myRegexp.exec(str);
	
	while (match != null) {
	
		var constantValue={
			"name":match[1].replace(/CONSTANT@/g,""),
			"result":""
		}
		constant_array.push(constantValue)
		match = myRegexp.exec(str);
	}

	 myRegexp = /(U[0-9]{1,2})(D[0-9]{1,4})/g;
	 match  = myRegexp.exec(str);
	

	while (match != null) {
		var unitValue={
			"unit":match[1],
			"value":match[2],
			"startTime":startTime,
			"endTime":endTime,
			"calID":calID,
			"trendID":trendID,
			"data":""
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
			url: "/ajax/calculation/extractByTrend",
			method: "POST",
			data: obj,
			async:false
		}).done(function(data, status, xhr) {
			console.log(data);
			var dataObject=eval("("+data+")");
			if(dataObject[0]=='createJsonSuccess'){
			   
			   readFomala(formalaData,trendID,calID);
			   
			   
    		}
		});

	}

	
}

function readFomala(formalaData,trendID,calID){

	$.ajax({
		url: "/ajax/calculation/readExtractFormulaByTrend/"+trendID+"/"+calID+"",
		method: "GET",
		async:false,
	}).done(function(datatxt, status, xhr) {
	    var data=eval("("+datatxt+")");
    	var unit_arrayResults = data.unit_array;
		dataLoop=eval("("+unit_arrayResults[0].data+")");
	    var dataLoop2="";
	    var formulas="";
	    formulas="{\"formula\":[";
	    for(var h=0;h<dataLoop.length;h++){
	            var str=jQuery.trim(formalaData.replace(/ /g,"") );
	            
		    	 for(var i=0;i<unit_arrayResults.length;i++){
			    	 
		    		    dataLoop2=eval("("+unit_arrayResults[i].data+")");
		    		    var re = new RegExp(unit_arrayResults[i].unit+unit_arrayResults[i].value,"g");
    					str=str.replace(re,dataLoop2[h][1]);
    					
		    	 }
		    	str=str.replace(/;/g,",")
	    		str=str.replace(/:/g,",")

		    	if(h==0){
		    		 formulas+="{\"key\":\""+h+"-"+trendID+"-"+calID+"\",\"value\":\""+str.toLowerCase()+"\",\"time\":\""+dataLoop2[h][0]+"\"}";
				 }else{
					 formulas+=",{\"key\":\""+h+"-"+trendID+"-"+calID+"\",\"value\":\""+str.toLowerCase()+"\",\"time\":\""+dataLoop2[h][0]+"\"}";
			     }
	    }
	    formulas+=" ],";
	    formulas+='"callBackName":"callBackFormula"';
	    formulas+="}";
	       formulas=eval("("+formulas+")");
			$.ajax({
    		
				 url: "http://10.249.99.107/steamtable/rest/calculation",
	      	        method: "POST",
	      	        crossDomain: true,
	      	        data: formulas,
	      	        async:false,
	      	        dataType: "jsonp",
	      	        jsonp:"callBackFormula"
    	      	        
			});
	});

    
}
var queryCalFormula="";
function callBackFormula(data){
    //Formatt start
     /*
     [{"EvTime":"2014-05-26 00:00:00","U04D260":-195.08799743652,"U05D260":-195.08799743652},
     {"EvTime":"2014-05-26 00:00:00","U04D260":-195.08799743652,"U05D260":-195.08799743652}]
    */
    
    //Format end
    //Gen data json format start
    //var queryCalFormula="";
    var calID="";
    var trendID="";
    queryCalFormula="(";
        $.each(data['formula'],function(index,indexEntry){

            var keyArray=indexEntry['key'].split("-");
            calID=keyArray[2];
            trendID=keyArray[1];
            /*
            (
            select DC101 FROM(
            SELECT  "2014-05-01 00:00:00" as EvTime,"0.333" AS DC101
            UNION
            SELECT  "2014-05-01 00:01:00" as EvTime,"1.223" AS DC101
            )queryA where  EvTime="2014-05-01 00:01:00") as DC101
            */
            if(index==0){
                if(indexEntry['status']=='OK'){

                    
                	    queryCalFormula+="select "+calID+" FROM(";
                	    queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\""+indexEntry['result']+"\" AS "+calID+"";
                           
                    }else{
                    	queryCalFormula+="select "+calID+" FROM(";
                    	queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
                    	   
                    }
            }else{
            	if(indexEntry['status']=='OK'){
            	       queryCalFormula+=" UNION ";
            		   queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\""+indexEntry['result']+"\" AS "+calID+"";
                    
             }else{
            	       queryCalFormula+=" UNION ";
            	       queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
             	   
             }
            }
        });
        queryCalFormula+=")queryA where  EvTime=EvTime2) as "+calID+"";
        console.log(queryCalFormula);
        $("#calID-"+calID).remove();
        $("body").append("<div class='calData-"+trendID+"' id='calID-"+calID+"'>"+queryCalFormula+"</div>");
        
        
        //createFileServiceChart.createFileByMinuteu(paramTrendID,generateQueryGetPointFn("Minute",paramTrendID),unitIdPointId);
		
    //Gen data json format end 
}

//function calculation end

//function display expand focus start
	function setScaleDateTimeFn(startDate,endDate,paramTrendID){
		//default value scaleDateTimeArea start
		//intervalDelNoneHis
		var htmlScaleDateTime="";
	  	if((startDate==undefined) || (endDate==undefined)){
		  htmlScaleDateTime="ข้อมูลวันที่ "+intervalDelNoneHisThFn(currentDateTime(),'day',1)+" - "+currentDateTh()+" &nbsp;&nbsp;<i style='font-size:16px;' class='fa fa-calendar'></i>";
	  	$("#scaleDateTimeArea-"+paramTrendID).html(htmlScaleDateTime);
	   	//default value scaleDateTimeArea end
		}else{
			if($("#paramScaleTime-"+paramTrendID).val()=="Second"){
				
				 htmlScaleDateTime="ข้อมูลวันที่ "+convertDateTh(startDate);
				 $("#scaleDateTimeArea-"+paramTrendID).html(htmlScaleDateTime);
				 
			}else if($("#paramScaleTime-"+paramTrendID).val()=="Month"){
				
				 htmlScaleDateTime="ข้อมูลเดือน "+convertDatetoMonthYearTh(startDate)+" - "+convertDatetoMonthYearTh(endDate)+"  &nbsp;&nbsp;<i style='font-size:16px;' class='fa fa-calendar'></i>";
				 $("#scaleDateTimeArea-"+paramTrendID).html(htmlScaleDateTime);
				 
			}else{
				 htmlScaleDateTime="ข้อมูลวันที่ "+convertDateTh(startDate)+" - "+convertDateTh(endDate)+"  &nbsp;&nbsp;<i style='font-size:16px;' class='fa fa-calendar'></i>";
				 $("#scaleDateTimeArea-"+paramTrendID).html(htmlScaleDateTime);
			}
		}
	}

	
//function display expand focus end
	
	
	
//read event for trend start
function loadEventForTrend(){
	//alert("loadEventForTrend");
	//tooltipCustom($("#trendTabActive").val(),true);
	/*
	var pointDataId= getDataFromPointEmbed("pointDataId");
	var trendTabActive= $("#trendTabActive").val();
	var paramUnit =$("#paramUnitEmbed-"+$("#trendTabActive").val()+"").val();
	var paramFromDate=$("#paramFromDate-"+$("#trendTabActive").val()+"").val();
	var paramToDate=$("#paramToDate-"+$("#trendTabActive").val()+"").val();
	*/
	/*
	alert(pointDataId);
	alert(trendTabActive);
	alert(paramUnit);
	alert(paramFromDate);
	alert(paramToDate);
	*/
	
	$.ajax({
		url:"/ais/serviceTrend/readEventDataTrendByEvent/D1/04/2014-05-01%2000:00:00/2014-10-01%2000:00:00/event",
		type:"get",
		dataType:"json",
		//async:false,
		success:function(data){
			
			console.log(data);
			console.log(data[0]['EvTime']);
			console.log(data[0]['ois_event']);
			//console.log(eval("("+data+")"));
			//console.log(data['EvTime']);
			//console.log($("#tooltip-event-"+point+"-$("#trendTabActive").val()").get());
			//$("#tooltip-event-"+point+"-"+$("#trendTabActive").val()).html(data);
			//$("#tooltip").html(returnEvent);
		}
	});
}
//test
//loadEventForTrend();
/*
setTimeout(function(){
	alert("hello");
	console.log(dataEventForTrend);
},3000);
*/

//read event for rrend end

//getDataByMenute start
function getDataByMenute(data,point){
	//###  DATA VALUE START ### 
		var EvTimeMenute="";
		var dataJson="[";
		var pointArray=point.split(",");
		
		$.each(data,function(index,indexEntry){
			
			EvTimeMenute=indexEntry['EvTime'].split(" ");
			EvTimeMenute=EvTimeMenute[1].substring(0,5);
			//console.log(EvTimeMenute);
			if(index==0){
				dataJson+="{";
			}else{
				dataJson+=",{";
			}
			dataJson+="\"EvTime\": \""+EvTimeMenute+":00  น.\",";
			for($i=0;$i<pointArray.length;$i++){
				if($i==0){
				dataJson+="\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";	
				}else{
				dataJson+=",\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";
				}
			}
			
			
			dataJson+="}";
		});
		dataJson+="]";	
		//console.log(dataJson);
		return eval("("+dataJson+")");
		
	//###  DATA VALUE END ### 
	//###  EVEENT VALUE START ### 
	var EvTimeMenuteEvent="";
	var dataJsonEvent="[";
	//var pointArray=point.split(",");
	/*
	$.each(data,function(index,indexEntry){
		
		EvTimeMenuteEvent=indexEntry['EvTime'].split(" ");
		EvTimeMenuteEvent=EvTimeMenuteEvent[1].substring(0,5);
		//console.log(EvTimeMenute);
		if(index==0){
			dataJsonEvent+="{";
		}else{
			dataJsonEvent+=",{";
		}
		dataJsonEvent+="\"EvTime\": \""+EvTimeMenute+":00  น.\",";
		for($i=0;$i<pointArray.length;$i++){
			if($i==0){
				dataJsonEvent+="\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";	
			}else{
				dataJsonEvent+=",\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";
			}
		}
		dataJsonEvent+="}";
	});
	dataJsonEvent+="]";	
	
	//console.log(dataJson);
	return eval("("+dataJson+")");
	*/
	//###  EVEENT VALUE END ### 
		
			
	}	

// getDataByMenute end

//convest data to day-h for scale time is hour start
function getDataByDateHour(data,point){
		var EvTime="";
		var EvTimeDay="";
		var EvTimeH="";
	
		var dataJson="[";
		var pointArray=point.split(",");
		
		$.each(data,function(index,indexEntry){
			//console.log(indexEntry['EvTime']);
			EvTime=indexEntry['EvTime'].split(" ");
			EvTimeDay=EvTime[0].split("-");
			EvTimeH=EvTime[1].substring(0,2);
			EvTime=EvTimeDay[2]+"/"+EvTimeDay[1]+"/"+EvTimeDay[0]+" "+EvTimeH;
			//console.log(EvTime);
			
			
			
			if(index==0){
				dataJson+="{";
			}else{
				dataJson+=",{";
			}
			dataJson+="\"EvTime\": \""+EvTime+" น.\",";
			for($i=0;$i<pointArray.length;$i++){
				if($i==0){
				dataJson+="\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";	
				}else{
				dataJson+=",\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";
				}
			}
			dataJson+="}";
			
		});
		dataJson+="]";	
		//console.log(dataJson);
		return eval("("+dataJson+")");

	}	

function getDataByDateDay(data,point){
	
	var EvTime="";
	var EvTimeDay="";
	var EvTimeMonth="";
	var EvTimeYear="";

	var dataJson="[";
	var pointArray=point.split(",");
	
	$.each(data,function(index,indexEntry){
		//console.log("1111111");
		//console.log(indexEntry['EvTime']);
		EvTime=indexEntry['EvTime'].split(" ");
		EvTime=EvTime[0].split("-");
		EvTimeDay=EvTime[2];
		EvTimeMonth=EvTime[1];
		EvTimeYear=EvTime[0];
		
		EvTime=EvTimeDay+"/"+EvTimeMonth+"/"+EvTimeYear;
		//console.log("22222");
		//console.log(EvTime);
		
		
		
		if(index==0){
			dataJson+="{";
		}else{
			dataJson+=",{";
		}
		dataJson+="\"EvTime\": \""+EvTime+"\",";
		for($i=0;$i<pointArray.length;$i++){
			if($i==0){
			dataJson+="\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";	
			}else{
			dataJson+=",\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";
			}
		}
		dataJson+="}";
		
	});
	dataJson+="]";	
	//console.log(dataJson);
	return eval("("+dataJson+")");

}
function getDataByDateMonth(data,point){
	
	var EvTime="";
	var EvTimeDay="";
	var EvTimeMonth="";
	var EvTimeYear="";

	var dataJson="[";
	var pointArray=point.split(",");
	
	$.each(data,function(index,indexEntry){
		//console.log("1111111");
		//console.log(indexEntry['EvTime']);
		EvTime=indexEntry['EvTime'].split(" ");
		EvTime=EvTime[0].split("-");
		EvTimeDay=EvTime[2];
		EvTimeMonth=EvTime[1];
		EvTimeYear=EvTime[0];
		
		//EvTime=EvTimeDay+"/"+EvTimeMonth+"/"+EvTimeYear;
		EvTime=EvTimeMonth+"/"+EvTimeYear;
		//console.log("22222");
		//console.log(EvTime);
		
		
		
		if(index==0){
			dataJson+="{";
		}else{
			dataJson+=",{";
		}
		dataJson+="\"EvTime\": \""+EvTime+"\",";
		for($i=0;$i<pointArray.length;$i++){
			if($i==0){
			dataJson+="\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";	
			}else{
			dataJson+=",\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";
			}
		}
		dataJson+="}";
		
	});
	dataJson+="]";	
	//console.log(dataJson);
	return eval("("+dataJson+")");

}
function getDataByDateSecond(data,point){
	
	var EvTime="";
	var EvTimeDay="";
	var EvTimeMonth="";
	var EvTimeYear="";

	var dataJson="[";
	var pointArray=point.split(",");
	
	$.each(data,function(index,indexEntry){
		//console.log("1111111");
		//console.log(indexEntry['EvTime']);
		EvTime=indexEntry['EvTime'].split(" ");
		
		/*
		EvTime=EvTime[0].split("-");
		EvTimeDay=EvTime[2];
		EvTimeMonth=EvTime[1];
		EvTimeYear=EvTime[0];
		*/
		//EvTime=EvTimeDay+"/"+EvTimeMonth+"/"+EvTimeYear;
		EvTime=EvTime[1];
		/*
		EvTime=EvTime.split(":");
		EvTime=EvTime[1]+":"+EvTime[2];
		*/
		//console.log("22222");
		//console.log(EvTime);
		
		
		
		if(index==0){
			dataJson+="{";
		}else{
			dataJson+=",{";
		}
		dataJson+="\"EvTime\": \""+EvTime+" น.\",";
		for($i=0;$i<pointArray.length;$i++){
			if($i==0){
			dataJson+="\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";	
			}else{
			dataJson+=",\""+pointArray[$i]+"\": "+indexEntry[pointArray[$i]]+"";
			}
		}
		dataJson+="}";
		
	});
	dataJson+="]";	
	//console.log(dataJson);
	return eval("("+dataJson+")");

}

//convest data to day-h for scale time is hour end

// createTrendChart start
	var createTrendChart =function(dataJson,point,paramStep,paramTrendID,colorIndex){
		
		
		
		var labelFontSize="12px sans-serif";
		
		if($("#paramScaleTime-"+paramTrendID).val()=="Second"){
			labelFontSize="5px sans-serif";
			//labelFontSize="";
		}
		
		//alert(labelFontSize);
		/*
		console.log("createTrendChart");
		console.log("point"+point);
		console.log("paramTrendID"+paramTrendID);
		*/
		console.log("paramStep1="+paramStep);
		if((paramStep==undefined) || (paramStep=='')){
			paramStep=60;
		}else{
			paramStep=parseInt(paramStep);
		}
		//alert(paramStep);
		
		/*
		console.log("start-----------------------");
		console.log("dataJson="+dataJson);
		console.log("point="+point);
		console.log("paramStep2="+paramStep);
		console.log("paramTrendID="+paramTrendID);
		console.log("colorIndex="+colorIndex);
		console.log("end-----------------------");
		//paramStep=50;
		*/
		
		$("#trendChartArea-"+paramTrendID+"").html("<div id=\"trendChart-"+paramTrendID+"\" class='heightChart' style=\"background: center no-repeat url('/js/kendoUI/bg/world-map.png');\"></div>");
		
		var seriesData="";
		var pointArray=point.split(",");
		seriesData+="[";
		for($i=0;$i<pointArray.length;$i++){
			
			if($i==0){
				seriesData+="{";
				seriesData+="field: \""+pointArray[$i]+"\",";	
				seriesData+="name: \""+pointArray[$i]+"\",";
				if(colorIndex!=undefined){
				var index=colorIndex[$i];
				console.log(index);
				seriesData+="color: \""+colorFlatTheme[index]+"\"";	
				}else{
				seriesData+="color: \""+colorFlatTheme[$i]+"\"";
				}
			}else{
				seriesData+=",{";
				seriesData+="field: \""+pointArray[$i]+"\",";
				seriesData+="name: \""+pointArray[$i]+"\",";
				if(colorIndex!=undefined){
					var index=colorIndex[$i];
					console.log(index);
					seriesData+="color: \""+colorFlatTheme[index]+"\"";	
				}else{
					seriesData+="color: \""+colorFlatTheme[$i]+"\"";
				}
			}
			seriesData+="}";
		}
		seriesData+="]";
		
		
		seriesData=eval("("+seriesData+")");
	
	

	$("#trendChart-"+paramTrendID+"").kendoChart({
		theme: "Flat",
		height:600,
		//width:800,
		
		//theme: "MaterialBlack",
		//renderAs: "canvas",
		chartArea: {
		    background: ""
		   },
		   dataSource: {
               data: dataJson
           },
          
        title: {
           // text: "Spain electricity production (GWh)"
        },
        legend: {
            position: "bottom",
            visible: false
        },
        
        seriesDefaults: {
            type: "line",
            style: "smooth",
            width:"2",
            missingValues: "gap",
            stack: true,
        	markers: {
                visible: false
            },
           // dashType:"solid"
        },
        //series:
        
        series:seriesData,
        categoryAxis: {
            field: "EvTime",
            labels: {
                rotation: -45,
                visible: true,
                step: paramStep ,
                font: labelFontSize,
                
            },
            crosshair: {
                visible: true
            },
            majorGridLines: {
                visible: true,
                step: 20 
            }
        },
        valueAxis: {
            labels: {
                format: "N0"
            },
            visible: false,
            
            //majorUnit: 500
        },
        /*
        tooltip: {
            visible: true,
            shared: true,
            format: "N0"
        },
        */
        tooltip: {
            visible: true,
            template: "#= templateFormat(category,series.name,value) #",
            //category,series.name,value
			//template: "#= series.name #: #= value #",
			shared: true
        },
        
        zoomable: {
            mousewheel: {
                lock: "y"
            },
            selection: {
                lock: "y"
            }
        },
        
        pannable: true,
        pannable: {
            lock: "y"
        },
    });
	

	
	//tooltipCustom(paramTrendID);
	//set tooltip end
	
	
	};
// createTrendChart end
function getDataFromPointEmbedNotCalID(){
	 var unitIdPointIdNotCalID="";
	 var pointCalArray=$("#paramPointEmbed-"+$("#trendTabActive").val()+"").val().split(",");;
	 //alert(pointCalArray);
	 var numCal=0;
	 var dataArray="";
	 var unit="";
	 var data="";
	 $.each(pointCalArray,function(index,indexEntry){
		// alert(indexEntry);
		 
		 var pointCal=indexEntry.substr(0,2);
		 if(pointCal=='DC'){
			//alert("DC");
		 }else{
			 dataArray=indexEntry.split("-");
			 //D3-4-88331
			 data=dataArray[0];
			 unit=dataArray[1];
			 if(numCal==0){
				 unitIdPointIdNotCalID+="U0"+unit+""+data;
			 }else{
				 unitIdPointIdNotCalID+=",U0"+unit+""+data;
			 }
			 numCal++;
		 }
		 
	 });
	 
	 return unitIdPointIdNotCalID;
}

function getformulaEmbedFn(paramTrendID,pointAll){
	var formulaEmbed="";
	var pointID="";
	var unitID="";
	var calFomula="";
	var checkCal="";
	var queryPointArray="";
	var queryPointCalArray="";
	
	
	if(pointAll=="All"){
		var paramPointAndUnitArray=$("#paramPointAllEmbed-"+paramTrendID).val().split(","); 
	}else{
		var paramPointAndUnitArray=$("#paramPointEmbed-"+paramTrendID).val().split(","); 
	}
	
	
	//var paramPointAndUnitArray="D3-4-88331,D4-4-88332,D7-4-88333,DC508-4-88334- U04D1+ U04D2+Enthalpy(U04D2;U04D2)".split(",");
	$.each(paramPointAndUnitArray,function(index,indexEntry){
		 //alert(indexEntry);
		 //D3-4-88331
		 checkCal="NO";
		 queryPointCalArray=indexEntry.split("{");
		 queryPointArray=indexEntry.split("-");

		 if((queryPointCalArray[1]=='undefined') || (queryPointCalArray[1]==undefined)){
			 checkCal="NO";
		 }else{
			 calFomula=queryPointCalArray[1];
			 checkCal="YES";
		 }
		 
		 
		 

		 unitID=queryPointArray[1]; 
		 pointID=queryPointArray[0]; 
		 /*
		alert(unitID);
		alert(pointID);
		alert(calFomula);
		*/
		//alert(checkCal);
		 
		 if(index==0){
			 if(checkCal=='YES'){
				 formulaEmbed+="\""+calFomula+"\"";
			 }else{
				 formulaEmbed+="\"U0"+unitID+""+pointID+"\""; 
			 }
		 }else{
			 if(checkCal=='YES'){
				 formulaEmbed+=",\""+calFomula+"\"";
			 }else{
				 formulaEmbed+=",\"U0"+unitID+""+pointID+"\""; 
			 }
		 }
		
	});
	
	return formulaEmbed;
}


function getformulaEmbedFn_bk(paramTrendID){
	var formulaEmbed="";
	var pointID="";
	var unitID="";
	var calFomula="";
	var checkCal="";
	var queryPointArray="";
	var paramPointAndUnitArray=$("#paramPointEmbed-"+paramTrendID).val().split(","); 
	//var paramPointAndUnitArray="D3-4-88331,D4-4-88332,D7-4-88333,DC508-4-88334- U04D1+ U04D2+Enthalpy(U04D2;U04D2)".split(",");
	$.each(paramPointAndUnitArray,function(index,indexEntry){
		 //alert(indexEntry);
		 //D3-4-88331
		 checkCal="NO";
		 queryPointArray=indexEntry.split("-");
		 
		
		 if((queryPointArray[3]=='undefined') || (queryPointArray[3]==undefined)){
			
			 checkCal="NO";
		 }else{
			 calFomula=queryPointArray[3];
			 checkCal="YES";
		 }
		 
		 
		 //alert(calFomula);

		 unitID=queryPointArray[1]; 
		 pointID=queryPointArray[0]; 
		 
		//alert(unitID);
		//alert(pointID);
		//alert(checkCal);
		 
		 if(index==0){
			 if(checkCal=='YES'){
				 
				 formulaEmbed+="\""+calFomula+"\"";
			 }else{
				
				 formulaEmbed+="\"U0"+unitID+""+pointID+"\""; 
			 }
		 }else{
			 if(checkCal=='YES'){
				
				 formulaEmbed+=",\""+calFomula+"\"";
			 }else{
				
				 formulaEmbed+=",\"U0"+unitID+""+pointID+"\""; 
			 }
		 }
		
	});
	
	return formulaEmbed;
}

	

	


function getDataFromPointEmbed(returnType,selectPointAll){
		if(selectPointAll=="All"){
			
			var pointData = $("#paramPointAllEmbed-"+$("#trendTabActive").val()+"").val();
			
		}else{
			
			var pointData = $("#paramPointEmbed-"+$("#trendTabActive").val()+"").val();
			
		}
		
		
		
		
		//alert(pointData);
		pointData=pointData.split(",");
		var pointDataId="";
		var pointUnitId="";
		var unitIdPointId="";
		var pointId="";
		var pointDataSub="";
		var pointDataCalID="";
		var unitIdPointIdDoubleQuote="";
		//alert(pointData.length);
		
		//unitIdPointIdDoubleQuote+="[";
		for(var i=0;i<pointData.length;i++){
			//alert(pointData[i]);
			pointDataSub=pointData[i].split("-");
			var pointCal=pointDataSub[0].substr(0,2);
			if(i==0){
				pointDataId+=pointDataSub[0];
				pointUnitId+=pointDataSub[1];
				pointId+=pointDataSub[2];
				
				
				 if(pointCal=='DC'){
					 unitIdPointId+=pointDataSub[0];
					 unitIdPointIdDoubleQuote+="\""+pointDataSub[0]+"\"";
				 }else{
					 unitIdPointId+="U0"+pointDataSub[1]+""+pointDataSub[0];
					 unitIdPointIdDoubleQuote+="\"U0"+pointDataSub[1]+""+pointDataSub[0]+"\"";
				 }
			}else{
				pointDataId+=','+pointDataSub[0];
				pointUnitId+=','+pointDataSub[1];
				pointId+=','+pointDataSub[2];
				
				 if(pointCal=='DC'){
					 unitIdPointId+=","+pointDataSub[0];
					 unitIdPointIdDoubleQuote+=",\""+pointDataSub[0]+"\"";
				 }else{
					 unitIdPointId+=",U0"+pointDataSub[1]+""+pointDataSub[0];
					 unitIdPointIdDoubleQuote+=",\"U0"+pointDataSub[1]+""+pointDataSub[0]+"\"";
				 }
				
			}
			
		}
		//unitIdPointIdDoubleQuote+="]";
		if(returnType=="pointDataId"){
			return pointDataId;
		}else if(returnType=="pointUnitId"){
			return pointUnitId;
		}else if(returnType=="pointId"){
			return pointId;
		}else if(returnType=="unitIdPointId"){
			return unitIdPointId;
		}else if(returnType=="unitIdPointIdDoubleQuote"){
			return unitIdPointIdDoubleQuote;
		}
		
		
	}
//setDefaultPointAndPlan start
function setDefaultPointAndPlan(lastObject,point,paramTrendID){
	
	//console.log(lastObject);
	//console.log(point);
	//alert("point="+point);
	var pointArray=point.split(",");

	
	for(var i=0;i<pointArray.length;i++){
		var key=pointArray[i];
		//var keyId=key.substring(1);
		var keyId=key;
		//alert("keyId="+keyId);
	
		
		
		if(i==0){
			var timeHIS=lastObject['EvTime'].split(" ");
			
			if($("#paramScaleTime-"+paramTrendID+"").val()=="Minute"){
				
				/*
				alert(lastObject['EvTime']);
				alert(convertDateTh(lastObject['EvTime']));
				*/
				
				$("#dateInDataDisplay-"+paramTrendID+"").html(convertDateTh(lastObject['EvTime']));
				$("#timeInDataDisplay-"+paramTrendID+"").html("เวลา "+timeHIS[1]+" น.");
				
			}else if($("#paramScaleTime-"+paramTrendID+"").val()=='Hour'){
				$("#dateTimeInDataDisplayHour-"+paramTrendID+"").html(convertDateTh(lastObject['EvTime'])+" เวลา "+timeHIS[1]+" น.");
				
			}else if($("#paramScaleTime-"+paramTrendID+"").val()=='Day'){
				
				$("#dateTimeInDataDisplayDay-"+paramTrendID+"").html(convertDateTh(lastObject['EvTime']));
				
			}else if($("#paramScaleTime-"+paramTrendID+"").val()=='Month'){
				
				$("#dateTimeInDataDisplayMonth-"+paramTrendID+"").html(convertDatetoMonthYearTh(lastObject['EvTime']));
				//$("#dateTimeInDataDisplayMonth-"+paramTrendID+"").html(lastObject['EvTime']);
				
			}else if($("#paramScaleTime-"+paramTrendID+"").val()=='Second'){
				
				$("#dateTimeInDataDisplaySecond-"+paramTrendID+"").html(convertDateTh(lastObject['EvTime'])+" เวลา "+timeHIS[1]+" น.");
				//$("#dateTimeInDataDisplayMonth-"+paramTrendID+"").html(lastObject['EvTime']);
				
			}else{
				
				
				
				$("#dateInDataDisplay-"+paramTrendID+"").html(convertDateTh(lastObject['EvTime']));
				$("#timeInDataDisplay-"+paramTrendID+"").html("เวลา "+timeHIS[1]+" น.");
			}
			
			

			
			
		}
		
		$("#valuePoint-"+keyId+"-"+paramTrendID).text(parseInt(lastObject[key]).toFixed(2));
		$("#planPoint-"+keyId+"-"+paramTrendID).text(parseInt(lastObject[key]).toFixed(2));
		//alert(lastObject[key]);
		
	}
	
	/*
	$.each(lastObject,function(index,indexEntry){
		console.log(indexEntry);
	});
	*/
	
}
//setDefaultPointAndPlan end
//read json file scale type = H
var readJsonFilter={
		
	//readJsonFilterFileScaleTypeH:function(){
	scaleTypeMinute:function(startTime,endTime,paramTrendID,scalType){
		//alert(startTime);
		//alert(endTime);
		
		// var jsonFilter = new Array();
		var jsonData="";
		 $.ajax({
				url:"/ajax/readData/"+scalType+"/"+paramTrendID+"",
				type:"get",
				async:false,
				dataType:"json",
				success:function(data){
							
							jsonData+="[";
							$i=0;
							$.each(data,function(index,indexEntry){
								/*
								console.log("index");
								console.log(index);
								console.log("startTime");
								console.log(startTime);
								console.log("endTime");
								console.log(endTime);
								*/
								
							if((toTimestamp(indexEntry['EvTime'])>=toTimestamp(startTime)) && (toTimestamp(indexEntry['EvTime'])<=toTimestamp(endTime))) {
								
								/*
								if($i<=10){
									
								console.log("อยู่ในเงื่อนไข");
								console.log(toTimestamp(index)+">="+toTimestamp(startTime)+"&&"+toTimestamp(index)+"<="+toTimestamp(endTime));
								console.log(index+">="+startTime+"&&"+index+"<="+endTime);
								console.log(indexEntry['EvTime']);
								console.log("-----");
								
								}
								*/
								//console.log(toTimestamp(index)+"<="+toTimestamp(endTime));
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
								
								
							}else{
								/*
								console.log("-----");
								console.log("ไม่อยู่ในเงื่อนไข");
								console.log(toTimestamp(index)+">="+toTimestamp(startTime)+"&&"+toTimestamp(index)+"<="+toTimestamp(endTime));
								console.log(index+">="+startTime+"&&"+index+"<="+endTime);
								console.log(indexEntry['EvTime']);
								*/
							}
							});
							
							jsonData+="]";
							console.log("jsonData");
							console.log(jsonData);
							//return eval("("+jsonData+")");
				}
		 	
		 });
		 return eval("("+jsonData+")");
		 
	},
	scaleTypeH:function(paramTrendID,scalType){
		/*
		 var jsonFilter = new Array();
		 $.ajax({
				url:"/ais/serviceTrend/readDataHru/"+paramTrendID+"",
				type:"get",
				async:false,
				dataType:"json",
				success:function(data){
					
					jsonFilter=data;
					
				}
		 });
		 return jsonFilter;
		 */
		// var jsonFilter = new Array();
		var jsonData="";
		 $.ajax({
				url:"/ajax/readData/"+scalType+"/"+paramTrendID+"",
				type:"get",
				async:false,
				dataType:"json",
				success:function(data){
							
							jsonData+="[";
							$i=0;
							$.each(data,function(index,indexEntry){
							//if((toTimestamp(index)>=toTimestamp(startTime)) && (toTimestamp(index)<=toTimestamp(endTime))) {
									
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
							//}
							
							});
							
							jsonData+="]";
							
							//console.log(jsonData);
							//return eval("("+jsonData+")");
				}
		 	
		 });
		 return eval("("+jsonData+")");
		 
	},
	scaleTypeD:function(paramTrendID,scalType){
		/*
		 var jsonFilter = new Array();
		 $.ajax({
				url:"/ais/serviceTrend/readDataDayu/"+paramTrendID+"",
				type:"get",
				async:false,
				dataType:"json",
				success:function(data){
					
					jsonFilter=data;
					
				}
		 });
		 return jsonFilter;
		 */
		var jsonData="";
		 $.ajax({
				url:"/ajax/readData/"+scalType+"/"+paramTrendID+"",
				type:"get",
				async:false,
				dataType:"json",
				success:function(data){
							
							jsonData+="[";
							$i=0;
							$.each(data,function(index,indexEntry){
							//if((toTimestamp(index)>=toTimestamp(startTime)) && (toTimestamp(index)<=toTimestamp(endTime))) {
									
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
							//}
							
							});
							
							jsonData+="]";
							
							//console.log(jsonData);
							//return eval("("+jsonData+")");
				}
		 	
		 });
		 return eval("("+jsonData+")");
		 
	},
	scaleTypeMonth:function(paramTrendID,scalType){
		
		
		
		var jsonData="";
		 $.ajax({
				url:"/ajax/readData/"+scalType+"/"+paramTrendID+"",
				type:"get",
				async:false,
				dataType:"json",
				success:function(data){
							
							jsonData+="[";
							$i=0;
							$.each(data,function(index,indexEntry){
							//if((toTimestamp(index)>=toTimestamp(startTime)) && (toTimestamp(index)<=toTimestamp(endTime))) {
									
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
							//}
							
							});
							
							jsonData+="]";
							
							//console.log(jsonData);
							//return eval("("+jsonData+")");
				}
		 	
		 });
		 return eval("("+jsonData+")");
		 
		 
		 
		/*
		 var jsonFilter = new Array();
		 $.ajax({
				url:"/ais/serviceTrend/readDataMonthu/"+paramTrendID+"",
				type:"get",
				async:false,
				dataType:"json",
				success:function(data){
					
					jsonFilter=data;
					
				}
		 });
		 return jsonFilter;
		 */
	},scaleTypeSecond_bk:function(paramTrendID,paramStartTime,paramEndTime,pointDataId){
		
		/*
		alert(paramStartTime);
		alert(paramEndTime);
		*/
		 var jsonFilter = "";
		
		 	//0820140520/08201405200000
			//url:"/ais/serviceTrend/readDataSecondu/"+paramTrendID+"",
		 
		 $.ajax({
			 	
			 	//url:"http://10.249.91.96/trendSecond47/readDataSecondu.php?trendID="+paramTrendID+"&sessEmpId=3&unit=04&callback=?",
			 	url:"http://localhost:9999/test/trendSecond47/readDataSecondu.php?trendID="+paramTrendID+"&sessEmpId=3&unit=08&callback=?",
			 	//url:"/ais/serviceTrend/readDataSecondu/"+paramTrendID+"",	
			 	type:"get",
				dataType:"jsonp",
				async: false, //blocks window close
				success:function(data){
					
					
					
					
					
					var objectData=eval("("+data+")");
					
					jsonFilter+="[";
					var j=0;
					$.each(objectData,function(index,indexEntry){
						
						//var dateTime="2014-05-01 00:00:";
						
						var dateTimeArray = index.split("-");
						var dateTime=convestDateTimeNonDash(dateTimeArray[3]);

							
						if((toTimestamp(dateTime)>=toTimestamp(paramStartTime)) && (toTimestamp(dateTime)<=toTimestamp(paramEndTime))) {
							
							//alert("data is filtered");
							if(j==0){
								jsonFilter+="{\"EvTime\":\""+dateTime+"\","+setFormatDataPointFn(indexEntry[0])+"";
							}else{
								jsonFilter+=",{\"EvTime\":\""+dateTime+"\","+setFormatDataPointFn(indexEntry[0])+"";
							}
							jsonFilter+="}";
							j++;
							
						}
						
					});
					jsonFilter+="]";
					
					
					if(jsonFilter=='[]'){
						alert("Data is empty!");
						return false;
					}
					var data2 = eval("("+jsonFilter+")");
					setTimeout(function(){
						//alert(pointDataId);
						createTrendChart(getDataByDateSecond(data2,pointDataId),pointDataId,"10",paramTrendID);
						var lastObject = data2.pop();
						setDefaultPointAndPlan(lastObject,pointDataId,paramTrendID);
					},1000);
					
					
					
					
				}
		 });
		 //console.log("-----------2"+jsonFilter);
		 //return eval("("+jsonFilter+")");
		 
	},scaleTypeSecond:function(paramTrendID,paramStartTime,paramEndTime){
		
		var jsonData="";
		 $.ajax({
				url:"/ajax/readDataSecond/"+paramTrendID+"",
				type:"get",
				async:false,
				dataType:"json",
				success:function(data){
							console.log("1data");
							console.log(data);
							jsonData+="[";
							$i=0;
							$.each(data,function(index,indexEntry){
								/*
								console.log("2index");
								console.log(index);
								console.log("2index");
								console.log(paramStartTime);
								console.log(paramEndTime);
								console.log("-------");
								*/
								/*
								console.log(index+"="+toTimestamp(index)+">="+toTimestamp(paramStartTime)+"="+paramStartTime);
								console.log("------------");
								console.log(index+"="+toTimestamp(index)+"<="+toTimestamp(paramEndTime)+"="+paramEndTime);
								console.log("------------");
								console.log("------------");
								*/
							if((toTimestamp(index)>=toTimestamp(paramStartTime)) && (toTimestamp(index)<=toTimestamp(paramEndTime))) {
									
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
							
							//console.log("jsonData");
							//console.log(jsonData);
							//return eval("("+jsonData+")");
				}
		 	
		 });
		 return eval("("+jsonData+")");
		 
		
	}		

}

//console.log(readJsonFilter.scaleTypeSecond('88','3','2014-05-01 02:00:00','2014-05-01 02:02:00'));

var createFileServiceChart={
		
	createFileByHru:function(paramTrendID,queryPoint,unitIdPointId){
		
		var pointDataId= getDataFromPointEmbed("unitIdPointId");
		//var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote");
		var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote","All");
		var arrayUnitIdPointIdDoubleQuote = JSON.parse("[" + unitIdPointIdDoubleQuote + "]");
		
		var pointUnitId= $("#paramUnitEmbed-"+paramTrendID+"").val();
		var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
		var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();
		var getformulaEmbed=JSON.parse("[" +getformulaEmbedFn(paramTrendID,"All")+ "]");
		
		var obj={
				
				//key:["U04D3","U04D4","U04D7","DC508"],
				key:arrayUnitIdPointIdDoubleQuote,
				startTime:paramFromDate,
				endTime:paramToDate,
				scaleType:"hour",
				//scaleType:"month",
				server:paramServer,
				trendID:paramTrendID,
				//formulas:["U04D3","U04D4","U04D7"," U04D1+ U04D2+Enthalpy(U04D2;U04D2)"]
				formulas:getformulaEmbed
			}
		$.ajax({
			url:"/ajax/executeCalculation",
			method: "POST",
			data: obj,
			async:false,
			success:function(data){
				//console.log(data);
				$obj=eval("("+data+")");
				if($obj=='createJsonSuccess'){
					
					var data2=readJsonFilter.scaleTypeH(paramTrendID,"hour");
			
					if(data2==""){
						
						alert("Data is empty!");
						return false;
					}
					
					
					setTimeout(function(){
						//alert("create createTrendChart HRU");
						console.log(getDataByDateHour(data2,pointDataId));
						createTrendChart(getDataByDateHour(data2,pointDataId),pointDataId,"12",paramTrendID);
						
						//$("#trendChart").find("g transform").get();
						var lastObject = data2.pop();
						setDefaultPointAndPlan(lastObject,pointDataId,paramTrendID);
						
					},1000);
					
					
				}
			}
		});
		
	},
	createFileByDayu:function(paramTrendID,queryPoint,unitIdPointId){
		

		var pointDataId= getDataFromPointEmbed("unitIdPointId");
		//var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote");
		var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote","All");
		var arrayUnitIdPointIdDoubleQuote = JSON.parse("[" + unitIdPointIdDoubleQuote + "]");
		var pointUnitId= $("#paramUnitEmbed-"+paramTrendID+"").val();
		var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
		var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();
		var getformulaEmbed=JSON.parse("[" +getformulaEmbedFn(paramTrendID,"All")+ "]");
		
		
		var obj={
				
				//key:["U04D3","U04D4","U04D7","DC508"],
				key:arrayUnitIdPointIdDoubleQuote,
				startTime:paramFromDate,
				endTime:paramToDate,
				scaleType:"day",
				//scaleType:"month",
				server:paramServer,
				trendID:paramTrendID,
				//formulas:["U04D3","U04D4","U04D7"," U04D1+ U04D2+Enthalpy(U04D2;U04D2)"]
				formulas:getformulaEmbed
			}
		$.ajax({
			url:"/ajax/executeCalculation",
			method: "POST",
			data: obj,
			async:false,
			success:function(data){
				//console.log(data);
				$obj=eval("("+data+")");
				if($obj=='createJsonSuccess'){
					
					var data2=readJsonFilter.scaleTypeD(paramTrendID,"day");
			
					if(data2==""){
						
						alert("Data is empty!");
						return false;
					}
					
					
					setTimeout(function(){
						createTrendChart(getDataByDateDay(data2,pointDataId),pointDataId,"1",paramTrendID);
						var lastObject = data2.pop();
						setDefaultPointAndPlan(lastObject,pointDataId,paramTrendID);
					},1000);
					
					
				}
			}
		});
		
	},
	createFileByMonthu:function(paramTrendID,unitIdPointId){
		
		var pointDataId= getDataFromPointEmbed("unitIdPointId");
		//var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote");
		var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote","All");
		var arrayUnitIdPointIdDoubleQuote = JSON.parse("[" + unitIdPointIdDoubleQuote + "]");
		var pointUnitId= $("#paramUnitEmbed-"+paramTrendID+"").val();
		var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
		var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();
		var getformulaEmbed=JSON.parse("[" +getformulaEmbedFn(paramTrendID,"All")+ "]");
		
		
		var obj={
				
				//key:["U04D3","U04D4","U04D7","DC508"],
				key:arrayUnitIdPointIdDoubleQuote,
				startTime:paramFromDate,
				endTime:paramToDate,
				scaleType:"month",
				//scaleType:"month",
				server:paramServer,
				trendID:paramTrendID,
				//formulas:["U04D3","U04D4","U04D7"," U04D1+ U04D2+Enthalpy(U04D2;U04D2)"]
				formulas:getformulaEmbed
			}
		$.ajax({
			url:"/ajax/executeCalculation",
			method: "POST",
			data: obj,
			async:false,
			success:function(data){
				//console.log(data);
				$obj=eval("("+data+")");
				if($obj=='createJsonSuccess'){
					
					var data2=readJsonFilter.scaleTypeMonth(paramTrendID,"month");
			
					if(data2==""){
						
						alert("Data is empty!");
						return false;
					}
					
					setTimeout(function(){
						createTrendChart(getDataByDateMonth(data2,pointDataId),pointDataId,"1",paramTrendID);
						var lastObject = data2.pop();
						setDefaultPointAndPlan(lastObject,pointDataId,paramTrendID);
					},1000);
					
					
				}
			}
		});
		
	},
	createFileByMinuteu_bk:function(paramTrendID,queryPoint,unitIdPointId){
		
		var pointDataId= getDataFromPointEmbed("unitIdPointId");
		var pointUnitId= $("#paramUnitEmbed-"+paramTrendID+"").val();
		var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
		var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();
		
		 var obj={
				 "paramTrendID":paramTrendID,
				 "paramFromDate":paramFromDate,
				 "paramToDate":paramToDate,
				 "queryPoint":queryPoint,
				 "unitIdPointId":unitIdPointId,
				}
		$.ajax({
			url:"/ais/serviceTrend/createDataMinuteu",
			//url:"/ais/serviceTrend/createDataMinuteu/"+paramTrendID+"/"+paramFromDate+"/"+paramToDate+"/"+queryPoint+"/"+unitIdPointId,
			type:"post",
			dataType:"json",
			async:false,
			data: obj,
			success:function(data){
				//alert(data);
				if(data=='createJsonSuccess'){
					
					
					var data2=readJsonFilterFile(startDateTime5HaGoFn(endDatetimeHisFn(paramToDate)),endDatetimeHisFn(paramToDate),paramTrendID);
					//console.log(data2);
					
					if(data2==''){
						alert("Data is empty!");
						return false;
					}
					
					
					var minute=startDateTime5HaGoFn(endDatetimeHisFn(paramToDate)).split(" ");
					minute=minute[1];
					$("#startTimeForDisplay-"+paramTrendID+"").val(minute);
					//embed param startDate On Proccess
					 $("#paramStartDateOnProccess-"+paramTrendID).remove();
					 $("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+startDateTime5HaGoFn(endDatetimeHisFn(paramToDate))+"'>");
					 
					setTimeout(function(){
						//unitIdPointId
						//alert(point)
						//createTrendChart(getDataByMenute(data2,point),point,"60",paramTrendID);
						
						
						createTrendChart(getDataByMenute(data2,unitIdPointId),unitIdPointId,"60",paramTrendID);
						var lastObject = data2.pop();
						//setDefaultPointAndPlan(lastObject,point,paramTrendID);
						setDefaultPointAndPlan(lastObject,unitIdPointId,paramTrendID);
					},1000);
					
					
				}
			}
		});
	},
	createFileByMinuteu:function(paramTrendID,unitIdPointId){
		
		var pointDataId= getDataFromPointEmbed("unitIdPointId");
		//var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote");
		var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote","All");
		var arrayUnitIdPointIdDoubleQuote = JSON.parse("[" + unitIdPointIdDoubleQuote + "]");
		var pointUnitId= $("#paramUnitEmbed-"+paramTrendID+"").val();
		var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
		var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();
		var getformulaEmbed=JSON.parse("[" +getformulaEmbedFn(paramTrendID,"All")+ "]");

		
		//console.log(getformulaEmbed);
		
		
		var obj={
				
				//key:["U04D3","U04D4","U04D7","DC508"],
				key:arrayUnitIdPointIdDoubleQuote,
				startTime:paramFromDate,
				endTime:paramToDate,
				scaleType:"minute",
				//scaleType:"month",
				server:paramServer,
				trendID:paramTrendID,
				//formulas:["U04D3","U04D4","U04D7"," U04D1+ U04D2+Enthalpy(U04D2;U04D2)"]
				formulas:getformulaEmbed
			}
		$.ajax({
			url:"/ajax/executeCalculation",
			method: "POST",
			data: obj,
			async:false,
			success:function(data){
				
			
				
				$obj=eval("("+data+")");
				if($obj=='createJsonSuccess'){
					
					/*
					alert(endDatetimeHisFn(paramToDate));
					alert(startDateTime5HaGoFn(endDatetimeHisFn(paramToDate)));
					*/
					
					var data2=readJsonFilter.scaleTypeMinute(startDateTime5HaGoFn(endDatetimeHisFn(paramToDate)),endDatetimeHisFn(paramToDate),paramTrendID,"minute");
			
					if(data2==""){
						
						alert("Data is empty!");
						return false;
						
					}
					
					
					
					var minute=startDateTime5HaGoFn(endDatetimeHisFn(paramToDate)).split(" ");
					minute=minute[1];
					$("#startTimeForDisplay-"+paramTrendID+"").val(minute);
					//embed param startDate On Proccess
					 $("#paramStartDateOnProccess-"+paramTrendID).remove();
					 $("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+startDateTime5HaGoFn(endDatetimeHisFn(paramToDate))+"'>");
					 
					setTimeout(function(){
					
						createTrendChart(getDataByMenute(data2,unitIdPointId),unitIdPointId,"60",paramTrendID);
						var lastObject = data2.pop();
						//setDefaultPointAndPlan(lastObject,point,paramTrendID);
						setDefaultPointAndPlan(lastObject,unitIdPointId,paramTrendID);
						
					},1000);
					
					
				}
		
			}
		
		});
			
		
		
	},
	createFileBySecondu_bk:function(paramTrendID){
		
		var pointDataId= getDataFromPointEmbed("pointDataId");
		//var pointDataId= getDataFromPointEmbed("unitIdPointId");
		var pointUnitId= $("#paramUnitEmbed-"+paramTrendID+"").val();
		var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
		var paramFromDateArray="";
		var paramYear="";
		var paramMonth="";
		var paramMinute="";
		var paramDay="";
		var paramHour="";
		
		paramFromDateArray=paramFromDate.split("-");
		

		paramYear=paramFromDateArray[0];
		paramMonth=paramFromDateArray[1];
		paramDay=paramFromDateArray[2].split(" ");
		paramDay=paramDay[0];
		paramHour=$("#paramHour-"+paramTrendID+"").val();
		paramMinute=$("#paramMinate-"+paramTrendID+"").val();
		
		var paramStartTime=paramYear+"-"+paramMonth+"-"+addZeroToNumber(paramDay)+" "+addZeroToNumber(paramHour)+":00:00";
		var paramEndTime=paramYear+"-"+paramMonth+"-"+addZeroToNumber(paramDay)+" "+addZeroToNumber(paramHour)+":"+addZeroToNumber(paramMinute)+":00";
		
		$(".initDateTimeSecond-"+paramTrendID).remove();
		$("body").append("" +
				"<input type='hidden' name='initStartTimeSecond-"+paramTrendID+"' id='initStartTimeSecond-"+paramTrendID+"' class='initDateTimeSecond' value='"+paramStartTime+"'>" +
				"<input type='hidden' name='initEndTimeSecond-"+paramTrendID+"' id='initEndTimeSecond-"+paramTrendID+"' class='initDateTimeSecond' value='"+paramEndTime+"'>");
		//alert(folderName);
		//var paramDate=paramYear+"-"+paramMonth+"-"+addZeroToNumber(paramDay);
		
		
		//startTimeForDisplay
		
		var menuteStartTime=paramStartTime.split(" ");
		$("#startTimeForDisplay-"+paramTrendID+"").val(menuteStartTime[1]);
		
		$("#paramStartDateOnProccess-"+paramTrendID).remove();
		$("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+paramStartTime+"'>");
		
		
		
		$.ajax({
			//url:"/ais/serviceTrend/createDataSecondu/"+paramEndTime+"/"+pointDataId+"/"+paramTrendID,
			url:"http://localhost:9999/test/trendSecond47/createDataSecondu.php?dateTime="+paramEndTime+"&point="+pointDataId+"&trendID="+paramTrendID+"&sessEmpId=3&unit=08&callback=?",
			//url:"http://10.249.91.96/trendSecond47/createDataSecondu.php?dateTime="+paramEndTime+"&point="+pointDataId+"&trendID="+paramTrendID+"&sessEmpId=3&unit=04&callback=?",
			type:"get",
			async:false,
			crossDomain: true,
			dataType:"JSON",
			success:function(data){
				
				if(data=='createJsonSuccess'){
					
					//alert("createJsonSuccess");
					readJsonFilter.scaleTypeSecond(paramTrendID,paramStartTime,intervalAddFn(paramStartTime,'minute','1'),pointDataId);
					
					
					/*
					var data2=readJsonFilter.scaleTypeSecond(paramTrendID,paramStartTime,intervalAddFn(paramStartTime,'minute','1'));
					if(data2==''){
						alert("Data is empty!");
						return false;
					}
					console.log(data2);
					alert(data2);
					
					
					setTimeout(function(){
						createTrendChart(getDataByDateSecond(data2,pointDataId),pointDataId,"10",paramTrendID);
						var lastObject = data2.pop();
						setDefaultPointAndPlan(lastObject,pointDataId,paramTrendID);
					},1000);
					*/
				}
					
			}
		});
		
	
		/*
		var data2=readJsonFilter.scaleTypeSecond(paramTrendID,'3',paramStartTime,intervalAddFn(paramStartTime,'minute','1'));
		setTimeout(function(){
			createTrendChart(getDataByDateSecond(data2,pointDataId),pointDataId,"10",paramTrendID);
			var lastObject = data2.pop();
			setDefaultPointAndPlan(lastObject,pointDataId,paramTrendID);
		},1000);
		*/
					
			
		
	},
	createFileBySecondu:function(paramTrendID){
		var pointDataId= getDataFromPointEmbed("unitIdPointId");
		//var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote");
		var unitIdPointIdDoubleQuote= getDataFromPointEmbed("unitIdPointIdDoubleQuote","All");
		var arrayUnitIdPointIdDoubleQuote = JSON.parse("[" + unitIdPointIdDoubleQuote + "]");
		var getformulaEmbed=JSON.parse("[" +getformulaEmbedFn(paramTrendID,"All")+ "]");
		var pointUnitId= $("#paramUnitEmbed-"+paramTrendID+"").val();
		
		//var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
		//var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();
		//var pointDataId= getDataFromPointEmbed("pointDataId");
		//var pointDataId= getDataFromPointEmbed("unitIdPointId");
		//var pointUnitId= $("#paramUnitEmbed-"+paramTrendID+"").val();
		
		var paramFromDateArray= $("#paramFromDate-"+paramTrendID+"").val().split(" ");
		var paramFromDate=paramFromDateArray[0];
		
		
		
		 var paramHourMinuteTime=$("#hour-"+paramTrendID).val();
		 
         var paramMinuteScale=$("#minute-"+paramTrendID).val();
        
         var paramDateTime= ""+paramFromDate+" "+paramHourMinuteTime+":00";
        // paramDateTime="2015-12-20 10:20:00";
         //alert(paramDateTime);
         
         var paramStartTime = intervalDelFn(paramDateTime,'minute',parseInt(paramMinuteScale));
         //alert(paramStartTime);
         var paramEndTime = intervalAddFn(paramDateTime,'minute',parseInt(paramMinuteScale));
         //alert(paramEndTime);

         
		$(".initDateTimeSecond-"+paramTrendID).remove();
		$("body").append("" +
				"<input type='hidden' name='initStartTimeSecond-"+paramTrendID+"' id='initStartTimeSecond-"+paramTrendID+"' class='initDateTimeSecond' value='"+paramStartTime+"'>" +
				"<input type='hidden' name='initEndTimeSecond-"+paramTrendID+"' id='initEndTimeSecond-"+paramTrendID+"' class='initDateTimeSecond' value='"+paramEndTime+"'>");
	
		//startTimeForDisplay
		
		var menuteStartTime=paramStartTime.split(" ");
		$("#startTimeForDisplay-"+paramTrendID+"").val(menuteStartTime[1]);
		
		$("#paramStartDateOnProccess-"+paramTrendID).remove();
		$("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+paramStartTime+"'>");
		
		
		
		/*engine calculation start*/
		/*
		"startTime":"2015-12-30 00:06:00",
		"endTime":"2015-12-30 00:06:00",
		
		"startTime":paramStartTime,
		"endTime":paramEndTime,
		 */
		console.log("--getformulaEmbed--");
		
		console.log(getformulaEmbed);
		var obj={
				//"key":["U04D1","DC102"],
				"key":arrayUnitIdPointIdDoubleQuote,
				//"formulas":["U04D1","U04D1+U04D2"],
				"formulas":getformulaEmbed,
				"startTime":paramStartTime,
				"endTime":paramEndTime,
				"url":paramUrlSecond, // ok
				"server":paramServer,
				"trendID":paramTrendID,
			}

			$.ajax({
				url: "/ajax/secdata",
				method: "POST",
				data: obj,
				async:false,
				
			}).done(function(data, status, xhr) {
				//console.log(data.dataWithTimes);
				
				
				//var sources = jQuery.parseJSON(data.sources);
				//var dataWithTimes =data.dataWithTimes;
				var dataWithTimes = jQuery.parseJSON(data.dataWithTimes);
				console.log(dataWithTimes);
			
				
				
					
					var data2={
						//"formula1":data.dataWithTimes,
						
						"formula":dataWithTimes,
						"trendID2":paramTrendID
						
					}
					
					$.ajax({
						url: "/ajax/postFormula",
						method: "POST",
						data: data2,
						async:false,
					}).done(function(data22, status, xhr) {

						console.log(data22);
						var objData=eval("("+data22+")");
						if(objData=='createJsonSuccess'){
							//alert("cleateFileSuccess");
							
							//if data is succcess start
							
										//var data2=readJsonFilter.scaleTypeSecond(paramTrendID,"second",paramStartTime,paramEndTime);
										var endTime = intervalAddFn(paramStartTime,'minute','1');
										var data2=readJsonFilter.scaleTypeSecond(paramTrendID,paramStartTime,endTime);
										
										console.log("data22222");
										console.log(data2);
										if(data2=='[]'){
											alert("Data is empty!");
											return false;
										}
										//var data2 = eval("("+data2+")");
										setTimeout(function(){
											//alert(pointDataId);
											
											createTrendChart(getDataByDateSecond(data2,pointDataId),pointDataId,"10",paramTrendID);
											var lastObject = data2.pop();
											setDefaultPointAndPlan(lastObject,pointDataId,paramTrendID);
											
										},1000);
						
										
										/*
										var data2=readJsonFilter.scaleTypeSecond(paramTrendID,paramStartTime,intervalAddFn(paramStartTime,'minute','1'));
										if(data2==''){
											alert("Data is empty!");
											return false;
										}
										console.log(data2);
										alert(data2);
										
										
										setTimeout(function(){
											createTrendChart(getDataByDateSecond(data2,pointDataId),pointDataId,"10",paramTrendID);
											var lastObject = data2.pop();
											setDefaultPointAndPlan(lastObject,pointDataId,paramTrendID);
										},1000);
										*/
										//if data is succcess end
						}
						
						
						
						
					});
					 


			});
		
		
					
				
		
					
			
		
	}
}
//readJsonFilter.scaleTypeSecond('88','3','2014-05-01 02:00:00','2014-05-01 02:01:00');

var plotGraphFn=function(paramAction,paramTest,paramTrendID,paramScaleTime){
	   //alert(paramTrendID);
	   var point="";
	   if(paramTest=="Y"){
		   
		   point+="D32-4-2026,D223-4-2030,D131-4-2034,D105-4-2038,D272-4-2042,D114-4-2046,D273-4-2050,D193-4-2054,D4-4-2058";
		   
	   }else{
		   
		  //var pointChecked = $('input[name=point]:checked');
		  var pointChecked=$(".paramPointEmbedPrePlot-"+paramTrendID+"").get();
		  $.each(pointChecked,function(index,indexEntry){
			 //console.log($(indexEntry).val()); 
			 
			  if(index==0){
					point+="D"+$(indexEntry).val();
				}else{
					point+=",D"+$(indexEntry).val();
				}
		  }); 
	   }
		  
		  
			  
			
		  //if plot grach is success crate new tab
		 if(paramAction!='Edit'){
			 
		  //alert(point);
		  $(".paramPointEmbed-"+paramTrendID+"").remove();
		  var paramPoint="";
		  paramPoint+="<input type='hidden' class='paramPointEmbed-"+paramTrendID+"' id='paramPointEmbed-"+paramTrendID+"' name='paramPointEmbed-"+paramTrendID+"' value='"+point+"'>";
		  paramPoint+="<input type='hidden' class='paramPointEmbed-"+paramTrendID+"' id='paramPointAllEmbed-"+paramTrendID+"' name='paramPointAllEmbed-"+paramTrendID+"' value='"+point+"'>";
		  $("body").append(paramPoint);
			  
		  var newTab="";
		  newTab+="<li class=\"titleTab \" id='tabTrendId-"+paramTrendID+"'><a href=\"#tab-"+paramTrendID+"\" data-toggle=\"tab\" aria-expanded=\"false\"><b>"+$("#trendName").html()+"</b></a></li>";
		  $("#tabTrendTitle").append(newTab);
		 
		  $.ajax({
			 url:"/View/structureDashTrend.php",
			 type:"get",
			 dataType:"html",
			 data:{"paramTrendID":paramTrendID},
			 async:false,
			 success:function(data){
				 //alert(data);
				 var contentTab="";
				  contentTab+="<div class=\"tab-pane\" id=\"tab-"+paramTrendID+"\">";
		          contentTab+=" <div class=\"panel-body\">";
		          contentTab+=data;
		          contentTab+=" </div>";
		          contentTab+="</div>";
		          $("#tabTrendContent").append(contentTab);

		          
		        
			 }
		  });
			  $("[href='#tab-"+paramTrendID+"']").click();
			  $("#trendSeting").hide();
			  
			 
			  
		 }
			 // $('[data-toggle="popover"]').popover();
			  $('#editTrendPointModal').modal('hide');
			  
			  
			  //START UP TREND 
			 
			 var fromDate="";
			 var toDate="";
			 $("#paramToDate-"+paramTrendID).val();
			 if(($("#paramFromDate-"+paramTrendID).val()!=undefined) ||($("#paramToDate-"+paramTrendID).val()!=undefined)){
				 fromDate=$("#paramFromDate-"+paramTrendID).val();
				 toDate=$("#paramToDate-"+paramTrendID).val();
			 }else{
				 fromDate=currentDate()+" 00:00:00";
				 toDate=currentDate()+" 23:59:59";
			 }
			  startUpFn("N",paramTrendID,paramScaleTime,$("#paramHour-"+paramTrendID).val(),$("#paramMinate-"+paramTrendID).val(),fromDate,toDate); 
			  
}


//read json by hidden or show point start
var readJsonHiddenPointAllFn=function(paramTrendID){
	
	 var scale = parseInt($("#scaleTimeMenuLeftArea-"+$("#trendTabActive").val()+"").text());
	 var paramStartDateOnProccess= $("#paramStartDateOnProccess-"+paramTrendID).val();
	 var startTime= paramStartDateOnProccess;
 	// var startTime= intervalDelFn(datetimeCurrentHFn($("#paramToDate-"+paramTrendID+"").val()),'hour',5);
	 var endTime = intervalAddFn(startTime,'hour',scale);
	 //var data2=readJsonFilterFile(startTime,endTime,paramTrendID);
	 var data2=readJsonFilter.scaleTypeMinute(startTime,endTime,paramTrendID,"minute");
	 
	 var paramPoint='';
	 $("#paramPoint").val('');
	 $(".clickHideShowPoint").removeClass("showPoint");
	 $(".clickHideShowPoint").addClass("hiddenPoint");
	 
	 createTrendChart("",paramPoint,'',paramTrendID);
	
	 
	 startTime=startTime.split(" ");
	 $("#startTimeForDisplay-"+paramTrendID+"").val(addZeroTOMinute(startTime[1]));
	
 }
 var readJsonShowPointAllFn=function(paramTrendID){
	 
	 var scale = parseInt($("#expandFocus-"+paramTrendID+"").val());
	 var startTime= $("#paramStartDateOnProccess-"+paramTrendID).val();
	 var paramScaleTime=$("#paramScaleTime-"+paramTrendID).val();
	 //var paramPoint= getDataFromPointAllEmbed("pointDataId");
	 var paramPoint= getDataFromPointAllEmbed("unitIdPointId");
	

	 if(paramScaleTime=='Second'){
		 var endTime = intervalAddFn(startTime,'minute',scale);
		 //readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,paramPoint);
		 //readJsonFilter.scaleTypeSecond(paramTrendID,"second");
		 var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime);
		 createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,"10",paramTrendID);
		 /*
		 var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,paramPoint);
		 createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,"10",paramTrendID);
		 */
	 }else if(paramScaleTime=='Hour'){
		 /*
		 var endTime = intervalAddFn(startTime,'minute',scale);
		 var data2=readJsonFilter.scaleTypeSecond(paramTrendID,'3',startTime,endTime);
		 createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,"10",paramTrendID);
		 */
		 var data2=readJsonFilter.scaleTypeH(paramTrendID,"hour");
		 createTrendChart(getDataByDateHour(data2,paramPoint),paramPoint,"12",paramTrendID);
		 
		 
	 }else if(paramScaleTime=='Day'){

		// var data2=readJsonFilter.scaleTypeD(paramTrendID);
		 var data2=readJsonFilter.scaleTypeD(paramTrendID,"day");
		 createTrendChart(getDataByDateDay(data2,paramPoint),paramPoint,"1",paramTrendID);
		 
		 
	 }else if(paramScaleTime=='Month'){

		
		 
		 var data2=readJsonFilter.scaleTypeMonth(paramTrendID,"month");
		 createTrendChart(getDataByDateMonth(data2,paramPoint),paramPoint,"1",paramTrendID);
		 
		 
	 }else{
 	
	 var endTime = intervalAddFn(startTime,'hour',scale);
	 //var data2=readJsonFilterFile(startTime,endTime,paramTrendID);
	 var data2=readJsonFilter.scaleTypeMinute(startTime,endTime,paramTrendID,"minute");
	 createTrendChart(getDataByMenute(data2,paramPoint),paramPoint,'',paramTrendID);
	 
	 }
	 
	 $("#paramPoint").val(paramPoint);
	 $(".clickHideShowPoint").removeClass("hiddenPoint");
	 $(".clickHideShowPoint").addClass("showPoint");

	 startTime=startTime.split(" ");
	 $("#startTimeForDisplay-"+paramTrendID+"").val(addZeroTOMinute(startTime[1]));
	 
	
 }
 
 var readJsonShowHiddenPointFn=function(point,paramTrendID,$colorIndex){
	 
	 var scale = parseInt($("#expandFocus-"+paramTrendID+"").val());
	 var startTime= $("#paramStartDateOnProccess-"+paramTrendID).val();
	 var paramScaleTime=$("#paramScaleTime-"+paramTrendID).val();
	 
	 
	 if(paramScaleTime=='Second'){
		 
		
		 var endTime = intervalAddFn(startTime,'minute',scale);
		 //readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,point);
		 //readJsonFilter.scaleTypeSecond(paramTrendID,"second");
		 var data2= readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime);
		 createTrendChart(getDataByDateSecond(data2,point),point,"10",paramTrendID,$colorIndex);
		 /*
		 var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,point);
		 createTrendChart(getDataByDateSecond(data2,point),point,"10",paramTrendID,$colorIndex);
				*/
		
		 
		 
	 }else if(paramScaleTime=='Hour'){
		
		

		 var data2=readJsonFilter.scaleTypeH(paramTrendID);
		 //console.log("xxxx");
		 //console.log(data2);
		 createTrendChart(getDataByDateHour(data2,point),point,"12",paramTrendID,$colorIndex);
		
		
		 
		 
	 }else if(paramScaleTime=='Day'){
		 
		// var data2=readJsonFilter.scaleTypeD(paramTrendID);
		 var data2=readJsonFilter.scaleTypeD(paramTrendID,"day");
		 createTrendChart(getDataByDateDay(data2,point),point,"1",paramTrendID,$colorIndex);

		 
		 
		 
	 }else if(paramScaleTime=='Month'){
		 
		 var data2=readJsonFilter.scaleTypeMonth(paramTrendID,"month");
		 createTrendChart(getDataByDateMonth(data2,point),point,"1",paramTrendID);

		 
		 
		 
	 }else{
	 	 var endTime = intervalAddFn(startTime,'hour',scale);
		 //var data2=readJsonFilterFile(startTime,endTime,paramTrendID);
	 	 var data2=readJsonFilter.scaleTypeMinute(startTime,endTime,paramTrendID,"minute");
		 createTrendChart(getDataByMenute(data2,point),point,'',paramTrendID,$colorIndex);
	 }
	 
	 
	 //startTime=startTime.split(" ");
	 //$("#startTimeForDisplay-"+paramTrendID+"").val(addZeroTOMinute(startTime[1]));
	
 }
//read json by hidden or show point start
 
 //function dinamic read file json start
 function readJsonExpandFocusFn(seek,paramTrendID,paramScalTime){
	 
	 
	 
	startTimeDisplay=0;
	var data2="";
	//var pointDataId=getDataFromPointEmbed("pointDataId");
	var pointDataId=getDataFromPointEmbed("unitIdPointId");
	//alert(pointDataId);
	
	var paramStep="";
	//var startTime="";

	if(paramScalTime=='Second'){
		
		 //alert(paramScalTime);
		 var startTime= $("#paramStartDateOnProccess-"+paramTrendID+"").val();
		 var endTime = intervalAddFn(startTime,'minute',seek);
		 
		
		 paramStep='10';
		 //data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,pointDataId);
		 //data2=readJsonFilter.scaleTypeSecond(paramTrendID,"second");
		 data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime);
		 setTimeout(function(){
				createTrendChart(getDataByDateSecond(data2,pointDataId),pointDataId,"10",paramTrendID);
				var lastObject = data2.pop();
				setDefaultPointAndPlan(lastObject,pointDataId,paramTrendID);
		 },1000);
		 
		 
		
	}else{
	
		var startTime="";
		if(($("#paramStartDateOnProccess-"+paramTrendID+"").val()=="")|| ($("#paramStartDateOnProccess-"+paramTrendID+"").val()==undefined)){
			 startTime= intervalDelFn(endDatetimeHFn($("#paramToDate-"+paramTrendID+"").val()),'hour',5);
		}else{
			 startTime= $("#paramStartDateOnProccess-"+paramTrendID+"").val();
		}
		 var endTime = intervalAddFn(startTime,'hour',seek);
		 //data2=readJsonFilterFile(startTime,endTime,paramTrendID);
		 var data2=readJsonFilter.scaleTypeMinute(startTime,endTime,paramTrendID,"minute");
		 createTrendChart(getDataByMenute(data2,pointDataId),pointDataId,paramStep,paramTrendID);
		 
	}
	
	 //console.log(data2);
	
	 
	 
	 $("#paramStartDateOnProccess-"+paramTrendID).remove();
	 $("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+startTime+"'>");
 
 }
//function dinamic read file json end
 
//function dinamic read file json start
 var readJsonReduceStartTimeDisplayFn=function(seek,paramTrendID){
	 
	 
	 
	 var scale = parseInt($("#expandFocus-"+$("#trendTabActive").val()+"").val());
	 var paramScaleTime=$("#paramScaleTime-"+paramTrendID).val();
	 var paramStartDateOnProccess= $("#paramStartDateOnProccess-"+paramTrendID).val();
	 //var paramPoint=getDataFromPointEmbed("pointDataId");
	 var paramPoint=getDataFromPointEmbed("unitIdPointId");

	 if(paramScaleTime=="Second"){
	 
		 var startTime= intervalDelFn(paramStartDateOnProccess,'minute',-seek);
		 var endTime = intervalAddFn(startTime,'minute',scale);
		 
		 //readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,paramPoint);
		 //readJsonFilter.scaleTypeSecond(paramTrendID,"second");
		 var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime);
		 createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,'10',paramTrendID);	 
		
			
		 /*
		 var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,paramPoint);
		 createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,'10',paramTrendID);	 
		 */
	 }else{
	 	 //var startTime= intervalDelFn(datetimeCurrentHFn($("#paramToDate-"+paramTrendID+"").val()),'hour',(scale-seek));
		 var startTime= intervalDelFn(paramStartDateOnProccess,'hour',-seek);
		 //alert("2="+startTime);
		 var endTime = intervalAddFn(startTime,'hour',scale);
		 var data2=readJsonFilter.scaleTypeMinute(startTime,endTime,paramTrendID,"minute");
		 //var data2=readJsonFilterFile(startTime,endTime,paramTrendID);
		 //var paramPoint=$("#paramPoint").val();
		 createTrendChart(getDataByMenute(data2,paramPoint),paramPoint,'',paramTrendID);
		 
	 }
	 
	 
	 
	
	 $("#paramStartDateOnProccess-"+paramTrendID).remove();
	 $("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+startTime+"'>");
	 startTime=startTime.split(" ");
	 $("#startTimeForDisplay-"+paramTrendID+"").val(addZeroTOMinute(startTime[1]));
	
	 
	
	
}
var readJsonIncreaseStartTimeDisplayFn=function(seek,paramTrendID){
	//alert("seek>="+seek);
	 var paramStartDateOnProccess= $("#paramStartDateOnProccess-"+paramTrendID).val();
	 //var scale = parseInt($("#scaleTimeMenuLeftArea-"+$("#trendTabActive").val()+"").text());
	 var scale = parseInt($("#expandFocus-"+$("#trendTabActive").val()+"").val());
	 //var paramPoint=getDataFromPointEmbed("pointDataId");
	 var paramPoint=getDataFromPointEmbed("unitIdPointId");
	 var paramScaleTime=$("#paramScaleTime-"+paramTrendID).val();
	 
	 if(paramScaleTime=="Second"){
		 
		 var startTime= intervalDelFn(paramStartDateOnProccess,'minute',-seek);
	 	 var endTime = intervalAddFn(startTime,'minute',scale);
	 	 
	 	 //readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,paramPoint);
	 	 //readJsonFilter.scaleTypeSecond(paramTrendID,"second");
	 	var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime);
	 	createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,'10',paramTrendID);
	 	
	 }else{
		 
		 var startTime= intervalDelFn(paramStartDateOnProccess,'hour',-seek);
	 	 var endTime = intervalAddFn(startTime,'hour',scale);
		// var data2=readJsonFilterFile(startTime,endTime,paramTrendID);
	 	var data2=readJsonFilter.scaleTypeMinute(startTime,endTime,paramTrendID,"minute");
		 createTrendChart(getDataByMenute(data2,paramPoint),paramPoint,'',paramTrendID);
	 }
	 
	 $("#paramStartDateOnProccess-"+paramTrendID).remove();
	 $("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+startTime+"'>");
	 startTime=startTime.split(" ");
	 $("#startTimeForDisplay-"+paramTrendID+"").val(addZeroTOMinute(startTime[1]));
}


var readJsonReduceDayDisplayFn=function(seek,paramTrendID){
 	
	 var paramStartDateOnProccess= $("#paramStartDateOnProccess-"+paramTrendID).val();
	 var scale = parseInt($("#expandFocus-"+$("#trendTabActive").val()+"").val());
	
	 //var paramPoint=getDataFromPointEmbed("pointDataId");
	 var paramPoint=getDataFromPointEmbed("unitIdPointId");
	 
	 var paramScaleTime=$("#paramScaleTime-"+paramTrendID).val();
	 
	 //alert(paramScaleTime);
	 if(paramScaleTime=="Second"){
		 
		 var startTime= $("#initStartTimeSecond-"+paramTrendID).val();
		 var endTime = intervalAddFn(startTime,'minute',scale);
		 
		 //readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,paramPoint);
		 //readJsonFilter.scaleTypeSecond(paramTrendID,"second");
		 var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime);
		 createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,'10',paramTrendID);
		 /*
		 var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,paramPoint);
		 createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,'10',paramTrendID);
		 */
	 }else{
		 var startTime= intervalDelFn(paramStartDateOnProccess,'day',-seek);
		 var endTime = intervalAddFn(startTime,'hour',scale);
		 //var data2=readJsonFilterFile(startTime,endTime,paramTrendID);
		 var data2=readJsonFilter.scaleTypeMinute(startTime,endTime,paramTrendID,"minute");
		 createTrendChart(getDataByMenute(data2,paramPoint),paramPoint,'',paramTrendID);
	 }
 
	 
	 $("#paramStartDateOnProccess-"+paramTrendID).remove();
	 $("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+startTime+"'>");
	 $("#dateInDataDisplay-"+paramTrendID+"").html(convertDateTh(endTime));
 
 

}
var readJsonIncreaseDayDisplayFn=function(seek,paramTrendID){
	
	var paramStartDateOnProccess= $("#paramStartDateOnProccess-"+paramTrendID).val();
	var scale = parseInt($("#expandFocus-"+$("#trendTabActive").val()+"").val());
	//var paramPoint=getDataFromPointEmbed("pointDataId");
	var paramPoint=getDataFromPointEmbed("unitIdPointId");
	var paramScaleTime=$("#paramScaleTime-"+paramTrendID).val();
	
	if(paramScaleTime=="Second"){
		var startTime= intervalDelFn($("#initEndTimeSecond-"+paramTrendID).val(),'minute',scale);
		var endTime = $("#initEndTimeSecond-"+paramTrendID).val();
		//readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,paramPoint);
		//readJsonFilter.scaleTypeSecond(paramTrendID,"second");
		var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime);
		createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,'10',paramTrendID);
		/*
		var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime,paramPoint);
		createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,'10',paramTrendID);
		 */
	 }else{
		var startTime= intervalDelFn(paramStartDateOnProccess,'day',-seek);
		var endTime = intervalAddFn(startTime,'hour',scale);
		//var data2=readJsonFilterFile(startTime,endTime,paramTrendID);
		var data2=readJsonFilter.scaleTypeMinute(startTime,endTime,paramTrendID,"minute");
		createTrendChart(getDataByMenute(data2,paramPoint),paramPoint,'',paramTrendID);
	 }
	
	$("#dateInDataDisplay-"+paramTrendID+"").html(convertDateTh(endTime));
	$("#paramStartDateOnProccess-"+paramTrendID).remove();
	$("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+startTime+"'>");

 
}

//function dinamic read file json end

$(document).ready(function(){
	
	
	$(document).on("click",".navbar-minimalize",function(){
		setTimeout(function(){
			
			var paramStartDateOnProccess= $("#paramStartDateOnProccess-"+$("#trendTabActive").val()).val();
			var scale = parseInt($("#expandFocus-"+$("#trendTabActive").val()+"").val());
			var caleTimeType=$("#paramScaleTime-"+$("#trendTabActive").val()).val();
			var paramPoint=getDataFromPointEmbed("pointDataId");
			//alert(scale);
			$(".clickHideShowPoint").removeClass("hiddenPoint");
			$(".clickHideShowPoint").addClass("showPoint");
			
			
			
			if($("#trendTabActive").val()!=undefined){	
				
				if(caleTimeType=='Second'){
					
					 var startTime= paramStartDateOnProccess;
					 var endTime = intervalAddFn(startTime,'minute',scale);
					 
					 //readJsonFilter.scaleTypeSecond($("#trendTabActive").val(),startTime,endTime,paramPoint);
					 //readJsonFilter.scaleTypeSecond($("#trendTabActive").val(),"second");
					 var data2=readJsonFilter.scaleTypeSecond(paramTrendID,startTime,endTime);
					 createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,'10',$("#trendTabActive").val());
					 /*
					 var data2=readJsonFilter.scaleTypeSecond($("#trendTabActive").val(),startTime,endTime,paramPoint);
					 createTrendChart(getDataByDateSecond(data2,paramPoint),paramPoint,'10',$("#trendTabActive").val());
					*/
					
				}else {
					readJsonExpandFocusFn(scale,$("#trendTabActive").val());
				}
			}
		},500);
		
	});
	//click tab start
	$(document).on("click",".titleTab",function(){
		
		 var id = this.id.split("-");
		 id=id[1];
		
		  $("#trendTabActive").remove();
		  var htmlTitleTab="<input type='hidden' id='trendTabActive' name='trendTabActive' value='"+id+"'>";
		  $("body").append(htmlTitleTab);
		  
		  
		  
	});
	//click tab end
	
	
	/*click create trend graph start*/
	
	$(document).on("click","#downloadData",function(event){
		alert("อยู่ในระหว่างพัฒนา...");
		$(".popover").popover('hide');
		return false;
	});
	$(document).on("click","#cancelDownloadData",function(event){
		 $(".popover").popover('hide');
		 //alert("hello");
		return false;
	});
	
	var countTrendSeting=0;
	$("[href='#trendSeting']").click(function(){
	
		//if(countTrendSeting==0){
			
		$.ajax({
			url:"/View/trend_setting.php",
			type:"html",
			async:false,
			success:function(data){
				//alert(data);
				$("#areaTrendSeting").html(data);
				
			}
		});
		/*
		}else{
			alert("อยู่ในระหว่างการปรับปรุง...");
			return false;
		}
		*/
		countTrendSeting++;
	});
	setTimeout(function(){
		$("[href='#trendSeting']").click();
	},1000);
	
	
	
	
	//delete tab start
	$(document).on("click",".exitTrendPoint",function(){

		if(confirm("Do you want to remove this graph?")){
			
		var id="";
		id=this.id.split("-");
		id=id[1];
		$("ul#tabTrendTitle").find("a[href='#tab-"+id+"']").remove();
		$("#tabTrendContent>#tab-"+id).remove();
		

		setTimeout(function(){
			//$("[href='#trendSeting']").click();
			$("#trendSeting").show();
			//delete embed param start
			//alert(id);
			$("#paramDateEmbed-"+id).remove();
			$("#paramPointEmbed-"+id).remove();
			$("#paramTrendNameEmbed-"+id).remove();
			//$("#paramUnitEmbed-"+id).remove();
			$("#paramTrendIDEmbed-"+id).remove();
			
		});

			
		
		
		//delete file ajax start
		/*
		$.ajax({
			url:"/webservice/deleteTrendJson.php",
			type:"html",
			data:{"id":id},
			async:false,
			success:function(data){
				//alert(data);
				
			}
		});
		*/
		//delete file ajax end
		
		//alert("exitTrendPoint");
		}
		
	});
	//deleate tab end
	
	
	
	

});


