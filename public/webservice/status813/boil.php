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
rtdata8.tagatom LIKE 'N%' AND
rtdata8.tagatom NOT LIKE 'LGTH%' AND
rtdata8.tagatom NOT LIKE 'DEMIN%' AND
rtdata8.tagatom NOT LIKE 'TOTCO%' AND
rtdata8.tagatom NOT LIKE 'BCEN%' AND
rtdata8.tagatom NOT LIKE 'BDEN%' AND
rtdata8.tagatom NOT LIKE 'BTEN%' AND
rtdata8.tagatom NOT LIKE 'ATEN%' AND
rtdata8.tagatom NOT LIKE 'GRGN%' AND
rtdata8.tagatom NOT LIKE 'NG01U001%' AND
rtdata8.tagatom NOT LIKE 'NH%' AND
rtdata8.tagatom NOT LIKE 'NT01L001%' AND
rtdata8.tagatom NOT LIKE 'NU50Y001%' AND
rtdata8.tagatom NOT LIKE 'NV02F001%' AND
rtdata8.tagatom NOT LIKE 'LO%' AND
rtdata8.tagatom NOT LIKE 'LS%' AND
rtdata8.tagatom NOT LIKE 'LIGOIL%'
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