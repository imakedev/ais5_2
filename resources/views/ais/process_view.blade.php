@extends('layouts.main')

@section('page_title','Process View')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
<script src='/Controller/cProcessView.js'></script> 
<link href="/css/processView.css" rel="stylesheet">
<link rel="stylesheet" href="/css/plugins/nouslider/jquery.nouislider.css">
<link rel="stylesheet" href="/css/plugins/ionRangeSlider/ion.rangeSlider.css">
<link rel="stylesheet" href="/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css">
<link href="/css/plugins/iCheck/custom.css" rel="stylesheet">

<!-- kendo ui start -->
<link rel="stylesheet" href="/js/kendoUI/styles/kendo.black.min.css" />
<!-- kendo ui end -->
<!-- test start 
<button id='btnExport'>button</button>-->
<!-- test end -->

<!-- Content Start-->  
   
				<div class="ibox ">
                    <div class="ibox-title bgBlack">
                        <h5>Process View</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="fullscreen-link">
                                <i class="fa fa-expand"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content bgBlack">
                         <div class='row'>
                             <div class='col-xs-12'>
                                <!-- grid list event -->
                                  <table class="gridPCV">
                                     <colgroup>
                                         <col style="width:100%"/>
                                       
                                     </colgroup>
                                     <thead>
                                         <tr>
                                             <th data-field="field1">
                                             <!-- menu start -->
                                             	<!-- process view start menu-->
                                                <div class="row bgParam ">
                                                   
                                    	            <div class="col-xs-2 ">
                                                    <!-- slide start -->
                                                    
                                                     <label class="control-label" for="slideFocusExpress">Focus / Expand</label>
                                                     
                                                      <div id="slideFocusExpressArea">
                                                        <div id="slideFocusExpress"></div>
                                                      </div>
                                                     <!-- 
                                                    <div class="noUi-target noUi-ltr noUi-horizontal noUi-background slideTop" id="basic_slider">
                                                        
                                                        <div class="noUi-base">
                                                            <div style="left: 48.1113%;" class="noUi-origin noUi-connect">
                                                                <div class="noUi-handle noUi-handle-lower"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     -->
                                                    <!-- slide end -->
                                                    </div>
                                    	             
                                    	            <div class="col-xs-10">
                                    	            
                                    	             <div class="row">
                                    	               <div class="col-xs-3">
                                    	                 
                                                               
                                                            <div class="form-group">
                                                                <label class="control-label" for="paramPcv">PCV</label>
                                                                <select class="form-control input-sm bgBlack" id='paramPcv' name="paramPcv">
                                                                    
                                                                     <?php if(Session::get('user_mmplant')==1){
                                                                     ?>
                                                                    <option value='plantow47' selected='selected'>Plant Overview </option>
                                                                    <option value='steam47' >STEAM </option>
                                                                    <option value='fgd67'>FGD </option>
                                                                    <option value='turbine47'>Turbine </option>
                                                                    <?php }else{
                                                                    ?>
                                                                     <option selected='selected' value='steam813' >STEAM</option> 
                                                                     <option value='fring'>FRING</option>
                                                                     <option value='pulv'>PULV</option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                   <!--  <option value='steam813' >STEAM(813)</option> -->
                                                                    
                                                                    <!-- 
                                                                    <option value='plantow'>PLANTOVV</option>
                                                                    <option value='turbine'>TURBINE</option>
                                                                    -->
                                                                    
                                                                   <!-- 
                                                                    <option value='steam'>STEAM</option>
                                                                    <option value='pulv'>PULV</option>
                                                                    <option value='fring'>FRING</option>
                                                                   -->
                                                                    
                                                                    
                                                                </select> 
                                                            </div>
                                                            
                                    	               </div>
                                    	                <div class="col-xs-2">
                                    	                 
                                                               
                                                            <div class="form-group">
                                                                <label class="control-label" for="product_name">Unit</label>
                                                                <select class="form-control input-sm bgBlack" name="paramUnit" id='paramUnit'>
                                                                 <?php if(Session::get('user_mmplant')==1){
                                                                     ?>
                                                                    <option value='4'>MM04</option>
                                                                    <option value='5'>MM05</option>
                                                                    <option value='6'>MM06</option>
                                                                    <option value='7'>MM07</option>
                                                                     <?php 
                                                                 }else{
                                                                     ?>
                                                                    <option value='8'>MM08</option>
                                                                    <option value='9'>MM09</option>
                                                                    <option value='10'>MM10</option>
                                                                    <option value='11'>MM11</option>
                                                                    <option value='12'>MM12</option>
                                                                    <option value='13'>MM13</option>
                                                                     <?php 
                                                                 }
                                                                 ?>
                                                                   
                                                                   
                                                                </select> 
                                                            </div>
                                                            
                                    	               </div>
                                    	               
                                    	               <div class="col-xs-2">
                                    	                 
                                    	                     <div class="form-group">
                                                                <label class="control-label" for="product_name">Date</label>
                                                               
                                                                <div class="input-group  ">
                                                                   <input type="text" class="form-control input-sm bgBlack" id='paramDate' value="2015-11-01">
                                                                </div>
                                                                 
                                                            </div>
                                                           
                                    	               </div>
                                    	               <div class="col-xs-1">
                                    	               <!--
                                    	                         <div class="form-group">
                                                                    <label class="control-label" for="paramHour">Hour</label>
                                                                    
                                                                    <div class="input-group ">
                                                                        <input type='text' class='input-xs form-control bgBlack' id='paramHour' name='paramHour' value='0.00'>
                                                                    </div>
                                                                    
                                                                    
                                                                </div>
                                                            
                                                            -->    
                                                             <div class="form-group">
                                                                    <label class="control-label" for="paramHour">Hour</label>
                                                                   
                                                                    <div class="input-group ">
                                                                        <input type='text' class='input-sm form-control bgBlack' name='paramHour' id='paramHour' value='0.00'>
                                                                    </div>
                                                                </div>
                                                           
                                    	               </div>
                                    	               <div class="col-xs-1"   >
                                    	                 
                                                                 <div class="form-group">
                                                                    <label class="control-label" for="paramMinute">Minute</label>
                                                                   
                                                                    <div class="input-group ">
                                                                        <input type='text' class='input-sm form-control bgBlack' name='paramMinute' id='paramMinute' value='0.00'>
                                                                    </div>
                                                                </div>
                                                           
                                    	               </div>
                                    	               <div class="col-xs-1"   >
                                    	                 
                                                                 <div class="form-group">
                                                                    <label class="control-label" for="product_name">Span T</label>
                                                                   
                                                                    <div class="input-group ">
                                                                        <input type='text' class='input-sm form-control bgBlack' name='paramSpanTime' id='paramSpanTime' value='4'>
                                                                    </div>
                                                                </div>
                                                           
                                    	               </div>
                                    	               
                                    	              
                                	                   <div class="col-xs-2">
                                       
                                                            <a class="btn btn-primary  btn-sm btnSubmit" id='btnSubmit' href="#">แสดง </a>
                                                            <!-- download button start -->
                                                            <button class="btn btn-warning btn-sm  btnSubmit" type="button" data-container="body" 
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
                                                            <button class='btn btn-primary btn-sm  ' id='downloadData' type='button'>
                                                                <i class='fa fa-download'></i>
                                                               Download
                                                            </button>
                                                            ">
                                                                <i class="fa fa-download"></i>&nbsp;&nbsp;
                                                               
                                                            </button>
                                                            <!-- download button end -->
                                                            
                                                            
                                                       </div>
                                    	             </div>
                                                     
                        
                                    	            </div>
                                                </div>
                                              
                                              
                                                  
                                                <!-- process view end -->
                        					 <!-- menu end -->
                        					</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                            
                                             <td>
                                                <div id='disPlayDateTimeArea'>
                                                    
                                                </div>
                                             		
                                             </td>
                                            
                                         </tr>
                                         </tbody>
                                  </table>
                                  
                                  <!-- display process view start -->
                                    <div class='row'>
                                        <div class='col-xs-12'>
                                      
                                            <div id='processViewArea'></div>
                                        
                                        </div>
                                    </div>
                                  <!-- display process view end -->              
                           </div>
                        </div>
                        
                        <div id='paramEmbedArea'>
                            
                        </div>
                        <input type='hidden' id='eventAction' name='eventAction' value='showEvent'>
                        
                        
                        <br style='clear: both'>
                        <br style='clear: both'>
                    </div>
                </div>
                
                <!-- test download excel start -->
                <div id="dvData" style='display:none;'>
                    <table>
                        <tr>
                            <th>Column One</th>
                            <th>Column Two</th>
                            <th>Column Three</th>
                        </tr>
                        <tr>
                            <td>row1 Col1</td>
                            <td>row1 Col2</td>
                            <td>row1 Col3</td>
                        </tr>
                        <tr>
                            <td>row2 Col1</td>
                            <td>row2 Col2</td>
                            <td>row2 Col3</td>
                        </tr>
                        <tr>
                            <td>row3 Col1</td>
                            <td>row3 Col2</td>
                            <td><a href="http://www.jquery2dotnet.com/">http://www.jquery2dotnet.com/</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- test download excel end -->
               
                
                <script>
                $("#btnExport").click(function (e) {
                    window.open('data:application/vnd.ms-excel,' + $('#dvData').html());
                    e.preventDefault();
                });
                </script>
  <!-- Content End-->           
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop