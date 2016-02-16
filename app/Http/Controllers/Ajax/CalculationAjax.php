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
class CalculationAjax extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
                $constant = DB::connection(DBUtils::getDBName())->select('SELECT A,B FROM mmconstant_table where A=\'' . $val["name"] . '\' limit 1');
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
                Log::info($unit);
                // $datau = DB::table('data'.$unit.' order by EvTime desc limit 1');
                $datau = DB::connection(DBUtils::getDBName())->select('SELECT D1 ,EvTime FROM  data' . $unit . '
             order by EvTime desc limit 1');

                $strText1 = json_encode($datau);
                if (!empty($datau)) {
                    Log::info($unit_array[$key]["value"] . 'xx' . $datau[0]->D1);
                    $unit_array[$key]["result"] = $datau[0]->D1;
                }
                Log::info($strText1);
            }
        return response()->json(['constant_array' => json_encode($constant_array),
            'unit_array' => json_encode($unit_array)]);
    }
}