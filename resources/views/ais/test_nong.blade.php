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
   
   <button id='btnCallWSAndData'>btnCallWSAndData</button>
   <button id='btnCallWS2'>btnCallWebService2</button>
   <button id='btnCallAjax'>btnCallAjax</button>
    <script>
    function callBackFormula(data){
        console.log(data);
    }
    $(document).ready(function(){

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
    
    
    
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop