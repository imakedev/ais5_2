@extends('layouts.main')

@section('page_title','ทั่วไป')

@include('layouts.navigation')

@section('body')
@include('layouts.header')
@section('content')
        <!-- Content Start-->
<script src='/Controller/cTagConfig.js' xmlns="http://www.w3.org/1999/html"></script>
<link href="/css/tagConfig.css" rel="stylesheet">

<div class="ibox">
    <div class="ibox-title">
        <h5>Tag Configuration</h5>
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
        {!! Form::open(array('url'=> 'ais/tagConfiguration')) !!}
        <div class="row bgParam">
            <div class="col-md-3">
                <a class="btn btn-primary btn-sm" data-toggle="modal" onclick="addBtn()">Add Tag</a>
                <button class="btn btn-w-m btn-danger btn-sm" type="button" onclick="deleteBtn()">Delete select</button>
            </div>
            <div class="col-md-4"  style="width:250px">
                <input type="text" name="search" class="form-control" placeholder="ค้นหา" value="{{session()->get('tagConf_search')}}">
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
        <form action="/tagConfiguration/deleteSelect" method="get" id="formDelete">
            <!-- grid list user -->
            <div class="col-md-12 table-responsive">
                <table id="gridUserList" class="table table-hover">
                    <colgroup>
                        <col style="width:3%"/>
                        <col  style="width:4%"/>
                        <col/>
                        <col/>
                        <col/>
                        <col/>
                        <col/>
                        <col/>
                        <col/>
                        <col/>
                        <col/>
                    </colgroup>
                    <thead>
                    <tr>
                        <th data-field="field0">
                            <input type='checkbox' id="checkAll">
                        </th>
                        <th class="center" data-field="field1"><b>Item</b></th>
                        <th class="center" data-field="field2"><b>Point&nbsp;Description</b></th>
                        <th class="center" data-field="field3"><b>Tag4</b></th>
                        <th class="center" data-field="field4"><b>Tag5</b></th>
                        <th class="center" data-field="field5"><b>Tag6</b></th>
                        <th class="center" data-field="field6"><b>Tag7</b></th>

                        <th class="center" data-field="field7"><b>Type</b></th>

                        <th class="center" data-field="field8"><b>L</b></th>
                        <th class="center" data-field="field9"><b>P</b></th>
                        <th class="center" data-field="field10"><b>M</b></th>
                        <th class="center" data-field="field11"><b>B</b></th>

                        <th class="center" data-field="field12"><b>L</b></th>
                        <th class="center" data-field="field13"><b>P</b></th>
                        <th class="center" data-field="field14"><b>M</b></th>
                        <th class="center" data-field="field15"><b>B</b></th>

                        <th class="center" data-field="field16"><b>L</b></th>
                        <th class="center" data-field="field17"><b>P</b></th>
                        <th class="center" data-field="field18"><b>M</b></th>
                        <th class="center" data-field="field19"><b>B</b></th>

                        <th class="center" data-field="field20"><b>L</b></th>
                        <th class="center" data-field="field21"><b>P</b></th>
                        <th class="center" data-field="field22"><b>M</b></th>
                        <th class="center" data-field="field23"><b>B</b></th>
                        <th class="center" data-field="field24" width="70px"><b></b></th>
                    </tr>
                    </thead>
                    <tbody id="gridTagListbody">
                    @foreach($tags_config as $index => $tag_config)
                        <tr>
                            <td class="settext">
                                <div class='listCheckbox'><input type='checkbox' name="checkbox[]" class="ck" data-id="checkbox" value="{{$tag_config->A}}"></div>
                                <input type="hidden" value="{{$tag_config->A}}">
                            </td>
                            <td>{{$tag_config->A}}</td>
                            <td class="">{{$tag_config->B}}</td>
                            <td class="settext">{{$tag_config->C4}}</td>
                            <td class="settext">{{$tag_config->C5}}</td>
                            <td class="settext">{{$tag_config->C6}}</td>
                            <td class="settext">{{$tag_config->C7}}</td>
                            <td class="settext">{{$tag_config->D}}</td>

                            <td class="settext">{{$tag_config->E4}}</td>
                            <td class="settext">{{$tag_config->F4}}</td>
                            <td class="settext">{{$tag_config->G4}}</td>
                            <td class="settext">{{$tag_config->H4}}</td>

                            <td class="settext">{{$tag_config->E5}}</td>
                            <td class="settext">{{$tag_config->F5}}</td>
                            <td class="settext">{{$tag_config->G5}}</td>
                            <td class="settext">{{$tag_config->H5}}</td>

                            <td class="settext">{{$tag_config->E6}}</td>
                            <td class="settext">{{$tag_config->F6}}</td>
                            <td class="settext">{{$tag_config->G6}}</td>
                            <td class="settext">{{$tag_config->H6}}</td>

                            <td class="settext">{{$tag_config->E7}}</td>
                            <td class="settext">{{$tag_config->F7}}</td>
                            <td class="settext">{{$tag_config->G7}}</td>
                            <td class="settext">{{$tag_config->H7}}</td>

                            <td class="center">
                                <a id="btnTagconfig" class="btn btn-dropbox btn-xs" onclick="return editBtn({{$index}})"><i style="color: #47a447;" class="glyphicon glyphicon-edit"></i></a>|
                                <a href="{{ URL::to('tagConfiguration/delete',$tag_config->A) }}" onclick="return confirm_del()" class="btn btn-dropbox btn-xs"><i class="glyphicon glyphicon-trash text-danger"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div style="float: right;">
                {!! $tags_config->render() !!}
            </div>
            <br style='clear:both'>
        </form>
    </div>
</div>
@include('modal.tagConfigModal')
        <!-- Content End-->
@stop
@section('footer')
    @include('layouts.footer')
@stop
@stop