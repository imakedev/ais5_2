
//function callTrendFn(){

//function for tooltip start

function templateFormat(category,series,value) {
	
	//set value in right table
	
	//var point=series.substring("1");
	var point=series;
	/*
	console.log("1212121212---121212121");
	console.log(point);*/
	var trendActive=$("#trendTabActive").val();
	var paramUnit= $("#paramUnitEmbed-"+trendActive).val();
	
	
	$("#valuePoint-"+point+"-"+$("#trendTabActive").val()).html(addCommas(parseFloat(value).toFixed(2)));
	
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
		
		var paramFromDate=$("#paramFromDate-"+trendActive).val();
		paramFromDate=paramFromDate.split(" ");
		paramFromDate=paramFromDate[0]+" "+category;
		

		$("#dateTimeInDataDisplaySecond-"+$("#trendTabActive").val()+"").html(convertDateHisTh(paramFromDate)+" น.");
		
		
		
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
	// ### Manage dateTime for get event on tooltip Start ###
	//varible for minute start
	 var dateTimeEvent="";
	 var dateTimeEventTime="";
	 var dateTimeEventDate="";
	 //varible for minute end
	 
	 
	 
	 if($("#paramScaleTime-"+trendActive+"").val()=='Minute'){
		 
		 dateTimeEventDate=$("#paramStartDateOnProccess-"+trendActive).val();
		 dateTimeEventDate =dateTimeEventDate.split(" ");
		 
		 dateTimeEventDate = dateTimeEventDate[0];
		 dateTimeEventTime= category.split(" ");
		 dateTimeEventTime=dateTimeEventTime[0];
		 
		 dateTimeEvent=dateTimeEventDate+" "+dateTimeEventTime;
		 /*
		 console.log("1dateTimeEvent1");
		 console.log("category"+category);
		 console.log(dateTimeEvent);
		 */
		 
		 
	 }else if($("#paramScaleTime-"+trendActive+"").val()=='Day'){

		 //12/05/2014
		 dateTimeEvent = category.split("/");
		 dateTimeEvent=dateTimeEvent[0]+"-"+dateTimeEvent[1]+"-"+dateTimeEvent[2]+" 00:00:00";
		
		 
		 
	 }else if($("#paramScaleTime-"+trendActive+"").val()=='Month'){
		 //fixed for test
		 //05/2014
		 //dateTimeEvent="2014-05-01 00:00:34";
		 dateTimeEvent = category.split("/");
		 dateTimeEvent="01-"+dateTimeEvent[0]+"-"+dateTimeEvent[1]+" 00:00:00";
		 console.log(dateTimeEvent);
		 $("#dateTimeInDataDisplayMonth-"+trendActive).html(convertDatetoMonthYearTh(dateTimeEvent));
		 
		 
		 
	 }else if($("#paramScaleTime-"+trendActive+"").val()=='Second'){
		 //fixed for test
		 //2014-05-20 00:00:31 น.
		
		 
		 var second="";
		 var date="";
		 var time="";
		 var paramFromDate=$("#paramFromDate-"+trendActive).val();
			paramFromDate=paramFromDate.split(" ");
	        date=paramFromDate[0];
	        time=category;
	        
	        date=date.split("-");
	        time=time.split(":");
	        paramFromDate=date[2]+"-"+date[1]+"-"+date[0]+" 00:00:"+parseInt(time[2]);
			
			console.log(paramFromDate);
		 
		 
	 }else if($("#paramScaleTime-"+trendActive+"").val()=='Hour'){
		 //fixed for test
		 //12/05/2014 12 น.
		 //["12/05/2014", "04", "น."]
		
		
		 				 
		 dateTimeEvent = category[0].split("/");
		 dateTimeEvent = dateTimeEvent[0]+"-"+dateTimeEvent[1]+"-"+dateTimeEvent[2]+" "+category[1]+":00:00";
		 //console.log("dateTimeEvent="+dateTimeEvent);

		 
		 
	 }else{
		 
		 //default minuate
		 dateTimeEventDate=$("#paramStartDateOnProccess-"+trendActive).val();
		 dateTimeEventDate =dateTimeEventDate.split(" ");
		 dateTimeEventDate = dateTimeEventDate[0];
		 dateTimeEventTime= category.split(" ");
		 dateTimeEventTime=dateTimeEventTime[0];
		 dateTimeEvent=dateTimeEventDate+" "+dateTimeEventTime;
	
	 }
	 
	// ### Manage dateTime for get event on Tooltip End ###
	 var paramStartDate="";
	 var paramEndDate="";
	 var paramTagList="";
	 
	 
	 
	 
	 
	 
	 
	 if($("#paramevent-"+point+"-"+$("#trendTabActive").val()).val()=="event"){
		 
		 paramStartDate=intervalDelFn(dateTimeEvent,'minute','5');
		 paramEndDate=intervalAddFn(dateTimeEvent,'minute','5');
		 paramTagList=$(".showPoint>.pointTag-"+trendActive+"").text().substring("1");
		 var tooltipUnit = $("#tooltipUnit").val();
		 tooltipUnit = parseInt(tooltipUnit);
		 

		 $.ajax({
				//url:"/ais/serviceTrend/readEventDataTrendByEvent/"+paramTagList+"/"+paramStartDate+"/"+paramEndDate+"/event",
			 url:"/getLogByTrend.php?tagName="+paramTagList+"&startDateTime="+paramStartDate+"&endDateTime="+paramEndDate+"&event=event&sess_emp_id="+emp_id+"&user_mmplant="+user_mmplant+"&unit="+tooltipUnit+"",	
			 type:"get",
				dataType:"json",
				//async:false,
				success:function(data){
					if(data!=''){
						
						var EvTime=data[0]['EvTime'];
						var ois_event=data[0]['ois_event'];
						$("#tooltip-event-"+point+"-"+$("#trendTabActive").val()).html("Event:"+ois_event);
						
					}
				}
			});
		 
		 
	 }
	 
	 
	
	 
	 
	 
	 if($("#paramaction-"+point+"-"+$("#trendTabActive").val()).val()=="action"){
		 
		 
		 paramStartDate=intervalDelFn(dateTimeEvent,'minute','5');
		 paramEndDate=intervalAddFn(dateTimeEvent,'minute','5');
		 paramTagList=$(".showPoint>.pointTag-"+trendActive+"").text().substring("1");
		 var tooltipUnit = $("#tooltipUnit").val();
		 tooltipUnit = parseInt(tooltipUnit);
		 //user_mmplant
		//emp_id
		 console.log(tooltipUnit);
		 ///getLogByTrend.php?tagName=0173&startDateTime=2014-10-07%2000:00:00&endDateTime=2014-10-07%2023:00:00&event=vpser&sess_emp_id=3&user_mmplant=1&unit=4
		 $.ajax({
				//url:"/ais/serviceTrend/readEventDataTrendByEvent/"+paramTagList+"/"+paramStartDate+"/"+paramEndDate+"/action",
				url:"/getLogByTrend.php?tagName="+paramTagList+"&startDateTime="+paramStartDate+"&endDateTime="+paramEndDate+"&event=action&sess_emp_id="+emp_id+"&user_mmplant="+user_mmplant+"&unit="+tooltipUnit+"",
				type:"get",
				dataType:"json",
				//async:false,
				success:function(data){
					if(data!=''){
						
						var EvTime=data[0]['EvTime'];
						var ois_event=data[0]['ois_action'];
						$("#tooltip-event-"+point+"-"+$("#trendTabActive").val()).html("Action:"+ois_event);
						
					}
				}
			});
		 
		 
		 /*
		 paramAction+="action";
		 console.log("action");
		 console.log(point+"-"+$("#trendTabActive").val()+"-"+category);
		 console.log("---");
		 */
		 /*
		 $.ajax({
				url:"/ais/serviceTrend/readEventDataTrendByEvent/"+series+"/"+paramUnit+"/"+dateTimeEvent+"/action",
				type:"get",
				dataType:"json",
				//async:false,
				success:function(data){
					
					console.log(data[0]['EvTime']);
					var EvTime=data[0]['EvTime'];
					console.log(data[0]['ois_action']);
					var ois_event=data[0]['ois_action'];
					//console.log(eval("("+data+")"));
					//console.log(data['EvTime']);
					//console.log($("#tooltip-event-"+point+"-$("#trendTabActive").val()").get());
					$("#tooltip-action-"+point+"-"+$("#trendTabActive").val()).html("Action:"+ois_event);
					
				}
			});
			*/
	 }
	 if($("#paramvpser-"+point+"-"+$("#trendTabActive").val()).val()=="vpser"){
		 
		 
		 paramStartDate=intervalDelFn(dateTimeEvent,'minute','5');
		 paramEndDate=intervalAddFn(dateTimeEvent,'minute','5');
		 paramTagList=$(".showPoint>.pointTag-"+trendActive+"").text().substring("1");
		 var tooltipUnit = $("#tooltipUnit").val();
		 tooltipUnit = parseInt(tooltipUnit);
		 
		 $.ajax({
				//url:"/ais/serviceTrend/readEventDataTrendByEvent/"+paramTagList+"/"+paramStartDate+"/"+paramEndDate+"/vpser",
			 url:"/getLogByTrend.php?tagName="+paramTagList+"&startDateTime="+paramStartDate+"&endDateTime="+paramEndDate+"&event=vpser&sess_emp_id="+emp_id+"&user_mmplant="+user_mmplant+"&unit="+tooltipUnit+"",	
			 type:"get",
				dataType:"json",
				//async:false,
				success:function(data){
					if(data!=''){
						
						var EvTime=data[0]['EvTime'];
						var ois_event=data[0]['ois_vpser'];
						$("#tooltip-event-"+point+"-"+$("#trendTabActive").val()).html("VPSER:"+ois_event);
						
					}
				}
			});
		 
		 /*
		 paramVpser+="vpser";
		 console.log("vpser");
		 console.log(point+"-"+$("#trendTabActive").val()+"-"+category);
		 console.log("---");
		 */
		 	/*
		 	console.log(paramUnit);
			console.log("---");
			console.log(point);
			console.log("---");
			console.log(series);
			*/
		 console.log(category);
		 
		 /*
		 
		 $.ajax({
				url:"/ais/serviceTrend/readEventDataTrendByEvent/"+series+"/"+paramUnit+"/"+dateTimeEvent+"/vpser",
				type:"get",
				dataType:"json",
				//async:false,
				success:function(data){
					
					console.log(data[0]['EvTime']);
					var EvTime=data[0]['EvTime'];
					console.log(data[0]['ois_vpser']);
					var ois_event=data[0]['ois_vpser'];
					//console.log(eval("("+data+")"));
					//console.log(data['EvTime']);
					//console.log($("#tooltip-event-"+point+"-$("#trendTabActive").val()").get());
					$("#tooltip-vpser-"+point+"-"+$("#trendTabActive").val()).html("VPSER:"+ois_event);
					
				}
			});
			*/
	 }
	 
	
	 
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
				$("#tooltip").css({"left":((event.pageX)+10)+"px","top":((event.pageY)+10)+"px"}).fadeIn();
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
	 			var paramFromDate=$("#paramFromDate-"+paramTrendID+"").val().split(" ");
	 			paramFromDate=paramFromDate[0];
	 			
	 			var paramToDate=$("#paramToDate-"+paramTrendID+"").val().split(" ");
	 			paramToDate=paramToDate[0];
	 			
	 			$("#dateFrom-"+paramTrendID+"").val(paramFromDate);
	 			$("#dateFrom-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM-dd"
	 			 });
	 			
	 			
	 			$("#dateTo-"+paramTrendID+"").val(paramToDate);
	 			$("#dateTo-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM-dd"
	 			 });
	 			
	 			//set Hour and Minute parameter start
	 			/*
	 			 alert($("#paramHour-"+paramTrendID).val());
				 alert($("#paramHour-"+paramTrendID).val()==undefined);
				 alert($("#paramHour-"+paramTrendID).val()=="undefined");
				 alert($("#paramHour-"+paramTrendID).val()=="");
				 */
	 			
				 if(($("#paramHour-"+paramTrendID).val()!=undefined) && ($("#paramHour-"+paramTrendID).val()!="undefined")&& ($("#paramHour-"+paramTrendID).val()!="")){
					 $("#hour-"+paramTrendID).val($("#paramHour-"+paramTrendID).val());
					 //alert("Hour="+$("#paramHour-"+paramTrendID).val());
				 }
				 if(($("#paramMinate-"+paramTrendID).val()!=undefined)&&($("#paramMinate-"+paramTrendID).val()!="undefined")&&($("#paramMinate-"+paramTrendID).val()!="")){
					 $("#minute-"+paramTrendID).val(addZeroToNumber($("#paramMinate-"+paramTrendID).val()));
					 //alert("Minate="+$("#paramMinate-"+paramTrendID).val());
				 }
				 
				 
	 		}else if($(this).val()=="Month"){
	 			var paramFromDate=$("#paramFromDate-"+paramTrendID+"").val().split(" ");
	 			paramFromDate=paramFromDate[0];
	 			
	 			var paramToDate=$("#paramToDate-"+paramTrendID+"").val().split(" ");
	 			paramToDate=paramToDate[0];
	 			
	 			$("#dateFrom-"+paramTrendID+"").val(paramFromDate);
	 			$("#dateFrom-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM-dd"
	 			 });
	 			
	 			
	 			$("#dateTo-"+paramTrendID+"").val(paramToDate);
	 			$("#dateTo-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM-dd"
	 			 });
	 			
	 			$(".forSecondFormShow").hide();
	 			$(".forSecondFormHide").show();
	 			
	 		}else{
	 			
	 			$(".forSecondFormShow").hide();
	 			$(".forSecondFormHide").show();
	 			
	 			var paramFromDate=$("#paramFromDate-"+paramTrendID+"").val().split(" ");
	 			paramFromDate=paramFromDate[0];
	 			
	 			var paramToDate=$("#paramToDate-"+paramTrendID+"").val().split(" ");
	 			paramToDate=paramToDate[0];
	 			
	 			
	 			$("#dateFrom-"+paramTrendID+"").val(paramFromDate);
	 			$("#dateFrom-"+paramTrendID+"").kendoDatePicker({
	 				 format: "yyyy-MM-dd"
	 			 });
	 			$("#dateTo-"+paramTrendID+"").val(paramToDate);
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
						"pointId":indexEntry['ZZ'],
						"point":indexEntry['H'],
						"tag":indexEntry['D'],
						"unit":indexEntry['E'],
						"unit_plant":indexEntry['B'],
						"max":indexEntry['F0'],
						"min":indexEntry['F1'],
						"mmunit":1,
						"colorFlatTheme":colorFlatTheme[index],
						"paramTrendID":paramTrendID,
						"index":index,
						"calID":indexEntry['I'],
					 },
				
				success:function(data){
					//alert(data);
					
					$("#listPointLeftArea-"+paramTrendID).append(data);
					
				}
			});
		});
		
		
	}
	function callServiceGetPointByTrend1(trendno,_unit,mmunit,starttime,endtime){
		
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
	
	
	function generateQueryByCalFn(paramTrendID){
		
		var paramPointAndUnitArray=$("#paramPointEmbed-"+paramTrendID).val().split(","); 
		var paramFromDate=$("#paramFromDate-"+paramTrendID).val();
		var paramToDate=$("#paramToDate-"+paramTrendID).val();
		$.each(paramPointAndUnitArray,function(index,indexEntry){

			 queryPointArray=indexEntry.split("-");
			 queryPointCalArray=queryPointArray[0]; 
			 queryPointCal=queryPointCalArray.substr(0,2);
			 if(queryPointCal=='DC'){
				 pointCal=queryPointArray[3];
				 createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",pointCal,""+paramTrendID+"",""+queryPointArray[0]+"");
				 
			 }
		});
		
		
		
		
	}
	function readQueryByCalFn(paramTrendID){
		var data= $(".calData-"+paramTrendID).text();
		return data;
	}
	function genrateQueryCalFn(key,startTime,endTime,scaleType,server){
		var queryCalFormula="";
		var obj={
				key:"88-c102",
				startTime:"2014-05-01 00:00:00",
				endTime:"2014-05-01 00:05:00",
				scaleType:"minute",
				//scaleType:"month",
				server:"47",
		        value:"U04D123+ U04D2+Enthalpy(U04D2;U04D2)"
			}

			$.ajax({
				url:"/ajax/executeCalculation",
				method: "POST",
				data: obj,
				async:false,
			}).done(function(data, status, xhr) {
				//console.log(data);
				var dataObj=eval("("+data+")");
				
				console.log(dataObj);
					
				 queryCalFormula="(";
				var calID="";
				var trendID="";
		        $.each(dataObj['formula'],function(index,indexEntry){
		        	
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
		        
		       return queryCalFormula;
		        //alert(queryCalFormula);
	});
}

	
	function generateQueryGetPointFn(scaleTime,paramTrendID){
		
		var queryPoint="";
		var queryPointArray="";
		var paramPointAndUnitArray=$("#paramPointEmbed-"+paramTrendID).val().split(","); 
		var queryPointCalArray="";
		var paramFromDate=$("#paramFromDate-"+paramTrendID).val();
		var paramToDate=$("#paramToDate-"+paramTrendID).val();
		
		
		
		if(scaleTime=="Minute2"){
			var obj={
					key:"88-c102",
					startTime:"2014-05-01 00:00:00",
					endTime:"2014-05-01 00:05:00",
					scaleType:"minute",
					//scaleType:"month",
					server:"47",
			        value:"U04D123+ U04D2+Enthalpy(U04D2;U04D2)"
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
		
		}else if(scaleTime=="Minute"){
			var $i=0;
			var $cal=0;
			var queryCal="";
			var queryCalFormula="";
			//var dataCheckFormula=false;
			$.each(paramPointAndUnitArray,function(index,indexEntry){
				 //alert(indexEntry);
				 //D3-4-88331
				
				 queryPointArray=indexEntry.split("-");
				 queryPointCalArray=queryPointArray[0]; 
				 queryPointCal=queryPointCalArray.substr(0,2);
				 
				 if(queryPointCal=='DC'){
				       
				        pointCal=queryPointArray[3];
				        console.log("pointCal1");
				        console.log(pointCal);
				       
				      //Read Data Cal Start
						// alert(queryPointArray[0]);
				        
						
						queryCalFormula+=",(";	
						
						 //for(var i=0;i<=2;i++){
						var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
						var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();	 
						//var endDate = currentDateTime();
						//var startDate=intervalDelFn(endDate,'hour',5);
						
						//alert(startDate);
						//alert(endDate);
						 var obj={
									key:paramTrendID+"-"+queryPointArray[0],
									startTime:paramFromDate,
									endTime:paramToDate,
									scaleType:"minute",
									//scaleType:scaleTime,
									server:"47",
							        //value:"U04D123+ U04D2+Enthalpy(U04D2;U04D2)"
							        value:pointCal
								}

								$.ajax({
									url:"/ajax/executeCalculation",
									method: "POST",
									data: obj,
									async:false,
								}).done(function(data, status, xhr) {
									console.log("data");
									
									var dataObj=eval("("+data+")");
									//check data not null
									if(dataObj['formula'][0]!=null){
										
									//dataCheckFormula=true;
									
									$.each(dataObj['formula'],function(index,indexEntry){
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
								                	    queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,"+indexEntry['result']+" AS "+calID+"";
								                           
								                    }else{
								                    	queryCalFormula+="select "+calID+" FROM(";
								                    	queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
								                    	   
								                    }
								            }else{
								            	if(indexEntry['status']=='OK'){
								            	       queryCalFormula+=" UNION ";
								            		   queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,"+indexEntry['result']+" AS "+calID+"";
								                    
								             }else{
								            	       queryCalFormula+=" UNION ";
								            	       queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
								             	   
								             }
								            }
										
									});
									
									//console.log(queryCalFormula);
									//console.log(eval("("+jsonData+")"));
									queryCalFormula+=")queryA where  EvTime=EvTime2) as "+queryPointArray[0]+"";
									
								}else{
									
									queryCalFormula+="select "+queryPointArray[0]+" FROM(";
			                    	queryCalFormula+="SELECT  \"00-00-00 00:00:00\" as EvTime,\"0\" AS "+queryPointArray[0]+"";
									queryCalFormula+=")queryA where  EvTime=EvTime2) as "+queryPointArray[0]+"";
								}
								//check data is not null
									
								});
						 //}
						 
						 //Read Data Cal End
						 
				        
				        
				        
				        
				        
				        
				        
				        
				    }else{
						 
							 //(SELECT D1 FROM datau04  WHERE EvTime=EvTime2) AS U04D1
							 queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datau0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
						 
				    }
						
					
			});
				
					queryPoint+=queryCalFormula;
			
				
				//alert(queryPoint);
				console.log(queryPoint);
				//alert(queryPoint):
				//return false;
		}else if(scaleTime=="Hour"){
			
			var queryCalFormula="";
			var queryPoint="";
			$.each(paramPointAndUnitArray,function(index,indexEntry){
				 //alert(indexEntry);
				
				 
				 
				 
				 
				 /*cal start*/
				 	
				 	var queryPointArray=indexEntry.split("-");
					var paramPointAndUnitArray=$("#paramPointEmbed-"+paramTrendID).val().split(","); 
					var queryPointCalArray="";
					var paramFromDate=$("#paramFromDate-"+paramTrendID).val();
					var paramToDate=$("#paramToDate-"+paramTrendID).val();
					
					
				 queryPointCalArray=queryPointArray[0]; 
				 queryPointCal=queryPointCalArray.substr(0,2);
				 
				 if(queryPointCal=='DC'){
				       
				        pointCal=queryPointArray[3];
				        console.log("pointCal1");
				        console.log(pointCal);
				       
				      //Read Data Cal Start
						// alert(queryPointArray[0]);
				        
						
						queryCalFormula+=",(";	
						
						 //for(var i=0;i<=2;i++){
						var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
						var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();	 
						//var endDate = currentDateTime();
						//var startDate=intervalDelFn(endDate,'hour',5);
						
						//alert(startDate);
						//alert(endDate);
						 var obj={
									key:paramTrendID+"-"+queryPointArray[0],
									startTime:paramFromDate,
									endTime:paramToDate,
									scaleType:"hour",
									//scaleType:scaleTime,
									server:"47",
							        //value:"U04D123+ U04D2+Enthalpy(U04D2;U04D2)"
							        value:pointCal
								}

								$.ajax({
									url:"/ajax/executeCalculation",
									method: "POST",
									data: obj,
									async:false,
								}).done(function(data, status, xhr) {
									console.log("data");
									
									var dataObj=eval("("+data+")");
									//check data not null
									if(dataObj['formula'][0]!=null){
										
									//dataCheckFormula=true;
									
									$.each(dataObj['formula'],function(index,indexEntry){
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
								                	    queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,"+indexEntry['result']+" AS "+calID+"";
								                           
								                    }else{
								                    	queryCalFormula+="select "+calID+" FROM(";
								                    	queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
								                    	   
								                    }
								            }else{
								            	if(indexEntry['status']=='OK'){
								            	       queryCalFormula+=" UNION ";
								            		   queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,"+indexEntry['result']+" AS "+calID+"";
								                    
								             }else{
								            	       queryCalFormula+=" UNION ";
								            	       queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
								             	   
								             }
								            }
										
									});
									
									//console.log(queryCalFormula);
									//console.log(eval("("+jsonData+")"));
									queryCalFormula+=")queryA where  EvTime=EvTime2) as "+queryPointArray[0]+"";
									
								}else{
									
									queryCalFormula+="select "+queryPointArray[0]+" FROM(";
			                    	queryCalFormula+="SELECT  \"00-00-00 00:00:00\" as EvTime,\"0\" AS "+queryPointArray[0]+"";
									queryCalFormula+=")queryA where  EvTime=EvTime2) as "+queryPointArray[0]+"";
								}
								//check data is not null
									
								});
						 //}
						 
						 //Read Data Cal End

				    }else{
				    	//alert("0="+queryPointArray[0]);
				    	//alert("1="+queryPointArray[1]);
				    	queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datahru0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
				    	//alert("queryPoint="+queryPoint);
				    }
				 /*cal end*/
				 	/*
					 if(index==0){
						 //(SELECT D1 FROM datau04  WHERE EvTime=EvTime2) AS U04D1
						 queryPoint+="(SELECT "+queryPointArray[0]+" FROM datahru0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					 }else{
						 queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datahru0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					}
					*/
						
				 
			});
			
			queryPoint+=queryCalFormula;
			
			
			//alert(queryPoint);
			console.log(queryPoint);
			
		}else if(scaleTime=="Month"){
			
			var queryCalFormula="";
			var queryPoint="";
			
			
			$.each(paramPointAndUnitArray,function(index,indexEntry){
				 //alert(indexEntry);
				 //queryPointArray=indexEntry.split("-");
				/*cal start*/
			 	
			 	var queryPointArray=indexEntry.split("-");
				var paramPointAndUnitArray=$("#paramPointEmbed-"+paramTrendID).val().split(","); 
				var queryPointCalArray="";
				var paramFromDate=$("#paramFromDate-"+paramTrendID).val();
				var paramToDate=$("#paramToDate-"+paramTrendID).val();
				
				
			 queryPointCalArray=queryPointArray[0]; 
			 queryPointCal=queryPointCalArray.substr(0,2);
			 
			 if(queryPointCal=='DC'){
			       
			        pointCal=queryPointArray[3];
			        console.log("pointCal1");
			        console.log(pointCal);
			       
			      //Read Data Cal Start
					// alert(queryPointArray[0]);
			        
					
					queryCalFormula+=",(";	
					
					 //for(var i=0;i<=2;i++){
					var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
					var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();	 
					//var endDate = currentDateTime();
					//var startDate=intervalDelFn(endDate,'hour',5);
					
					//alert(startDate);
					//alert(endDate);
					 var obj={
								key:paramTrendID+"-"+queryPointArray[0],
								startTime:paramFromDate,
								endTime:paramToDate,
								scaleType:"month",
								//scaleType:scaleTime,
								server:"47",
						        //value:"U04D123+ U04D2+Enthalpy(U04D2;U04D2)"
						        value:pointCal
							}

							$.ajax({
								url:"/ajax/executeCalculation",
								method: "POST",
								data: obj,
								async:false,
							}).done(function(data, status, xhr) {
								console.log("data");
								
								var dataObj=eval("("+data+")");
								//check data not null
								if(dataObj['formula'][0]!=null){
									
								//dataCheckFormula=true;
								
								$.each(dataObj['formula'],function(index,indexEntry){
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
							                	    queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,"+indexEntry['result']+" AS "+calID+"";
							                           
							                    }else{
							                    	queryCalFormula+="select "+calID+" FROM(";
							                    	queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
							                    	   
							                    }
							            }else{
							            	if(indexEntry['status']=='OK'){
							            	       queryCalFormula+=" UNION ";
							            		   queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,"+indexEntry['result']+" AS "+calID+"";
							                    
							             }else{
							            	       queryCalFormula+=" UNION ";
							            	       queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
							             	   
							             }
							            }
									
								});
								
								//console.log(queryCalFormula);
								//console.log(eval("("+jsonData+")"));
								queryCalFormula+=")queryA where  EvTime=EvTime2) as "+queryPointArray[0]+"";
								
							}else{
								
								queryCalFormula+="select "+queryPointArray[0]+" FROM(";
		                    	queryCalFormula+="SELECT  \"00-00-00 00:00:00\" as EvTime,\"0\" AS "+queryPointArray[0]+"";
								queryCalFormula+=")queryA where  EvTime=EvTime2) as "+queryPointArray[0]+"";
							}
							//check data is not null
								
							});
					 //}
					 
					 //Read Data Cal End

			    }else{
			 
			    	queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datadayu0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
			
			    }
				 
				 /*
					 if(index==0){
						 //(SELECT D1 FROM datau04  WHERE EvTime=EvTime2) AS U04D1
						 queryPoint+="(SELECT "+queryPointArray[0]+" FROM datahru0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					 }else{
						 queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datahru0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					}
				*/		
			});
			
			queryPoint+=queryCalFormula;
			console.log(queryPoint);
			
		}else if(scaleTime=="Second"){
			$.each(paramPointAndUnitArray,function(index,indexEntry){
				 //alert(indexEntry);
				 queryPointArray=indexEntry.split("-");
				 
					 if(index==0){
						 //(SELECT D1 FROM datau04  WHERE EvTime=EvTime2) AS U04D1
						 queryPoint+="(SELECT "+queryPointArray[0]+" FROM datahru0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					 }else{
						 queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datahru0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					}
						
			});
		}else if(scaleTime=="Day"){
			var queryCalFormula="";
			var queryPoint="";
			
			$.each(paramPointAndUnitArray,function(index,indexEntry){
				 //alert(indexEntry);
				// queryPointArray=indexEntry.split("-");
				 
				 
				 
				 /*cal start*/
				 	
				 	var queryPointArray=indexEntry.split("-");
					var paramPointAndUnitArray=$("#paramPointEmbed-"+paramTrendID).val().split(","); 
					var queryPointCalArray="";
					var paramFromDate=$("#paramFromDate-"+paramTrendID).val();
					var paramToDate=$("#paramToDate-"+paramTrendID).val();
					
					
				 queryPointCalArray=queryPointArray[0]; 
				 queryPointCal=queryPointCalArray.substr(0,2);
				 
				 if(queryPointCal=='DC'){
				       
				        pointCal=queryPointArray[3];
				        console.log("pointCal1");
				        console.log(pointCal);
				       
				      //Read Data Cal Start
						// alert(queryPointArray[0]);
				        
						
						queryCalFormula+=",(";	
						
						 //for(var i=0;i<=2;i++){
						var paramFromDate= $("#paramFromDate-"+paramTrendID+"").val();
						var paramToDate=  $("#paramToDate-"+paramTrendID+"").val();	 
						//var endDate = currentDateTime();
						//var startDate=intervalDelFn(endDate,'hour',5);
						
						//alert(startDate);
						//alert(endDate);
						 var obj={
									key:paramTrendID+"-"+queryPointArray[0],
									startTime:paramFromDate,
									endTime:paramToDate,
									scaleType:"day",
									//scaleType:scaleTime,
									server:"47",
							        //value:"U04D123+ U04D2+Enthalpy(U04D2;U04D2)"
							        value:pointCal
								}

								$.ajax({
									url:"/ajax/executeCalculation",
									method: "POST",
									data: obj,
									async:false,
								}).done(function(data, status, xhr) {
									console.log("data");
									
									var dataObj=eval("("+data+")");
									//check data not null
									if(dataObj['formula'][0]!=null){
										
									//dataCheckFormula=true;
									
									$.each(dataObj['formula'],function(index,indexEntry){
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
								                	    queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,"+indexEntry['result']+" AS "+calID+"";
								                           
								                    }else{
								                    	queryCalFormula+="select "+calID+" FROM(";
								                    	queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
								                    	   
								                    }
								            }else{
								            	if(indexEntry['status']=='OK'){
								            	       queryCalFormula+=" UNION ";
								            		   queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,"+indexEntry['result']+" AS "+calID+"";
								                    
								             }else{
								            	       queryCalFormula+=" UNION ";
								            	       queryCalFormula+="SELECT  \""+indexEntry['time']+"\" as EvTime,\"0\" AS "+calID+"";
								             	   
								             }
								            }
										
									});
									
									//console.log(queryCalFormula);
									//console.log(eval("("+jsonData+")"));
									queryCalFormula+=")queryA where  EvTime=EvTime2) as "+queryPointArray[0]+"";
									
								}else{
									
									queryCalFormula+="select "+queryPointArray[0]+" FROM(";
			                    	queryCalFormula+="SELECT  \"00-00-00 00:00:00\" as EvTime,\"0\" AS "+queryPointArray[0]+"";
									queryCalFormula+=")queryA where  EvTime=EvTime2) as "+queryPointArray[0]+"";
								}
								//check data is not null
									
								});
						 //}
						 
						 //Read Data Cal End

				    }else{
				 
				    	queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datadayu0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
				    }
					 
				 /*
					 if(index==0){
						 //(SELECT D1 FROM datau04  WHERE EvTime=EvTime2) AS U04D1
						 queryPoint+="(SELECT "+queryPointArray[0]+" FROM datadayu0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					 }else{
						 queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datadayu0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					}
				*/		
			});
			
			queryPoint+=queryCalFormula;
			console.log(queryPoint);
			
		}
		return queryPoint;
		
	}
	function callCreateFileServiceChart(starttime,endtime,point,_unit,mmunit,scaleTime,paramTrendID,unitIdPointId){
		

		//var queryPoint="111111";
		/*
		var queryPoint="";
		var queryPointArray="";
		var paramPointAndUnitArray=$("#paramPointEmbed-"+paramTrendID).val().split(","); 
		//alert(paramPointAndUnitArray);
		
		$.each(paramPointAndUnitArray,function(index,indexEntry){
			 //alert(indexEntry);
			 queryPointArray=indexEntry.split("-");
			 
				 if(index==0){
					 //(SELECT D1 FROM datau04  WHERE EvTime=EvTime2) AS U04D1
					 queryPoint+="(SELECT "+queryPointArray[0]+" FROM datau0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
				 }else{
					 queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datau0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
				}
					
		});
		*/
		//alert(queryPoint);
		
		
		if(scaleTime=="Hour"){
			//alert("scaleTime"+scaleTime);
			createFileServiceChart.createFileByHru(paramTrendID,unitIdPointId);
			//alert("hello create Hour");
			
		}else if(scaleTime=="Day"){
			
			createFileServiceChart.createFileByDayu(paramTrendID,unitIdPointId);
			//alert("hello create Day");
			
		}else if(scaleTime=="Month"){
			
			createFileServiceChart.createFileByMonthu(paramTrendID,unitIdPointId);
			//alert("hello create Day");
			
		}else if(scaleTime=="Second"){
			
			createFileServiceChart.createFileBySecondu(paramTrendID,unitIdPointId);
			//alert("hello createFileServiceChart");
			
		}else if(scaleTime=="Minute"){
			
			
			createFileServiceChart.createFileByMinuteu(paramTrendID,unitIdPointId);
			
		}else{
			
			//generateQueryByCalFn(paramTrendID);
			createFileServiceChart.createFileByMinuteu(paramTrendID,unitIdPointId);
			
			
			//generateQueryByCalFn(paramTrendID);
			//setTimeout(function(){
				//alert(readQueryByCalFn(paramTrendID));
			//},5000);
			
			/*
			$.ajax({
				url:"/ais/serviceTrend/createDataMinuteu/"+paramTrendID+"/"+starttime+"/"+endtime+"/"+generateQueryGetPointFn("Minute",paramTrendID)+"/"+unitIdPointId,
				type:"get",
				dataType:"json",
				async:false,
				success:function(data){
					//alert(data);
					if(data=='createJsonSuccess'){
						
						
						var data2=readJsonFilterFile(startDateTime5HaGoFn(endDatetimeHisFn(endtime)),endDatetimeHisFn(endtime),paramTrendID);
						//console.log(data2);
						
						if(data2==''){
							alert("Data is empty!");
							return false;
						}
						
						var minute=startDateTime5HaGoFn(endDatetimeHisFn(endtime)).split(" ");
						minute=minute[1];
						$("#startTimeForDisplay-"+paramTrendID+"").val(minute);
						//embed param startDate On Proccess
						 $("#paramStartDateOnProccess-"+paramTrendID).remove();
						 $("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+startDateTime5HaGoFn(endDatetimeHisFn(endtime))+"'>");
						 
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
			*/
		}
			/*
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
						console.log(data2);
						if(data2==''){
							alert("Data is empty!");
							return false;
						}
						var minute=startDateTime5HaGoFn(endDatetimeHisFn(endtime)).split(" ");
						minute=minute[1];
						$("#startTimeForDisplay-"+paramTrendID+"").val(minute);
						//embed param startDate On Proccess
						 $("#paramStartDateOnProccess-"+paramTrendID).remove();
						 $("body").append("<input type='hidden' name='paramStartDateOnProccess-"+paramTrendID+"' id='paramStartDateOnProccess-"+paramTrendID+"' value='"+startDateTime5HaGoFn(endDatetimeHisFn(endtime))+"'>");
						 
						setTimeout(function(){
							
							createTrendChart(getDataByMenute(data2,point),point,"60",paramTrendID);
							
							var lastObject = data2.pop();
							setDefaultPointAndPlan(lastObject,point,paramTrendID);
						},1000);
						
					}
				}
			});
		}
		
		*/
		
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
	
	
	
	
	
	function pointCheckbox(paramPointId,paramTrendID){
		var point1="";
		$("input[name='pointEdit-"+paramTrendID+"']").filter(function() {
			point1=$(this).val().split("-");
			point1=point1[2];
			//alert("point1="+point1+"="+paramPointId);
			
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
				//console.log("///////////////////");
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
		var unitIdPointId="";
		
		//alert(pointData.length);
		
		for(var i=0;i<pointData.length;i++){
			//alert(pointData[i]);
			pointDataSub=pointData[i].split("-");
			
			
			if(i==0){
				
				pointDataId+=pointDataSub[0];
				pointUnitId+=pointDataSub[1];
				pointId+=pointDataSub[2];
				unitIdPointId+="U0"+pointDataSub[1]+""+pointDataSub[0];
			}else{
				pointDataId+=','+pointDataSub[0];
				pointUnitId+=','+pointDataSub[1];
				pointId+=','+pointDataSub[2];
				unitIdPointId+=",U0"+pointDataSub[1]+""+pointDataSub[0];
			}
			
		}
		if(returnType=="pointDataId"){
			return pointDataId;
		}else if(returnType=="pointUnitId"){
			return pointUnitId;
		}else if(returnType=="pointId"){
			return pointId;
		}else if(returnType=="unitIdPointId"){
			return unitIdPointId;
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

		$(".btnScaleTimeArea").popover('hide');
		$(".btnScaleTimeArea").removeClass("clicked");
		
	});
	
	
	
    
	/*
	$(document).on("click",".btnScaleTimeArea",function(event){
		$(this).popover('show');
	});
	*/
	 
	 function validateTime (paramFromDate,paramToDate,scaleTime){
		 var txt="";
		 //alert("Month1");
			 //test compare data here start...
			 var fromDateTest= toTimestamp(paramFromDate);
			 var toDateTest= toTimestamp(paramToDate);
			 
			 
		if(scaleTime=='Second'){
			//
			
			var trendActive=$("#trendTabActive").val();
			var paramMinute=$("#minute-"+trendActive).val();
			
			 if(paramMinute>=10){
				 txt+="Scale Time Second ดูข้อมูลได้ไม่เกิน 10 นาที \n";
			 }
			 
		}else{
			
			 if(fromDateTest > toDateTest){
					
				 txt+="เลือกช่วงเวลาไม่ถูกต้อง /n";
				//return false;
			 }
			 
			 if(fromDateTest <= toDateTest){
				 
				 var a = moment(paramFromDate,'YYYY-M-D');
				 var b = moment(paramToDate,'YYYY-M-D');
				
				 //alert("Month2");
				if(scaleTime=='Month'){
					
					 var diffMonth = b.diff(a, 'months');
					// alert(diffMonth);
					 if(diffMonth>12){
						 txt+="Scale Time Months ดูข้อมูลได้ไม่เกิน 12 เดือน \n";
					 }
					 
				}else if(scaleTime=='Day'){
					var diffMonth = b.diff(a, 'months');
					 if(diffMonth>1){
						 txt+="Scale Time Day ดูข้อมูลได้ไม่เกิน 1 เดือน \n";
					 }
				}else if(scaleTime=='Hour'){
					var diffDays = b.diff(a, 'days');
					 if(diffDays>7){
						 txt+="Scale Time Hour ดูข้อมูลได้ไม่เกิน 7 วัน \n";
					 }
				}else if(scaleTime=='Minute'){
					var diffDays = b.diff(a, 'days');
					 if(diffDays>1){
						 txt+="Scale Time Minute ดูข้อมูลได้ไม่เกิน 1 วัน \n";
					 }
				}
				
				
				
			//return false;
				 
			 }
			 
			 
		}
			
			 
			 
		return txt;	
			
	 }
	 
	
	 
	 
	 
	 $(document).on("click",".btnScaleTime",function(event){
		
		var paramTrendID=this.id.split("-");
		paramTrendID=paramTrendID[1];
		
		
		
		
		var dateFrom = $("#dateFrom-"+paramTrendID).val();
		var dateTo = $("#dateTo-"+paramTrendID).val();
		var scaleTime = $("#scaleTime-"+paramTrendID).val();
		/*
		alert("dateFrom="+dateFrom);
		alert("dateTo="+dateTo);
		alert("scaleTime="+scaleTime);
		*/
		 var validate=validateTime(dateFrom,dateTo,scaleTime);
		 if(validate!=""){
			 alert(validate);
			 return false;
		 }else{
			 startUpFn('N',paramTrendID);
		 }
		//$(".btnScaleTimeArea").click();
		
		
		$(".popover").popover('hide');
		
	 });
	 
	
	 //read file json start

	 function readJsonFilterFile(startTime,endTime,paramTrendID){
		 //return ("ok");
		 /*
		 alert(startTime);
		 alert(endTime);
		 //Read Data Cal Start
		 
		 var jsonData="";
		 jsonData+="[";
		 for(var i=0;i<=2;i++){
			 
		 var obj={
					key:paramTrendID+"-c10"+i,
					startTime:startTime,
					endTime:endTime,
					scaleType:"minute",
					//scaleType:"month",
					server:"47",
			        value:"U04D123+ U04D2+Enthalpy(U04D2;U04D2)"
				}

				$.ajax({
					url:"/ajax/executeCalculation",
					method: "POST",
					data: obj,
					async:false,
				}).done(function(data, status, xhr) {
					//console.log(data);
					var dataObj=eval("("+data+")");
					
					//var results = jQuery.parseJSON(data);
					console.log(dataObj['formula'][0]);
					
					
					
					$.each(dataObj['formula'],function(index,indexEntry){
						var calID=indexEntry['key'].split("-");
						calID=calID[2];
						if(index==0){
							if(i==0){	
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
						}else{
							if(indexEntry['status']=='OK'){
								jsonData+=",{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":"+indexEntry['result']+"}";
							}else{
								jsonData+=",{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":0}";
							}
						}
					
						
					});
					
					console.log(jsonData);
					//console.log(eval("("+jsonData+")"));
					
					
					
					
				});
		 }
		 jsonData+="]";
		 */
		 //Read Data Cal End

		 
		 var jsonFilter = new Array();
		 $.ajax({
				url:"/ais/serviceTrend/readDataMinuteu/"+paramTrendID+"",
				type:"get",
				async:false,
				dataType:"json",
				//data:{"paramTrendID":paramTrendID},
				success:function(data){
					console.log(data);
					
					/*
					 if(data==""){
						return false;
					}
					*/
					$.each(data,function(index,indexEntry){
						
						if((toTimestamp(indexEntry['EvTime'])>=toTimestamp(startTime)) && (toTimestamp(indexEntry['EvTime'])<=toTimestamp(endTime))) {
							
							jsonFilter.push(indexEntry);
							//console.log("---------");
							//console.log(eval("("+indexEntry+")"));
							/*
							EvTime
	
								"2014-05-03 15:06:00"
							U04D3
								
								15.039799690247
							U04D4
								
								-0.00066692900145426
							U04D7
								
								80.909301757812
							 */
							
						}
						
					});
					
					//console.log(jsonFilter);
					
					
					
				}
		 });
		 return jsonFilter;
		 //alert(jsonFilter);
		 //alert(jsonData);
		 
	 }
	 //test
	 //readJsonFilterFile("2014-5-3 10:00:00","2014-5-3 10:49:11","3041");
	 
	
	 function dateFromPicker(paramTrendID){
		 
		// $("#dateFromArea-"+paramTrendID+"").html("<input type='text' id='dateFrom-"+paramTrendID+"' value='07/01/2014' class='form-control input-sm' style='width: 100%'>");
		 
		 var dateFrom="";
		// alert($("#paramFromDate-"+paramTrendID+"").val());
		 if($("#paramFromDate-"+paramTrendID+"").val()!=undefined){
			 dateFrom=$("#paramFromDate-"+paramTrendID+"").val();
		 }else{
			 //dateFrom=currentDate();
			 
			 dateFrom=intervalDelFn(currentDateTime(),'day',1);
			 //dateFrom="2014-05-17 00:00:00";
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
			 dateTo=currentDate();
			 //dateTo="2014-05-18 00:00:00";
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
		 
		
		 
		 
		 
		 var id=this.id.split("-");
		 id=id[1];
		 var unitID = id.substring(1, 3);
		 
		//for delete other is not selected
		 $(".paramEmbedArea").empty();
		 $("#tooltipUnit").remove();
		 $("body").append('<input type="hidden" value='+unitID+' id="tooltipUnit"  name="tooltipUnit">');
		// alert(id);
		 var paramEmbedEvent="";
		 var dataForTooltipUl="";
		 var dataForTooltipLi="";
		 $('input[name="pointEvent"]:checked').each(function() {
			 
			 // alert(id);
			 // alert(this.value);
			 
			  paramEmbedEvent+="<input type='hidden' id='param"+this.value+"-"+id+"-"+$("#trendTabActive").val()+"' class='paramEvent-"+id+"' value='"+this.value+"'>";
			  dataForTooltipLi+="<li id=tooltip-"+this.value+"-"+id+"-"+$("#trendTabActive").val()+" class='paramEvent-"+id+"'>"+this.value+":</li>";
			  
		 });
		 
		 $("#paramEmbedArea-"+id+"-"+$("#trendTabActive").val()).html(paramEmbedEvent);
		 
		 //Embed Tooltip Area
		 //$("#showPoin-"+id+"-"+$("#trendTabActive").val()+">.pointName").text()+
		 console.log($("#tooltipUl-"+id+"-"+$("#trendTabActive").val()).get());
		 //console.log( $("ul#tooltip-"+id+"-"+$("#trendTabActive").val()).empty(););
		 
		 dataForTooltipUl+="<div id='"+unitID+"' class='tooltipUnit tooltipPointName-"+id+"-"+$("#trendTabActive").val()+"'><b>"+$("#showPoint-"+id+"-"+$("#trendTabActive").val()+">.pointName").text()+"</b></div><ul class='tooltipUl-"+id+"-"+$("#trendTabActive").val()+"'>"+dataForTooltipLi+"</ul>";
		 
		 
		 $(".tooltipUl-"+id+"-"+$("#trendTabActive").val()).remove();
		 $(".tooltipPointName-"+id+"-"+$("#trendTabActive").val()).remove();
		 
		 //$("#tooltip").append(dataForTooltipUl);
		 //for delete other is not selected
		 $("#tooltip").html(dataForTooltipUl);
		 
		 if(dataForTooltipLi==""){
			 $(".tooltipPointName-"+id+"-"+$("#trendTabActive").val()).remove();
		 }
		 
		 if($.trim($("#tooltip").text())!=""){
			 $("#hiddenTooltip").remove();
			 //loadEventForTrend();
			 tooltipCustom($("#trendTabActive").val(),true);
		 }else{
			 $("#hiddenTooltip").remove();
			 $("body").append("<input type='hidden' id='hiddenTooltip' name='hiddenTooltip' value='hiddenTooltip'>");
		 }
		 
		 
		 //set max scale here start.
		 
		 var maxScale = $("#maxScale-"+id+"-"+$("#trendTabActive").val()).val();
		 //alert(maxScale);
		 //set max scale here end.
		 
		 
		 //$(".btnSetingPoint-"+id+"").click();
		 $(".popover").popover('hide');
		 
		 
	 });
	 
	 
	 
	 $(document).on("click",".btnCancelSetingPoint",function(event){
		
		 var id=this.id.split("-");
		 id=id[1];
		 //$(".btnSetingPoint-"+id+"").click();
		 $(".popover").popover('hide');
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
		var pointIdEmbed="";
		//alert(paramTrendID);
	
		if($(this).hasClass("hiddenPoint")){
			$(this).addClass("showPoint");
			$(this).removeClass("hiddenPoint");
	
			paramPointList=$(".showPoint>.pointId-"+paramTrendID+"").text().substring("1");
			pointIdEmbed=$(".showPoint>.pointId2-"+paramTrendID+"").text().substring("1");
			//alert("1"+paramPointList);
			//$("#paramPointByShowOrHidden").val(paramPointList);
			
			//readJsonShowHiddenPointFn(paramPointList,paramTrendID);
			//$("#paramPoint").val(paramPointList)
			
		}else{
			
			
			$(this).addClass("hiddenPoint");
			$(this).removeClass("showPoint");
			
			paramPointList=$(".showPoint>.pointId-"+paramTrendID+"").text().substring("1");
			pointIdEmbed=$(".showPoint>.pointId2-"+paramTrendID+"").text().substring("1");
			//alert("2"+paramPointList);
			//$("#paramPointByShowOrHidden").val(paramPointList);
			//readJsonShowHiddenPointFn(paramPointList,paramTrendID);
			//$("#paramPoint").val(paramPointList)
			
			
		}
		//alert(id);
		
		var pointArray=$(".showPoint").parent().parent().parent().get();
		//console.log(pointArray);
		
		var $colorIndex = [];


		
		
		$.each(pointArray,function(index,indexEntry){
			console.log(indexEntry);
			console.log(indexEntry.id);
			var indexData=indexEntry.id.split("-");
			indexData=indexData[1];
			$colorIndex.push(indexData);
			
		});
		
		readJsonShowHiddenPointFn(paramPointList,paramTrendID,$colorIndex);
		$("#paramPointEmbed-"+paramTrendID).val(pointIdEmbed);
		
		
	});
	
	//showPoint/hiddenPoint end
	
	
	 
	 
	 
	 function startUpFn(paramInitail,paramTrendID,paramScaleTime,paramHour,paramMinute,paramFromDate,paramToDate){
			//create query for cal
		 	//generateQueryByCalFn(paramTrendID);
			//alert(paramHour);
			//alert(paramMinute);
			
			var fromDate="";
			var toDate="";
			if(paramInitail=="Y"){
				
				fromDate="2014-05-01 00:00:00";
				toDate="2014-05-02 23:59:59";
				
			}else{
				if((paramFromDate!=undefined) || (paramToDate!=undefined)){
					fromDate=paramFromDate;
					toDate=paramToDate;
				}else{
					fromDate=$("#dateFrom-"+paramTrendID+"").val()+" 00:00:00";
					toDate=$("#dateTo-"+paramTrendID+"").val()+" 23:59:59";
				}
			}
			

			$(".paramDateEmbed-"+paramTrendID+"").remove();
			var paramDateEmbed="";
			paramDateEmbed+="<input type='hidden' name='paramFromDate-"+paramTrendID+"' id='paramFromDate-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+fromDate+"'>";
			paramDateEmbed+="<input type='hidden' name='paramToDate-"+paramTrendID+"' id='paramToDate-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+toDate+"'>";
			
			if(paramScaleTime!=undefined){
				paramDateEmbed+="<input type='hidden' name='paramScaleTime-"+paramTrendID+"' id='paramScaleTime-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+paramScaleTime+"'>";
			}else{
				paramDateEmbed+="<input type='hidden' name='paramScaleTime-"+paramTrendID+"' id='paramScaleTime-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+$("#scaleTime-"+paramTrendID+"").val()+"'>";
			}
			if((paramHour!=undefined) ||(paramMinute!=undefined )){
				paramDateEmbed+="<input type='hidden' name='paramHour-"+paramTrendID+"' id='paramHour-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+paramHour+"'>";
				paramDateEmbed+="<input type='hidden' name='paramMinate-"+paramTrendID+"' id='paramMinate-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+paramMinute+"'>";
			}else{
				paramDateEmbed+="<input type='hidden' name='paramHour-"+paramTrendID+"' id='paramHour-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+$("#hour-"+paramTrendID+"").val()+"'>";
				paramDateEmbed+="<input type='hidden' name='paramMinate-"+paramTrendID+"' id='paramMinate-"+paramTrendID+"' class='paramDateEmbed-"+paramTrendID+"' value='"+$("#minute-"+paramTrendID+"").val()+"'>";
			}
			$("body").append(paramDateEmbed);

			var pointId =getDataFromPointEmbed("pointId");
			var pointDataId= getDataFromPointEmbed("pointDataId");
			var unitIdPointId= getDataFromPointEmbed("unitIdPointId");
			
			//show layout right
			//alert(pointId);
			callDataLayoutPointRight(pointId,paramTrendID);
			//create file for chart
			
			var scaleTime=$("#paramScaleTime-"+paramTrendID+"").val();
			
			//alert(scaleTime);
			//alert("2="+scaleTime);
			
			if(scaleTime=='Minute'){
				
				
				//expandFocus defualt
				$(".timeFocusExpand").show();
				$(".setTimeCustomArea").show();
				$("#expandFocus-"+paramTrendID).val("4 Hour");
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").show();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").hide();
				$(".timeFocusExpand").show();
			}else if(scaleTime=='Hour'){
				$(".timeFocusExpand").hide();
				$(".setTimeCustomArea").hide();
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").show();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").hide();
				
			}else if(scaleTime=='Day'){
				$(".timeFocusExpand").hide();
				$(".setTimeCustomArea").hide();
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").show();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").hide();
				
			}else if(scaleTime=='Month'){
				$(".timeFocusExpand").hide();
				$(".setTimeCustomArea").hide();
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").show();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").hide();
				
			}else if(scaleTime=='Second'){
				//expandFocus defualt
				$(".timeFocusExpand").show();
				//$(".setTimeCustomArea").show();
				$(".setTimeCustomAreaSecondHidden").hide();
				$("#expandFocus-"+paramTrendID).val("1 Min");
				$("#dateInDataDisplayAreaMenute-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHour-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaHourDay-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaMonth-"+paramTrendID+"").hide();
				$("#dateInDataDisplayAreaSecond-"+paramTrendID+"").show();
				
			}else{
				
				//expandFocus defualt
				$(".timeFocusExpand").show();
				$(".setTimeCustomArea").show();
				
				$("#expandFocus-"+paramTrendID).val("4 Hour");
			}
			
			
			var paramUnitEmbedCall="";
			//alert($("#paramUnitEmbed-"+paramTrendID+"").val());
			
			if($("#paramUnitEmbed-"+paramTrendID+"").val()=='All'){
				paramUnitEmbedCall="All";
			}else{
				paramUnitEmbedCall="0"+$("#paramUnitEmbed-"+paramTrendID+"").val();
			}
			//alert("paramUnitEmbedCall="+paramUnitEmbedCall);
			
			
			
			//alert(getDataFromPointEmbedNotCalID());
			//alert(unitIdPointId);
			callCreateFileServiceChart(fromDate,toDate,pointDataId,mmPlant,paramUnitEmbedCall,scaleTime,paramTrendID,unitIdPointId);
			
			
			
			//set title between for display
			//alert(fromDate);
			setScaleDateTimeFn(fromDate,toDate,paramTrendID);
			//show date for left layout
			$(".popover").popover('hide');
			/*
			alert(toDate);
			alert(convertDateTh(toDate));
			*/
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
						 //$(this).popover('hide');
					 }else{
						 $(this).addClass("clicked");
						 //$(this).popover('show');
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
					//var seek=3;
					// alert(seek);
					 var seek=0;
					 seek=parseInt($("#expandFocus-"+paramTrendID).val());
					 seek=(seek-1);
					 //alert("1="+seek);
					//var seek="";
					 	$("#focus-"+paramTrendID+"").off();
					 	$("#focus-"+paramTrendID+"").on("click",function(){
					 		
					 		//alert("2="+seek);
					 		
					 		
					 		
					 		
					 		if($("#paramScaleTime-"+paramTrendID).val()=="Second"){
					 			// seek=(seek-1);
					 			
					 			if(seek>=0){
						 			if(seek<=0){
						 				seek=0;
						 			}else{
						 				seek=seek-1;
						 			}
							 			$("#expandFocus-"+paramTrendID+"").val(rangSecond[seek]+" Min");
							 			$("#scaleTimeMenuLeftArea-"+paramTrendID+"").text(rangSecond[seek]+" Min");
							 			readJsonExpandFocusFn(rangSecond[seek],paramTrendID,$("#paramScaleTime-"+paramTrendID).val());
						 			
							 	}
					 			
				 				
				 			}else{

				 			//scaleTime = manute	
				 				//alert("1="+seek);
				 				//seek=seek;
				 				//alert(seek);
						 		if(seek>=0){
						 			//alert("2="+seek);
						 			if(seek<=0){
						 				seek=0;
						 			}else{
						 				seek=seek-1;
						 			}
							 			$("#expandFocus-"+paramTrendID+"").val(rangHour[seek]+" Hour");
							 			$("#scaleTimeMenuLeftArea-"+paramTrendID+"").text(rangHour[seek]+" Hour");
							 			readJsonExpandFocusFn(rangHour[seek],paramTrendID);
						 			
							 	}
						 	}
					 		
					 		
					 	});
					 	$("#expand-"+paramTrendID+"").off();
					 	$("#expand-"+paramTrendID+"").on("click",function(){
					 		
					 		
					 		//alert(rangHour.length);
					 	if($("#paramScaleTime-"+paramTrendID).val()=="Second"){
					 		
					 		if(seek<rangSecond.length){
					 			if(seek>=9){
					 				seek=9;
					 			}else{
					 				seek=seek+1;
					 			}
					 			//alert(rangHour[seek]+","+seek);
					 			$("#expandFocus-"+paramTrendID+"").val(rangSecond[seek]+" Min");
					 			$("#scaleTimeMenuLeftArea-"+paramTrendID+"").text(rangSecond[seek]+" Min");
					 			//slideScaleFn(paramTrendID,rangHour[seek]);
					 			readJsonExpandFocusFn(rangSecond[seek],paramTrendID,$("#paramScaleTime-"+paramTrendID).val());
					 			
					 		}
					 		
					 			
					 	}else{
					 		
					 		if(seek<rangHour.length){
					 			if(seek>=9){
					 				seek=9;
					 			}else{
					 				seek=seek+1;
					 			}
					 			//alert(rangHour[seek]+","+seek);
					 			$("#expandFocus-"+paramTrendID+"").val(rangHour[seek]+" Hour");
					 			$("#scaleTimeMenuLeftArea-"+paramTrendID+"").text(rangHour[seek]+" Hour");
					 			//slideScaleFn(paramTrendID,rangHour[seek]);
					 			readJsonExpandFocusFn(rangHour[seek],paramTrendID);
					 			
					 		}
					 	}
					 	});
					 //focus expand end
					 	
					 	
					 	
					 	
						
					// var startTimeDisplay=0;
					//reduce start time start
					 	
					$("#reduceStartTime-"+paramTrendID+"").off("click");
					$("#reduceStartTime-"+paramTrendID+"").on("click",function(){
						//startTimeDisplay=startTimeDisplay-1;
						startTimeDisplay=-1;
						//alert(startTimeDisplay);
						
						readJsonReduceStartTimeDisplayFn(startTimeDisplay,paramTrendID);
						
					});
					
					//reduce start time end
					
					//increase start time start
					$("#increaseStartTime-"+paramTrendID+"").off("click");
					$("#increaseStartTime-"+paramTrendID+"").on("click",function(){
						//startTimeDisplay=startTimeDisplay+1;
						startTimeDisplay=+1;
						//alert(startTimeDisplay);
						readJsonIncreaseStartTimeDisplayFn(startTimeDisplay,paramTrendID);
						
					});
					
					//increase start time start
					
					
					//reduce start day start
					// var startDayDisplay=0;
					$("#reduceDay-"+paramTrendID+"").off();
					$("#reduceDay-"+paramTrendID+"").click(function(){
						//startDayDisplay=startDayDisplay-1;
						startDayDisplay=-1;
						readJsonReduceDayDisplayFn(startDayDisplay,paramTrendID);
					});
					
					//reduce start day end
					
					
					//increase start day start
					$("#increaseDay-"+paramTrendID+"").off();
					$("#increaseDay-"+paramTrendID+"").on("click",function(){
						//startDayDisplay=startDayDisplay+1;
						startDayDisplay=+1;
						readJsonIncreaseDayDisplayFn(startDayDisplay,paramTrendID);
					});
					
					//increase start day end
					
					//slider start
						/*Ananble Start slideScaleFn(paramTrendID,'4','Y');*/
					//slider end
					
					
					
					
					//EDIT POINT START
					$(".editTrendPoint").off("click");
					$(".editTrendPoint").on("click",function(){
						
						//alert 
						//alert("อยู่ในระหว่างการปรับปรุง...");
						//return false;
						
						
						var unitHtml="";
						$.ajax({
							url:'/ais/trendSetting/getMMPlant',
							dataType:'json',
							async:false,
							success:function(data){
								//alert(data);
								//console.log(data);
								if(data==1){
									
								unitHtml+="<select name=\"editUnit\" id=\"editUnit\" class=\"form-control input-sm\" style='display:'>";
									unitHtml+="<option selected value='All'>All Unit</option>";
									unitHtml+="<option value='4'>MM04</option>";
					                unitHtml+="<option value='5'>MM05</option>";
					                unitHtml+="<option value='6'>MM06</option>";
					                unitHtml+="<option value='7'>MM07</option>";
					            unitHtml+="</select> ";
								}else{
								unitHtml+="<select name=\"editUnit\" id=\"editUnit\" class=\"form-control input-sm\" style='display:'>";
									unitHtml+="<option selected value='All'>All Unit</option>";
									unitHtml+="<option value='8'>MM08</option>";
					                unitHtml+="<option value='9'>MM09</option>";
					                unitHtml+="<option value='10'>MM10</option>";
					                unitHtml+="<option value='11'>MM11</option>";
					                unitHtml+="<option value='12'>MM12</option>";
					                unitHtml+="<option value='13'>MM13</option>";
					            unitHtml+="</select> ";
					            
								}
							}
						});
						$("#listAllUnitEditArea").html(unitHtml);
						
						var paramTrendID=$("#trendTabActive").val();
						var paramTrendName=$("#paramTrendNameEmbed-"+paramTrendID).val();
						var paramUnit=$("#paramUnitEmbed-"+paramTrendID).val();
						
						
						$("#editTrendName-"+paramTrendID).html(paramTrendName);
						//editUnit
						//check selected option
						var val1 =paramUnit;
						$("select#editUnit option").filter(function() {
						    return $(this).val() == val1; 
						}).prop('selected', true);
					
					 	//$("#editUnit").kendoDropDownList();

						editTrendPointFn(paramTrendID,paramUnit);

						var paramPointId=getDataFromPointEmbed("pointId");
						var paramPointEmbedArray=$("#paramPointEmbed-"+paramTrendID).val();
						var paramPointEmbed=paramPointEmbedArray.split(",");
						paramPointId=paramPointId.split(",");
						var paramPoint="";
						for(var i=0;i<paramPointId.length;i++){
							//alert(paramPointId[i]);
							//alert(paramPointEmbed[i].substring("1"));
						
							paramPoint+="<input type='hidden' class='paramPointEmbedPrePlot-"+paramTrendID+"' id='paramPointEmbedPrePlot-"+paramPointEmbed[i].substring("1")+"' name='paramPointEmbedPrePlot-"+paramPointEmbed[i].substring("1")+"' value='"+paramPointEmbed[i].substring("1")+"'>";
							pointCheckbox(paramPointId[i],paramTrendID);
							
						}
						$("body").append(paramPoint);
						
						
						
						$("select#editUnit").change(function(){
							
							  editTrendPointFn(paramTrendID,$(this).val());
							  
							  $("#paramUnitEmbed-"+paramTrendID+"").remove();
							  var paramUnit="";
							  paramUnit+="<input type='hidden' id='paramUnitEmbed-"+paramTrendID+"' name='paramUnitEmbed-"+paramTrendID+"' value='"+$(this).val()+"'>";
							  $("body").append(paramUnit);
						});
						
						
						
						 $("#btnEditPlotGraph").off("click");
						 $("#btnEditPlotGraph").on("click",function(){
							  // plotGraphFn();
							  // plotGraphFn('Initial','N',$("#paramTrendIDEmbed").val());
							 var paramTrendID = $("#trendTabActive").val();
							 var scale = parseInt($("#scaleTimeMenuLeftArea-"+$("#trendTabActive").val()+"").text());
							  $(".paramPointEmbed-"+paramTrendID+"").remove();
							  
							  //embed point start
							  //var pointChecked = $('input[name=point]:checked');
							  var pointChecked = $(".pointEdit-"+paramTrendID+":checked");
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
							  $(".paramPointEmbedPrePlot-"+paramTrendID).remove();
							  //embed point start
							  var pointId =getDataFromPointEmbed("pointId");
							  
							  
							  //Create Data Here Start.
							 // alert($("#paramScaleTime-"+paramTrendID).val());
							  
							
							  plotGraphFn('Edit','N',paramTrendID,$("#paramScaleTime-"+paramTrendID).val());
							  /*
							  if($("#paramScaleTime-"+paramTrendID).val()=="Second"){
								  alert("Second");
								  
							  }else{
								  alert("Minute");
								  plotGraphFn('Edit','N',$("#paramTrendIDEmbed").val());
								  //callDataLayoutPointRight(pointId,paramTrendID);
							  }
							  */
							  //Create Data Here End.
							  
							  $('#editTrendPointModal').modal('hide');
							  
						 });
						 
						
						
					});
					//EDIT POINT END
					
					
					
					 
		}
	 $(document).ready(function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
	
		});
	
	 
//});
//}