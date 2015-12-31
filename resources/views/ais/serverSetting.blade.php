@extends('layouts.main')

@section('page_title','ทั่วไป')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
        <!-- Content Start-->
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Server Setting</h5>
            </div>
            <div class="ibox-content">
                {!! Form::open(array('user'=>'ais/serverSetting/store','class'=>'form-horizontal')) !!}
                <div class='row'>
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
                        <div class='col-md-6'>
                            <!-- Database Server -->
                            <p>Database Server</p>
                            <div class="form-group"><label class="col-lg-2 control-label">MM4-7</label>
                                <div class="col-lg-10">
                                    <input type="hidden" class="form-control" name="id" placeholder="IP SERVER" value="{{$ip->server_setting_id}}">
                                    <input type="text" class="form-control" name="dmm4-7" placeholder="IP SERVER" value="{{$ip->mm_4_17_db_server}}">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">MM8-13</label>
                                <div class="col-lg-10"><input type="text" class="form-control" name="dmm8-13" placeholder="IP SERVER" value="{{$ip->mm_8_13_db_server}}"></div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">FGD8-13</label>
                                <div class="col-lg-10"><input type="text" class="form-control" name="dfgd8-13" placeholder="IP SERVER" value="{{$ip->fgd_8_13_db_server}}"></div>
                            </div>
                            <!-- Database Server -->
                        </div>
                        <div class='col-md-6'>
                            <!-- Logs Server -->
                            <p>Logs Server</p>
                            <div class="form-group"><label class="col-lg-2 control-label">MM4-7</label>
                                <div class="col-lg-10"><input type="text" class="form-control" name="lmm4-7" placeholder="IP SERVER" value="{{$ip->mm_4_7_logs_server}}">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">MM8-13</label>
                                <div class="col-lg-10"><input type="text" class="form-control" name="lmm8-13" placeholder="IP SERVER" value="{{$ip->mm_8_13_logs_server}}"></div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">FGD8-13</label>
                                <div class="col-lg-10"><input type="text" class="form-control" name="lfgd8-13" placeholder="IP SERVER" value="{{$ip->fgd_8_13_logs_server}}"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-sm btn-white">Save</button>
                                    <button type="reset" class="btn btn-sm btn-white">Cancel</button>
                                </div>
                            </div>
                            <!-- Logs Server -->
                        </div>
                    </div>
                    <br style='clear:both'>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- Content End-->
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop