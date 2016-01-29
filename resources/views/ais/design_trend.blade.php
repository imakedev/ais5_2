@extends('layouts.main')

@section('page_title','Design Trend')

@include('layouts.navigation')

@section('body')
@include('layouts.header')
@section('content')
        <!-- Content Start-->
<!-- iCheck -->
<script src='/Controller/cDesignTrend.js'></script>
<link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

<!-- Main title Start -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Design Trend </h2>
        <ol class="breadcrumb">
            <li>
                <a href="index">Design</a>
            </li>
            <li class="active">
                <strong>Design Trend</strong>
            </li>
        </ol>
    </div>
</div>
<!-- Main title end -->
<div class='row'>
    <!-- Table trend start-->
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Design Trend Management</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    @if(session()->has('message'))
                        <div class="col-md-12">
                            <div class="alert alert-success" style="margin: 5px 0px; padding: 5px 3px;" role="alert">
                                <i class="glyphicon glyphicon-ok-sign"></i> {{ session()->get('message') }}
                            </div>
                        </div>
                    @elseif(session()->has('error_message'))
                        <div class="col-md-12">
                            <div class="alert alert-danger" style="margin: 5px 0px; padding: 5px 3px;" role="alert">
                                <i class="glyphicon glyphicon-remove-sign"></i>
                                <b>{{ session()->get('error_message') }}</b>{{ session()->get('error_message2') }}
                            </div>
                        </div>
                    @endif
                        {!! Form::open(array('url'=> 'ais/designTrend')) !!}
                            <div class='col-md-12 bgParam'>
                                <div class="col-md-3" style="margin-top: 8px">
                                    Trend Group:
                                    <!--  btn -->
                                    <input type="hidden" id="design_trend_B_hidden" value="{{session()->get('design_trend_B')}}"/>
                                    <select id="design_trend_B" name="design_trend_B">
                                        <option value="-1">All Trend</option>
                                        <option value="{{Auth::user()->empId}}">My Trend</option>
                                        <option value="900002">Boiler Trend</option>
                                        <option value="900003">Turbine Trend</option>
                                        <option value="900004">Electrical Trend</option>
                                        <option value="900005">Loss Analyzing</option>
                                        <option value="900006">Start up and S/D</option>
                                    </select>

                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control"
                                           placeholder="ค้นหา" value="{{session()->get('design_trend_search')}}">
                                </div>
                                <div class="col-md-3" style="margin-top: 8px;width: 180px">

                                    Sort By:
                                    <!--  btn -->

                                    <input type="hidden" id="sortBy_hidden" value="{{session()->get('sortBy')}}"/>
                                    <select id="sortBy" name="sortBy">
                                        <option value=""></option>
                                        <option value="A">Trend Name</option>
                                    </select>

                                </div>
                                <div class="col-md-2" style="margin-top: 8px">
                                    Order By:
                                    <!--  btn -->

                                    <input type="hidden" id="orderBy_hidden" value="{{session()->get('orderBy')}}"/>
                                    <select id="orderBy" name="orderBy">
                                        <option value=""></option>
                                        <option value="ASC">ASC</option>
                                        <option value="DESC">DESC</option>
                                    </select>

                                </div>


                                <div class="col-md-1" style="margin-top: 8px"><button class="btn btn-sm btn-primary pull-left m-t-n-xs"><strong>Search</strong></button></div>

                            </div>
                        {!! Form::close() !!}


                    <div class='col-md-12'>
                        <a onclick="displayMmname('add','0')"  class="btn btn-primary  btn-sm">Add Trend</a>
                        <!-- data-target="#myModal2" data-toggle="modal" -->
                        <!-- <a class="btn btn-w-m btn-warning  btn-sm">Edit Trend</a> -->
                        <a onclick="displayMmnameDelete('deleteAll','0')" class="btn btn-w-m btn-danger  btn-sm">Delete Trend</a>

                    </div>
                </div>
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="editable" class="table table-striped table-bordered table-hover  dataTable"
                                   role="grid" aria-describedby="editable_info">
                                <thead>
                                <tr role="row">
                                    <th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1"
                                        style="width: 0%;" aria-sort="" aria-label=""> <input type='checkbox' id="checkAll">
                                    </th>
                                    <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1"
                                        style="width: 80%;" aria-label="Browser: activate to sort column ascending">
                                        Trend Name
                                    </th>
                                    <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1"
                                        style="width: 207%;" aria-label="Platform(s): activate to sort column ascending">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" id="mmtrend_zz"/>
                                    @foreach($mmtrendsM as $mmtrendM)
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1">
                                                <input type='checkbox' name="checkbox[]"
                                                       class="ck" data-id="checkbox"  value="{{$mmtrendM->ZZ}}">
                                        </td>
                                        <td>{{ $mmtrendM->A }}</td>
                                        <!--  URL::to('/addUser/destroy',$info_emp->ZZ)  -->
                                        <!--  url('/addUser/destroy',$info_emp->ZZ)  -->
                                        <td>
                                            <a onclick="showmmtrend('{{ $mmtrendM->ZZ }}')"
                                               class="btn btn-primary  btn-xs">แสดง Point</a> |
                                            <a id="btnEdit" onclick="displayMmname('edit','{{ $mmtrendM->ZZ }}')" class="btn btn-dropbox btn-xs"><i style="color: #47a447;" class="glyphicon glyphicon-edit"></i><span hidden id="id">{{$mmtrendM->ZZ}}</span></a>|
                                            <a onclick="displayMmnameDelete('delete','{{ $mmtrendM->ZZ }}')"  class="btn btn-dropbox btn-xs"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                    <div style="float: right;">
                                        {!!  $mmtrendsM->render() !!}
                                    </div>
                        </div>
                    </div>
