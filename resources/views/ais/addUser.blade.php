@extends('layouts.main')

@section('page_title','ทั่วไป')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
        <!-- Content Start-->
        <script src='/Controller/cAddUser.js'></script>
        <link href="/css/addUser.css" rel="stylesheet">

        <div class="ibox">
            <div class="ibox-title">
                <h5>เพิ่มรายชื่อผู้ใช้งาน</h5>
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

                {!! Form::open(array('url'=> 'ais/addUser')) !!}
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
                                <b>{{ session()->get('error_message') }}</b>{{ session()->get('error_message') }}
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3 bgParam">
                        <div class='labelParam'>
                            <a class="btn btn-primary  btn-sm" data-toggle="modal" onclick="addBtn()">Add User</a>
                            <button class="btn btn-w-m btn-danger btn-sm" type="button" onclick="deleteBtn()">Delete select</button>
                        </div>
                    </div>
                    <div class="col-md-4"   style="width:270px">
                        <input type="text" name="search"
                               class="form-control" placeholder="ค้นหา เลขประจำตัว หรือ ชื่อ-นามสกุล"
                               value="{{session()->get('addUser_search')}}">
                    </div>
                    <div class="col-md-4" style="margin-top: 8px;width: 200px">

                        Sort By:
                        <!--  btn -->

                        <input type="hidden" id="sortBy_hidden" value="{{session()->get('sortBy')}}"/>
                        <select id="sortBy" name="sortBy">
                            <option value=""></option>
                            <option value="A">เลขประจำตัว</option>
                            <option value="C">ชื่อ-นามสกุล</option>
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
                <form action="/addUser/deleteSelect" method="get" id="formDelete">
                <!-- grid list user -->
                <div class="col-md-12 table-responsive">
                    <table id="gridUserList" class="table table-hover">
                        <colgroup>
                            <col style="width:3%"/>
                            <col style="width:10%"/>
                            <col style="width:8%" />
                            <col style="width:50%" />
                            <col style="width:8%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th data-field="field1">
                                <input type='checkbox' id="checkAll">
                            </th>
                            <th data-field="field2"><b>เลขประจำตัว</b></th>
                            <th data-field="field3"><b>คำนำหน้า</b></th>
                            <th data-field="field4"><b>ชื่อ-นามสกุล</b></th>
                            <th data-field="field5"><b>Priority</b></th>
                            <th data-field="field6" class="center"><b>Action</b></th>
                        </tr>
                        </thead>
                        <tbody id="gridUserListBody">
                            @foreach($info_employee as $index => $info_emp)
                                <tr>
                                    <td>
                                        <div class='listCheckbox'>
                                            <input type='checkbox' name="checkbox[]" class="ck" data-id="checkbox" value="{{$info_emp->ZZ}}"></div>
                                        <input type="hidden" value="{{$info_emp->ZZ}}">
                                    </td>
                                    <td>{{$info_emp->A}}</td>
                                    <td>{{$info_emp->B}}</td>
                                    <td>{{$info_emp->C}}</td>
                                    <td>{{$info_emp->D0}}</td>
                                    <td class="center">
                                        <a id="btnEdit" onclick="return editBtn({{$index}})" class="btn btn-dropbox btn-xs"><i style="color: #47a447;" class="glyphicon glyphicon-edit"></i><span hidden id="id">{{$info_emp->A}}</span></a>|
                                        <ammname_z  onclick='return doDelete("{{ URL::to('/addUser/destroy',$info_emp->ZZ) }}")' class="btn btn-dropbox btn-xs"><i class="glyphicon glyphicon-trash text-danger"></i></ammname_z>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </form>
                <div style="float: right;">
                    <?php
                    echo $info_employee->render();
                    ?>
                </div>
                <br style='clear:both'>
                <!-- grid list user -->
            </div>
        </div>
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
        @include('modal.addUserModal')
        <!-- Content End-->
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop