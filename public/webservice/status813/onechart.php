<?php
header('Access-Control-Allow-Origin: *');
require 'config.php';
$con=new mysqli($host, $user, $password, $dbname);
if($con->connect_error){
    echo "ติดต่อฐานข้อมูลไม่ได้";
}
$con->set_charset("utf8");
//$sdate = request.Querystring("sdate");
if ($_GET["id"] == ""){
	$_GET["id"]="T200";
	}
if ($_GET["unit"] == ""){
	$_GET["unit"]=8;
	}
if ($_GET["sdate"] == ""){
	$_GET["sdate"]="2013-03-01 00:01:00";
	$_GET["edate"]="2013-03-01 23:59:00";
}
else{
	$_GET["sdate"]="2013-03-01 00:01:00";
	$_GET["edate"]="2013-03-01 23:59:00";
	}
$sql = "SELECT
trenddata".$_GET["unit"].".T_DATE AS val1,
trenddata".$_GET["unit"].".".$_GET["id"]." AS val2
FROM
trenddata".$_GET["unit"]."
WHERE
trenddata".$_GET["unit"].".T_DATE  BETWEEN ('".$_GET["sdate"]."') AND ('".$_GET["edate"]."')
ORDER BY trenddata".$_GET["unit"].".T_DATE
";
$result=$con->query($sql);
$results_array = array();

while ($row = $result->fetch_assoc()) {
  $results_array[] = $row;
}
    echo '{"items":'.json_encode($results_array).'}';

$con->close();

?>