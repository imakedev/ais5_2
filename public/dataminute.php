<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 16/03/2016
 * Time: 17:25
 */
set_time_limit(0); //Unlimited max execution time
error_reporting(E_ALL ^ E_NOTICE);
header('Cache-control: private'); // IE 6 FIX
// always modified
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
// HTTP/1.1
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
// HTTP/1.0
header('Pragma: no-cache');
header('Content-Type: application/json');
echo  getData();
function getData()
{
    $data_back = json_decode(file_get_contents('php://input'));

    $host_db_params = $data_back->{'host_db'};//request('key');
    $user_db_params = $data_back->{'user_db'};//request('formulas');
    $pass_db_param = $data_back->{'pass_db'};//request('startTime');
    $schema_db_param = $data_back->{'schema_db'};//request('endTime');
    $data_str_param = $data_back->{'data_str'};//request('endTime');
    $data_table_param = $data_back->{'data_table'};//request('endTime');
    $unit_param = $data_back->{'unit'};//request('server')
    $startTime_param = $data_back->{'startTime'};//request('server')
    $endTime_param = $data_back->{'endTime'};//request('server')
    $groupby_param = $data_back->{'groupby'};//request('server')
    $scaleType_param = $data_back->{'scaleType'};//request('server')
    
     /*
    $host_db_params = 'localhost';
    $user_db_params = 'root';
    $pass_db_param ='010535546';
    $schema_db_param ='ais_db';
    $data_str_param = "D260";
    $data_table_param ="data";
    $unit_param ="U04";
    $startTime_param = "2014-05-11 00:10:00";
       $endTime_param ="2014-05-11 14:20:00";
    $groupby_param ="";
    $scaleType_param ="minute";
    */
    // $scaleType_param="month";
    $datetime1 = strtotime($startTime_param);
    $datetime2 = strtotime($endTime_param);
    $interval = abs($datetime2 - $datetime1);
    if ($scaleType_param == 'minute') {
        $data_table = "data";
        $minutes = round($interval / 60)+1;
    } else if ($scaleType_param == 'hour') { // ok
        $data_table = "datahr";
        $minutes = round($interval / (60*60))+1;
    }
    if ($scaleType_param == 'day') { // 0k
        $data_table = "dataday";
        $minutes = round($interval / (24*60*60))+1;
    }
    if ($scaleType_param == 'month') {
        $data_table = "dataday";
        $groupby = " group by month(EvTime) ";
        $minutes = round($interval / (30*24*60*60))+1;
    }

    $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);

    $db = mysql_select_db($schema_db_param);

    if ($conn) {

       // echo "connect success";

    }

    if ($db) {

        //echo "select db success";

    }
    $sql = " select EvTime , " . $data_str_param . " as data  from " . $data_table . strtolower($unit_param) .
        " where EvTime between '" . $startTime_param . "' " .
         " and '" . $endTime_param . "' " . $groupby_param.  " order by EvTime asc ";
    $sql2 = " select EvTime , " . $data_str_param . " as data  from " . $data_table_param . strtolower($unit_param) .
        // " where EvTime between '" . $startTime_param . "' " .
        // " and '" . $endTime_param . "' " . $groupby;
        " where EvTime >= '" . $startTime_param . "' " .$groupby.
        //" where EvTime <= '" . $endTime_param . "' " . $groupby.
        " order by EvTime asc ".
        " limit  ".$minutes;
    $result = mysql_query($sql);


    if (!$result) {


       // echo mysql_error();


    } else {


       // echo " query ok..";


    }
    // Log::info($result_key_array);
    $result_key_array = array();
    while ($rs = mysql_fetch_array($result)) {
        $new_array_inner = array();
        // $new_array_inner['formula'] = $str;
        $data="0";
        if($rs['data']!=null)
            $data=$rs['data'];
        $new_array_inner['data'] =$data ;
        $new_array_inner['EvTime'] = $rs['EvTime'];
        //echo $rs['xxadfs'];
        array_push($result_key_array, $new_array_inner);
    }
    return json_encode($result_key_array);
}