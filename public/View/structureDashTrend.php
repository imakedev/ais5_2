<!-- 
<script src="/Controller/cTrend.js"></script>
 -->
<!-- test start -->

<!-- test start -->
<!-- trend contend area start -->
<link href="/css/structureDashTrend.css" rel="stylesheet">
<div id='tooltipData' class='displaynone'>
    <!-- 
    <ul id='eventArea-point-trend'>Trend01
        <li id='event-point-trend'>event</li>
        <li id='action-point-trend'>action</li>
        <li id='vpser-point-trend'>vpser</li>
    </ul>
    <ul id='eventArea-point-trend'>Trend02
        <li id='event-point-trend'>event</li>
        <li id='action-point-trend'>action</li>
        <li id='vpser-point-trend'>vpser</li>
    </ul>
     -->
</div>
<div id='trendContentArea' class=''>

            
            <div class='row scaleTimeMenu '>
                <div class='col-md-2 '>
                   <!--<div class='col-md-2 basicSlideArea'>
                    slide start -->
                        <div class='scaleTimeMenuRightArea' id='scaleTimeMenuRightArea-<?=$_GET['paramTrendID']?>'>
                        <!-- <div id="keypress" ></div> -->
                        <!-- start -->
                        <div class='setTimeCustomArea timeFocusExpand' >
                        <div class='doubleLeftArea'>
                            
                             <a class="btn btn-white btn-bitbucket btn-sm  " id='focus-<?=$_GET['paramTrendID']?>'>
                                <i class="fa fa-minus"></i>
                             </a>
                        </div>
                      
                        
                            <div class='textExpandFocus'>
                                <input type="text" class="form-control input-sm expandFocus " id='expandFocus-<?=$_GET['paramTrendID']?>' >
                            </div>
                        
                        
                        
                         <div class='doublerightArea'>
                             <a class="btn btn-white btn-bitbucket btn-sm  " id='expand-<?=$_GET['paramTrendID']?>'>
                                <i class="fa fa-plus"></i>
                            </a>
                            
                         </div>
                        
                    </div>
                        <!-- end -->
                    </div>
                    <div class='scaleTimeMenuLeftArea displaynone' id='scaleTimeMenuLeftArea-<?=$_GET['paramTrendID']?>'>
                        4 Hour
                    </div>
                	 
                   
                <!-- slide end -->
                
                
                        <?
                        //$_GET['paramTrendID']
                        ?> 
                            <!-- 
                            <div class='dateInDataDisplayArea'>
                                
                                <div class='dateInDataDisplay'><div id='dateInDataDisplay'>18 พฤศจิกายน 2558</div></div>
                                <div class='timeInDataDisplay'><div id='timeInDataDisplay'> เวลา 13:36 น.</div></div>
                                <br style='clear:both'>
                            </div>
                             -->
                </div>
                <div class='col-md-5'>
               
                <!-- date display -->
                <!-- 
                <div class=" navy-bg titleDate">
                     <span>  ข้อมูลวันที่ 9 - 10 กันยายน 2558 </span>
                </div>
                 -->
                <!-- scale time start -->
               
                
                <div class="btn btn-sm titleDate btnScaleTimeArea" id='btnScaleTimeArea-<?=$_GET['paramTrendID']?>' data-container="body" 
                        data-toggle="popover" data-placement="bottom"   title="<i class='fa fa-calendar'></i> Scale Times" data-html="true"
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
                                <div class='col-lg-9 scaleTimeR'>
                                    <select name='scaleTime-<?=$_GET['paramTrendID']?>' id='scaleTime-<?=$_GET['paramTrendID']?>' class='form-control input-sm '>
                                        
                                        <option value='Month'>Month</option>
                                        <option value='Day'>Day</option>
                                        <option value='Hour'>Hour</option>
                                        <option value='Minute' selected='selected'>Minute</option>
                                        <option value='Second'>Second</option>
                                        
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
                                <div class='col-lg-9 scaleTimeR' id='dateFromArea-<?=$_GET['paramTrendID']?>'>
                                        <!-- 07/01/2014 -->
                                       <input type='text' id='dateFrom-<?=$_GET['paramTrendID']?>' value='' class='form-control input-sm' style='width: 100%'>
                                    
                                </div>
                           </div>
                     </div>
                     <div class='row rowTopBottomMargin forSecondFormHide'>
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
                                <div class='col-lg-9 scaleTimeR' id='dateToArea-<?=$_GET['paramTrendID']?>'>
                                   <!-- 07/01/2014 -->
                                       <input type='text' id='dateTo-<?=$_GET['paramTrendID']?>' value='' class='form-control input-sm' style='width: 100%'>
                                    
                                </div>
                           </div>
                        
                     </div>
                     
                     
                       <div class='row rowTopBottomMargin forSecondFormShow displaynone'>
                           
                            <div class='form-group' >
                                <label class='col-lg-3 control-label textAlign'>ชั่วโมง</label>
                                <div class='col-lg-9 scaleTimeR'>
                                   
                                       <input type='text' id='hour-<?=$_GET['paramTrendID']?>' value='00' class='form-control input-sm '>
                                    
                                </div>
                           </div>
                        
                     </div>
                     
                     <div class='row rowTopBottomMargin forSecondFormShow displaynone'>
                           
                            <div class='form-group' >
                                <label class='col-lg-3 control-label textAlign'>นาที</label>
                                <div class='col-lg-9 scaleTimeR'>
                                   
                                       <input type='text' id='minute-<?=$_GET['paramTrendID']?>' value='02' class='form-control input-sm '>
                                    
                                </div>
                           </div>
                        
                     </div>
                     
                      
                   
                     <div class='btnScaleArea'>
                        <div class='pull-right'>
                            
                            <button  id='btnScaleTime-<?=$_GET['paramTrendID']?>' class='btn btn-sm btn-primary btnScaleTime'>OK</button>
                            <button  class='btn btn-sm btn-white btnScaleTimeCancel' id='btnScaleTimeCancel-<?=$_GET['paramTrendID']?>'>Cancel</button>
                            
                        </div>
                     </div>
                     
                    </div>
              
                       
                        ">
                          <div id='scaleDateTimeArea-<?=$_GET['paramTrendID']?>'></div>
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
                        <button class='btn btn-primary btn-sm  ' id='downloadData' type='button'>
                            <i class='fa fa-download'></i>
                           Download
                        </button>
                        ">
                          <i class="fa fa-download"></i>
                        </button>
                         <button type="button" data-toggle="modal" data-target="#editTrendPointModal" id='editTrendPoint-<?=$_GET['paramTrendID']?>' class="btn btn-warning  btn-sm  editTrendPoint">
                            <i class="fa fa-cogs"></i>
                        </button>
                       
                        
                        
                         <button type="button" data-toggle="modal" data-target="#" id='exitTrendPoint-<?=$_GET['paramTrendID']?>' class="btn btn-danger  btn-sm exitTrendPoint">
                            <i class="fa fa-times-circle"></i>
                        </button>
                    </div>
                  
                  
                  
                    <div class='setTimeCustomArea'>
                        <div class='doubleLeftArea'>
                             <a class="btn btn-sm btn-white btn-bitbucket   " id='reduceDay-<?=$_GET['paramTrendID']?>'>
                             <i class="fa fa-angle-double-left   "></i>
                             </a>
                             <a class="btn btn-white btn-bitbucket btn-sm  " id='reduceStartTime-<?=$_GET['paramTrendID']?>'>
                                <i class="fa fa-angle-left" ></i>
                             </a>
                        </div>
                        
                        <!-- input form start -->
                            <div class='textSetTime'>
                                <input type="text" class="form-control input-sm  startTimeForDisplay" id='startTimeForDisplay-<?=$_GET['paramTrendID']?>' placeholder="00:00">
                            </div>
                        <!-- input form end -->
                        
                        
                         <div class='doublerightArea'>
                             <a class="btn btn-white btn-bitbucket btn-sm  " id='increaseStartTime-<?=$_GET['paramTrendID']?>'>
                                <i class="fa fa-angle-right" ></i>
                            </a>
                            
                            <a class="btn btn-white btn-bitbucket btn-sm  " id='increaseDay-<?=$_GET['paramTrendID']?>'>
                                <i class="fa fa-angle-double-right"></i>
                            </a>
                         </div>
                        
                    </div>
                    
                    
                    <!-- 
                    <div class='setTimeCustomArea timeFocusExpand' >
                        <div class='doubleLeftArea'>
                            
                             <a class="btn btn-white btn-bitbucket btn-sm  " id='focus-<?=$_GET['paramTrendID']?>'>
                                <i class="fa fa-minus"></i>
                             </a>
                        </div>
                      
                         /*input form start */
                            <div class='textExpandFocus'>
                                <input type="text" class="form-control input-sm  " id='expandFocus-<?=$_GET['paramTrendID']?>' placeholder="4 Hour">
                            </div>
                        /*input form end */
                        
                        
                         <div class='doublerightArea'>
                             <a class="btn btn-white btn-bitbucket btn-sm  " id='expand-<?=$_GET['paramTrendID']?>'>
                                <i class="fa fa-plus"></i>
                            </a>
                            
                         </div>
                        
                    </div>
                     -->
                    <!-- date display -->
                </div>
            </div>
            
            	 <!-- kendo ui chart start -->
                <div class="row grachArea">
                    <div class='col-md-9 col-padding0 ' id='boxLeft'> 
                        <div class="demo-section k-content wide " id='trendChartArea-<?=$_GET['paramTrendID']?>'>
                            
                	        <div id="trendChart-<?=$_GET['paramTrendID']?>" class='heightChart' style="background: center no-repeat url('/js/kendoCommercial/bg/world-map.png');"></div>
                	   
                	    </div>
            	    </div>
            	    
                    <div class='col-md-3 col-padding0 ' id='boxRight'  >
                    
                      <div id="titleDateTime">
                         
                            <div id='dateInDataDisplayAreaMenute-<?=$_GET['paramTrendID']?>' class='dateInDataDisplayArea '>   
                                
                                <div class='dateInDataDisplay'>
                                    <span class='dateInDataDisplayLeft' id='dateInDataDisplay-<?=$_GET['paramTrendID']?>'></span>
                                    <span class='dateInDataDisplayRight' id='timeInDataDisplay-<?=$_GET['paramTrendID']?>'></span>
                                </div>
                               <!-- 
                                <div class='timeInDataDisplay'><div id='timeInDataDisplay-<?=$_GET['paramTrendID']?>'></div></div>
                                <br style='clear:both'>
                                -->
                            </div>
                        
                             <div id='dateInDataDisplayAreaHour-<?=$_GET['paramTrendID']?>' class='dateInDataDisplayArea  displaynone'>   
                               
                                    <div id='dateTimeInDataDisplayHour-<?=$_GET['paramTrendID']?>'></div>
                            </div>
                            
                             <div id='dateInDataDisplayAreaHourDay-<?=$_GET['paramTrendID']?>' class='dateInDataDisplayArea  displaynone'>   
                                
                                    <div id='dateTimeInDataDisplayDay-<?=$_GET['paramTrendID']?>'></div>
                            </div>
                            
                             <div id='dateInDataDisplayAreaMonth-<?=$_GET['paramTrendID']?>' class='dateInDataDisplayArea  displaynone'>   
                                
                                    <div id='dateTimeInDataDisplayMonth-<?=$_GET['paramTrendID']?>'></div>
                            </div>
                            
                            <div id='dateInDataDisplayAreaSecond-<?=$_GET['paramTrendID']?>' class='dateInDataDisplayArea  displaynone'>   
                                
                                    <div id='dateTimeInDataDisplaySecond-<?=$_GET['paramTrendID']?>'></div>
                            </div>
                            
                            
                        
                      </div>  
                        <!-- list point area -->
                        <ul class="list-group clear-list m-t" id='listPointLeftArea-<?=$_GET['paramTrendID']?>'>
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
                            <div class="iradio_square-green " style="position: relative;"><input type="radio" class='showTrendby' id='showTrendby-<?=$_GET['paramTrendID']?>' name="showTrendby-<?=$_GET['paramTrendID']?>" value="showbyPointName" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                            <i></i> Show by Point Name </label>
                            </div>
                        </div>
                        <div class='checkboxFooter'>
                                <div class="i-checks">
                                <label class=""> 
                                <div class="iradio_square-green" style="position: relative;"><input type="radio" class='showTrendby' id='showTrendby-<?=$_GET['paramTrendID']?>' name="showTrendby-<?=$_GET['paramTrendID']?>" value="showbyTagName" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                                <i></i> Show by Tag Name
                                </label>
                                </div>
                        </div>
                       
                       <div class='checkboxFooter showPointAll'>
                            <div class="i-checks">
                            <label class=""> 
                            <div class="iradio_square-green " style="position: relative;"><input type="radio" id='showHiddenPoint-<?=$_GET['paramTrendID']?>' class='showHiddenPoint' name="showHiddenPoint-<?=$_GET['paramTrendID']?>" value="showPointAll" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> 
                            <i></i> Show Point All  </label>
                            </div>
                        </div>
                        <div class='checkboxFooter'>
                                <div class="i-checks">
                                <label class=""> 
                               <div class="iradio_square-green " style="position: relative;">
                               
                               <input type="radio" class='showHiddenPoint'  id='showHiddenPoint-<?=$_GET['paramTrendID']?>' name="showHiddenPoint-<?=$_GET['paramTrendID']?>" value="hiddenPointAll" style="position: absolute; opacity: 0;">
                               
                               <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                                <i></i> Hidden Point All
                                </label>
                                </div>
                                
                                 
                        </div>
                        
                    </div>
                  </div>
               </div>
               
 </div><!-- trend contend area end -->   
 
 
      