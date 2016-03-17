<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 16/03/2016
 * Time: 18:13
 */
$conn = mysql_connect('10.249.91.207', 'Administrator', 'larrabee');

$db = mysql_select_db('avg8-13');

if ($conn) {

    echo "connect success";

}

if ($db) {

    echo "select db success";

}
$sql2 = "select EvTime,d1,d2  from datau08 where EvTime between '2015-11-30 14:17:00' and '2015-11-30 15:17:00'";


$result = mysql_query($sql2);


if (!$result) {


    echo mysql_error();


} else {


    echo " query ok..";


}
while ($rs = mysql_fetch_array($result)) {

    print_r($rs);

}