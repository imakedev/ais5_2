@extends('layouts.main')

@section('page_title','Process View')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
    <script src='/Controller/cTrendColor.js'></script>
<link href="/css/trendColor.css" rel="stylesheet">

<script src='/js/spectrum.js'></script>
<link rel='stylesheet' href='/css/spectrum.css' />



<div class="ibox">
    <div class="ibox-title">
        <h5>Defind Color Point</h5>
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
           
     <!-- content start -->
        {!! Form::open(array('user'=>'ais/trendColor/store','class'=>'form-horizontal')) !!}
        <div class='row alert alert-warning'>
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
            <div class='col-xs-2'>
            
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball redBall'>
                        <input type="hidden" id="userid" name="userid" value="{{$userid}}"/>
                        <input type='text' id="color_point_A" name="color_point_A"  type='color'  value='{{$mmtrend_color->A}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                        Point 1
                    </div>
                </div>
                 <!-- set color end  -->
                 
            </div>
            <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                    <input type='text'  id="color_point_B" name="color_point_B"  type='color'  value='{{$mmtrend_color->B}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                        Point 2
                    </div>
                </div>
                <!-- set color end  -->
            </div>
            <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                    <input type='text'  id="color_point_C" name="color_point_C"  type='color'  value='{{$mmtrend_color->C}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 3
                    </div>
                </div>
                <!-- set color end  -->
            </div>
            <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                     <input type='text'  id="color_point_D" name="color_point_D"  type='color'  value='{{$mmtrend_color->D}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 4
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
               <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text'  id="color_point_E" name="color_point_E"  type='color'  value='{{$mmtrend_color->E}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 5
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text'  id="color_point_F" name="color_point_F"  type='color'  value='{{$mmtrend_color->F}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 6
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text'  id="color_point_G" name="color_point_G"  type='color'  value='{{$mmtrend_color->G}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 7
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text'  id="color_point_H" name="color_point_H"  type='color'  value='{{$mmtrend_color->H}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 8
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball '>
                     <input type='text'  id="color_point_I" name="color_point_I"  type='color'  value='{{$mmtrend_color->I}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 9
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                     <input type='text'  id="color_point_J" name="color_point_J"  type='color'  value='{{$mmtrend_color->J}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 10
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                     <input type='text'  id="color_point_K" name="color_point_K"  type='color'  value='{{$mmtrend_color->K}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 11
                    </div>
                </div>
                <!-- set color end  -->
            </div>
             <div class='col-xs-2'>
                <!-- set color start  -->
                <div class='ballArea'>
                    <div class='ball'>
                     <input type='text'  id="color_point_L" name="color_point_L"  type='color'  value='{{$mmtrend_color->L}}' class="customColors" />
                    </div>
                    <div class='textBall'>
                         Point 12
                    </div>
                </div>
                <!-- set color end  -->
            </div>
           
        </div>
        
        <div class='row'>
            <div class='col-xs-11'>
                <input type="hidden" id="color_type_pre" value="{{$mmtrend_color->N}}"/>
                <input type='radio' name="color_type" value="0">เส้นหนา
                <input type='radio'  name="color_type" value="1">เส้นปกติ
                <input type='radio'  name="color_type" value="2">เส้นบาง
            </div>
            <div class="form-group">
                <div class="">
                    <button type="submit" class="btn btn-sm btn-white">Save</button>
                </div>
            </div>
        </div>

        <br style='clear: both'>
     <!-- content end -->
        {!! Form::close() !!}
    </div>

<!-- Modal Start -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="modalAddEditUser" class="modal inmodal in" style="display: none;">
     <div class="modal-dialog">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
           <h5 class="modal-title">เพิ่มผู้ใช้งาน</h5>
              
           </div>
          <div class="modal-body">
          	
                            <form class="form-horizontal">
                               
                                <div class="form-group">
                                	<label class="col-lg-2 control-label padding5">เลขประจำตัว</label>

                                    <div class="col-lg-10 padding5">
                                    	<input type="text" class="form-control " placeholder="เลขประจำตัว"> 
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label padding5">ยศ/ตำแหน่ง</label>

                                    <div class="col-lg-10 padding5">
	                                    <select name="account" class="form-control m-b">
	                                        <option>นาย</option>
	                                        <option>นาง</option>
	                                        <option>นางสาว</option>
	                                        <option>...</option>
	                                    </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-lg-2 control-label padding5">ชื่อ</label>

                                    <div class="col-lg-10 padding5">
                                    	<input type="text" class="form-control " placeholder="เลขประจำตัว"> 
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-lg-2 control-label padding5">นามสกุล</label>

                                    <div class="col-lg-10 padding5">
                                    	<input type="text" class="form-control " placeholder=""> 
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-lg-2 control-label padding5">Priority</label>

                                    <div class="col-lg-10 padding5">
                                    	<input type="text" class="form-control " placeholder=""> 
                                    </div>
                                </div>
                               
                                
                            </form>
                        
          </div>
         <div class="modal-footer">
         <button class="btn btn-primary" type="button">Add</button>
         <button data-dismiss="modal" class="btn btn-white" type="button">Cancel</button>
        
      </div>
     </div>
   </div>
  </div>
<!-- Modal End -->
    
     @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop