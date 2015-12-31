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
rtdata8.tagatom LIKE 'NL%' AND
rtdata8.tagatom NOT LIKE 'NL1%' AND
rtdata8.tagatom NOT LIKE 'NL2%' AND
rtdata8.tagatom NOT LIKE 'NL31G%' AND
rtdata8.tagatom NOT LIKE 'NL31T%' AND
rtdata8.tagatom NOT LIKE 'NL32G%' AND
rtdata8.tagatom NOT LIKE 'NL32T%' AND
rtdata8.tagatom NOT LIKE 'NL33G%' AND
rtdata8.tagatom NOT LIKE 'NL33T%' AND
rtdata8.tagatom NOT LIKE 'NL34G%' AND
rtdata8.tagatom NOT LIKE 'NL34T%' AND
rtdata8.tagatom NOT LIKE 'NL35G%' AND
rtdata8.tagatom NOT LIKE 'NL35T%' AND
rtdata8.tagatom NOT LIKE '%P003%' AND
rtdata8.tagatom NOT LIKE 'NL4%' AND
rtdata8.tagatom NOT LIKE 'NL96%' AND
rtdata8.tagatom NOT LIKE 'NL97%' AND
rtdata8.tagatom NOT LIKE '%P001%' AND
rtdata8.tagatom NOT LIKE '%M001%' AND
rtdata8.tagatom NOT LIKE '%E121%' AND
rtdata8.tagatom NOT LIKE '%L001%' AND
rtdata8.tagatom NOT LIKE '%U007%' AND
rtdata8.tagatom NOT LIKE 'NL0%'
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