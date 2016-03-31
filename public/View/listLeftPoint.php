
 
 
<script src="/Controller/cListLeftPoint.js"></script>
<?php 
$calID = $_GET['calID'];

if(($calID!='') and ($calID!='0') and ($calID!=0)){
    $id="DC".$calID;
}else{
    
    $id="U0".$_GET['unit_plant']."D".$_GET['point'];
}

?>

<!-- $_GET['paramTrendID'] -->
<!-- list point start-->
    <li class="list-group-item ">
       <div class='row'>
            <div class='col-md-10 col-sm-10 col-xs-10 '>
                    <div class="row ">
                    <div class='col-md-12  col-sm-12 col-xs-12' id='btnPoint-<?=$_GET['index']?>'>
                        <div  id='labelTitle'>
                            <!-- <span class="label label-success" >1</span> Point1-->
                            <!-- btn seting grach1 start-->
                            <!-- U05D260 -->
                            
                            
                            <button id='<?=$id?>'  type="button" style='background: <?=$_GET['colorFlatTheme']?>;color:white;' class="btn  btn-xs btnSetingPoint btnSetingPoint-<?=$_GET['point']?>" data-container="body" 
                                data-toggle="popover" data-placement="bottom"  title="Event Seting"  data-html="true"
                                data-content="
                                 
                               
                                <table class=''>
                                    <!-- 
                                    <tr>
                                        <td colspan='2'>
                                         <b> Show Piont</b>
                                        </td>
                                       
                                    </tr>
                                    <tr>
                                        <td colspan='2'>
                                                 <input type='radio' name='showPoint' class='showPoint' id='show-<?=$_GET['point']?>' value='show'> Show
                                                 <input type='radio' name='showPoint' class='showPoint' id='hide-<?=$_GET['point']?>' value='hide'> Hide
                                        </td>
                                       
                                    </tr>
                                    
                                    <tr>
                                        <td colspan='2'>
                                         <b> Show Event</b>
                                        </td>
                                       
                                    </tr>
                                     -->
                                    <tr>
                                        <td colspan='2'>
                                            <input type='checkbox' name='pointEvent' class='pointEvent i-checks' id='event-<?=$id?>-<?=$_GET['paramTrendID']?>' value='event'>&nbsp;Event
                                            &nbsp; <input type='checkbox' class='pointEvent i-checks' name='pointEvent' id='action-<?=$id?>-<?=$_GET['paramTrendID']?>' value='action'>&nbsp;Action
                                            &nbsp;<input type='checkbox' class='pointEvent i-checks' name='pointEvent' id='vpser-<?=$id?>-<?=$_GET['paramTrendID']?>' value='vpser'>&nbsp;VPSER
                                        </td>
                                      
                                    </tr>
                                     <!-- 
                                     <tr>
                                        <td colspan='2'>
                                          <b> Set Scale</b>
                                        </td>
                                       
                                    </tr>
                                    <tr>
                                        <td colspan='2'>
                                         Scale Max=250 T/H Scale Min=0 T/H
                                        </td>
                                       
                                    </tr>
                                   
                                    <tr>
                                        <td  colspan='2'>
                                       <span style='float:left; width:63px;'> Max Scale</span>
                                       <span style='float:left; width:100px;'> <input type='text' id='maxScale-<?=$_GET['point']?>-<?=$_GET['paramTrendID']?>' name='maxScale-<?=$_GET['point']?>-<?=$_GET['paramTrendID']?>'  class='form-control input-sm' style='width:40px;' ></span>
                                        </td>
                                        
                                       
                                    </tr>
                                     -->
                                    <tr class='btnArea' >
                                        <td colspan='2' >
                                            <div style='padding:5px;'>
                                            <!-- unit_plant U04D260-->
                                            <button class='btn btn-primary btn-xs  btnOkSetingPoint' id='psOk-<?=$id?>' type='button'>
                                                <!-- <i class='fa fa-save'></i>&nbsp; -->
                                               OK
                                            </button>
                                             <button class='btn btn-white btn-xs  btnCancelSetingPoint' id='psCancel-<?=$id?>' type='button'>
                                                <!--  <i class='fa fa-power-off'></i>&nbsp;-->
                                               Cancel
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </table>
                             
                                
                                
                                ">
                                  <i class="fa fa-gear"></i>
                             </button>
                             <span style='color:<?=$_GET['colorFlatTheme']?>'>
                             
                             <span class='clickHideShowPoint showPoint' id='showPoint-<?=$id?>-<?=$_GET['paramTrendID']?>'>
                              <div class='pointName pointName-<?=$_GET['paramTrendID']?>'>
                             U0<?=$_GET['unit_plant']?> <?=$_GET['pointname'];?>
                             </div>
                              <div class='pointTag pointTag-<?=$_GET['paramTrendID']?>' >,U0<?=$_GET['unit_plant']?> <?=$_GET['tag'];?></div>
                             <!-- U04D260 -->
                             <!-- <div class='pointId pointId-<?=$_GET['paramTrendID']?>'>,D<?=$_GET['point']?></div> -->
                             <div class='pointId pointId-<?=$_GET['paramTrendID']?>' >,<?=$id?></div>
                             <div class='pointId2 pointId2-<?=$_GET['paramTrendID']?>' >,D<?=$_GET['point']?>-<?=$_GET['unit_plant']?>-<?=$_GET['pointId']?></div>
                            
                             </span>
                             
                             </span>
                            <!-- btn seting grach1 end-->
                        </div>   
                        <div id='setEvent'>
                          
                            
                        </div>
                        
                        
                    </div>
                    
                    
                   
                </div>
                 <div class="row">
                   
                    <div class='col-md-12 col-sm-12 col-xs-12'>
                   <!--  unit_plant--> 
                   <!-- 
                         <span class="pull-left valuePoint" id='valuePoint-<?=$_GET['point']?>-<?=$_GET['paramTrendID']?>-<?=$_GET['unit_plant']?>' style='color:<?=$_GET['colorFlatTheme']?>'>
                            
                            00.00
                        </span>
                         <span class="pull-right planPoint" id='planPoint-<?=$_GET['point']?>-<?=$_GET['paramTrendID']?>-<?=$_GET['unit_plant']?>' style='color:<?=$_GET['colorFlatTheme']?>'>
                            00.00
                        </span>
                        -->
                        <span class="pull-left valuePoint" id='valuePoint-<?=$id?>-<?=$_GET['paramTrendID']?>' style='color:<?=$_GET['colorFlatTheme']?>'>
                            
                            00.00
                        </span>
                         <span class="pull-right planPoint" id='planPoint-<?=$id?>-<?=$_GET['paramTrendID']?>' style='color:<?=$_GET['colorFlatTheme']?>'>
                            00.00
                        </span>
                   
                    </div>
                   
                </div>
            </div>
            <div class='col-md-2 fontSize10 col-sm-2 col-xs-2 col-padding0 unitWidth'>
                 <div class="row">
                     <div class='col-md-12 col-sm-12 col-xs-12'><?=$_GET['unit']?></div>
                 </div>
                 <div class="row">
                     <div class='col-md-12 col-sm-12 col-xs-12'><?=$_GET['max']?></div>
                 </div>
                 <div class="row">
                     <div class='col-md-12 col-sm-12 col-xs-12'><?=$_GET['min']?></div>
                 </div>
                 
            </div>
       </div>
    </li>
    <div style='display: none;'>
    
        <div class='paramEmbedArea' id='paramEmbedArea-<?=$id?>-<?=$_GET['paramTrendID']?>'>
            
        </div>
    </div>
    
<!-- list point end-->