<!-- Table trend end-->

                                    <!-- Table show point start-->
                                    <div id="trend_element" class="col-lg-12" style="display:none" >
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <h5 id="trend_element_header">
                                                    <!--
                                                    แสดง Point ของ Trend001
                                                    -->
                                                </h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <a onclick="displayMmtrend('add','0','0')"
                                                           class="btn btn-primary  btn-sm">Add Point</a>
                                                      <!--   <a class="btn btn-w-m btn-warning  btn-sm">Edit Point</a> -->
                                                        <a onclick="displayMmtrendDelete('deleteAll','0')"  class="btn btn-w-m btn-danger  btn-sm">Delete Point</a>
                                                    </div>
                                                    <!--
                                                    <div class="col-md-3 lableDropdownList">MMPlant</div>
                                                    <div class="col-md-3">
                                                        <select id="mmplant" class="form-control m-b">
                                                            <option>All Calculation</option>
                                                            <option>My Calcualtion</option>
                                                            <option>MM04-MM07</option>
                                                            <option>MM04</option>
                                                            <option>MM05</option>
                                                            <option>MM06</option>
                                                            <option>MM07</option>
                                                        </select>
                                                    </div>
                                                    -->
                                                </div>
                                                <div id="editable_wrapper"
                                                     class="dataTables_wrapper form-inline dt-bootstrap">
                                                    <div class="row">
                                                        <div id="trend_element_table" class="col-sm-12 table-responsive">
                                                            <table id="editable"
                                                                   class="table table-striped table-bordered table-hover  dataTable"
                                                                   role="grid" aria-describedby="editable_info">
                                                                <thead>
                                                                <tr role="row">
                                                                    <th class="" tabindex="0" aria-controls=""
                                                                        rowspan="1" colspan="1" style="width: 0%;"
                                                                        aria-sort="" aria-label="">  <input type='checkbox' id="checkAll_inner">
                                                                    </th>
                                                                    <th class="" tabindex="0" aria-controls="editable"
                                                                        rowspan="1" colspan="1" style="width: 10%;"
                                                                        aria-label="Browser: activate to sort column ascending">
                                                                        Point
                                                                    </th>
                                                                    <th class="" tabindex="0" aria-controls="editable"
                                                                        rowspan="1" colspan="1" style="width: 5%;"
                                                                        aria-label="Platform(s): activate to sort column ascending">
                                                                        MM
                                                                    </th>
                                                                    <th class="" tabindex="0" aria-controls="editable"
                                                                        rowspan="1" colspan="1" style="width: 35%;"
                                                                        aria-label="Platform(s): activate to sort column ascending">
                                                                        Point Name
                                                                    </th>
                                                                    <th class="" tabindex="0" aria-controls="editable"
                                                                        rowspan="1" colspan="1" style="width: 15%;"
                                                                        aria-label="Platform(s): activate to sort column ascending">
                                                                        Tag Name
                                                                    </th>
                                                                    <th class="" tabindex="0" aria-controls="editable"
                                                                        rowspan="1" colspan="1" style="width: 10%;"
                                                                        aria-label="Platform(s): activate to sort column ascending">
                                                                        Unit
                                                                    </th>
                                                                    <th class="" tabindex="0" aria-controls="editable"
                                                                        rowspan="1" colspan="1" style="width: 5%;"
                                                                        aria-label="Platform(s): activate to sort column ascending">
                                                                        Max
                                                                    </th>
                                                                    <th class="" tabindex="0" aria-controls="editable"
                                                                        rowspan="1" colspan="1" style="width: 5%;"
                                                                        aria-label="Platform(s): activate to sort column ascending">
                                                                        Min
                                                                    </th>
                                                                    <th class="" tabindex="0" aria-controls="editable" rowspan="1" colspan="1"
                                                                        style="width: 10%;" aria-label="Platform(s): activate to sort column ascending">
                                                                        Action
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <!--
                                                                <tr class="gradeA odd" role="row">
                                                                    <td class="sorting_1">
                                                                        <input type='checkbox' name="checkbox_inner[]"
                                                                               class="ck_inner" data-id="checkbox"  value="">
                                                                    </td>
                                                                    <td>Point001</td>
                                                                    <td>4</td>
                                                                    <td>43MSP Control Deviation</td>
                                                                    <td>40HF02U066</td>
                                                                    <td>N/A</td>
                                                                    <td>2</td>
                                                                    <td>0</td>
                                                                </tr>
                                                                -->
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div id="trend_paging" style="float: right;">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Table show point end-->
                        </div>
                        <!-- Modal Start -->
                        <div aria-hidden="true" role="dialog" tabindex="-1" id="myModal2" class="modal inmodal in"
                             style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content animated flipInY">
                                    <div class="modal-header">
                                        <button data-dismiss="modal" class="close" type="button"><span
                                                    aria-hidden="true">×</span><span class="sr-only">Close</span>
                                        </button>
                                        <h5 id="mmname_tilte_section" class="modal-title"></h5>
                                        <input type="hidden" id="mmname_mode"/>
                                        <input type="hidden" id="mmname_zz"/>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label padding5">ชื่อ Trend</label>

                                                <div class="col-lg-10 padding5">
                                                    <input type="text" id="mmname_a" name="mmname_a" class="form-control " placeholder="ชื่อ Trend">
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-lg-2 control-label padding5">Trend
                                                    Group</label>

                                                <div class="col-lg-10 padding5">
                                                    <span id="mmtrend_group_select_element"></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
                                        <button class="btn btn-primary" onclick="doActionMmname()" type="button"><span id="button_mode_section"/></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal End -->

                        <!-- Modal Add Point Start -->
                        <div aria-hidden="true" role="dialog" tabindex="-1" id="myModalAddPoint"
                             class="modal inmodal in" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content animated flipInY">
                                    <div class="modal-header">
                                        <button data-dismiss="modal" class="close" type="button"><span
                                                    aria-hidden="true">×</span><span class="sr-only">Close</span>
                                        </button>
                                        <h5 id="mmtrend_tilte_section" class="modal-title">
                                            <!--
                                            เพิ่ม Point ไปที่ Trend001
                                            -->
                                        </h5>

                                    </div>
                                    <div class="modal-body">
                                        <!-- Table show point start-->
                                        <div class="col-lg-12">
                                            <div class="ibox float-e-margins">
                                                <div class="ibox-content">
                                                    <div class="row">
                                                        <input type="hidden" id="mmtrend_mode" />
                                                        <input type="hidden" id="mmtrend_point_zz" />
                                                        <input type="hidden" id="mmtrend_point_h" />
                                                        <div class="col-md-3 lableDropdownList">MMPlant</div>
                                                        <div class="col-md-3">
                                                            <select id="mmtrend_table_B" class="form-control m-b" onclick="searchMmpoint(this.value)">

                                                                <option value="4">MM04</option>
                                                                <option value="5">MM05</option>
                                                                <option value="6">MM06</option>
                                                                <option value="7">MM07</option>

                                                                <option value="47">MM04-07</option>

                                                                <option value="0">My Calculation</option>

                                                                <option value="-1">All Calculation</option>
                                                                <!-- -->
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 ">
                                                            <input id="keyword" type="text" placeholder="ค้นหา"
                                                                   class="form-control ">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <bunton onclick="searchMmpoint('')" class='btn btn-primary  btn-sm' type="button">ค้นหา</bunton>
                                                        </div>
                                                    </div>
                                                    <div id="editable_wrapper"
                                                         class="dataTables_wrapper form-inline dt-bootstrap">
                                                        <div class="row">
                                                            <div id="point_list_section" class="col-sm-12 table-responsive">
                                                                <table id="editable"
                                                                       class="table table-striped table-bordered table-hover  dataTable"
                                                                       role="grid" aria-describedby="editable_info">
                                                                    <thead>
                                                                    <tr role="row">
                                                                        <th class="" tabindex="0" aria-controls=""
                                                                            rowspan="1" colspan="1" style="width: 0%;"
                                                                            aria-sort="" aria-label="">

                                                                        </th>
                                                                        <th class="" tabindex="0"
                                                                            aria-controls="editable" rowspan="1"
                                                                            colspan="1" style="width: 20%;"
                                                                            aria-label="Browser: activate to sort column ascending">
                                                                            Point Name
                                                                        </th>
                                                                        <th class="" tabindex="0"
                                                                            aria-controls="editable" rowspan="1"
                                                                            colspan="1" style="width: 13%;"
                                                                            aria-label="Platform(s): activate to sort column ascending">
                                                                            Tag4
                                                                        </th>
                                                                        <th class="" tabindex="0"
                                                                            aria-controls="editable" rowspan="1"
                                                                            colspan="1" style="width: 13%;"
                                                                            aria-label="Platform(s): activate to sort column ascending">
                                                                            Tag5
                                                                        </th>
                                                                        <th class="" tabindex="0"
                                                                            aria-controls="editable" rowspan="1"
                                                                            colspan="1" style="width: 13%;"
                                                                            aria-label="Platform(s): activate to sort column ascending">
                                                                            Tag6
                                                                        </th>
                                                                        <th class="" tabindex="0"
                                                                            aria-controls="editable" rowspan="1"
                                                                            colspan="1" style="width: 13%;"
                                                                            aria-label="Platform(s): activate to sort column ascending">
                                                                            Tag7
                                                                        </th>
                                                                        <th class="" tabindex="0"
                                                                            aria-controls="editable" rowspan="1"
                                                                            colspan="1" style="width: 5%;"
                                                                            aria-label="Platform(s): activate to sort column ascending">
                                                                            Unit
                                                                        </th>
                                                                        <th class="" tabindex="0"
                                                                            aria-controls="editable" rowspan="1"
                                                                            colspan="1" style="width: 5%;"
                                                                            aria-label="Platform(s): activate to sort column ascending">
                                                                            Max
                                                                        </th>
                                                                        <th class="" tabindex="0"
                                                                            aria-controls="editable" rowspan="1"
                                                                            colspan="1" style="width: 5%;"
                                                                            aria-label="Platform(s): activate to sort column ascending">
                                                                            Min
                                                                        </th>
                                                                        <th class="" tabindex="0"
                                                                            aria-controls="editable" rowspan="1"
                                                                            colspan="1" style="width: 5%;"
                                                                            aria-label="Platform(s): activate to sort column ascending">
                                                                            Data
                                                                        </th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr class="gradeA odd" role="row">
                                                                        <td class="sorting_1">
                                                                                <input type="radio" name="point_ids_input[]"
                                                                                       class="i-checks">
                                                                        </td>
                                                                        <td>Point001</td>
                                                                        <td>40HF02U066</td>
                                                                        <td>50HF02U066</td>
                                                                        <td>60HF02U066</td>
                                                                        <td>70HF02U066</td>
                                                                        <td>N/A</td>
                                                                        <td>2</td>
                                                                        <td>0</td>
                                                                        <td>435</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!--
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <div class="dataTables_info" id="editable_info"
                                                                     role="status" aria-live="polite">Showing 1 to 10 of
                                                                    57 entries
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-7">
                                                                <div class="dataTables_paginate paging_simple_numbers"
                                                                     id="editable_paginate">
                                                                    <ul class="pagination">
                                                                        <li class="paginate_button previous disabled"
                                                                            id="editable_previous">
                                                                            <a href="#" aria-controls="editable"
                                                                               data-dt-idx="0" tabindex="0">Previous</a>
                                                                        </li>
                                                                        <li class="paginate_button active">
                                                                            <a href="#" aria-controls="editable"
                                                                               data-dt-idx="1" tabindex="0">1</a>
                                                                        </li>
                                                                        <li class="paginate_button">
                                                                            <a href="#" aria-controls="editable"
                                                                               data-dt-idx="2" tabindex="0">2</a>
                                                                        </li>
                                                                        <li class="paginate_button">
                                                                            <a href="#" aria-controls="editable"
                                                                               data-dt-idx="3" tabindex="0">3</a>
                                                                        </li>
                                                                        <li class="paginate_button">
                                                                            <a href="#" aria-controls="editable"
                                                                               data-dt-idx="4" tabindex="0">4</a>
                                                                        </li>
                                                                        <li class="paginate_button">
                                                                            <a href="#" aria-controls="editable"
                                                                               data-dt-idx="5" tabindex="0">5</a>
                                                                        </li>
                                                                        <li class="paginate_button">
                                                                            <a href="#" aria-controls="editable"
                                                                               data-dt-idx="6" tabindex="0">6</a>
                                                                        </li>
                                                                        <li class="paginate_button next"
                                                                            id="editable_next">
                                                                            <a href="#" aria-controls="editable"
                                                                               data-dt-idx="7" tabindex="0">Next</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        -->
                                                    </div>
                                                    <div class='col-md-2'>
                                                        <input id="mmpoint_table_G0" type="text" placeholder="Max" class="form-control ">
                                                    </div>
                                                    <div class='col-md-2'>
                                                        <input id="mmpoint_table_G1" type="text" placeholder="Min" class="form-control ">
                                                    </div>
                                                    <div class='col-md-1 lableText'>
                                                        หน่วยวัด:
                                                    </div>
                                                    <div class='col-md-2 lableText'>
                                                        <input id="mmpoint_table_F" type="text" placeholder="" class="form-control ">
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Table show point end-->
                                    </div>
                                    <div class="modal-footer" style="padding: 10px 5px;">
                                        <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
                                        <button class="btn btn-primary" onclick="doActionMmtrend()" type="button"><span id="button_mmtrend_mode_section"/></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Add Point End -->

                <!-- Modal Delete  Start -->
                <div aria-hidden="true" role="dialog" tabindex="-1" id="myModalDelete" class="modal inmodal in"
                     style="display: none;">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content animated flipInY">
                            <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button"><span
                                            aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                                <h5 id="mmname_tilte_section" class="modal-title">ต้องการลบข้อมูล ?</h5>
                                <input type="hidden" id="mmtrend_group_b"/>
                                <input type="hidden" id="mmtrend_group_mode"/>
                            </div>
                            <!--
                            <div class="modal-body">

                            </div>
                            -->
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
                                <button class="btn btn-primary" onclick="doDeleteMmname()" type="button">ตกลง</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Delete  End -->

                <!-- Modal mmtrend Delete  Start -->
                <div aria-hidden="true" role="dialog" tabindex="-1" id="myModalMmtrendDelete" class="modal inmodal in"
                     style="display: none;">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content animated flipInY">
                            <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button"><span
                                            aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                                <h5 id="mmname_tilte_section" class="modal-title">ต้องการลบข้อมูล ?</h5>
                                <input type="hidden" id="mmtrend_table_zz"/>
                                <input type="hidden" id="mmtrend_table_mode"/>
                            </div>
                            <!--
                            <div class="modal-body">

                            </div>
                            -->
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-white" type="button">ยกเลิก</button>
                                <button class="btn btn-primary" onclick="doDeleteMmtrend()" type="button">ตกลง</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal mmtrend Delete  End -->
                        <!-- Content End-->
@stop
@section('footer')
    @include('layouts.footer')
@stop
@stop