<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 12/02/2016
 * Time: 13:03
 */

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\Utils\DBUtils;
use GuzzleHttp\Client;
use Session;
class CalculationAjax extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function extractFormulaByTrend(Request $request)
    {

        $sess_emp_id= Auth::user()->id;
        $user_mmplant= Session::get('user_mmplant');
        $calID="";

        $constant_array = request('constant_array');
        if (!empty($constant_array))
            foreach ($constant_array as $key => $val) {
                Log::info(" key [" . $key . "] value [" . $val["name"] . "]");

                $constant = DB::connection(DBUtils::getDBName())->select('SELECT A,B FROM mmconstant_table where A=\'' . $val["name"] . '\' limit 1');
                if (!empty($constant)) {
                    $constant_array[$key]["result"] = $constant[0]->B;
                }
            }
        $unit_array = request('unit_array');

        if (!empty($unit_array))
            foreach ($unit_array as $key => $val) {
                $calID=$val["calID"];
                $trendID=$val["trendID"];

                Log::info(" key [" . $key . "] unit [" . $val["unit"] . "] value [" . $val["value"] . "]");
                // to lower case
                $unit = strtolower($val["unit"]);
                $value = strtoupper($val["value"]);
                Log::info($unit);
                // $datau = DB::table('data'.$unit.' order by EvTime desc limit 1');
                $datau = DB::connection(DBUtils::getDBName())->select('
                        SELECT EvTime, '.$value.' as D  FROM  data' . $unit . '
                        WHERE EvTime between "'.$val["startTime"].'" and "'.$val["endTime"].'"
                        order by EvTime asc  ');

                $strText1 = json_encode($datau);
                if (!empty($datau)) {
                    Log::info($unit_array[$key]["value"] . 'xx' . $datau[0]->D);
                   // $unit_array[$key]["result"] = $datau[0]->D1;

                   // $unit_array[$key]["data"] = "[[\"2014-05-01 00:00:01\",2255".$key."],[\"2014-05-01 00:00:02\",2.22".$key."]]";
                    $dataForCal="";
                    $dataForCal.="[";
                    $i=0;
                    foreach ($datau as $rs) {
                        if($i==0){
                            $dataForCal.="[\"$rs->EvTime\",$rs->D]";
                        }else{
                            $dataForCal.=",[\"$rs->EvTime\",$rs->D]";
                        }
                        $i++;
                    }
                    $dataForCal.="]";
                    $unit_array[$key]["data"]=$dataForCal;

                    //$unit_array[$key]["result"] = $datau[0]->D;
                }
                Log::info($strText1);
            }
        //print_r($unit_array);
        /*
        return response()->json(['constant_array' => json_encode($constant_array),
                'unit_array' => json_encode($unit_array)]);


       */


        $jsonData="{\"constant_array\":".json_encode($constant_array).",\"unit_array\":".json_encode($unit_array)."}";
        /*create
         *  cal file start*/
        //create floader by user


        $pathCal = "webservice/fileCal/$sess_emp_id/";
        if(!is_dir($pathCal)){
            umask(0);
            mkdir($pathCal,0777);

        }
                $strFileName = "webservice/fileCal/$sess_emp_id/cal_minute_".$trendID."_".$calID.".txt";

                $objCreate = fopen($strFileName, 'w');
                if($objCreate)
                {
                    //write flie here start.


                    $objFopen = fopen($strFileName, 'w');
                    $strText1 =$jsonData;
                    fwrite($objFopen, $strText1);
                    if($objFopen)
                    {
                        echo '["createJsonSuccess"]';
                    }
                    else
                    {
                        echo '["error"]';
                    }


                    fclose($objFopen);
                    //write flie here end.
                }else{
                    echo '["File_Not_Create"]';
                }


        /*create cal file end*/


    }


    public function readExtractFormulaByTrend($trendID,$calID){

        Log::info("Into readExtractFormulaByTrend");

        $sess_emp_id= Auth::user()->id;
        $user_mmplant= Session::get('user_mmplant');
        $strFileName = "webservice/fileCal/$sess_emp_id/cal_minute_".$trendID."_".$calID.".txt";
        //$strFileName = "webservice/fileTrend/trendJsonMinuteu-$trendID-$sess_emp_id-$user_mmplant.txt";

        $objFopen = fopen($strFileName, 'r');
        if ($objFopen) {
            while (!feof($objFopen)) {
                $file = fgets($objFopen, 4096);
                echo $file;
            }
            fclose($objFopen);
        }


        //http://localhost:9952/ajax/calculation/readExtractFormulaByTrend/88/c102
    }


    public function extractFormula(Request $request)
    {
        /*
            for ($i = 0; $i < count($array); ++$i) {
                print $array[$i];
            }
            foreach($array as $val) {
                print $val;
            }

            foreach ($array as $key => $val) {
                print "$key = $val\n";
            }
         */
        $constant_array = request('constant_array');
        if (!empty($constant_array))
            foreach ($constant_array as $key => $val) {
                Log::info(" key [" . $key . "] value [" . $val["name"] . "]");
                //  $constant = DB::connection(DBUtils::getDBName())->select('SELECT A,B FROM mmconstant_table where A=\'' . $val["name"] . '\' limit 1');
                $constant = DB::select('SELECT A,B FROM mmconstant_table where A=\'' . $val["name"] . '\' limit 1');
                if (!empty($constant)) {
                    $constant_array[$key]["result"] = $constant[0]->B;
                }
            }
        $unit_array = request('unit_array');
        if (!empty($unit_array))
            foreach ($unit_array as $key => $val) {
                Log::info(" key [" . $key . "] unit [" . $val["unit"] . "] value [" . $val["value"] . "]");
                // to lower case
                $unit = strtolower($val["unit"]);
                $value = strtoupper($val["value"]);
                Log::info($unit);
                // $datau = DB::table('data'.$unit.' order by EvTime desc limit 1');
                // $datau = DB::connection(DBUtils::getDBName())->select('SELECT D1 ,EvTime FROM  data' . $unit . '
                $datau = DB::connection(DBUtils::getDBName())->select('SELECT  ' . $value . ' as D  FROM  data' . $unit . '
             order by EvTime desc limit 1');

                $strText1 = json_encode($datau);
                if (!empty($datau)) {
                    Log::info($unit_array[$key]["value"] . 'xx' . $datau[0]->D);
                    $unit_array[$key]["result"] = $datau[0]->D;
                }
                Log::info($strText1);
            }
        return response()->json(['constant_array' => json_encode($constant_array),
            'unit_array' => json_encode($unit_array)]);
    }

    public function postFormula(Request $request)
    {
       
        $sess_emp_id= Auth::user()->id;
        $user_mmplant= Session::get('user_mmplant');
        $trendID=request('trendID');
        
        
        $url = env('CALCULATION_HOST', 'http://localhost:3000/v1/');
        $json_str = "{
  \"formula\" : [ {
    \"key\" : \"1\",
    \"value\" : \"(100/3)*20\"
  }, {
    \"key\" : \"2\",
    \"value\" : \"(300/3)*20\"
  } ]
}";

       // Log::info(sizeof(request('formula2')));

        $formulas_init = array();

        if(!empty(request('formula')))
           
        foreach (request('formula') as $key => $val) {
            $formulas = array();
            //$formulas["key"] = $key;

           // $trendID =  $val["trendID"];
            $formulas["key"] =  $val["key"];
            $formulas["value"] = $val["value"];
            $formulas["time"] = $val["time"];//$key;
            array_push($formulas_init, $formulas);
        }
        //Log::info(sizeof($formulas_init));
        $jsonStr = json_encode($formulas_init);


        $json_str = "{
  \"formula\" : $jsonStr
}";
        Log::info($json_str);
        // Create a client with a base URI
        $client = new Client(['base_uri' => $url]);
        /*
// Send a request to https://foo.com/api/test
        $response = $client->request('GET', 'test');
// Send a request to https://foo.com/root
        $response = $client->request('GET', '/root');
        */
        // Send a request to https://foo.com/api/test
        $response = $client->request('POST', 'calculation', [
            'body' => $json_str
        ]);
       //  $data_result=$response->getBody();
        //return $data_result;

        $contents = (string) $response->getBody();
        $contentsObj=json_decode($contents);
        //Log::info($contents);

        $formulaObjList=$contentsObj->formula;
       // Log::info($formulaObjList);
        $result_plot_array = array();
        foreach ($formulaObjList as $key => $formulaObj) {
            if (!array_key_exists($formulaObj->{'time'}, $result_plot_array)) {
                $new_result_plot_inner = array();
                $new_result_plot_inner['EvTime'] =$formulaObj->{'time'};
        
                if($formulaObj->{'status'}=='OK'){
                    $new_result_plot_inner[$formulaObj->{'key'}] =$formulaObj->{'result'};
                }else{
                    $new_result_plot_inner[$formulaObj->{'key'}] =0;
                }
        
                //$new_result_plot_inner[$formulaObj->{'key'}.'-status'] =$formulaObj->{'status'};
                $result_plot_array[$formulaObj->{'time'}] = $new_result_plot_inner;
            }else{
                if($formulaObj->{'status'}=='OK'){
        
                    $result_plot_array[$formulaObj->{'time'}][$formulaObj->{'key'}]=$formulaObj->{'result'};
                }else{
                    $result_plot_array[$formulaObj->{'time'}][$formulaObj->{'key'}]=0;
                    //$result_plot_array[$formulaObj->{'time'}][$formulaObj->{'key'}.'-status']=$formulaObj->{'status'};
                }
            }
        }

       // return json_encode($result_plot_array);

        $strFileName = "webservice/fileTrend/trendJson-second-$trendID-$sess_emp_id-$user_mmplant.txt";
        $objCreate = fopen($strFileName, 'w');
        if($objCreate)
        {
            $objFopen = fopen($strFileName, 'w');
            $strText1 = json_encode($result_plot_array);
            //echo "strText1=".$strText1;
            fwrite($objFopen, $strText1);
            if($objFopen)
            {
                echo '["createJsonSuccess"]';
            }
            else
            {
                echo '["error"]';
            }
            fclose($objFopen);
        
        }else{
            echo "File Not Create.";
        }
       

     // return json_encode($result_plot_array);
    }
    public function readDataSecond($trendID){
    
        Log::info("Into readDataMinuteu");
    
        $sess_emp_id= Auth::user()->id;
        $user_mmplant= Session::get('user_mmplant');
    
    
        
        $strFileName = "webservice/fileTrend/trendJson-second-$trendID-$sess_emp_id-$user_mmplant.txt";
        //$strFileName = "webservice/fileTrend/trendJson-second--$sess_emp_id-$user_mmplant.txt";
        
        $objFopen = fopen($strFileName, 'r');
        if ($objFopen) {
            while (!feof($objFopen)) {
                $file = fgets($objFopen, 4096);
                echo $file;
            }
            fclose($objFopen);
        }
    
        //http://localhost:9952/ajax/readDataSecond/88
    }

    public function executeCalculationBK()
    {
        /*
        key:"88-c102"

        startTime:"2014-05-01 00:01:00"

        endTime:"2014-05-01 00:50:00"

        scaleType:'minute'

        server:’47’

        value:"U04D1+ U04D2+Enthalpy(U04D2;U04D2)"
        */
        $key_param = request('key');
        $startTime_param = request('startTime');
        $endTime_param = request('endTime');
        $scaleType_param = request('scaleType');
        $server_param = request('server');
        $value_param = request('value');
        Log::info("value_param ".$value_param[0]);
        $str = $value_param[0];//"U04D1+ U04D2+Enthalpy(U04D2;U04D2)";
        $str = str_replace(";", ":", $str);
        $str = strtoupper($str);
        preg_match_all('/(U[0-9]{1,2})(D[0-9]{1,4})/', $str, $matches);

        $fomula_array = array();
        if (!empty($matches)) {
            $full_formats = $matches[0]; //full format
            $first_groups = $matches[1];//first group (U0x)
            $second_groups = $matches[2];//second group (Dyyy)
            foreach ($full_formats as $key => $full_format) {
                if (!array_key_exists($full_format, $fomula_array)) {
                    $new_array_inner = array();
                    $new_array_inner['unit'] = $first_groups[$key];
                    $new_array_inner['data'] = $second_groups[$key];
                    $new_array_inner['time'] = '';
                    $new_array_inner['value'] = '';
                    $fomula_array[$full_format] = $new_array_inner;
                }
            }
        }
        // Log::info($fomula_array);
        $groupby = "";
        $data_table = "";
        if ($scaleType_param == 'minute') {
            $data_table = "data";
        } else if ($scaleType_param == 'hour') {
            $data_table = "datahr";
        }
        if ($scaleType_param == 'day') {
            $data_table = "dataday";
        }
        if ($scaleType_param == 'month') {
            $data_table = "dataday";
            $groupby = " group by month(evTime) ";
        }
        $result_array = array();
        $result_key_time_array = array();
        foreach ($fomula_array as $key => $fomula) {
            $data_str = $fomula["data"];
            if ($scaleType_param == 'month') {
                $data_str = "avg(" . $fomula["data"] . ")";
            }
            /*
            $sql = " select evTime , " . $data_str . " as data  from ais_db." . $data_table . strtolower($fomula["unit"]) .
                " where evTime between '" . $startTime_param . "' " .
                " and '" . $endTime_param . "' " . $groupby;
            */
            $sql = " select evTime , " . $data_str . " as data  from " . $data_table . strtolower($fomula["unit"]) .
                " where evTime between '" . $startTime_param . "' " .
                " and '" . $endTime_param . "' " . $groupby;
            //$lists = DB::connection('mysql')->select($sql);
            $lists = DB::connection(DBUtils::getDBName())->select($sql);
            // Log::info($sql);
            //Log::info($lists);
            $lists_str = json_encode($lists);
            foreach ($lists as $key2 => $result) {
                $new_array_result_inner = array();
                $new_array_result_inner['data'] = $result->data;
                $result_array[$result->evTime . "|" . $key] = $new_array_result_inner;
                $result_key_time_array[$result->evTime] = $result->evTime;
                // Log::info("key2[".$key2."]->".$result->evTime);
            }
            //Log::info($lists_str);
        }
        // Log::info($result_array);
        // Log::info(sizeof($result_array));
        //  Log::info(json_encode($result_key_time_array));
        // Log::info(sizeof($result_key_time_array));
        // Log::info($result_array['2014-05-01 00:00:00|U04D123']['data']);

        $result_final_array = array();
        $index = 0;
        foreach ($result_key_time_array as $key_time => $result_key_time) {
            $new_data = $str;
            foreach ($fomula_array as $key_fomula => $fomula) {
                $key = $key_time . "|" . $key_fomula;
                // Log::info($key);
                //Log::info($result_array['2014-05-01 00:00:00|U04D123']['data']);
                // Log::info("[.$key_time."|".$key_fomula.]".$result_array[$key_time."|".$key_fomula]['data']);
                $new_data = str_replace($key_fomula, $result_array[$key]['data'], $new_data);
                // Log::info($result_array[$key]['data']);
            }
            $new_data = str_replace(" ", "", $new_data);
            $new_data = str_replace(":", ",", $new_data);
            $new_data = strtolower($new_data);
            $new_array_result_final_inner = array();
            $new_array_result_final_inner['key'] = $index . "-" . $key_param;
            $new_array_result_final_inner['value'] = $new_data;
            $new_array_result_final_inner['result'] = "";
            $new_array_result_final_inner['time'] = $key_time;
            //$result_final_array[$key_time]=$new_array_result_final_inner;
            array_push($result_final_array, $new_array_result_final_inner);
            $index++;
        }
        $result_final_json = json_encode($result_final_array);
        //Log::info($result_final_json);
        //$result_final_json=json_encode($result_final_array);
        $url = env('CALCULATION_HOST', 'http://localhost:3000/v1/');
        $json_str = "{
                \"formula\" :$result_final_json
        }";

        // Create a client with a base URI
        $client = new Client(['base_uri' => $url]);
        $response = $client->request('POST', 'calculation', [
            'body' => $json_str
        ]);
        $data_result = $response->getBody();
        Log::info($data_result);
        return $data_result;
    }
    public function executeCalculation()
    {
        /*
        key:"88-c102"

        startTime:"2014-05-01 00:01:00"

        endTime:"2014-05-01 00:50:00"

        scaleType:'minute'

        server:’47’

        value:"U04D1+ U04D2+Enthalpy(U04D2;U04D2)"
        */
        $key_params = request('key');
        $trendID=request('trendID');;
        $startTime_param = request('startTime');
        $endTime_param = request('endTime');
        $scaleType_param = request('scaleType');
        $server_param = request('server');
        $formulas_params = request('formulas');
        $constant_array = array();
        foreach ($formulas_params as $key_formula_param => $formulas_param) {
            $str = $formulas_param;//"U04D1+ U04D2+Enthalpy(U04D2;U04D2)";
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
        $sess_emp_id= Auth::user()->id;
        $user_mmplant= Session::get('user_mmplant');

        //Log::info("value_param ".$formulas_params[0]);
        $fomula_array = array();
        foreach ($formulas_params as $key_formula_param => $formulas_param) {
            $str = $formulas_param;//"U04D1+ U04D2+Enthalpy(U04D2;U04D2)";
            $str = str_replace(";", ":", $str);
            $str = strtoupper($str);

            foreach ($constant_array as $key_constant_param => $constant_value) {
                $str=str_replace('CONSTANT@'.$constant_value['name'], $constant_value['value'], $str);
               // Log::info('CONSTANT2=>'. $constant_value['name'].' value=>'.$constant_value['value']);
            }
            // udate formula_param
            $formulas_params[$key_formula_param]=$str;
            preg_match_all('/(U[0-9]{1,2})(D[0-9]{1,4})/', $str, $matches);


            if (!empty($matches)) {
                $full_formats = $matches[0]; //full format
                $first_groups = $matches[1];//first group (U0x)
                $second_groups = $matches[2];//second group (Dyyy)
                foreach ($full_formats as $key => $full_format) {
                    if (!array_key_exists($full_format, $fomula_array)) {
                        $new_array_inner = array();
                        $new_array_inner['unit'] = $first_groups[$key];
                        $new_array_inner['data'] = $second_groups[$key];
                        $new_array_inner['time'] = '';
                        $new_array_inner['value'] = '';
                        $fomula_array[$full_format] = $new_array_inner;
                    }
                }
            }
        }

        // Log::info($fomula_array);
        $groupby = "";
        $data_table = "";
        if ($scaleType_param == 'minute') {
            $data_table = "data";
        } else if ($scaleType_param == 'hour') {
            $data_table = "datahr";
        }
        if ($scaleType_param == 'day') {
            $data_table = "dataday";
        }
        if ($scaleType_param == 'month') {
            $data_table = "dataday";
            $groupby = " group by month(evTime) ";
        }
        $result_array = array();
        $result_key_time_array = array();
        foreach ($fomula_array as $key => $fomula) {
            $data_str = $fomula["data"];
            if ($scaleType_param == 'month') {
                $data_str = "avg(" . $fomula["data"] . ")";
            }
            /*
            $sql = " select evTime , " . $data_str . " as data  from ais_db." . $data_table . strtolower($fomula["unit"]) .
                " where evTime between '" . $startTime_param . "' " .
                " and '" . $endTime_param . "' " . $groupby;
            */
            $sql = " select evTime , " . $data_str . " as data  from " . $data_table . strtolower($fomula["unit"]) .
                " where evTime between '" . $startTime_param . "' " .
                " and '" . $endTime_param . "' " . $groupby;
            //$lists = DB::connection('mysql')->select($sql);
            $lists = DB::connection(DBUtils::getDBName())->select($sql);
            // Log::info($sql);
            //Log::info($lists);
            $lists_str = json_encode($lists);
            foreach ($lists as $key2 => $result) {
                $new_array_result_inner = array();
                $new_array_result_inner['data'] = $result->data;
                $result_array[$result->evTime . "|" . $key] = $new_array_result_inner;
                $result_key_time_array[$result->evTime] = $result->evTime;
                // Log::info("key2[".$key2."]->".$result->evTime);
            }
            //Log::info($lists_str);
        }
        // Log::info($result_array);
        // Log::info(sizeof($result_array));
        //  Log::info(json_encode($result_key_time_array));
        // Log::info(sizeof($result_key_time_array));
        // Log::info($result_array['2014-05-01 00:00:00|U04D123']['data']);

        $result_final_array = array();
        $index = 0;
        foreach ($result_key_time_array as $key_time => $result_key_time) {
            foreach ($formulas_params as $key_p => $formulas_param) {
                $new_data = $formulas_param;//$str;
                foreach ($fomula_array as $key_fomula => $fomula) {
                    $key = $key_time . "|" . $key_fomula;
                    // Log::info($key);
                    //Log::info($result_array['2014-05-01 00:00:00|U04D123']['data']);
                    // Log::info("[.$key_time."|".$key_fomula.]".$result_array[$key_time."|".$key_fomula]['data']);
                    $new_data = str_replace($key_fomula, $result_array[$key]['data'], $new_data);
                    // Log::info($result_array[$key]['data']);
                }
                $new_data = str_replace(" ", "", $new_data);

                $new_data = str_replace(":", ",", $new_data);
                $new_data = strtolower($new_data);
                Log::info($new_data);
                $new_array_result_final_inner = array();
             //   $new_array_result_final_inner['key'] = $index . "-" . $key_param;
               // Log::info("key_p=>".$key_p);
                $new_array_result_final_inner['key'] =$key_params[$key_p];
                $new_array_result_final_inner['value'] = $new_data;
                $new_array_result_final_inner['result'] = "";
                $new_array_result_final_inner['time'] = $key_time;
                //$result_final_array[$key_time]=$new_array_result_final_inner;
                array_push($result_final_array, $new_array_result_final_inner);
                $index++;
            }

        }
        $result_final_json = json_encode($result_final_array);
        //Log::info($result_final_json);
        //$result_final_json=json_encode($result_final_array);
        //$url = env('CALCULATION_HOST', 'http://localhost:3000/v1/');
        $url = env('CALCULATION_HOST', 'http://10.249.99.107/steamtable/rest/calculation');
        $json_str = "{
                \"formula\" :$result_final_json
        }";
        //Log::info("xx=>".$json_str);
        // Create a client with a base URI
        $client = new Client(['base_uri' => $url]);
        $response = $client->request('POST', 'calculation', [
            'body' => $json_str
        ]);
        $data_result = $response->getBody();


        // Log::info($xxx->formula[0]->{'key'}); // ok
     //   Log::info($data_result['formula']); // ok
        $contents = (string) $response->getBody();
        $contentsObj=json_decode($contents);
        Log::info($contents);

        $formulaObjList=$contentsObj->formula;
        Log::info($formulaObjList);
        $result_plot_array = array();
        foreach ($formulaObjList as $key => $formulaObj) {
            if (!array_key_exists($formulaObj->{'time'}, $result_plot_array)) {
                $new_result_plot_inner = array();
                $new_result_plot_inner['EvTime'] =$formulaObj->{'time'};
                
                if($formulaObj->{'status'}=='OK'){
                    $new_result_plot_inner[$formulaObj->{'key'}] =$formulaObj->{'result'};
                }else{
                    $new_result_plot_inner[$formulaObj->{'key'}] =0;
                }
                
                //$new_result_plot_inner[$formulaObj->{'key'}.'-status'] =$formulaObj->{'status'};
                $result_plot_array[$formulaObj->{'time'}] = $new_result_plot_inner;
            }else{
                if($formulaObj->{'status'}=='OK'){
                    
                    $result_plot_array[$formulaObj->{'time'}][$formulaObj->{'key'}]=$formulaObj->{'result'};
                }else{
                    $result_plot_array[$formulaObj->{'time'}][$formulaObj->{'key'}]=0;
                //$result_plot_array[$formulaObj->{'time'}][$formulaObj->{'key'}.'-status']=$formulaObj->{'status'};
                }
            }
        }
       // Log::info(json_encode($result_plot_array));
        //return $data_result;
        //return json_encode($result_plot_array);
        //$scaleType_param = request('scaleType');
        //$server_param = request('server');

        $strFileName = "webservice/fileTrend/trendJson-$scaleType_param-$trendID-$sess_emp_id-$user_mmplant.txt";
        $objCreate = fopen($strFileName, 'w');
        if($objCreate)
        {
            $objFopen = fopen($strFileName, 'w');
            $strText1 = json_encode($result_plot_array);
            //echo "strText1=".$strText1;
            fwrite($objFopen, $strText1);
            if($objFopen)
            {
                echo '["createJsonSuccess"]';
            }
            else
            {
                echo '["error"]';
            }
            fclose($objFopen);

        }else{
            echo "File Not Create.";
        }

        //return json_encode($result_plot_array);
    }

    public function readData($scaleType,$trendID){

        Log::info("Into readDataMinuteu");

        $sess_emp_id= Auth::user()->id;
        $user_mmplant= Session::get('user_mmplant');


        $strFileName = "webservice/fileTrend/trendJson-$scaleType-$trendID-$sess_emp_id-$user_mmplant.txt";
        $objFopen = fopen($strFileName, 'r');
        if ($objFopen) {
            while (!feof($objFopen)) {
                $file = fgets($objFopen, 4096);
                echo $file;
            }
            fclose($objFopen);
        }
    }
}