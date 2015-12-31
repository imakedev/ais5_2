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
rtdata8.tagatom NOT LIKE 'A%' AND
rtdata8.tagatom NOT LIKE 'B%' AND
rtdata8.tagatom NOT LIKE 'C%' AND
rtdata8.tagatom NOT LIKE 'D%' AND
rtdata8.tagatom NOT LIKE 'E%' AND
rtdata8.tagatom NOT LIKE 'F%' AND
rtdata8.tagatom NOT LIKE 'G%' AND
rtdata8.tagatom NOT LIKE 'H%' AND
rtdata8.tagatom NOT LIKE 'L%' AND
rtdata8.tagatom NOT LIKE 'M%' AND
rtdata8.tagatom NOT LIKE 'O%' AND
rtdata8.tagatom NOT LIKE 'P%' AND
rtdata8.tagatom NOT LIKE 'Q%' AND
rtdata8.tagatom NOT LIKE 'T%' AND
rtdata8.tagatom NOT LIKE 'V%' AND
rtdata8.tagatom NOT LIKE 'S%' AND
rtdata8.tagatom NOT LIKE 'W%' AND
rtdata8.tagatom NOT LIKE 'NC%' AND
rtdata8.tagatom NOT LIKE 'NF%' AND
rtdata8.tagatom NOT LIKE 'NH%' AND
rtdata8.tagatom NOT LIKE 'NK%' AND
rtdata8.tagatom NOT LIKE 'NL%' AND
rtdata8.tagatom NOT LIKE 'NT%' AND
rtdata8.tagatom NOT LIKE 'NN%' AND
rtdata8.tagatom NOT LIKE 'NV%' AND
rtdata8.tagatom NOT LIKE 'NB%' AND
rtdata8.tagatom NOT LIKE 'NU%' AND
rtdata8.tagatom NOT LIKE 'NR%' AND
rtdata8.tagatom NOT LIKE 'RH%' AND
rtdata8.tagatom NOT LIKE 'RM%' AND
rtdata8.tagatom NOT LIKE 'RV%' AND
rtdata8.tagatom NOT LIKE 'RL%' AND
rtdata8.tagatom NOT LIKE 'RC%' AND
rtdata8.tagatom NOT LIKE 'RBP%' AND
rtdata8.tagatom NOT LIKE 'RB10M%' AND
rtdata8.tagatom NOT LIKE 'RB20M%' AND
rtdata8.tagatom NOT LIKE 'RB10T010%' AND
rtdata8.tagatom NOT LIKE 'RB20T010%' AND
rtdata8.tagatom NOT LIKE 'RB10P001%' AND
rtdata8.tagatom NOT LIKE 'RB20P001%' AND
rtdata8.tagatom NOT LIKE 'RW%' AND
rtdata8.tagatom NOT LIKE 'NM1%' AND
rtdata8.tagatom NOT LIKE 'NA4%' AND
rtdata8.tagatom NOT LIKE 'RA10U%' AND
rtdata8.tagatom NOT LIKE 'NG01T%' AND
rtdata8.tagatom NOT LIKE 'NG01U001%' AND
rtdata8.tagatom NOT LIKE 'NG1%' AND
rtdata8.tagatom NOT LIKE 'NG01F%' AND
rtdata8.tagatom NOT LIKE 'NG2%' AND
rtdata8.tagatom NOT LIKE 'NG3%' AND
rtdata8.tagatom NOT LIKE 'NG4%' AND
rtdata8.tagatom NOT LIKE 'NG5%' AND
rtdata8.tagatom NOT LIKE 'NG8%' AND
rtdata8.tagatom NOT LIKE 'NG9%' AND
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