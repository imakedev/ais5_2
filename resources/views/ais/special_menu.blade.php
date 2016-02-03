@extends('layouts.main')

@section('page_title','Process View')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')

    <div class="content">        <!-- Content Start-->
<!-- iCheck -->
<script src="/Controller/cDesignTrend.js"></script>
<link rel="stylesheet" href="/css/plugins/iCheck/custom.css">
<link rel="stylesheet" href="/css/plugins/dataTables/dataTables.bootstrap.css">

<!-- Main title Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Special Menu </h2>
        <ol class="breadcrumb">
            <li>
                <a href="index">Design</a>
            </li>
            <li class="active">
                <strong>Special Menu</strong>
            </li>
        </ol>
    </div>
</div>
<!-- Main title end -->
<div class="row">
    <!-- Table trend start-->
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Special Menu Management</h5>
            </div>
            <div class="ibox-content">
            
               <div class="row bgParam ">
                    <div class="col-xs-offset-6 col-xs-2 ">
                           <div id="listAllTrendGroupArea"><select class="form-control input-sm pull-right" id="listAllTrendGroup"><option value="9">My Trend</option><option value="900002">Boiler Trend</option><option value="900003">Turbine Trend</option><option value="900004">Electrical Trend</option><option value="900005">Loss Analyzing</option><option value="900006">Start up and S/D</option></select></div>
                    </div>
                     <div class="col-xs-2">
                      <input type="text" class="input-sm form-control pull-right" placeholder="ค้นหาด่วน" name="searhTrend" id="searhTrend"> 
                     </div>
                    <div class="col-xs-2 ">
                                <button style="width:100%" class="btn btn-sm btn-primary pull-right" id="btnSearchByGroup" type="button"> Search Trend</button> 
                    </div>
                </div>
                
                
                <div class="dataTables_wrapper form-inline dt-bootstrap" id="editable_wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <table aria-describedby="editable_info" role="grid" class="table table-striped table-bordered table-hover  dataTable" id="editable">
                                <thead>
                                <tr role="row">
                                    <th aria-label="" aria-sort="" style="width: 0%;" colspan="1" rowspan="1" aria-controls="" tabindex="0" class=""> <input type="checkbox" id="checkAll">
                                    </th>
                                    <th aria-label="Browser: activate to sort column ascending" style="width: 75%;" colspan="1" rowspan="1" aria-controls="editable" tabindex="0" class="">
                                        Trend Name
                                    </th>
                                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 25%;" colspan="1" rowspan="1" aria-controls="editable" tabindex="0" class="">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" id="mmtrend_zz">
                                                                        <tr role="row" class="gradeA odd">
                                        <td class="sorting_1">
                                                <input type="checkbox" value="57" data-id="checkbox" class="ck" name="checkbox[]">
                                        </td>
                                        <td>TB.5</td>
                                        <!--  URL::to('/addUser/destroy',$info_emp->ZZ)  -->
                                        <!--  url('/addUser/destroy',$info_emp->ZZ)  -->
                                        <td>
                                            <a class="btn btn-primary  btn-xs" onclick="">Choose Point</a> |
                                            <a class="btn btn-primary  btn-xs" data-target="#copy" data-toggle="modal"  onclick="">Copy </a> |
                                            <a class="btn btn-primary  btn-xs" data-target="#move" data-toggle="modal"  onclick="">Move </a> 
                                       </td>
                                       
                                    </tr>
                                                                        <tr role="row" class="gradeA odd">
                                        <td class="sorting_1">
                                                <input type="checkbox" value="291" data-id="checkbox" class="ck" name="checkbox[]">
                                        </td>
                                        <td>hotRHtemp</td>
                                        <!--  URL::to('/addUser/destroy',$info_emp->ZZ)  -->
                                        <!--  url('/addUser/destroy',$info_emp->ZZ)  -->
                                        <td>
                                            <a class="btn btn-primary  btn-xs" onclick="">Choose Point</a> |
                                            <a class="btn btn-primary  btn-xs" onclick="">Copy </a> |
                                            <a class="btn btn-primary  btn-xs" onclick="">Move </a> 
                                       </td>
                                    </tr>
                                                                        <tr role="row" class="gradeA odd">
                                        <td class="sorting_1">
                                                <input type="checkbox" value="88" data-id="checkbox" class="ck" name="checkbox[]">
                                        </td>
                                        <td>SH-RH Temperature Control</td>
                                        <!--  URL::to('/addUser/destroy',$info_emp->ZZ)  -->
                                        <!--  url('/addUser/destroy',$info_emp->ZZ)  -->
                                        <td>
                                            <a class="btn btn-primary  btn-xs" onclick="">Choose Point</a> |
                                            <a class="btn btn-primary  btn-xs" onclick="">Copy </a> |
                                            <a class="btn btn-primary  btn-xs" onclick="">Move </a> 
                                       </td>
                                   
                                   </tbody>
                            </table>
                                    <div style="float: right;">
                                        <ul class="pagination"><li class="disabled"><span>«</span></li> <li class="active"><span>1</span></li><li><a href="http://localhost:9952/ais/designTrend?page=2">2</a></li><li><a href="http://localhost:9952/ais/designTrend?page=3">3</a></li><li><a href="http://localhost:9952/ais/designTrend?page=4">4</a></li><li><a href="http://localhost:9952/ais/designTrend?page=5">5</a></li><li><a href="http://localhost:9952/ais/designTrend?page=6">6</a></li><li><a href="http://localhost:9952/ais/designTrend?page=7">7</a></li><li><a href="http://localhost:9952/ais/designTrend?page=8">8</a></li><li class="disabled"><span>...</span></li><li><a href="http://localhost:9952/ais/designTrend?page=144">144</a></li><li><a href="http://localhost:9952/ais/designTrend?page=145">145</a></li> <li><a rel="next" href="http://localhost:9952/ais/designTrend?page=2">»</a></li></ul>
                                    </div>
                        </div>
    </div>
    <!-- Table trend end-->
</div>

    <!-- show point start -->
<div class='row'>
<div style="" class="col-lg-12" id="trend_element">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5 id="trend_element_header">แสดง Point ของ TB.5</h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-6 ">
                   
                </div>
                <div class="col-md-3 lableDropdownList">MMPlant</div>
                <div class="col-md-3">
                    <select class="form-control m-b" id="mmplant">
                        <option>MM04</option>
                        <option>MM05</option>
                        <option>MM06</option>
                        <option>MM07</option>
                    </select>
                </div>
            </div>
            <div class="dataTables_wrapper form-inline dt-bootstrap" id="editable_wrapper">
                <div class="row">
                    <div class="col-sm-12 table-responsive" id="trend_element_table"> 
                    <table aria-describedby="editable_info" role="grid" class="table table-striped table-bordered table-hover  dataTable" id="editable">   
                    <thead>     
                    <tr role="row">     
                    <th aria-label="" aria-sort="" style="width: 0%;" colspan="1" rowspan="1" aria-controls="" tabindex="0" class="">  
                    <input type="checkbox" id="checkAll_inner">      
                    </th>      
                    <th aria-label="Browser: activate to sort column ascending" style="width: 10%;" colspan="1" rowspan="1" aria-controls="editable" tabindex="0" class="">      Point      </th>     
                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 5%;" colspan="1" rowspan="1" aria-controls="editable" tabindex="0" class="">      MM     </th>    
                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 45%;" colspan="1" rowspan="1" aria-controls="editable" tabindex="0" class="">      Point Name  </th>  
                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 15%;" colspan="1" rowspan="1" aria-controls="editable" tabindex="0" class="">      Tag Name   </th>  
                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 10%;" colspan="1" rowspan="1" aria-controls="editable" tabindex="0" class="">      Unit      </th>      
                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 5%;" colspan="1" rowspan="1" aria-controls="editable" tabindex="0" class="">      Max      </th>      
                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 5%;" colspan="1" rowspan="1" aria-controls="editable" tabindex="0" class="">      Min      </th>      
                    </tr>     
                    </thead>     
                    <tbody>     
                        <tr role="row" class="gradeA odd">     
                            <td class="sorting_1">     <input type="checkbox" value="974" data-id="checkbox" class="ck_inner" name="checkbox_inner[]">     </td>    
                            <td>11</td>    
                            <td>5</td>    
                            <td>Turbine Speed</td>  
                            <td>50SB10Y001</td>  
                            <td>rpm</td>  
                            <td>3400</td>  
                            <td>0</td>  
                       </tr> 
                       <tr role="row" class="gradeA odd">     
                            <td class="sorting_1">     <input type="checkbox" value="974" data-id="checkbox" class="ck_inner" name="checkbox_inner[]">     </td>    
                            <td>11</td>    
                            <td>5</td>    
                            <td>Turbine Speed</td>  
                            <td>50SB10Y001</td>  
                            <td>rpm</td>  
                            <td>3400</td>  
                            <td>0</td>  
                       </tr>  
                       <tr role="row" class="gradeA odd">     
                            <td class="sorting_1">     <input type="checkbox" value="974" data-id="checkbox" class="ck_inner" name="checkbox_inner[]">     </td>    
                            <td>11</td>    
                            <td>5</td>    
                            <td>Turbine Speed</td>  
                            <td>50SB10Y001</td>  
                            <td>rpm</td>  
                            <td>3400</td>  
                            <td>0</td>  
                       </tr>      
                            
                            
                     </tbody>  
                 </table> 
                 </div>
                </div>
                <div style="float: right;" id="trend_paging">

                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <!-- show point end -->
    
    
    <!-- Modal copy Start -->
    <div aria-hidden="true" role="dialog" tabindex="-1" id="copy" class="modal inmodal in"
         style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"><span
                                aria-hidden="true">×</span><span class="sr-only">Close</span>
                    </button>
                    <h5 id="mmname_tilte_section" class="modal-title">Copy Trend TB.5</h5>
               
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-3 control-label padding5">ตั้งชื่อ Trend ใหม่</label>

                            <div class="col-lg-9 padding5">
                                <input type="text" id="mmname_a" name="mmname_a" class="form-control " placeholder="ชื่อ Trend">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-3 control-label padding5">Target Group</label>

                            <div class="col-lg-9 padding5">
                               <select id="listAllTrendGroup" class="form-control input-sm pull-right"><option value="9">My Trend</option><option value="900002">Boiler Trend</option><option value="900003">Turbine Trend</option><option value="900004">Electrical Trend</option><option value="900005">Loss Analyzing</option><option value="900006">Start up and S/D</option></select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-3 control-label padding5">Target Unit</label>

                            <div class="col-lg-9 padding5">
                               <select id="listAllTrendGroup" class="form-control input-sm pull-right">
                                    <option value="">Same</option>
                                    <option value="">MM04</option>
                                    <option value="">MM05</option>
                                    <option value="">MM06</option>
                                    <option value="">MM07</option>
                               </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
                    <button class="btn btn-primary"  type="button">ตกลง</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal copy End -->
    
    <!-- Modal move Start -->
    <div aria-hidden="true" role="dialog" tabindex="-1" id="move" class="modal inmodal in"
         style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button"><span
                                aria-hidden="true">×</span><span class="sr-only">Close</span>
                    </button>
                    <h5 id="mmname_tilte_section" class="modal-title">Move Trend TB.5</h5>
               
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        
                        <div class="form-group"><label class="col-lg-3 control-label padding5">Target Group</label>

                            <div class="col-lg-9 padding5">
                               <select id="listAllTrendGroup" class="form-control input-sm pull-right"><option value="9">My Trend</option><option value="900002">Boiler Trend</option><option value="900003">Turbine Trend</option><option value="900004">Electrical Trend</option><option value="900005">Loss Analyzing</option><option value="900006">Start up and S/D</option></select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-3 control-label padding5">Target Unit</label>

                            <div class="col-lg-9 padding5">
                               <select id="listAllTrendGroup" class="form-control input-sm pull-right">
                                    <option value="">Same</option>
                                    <option value="">MM04</option>
                                    <option value="">MM05</option>
                                    <option value="">MM06</option>
                                    <option value="">MM07</option>
                               </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
                    <button class="btn btn-primary"  type="button">ตกลง</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal move End -->
    
    <!-- content end -->
    
     @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop