@extends('layouts.main')

@section('page_title','Process View')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
        <!-- Content Start-->
        <div class="ibox">
            <div class="ibox-title">
                <h5>Example Process View</h5>
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
                <!-- process view start -->
                <img src='{{ url('images/1441185404.jpg') }}' width='100%'>
                <!-- process view end -->
            </div>
        </div>
        <!-- Content End-->
    @stop
    @section('footer')
        @include('layouts.footer')
    @stop
@stop