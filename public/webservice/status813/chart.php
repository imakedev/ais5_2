<?php
header('Access-Control-Allow-Origin: *');
require 'config.php';
$con=new mysqli($host, $user, $password, $dbname);
if($con->connect_error){
    echo "ติดต่อฐานข้อมูลไม่ได้";
}
$con->set_charset("utf8");
$todays = Date("Y-m-d");
$today = Date("Y-m-d H:i:s");

if ($_GET["id"] == ""){
	$_GET["id"]="T200";
	}
else{
	$_GET["id"]=$_GET["id"];
	}

if ($_GET["sdate"] == ""){
	$sdate = $todays . " 00:01:00";
	$edate = $today;
}
else{
	$sdate = $_GET["sdate"]." 00:01:00";
	$edate = $_GET["sdate"]." 23:59:00";
	}
//print  $sdate;
//print  $edate;
$sql = "SELECT
trenddata8.T_DATE AS uTval, 
trenddata8.".$_GET["id"]." AS u8val, 
trenddata9.".$_GET["id"]." AS u9val,
trenddata10.".$_GET["id"]." AS u10val,
trenddata11.".$_GET["id"]." AS u11val,
trenddata12.".$_GET["id"]." AS u12val,
trenddata13.".$_GET["id"]." AS u13val
FROM
trenddata8 ,
trenddata9 ,
trenddata10 ,
trenddata11 ,
trenddata12 ,
trenddata13
WHERE
trenddata8.T_DATE=trenddata9.T_DATE AND
trenddata8.T_DATE=trenddata10.T_DATE AND
trenddata8.T_DATE=trenddata11.T_DATE AND
trenddata8.T_DATE=trenddata12.T_DATE AND
trenddata8.T_DATE=trenddata13.T_DATE AND
trenddata8.T_DATE BETWEEN ('".$sdate."') AND ('".$edate."')
ORDER BY trenddata8.T_DATE
";
$result=$con->query($sql);
$results_array = array();

while ($row = $result->fetch_assoc()) {
  $results_array[] = $row;
}
    echo '{"items":'.json_encode($results_array).'}';

$con->close();

?>