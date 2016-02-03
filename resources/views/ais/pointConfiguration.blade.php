@extends('layouts.main')

@section('page_title','ทั่วไป')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
        <!-- Content Start-->
        <script src='/Controller/cPointConfig.js'></script>
        <link href="/css/pointConfig.css" rel="stylesheet">

        <div class="ibox">
            <div class="ibox-title">
                <h5>Point Configuration</h5>
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
            <div class="ibox-content">
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
                            <b>{{ session()->get('error_message') }}</b>{{ session()->get('error_message') }}
                        </div>
                    </div>
                @endif
                {!! Form::open(array('url'=> 'ais/pointConfiguration')) !!}

                <div class="row bgParam">
                    <div class="col-md-3">
                      <!--
                         <a class="btn btn-primary btn-sm" onclick="addBtn()">Add Point</a>
                      -->
                        <button class="btn btn-w-m btn-danger btn-sm" type="button" onclick="deleteBtn()">Delete select</button>

                    </div>
                    <div class="col-md-4" style="width:250px">
                        <input type="text" name="search" class="form-control" placeholder="ค้นหา" value="{{session()->get('pointConf_search')}}">
                    </div>
                    <div class="col-md-4" style="margin-top: 8px;width: 200px">

                        Sort By:
                        <!--  btn -->

                        <input type="hidden" id="sortBy_hidden" value="{{session()->get('sortBy')}}"/>
                        <select id="sortBy" name="sortBy">
                            <option value=""></option>
                            <option value="B">Point Description</option>
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
                <form action="/pointConfiguration/deleteSelect" method="get" id="formDelete">
                <!-- grid list user -->
                <div class="col-md-12 table-responsive">
                    <table id="gridPointConfigList" class="table table-hover">
                        <thead>
                            <tr>
                                <th data-field="field0">
                                    <input type='checkbox' id="checkAll">
                                </th>
                                <th data-field="field1"><b>Point Index</b></th>
                                <th class="center" data-field="field2"><b>Point&nbsp;Desc</b></th>
                                <th class="center" data-field="field3"><b>Tag4</b></th>
                                <th class="center" data-field="field4"><b>Tag5</b></th>
                                <th class="center" data-field="field5"><b>Tag6</b></th>
                                <th class="center" data-field="field6"><b>Tag7</b></th>
                                <th class="center" data-field="field7"><b>Tag&nbsp;Atom</b></th>
                                <th class="center" data-field="field8"><b>Average</b></th>
                                <th class="center" data-field="field9"><b>Unit</b></th>
                                <th class="center" data-field="field10"><b>Max</b></th>
                                <th class="center" data-field="field11"><b>Min</b></th>
                                <th class="center" data-field="field12"><b>Tag Index</b></th>
                                <th class="center" data-field="field13" width="100px"><b></b></th>
                            </tr>
                        </thead>
                        <tbody id="gridPointListbody">
                            @foreach($points_config as $index => $poi_config)
                                <tr>
                                    <td>
                                        <div class='listCheckbox'><input type='checkbox' name="checkbox[]" class="ck" data-id="checkbox" value="{{$poi_config->A}}"></div>
                                    </td>
                                    <td>{{$poi_config->A}}</td>
                                    <td>{{$poi_config->B}}</td>
                                    <td class="settext">{{$poi_config->C4}}</td>
                                    <td class="settext">{{$poi_config->C5}}</td>
                                    <td class="settext">{{$poi_config->C6}}</td>
                                    <td class="settext">{{$poi_config->C7}}</td>
                                    <td class="settext">{{$poi_config->D}}</td>
                                    <td class="settext">{{$poi_config->E}}</td>
                                    <td class="settext">{{$poi_config->F}}</td>
                                    <td class="settext">{{$poi_config->G0}}</td>
                                    <td class="settext">{{$poi_config->G1}}</td>
                                    <td class="settext">{{$poi_config->H}}</td>

                                    <td class="settext">
                                        <!--
                                        <a id="pointConfig" class="btn btn-dropbox btn-xs" onclick="return editBtn({{$index}})"><i style="color: #47a447;" class="glyphicon glyphicon-cog"></i></a>|
                                        -->
                                        <a id="pointConfig" class="btn btn-dropbox btn-xs" onclick="return editBtn({{$index}})"><i style="color: #47a447;" class="glyphicon glyphicon-edit"></i></a>|
                                        <a href="{{ URL::to('/pointConfiguration/delete',$poi_config->A) }}" onclick="return confirm_del()" class="btn btn-dropbox btn-xs"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="float: right;">
                    <?php
                        echo $points_config->render();
                    ?>
                </div>
                <br style='clear:both'>
                <!-- grid list user -->
                </form>
            </div>
        </div>
        <!-- Content End-->
        @include('modal.pointConfigModal')
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop