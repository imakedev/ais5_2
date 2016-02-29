<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 20/02/2016
 * Time: 22:17
 */

namespace App\Http\Controllers;

use \App\Model\MmcalculationModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Model\TagConfigModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Log;
use \App\Utils\DBUtils;
use Illuminate\Support\Facades\Auth;
class DataSecController  extends Controller
{

    function getSecdata(Request $request)
    {
        //$str = strtoupper('(u04D122+U04D122)*U09D123');
        $str = strtoupper('(U08D122+U08D122)*U08D123');
        $root_path='/Users/imake/Desktop/AIS/data/MM';
        //$str = strtoupper('U08D123');
        preg_match_all('/(U[0-9]{1,2})(D[0-9]{1,4})/', $str, $matches);

        /* This also works in PHP 5.2.2 (PCRE 7.0) and later, however
         * the above form is recommended for backwards compatibility */
// preg_match('/(?<name>\w+): (?<digit>\d+)/', $str, $matches);
        $new_array = array();
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
               // Log::info($full_format.' first['.$first_groups[$key].'] second['.$second_groups[$key].']' );
            }


        }
        //print_r($matches);
        //Log::info($matches);
        $fileName = request('fileName');
        //Log::info($fileName);
        foreach($new_array as $key => $value){

         //   Log::info(' key['.$key.'] value 1 ['.$value[0].'] value 2 ['.$value[1].']' );
            //Log::info(' key['.$key.'] value 1 ['.intval(str_replace("U","",$value[0])).'] value 2 ['.str_replace("D","",$value[1]).']' );
          //  Log::info(' key['.$key.'] value 1 ['.intval(str_replace("U","",$value['unit'])).'] value 2 ['.str_replace("D","",$value['data']).']' );
        }
        if(!empty($new_array['U04D122'])){
            //Log::info($new_array['U04D122']);
        }
        $jsonStr=json_encode($new_array);
        //Log::info('jsonStr->'.$jsonStr);
        //{"U04D122":["U04","D122"],"U09D123":["U09","D123"]}

        $json = json_decode($jsonStr);
        //Log::info($json->{'U09D123'}->unit);
        //Log::info($json->U09D123->unit);
        $startTime='2014-05-20 00:02:00';
        $endTime='2014-05-20 00:02:00';
        $startTimeArray= explode(" ",$startTime);
        $endTimeArray= explode(" ",$endTime);
        //$vdateArray2 = $vdateArray[0];
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
        //$vSecond = $vtime[2];

        $folderNameStart=$vYearStart.$vMonthStart.$vDayStart;
        $folderNameEnd=$vYearEnd.$vMonthEnd.$vDayEnd;
        //$startTime=$folderName.$vHourStart."0000";
       // $startTime=$folderNameStart.$vHourStart.$vMinuteStart;
        // $endTime=$folderNameEnd.$vHourEnd.$vMinuteEnd;
        $result_array = array();
        $result_times_array = array();
        $index=0;
        foreach($new_array as $keyOfArray => $valueOfArray){
            Log::info(' key['.$keyOfArray.'] value 1 ['.intval(str_replace("U","",$valueOfArray['unit'])).'] value 2 ['.str_replace("D","",$valueOfArray['data']).']' );
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

                Log::info(' $vMinuteStart['.$minute_start.'] $vMinuteEnd['.$minute_end.']' );
                for ($minute = $minute_start; $minute <= $minute_end; $minute++) {
                //for ($minute = 0; $minute <= 59; $minute++) {
                    //  $url = '/Users/imake/Desktop/AIS/data/MM08/0820140520/'.$fileName.'.dat';

                    $minuteStr=($minute>9)?$minute:('0'.$minute);
                    $unit=str_replace("U","",$valueOfArray['unit']);
                    $new_array[$keyOfArray]['time']=$folderNameStart.$hourStr.$minuteStr;
                    $valueOfArray['time']=$folderNameStart.$hourStr.$minuteStr;

                    $url = $root_path.$unit.'/'.$unit.$folderNameStart.'/'.$unit.$folderNameStart.$hourStr.$minuteStr.'.dat';

                    //$p = array(260,15,20,25,30);
                    $p = array(intval(str_replace("D","",$valueOfArray['data'])));

                    $hd = fopen($url, "rb");

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

                        echo "sec : " . $ar['id'] . "->" . $ar['data'] . "<br>";


                        for ($i = 0; $i <= $ar['data'] - 1; $i++) {
                            $data = fread($hd, 6);
                            $arr = unpack("vid/fdata", $data);
                            $trend_data[$arr['id']] = $arr['data'];

                        }

                        foreach ($p as $key => $value) {
                            echo "Point : " . $p[$key] . ", data : " . $trend_data[$value] . "<br />";
                            $second_array_inner = array();
                            $secondStr=(intval($ar['id'])>9)?$ar['id']:('0'.$ar['id']);
                            $second_array_inner['time']=$vYearStart.'-'.$vMonthStart.'-'.$vDayStart.' '.$hourStr.':'.$minuteStr.':'.$secondStr;
                            $second_array_inner['point']=$p[$key];
                            $second_array_inner['unit']=$valueOfArray['unit'];
                            $second_array_inner['data']=$valueOfArray['data'];
                            $second_array_inner['value']=$trend_data[$value];
                            $key_time=$vYearStart.'-'.$vMonthStart.'-'.$vDayStart.' '.$hourStr.':'.$minuteStr.':'.$secondStr;
                            $minute_array_inner[$key_time]=$second_array_inner;
                            Log::info("key time->".$key_time);
                            if(!array_key_exists($key_time, $result_times_array)){
                               // $result_times_array_inner = array();
                                //$result_times_array_inner['time']=$key_time;
                                //$result_times_array[$key_time]=$result_times_array_inner;
                                 $result_times_array[$key_time]=$key_time;
                            }
                           // array_push($minute_array_inner,$second_array_inner);

                            // Log::info("Point : " . $p[$key] . ", data : " . $trend_data[$value] . "<br />".$value." key ".$key);
                        }
                    }
                    //$result_array[$keyOfArray]=$minute_array_inner;
                    fclose($hd);
                }
                $index++;
            }
            $index=0;
            $result_array[$keyOfArray]=$minute_array_inner;
        }

        /*
        $index=0;
        //$result_with_formula_array = array();
        $result_with_formula_array = array();
        $unit_array_inner = array();
        for ($time = $vHourStart; $time <= $vHourEnd; $time++) {
            Log::info(' vHourStart[' . $time . '] ');
            $hourStr = ($time > 9) ? $time : ('0' . $time);
            $minute_end = 59;
            $minute_start = 0;
            if ($time == $vHourEnd && $index != 0 || ($vHourStart == $vHourEnd && $index == 0)) {
                $minute_end = $vMinuteEnd;
            }

            if (($index == 0)) {
                $minute_start = $vMinuteStart;
            }

            //Log::info(' $vMinuteStart[' . $minute_start . '] $vMinuteEnd[' . $minute_end . ']');
            for ($minute = $minute_start; $minute <= $minute_end; $minute++) {

                foreach($new_array as $kk => $new_array_value){
                    Log::info($new_array_value['unit'].$new_array_value['data']);
                    
                    foreach($result_array as $key => $value){
                        Log::info($new_array_value['unit'].$new_array_value['data']);
                    }
                }
                $minuteStr = ($minute > 9) ? $minute : ('0' . $minute);

            }
        }
        */
       // Log::info($result_with_formula_array);
        //$result_with_formula_array[$key]=$unit_array_outer;

                $jsonStr=json_encode($result_array);
        $json = json_decode($jsonStr);
        //Log::info($json->{'U08D122'}[7199]->sec);
        //Log::info($json->U09D123->unit);
     //   Log::info($result_array['U08D122']['2014-05-20 00:02:58']['value']);
      //  Log:info(sizeof($result_array));
      // Log::info($result_array);
      //Log::info($jsonStr);
        //Log::info(sizeof($result_array));
        $result_key_array = array();
        foreach($result_times_array as $key => $result_times){
            $new_array_inner = array();
            $new_array_inner['formula']=$str;
            $new_str=$str;
            foreach($result_array as $key2 => $result_unit){
                $new_key=$result_unit[$key]['unit'].$result_unit[$key]['data'];
                $new_str=str_replace($new_key,$result_unit[$key]['value'],$new_str);
                //Log::info(sizeof($result_unit));
                //Log::info(' time '.$key.' unit '.$result_unit[$key]['unit'].' data '.$result_unit[$key]['data'].' value '.$result_unit[$key]['value']);
            }
           // $result_array['U08D122']['2014-05-20 00:02:58']['value']
            $new_array_inner['value']=$new_str;
            $result_key_array[$key]=$new_array_inner;

        }
      Log::info($result_key_array);
        //Log:info($result_key_array['2014-05-20 00:02:59']['formula']);
    }
}