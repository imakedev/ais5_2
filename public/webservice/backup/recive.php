<?php
$url="http://10.249.99.133/ais/webservice/webservice.php";
$url="http://10.249.99.133/ais/webservice/TrendGroup.php?trend=900002&_unit=2";
$url="http://maemoh.egat.com/ais/webservice/TrendName.php?trendno=239&_unit=2&mmunit=9";
$url="http://10.249.99.133/ais/webservice/PointName.php?pointno=242&_unit=2";
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