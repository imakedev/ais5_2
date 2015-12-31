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
rtdata8.tagatom NOT LIKE 'NA%' AND
rtdata8.tagatom NOT LIKE 'NB%' AND
rtdata8.tagatom NOT LIKE 'NC%' AND
rtdata8.tagatom NOT LIKE 'NF%' AND
rtdata8.tagatom NOT LIKE 'NT%' AND
rtdata8.tagatom NOT LIKE 'NK%' AND
rtdata8.tagatom NOT LIKE 'NH%' AND
rtdata8.tagatom NOT LIKE 'NU%' AND
rtdata8.tagatom NOT LIKE 'NV%' AND
rtdata8.tagatom NOT LIKE 'NN%' AND
rtdata8.tagatom NOT LIKE 'NM%' AND
rtdata8.tagatom NOT LIKE 'NG0%' AND
rtdata8.tagatom NOT LIKE 'NR0%' AND
rtdata8.tagatom NOT LIKE 'NL0%' AND
rtdata8.tagatom NOT LIKE 'NL3%' AND
rtdata8.tagatom NOT LIKE 'NL4%' AND
rtdata8.tagatom NOT LIKE 'NL8%' AND
rtdata8.tagatom NOT LIKE '%T003%' AND
rtdata8.tagatom NOT LIKE 'NL11E%' AND
rtdata8.tagatom NOT LIKE 'NL11G%' AND
rtdata8.tagatom NOT LIKE 'NL11S%' AND
rtdata8.tagatom NOT LIKE 'NL11V%' AND
rtdata8.tagatom NOT LIKE 'NL12E%' AND
rtdata8.tagatom NOT LIKE 'NL12T%' AND
rtdata8.tagatom NOT LIKE 'NL12P%' AND
rtdata8.tagatom NOT LIKE 'NL21E%' AND
rtdata8.tagatom NOT LIKE 'NL21G%' AND
rtdata8.tagatom NOT LIKE 'NL21S%' AND
rtdata8.tagatom NOT LIKE 'NL21V%' AND
rtdata8.tagatom NOT LIKE 'NL22P%' AND
rtdata8.tagatom NOT LIKE 'NL22T%' AND
rtdata8.tagatom NOT LIKE 'NG12E%' AND
rtdata8.tagatom NOT LIKE 'NG12G%' AND
rtdata8.tagatom NOT LIKE 'NG12P%' AND
rtdata8.tagatom NOT LIKE 'NG12S%' AND
rtdata8.tagatom NOT LIKE 'NG13%' AND
rtdata8.tagatom NOT LIKE 'NG14%' AND
rtdata8.tagatom NOT LIKE 'NG15%' AND
rtdata8.tagatom NOT LIKE 'NG16%' AND
rtdata8.tagatom NOT LIKE 'NG22E%' AND
rtdata8.tagatom NOT LIKE 'NG22G%' AND
rtdata8.tagatom NOT LIKE 'NG22P%' AND
rtdata8.tagatom NOT LIKE 'NG22S%' AND
rtdata8.tagatom NOT LIKE 'NG23%' AND
rtdata8.tagatom NOT LIKE 'NG24%' AND
rtdata8.tagatom NOT LIKE 'NG25%' AND
rtdata8.tagatom NOT LIKE 'NG26%' AND
rtdata8.tagatom NOT LIKE 'NG3%' AND
rtdata8.tagatom NOT LIKE 'NG4%' AND
rtdata8.tagatom NOT LIKE 'NG5%' AND
rtdata8.tagatom NOT LIKE 'NG8%' AND
rtdata8.tagatom NOT LIKE 'NR1%' AND
rtdata8.tagatom NOT LIKE 'NR2%' AND
rtdata8.tagatom NOT LIKE 'NR31%' AND
rtdata8.tagatom NOT LIKE 'NR32%' AND
rtdata8.tagatom NOT LIKE 'NR34%' AND
rtdata8.tagatom NOT LIKE 'NR33E%' AND
rtdata8.tagatom NOT LIKE 'NR33Q%' AND
rtdata8.tagatom NOT LIKE 'NR33T001%' AND
rtdata8.tagatom NOT LIKE 'NR33G%' AND
rtdata8.tagatom NOT LIKE 'NR33P%' AND
rtdata8.tagatom NOT LIKE 'NR33S%' AND
rtdata8.tagatom NOT LIKE 'NR41%' AND
rtdata8.tagatom NOT LIKE 'NR42%' AND
rtdata8.tagatom NOT LIKE 'NR43T001%' AND
rtdata8.tagatom NOT LIKE 'NR43E%' AND
rtdata8.tagatom NOT LIKE 'NR43G%' AND
rtdata8.tagatom NOT LIKE 'NR43P%' AND
rtdata8.tagatom NOT LIKE 'NR43S%' 
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