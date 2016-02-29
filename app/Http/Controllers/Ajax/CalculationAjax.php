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
                 $datau = DB::connection(DBUtils::getDBName())->select('SELECT  '.$value.' as D  FROM  data' . $unit . '
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
}