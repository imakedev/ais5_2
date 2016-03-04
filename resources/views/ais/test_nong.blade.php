@extends('layouts.main')

@section('page_title','ทั่วไป')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
   
   
   <!-- http://10.249.99.107/steamtable/rest/calculation 
   $.ajax({
        url: "your url which return json",
        type: "POST",
        crossDomain: true,
        data: data,
        dataType: "json",
        success:function(result){
            alert(JSON.stringify(result));
        },
        error:function(xhr,status,error){
            alert(status);
        }
    });
   ================ Send Start =================
   {

  "formula": [

    {

      "key": "1",

      "value": "(100/3)*20"

    },

    {

      "key": "2",

      "value": "(300/3)*20"

    }

  ]

}
================ Send End =================
================ Result ===================
   {

  "formula" : [ {

    "key" : "1",

    "value" : "(100/3)*20",

    "result" : "700"

  }, {

    "key" : "2",

    "value" : "(300/3)*20",

    "result" : "600"

  } ]

}
================ Result ===================
   -->
   
   <button id='btnCallWSAndData'>btnCallWSAndData1</button> 
   <button id='btnCallWS2'>btnCallWebService2</button>
   <!--<button id='btnCallAjax'>btnCallAjax</button>-->
   <button id='btnTestSplitFormula'>btnTestSplitFormula3</button>
   <button id='readJsonFilterFile'>readJsonFilterFile</button>
    <script>

  //toTimestamp();

    //read file json start
