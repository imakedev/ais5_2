<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 08/03/2016
 * Time: 18:06
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
echo get_secdata();


function get_secdata()
{
    //$root_path='/Users/imake/Desktop/AIS/data/MM';
    //$root_path='/mnt/aisdata/MM';
    $root_path='';
    $sub_path='';
    $data_back = json_decode(file_get_contents('php://input'));

    $key_params=$data_back->{'key'};//request('key');
    $formula_params=$data_back->{'formulas'};//request('formulas');
    $startTime_param=$data_back->{'startTime'};//request('startTime');
    $endTime_param=$data_back->{'endTime'};//request('endTime');
    $constant_array=$data_back->{'constants'};//request('endTime');
    $server_param=$data_back->{'server'};//request('server')

    //echo $data_back->{'server'};
    $new_array = array();
    foreach ($formula_params as $key_formula_param => $formula_param) {
        //$str = strtoupper($formula_params);
        $str = strtoupper($formula_param);

        foreach ($constant_array as $key_constant_param => $constant_value) {
            //$str=str_replace('CONSTANT@'.$constant_value['name'], $constant_value['value'], $str);
            $str=str_replace('CONSTANT@'.$constant_value->name, $constant_value->value, $str);
            // Log::info('CONSTANT2=>'. $constant_value['name'].' value=>'.$constant_value['value']);
        }

        // udate formula_param
        $formula_params[$key_formula_param]=$str;
        preg_match_all('/(U[0-9]{1,2})(D[0-9]{1,4})/', $str, $matches);


        if(!empty($matches)){
            $full_formats=$matches[0]; //full format
            $first_groups=$matches[1];//first group (U0x)
            $second_groups=$matches[2];//second group (Dyyy)
            foreach($full_formats as $key => $full_format){
                if(!array_key_exists($full_format, $new_array)){
                    $new_array_inner = array();
                    $new_array_inner['unit']=$first_groups[$key];
                    $new_array_inner['data']=$second_groups[$key];
                    $new_array_inner['time']='';
                    $new_array_inner['value']='';
                    $new_array[$full_format]=$new_array_inner;
                }
            }
        }
    }


    //$jsonStr=json_encode($new_array);
    //$json = json_decode($jsonStr);
    $startTimeArray= explode(" ",$startTime_param);
    $endTimeArray= explode(" ",$endTime_param);
    $vdateStart = explode("-",$startTimeArray[0]);
    $vYearStart =$vdateStart[0];
    $vMonthStart=$vdateStart[1];
    $vDayStart  =$vdateStart[2];

    $vdateEnd = explode("-",$endTimeArray[0]);
    $vYearEnd =$vdateEnd[0];
    $vMonthEnd=$vdateEnd[1];
    $vDayEnd  =$vdateEnd[2];

    $vtimeStart= explode(":",$startTimeArray[1]);
    $vtimeEnd= explode(":",$endTimeArray[1]);

    $vHourStart   = intval($vtimeStart[0]);
    $vMinuteStart = intval($vtimeStart[1]);

    $vHourEnd   = intval($vtimeEnd[0]);
    $vMinuteEnd= intval($vtimeEnd[1]);

    $folderNameStart=$vYearStart.$vMonthStart.$vDayStart;
    $folderName=$vYearStart.'/'.$vMonthStart.'/'.$vDayStart;
    $folderNameEnd=$vYearEnd.$vMonthEnd.$vDayEnd;

    if($server_param=='47'){
        $root_path='D:/Data/MM';
        $sub_path=$folderNameStart;
    }else if($server_param=='813'){
        $root_path='E:/MM';
        $sub_path='/'.$folderName;
    }

    $result_array = array();
    $result_times_array = array();
    $index=0;
    foreach($new_array as $keyOfArray => $valueOfArray){
      //  Log::info(' key['.$keyOfArray.'] value 1 ['.intval(str_replace("U","",$valueOfArray['unit'])).'] value 2 ['.str_replace("D","",$valueOfArray['data']).']' );
        $minute_array_inner = array();
        for ($time = $vHourStart; $time <= $vHourEnd; $time++) {
            // Log::info(' vHourStart['.$time.'] ' );
            $hourStr=($time>9)?$time:('0'.$time);
            $minute_end=59;
            $minute_start=0;
            if($time==$vHourEnd && $index!=0 || ($vHourStart==$vHourEnd && $index==0)){
                $minute_end=$vMinuteEnd;
            }
            if(($index==0)){
                $minute_start=$vMinuteStart;
            }
         //   Log::info(' $vMinuteStart['.$minute_start.'] $vMinuteEnd['.$minute_end.']' );
            for ($minute = $minute_start; $minute <= $minute_end; $minute++) {
                $minuteStr=($minute>9)?$minute:('0'.$minute);
                $unit=str_replace("U","",$valueOfArray['unit']);
                $new_array[$keyOfArray]['time']=$folderNameStart.$hourStr.$minuteStr;
                $valueOfArray['time']=$folderNameStart.$hourStr.$minuteStr;
                //E:/MM -->08/0820140520/08201405200002.dat
                //E:/MM -->08/2015/11/30/08201511301419.dat
                if($server_param=='47'){
                    $sub_path=$unit.$folderNameStart;
                }else if($server_param=='813'){
                    $sub_path=$folderName;
                }
                //$url = $root_path.$unit.'/'.$unit.$folderNameStart.'/'.$unit.$folderNameStart.$hourStr.$minuteStr.'.dat';
                //$url = $root_path.$unit.'/'.$unit.'/'.$folderName.'/'.$unit.$folderNameStart.$hourStr.$minuteStr.'.dat';
                $url = $root_path.$unit.'/'.$sub_path.'/'.$unit.$folderNameStart.$hourStr.$minuteStr.'.dat';
                if ( file_exists($url) && ($hd = fopen($url, "rb"))!==false ) {
                    $p = array(intval(str_replace("D","",$valueOfArray['data'])));

                   // $hd = fopen($url, "rb");

                    $data = fread($hd, 6);
                    $ar = unpack("vid/fdata", $data);
                    fseek($hd, ($ar['data'] + 1) * 6);
                    while (!feof($hd)) {

                        $data = fread($hd, 6);
                        if (strlen($data) != 6) {
                            //echo "length ".strlen($data);
                            break;
                        }
                        $ar = unpack("vid/fdata", $data);
                        //  echo "sec : " . $ar['id'] . "->" . $ar['data'] . "<br>";
                        for ($i = 0; $i <= $ar['data'] - 1; $i++) {
                            $data = fread($hd, 6);
                            $arr = unpack("vid/fdata", $data);
                            $trend_data[$arr['id']] = $arr['data'];
                        }
                        foreach ($p as $key => $value) {
                            // echo "Point : " . $p[$key] . ", data : " . $trend_data[$value] . "<br />";
                            $second_array_inner = array();
                            $secondStr=(intval($ar['id'])>9)?$ar['id']:('0'.$ar['id']);
                            $second_array_inner['time']=$vYearStart.'-'.$vMonthStart.'-'.$vDayStart.' '.$hourStr.':'.$minuteStr.':'.$secondStr;
                            $second_array_inner['point']=$p[$key];
                            $second_array_inner['unit']=$valueOfArray['unit'];
                            $second_array_inner['data']=$valueOfArray['data'];
                            $second_array_inner['value']=$trend_data[$value];
                            $key_time=$vYearStart.'-'.$vMonthStart.'-'.$vDayStart.' '.$hourStr.':'.$minuteStr.':'.$secondStr;
                            $minute_array_inner[$key_time]=$second_array_inner;
                            // Log::info("key time->".$key_time);
                            if(!array_key_exists($key_time, $result_times_array)){
                                $result_times_array[$key_time]=$key_time;
                            }
                            // Log::info("Point : " . $p[$key] . ", data : " . $trend_data[$value] . "<br />".$value." key ".$key);
                        }
                    }
                    fclose($hd);
                }else{

                }

            }
            $index++;
        }
        $index=0;
        $result_array[$keyOfArray]=$minute_array_inner;
    }

    $jsonStr=json_encode($result_array);
    //$json = json_decode($jsonStr);

    $result_key_array = array();
    foreach($result_times_array as $key => $result_times) {

        foreach ($formula_params as $key_p => $formula_param) {
            //  Log::info("formula_param ".$formula_param);
            $new_array_inner = array();
            // $new_array_inner['formula'] = $str;
            $new_array_inner['formula'] = $formula_param;
            //$new_str = $str;
            $new_str = $formula_param;
            foreach ($result_array as $key2 => $result_unit) {
                $new_key = $result_unit[$key]['unit'] . $result_unit[$key]['data'];
                $new_str = str_replace($new_key, $result_unit[$key]['value'], $new_str);
                //Log::info(' time '.$key.' unit '.$result_unit[$key]['unit'].' data '.$result_unit[$key]['data'].' value '.$result_unit[$key]['value']);
            }
            // $result_array['U08D122']['2014-05-20 00:02:58']['value']
            $new_array_inner['value'] = $new_str;
            $new_array_inner['key'] = $key_params[$key_p];
            $new_array_inner['time'] = $key;
            //$result_key_array[$key] = $new_array_inner;
            array_push($result_key_array, $new_array_inner);
        }
    }
   // Log::info($result_key_array);
    return json_encode($result_key_array);
//    return response()->json(['sources'=>json_encode($result_array),'dataWithTimes'=>json_encode($result_key_array)]);
}