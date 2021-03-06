<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 07/02/2016
 * Time: 16:37
 */

namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use Illuminate\Support\Facades\Auth;
use \App\Model\MmConstantModel;
use Illuminate\Support\Facades\DB;
use \App\Utils\DBUtils;
class ConstantAjax extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function get(Request $request){
        $kk_id=request('kk_id');
        //$mmConstantM = MmConstantModel::on(DBUtils::getDBName())->find($kk_id);
        $mmConstantM = MmConstantModel::find($kk_id);
        return response()->json(['constantM'=>json_encode($mmConstantM)]);
    }
    public  function delete(Request $request){
         $kk_id=request('kk_id');
         //MmConstantModel::on(DBUtils::getDBName())->find($kk_id)->delete();
        MmConstantModel::find($kk_id)->delete();
        return response()->json(['kk_id'=>$kk_id]);
    }

    public  function search(Request $request){
      //  $keyword=request('keyword');
       // $h_id=request('H');
        $constantType=request('constantType');
        Log::info("Into search constantType [".$constantType."]");
        //$datas = MmConstantModel::query();
        $lists = null;
       // $lists=null;
        if($constantType=='0') { //my constant
            Log::info("Into xxxx [".$constantType."],empId[".Auth::user()->empId."]");
            //$datas= $datas->where('C','=', "'".Auth::user()->empId."'");
           // $lists->where('C','=', "'".Auth::user()->empId."'");
            //$lists=DB::connection(DBUtils::getDBName())->table('mmconstant_table')->where('C','=',''.Auth::user()->empId.'')->get();
            $lists=DB::table('mmconstant_table')->where('C','=',''.Auth::user()->empId.'')->get();
            //$lists=$lists->get();
        }else if($constantType=='-1'){ // standard
            Log::info("Into yyy [".$constantType."]");
            //$lists=DB::connection(DBUtils::getDBName())->table('mmconstant_table');
            $lists=DB::table('mmconstant_table');
            $user_admins = DB::table('mmemployee_table')->where('D0','>=',254)->get();
            if(!empty($user_admins)) {
                $index=0;
                $new_array = array();
                foreach ($user_admins as $user_admin) {
                    $new_array[$index]=$user_admin->A;
                    $index++;
                }
                $lists= $lists->where('C','<>',''.Auth::user()->empId.'')
                    ->whereIn('C', $new_array)->get();
            }

        }else{//all
            //$lists=DB::connection(DBUtils::getDBName())->table('mmconstant_table')->get();
            $lists=DB::table('mmconstant_table')->get();
        }

        //$lists = $datas->orderBy('B','ASC')->take(9)->union($old_mmpoint)->get();
        return response()->json(['constantM'=>json_encode($lists)]);
    }
    public function post(Request $request)
    {
        $id = $request->input('ZZ');
        $mmConstantM=null;
            if(!empty($id)){
                //$mmConstantM = MmConstantModel::on(DBUtils::getDBName())->find($id);
                $mmConstantM = MmConstantModel::find($id);
                $mmConstantM->A = $request->input('A');
                $mmConstantM->B = $request->input('B');

                $mmConstantM->save();
                session()->flash('message', ' Update successfuly.');
            }else{

                $mmConstantM = new MmConstantModel();
               // $mmConstantM->setConnection(DBUtils::getDBName());
                $mmConstantM->A = $request->input('A');
                $mmConstantM->B = $request->input('B');
                $mmConstantM->C = Auth::user()->empId;
                $mmConstantM->save();
                session()->flash('message', ' Save successfuly.');
            }
        return response()->json(['constantM'=>json_encode($mmConstantM)]);
    }

}