$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	 function readJsonFilterFile(startTime,endTime,paramTrendID){
		 //return ("ok");
		// alert(startTime);
		 //alert(endTime);
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
							
							//jsonFilter.push(indexEntry);
							
							console.log("---------");
							console.log(indexEntry["EvTime"]);
							console.log(indexEntry);
							
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
		 //return jsonFilter;
		 //alert(jsonFilter);
		 alert(jsonData);
		 
	 }
	 //test
	 $("#readJsonFilterFile").click(function(){
		 readJsonFilterFile("2014-5-3 10:00:00","2014-5-3 10:49:11","3041");
     });
	 
	 












    
    function callBackFormula_bk(data){
 
        //Formatt start
         /*
         [{"EvTime":"2014-05-26 00:00:00","U04D260":-195.08799743652,"U05D260":-195.08799743652},
         {"EvTime":"2014-05-26 00:00:00","U04D260":-195.08799743652,"U05D260":-195.08799743652}]
        */
        
        //Format end
        //Gen data json format start
        var dataCalFormula="";
        dataCalFormula="[";
            $.each(data['formula'],function(index,indexEntry){
                
            	/*
            	console.log("Loop=========== Start"+index);
                console.log(indexEntry['key']);
                console.log(indexEntry['value']);
                console.log(indexEntry['result']);
                console.log(indexEntry['time']);
                console.log(indexEntry['status']);
                console.log("Loop=========== End");
                */
               // 
                var keyArray=indexEntry['key'].split("-");
                var calID="";
                var trendID="";
                calID=keyArray[2];
                trendID=keyArray[1];
                
                if(index==0){
                    if(indexEntry['status']=='OK'){
                    	    dataCalFormula+="{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":\""+indexEntry['result']+"\"}";
                               
                        }else{
                        	dataCalFormula+="{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":\"0\"}";
                        	   
                        }
                }else{
                	if(indexEntry['status']=='OK'){
                		  dataCalFormula+=",{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":\""+indexEntry['result']+"\"}";
                        
                 }else{
                	      dataCalFormula+=",{\"EvTime\":\""+indexEntry['time']+"\",\""+calID+"\":\"0\"}";
                 	   
                 }
                }
            });
            dataCalFormula+="]";

            
 
            var objDataCalFormula=eval("("+dataCalFormula+")");
            console.log(objDataCalFormula);
            alert(objDataCalFormula);
            return objDataCalFormula;
        //Gen data json format end
        
      
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
        
        var calID="";
        var trendID="";
        queryCalFormula="(";
            $.each(data['formula'],function(index,indexEntry){
            	/*
            	console.log("Loop=========== Start"+index);
                console.log(indexEntry['key']);
                console.log(indexEntry['value']);
                console.log(indexEntry['result']);
                console.log(indexEntry['time']);
                console.log(indexEntry['status']);
                console.log("Loop=========== End");
                */
               //
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
 
           

            //console.log(queryCalFormula);
            $("#calID-"+calID).remove();
            $("body").append("<div class='calData-"+trendID+"' id='calID-"+calID+"'>"+queryCalFormula+"</div>");
            //alert(queryCalFormula);
            //console.log(queryCalFormula);
           // return queryCalFormula;
        //Gen data json format end
        


            
    }
    function nomalFormula(str){
    	var formulas={
    		"formula":[
    			{"key":"1","value":str.toLowerCase()} // ,
    			// {"key":"2","value":"(300/3)*20"}
    		],
    		"callBackName":"callBackFormula"
    	}
    	$.ajax({
    		url:"http://10.249.99.107:8080/steamtable/rest/calculation",
    		//url: "http://localhost:3000/v1/calculation",
    		method: "POST",
    		dataType: "jsonp",
    		jsonp: "callBackFormula",
    		data: formulas
    	}).done(function(data, status, xhr) {
			console.log(data);
			alert("done");
			
		});

    }
    function callBackFormula2(data){
    	var resultMessage=data.formula[0].result;
    	if(data.formula[0].status=='ERROR'){
    		resultMessage="<span style='color: red;'>"+data.formula[0].result+"</span>";
    	}
    	$("#extract_section").html("<b>Extract : </b>"+data.formula[0].value)
    	$("#result_section").html("<b>Result : </b>"+resultMessage);
    	$("#myModalFormula").modal()
    	console.log(data);
    	//alert(data.formula.length)
    	//alert(data.formula[0].key +" value="+data.formula[0].value)
    	//var formula=jQuery.parseJSON(data);
    	//alert("x")
    }
    function readFomala(formalaData,trendID,calID){

    	$.ajax({
			url: "/ajax/calculation/readExtractFormulaByTrend/"+trendID+"/"+calID+"",
			method: "GET",
			sync:false,
		}).done(function(datatxt, status, xhr) {
			console.log(datatxt);
		    var data=eval("("+datatxt+")");
		    
		    console.log("...");
			console.log(data.unit_array);
			
			
			 //data return here start

	    	//var unit_arrayResults = jQuery.parseJSON(data.unit_array);
	    	var unit_arrayResults = data.unit_array;
			//console.log(unit_arrayResults);
			dataLoop=eval("("+unit_arrayResults[0].data+")");
		    //console.log(dataLoop);
		    //var str="";
		    var dataLoop2="";
		    var formulas="";
		    formulas="{\"formula\":[";
		    for(var h=0;h<dataLoop.length;h++){
		            var str=jQuery.trim(formalaData.replace(/ /g,"") );
		            
			    	// str=str.replace(re,indexEntry[i]);
			    	//console.log("====");
			    	 
			    	 
			    	 //console.log(dataLoop2);
			    	 for(var i=0;i<unit_arrayResults.length;i++){
				    	 
			    		  dataLoop2=eval("("+unit_arrayResults[i].data+")");

			    		 
						  
						   
			    		    var re = new RegExp(unit_arrayResults[i].unit+unit_arrayResults[i].value,"g");

// 	    					console.log("re"+re);
// 	    					console.log("data"+dataLoop2[h][1]);
// 	    					console.log("time"+dataLoop2[h][0]);

	    					str=str.replace(re,dataLoop2[h][1]);
	    					
			    	 }

			    	str=str.replace(/;/g,",")
		    		str=str.replace(/:/g,",")
			    	 console.log(str);
			    	 /*
			    	 if(h==0){
			    		 formulas+="{\"key\":\""+h+"\",\"value\":\""+str.toLowerCase()+"\",\"evTime\":\""+dataLoop2[h][0]+"\",\"calID\":\""+calID+"\",\"trendID\":\""+trendID+"\"}";
					 }else{
						 formulas+=",{\"key\":\""+h+"\",\"value\":\""+str.toLowerCase()+"\",\"evTime\":\""+dataLoop2[h][0]+"\",\"calID\":\""+calID+"\",\"trendID\":\""+trendID+"\"}";
				     }
				     */
			    	if(h==0){
			    		 formulas+="{\"key\":\""+h+"-"+trendID+"-"+calID+"\",\"value\":\""+str.toLowerCase()+"\",\"time\":\""+dataLoop2[h][0]+"\"}";
					 }else{
						 formulas+=",{\"key\":\""+h+"-"+trendID+"-"+calID+"\",\"value\":\""+str.toLowerCase()+"\",\"time\":\""+dataLoop2[h][0]+"\"}";
				     }
				    // console.log("dataLoop2[h]");
				    // console.log(dataLoop2[h][0]);
				    // console.log(dataLoop2[h]);

			    	// {"key":"2","value":"(300/3)*20"}
			    				
		    			
			    	 
		    }
		    formulas+=" ],";
		    formulas+='"callBackName":"callBackFormula"';
		    formulas+="}";

		    
		      
		       formulas=eval("("+formulas+")");
				//console.log("formulas");
				console.log("formulas");
				console.log(formulas);
				//get data from formala
			
			 
				   var ajaxStatus= $.ajax({
	    		
					 url: "http://10.249.99.107/steamtable/rest/calculation",
		      	       // method: "POST",
		      	        type: "POST",
		      	        crossDomain: true,
		      	        data: formulas,
		      	        async:false,
		      	        dataType: "jsonp",
		      	       // jsonp:"callBackFormula",  
		      	        
				});

					
				
				
            
			 //data return here end
		});
   
	    
    }

    
    function createFomala(startTime,endTime,formalaData,trendID,calID){
    	//var cal_g=jQuery.trim( $("#cal_g").val().replace(/ /g,"") );
    	//U04D1+ U04D2+Enthalpy(U04D2;U04D2)
    	var cal_g=jQuery.trim(formalaData.replace(/ /g,""));
    	var dataLoop="";
    	var str=cal_g;
    	var myRegexp ="";
    	var match  = "";
    	var constant_array=[];
    	var unit_array=[];
    	// find Constant
    	// str="sing(CONSTANT@XXD)+4-CONSTANT@XXXXXX*3";
    	 myRegexp = /(CONSTANT@[\w]+)/g;
    	 match  = myRegexp.exec(str);
    	 //alert(match)
    	//match = myRegexp.exec(myString);
    	while (match != null) {
    		// matched text: match[0]
    		// match start: match.index
    		// capturing group n: match[n]
    		//alert(match[1])
    		//alert(match[1].replace(/CONSTANT@/g,""));
    		var constantValue={
    			"name":match[1].replace(/CONSTANT@/g,""),
    			"result":""
    		}
    		constant_array.push(constantValue)
    		match = myRegexp.exec(str);
    	}
    	//alert(constant_array);

    	// find Unit or Cal Value
    	 //str = "sin(U04D122+U07D123*5)";
    	 myRegexp = /(U[0-9]{1,2})(D[0-9]{1,4})/g;
    	 match  = myRegexp.exec(str);
    	
    
    	while (match != null) {
    		//console.log("unit["+match[1]+"] , value["+match[2]+"]");
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
    	 console.log("match");
    	 console.log(unit_array);
    	 
    	//alert(unit_array);
    	if(constant_array.length==0 && unit_array.length==0){
    		nomalFormula(str);
    	
    	}else{
        	/*
    		console.log("constant_array");
        	console.log(constant_array);
        	console.log("unit_array");
        	console.log(unit_array);
        	*/
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
    			   //alert("create file is successfully");
    			   
    			   readFomala(formalaData,trendID,calID);
    			   
    			   //console.log("returnData");
    			   //console.log(returnData);
    			   
        		}
    		});

    	}
    	//alert(constant_array.length)
    	//alert(unit_array.length)



    	/*
    	$.ajax({
    		url: "http://localhost:3000/v1/extract",
    		//url:"http://query.yahooapis.com/v1/public/yql",
    		method: "GET",
    		//crossDomain: true,
    		dataType: "jsonp",
    		jsonp: "jsonp",
    		data: obj
    	});
    	*/
    }
    $(document).ready(function(){

    	$.ajaxSetup({
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
    	});

        $("#btnTestSplitFormula").click(function(){
        	var queryPoint="";
    		var queryPointArray="";
    		var queryPointCalArray="";
    		var queryPointCal="";
    		var pointCal="";
    		var paramPointAndUnitArray=$("#paramPointEmbed-3041").val().split(","); 


    		$.each(paramPointAndUnitArray,function(index,indexEntry){
				 //alert(indexEntry);
				 queryPointArray=indexEntry.split("-");
				    
				    queryPointCalArray=queryPointArray[0]; 
				    queryPointCal=queryPointCalArray.substr(0,2);

				    if(queryPointCal=='DC'){
				       
				        pointCal=queryPointArray[3];
				        console.log("pointCal1");
				        console.log(pointCal);
				        
				       // pointCal=pointCal.split("U");
				        var myRegexp = /(U[0-9]{1,2})(D[0-9]{1,4})/g;
				        var match  = myRegexp.exec(pointCal);
				        
				        
				        console.log("pointCal2");
				        console.log(match);
				        /*previewFomala();*/
				        var formulaData="U04D1+ U04D2+Enthalpy(U05D3;U06D4)";
				        var formulaData2="Enthalpy(U05D3;U06D4)";
				        setTimeout(function(){
				       // createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",formulaData,"88","c102");
				        createFomala("2014-05-01 :00:01:00","2014-05-01 :00:40:00",formulaData,"88","c102");
				        //createFomala("2014-05-01 :00:01:00","2014-05-01 :00:50:00",formulaData2,"88","c103");
				        /*
				        createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",formulaData2,"88","c104");
				        createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",formulaData2,"88","c105");
				        createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",formulaData2,"88","c106");
				        createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",formulaData,"88","c102");
				        createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",formulaData2,"88","c103");
				        createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",formulaData2,"88","c104");
				        createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",formulaData2,"88","c105");
				        createFomala("2014-05-01 :00:01:00","2014-05-01 :00:10:00",formulaData2,"88","c106");
				        */
				        });
				        
				        setTimeout(function(){
					        
				        	alert($(".calData-88").text());
				        	
					    },3000);
				        
				       
				        
				    }
				    
				   /*
					 if(index==0){
						 //(SELECT D1 FROM datau04  WHERE EvTime=EvTime2) AS U04D1
						 queryPoint+="(SELECT "+queryPointArray[0]+" FROM datau0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					 }else{
						 queryPoint+=",(SELECT "+queryPointArray[0]+" FROM datau0"+queryPointArray[1]+"  WHERE EvTime=EvTime2) AS U0"+queryPointArray[1]+""+queryPointArray[0]+"";
					}
					*/
			});
			
        });
        
    	

		
    	//data test
    	//U04D260,D05D260,(U04D26+U05D260)
    	$("#btnCallWSAndData").click(function(){
    		var data=  {
    			    
          		  "formula": [
  
          		    {
  
          		      "key": "1",
  
          		      "value": "(100/3)*20"
  
          		    },
  
          		    {
  
          		      "key": "2",
  
          		      "value": "(300/3)*20"
  
          		    }
  
          		  ],
          		  "callBackName":"callBackFormula"
  
          		};
      		
    	    $.ajax({
      	        url: "http://10.249.99.107/steamtable/rest/calculation",
      	        method: "POST",
      	        crossDomain: true,
      	        data: data,
      	        dataType: "jsonp",
      	        jsonp:"callBackFormula"
      	       
      	    });
   	    
       });


    	$("#btnCallWS2").click(function(){
            var data=  {
    
            		  "formula": [
    
            		    {
    
            		      "key": "A1",
    
            		      "value": "(100/3)*20"
    
            		    },
    
            		    {
    
            		      "key": "A2",
    
            		      "value": "(300/3)*20"
    
            		    }
    
            		  ],
            		  "callBackName":"callBackFormula2"
    
            		};
        	 $.ajax({
        	        url: "http://10.249.99.107/steamtable/rest/calculation",
        	        method: "POST",
        	        crossDomain: true,
        	        data: data,
        	        dataType: "jsonp",
        	        jsonp:"callBackFormula2"
        	       
        	    });
     	    
        });

        
    });
  //2014-05-20 00:00:31 น.
  
	 var second="";
	 var date="";
	 var time="";
	 var paramFromDate="2014-05-20 00:00:31 น.";
		paramFromDate=paramFromDate.split(" ");
        date=paramFromDate[0];
        time=paramFromDate[1];
        
        date=date.split("-");
        time=time.split(":");
        paramFromDate=date[2]+"-"+date[1]+"-"+date[0]+" 00:00:"+parseInt(time[2]);
		
		console.log(paramFromDate);
	

		
    $(document).ready(function(){
       $("#btnCalAjax").click(function(){
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
       });
    });
           
    </script>
    
    
    <input type="hidden" value="DC508-4-88337- U04D1+ U04D2+Enthalpy(U04D2;U04D2),D3-4-88331" name="paramPointEmbed-3041" id="paramPointEmbed-3041" class="paramPointEmbed-3041">
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop