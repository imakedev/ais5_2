//DECLARE:
//localindex,unit.tagiATOM,type,high alarm,low alarm,digital alarm
var planTown4=[];
planTown4[0]="4,D1,A,155,75,2";
planTown4[1]="4,D2,A,300,105,2";
planTown4[2]="4,D3,A,2,-1,2";
planTown4[3]="4,D4,A,2,-1,2";
planTown4[4]="4,D5,A,200,75,2";
planTown4[5]="4,D6,A,200,75,2";
planTown4[6]="4,D7,A,100,-10,2";
planTown4[7]="4,D8,A,200,-100,2";
planTown4[8]="4,D9,A,200,-100,2";
planTown4[9]="4,D10,A,200,-100,2";
planTown4[10]="4,D11,A,600,100,2";
planTown4[11]="4,D12,A,250,10,2";
planTown4[12]="4,D13,A,250,10,2";
planTown4[13]="4,D14,A,250,10,2";

var tripFnRed=[];
var tripFnGreen=[];


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




var planTown5=[];
var planTown6=[];
var planTown7=[];

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



var tripCountRed=0;
var tripCountGreen=0;


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
	//clear setTimeOut Start
	//alert("clearTripGreenFn");
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

	//clear setTimeOut Start
	/*
	if(tripFnRed.length>0){
	    for(var i=0; i<tripFnRed.length; i++)
	    {
	        clearTimeout(tripFnRed[i]);
	    }
	    
	    tripFnRed = [];
	   
	}
	*/
	/*
	 console.log("-----****-----");
	 console.log(tripFnRed.length);
	 console.log("-----####-----");
	 */
    //clear setTimeOut end

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
			
			//clear setTimeOut end
		
		}
	
	
}

var countLogicPoint=0;
var logicPointPlantow47 = {
		
		
		pointClearTripRedFn(){
			clearTripRedFn((tripFnRed));
		},
		pointClearTripGreenFn(){
			clearTripGreenFn((tripFnGreen));
		},
		setDateTime(EvTime){
			
			$("#disPlayDateTimeArea").html(EvTime);	
			
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
			
		},point19(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 200)){
				tripFn("Y",19);
			}else{
				tripFn("N",19);
			}
			/*logic trip point end*/
			$("#point19").html("<font class='displaynone' color='red'>19,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point20(paramDataPoint){
			/*logic trip point start*/
			
			if((parseFloat(paramDataPoint).toFixed(2)< 1) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",20);
				//alert("trip");
			}else{
				tripFn("N",20);
			}
			/*logic trip point end*/
			$("#point20").html("<font class='displaynone' color='red'>20,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},
		point21(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -25) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",21);
			}else{
				tripFn("N",21);
			}
			/*logic trip point end*/
			$("#point21").html("<font class='displaynone' color='red'>21,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		
		},point22(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 0) ||(parseFloat(paramDataPoint).toFixed(2)> 200)){
				tripFn("Y",22);
			}else{
				tripFn("N",22);
			}
			/*logic trip point end*/
			$("#point22").html("<font class='displaynone' color='red'>22,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point23(paramDataPoint){
			
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 100) ||(parseFloat(paramDataPoint).toFixed(2)> 560)){
				tripFn("Y",23);
			}else{
				tripFn("N",23);
			}
			/*logic trip point end*/

			$("#point23").html("<font class='displaynone' color='red'>23,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point24(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 100) ||(parseFloat(paramDataPoint).toFixed(2)> 600)){
				tripFn("Y",24);
			}else{
				tripFn("N",24);
			}
			/*logic trip point end*/
			$("#point24").html("<font class='displaynone' color='red'>24,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point25(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",25);
			}else{
				tripFn("N",25);
			}
			/*logic trip point end*/
			$("#point25").html("<font class='displaynone' color='red'>25,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point26(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",26);
			}else{
				tripFn("N",26);
			}
			/*logic trip point end*/
			$("#point26").html("<font class='displaynone' color='red'>26,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point27(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",27);
			}else{
				tripFn("N",27);
			}
			/*logic trip point end*/
			$("#point27").html("<font class='displaynone' color='red'>27,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point28(paramDataPoint){
			
			//$("#point28").html("<font class='displaynone' color='red'>28,</font>"+parseFloat(paramDataPoint).toFixed(2));	

			if(parseFloat(paramDataPoint).toFixed(2)<= -100){
				//$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				$("#point28").addClass("pumptbodyHightAlarm");
				//alert("pumpHightAlarm");
				
			}else if(parseFloat(paramDataPoint).toFixed(2)>= 200){
				
				$("#point28").addClass("pumptbodyLowAlarm");
				//alert("pumpLowAlarm");
				
			}else{
				$("#point28").addClass("pumptbodyNormal");
				//alert("pumpNormal");
				
			}
			
		},point29(paramDataPoint){

			if(parseFloat(paramDataPoint).toFixed(2)<= -100){
				//$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				$("#point29").addClass("pumptbodyHightAlarm");
				//alert("pumpHightAlarm");
				
			}else if(parseFloat(paramDataPoint).toFixed(2)>= 200){
				
				$("#point29").addClass("pumptbodyLowAlarm");
				//alert("pumpLowAlarm");
				
			}else{
				$("#point29").addClass("pumptbodyNormal");
				//alert("pumpNormal");
				
			}
			//$("#point29").html("<font class='displaynone' color='red'>29,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point30(paramDataPoint){
			//paramDataPoint=2;
			if(parseFloat(paramDataPoint).toFixed(2)<= -1){
				//$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				$("#point30").addClass("pumpbodyHightAlarm");
				//alert("pumpHightAlarm");
				
			}else if(parseFloat(paramDataPoint).toFixed(2)>= 2){
				
				$("#point30").addClass("pumpbodyLowAlarm");
				//alert("pumpLowAlarm");
				
			}else{
				$("#point30").addClass("pumpbodyNormal");
				//alert("pumpNormal");
				
			}
				
			//$("#point30").html("<font class='displaynone' color='red'>30,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point31(paramDataPoint){
			//paramDataPoint=2;
			
			if(parseFloat(paramDataPoint).toFixed(2)<= -1){
				//$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				$("#point31").addClass("pumpbodyHightAlarm");
				//alert("pumpHightAlarm");
				
			}else if(parseFloat(paramDataPoint).toFixed(2)>= 2){
				
				$("#point31").addClass("pumpbodyLowAlarm");
				//alert("pumpLowAlarm");
				
			}else{
				$("#point31").addClass("pumpbodyNormal");
				//alert("pumpNormal");
				
			}
			//$("#point31").html("<font class='displaynone' color='red'>31,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point32(paramDataPoint){
			
			
			if(parseFloat(paramDataPoint).toFixed(2)<= -100){
				//$("#point1").html("<font class='displaynone' color='red'>1,</font>"+parseFloat(paramDataPoint).toFixed(2));	
				$("#point32").addClass("pumpbodyHightAlarm");
				//alert("pumpHightAlarm");
				
			}else if(parseFloat(paramDataPoint).toFixed(2)>= 200){
				
				$("#point32").addClass("pumpbodyLowAlarm");
				//alert("pumpLowAlarm");
				
			}else{
				$("#point32").addClass("pumpbodyNormal");
				//alert("pumpNormal");
				
			}
			//$("#point32").html("<font class='displaynone' color='red'>32,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point33(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 1) ||(parseFloat(paramDataPoint).toFixed(2)> 200)){
				tripFn("Y",33);
			}else{
				tripFn("N",33);
			}
			/*logic trip point end*/
			$("#point33").html("<font class='displaynone' color='red'>33,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point34(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 1) ||(parseFloat(paramDataPoint).toFixed(2)> 200)){
				tripFn("Y",34);
			}else{
				tripFn("N",34);
			}
			/*logic trip point end*/
			$("#point34").html("<font class='displaynone' color='red'>34,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point35(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 100)){
				tripFn("Y",35);
			}else{
				tripFn("N",35);
			}
			/*logic trip point end*/
			$("#point35").html("<font class='displaynone' color='red'>35,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point36(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< 10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",36);
			}else{
				tripFn("N",36);
			}
			/*logic trip point end*/
			$("#point36").html("<font class='displaynone' color='red'>36,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point37(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",37);
			}else{
				tripFn("N",37);
			}
			/*logic trip point end*/
			$("#point37").html("<font class='displaynone' color='red'>37,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point38(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",38);
			}else{
				tripFn("N",38);
			}
			/*logic trip point end*/
			$("#point38").html("<font class='displaynone' color='red'>38,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point39(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",39);
			}else{
				tripFn("N",39);
			}
			/*logic trip point end*/
			$("#point39").html("<font class='displaynone' color='red'>39,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point40(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",40);
			}else{
				tripFn("N",40);
			}
			/*logic trip point end*/
			$("#point40").html("<font class='displaynone' color='red'>40,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point41(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",41);
			}else{
				tripFn("N",41);
			}
			/*logic trip point end*/
			$("#point41").html("<font class='displaynone' color='red'>41,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point42(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",42);
			}else{
				tripFn("N",42);
			}
			/*logic trip point end*/
			$("#point42").html("<font class='displaynone' color='red'>42,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point43(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 300)){
				tripFn("Y",43);
			}else{
				tripFn("N",43);
			}
			/*logic trip point end*/
			$("#point43").html("<font class='displaynone' color='red'>43,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		},point44(paramDataPoint){
			/*logic trip point start*/
			if((parseFloat(paramDataPoint).toFixed(2)< -10) ||(parseFloat(paramDataPoint).toFixed(2)> 5000)){
				tripFn("Y",44);
			}else{
				tripFn("N",44);
			}
			/*logic trip point end*/
			$("#point44").html("<font class='displaynone' color='red'>44,</font>"+parseFloat(paramDataPoint).toFixed(2));	
			
		}
}




function setDataOnDashboardPlantow47(data){
	
	logicPointPlantow47.pointClearTripRedFn();
	logicPointPlantow47.pointClearTripGreenFn();
	logicPointPlantow47.setDateTime("<center><b>ข้อมูลวันที่ "+convertDateHisTh(data['EvTime'])+"</b></center>");
	/*
	D32,
	D266,
	0 as 'D1', 
	0 as 'D2', 
	D264,
	D261,
	D272,
	D137,
	D141,
	D253,
	*/
	logicPointPlantow47.point1(data['D32']);
	logicPointPlantow47.point2(data['D266']);
	logicPointPlantow47.point3(data['D1']);
	logicPointPlantow47.point4(data['D2']);
	logicPointPlantow47.point5(data['D264']);
	logicPointPlantow47.point6(data['D261']);
	logicPointPlantow47.point7(data['D272']);
	logicPointPlantow47.point8(data['D137']);
	logicPointPlantow47.point9(data['D141']);
	logicPointPlantow47.point10(data['D253']);
	
	/*
	D105,
	D104,
	D103,
	D146,
	D147,
	D14,
	D56,
	D273,
	D267,
	D260,
	 */
	logicPointPlantow47.point11(data['D105']);
	logicPointPlantow47.point12(data['D104']);
	logicPointPlantow47.point13(data['D103']);
	logicPointPlantow47.point14(data['D146']);
	logicPointPlantow47.point15(data['D147']);
	logicPointPlantow47.point16(data['D14']);
	logicPointPlantow47.point17(data['D56']);
	logicPointPlantow47.point18(data['D273']);
	logicPointPlantow47.point19(data['D267']);
	logicPointPlantow47.point20(data['D260']);
	/*
	D148,
D145,
D270,
D258,
D114,
D113,
D112,
D131,
D223,
D133,
	 */
	logicPointPlantow47.point21(data['D148']);
	logicPointPlantow47.point22(data['D145']);
	logicPointPlantow47.point23(data['D270']);
	logicPointPlantow47.point24(data['D258']);
	logicPointPlantow47.point25(data['D114']);
	logicPointPlantow47.point26(data['D113']);
	logicPointPlantow47.point27(data['D112']);
	logicPointPlantow47.point28(data['D131']);
	logicPointPlantow47.point29(data['D223']);
	logicPointPlantow47.point30(data['D133']);
	/*
	D16,
D229,
D225,
D269,
D165,
D163,
D161,
D160,
D159,
D158,
	 */
	logicPointPlantow47.point31(data['D16']);
	logicPointPlantow47.point32(data['D229']);
	logicPointPlantow47.point33(data['D225']);
	logicPointPlantow47.point34(data['D269']);
	logicPointPlantow47.point35(data['D165']);
	logicPointPlantow47.point36(data['D163']);
	logicPointPlantow47.point37(data['D161']);
	logicPointPlantow47.point38(data['D160']);
	logicPointPlantow47.point39(data['D159']);
	logicPointPlantow47.point40(data['D158']);
/*
	D157,
D151,
D150,
D149
	 */
	logicPointPlantow47.point41(data['D157']);
	logicPointPlantow47.point42(data['D151']);
	logicPointPlantow47.point43(data['D150']);
	logicPointPlantow47.point44(data['D149']);
	

	
	
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
							//console.log(indexEntry);
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
					//console.log(data);
					
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
					//console.log(data);
					
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