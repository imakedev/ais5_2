@extends('layouts.main')

@section('page_title','Calculation')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
<script src='/Controller/cDesignCalculation.js'></script>
<link href="/css/designCalculation.css" rel="stylesheet">

<div class="ibox">
    <div class="ibox-title">
        <h5> Calculation</h5>
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
    <form action="/designCalculation/deleteSelect"  id="deleteSlectForm" name="deleteSlectForm" method="get" style="display: none">
        <input type='hidden' name="checkboxs_hidden">
    </form>
    {!! Form::open(array('url'=> 'ais/designCalculation')) !!}
    <div class="ibox-content">
            <div class="row bgParam">
	            <div class="col-md-3">
		            <a class="btn btn-primary  btn-sm" href='/ais/formCalculation/0'>Add </a>
                    <!--
		            <a class="btn btn-w-m btn-warning  btn-sm" href='formCalculation'>Edit </a>
		            -->
                    <!--
		            <a class="btn btn-w-m btn-danger  btn-sm">Delete </a>
		            -->
                    <button class="btn btn-w-m btn-danger btn-sm" type="button" onclick="return deleteBtn()">Delete select</button>
	            </div>
                <!--
	            -->
	             <div class='row'>
	               <div class='col-md-2' style="margin-left: -60px">
                       <input type="hidden" id="calculationSelectionHidden" value="{{session()->get('calculation_selection')}}"/>
                           <select class="form-control input-sm" style="width: 180px;" name="calculationSelection">
                                <option value="-1">All Calculation</option>
                                <option value="1">My Calculation</option>
                                <option value="2">Standard Calculation</option>

                            </select>

	               </div>

	               <div class='col-md-2' style="padding-left: 25px">
        	               <div class="input-group">
                                <input type="text" style="width: 150px;" id="calculationKeySearch" name="calculationKeySearch"
                                       class="input-sm form-control" placeholder="ค้นหาด่วน"
                                       value="{{session()->get('calculation_keySearch')}}"
                                >
                               <!--
                                <span class="input-group-btn">
                                <button class="btn btn-sm btn-primary" > Search</button>
                                </span>
                                -->
                            </div>
	               </div>
                     <div class="col-md-4" style="margin-top: 8px;width: 200px">

                         Sort By:
                         <!--  btn -->

                         <input type="hidden" id="sortBy_hidden" value="{{session()->get('sortBy')}}"/>
                         <select id="sortBy" name="sortBy">
                             <option value=""></option>
                             <option value="B">Description</option>
                             <option value="B">TagName</option>
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
                <!--
	            </div>
	            -->
            </div>
        <!-- grid list user -->
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table border="0" id="gridStatistics"  class="table table-striped table-bordered table-hover  dataTable">
                    <colgroup>
                        <!--
                        <col style="width:3%"/>
                        -->
                        <col style="width:3%"/>
                        <col style="width:10%"/>
                        <col style="width:38%"/>
                        <col style="width:13%" /> <!-- TagName -->
                        <col style="width:10%" />
                        <col style="width:10%" />
                        <col style="width:8%" />
                        <col style="width:8%" /> <!-- 30+30+40 -->
                    </colgroup>
                    <thead>
                    <tr>
                        <th data-field="field1">
                            <input type='checkbox' id="checkAll">
                        </th>
                        <!--
                        <th data-field="field2"><b>Data</b></th>
                        -->
                        <th data-field="field3"><b>MM</b></th>
                        <th data-field="field4"><b>Description</b></th>
                        <th data-field="field5"><b>TagName</b></th>
                        <th data-field="field6"><b>Unit</b></th>
                        <th data-field="field7"><b>Max</b></th>
                        <th data-field="field8"><b>Min</b></th>
                        <th data-field="field9"><b>Action</b></th>
                    </tr>
                    </thead>
                    @foreach($lists as $list)
                        <tbody>
                        <tr>
                            <td>
                                <div class='listCheckbox'>
                                    <input type='checkbox' name="checkbox[]" class="ck" data-id="checkbox" value="{{$list->A}}">
                                </div>
                            </td>
                            <!--
                            <td>435</td>
                            -->
                            <td>{{ $list->B }}</td>
                            <td>{{ $list->C }}</td>
                            <td>{{ $list->D }}</td>
                            <td>{{ $list->E }}</td>
                            <td>{{ $list->F0 }}</td>
                            <td>{{ $list->F1 }}</td>
                            <td>
                                <!--
                            <a id="btnEdit" onclick="displayMmname('edit','{{ $list->A }}')" class="btn btn-dropbox btn-xs"><i style="color: #47a447;" class="glyphicon glyphicon-edit"></i><span hidden id="id">{{$list->A}}</span></a>|
                            -->
                                <a id="btnEdit" href="{{ URL::to('/ais/formCalculation',$list->A) }}" class="btn btn-dropbox btn-xs"><i style="color: #47a447;" class="glyphicon glyphicon-edit"></i><span hidden id="id">{{$list->A}}</span></a>|
                                <ammname_z  onclick='return doDelete("{{ URL::to('/designCalculation/destroy',$list->A) }}")' class="btn btn-dropbox btn-xs"><i class="glyphicon glyphicon-trash text-danger"></i></ammname_z>
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


@stop
@section('footer')
 @include('layouts.footer')
@stop
@stop