<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="csrf-token" content="<?php echo csrf_token() ?>" />
    <title>AIS2015 | @yield('page_title')</title>


    <!-- kendo ui resource start -->
    <!-- -->
    <link rel="stylesheet" href="/js/kendoCommercial/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="/js/kendoCommercial/styles/kendo.default.min.css" />

    <!-- kendo ui resource end -->

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

    <!-- Mainly scripts -->
    <!-- <script src="js/jquery-2.1.1.js"></script> -->
    <script src="/js/kendoCommercial/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>


    <!-- loading -->
    <link rel="stylesheet" href="/css/HoldOn.min.css">
    <!-- java script loading -->
	<script src="/Controller/HoldOn.min.js"></script>



    <!-- NouSlider -->
    <script src='/js/nouislider.min.js'></script>
     <!-- NouSlider -->
    <link rel="stylesheet" href="/css/plugins/nouslider/jquery.nouislider.css">

    <!-- Flot -->
    <script src="/js/plugins/flot/jquery.flot.js"></script>
    <script src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript-->
    <script src="/js/inspinia.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>
    

    <!-- jQuery UI -->
    <script src="/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="/js/plugins/toastr/toastr.min.js"></script>

    <!-- kendo ui resource end -->
    <script src="/Controller/cMain.js"></script>
   <script src="//kendo.cdn.telerik.com/2015.3.930/js/kendo.all.min.js"></script>
     <!--<script src="/js/kendoCommercial/js/kendo.all.min.js"></script> --> 


    <script>
        function confirm_del(){
            return confirm('Are you sure! you want to delete this entry');
        }
    </script>
</head>

<body>

 <div id='tooltip'class='tooltipClass'></div> 
    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            @yield('nevigation_slideMenu')
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            @yield('body')
                <div class="row border-bottom">@yield('navigation_Header')</div>
                <div class="content">@yield('content')</div>
                <div class="footer">@yield('footer')</div>
        </div>
    </div>

</body>
</html>

