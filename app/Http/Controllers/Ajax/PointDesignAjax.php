<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 19/02/2016
 * Time: 12:08
 */

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \App\Model\MmpointModel;
use Log;
use Illuminate\Support\Facades\Auth;
use \App\Utils\DBUtils;
class PointDesignAjax extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getMmPoint(Request $request){
        $key=request('key');


        $mmpointM = DB::connection(DBUtils::getDBName())->table('mmpoint_table')->where('A', $key)->first();

        // Log::info("lenth ".sizeof($mmtrendM));
        return response()->json(['mmpointM'=>json_encode($mmpointM)]);
    }
}