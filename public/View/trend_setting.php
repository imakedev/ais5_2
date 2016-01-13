<script src='/Controller/cTrendSetting.js'></script>
<link href="/css/trendSetting.css" rel="stylesheet">

<!-- test start -->
<button id='btnCallAjax'>CallAjax</button>
<button id='btnReadAjax'>btnReadAjax</button>

<script>
$("#btnCallAjax").click(function(){
	 /*
	 $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    */
	$.ajax({
		 //0820140520/08201405200000
			//url:"/ais/serviceTrend/readDataSecondu/"+paramTrendID+"",
		 	url:"http://localhost:9999/test/trendSecond47/createDataSecondu.php?dateTime=2014-05-20%2000:04:00&point=D1,D2,D3&trendID=88&sessEmpId=3&unit=08&callback=?",
			type:"get",
			async:false,
			crossDomain: true,
			dataType:"JSON",
			success:function(data){
				alert(data);
			}
	});
});
$("#btnReadAjax").click(function(){
	 /*
	 $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    */
	$.ajax({
		 //0820140520/08201405200000
			//url:"/ais/serviceTrend/readDataSecondu/"+paramTrendID+"",
		 	url:"http://localhost:9999/test/trendSecond47/readDataSecondu.php?trendID=88&sessEmpId=3&unit=08&callback=?",
			type:"get",
			async:false,
			//crossDomain: true,
			dataType:"JSON",
			success:function(data){
				//console.log(data);
				var objectData=eval("("+data+")");
				console.log(objectData);
	
			}
	});
});
</script>
<!-- test end -->


<div class="row bgParam ">
            
    
    <div class="col-xs-offset-6 col-xs-2 ">
           <div id='listAllTrendGroupArea'></div>
    </div>
   
     <div class="col-xs-2">
      <input type="text" id='searhTrend' name='searhTrend' placeholder="ค้นหาด่วน" class="input-sm form-control pull-right"> 
     </div>
    <div class="col-xs-2 ">
          
                <button type="button" id ='btnSearchByGroup'class="btn btn-sm btn-primary pull-right" style='width:100%'> Search Trend</button> 
              
    </div>
</div>



<!-- grid list Trend -->
<div id='gridTrendListArea'></div>
<br style='clear:both'>
 <div class="col-xs-10  displaynone " id='trendNameArea'>
  Trend Name <i class='glyphicon glyphicon-menu-right'></i> <span id='trendName'></span>
 </div>
 <div class="col-xs-offset-0 col-xs-2 ">
        <div id='listAllUnitArea' class='displaynone'>
            <select class="form-control input-sm" id='unit' name="unit">
                <!-- <option value='All'>All Point</option> -->
                <option selected value='4'>MM04</option>
                <option value='5'>MM05</option>
                <option value='6'>MM06</option>
                <option value='7'>MM07</option>
               
            </select> 
       </div>
</div>
<br style='clear:both'>
<br style='clear:both'>
<div id='gridPointListArea'></div>
<div  class='row bgParam displaynone' id='btnPlotGraphArea'>
     <div class="col-xs-12">
        <buton class="btn btn-primary  btn-sm pull-right btnPlotGraph" id='btnPlotGraph' >Plot Graph </button>
     </div>
</div>
<br style='clear:both'>
<br style='clear:both'>
<br style='clear:both'>
<!-- grid list piont -->