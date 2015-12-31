@extends('layouts.main')

@section('page_title','ทั่วไป')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
   
   
   

    <script src='/Controller/cMain.js'></script>
    <script src='/Controller/cMainTrend.js'></script>
    <script src='/Controller/cTrendSetting.js'></script>
    <!-- <script src='/Controller/cTrend.js'></script>   -->
    
    
    <script>
    $(document).ready(function(){
    	console.log("-------------------------");
    	console.log(editTrendPointFn("88","04"));
    	
    });
    </script>
    


<button class="btn btn-warning  btn-sm  " id="editTrendPoint" data-target="#setTimeScale" data-toggle="modal" type="button">
    <i class="fa fa-cogs"></i>
</button>




<!-- Modal Start -->

<div aria-hidden="true" role="dialog" tabindex="-1" id="setTimeScale" class="modal inmodal in" >
<div class="modal-dialog modal-lg">
<div class="modal-content animated flipInY">
<div class="modal-header">
    <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
   <h5 class="modal-title">Edit Point</h5>
      
   </div>
  <div class="modal-body">
  	
                   
                            <div id='editTrendPointArea'>
                                
                            </div>
                    
                    
      </div>
     <div class="modal-footer">
     <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
    <button class="btn btn-primary" type="button">ตกลง</button>
  </div>
 </div>
</div>
</div>

<!-- Modal End -->




    <script>

    var createFileServiceChart={
    		createFileByHru:function(){
    			//alert("createFileByHru");
    			$.ajax({
    				url:"/ais/serviceTrend/getDataHru/D1,D2,D3/04/2014-05-01 00:00:00/2014-05-01 05:00:00",
    				type:"get",
    				dataType:"json",
    				async:false,
    				success:function(data){
    					
    					if(data=='createJsonSuccess'){
    						
    						var data2=readJsonFilterFileScaleTypeH();
    						console.log(getDataByDateHour(data2,'D1,D2,D3'));
    						
    						//console.log(data2);
    						/*   
    						var lastObject = data2.pop();
    						setTimeout(function(){
    							console.log(lastObject);
    						},1000);
    						*/
    						
    					}
    				}
    			});
    			
    		},
    		createFileByDayu:function(){
    			//alert("createFileByHru");
    			$.ajax({
    				url:"/ais/serviceTrend/getDataDayu/D1,D2,D3/04/2014-05-01 00:00:00/2014-05-05 00:00:00",
    				type:"get",
    				dataType:"json",
    				async:false,
    				success:function(data){
    					
    					if(data=='createJsonSuccess'){
    						
    						var data2=readJsonFilter.scaleTypeD();


    						console.log(getDataByDateDay(data2,'D1,D2,D3'));
    						
    						//console.log(data2);
    						/*   
    						var lastObject = data2.pop();
    						setTimeout(function(){
    							console.log(lastObject);
    						},1000);
    						*/
    						
    					}
    				}
    			});
    			
    		}
    	}

	
    	$(document).ready(function(){
    		//alert("hello");
    		//createFileServiceChart.createFileByHru();
    		createFileServiceChart.createFileByDayu();


    		
    		console.log(convertDateTh('2015-11-17 00:00:00'));
    		console.log(setFormatDateTime('2015-11-17 00:00:00'));
    		    		
    	});
    </script>
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop