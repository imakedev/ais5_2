<?php
header('Access-Control-Allow-Origin: *');
require 'config.php';
$con=new mysqli($host, $user, $password, $dbname);
if($con->connect_error){
    echo "ติดต่อฐานข้อมูลไม่ได้";
}
$con->set_charset("utf8");
$todays = Date("Y-m-d");
$hours =Date("H")-1;
$minut =Date("i");
$today = Date("Y-m-d H:i:s");
$sdate = $todays ." ". $hours.":".$minut .":00";
$edate = $today;
//print  $sdate;
//print  $edate;
$sql = "SELECT
trenddata8.T_DATE AS uTval, 
trenddata8.T200 AS u8val, 
trenddata9.T200 AS u9val,
trenddata10.T200 AS u10val,
trenddata11.T200 AS u11val,
trenddata12.T200 AS u12val,
trenddata13.T200 AS u13val
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