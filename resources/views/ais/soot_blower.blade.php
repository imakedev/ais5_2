@extends('layouts.main')

@section('page_title','Process View')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
@section('content')
    <script src='/Controller/cSoot.js'></script>
    <!-- Data picker -->
    <script src='/js/plugins/datapicker/bootstrap-datepicker.js'></script>

    <link href="/css/soot.css" rel="stylesheet">
    <link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Soot/Blow</h5>
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
            {!! Form::open(array('url'=> 'ais/sootBlower')) !!}
            <div class='row'>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product_name" class="control-label">Blow/Soot</label>
                        <input type="hidden" id="sootViewHidden" value="{{Input::get("sootView")}}"/>
                        <select name="sootView" style="width: 140px" class="form-control input-sm">
                            <option value="1">เวลาที่ Blow</option>
                            <option value="2">จำนวนครั้งที่ Blow</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product_name" class="control-label">Unit</label>
                        <input type="hidden" id="sootUnitHidden" value="{{Input::get("sootUnit")}}"/>
                        <select name="sootUnit" class="form-control input-sm">
                            @if(Session::get('user_mmplant')=='1')
                            <option value="4">Unit 4</option>
                            <option value="5">Unit 5</option>
                            <option value="6">Unit 6</option>
                            <option value="7">Unit 7</option>
                            @endif
                             @if(Session::get('user_mmplant')=='2')
                                    <option value="8">Unit 8</option>
                                    <option value="9">Unit 9</option>
                                    <option value="10">Unit 10</option>
                                    <option value="11">Unit 11</option>
                                    <option value="12">Unit 12</option>
                                    <option value="13">Unit 13</option>
                             @endif
                              @if(Session::get('user_mmplant')=='3')
                                    <option value="8">Unit 8</option>
                                    <option value="9">Unit 9</option>
                                    <option value="10">Unit 10</option>
                                    <option value="11">Unit 11</option>
                                    <option value="12">Unit 12</option>
                                    <option value="13">Unit 13</option>
                              @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group" id="sootData">
                        <label for="product_name" class="control-label">Date</label>

                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="sootDate"
                                                                                                        type="text"
                                                                                                        readonly="readonly"
                                                                                                        value="{{$sootDate}}"
                                                                                                        style="width: 100px"
                                                                                                        class="form-control">
                        </div>

                    </div>
                </div>
                <!--
                <div class="form-group" id="data_1">
                    <label class="font-noraml">Simple data input format</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                    </div>
                </div>
                -->
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary  btn-sm btnSubmit"><strong>Ok</strong></button>
                    <!--  <a href="#" class="btn btn-primary  btn-sm btnSubmit">OK </a>
                    -->

                </div>

            </div>
            <div class='row'>
                <div class='col-xs-4'>

                    <!-- BOX1 START -->
                    <div class='row'>
                        <div class='col-xs-12'>
                            <label> กะดึก 00:00 - 07:59 น.</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-xs-12 '>

                            <!-- list soot start -->

                            <table id="gridSootList">
                                @if($sootView=='1')
                                    <colgroup>

                                        <col style="width:15%"/>
                                        <col style="width:35%"/>
                                        <col style="width:50%"/>

                                    </colgroup>
                                    <thead>
                                    <tr>

                                        <th data-field="field1"><b></b></th>
                                        <th data-field="field2"><b></b></th>
                                        <th data-field="field3"><b></b></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_phase_list[0] as $data_phase)
                                        <tr>
                                            <td>
                                                    <span class="myTooltip" onclick="show(this)"
                                                          title="{{ $data_phase->time }} , {{ $data_phase->amount }} , {{ $data_phase->data }}">
                                                        {{ $data_phase->time }}
                                                    </span>
                                            </td>
                                            <td>
                                                <span class="myTooltip" onclick="show(this)"
                                                      title="{{ $data_phase->time }} , {{ $data_phase->amount }} , {{ $data_phase->data }}">
                                                        {{ $data_phase->amount }}
                                                </span>

                                            </td>
                                            <td>
                                                <span class="myTooltip" onclick="show(this)"
                                                      title="{{ $data_phase->time }} , {{ $data_phase->amount }} , {{ $data_phase->data }}">
                                                        {{ $data_phase->data }}
                                                </span>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                                @if($sootView=='2')
                                    <colgroup>

                                        <col style="width:50%"/>
                                        <col style="width:50%"/>

                                    </colgroup>
                                    <thead>
                                    <tr>

                                        <th data-field="field1"><b></b></th>
                                        <th data-field="field2"><b></b></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_blow_list[0] as $data_blow=>$id)
                                        <tr>
                                            <td>Blow Soot = {{ $data_blow}}</td>
                                            <td>รวม = {{ $id }} ครั้ง</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                            <br style='clear:both'>

                            <!-- list soot end -->
                        </div>
                    </div>

                    <!-- BOX1 END -->


                </div>
                <div class='col-xs-4'>

                    <!-- BOX2 START -->
                    <div class='row'>
                        <div class='col-xs-12'>
                            <label> กะเช้า 08:00 - 15:59 น.</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-xs-12 '>

                            <!-- list soot start -->

                            <table id="gridSootList2">
                                @if($sootView=='1')
                                    <colgroup>

                                        <col style="width:15%"/>
                                        <col style="width:35%"/>
                                        <col style="width:50%"/>

                                    </colgroup>
                                    <thead>
                                    <tr>

                                        <th data-field="field1"><b></b></th>
                                        <th data-field="field2"><b></b></th>
                                        <th data-field="field3"><b></b></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_phase_list[1] as $data_phase)
                                        <tr>
                                            <td>
                                                <span class="myTooltip" onclick="show(this)"
                                                      title="{{ $data_phase->time }} , {{ $data_phase->amount }} , {{ $data_phase->data }}">
                                                        {{ $data_phase->time }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="myTooltip" onclick="show(this)"
                                                      title="{{ $data_phase->time }} , {{ $data_phase->amount }} , {{ $data_phase->data }}">
                                                        {{ $data_phase->amount }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="myTooltip" onclick="show(this)"
                                                      title="{{ $data_phase->time }} , {{ $data_phase->amount }} , {{ $data_phase->data }}">
                                                        {{ $data_phase->data }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                                @if($sootView=='2')
                                    <colgroup>

                                        <col style="width:50%"/>
                                        <col style="width:50%"/>

                                    </colgroup>
                                    <thead>
                                    <tr>

                                        <th data-field="field1"><b></b></th>
                                        <th data-field="field2"><b></b></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_blow_list[1] as $data_blow=>$id)
                                        <tr>
                                            <td>Blow Soot = {{ $data_blow}}</td>
                                            <td>รวม = {{ $id }} ครั้ง</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                            <br style='clear:both'>

                            <!-- list soot end -->
                        </div>
                    </div>

                    <!-- BOX1 END -->
                </div>

                <div class='col-xs-4'>

                    <!-- BOX1 START -->
                    <div class='row'>
                        <div class='col-xs-12'>
                            <label> กะบ่าย 16:00 - 23:59 น.</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-xs-12 '>

                            <!-- list soot start -->

                            <table id="gridSootList3">
                                @if($sootView=='1')
                                    <colgroup>

                                        <col style="width:15%"/>
                                        <col style="width:35%"/>
                                        <col style="width:50%"/>

                                    </colgroup>
                                    <thead>
                                    <tr>

                                        <th data-field="field1"><b></b></th>
                                        <th data-field="field2"><b></b></th>
                                        <th data-field="field3"><b></b></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_phase_list[2] as $data_phase)
                                        <tr>
                                            <td>
                                                <span class="myTooltip" onclick="show(this)"
                                                      title="{{ $data_phase->time }} , {{ $data_phase->amount }} , {{ $data_phase->data }}">
                                                        {{ $data_phase->time }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="myTooltip" onclick="show(this)"
                                                      title="{{ $data_phase->time }} , {{ $data_phase->amount }} , {{ $data_phase->data }}">
                                                         {{ $data_phase->amount }}
                                                </span>
                                               </td>
                                            <td>
                                                <span class="myTooltip" onclick="show(this)"
                                                      title="{{ $data_phase->time }} , {{ $data_phase->amount }} , {{ $data_phase->data }}">
                                                        {{ $data_phase->data }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                                @if($sootView=='2')
                                    <colgroup>

                                        <col style="width:50%"/>
                                        <col style="width:50%"/>

                                    </colgroup>
                                    <thead>
                                    <tr>

                                        <th data-field="field1"><b></b></th>
                                        <th data-field="field2"><b></b></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_blow_list[2] as $data_blow=>$id)
                                        <tr>
                                            <td>Blow Soot = {{ $data_blow}}</td>
                                            <td>รวม = {{ $id }} ครั้ง</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                            <br style='clear:both'>

                            <!-- list soot end -->
                        </div>
                    </div>

                    <!-- BOX1 END -->
                </div>


            </div>
            {!! Form::close() !!}
        </div>

    </div>

    <div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Soot Infomation</h4>
                </div>
                <div class="modal-body">
                    <p><strong id="soot_info"></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <!--
                    <button type="button" class="btn btn-primary">Save changes</button>
                    -->
                </div>
            </div>
        </div>
    </div>

@stop
@section('footer')
    @include('layouts.footer')
@stop
@stop