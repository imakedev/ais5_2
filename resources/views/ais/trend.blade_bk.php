@extends('layouts.main')

@section('page_title','Trend')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
<meta charset="utf-8">
<link rel="stylesheet" href="/js/kendoCommercial/styles/kendo.common.min2.css" />
<link rel="stylesheet" href="//kendo.cdn.telerik.com/2015.3.930/styles/kendo.rtl.min.css">
<link rel="stylesheet" href="//kendo.cdn.telerik.com/2015.3.930/styles/kendo.silver.min.css">
<link rel="stylesheet" href="//kendo.cdn.telerik.com/2015.3.930/styles/kendo.silver.mobile.min.css">


<link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
   
<link href="/css/plugins/iCheck/custom.css" rel="stylesheet">



<!-- Data picker -->
<script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/js/plugins/iCheck/icheck.min.js"></script>



<!-- 
<button id='btnCalAjax'>btnCalAjax</button>
 -->
<!-- Content Start--> 


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

<script src="/Controller/cTrend.js"></script>
<link href="/css/trend.css" rel="stylesheet"> 
<script src="/js/jquery.tooltipCustom.js"></script>
<link href="/css/tooltip.css" rel="stylesheet"> 
 



<!-- exsample start -->
<!-- exsample end -->



<div class="tabs-container topMargin">


    <ul class="nav nav-tabs" id='tabTrendTitle'>
        <li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="true"> <b>Ari Flow Analysis</b></a></li>
        <li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="false"><b>Ari Flow Analysis 2</b></a></li>
        <li class=" pull-right" ><a  href="#trendSeting" data-toggle="tab" aria-expanded="false"><b><span class='btnPlus fa fa-plus-circle'></span></b></a></li>
        <!-- 
<li class='pull-right'>  
    <div class="ibox-tools topPanelBtn">
        <a class="fullscreen-link">
            <i class="fa fa-expand"></i>
        </a>
        <a class="close-link">
            <i class="fa fa-times"></i>
        </a>
    </div>
<li>  
    -->
    
</ul>
<div class="tab-content" id='tabTrendContent'>
    

    
    <div class="tab-pane active" id="tab-1">
        <div class="panel-body" >
        
        
        
        <div class='row scaleTimeMenu'>
            <div class='col-md-3 '>
               <!--<div class='col-md-2 basicSlideArea'>
        slide start -->
        
        	 <!-- <div id="keypress" ></div> -->
            <!-- <input type="text" id="input-with-keypress"> -->
        <!-- slide end -->
        
        

        
                    <div class='dateInDataDisplayArea'>
                        
                        <div class='dateInDataDisplay'><div id='dateInDataDisplay'>18 พฤศจิกายน 2558</div></div>
                        <div class='timeInDataDisplay'><div id='timeInDataDisplay'> เวลา 13:36 น.</div></div>
                        <br style='clear:both'>
                    </div>
        </div>
        <div class='col-md-4'>
       
        <!-- date display -->
        <!-- 
        <div class=" navy-bg titleDate">
             <span>  ข้อมูลวันที่ 9 - 10 กันยายน 2558 </span>
        </div>
         -->
        <!-- scale time start -->
       
        
        <div class="btn btn-primary btn-sm titleDate " id='btnScaleTimeArea' data-container="body" 
                data-toggle="popover" data-placement="bottom"   title="Scale Times" data-html="true"
                data-content="
                
         
            <div class='container widthScaleTime' >
            <!--  
                <div class=' navy-bg titleDate titleScale'>
                     <span> เลือกช่วงเวลา<span>
                </div>
                -->
             <div class='row rowTopBottomMargin'>
                
                   <div class='form-group'>
                        <label class='col-lg-3 control-label textAlign'>ช่วงเวลา</label>
                        <div class='col-lg-9 '>
                            <select name='scaleTime' id='scaleTime' class='form-control input-sm'>
                                
                                <option>Month</option>
                                <option>Day</option>
                                <option>Hour</option>
                                <option selected='selected'>Minute</option>
                                <option>Second</option>
                                
                            </select>
                        </div>
                   </div>
                
             </div>
             <div class='row rowTopBottomMargin'>
               <!--
                   <div class='form-group' id='dateFromArea'>
                        <label class='col-lg-3 control-label textAlign'>วันที่</label>
                        <div class='col-lg-9 inputDate'>
                            <div class='input-group date'>
                                <span class='input-group-addon  input-sm'><i class='fa fa-calendar'></i></span><input type='text' id='dateFrom' value='07/01/2014' class='form-control input-sm'>
                            </div>
                        </div>
                   </div>
                -->
                
                   <div class='form-group' >
                        <label class='col-lg-3 control-label textAlign'>วันที่</label>
                        <div class='col-lg-9 '>
                          
                               <input type='text' id='dateFrom' value='07/01/2014' class='form-control input-sm'>
                            
                        </div>
                   </div>
             </div>
             <div class='row rowTopBottomMargin'>
                    <!-- 
                   <div class='form-group'  id='dateToArea'>
                        <label class='col-lg-3 control-label textAlign'>ถึงวันที่</label>
                        <div class='col-lg-9 inputDate'>
                            <div class='input-group date'>
                                <span class='input-group-addon  input-sm'><i class='fa fa-calendar'></i></span><input type='text' id='dateTo' value='07/01/2014' class='form-control input-sm'>
                            </div>
                        </div>
                   </div>
                    -->
                    <div class='form-group' >
                        <label class='col-lg-3 control-label textAlign'>ถึงวันที่</label>
                        <div class='col-lg-9 '>
                           
                               <input type='text' id='dateTo' value='07/01/2014' class='form-control input-sm'>
                            
                        </div>
                   </div>
                
             </div>
             
              
           
             <div class='btnScaleArea'>
                <div class='pull-right'>
                    
                    <button  id='btnScaleTime' class='btn btn-sm btn-primary btnScaleTime'>OK</button>
                    <button  class='btn btn-sm btn-white' id='btnScaleTimeCancel'>Cancel</button>
                    
                </div>
             </div>
             
            </div>
      
               
                ">
                  <div id='scaleDateTimeArea'></div>
                  <!--   ข้อมูลวันที่ 9 - 10 กันยายน 2558 เวลา 22:44 น.-->
                </div>
           
           
         
        <!-- scale time end -->
        
        <!-- date display -->
        </div>
         <div class='col-md-5'>
            <!-- date display -->
            <div class="downloadSettingArea">
                <button type="button" class="btn btn-primary btn-sm  " data-container="body" 
                data-toggle="popover" data-placement="bottom"  data-html="true"
                data-content="
                <table>
                    <tr>
                        <td>
                            <input type='radio' name='download'>
                        </td>
                        <td>
                            &nbsp;Excel
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type='radio' name='download'>
                        </td>
                        <td>
                            &nbsp;Libre Office
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type='radio' name='download'>
                        </td>
                        <td>
                            &nbsp;HTML+Data
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type='radio' name='download'>
                        </td>
                        <td>
                            &nbsp;HTML only
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type='radio' name='download'>
                        </td>
                        <td>
                            &nbsp;Data only
                        </td>
                    </tr>
                    
                </table>
                <button class='btn btn-primary btn-sm  ' type='button'>
                    <i class='fa fa-download'></i>
                   Download
                </button>
                ">
                  <i class="fa fa-download"></i>
                </button>
                 <button type="button" data-toggle="modal" data-target="#setTimeScale" id='editTrendPoint' class="btn btn-warning  btn-sm  ">
                    <i class="fa fa-cogs"></i>
                </button>
            </div>
          
          
          
            <div class='setTimeCustomArea'>
                <div class='doubleLeftArea'>
                     <a class="btn btn-sm btn-white btn-bitbucket   " id='reduceDay'>
                     <i class="fa fa-angle-double-left   "></i>
                     </a>
                     <a class="btn btn-white btn-bitbucket btn-sm  " id='reduceStartTime'>
                        <i class="fa fa-angle-left" ></i>
                     </a>
                </div>
                
                <!-- input form start -->
                    <div class='textSetTime'>
                        <input type="text" class="form-control input-sm  " id='startTimeForDisplay' placeholder="00:00">
                    </div>
                <!-- input form end -->
                
                
                 <div class='doublerightArea'>
                     <a class="btn btn-white btn-bitbucket btn-sm  " id='increaseStartTime'>
                        <i class="fa fa-angle-right" ></i>
                    </a>
                    
                    <a class="btn btn-white btn-bitbucket btn-sm  " id='increaseDay'>
                        <i class="fa fa-angle-double-right"></i>
                    </a>
                 </div>
                
            </div>
            
            
            
            <div class='setTimeCustomArea timeFocusExpand' >
                <div class='doubleLeftArea'>
                    
                     <a class="btn btn-white btn-bitbucket btn-sm  " id='focus'>
                        <i class="fa fa-angle-left"></i>
                     </a>
                </div>
              
                <!-- input form start -->
                    <div class='textExpandFocus'>
                        <input type="text" class="form-control input-sm  " id='expandFocus' placeholder="4 Hour">
                    </div>
                <!-- input form end -->
                
                
                 <div class='doublerightArea'>
                     <a class="btn btn-white btn-bitbucket btn-sm  " id='expand'>
                        <i class="fa fa-angle-right"></i>
                    </a>
                    
                 </div>
                
            </div>
            
            <!-- date display -->
        </div>
    </div>
    
    	 <!-- kendo ui chart start -->
        <div class="row grachArea">
            <div class='col-md-9 col-padding0'> 
                <div class="demo-section k-content wide " id='trendChartArea'>
                    
        	        <div id="trendChart" class='heightChart' style="background: center no-repeat url('/js/kendoCommercial/bg/world-map.png');"></div>
        	   
        	    </div>
    	    </div>
    	    
            <div class='col-md-3 col-padding0' >
                <!-- list point area -->
                <ul class="list-group clear-list m-t" id='listPointLeftArea'>
                </ul>
                <!-- list point area -->
            </div>
        </div>
        <!-- 
        <div class="lineChartArea">
    	</div>
    	<div class='listPointLeftArea'>
    	</div>
    	 -->
        <!-- kendo ui chart end -->
       <div class='row footGrachArea'>
        <div class='col-sm-12'>
            <div class='trendFooterArea'>
                <div class='checkboxFooter'>
                    <div class="i-checks">
                    <label class=""> 
                    <div class="iradio_square-green " style="position: relative;"><input type="radio" name="showTrendby" value="showbyPointName" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                    <i></i> Show by Point Name </label>
                    </div>
                </div>
                <div class='checkboxFooter'>
                        <div class="i-checks">
                        <label class=""> 
                        <div class="iradio_square-green" style="position: relative;"><input type="radio" name="showTrendby" value="showbyTagName" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                        <i></i> Show by Tag Name
                        </label>
                        </div>
                </div>
               
               <div class='checkboxFooter showPointAll'>
                    <div class="i-checks">
                    <label class=""> 
                    <div class="iradio_square-green " style="position: relative;"><input type="radio" id='showPointAll' class='showHiddenPoint' name="showHiddenPoint" value="showPointAll" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> 
                    <i></i> Show Point All  </label>
                    </div>
                </div>
                <div class='checkboxFooter'>
                        <div class="i-checks">
                        <label class=""> 
                       <div class="iradio_square-green " style="position: relative;">
                       
                       <input type="radio" class='showHiddenPoint'  id='hiddenPointAll' name="showHiddenPoint" value="hiddenPointAll" style="position: absolute; opacity: 0;">
                       
                       <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                        <i></i> Hidden Point All
                        </label>
                        </div>
                        
                         
                </div>
                
            </div>
          </div>
       </div>
       
       <br style='clear:both'>
       <br style='clear:both'>
       <br style='clear:both'>
               
            </div>
            
        </div>
        
        <div class="tab-pane" id="tab-2">
            <div class="panel-body">
            content2
              
<br>
<br>
<br>
<br>
<br>
<br>
                <a class="btn btn-large" id='test1'  data-placement="bottom" data-toggle="confirmation">Click to toggle confirmation</a>
                   
            </div>
        </div>
        <div class="tab-pane" id="trendSeting">
            <div class="panel-body">
           
            <!-- content area tab-3 start -->
     <div id="areaTrendSeting"></div>
    <!-- content area tab-3 start -->
            </div>
        </div>


</div>

<!-- Content End-->  



<!-- Main title Start -->
<!-- 
	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Dashboard Trend </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Dashboard</a>
                </li>
               
                <li class="active">
                    <strong> Trend</strong>
                </li>
            </ol>
        </div>
        
    </div>
-->      
<!-- Main title end -->   




<!-- Modal Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="setTimeScale" class="modal inmodal in" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content animated flipInY">
<div class="modal-header">
    <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
   <h5 class="modal-title">Edit Point</h5>
      
   </div>
  <div class="modal-body">
  	
                    <!-- edit trend point start -->
                            <div id='editTrendPointArea'>
                                
                            </div>
                     <!-- edit trend point end -->
                    
      </div>
     <div class="modal-footer">
     <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
    <button class="btn btn-primary" type="button">ตกลง</button>
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