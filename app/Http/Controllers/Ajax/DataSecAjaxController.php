<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 22/02/2016
 * Time: 00:57
 */

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
class DataSecAjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function getSecDataBk(Request $request)
    {
        $root_path='/Users/imake/Desktop/AIS/data/MM';
        //$formula_param=request('formula');
        //$formula_params=request('formula');
        $key_params=request('key');
        $formula_params=request('formulas');
        $startTime_param=request('startTime');
        $endTime_param=request('endTime');
        /*
        $formula_param='(U08D122+U08D122)*U08D123';
        $startTime_param='2014-05-20 00:02:00';
        $endTime_param='2014-05-20 00:02:00';
        */

        $new_array = array();
        foreach ($formula_params as $key_formula_param => $formula_param) {
            //$str = strtoupper($formula_params);
            $str = strtoupper($formula_param);

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
        $folderNameEnd=$vYearEnd.$vMonthEnd.$vDayEnd;

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
                    $minuteStr=($minute>9)?$minute:('0'.$minute);
                    $unit=str_replace("U","",$valueOfArray['unit']);
                    $new_array[$keyOfArray]['time']=$folderNameStart.$hourStr.$minuteStr;
                    $valueOfArray['time']=$folderNameStart.$hourStr.$minuteStr;

                    $url = $root_path.$unit.'/'.$unit.$folderNameStart.'/'.$unit.$folderNameStart.$hourStr.$minuteStr.'.dat';
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
                }
                $index++;
            }
            $index=0;
            $result_array[$keyOfArray]=$minute_array_inner;
        }

        $jsonStr=json_encode($result_array);
        //$json = json_decode($jsonStr);

        $result_key_array = array();
        foreach($result_times_array as $key => $result_times){
            $new_array_inner = array();
            $new_array_inner['formula']=$str;
            $new_str=$str;
            foreach($result_array as $key2 => $result_unit){
                $new_key=$result_unit[$key]['unit'].$result_unit[$key]['data'];
                $new_str=str_replace($new_key,$result_unit[$key]['value'],$new_str);
                //Log::info(' time '.$key.' unit '.$result_unit[$key]['unit'].' data '.$result_unit[$key]['data'].' value '.$result_unit[$key]['value']);
            }
            // $result_array['U08D122']['2014-05-20 00:02:58']['value']
            $new_array_inner['value']=$new_str;
            $result_key_array[$key]=$new_array_inner;

        }
        //Log::info($result_key_array);
        return response()->json(['sources'=>json_encode($result_array),'dataWithTimes'=>json_encode($result_key_array)]);
        //Log:info($result_key_array['2014-05-20 00:02:59']['formula']);
    }
    function getSecData(Request $request)
    {
        $key_params=request('key');
        $formula_params=request('formulas');
        $startTime_param=request('startTime');
        $endTime_param=request('endTime');
        $url_param=request('url');
        $constant_array = array();
        foreach ($formula_params as $key_formula_param => $formula_param) {
            $str = $formula_param;//"U04D1+ U04D2+Enthalpy(U04D2;U04D2)";
            $str = strtoupper($str);
            preg_match_all('/(CONSTANT@[\w]+)/', $str, $matches);
            if (!empty($matches)) {
                $full_constants = $matches[0]; //full constant
                $first_constant = $matches[1];//first constant ()

                foreach ($full_constants as $key => $full_constant) {
                    if (!array_key_exists($full_constant, $constant_array)) {
                        $new_array_constant_inner = array();
                        $new_array_constant_inner['name'] = str_replace("CONSTANT@", "", $first_constant[$key]);
                        $constant = DB::select('SELECT A,B FROM mmconstant_table where A=\'' . $new_array_constant_inner['name'] . '\' limit 1');
                        if (!empty($constant)) {
                            $new_array_constant_inner['value']= $constant[0]->B;
                        }else
                            $new_array_constant_inner['value'] ='';
                        //Log::info('CONSTANT=>'.str_replace("CONSTANT@", "", $first_constant[$key]).' value=>'.$new_array_constant_inner['value']);
                        $constant_array[$full_constant] = $new_array_constant_inner;
                    }
                }
            }
        }
        $url=$url_param;//"http://localhost/";
        $client = new Client(['base_uri' => $url]);
        $key_json=json_encode($key_params);
        $formulas_json=json_encode($formula_params);
        $constants_json=json_encode($constant_array);
        $json_str = "{
            \"key\":".$key_json.",
		    \"formulas\":".$formulas_json.",
		    \"startTime\":\"".$startTime_param."\",
		    \"endTime\":\"".$endTime_param."\",
		    \"constants\":".$constants_json."
        }";
       // Log::info($constants_json);
        $response = $client->request('GET', 'datasec.php', [
            'body' => $json_str

        ]);

        $contents = (string) $response->getBody();
       // Log::info($contents);
        return response()->json(['dataWithTimes'=>$contents]);
    }
    function getSecDataBkForTest(Request $request)
    {
        $root_path='/Users/imake/Desktop/AIS/data/MM';
        //$formula_param=request('formula');
        //$formula_params=request('formula');
        $key_params=request('key');
        $formula_params=request('formulas');
        $startTime_param=request('startTime');
        $endTime_param=request('endTime');
        /*
        $formula_param='(U08D122+U08D122)*U08D123';
        $startTime_param='2014-05-20 00:02:00';
        $endTime_param='2014-05-20 00:02:00';
        */
        $constant_array = array();
        foreach ($formula_params as $key_formula_param => $formula_param) {
            $str = $formula_param;//"U04D1+ U04D2+Enthalpy(U04D2;U04D2)";
            $str = strtoupper($str);
            preg_match_all('/(CONSTANT@[\w]+)/', $str, $matches);
            if (!empty($matches)) {
                $full_constants = $matches[0]; //full constant
                $first_constant = $matches[1];//first constant ()

                foreach ($full_constants as $key => $full_constant) {
                    if (!array_key_exists($full_constant, $constant_array)) {
                        $new_array_constant_inner = array();
                        $new_array_constant_inner['name'] = str_replace("CONSTANT@", "", $first_constant[$key]);
                        $constant = DB::select('SELECT A,B FROM mmconstant_table where A=\'' . $new_array_constant_inner['name'] . '\' limit 1');
                        if (!empty($constant)) {
                            $new_array_constant_inner['value']= $constant[0]->B;
                        }else
                            $new_array_constant_inner['value'] ='';
                        //Log::info('CONSTANT=>'.str_replace("CONSTANT@", "", $first_constant[$key]).' value=>'.$new_array_constant_inner['value']);
                        $constant_array[$full_constant] = $new_array_constant_inner;
                    }
                }
            }
        }
        $new_array = array();
        foreach ($formula_params as $key_formula_param => $formula_param) {
            //$str = strtoupper($formula_params);
            $str = strtoupper($formula_param);
            foreach ($constant_array as $key_constant_param => $constant_value) {
                $str=str_replace('CONSTANT@'.$constant_value['name'], $constant_value['value'], $str);
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
        $folderNameEnd=$vYearEnd.$vMonthEnd.$vDayEnd;

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
                    $minuteStr=($minute>9)?$minute:('0'.$minute);
                    $unit=str_replace("U","",$valueOfArray['unit']);
                    $new_array[$keyOfArray]['time']=$folderNameStart.$hourStr.$minuteStr;
                    $valueOfArray['time']=$folderNameStart.$hourStr.$minuteStr;

                    $url = $root_path.$unit.'/'.$unit.$folderNameStart.'/'.$unit.$folderNameStart.$hourStr.$minuteStr.'.dat';
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
        Log::info($result_key_array);
        return response()->json(['sources'=>json_encode($result_array),'dataWithTimes'=>json_encode($result_key_array)]);
        //Log:info($result_key_array['2014-05-20 00:02:59']['formula']);
    }
}