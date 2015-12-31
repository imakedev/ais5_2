<?php
//$url="http://maemoh.egat.com/ais/webservice/TrendGroup.php?trend=900002&_unit=2";
$url="http://maemoh.egat.com/ais/webservice/PlotGraph.php?starttime=2014-10-10%2008:00:00&endtime=2014-10-10%2008:30:00&mmunit=10&_unit=2&point=d10,d50,d60";
$contents = file_get_contents($url);
$contents = utf8_encode($contents);
$results = json_decode($contents);
//print_r($results);

foreach ($results as $key => $value) {
    echo "<h2>$key</h2>";
    foreach ($value as $k => $v) {
        echo "$k | $v <br />";
    }
}


 ?>