/*manage trip point start*/
var tripFnRed=[];
var tripFnGreen=[];

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


function clearTripRedFn(tripFnRed){
	//alert("clearTripRed");
	//clear setTimeOut Start
	if(tripFnRed.length>0){
	    for(var i=0; i<tripFnRed.length; i++)
	    {
	        clearTimeout(tripFnRed[i]);
	    }
	    
	    tripFnRed = [];
	   
	}
	
	//clear setTimeOut End
}
function clearTripGreenFn(tripFnGreen){
	if(tripFnGreen.length>0){
	    for(var i=0; i<tripFnGreen.length; i++)
	    {
	        clearTimeout(tripFnGreen[i]);
	    }
	    
	    tripFnGreen = [];
	   
	}
	
	//clear setTimeOut End
}
function tripFn(paramTrip,paramPoint){

	$("#paramEmbedTripFn"+paramPoint).remove();
	$("#paramTripArea").append("<input type=\"hidden\" id=\"paramEmbedTripFn"+paramPoint+"\" class=\"paramTripAlarmEmbed\" value="+paramTrip+">");
	
		if(paramTrip!="N"){

			tripFnRed.push(setTimeout(function(){
				$("#point"+paramPoint).css({"color":"#ff0000"});
			},1000));
			
			
			 tripFnGreen.push(setTimeout(function(){
				$("#point"+paramPoint).css({"color":"#00ff00"});
				tripFn($("#paramEmbedTripFn"+paramPoint).val(),paramPoint);
			
			},2000));
  
		}else{
			
			
			$("#point"+paramPoint).css({"color":"#00ff00"});
		
		}
}
/*manage trip point end*/


var bindingGridlistEventFn=function(){
	$("#gridEventList").kendoGrid({
       // height: 400,
		theme: "Moonlight",
        scrollable: false,
       // groupable: true,
       /* sortable: true,*/
       /*
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
        */
    });
	
	
};

function callReadDataEventPCVBySlideFn(paramPcv,paramUnit,paramEmpId,indexDate){
	//console.log(paramPcv);
	
	
	if(paramPcv=='steam47'){
		
		//Read Stean47 start
		stream47.readDataPCVFn(paramPcv,paramUnit,paramEmpId,indexDate);
		if($("#eventAction").val()=='showEvent'){
			
			setTimeout(function(){
				stream47.readDataEventPCVFn(paramPcv,paramUnit,paramEmpId);
			},2000);
		
		}
		//Read Stean47 end
		
	}if(paramPcv=='steam813'){
		
		//Read steam813 start
		stream813.readDataPCVFn(paramPcv,paramUnit,paramEmpId,indexDate);
		if($("#eventAction").val()=='showEvent'){
			
			setTimeout(function(){
				stream813.readDataEventPCVFn(paramPcv,paramUnit,paramEmpId);
			},2000);
		
		}
		//Read steam813 end
		
	}if(paramPcv=='plantow47'){
		
		//Read plantow47 start
		//alert("plantow47001");
		plantow47.readDataPCVFn(paramPcv,paramUnit,paramEmpId,indexDate);
		if($("#eventAction").val()=='showEvent'){
			
			//setTimeout(function(){
				plantow47.readDataEventPCVFn(paramPcv,paramUnit,paramEmpId);
			//},2000);
		
		}
		//Read plantow47 end
		
	}else if(paramPcv=='fgd'){
		//Read fgd start
		fgd.readDataPCVFn(paramPcv,paramUnit,paramEmpId,indexDate);
		if($("#eventAction").val()=='showEvent'){
			
			setTimeout(function(){
				fgd.readDataEventPCVFn(paramPcv,paramUnit,paramEmpId);
			},2000);
		
		}
		//Read fgd end
	}
	
}

//slider start
function slideFucusExpressFn(parmStart,paramMax){
	
		$("#slideFocusExpressArea").html("<div id=\"slideFocusExpress\"></div>");
		var slider = document.getElementById("slideFocusExpress");
		noUiSlider.create(slider, {
			start: parmStart,
			step: 1,
			range: {
				'min': 0,
				//'20%': [ 300, 100 ],
				//'50%': [ 800, 50 ],
				'max': paramMax
			}
		});
		var i=0;
		slider.noUiSlider.on('update', function( values, handle ) {
			
			//alert("test");
			
			if(i!=0){
			//console.log(values[handle]);
			var indexDate = values[handle];
			
			callReadDataEventPCVBySlideFn($("#paramPcvEmbed").val(),$("#paramUnitEmbed").val(),$("#paramEmpIdEmbed").val(),indexDate);
			//console.log(i);
			//console.log($("#paramPcvEmbed").val());
			
			}
			
			i++;
		});
	}
//slider end
$(document).on("click","#btnEvenShowHidden",function(){
	
	if($(this).hasClass('showEvent')){
		$(this).addClass('hiddenEvent');
		$(this).removeClass('showEvent');
		$("#eventAction").remove();
		$("body").append("<input type='hidden' id='eventAction' name='eventAction' value='hiddenEvent'>");
		
	}else{
		
		$(this).addClass('showEvent');
		$(this).removeClass('hiddenEvent');
		$("#eventAction").remove();
		$("body").append("<input type='hidden' id='eventAction' name='eventAction' value='showEvent'>");
		//callReadDataEventPCVSteam47Fn();
	}
	$("#gridEventList").toggle("slow");
	
	return false;
});

$(document).ready(function(){
	
	
	
	slideFucusExpressFn(5,10);
	
	$(".gridPCV").kendoGrid({
	// height: 400,
		theme: "Moonlight",
        scrollable: false,
       
    });
	
	//set current hour,minute

	$("#paramDate").val(currentDate());
	//$("#paramHour").val(currentH2Time());
	//$("#paramMinute").val(currentMinuteTime());
	//Test
	//$("#paramDate").val("2014-05-01");

	$("#paramHour").val(currentH2Time());
	$("#paramMinute").val(currentMinuteTime());
	//binding data kendoui
	$("#paramDate").kendoDatePicker({
		 theme: "Moonlight",
		 format: "yyyy-MM-dd",
		 
	 });
	$("#paramDate").css({"color":"white"});
	$("#paramPcv").kendoDropDownList();
	$("#paramUnit").kendoDropDownList();
	
	
	$("#btnSubmit").click(function(){
		
		
		var paramSpanTime = $("#paramSpanTime").val();
		var paramMinute = $("#paramMinute").val();
		var paramHour = $("#paramHour").val();
		var paramDate = $("#paramDate").val();
		var paramPcv = $("#paramPcv").val();
		var paramUnit=$("#paramUnit").val();
		
		var paramFromDate=paramDate+" 00:00:00";
		var paramHourOnly=paramHour.split(":");
		paramHourOnly=paramHourOnly[0];
		var paramMinuteOnly=paramMinute.split(":");
		paramMinuteOnly=paramMinuteOnly[0];
		var paramToDate=paramDate+" "+paramHourOnly+":"+paramMinuteOnly+":00";
		
		//alert(paramFromDate);
		//alert(paramToDate);
		//Test
		
		//var paramFromDate="2014-05-01 00:00:00";
		//var paramToDate="2014-05-01 00:30:00";
		
		//alert(paramFromDate);
		//alert(paramToDate);
		/*
		alert(paramSpanTime);
		alert(paramMinute);
		alert(paramHour);
		alert(paramDate);
		alert(paramPcv);
		alert(paramUnit);
		*/
		
		//Embed Param Start
		$(".paramPCVEmbed").remove();
		var paramPCVEmbed="";
		paramPCVEmbed+="<input type='hidden' id='paramSpanTimeEmbed' name='paramSpanTimeEmbed' class='paramPCVEmbed' value='"+paramSpanTime+"'>";
		paramPCVEmbed+="<input type='hidden' id='paramPcvEmbed' name='paramPcvEmbed' class='paramPCVEmbed' value='"+paramPcv+"'>";
		paramPCVEmbed+="<input type='hidden' id='paramUnitEmbed' name='paramUnitEmbed' class='paramPCVEmbed' value='"+paramUnit+"'>";
		paramPCVEmbed+="<input type='hidden' id='paramHourEmbed' name='paramHourEmbed' class='paramPCVEmbed' value='"+paramHour+"'>";
		paramPCVEmbed+="<input type='hidden' id='paramMinuteEmbed' name='paramMinuteEmbed' class='paramPCVEmbed' value='"+paramMinute+"'>";
		paramPCVEmbed+="<input type='hidden' id='paramFromDateEmbed' name='paramFromDateEmbed' class='paramPCVEmbed' value='"+paramFromDate+"'>";
		paramPCVEmbed+="<input type='hidden' id='paramToDateEmbed' name='paramToDateEmbed' class='paramPCVEmbed' value='"+paramToDate+"'>";
		paramPCVEmbed+="<input type='hidden' id='paramDateEmbed' name='paramDateEmbed' class='paramPCVEmbed' value='"+paramDate+"'>";
		//paramPCVEmbed+="<input type='hidden' id='paramEmpIdEmbed' name='paramEmpIdEmbed' class='paramPCVEmbed' value='3'>";
		
		$("#paramEmbedArea").append(paramPCVEmbed);
		//Embed Param End
		
		
		var pcvName=$("#paramPcv").val();
		$.ajax({
			url:"/processView/"+pcvName+".html",
			type:"get",
			dataType:"html",
			async:false,
			success:function(data){
				$("#processViewArea").html(data);
				
				
				//alert(pcvName);
				if(pcvName=='steam47'){
					///ais/processView/createDataPCVSteam47/{paramPCV}/{paramUnit}/{parmEmpId}/{paramFromDate}/{paramToDate}
					//alert(paramFromDate);
					//alert(paramToDate);
					mainSteam47Fn(paramPcv,paramUnit,emp_id,paramFromDate,paramToDate);

				}if(pcvName=='plantow47'){
					
					mainPlantow47Fn(paramPcv,paramUnit,emp_id,paramFromDate,paramToDate);

				}if(pcvName=='steam813'){
			
					mainSteam813Fn(paramPcv,paramUnit,emp_id,paramFromDate,paramToDate);

				}if(pcvName=='fgd67'){
					
					mainFGDFn(paramPcv,paramUnit,emp_id,paramFromDate,paramToDate);
					
				}if(pcvName=='turbine47'){
					
					mainTurbine47Fn(paramPcv,paramUnit,emp_id,paramFromDate,paramToDate);
					
				}
				//bindingGridlistEventFn();
				//setTimeout(function(){
					$(".point").show();
				//},3000);
			}
		});
		
		
		
	});
	
	
	setTimeout(function(){
		$("#btnSubmit").click();
	},1000);
	
	
	

});