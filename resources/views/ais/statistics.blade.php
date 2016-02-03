@extends('layouts.main')

@section('page_title','ทั่วไป')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
        <!-- Content Start-->
        <script src='/Controller/cStatistics.js'></script>
        <!-- Data picker -->
        <script src='/js/plugins/datapicker/bootstrap-datepicker.js'></script>

        <link href="/css/statistics.css" rel="stylesheet">
        <link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

        <div class="ibox">
            <div class="ibox-title">
                <h5>ดูข้อมูลการใช้งาน</h5>
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
        {!! Form::open(array('url'=> 'ais/statistics')) !!}
            <div class="ibox-content">
                <div class='row '>
                    <div class='col-md-12 bgParam'>
                        <div class='labelParam'>วันที่</div>
                        <div class='inputParam' style="width: 150px">
                            <!-- input date -->
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar">

                                    </i></span><input name="fromDate"
                                                      type="text" readonly="readonly"
                                                      value="{{session()->get('static_fromDate')}}"
                                                      style="width: 100px"
                                                      class="form-control">
                            </div>
                            <!--
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="03/04/2014" class="form-control">
                            </div>
                            -->
                            <!-- input date -->
                        </div>
                        <div class='labelParam'>ถึงวันที่</div>
                        <div class='inputParam' style="width: 150px">
                            <!-- input date -->
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar">

                                    </i></span><input name="toDate"
                                                      type="text" readonly="readonly"
                                                      value="{{session()->get('static_toDate')}}"
                                                      style="width: 100px"
                                                      class="form-control">
                            </div>
                            <!-- input date -->
                        </div>
                        <!-- text search -->
                        <div class='inputParamSearch' style="width: 170px;">
                            <input type="text" name="search" class="form-control" placeholder="ค้นหา ชื่อ หรือ นามสกุล" value="{{session()->get('static_search')}}">
                        </div>
                        <!-- text search -->

                        <div class='labelParam' style="width: 80px">Sort By: </div>
                        <!--  btn -->
                        <div class='inputParam' style="width: 70px;margin-top:8px">
                            <input type="hidden" id="sortBy_hidden" value="{{session()->get('sortBy')}}"/>
                           <select id="sortBy" name="sortBy">
                               <option value=""></option>
                               <option value="first_name">ชื่อ</option>
                               <option value="last_name">นามสกุล</option>
                           </select>
                        </div>
                        <div class='labelParam' style="width: 80px">Order By: </div>
                        <!--  btn -->
                        <div class='inputParam' style="width: 80px;margin-top:8px">
                            <input type="hidden" id="orderBy_hidden" value="{{session()->get('orderBy')}}"/>
                            <select id="orderBy" name="orderBy">
                                <option value=""></option>
                                <option value="ASC">ASC</option>
                                <option value="DESC">DESC</option>
                            </select>
                        </div>
                        <!-- search btn -->
                        <div class='btnSearch'>
                            <button class="btn btn-sm btn-primary pull-left m-t-n-xs"><strong>Search</strong></button>
                        </div>
                        <!--
                        <div>
                            <button type="button" onclick="mulipleDB()">Call Multiple DB</button>
                        </div>
                        -->
                        <!-- search btn -->
                    </div>
                </div>
                <!-- grid list user -->
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="gridStatistics"  class="table table-striped table-bordered table-hover  dataTable">
                            <colgroup>
                                <col style="width:10%"/>
                                <col style="width:30%"/>
                                <col style="width:10%" />
                                <col style="width:10%" />
                                <col style="width:10%" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th data-field="field1"><b>วันที่</b></th>
                                    <th data-field="field2"><b>ชื่อ</b></th>
                                    <th data-field="field2"><b>นามสกุล</b></th>
                                    <th data-field="field3"><b>เวลาเข้าใช้งาน</b></th>
                                    <th data-field="field4"><b>เวลาออกจากระบบ</b></th>
                                </tr>
                            </thead>
                                @foreach($lists as $list)
                                    <tbody>
                                        <tr>
                                            <td>{{ $list->date_created }}</td>
                                            <!-- {{ $list->title_name }} -->
                                                    <td>{{ $list->first_name }}</td>
                                            <td>{{ $list->last_name }}</td>
                                            <td>{{ $list->login_time }} น.</td>

                                            <td>
                                                @if (!empty($list->logout_time))
                                                {{ $list->logout_time }} น.
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                        </table>
                    </div>
                </div>

                <div style="float: right;">
                    {!!  $lists->render() !!}

                </div>
                <br style='clear:both'>
                <!-- grid list user -->
            </div>
            {!! Form::close() !!}
        </div>
        <!-- Content End-->

    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop

