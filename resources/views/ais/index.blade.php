@extends('layouts.main')

@section('page_title','Trend')

@include('layouts.navigation')

@section('body')
    @include('layouts.header')
    @section('content')
            <!-- Main Content Start -->
        <?php
            /*switch ($_GET['page']){
            *    case 'trend':include 'trend';break;
            *   case 'design_trend':include 'design_trend.php';break;
            *    case 'process_view':include 'process_view';break;
            *    case 'trend':include 'trend';break;
            *
            *    case 'serverSetting':include 'serverSetting.php';break;
            *    case 'pointConfiguration':include 'pointConfiguration.php';break;
            *    case 'tagConfiguration':include 'tagConfiguration.php';break;
            *    case 'addUser':include 'addUser.php';break;
            *    case 'statistics':include 'statistics.php';break;
            *
            *}
            *switch($page) {
            *    case "trend" :
            *        include ("trend.blade.php");
            *        break;
            *}
            */echo "<h1 style='color:lightseagreen;'> Include PHP File !! ToT </h1>";

        if(Auth::check()){
// User is logged in
            echo "<h1 style='color:lightseagreen;'>  </h1>";
        }
        ?>
￼{{Auth::user()->name}}
            <!-- Main Content End -->
    @stop

    @section('footer')
        <div class="pull-right">
            AIS <strong>Client</strong> 2015.
        </div>
        <div>
            <strong>Copyright</strong> Analytical Information System  &copy; 2014-2015
        </div>
    @stop
@stop