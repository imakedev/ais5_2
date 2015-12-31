<?php
header('Access-Control-Allow-Origin: *');
require 'config.php';
$con=new mysqli($host, $user, $password, $dbname);
if($con->connect_error){
    echo "ติดต่อฐานข้อมูลไม่ได้";
}
$con->set_charset("utf8");

$sql = "SELECT
SUBSTRING(rtdata8.tagatom,1,LENGTH(rtdata8.tagatom)-4) AS tagname,
rtdata8.`value` AS u8val,
rtdata9.`value` AS u9val,
rtdata10.`value` as u10val,
rtdata11.`value` as u11val,
rtdata12.`value` as u12val,
rtdata13.`value` as u13val
FROM
rtdata8 ,
rtdata9 ,
rtdata10 ,
rtdata11 ,
rtdata12 ,
rtdata13
WHERE
SUBSTRING(rtdata8.tagatom,LENGTH(rtdata8.tagatom)-2,3)='APV' AND
SUBSTRING(rtdata9.tagatom,LENGTH(rtdata9.tagatom)-2,3)='APV' AND
SUBSTRING(rtdata10.tagatom,LENGTH(rtdata10.tagatom)-2,3)='APV' AND
SUBSTRING(rtdata11.tagatom,LENGTH(rtdata11.tagatom)-2,3)='APV' AND
SUBSTRING(rtdata12.tagatom,LENGTH(rtdata11.tagatom)-2,3)='APV' AND
SUBSTRING(rtdata13.tagatom,LENGTH(rtdata11.tagatom)-2,3)='APV' AND
rtdata8.tagatom=rtdata9.tagatom AND
rtdata8.tagatom=rtdata10.tagatom AND
rtdata8.tagatom=rtdata11.tagatom AND
rtdata8.tagatom=rtdata12.tagatom AND
rtdata8.tagatom=rtdata13.tagatom AND
rtdata8.tagatom LIKE 'S%' AND
rtdata8.tagatom NOT LIKE 'SA%' AND
rtdata8.tagatom NOT LIKE 'SD%' AND
rtdata8.tagatom NOT LIKE 'SP%' AND
rtdata8.tagatom NOT LIKE 'SO%' AND
rtdata8.tagatom NOT LIKE 'SU%' AND
rtdata8.tagatom NOT LIKE 'SF%' AND
rtdata8.tagatom NOT LIKE 'SY%' AND
rtdata8.tagatom NOT LIKE 'SG%' AND
rtdata8.tagatom NOT LIKE 'SA%' AND
rtdata8.tagatom NOT LIKE '%T00%' AND
rtdata8.tagatom NOT LIKE 'SB20T%' AND
rtdata8.tagatom NOT LIKE 'SB30T%' AND
rtdata8.tagatom NOT LIKE 'SB40T%'
ORDER BY rtdata8.tagatom
";
$result=$con->query($sql);
$results_array = array();

while ($row = $result->fetch_assoc()) {
  $results_array[] = $row;
}
    echo '{"items":'.json_encode($results_array).'}';

$con->close();

?>