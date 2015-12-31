
@content
<!-- Main title Start -->
        	<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Dashboard Trend </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Dashboard</a>
                        </li>
                       
                        <li class="active">
                            <strong> Trend</strong>
                        </li>
                    </ol>
                </div>
                
            </div>
            
<!-- Main title end -->   
<!-- Content Start-->     
<div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="true"> Trend001</a></li>
                            <li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="false">Trend002</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1">
                                <div class="panel-body">
                                	<!-- Trend start -->
                                	<div class='row'>
								   		<div class='col-md-12'>
								   		<div class="ibox ">
								                        
								                        <div class="ibox-content">
								                           
								                            <!-- kendo ui chart start -->
								                            <div id="example">
															    <div class="demo-section k-content wide">
															        <div id="chart" style="background: center no-repeat url('js/kendoCommercial/bg/world-map.png');"></div>
															    </div>
															  
															</div>
								
								                            
								                            <!-- kendo ui chart end -->
								
								                        </div>
								                    </div>
								   			</div>
										</div>
                                	<!-- Trend end -->
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <div class="panel-body">
                                content2
                                </div>
                            </div>
                        </div>


                    </div>

<!-- Content End-->   

 <script>

$(document).ready(function(){
	$("#chart").kendoChart({
		theme: "Silver",
        title: {
            text: "Gross domestic product growth \n /GDP annual %/"
        },
        legend: {
            position: "bottom"
        },
        chartArea: {
            background: ""
        },
        seriesDefaults: {
            type: "line",
            style: "smooth"
        },
        series: [{
            name: "India",
            data: [3.907, 7.943, 7.848, 9.284, 9.263, 9.801, 3.890, 8.238, 9.552, 6.855]
        },{
            name: "World",
            data: [1.988, 2.733, 3.994, 3.464, 4.001, 3.939, 1.333, -2.245, 4.339, 2.727]
        },{
            name: "Russian Federation",
            data: [4.743, 7.295, 7.175, 6.376, 8.153, 8.535, 5.247, -7.832, 4.3, 4.3]
        },{
            name: "Haiti",
            data: [-0.253, 0.362, -3.519, 1.799, 2.252, 3.343, 0.843, 2.877, -5.416, 5.590]
        },{
            name: "Haiti2",
            data: [-3.253, 5.362, -5.519, 6.799, 4.252, 3.343, 1.843, 1.877, -0.416, 6.590]
        },{
            name: "Haiti3",
            data: [-2.253, 3.362, -4.519, 5.799, 3.252, 2.343, 0.843, 0.877, -1.416, 5.590]
        },{
            name: "Haiti4",
            data: [-1.253, 2.362, -3.519, 4.799, 2.252, 1.343, 1.843, 1.877, -2.416, 4.590]
        }],
        valueAxis: {
            labels: {
                format: "{0}%"
            },
            line: {
                visible: false
            },
            axisCrossingValue: -10
        },
        categoryAxis: {
            categories: [2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011],
            majorGridLines: {
                visible: false
            },
            labels: {
                rotation: "auto"
            }
        },
        tooltip: {
            visible: true,
            format: "{0}%",
            template: "#= series.name #: #= value #"
        }
    });
});
   </script>
            