@extends('layouts.main')

@section('page_title','Trend')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
<meta charset="utf-8">
<link rel="stylesheet" href="/js/kendoCommercial/styles/kendo.common.min2.css" />
<link rel="stylesheet" href="/js/kendoCommercial/styles/kendo.rtl.min2.css">
<link rel="stylesheet" href="/js/kendoCommercial/styles/kendo.silver.min2.css">
<link rel="stylesheet" href="/js/kendoCommercial/styles/kendo.silver.mobile.min.css">
<!-- kendo ui start 
<link rel="stylesheet" href="/js/kendoCommercial/styles/kendo.black.min.css" />-->
<!-- kendo ui end -->
<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
<link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
<!-- Data picker -->
<script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/js/plugins/iCheck/icheck.min.js"></script>
<!-- 
 -->
<!-- Content Start--> 
<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script> -->
<script src="/Controller/cMainTrend.js"></script>

<script src="/Controller/cTrend.js"></script>

<link href="/css/trend.css" rel="stylesheet"> 
<script src="/js/jquery.tooltipCustom.js"></script>
<link href="/css/tooltip.css" rel="stylesheet"> 
 



<!-- exsample start -->
<!-- <button id='testGraph'>call graph</button> -->

<!-- exsample end -->


<div class="tabs-container topMargin">


    <ul class="nav nav-tabs" id='tabTrendTitle'>
        
        <li class="titleTab pull-right" ><a  href="#trendSeting" data-toggle="tab" aria-expanded="false"><b><span class='btnPlus fa fa-plus-circle'></span></b></a></li>
     
       
    
</ul>
<div class="tab-content" id='tabTrendContent'>


        <div class="tab-pane" id="trendSeting">
            <div class="panel-body">
           
            <!-- content area tab-3 start -->
             <div id="areaTrendSeting"></div>
            <!-- content area tab-3 start -->
            
            
            </div>
        </div>


</div>


<!-- Content End-->  







<!-- Modal Start -->

<div aria-hidden="true" role="dialog" tabindex="-1" id="editTrendPointModal" class="modal inmodal in" >
<div class="modal-dialog modal-lg">
<div class="modal-content animated flipInY">
<div class="modal-header">
    <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
   <h5 class="modal-title">Edit Point</h5>
      
   </div>
  <div class="modal-body">
  	            <div class='row'>
                    <div id="trendNameArea" class="col-xs-10  displaynone " style="display: block;">
                      Trend Name <i class="glyphicon glyphicon-menu-right"></i> 
                      <span id="editTrendName">SH-RH Temperature Control</span>
                    </div>
                    
                    <div class="col-xs-offset-0 col-xs-2 ">
                            <div class="displaynone" id="listAllUnitArea" style="display: block;">
                                <select name="editUnit" id="editUnit" class="form-control input-sm">
                                    <option value="All">All Point</option>
                                    <option value="4">MM04</option>
                                    <option value="5">MM05</option>
                                    <option value="6">MM06</option>
                                    <option value="7">MM07</option>
                                   
                                </select> 
                           </div>
                    </div>
               </div>
               
                <div id='editTrendPointArea'>
                    
                </div>
                    
                    
      </div>
     <div class="modal-footer">
     <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
    <button class="btn btn-primary" id='btnEditPlotGraph' type="button">ตกลง</button>
  </div>
 </div>
</div>
</div>

<!-- Modal End -->
   

            
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop