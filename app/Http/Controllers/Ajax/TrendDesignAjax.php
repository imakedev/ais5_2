<?php
/**
 * User: imake
 * Date: 12/11/15
 * Time: 16:35
 */

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \App\Model\MmtrendModel;
use \App\Model\MmnameModel;
use \App\Model\MmpointModel;
use \App\Model\MmcalculationModel;
use Log;
use Illuminate\Support\Facades\Auth;
use \App\Utils\DBUtils;
class TrendDesignAjax extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listMmTrend(Request $request){
        Log::info("Into TrendDesignAjax callAjax");
        //Log::info(request('xx')['yy']);
        $g_data=request('zz');
        $mmnameM = DB::connection(DBUtils::getDBName())->table('mmname_table')->where('ZZ', $g_data)->first();
        $trendDesignsM = DB::connection(DBUtils::getDBName())->table('mmtrend_table as mmtrend ')
          //  ->join('mmname_table as mmname ', 'mmtrend.G', '=', 'mmname.ZZ')
            //   ->join('orders', 'users.id', '=', 'orders.user_id')
            //   ->select('users.*', 'contacts.phone', 'orders.price')
          //  ->select('mmtrend.*', 'mmname.A')
            ->where('mmtrend.G', '=', $g_data)
            ->orderBy('mmtrend.A','ASC')->paginate(100);
          //  ->orderBy('mmtrend.updated_at','DESC')
            //->paginate(10);
       // $data   = array('value' => request('xx').' some data');
       // return response()->json(['name' => 'Abigail', 'state' => 'CA']);
        //return response()->json($trendDesignsM);
        return response()->json(['trendDesignsM'=>$trendDesignsM->toJson(),
            'paging' => $trendDesignsM->render(),
            'mmnameM'=>json_encode($mmnameM)]);
    }

    public function getMmTag(Request $request){
        $key=request('key');


        $mmtagM = DB::connection(DBUtils::getDBName())->table('mmtag_table')->where('A', $key)->first();

        // Log::info("lenth ".sizeof($mmtrendM));
        return response()->json(['mmtagM'=>json_encode($mmtagM)]);
    }
    public function getMmTrend(Request $request){
        $zz_data=request('ZZ');
        $g_data=request('G');
        Log::info("Into getMmTrend callAjax ZZ[".$zz_data."],G[".$g_data."]");

        $mmtrendM = DB::connection(DBUtils::getDBName())->table('mmtrend_table')->where('ZZ', $zz_data)->first();
        $mmnameM =null;
        $mmpointM=null;

        $mmnameM = DB::connection(DBUtils::getDBName())->table('mmname_table')->where('ZZ', $g_data)->first();

        if($mmtrendM!=null) {
            Log::info("H " . $mmtrendM->H);
            $mmpointM = DB::connection(DBUtils::getDBName())->table('mmpoint_table')->where('A', $mmtrendM->H)->first();
        }

       // Log::info("lenth ".sizeof($mmtrendM));
        return response()->json(['mmtrendM'=>json_encode($mmtrendM),
            'mmnameM'=>json_encode($mmnameM),
            'mmpointM'=>json_encode($mmpointM)]);
    }
    public function getMmname(Request $request){
        Log::info("Into getMmname callAjax");
        // do something
        $mmnameM = MmnameModel::on(DBUtils::getDBName())->where('ZZ', request('ZZ'))
           // ->orderBy('name', 'desc')
           // ->take(10)
            ->get();
        //return response()->json(['mmnameM'=>json_encode($mmnameM)]);
        $mmtrend_groups = DB::connection(DBUtils::getDBName())->table('mmtrend_group')->get();

        return response()->json(['mmnameM'=>json_encode($mmnameM),'mmtrend_groups'=>json_encode($mmtrend_groups)]);
    }

    public function postMmTrend(Request $request){
        Log::info("Into postMmTrend callAjax");
        $mode=request("mode");
        $a=request("A");
        $g0=request("G0");
        $g1=request("G1");
        $f=request("F");
        $b=request("B");
        $g=request("G");
        $mmname_zz=request("ZZ");


        $mmnameModel=null;
        Log::info("test->".$request->input('A'));
        if($b=='-1' || $b=='0'){
            $mmpointM = DB::connection(DBUtils::getDBName())->table('mmcalculation_table')->where('A', $a)->first();
        }else {
            $mmpointM = DB::connection(DBUtils::getDBName())->table('mmpoint_table')->where('A', $a)->first();
        }
        $c=null;
        $d=null;
        $mmplants=[];
        $mmplants_d=[];
        if($mmpointM!=null){
            $c=$mmpointM->B;
            if($b=='4'){
                $d=$mmpointM->C4;
            }else if($b=='5'){
                $d=$mmpointM->C5;
            }else if($b=='6'){
                $d=$mmpointM->C6;
            }else if($b=='7'){
                $d=$mmpointM->C7;
            }else if($b=='47'){
                $mmplants=['4','5','6','7'];
                $mmplants_d=[$mmpointM->C4,$mmpointM->C5,$mmpointM->C6,$mmpointM->C7];
            }
            if($b=='-1' || $b=='0'){
                $d=$mmpointM->D;
                $c=$mmpointM->C;
                $b=$mmpointM->B;
               // $f=$mmpointM->E;
            }
        }
        if($mode=='add'){
            if(sizeof($mmplants)>0){
                $maxId = DB::connection(DBUtils::getDBName())->table('mmtrend_table')->where("G",$g)->max('A');
                Log::info("maxId->".$maxId);

                $index=1;
                foreach($mmplants as $mmplant) {
                    $mmtrendModel = new MmtrendModel();
                    $mmtrendModel->setConnection(DBUtils::getDBName());
                    $mmtrendModel->A =$maxId+$index;
                    $mmtrendModel->B =$mmplant;
                    $mmtrendModel->C =$c;
                    $mmtrendModel->D =$mmplants_d[$index-1];
                    $mmtrendModel->E =$f;
                    $mmtrendModel->F0 =$g0;
                    $mmtrendModel->F1 =$g1;
                    $mmtrendModel->G =$g;
                    $mmtrendModel->H =$a;
                    $mmtrendModel->ZZ =$mmname_zz;
                    $mmtrendModel->save();
                    $index=$index+1;
                }
            }else{
                $mmtrendModel = new MmtrendModel();
                $mmtrendModel->setConnection(DBUtils::getDBName());
                $maxId = DB::connection(DBUtils::getDBName())->table('mmtrend_table')->where("G",$g)->max('A');
                Log::info("maxId->".$maxId);
                $mmtrendModel->A =$maxId+1;;

                $mmtrendModel->B =$b;
                $mmtrendModel->C =$c;
                $mmtrendModel->D =$d;
                $mmtrendModel->E =$f;
                $mmtrendModel->F0 =$g0;
                $mmtrendModel->F1 =$g1;
                $mmtrendModel->G =$g;
                $mmtrendModel->H =$a;
                $mmtrendModel->ZZ =$mmname_zz;
                $mmtrendModel->save();
            }


            session()->flash('message', ' Save successfuly.');
        }else{
            $mmtrendModel = MmtrendModel::on(DBUtils::getDBName())->find($mmname_zz);
            $mmtrendModel->B =$b;
            $mmtrendModel->C =$c;
            $mmtrendModel->D =$d;
            $mmtrendModel->E =$f;
            $mmtrendModel->F0 =$g0;
            $mmtrendModel->F1 =$g1;
            $mmtrendModel->G =$g;
            $mmtrendModel->H =$a;
            //$mmtrendModel->ZZ =$mmname_zz;
            $mmtrendModel->save();
            session()->flash('message', ' Update successfuly.');
        }

        return response()->json(['mmtrendM'=>json_encode($mmnameModel)]);

    }

    public function postMmname(Request $request){
        Log::info("Into postMmnam callAjax");
        // do something
        $mode=request("mode");
        $mmname_a=request("A");
        $mmname_b=request("B");
        $mmname_zz=request("ZZ");
        $mmnameModel=null;
        Log::info("test->".$request->input('A'));
        if($mode=='add'){
            $mmnameModel = new MmnameModel();
            $mmnameModel->setConnection(DBUtils::getDBName());
            $mmnameModel->A =$mmname_a;
            if($mmname_b=='9'){
                $mmname_b=Auth::user()->empId;
            }
            $mmnameModel->B =$mmname_b;
            $mmnameModel->save();
            session()->flash('message', ' Save successfuly.');
        }else{
            $mmnameModel = MmnameModel::on(DBUtils::getDBName())->find($mmname_zz);
            $mmnameModel->A =$mmname_a;
            if($mmname_b=='9'){
                $mmname_b=Auth::user()->empId;
            }
            $mmnameModel->B =$mmname_b;
            $mmnameModel->save();
            session()->flash('message', ' Update successfuly.');
        }

        return response()->json(['mmnameM'=>json_encode($mmnameModel)]);
    }
    public function deleteMmname(Request $request){
        $mode=request('mode');
        $mmnameM=null;
        if($mode=='deleteAll'){
            $ids=request('ids');
            foreach($ids as $id) {
                $mmnameM= MmnameModel::on(DBUtils::getDBName())->find($id);
                $mmnameM->delete();
                DB::connection(DBUtils::getDBName())->table('mmtrend_table')->where('G', '=', $id)->delete();

            }

        }else{
            $id=request('ZZ');
            Log::info("deleteMmname [".$id."] x");
            $mmnameM= MmnameModel::on(DBUtils::getDBName())->find($id);
            $mmnameM->delete();
            DB::connection(DBUtils::getDBName())->table('mmtrend_table')->where('G', '=', $id)->delete();
        }
        session()->flash('message', ' Delete successfuly.');
        return response()->json(['mmnameM'=>json_encode($mmnameM)]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function moveTrend(Request $request){
        Log::info("moveTrend");
        $id=request('ZZ');
        $target_group=request('target_group');
        $target_unit=request('target_unit');
        Log::info("ZZ[".$id."],target_group[".$target_group."]
        target_unit[".$target_unit."]");
        /*
       $mmtrendM = MmnameModel::on(DBUtils::getDBName())->where('ZZ', $id)
            ->get();
        */

        $mmtrendM = MmnameModel::on(DBUtils::getDBName())->find($id);
        if(!empty($mmtrendM)){
            // set target group
            if($target_group=='9'){
                $mmtrendM->B=Auth::user()->empId;
            }else{
                $mmtrendM->B=$target_group;
            }
            $mmtrendM->save();
            $mmtrends= MmtrendModel::on(DBUtils::getDBName())->where('G', $id)
                ->get();
            if(!empty($mmtrends) && $target_unit!='0'){
                foreach($mmtrends as $mmtrend) {
                        $mmtrend->B=$target_unit;
                        $mmtrend->save();
                }
            }
        }
        Log::info("mmnameModel ->".$mmtrendM->A);
        return response()->json(['mmtrendM'=>json_encode($mmtrendM)]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function copyTrend(Request $request){
        Log::info("copyTrend");
        $id=request('ZZ');
        $trend_name=request('trend_name');
        $target_group=request('target_group');
        $target_unit=request('target_unit');
        Log::info("ZZ[".$id."],trend_name[".$trend_name."],target_group[".$target_group."]
        target_unit[".$target_unit."]");
        /*
        $mmtrendM = MmnameModel::on(DBUtils::getDBName())->where('ZZ', $id)
           ->get();
           */
        $mmtrendM = MmnameModel::on(DBUtils::getDBName())->find($id);
        if(!empty($mmtrendM)){
            // set target group
            $mmtrendM_new = new MmnameModel();
            $mmtrendM_new->setConnection(DBUtils::getDBName());
            $mmtrendM_new->A=$trend_name;
            if($target_group=='9'){
                $mmtrendM_new->B=Auth::user()->empId;
            }else{
                $mmtrendM_new->B=$target_group;
            }
            $mmtrendM_new->save();
            $mmtrends= MmtrendModel::on(DBUtils::getDBName())->where('G', $id)
                ->get();
            if(!empty($mmtrends) ){
                foreach($mmtrends as $mmtrend) {
                    $mmtrendModel_new=new MmtrendModel();
                    $mmtrendModel_new->setConnection(DBUtils::getDBName());
                    $mmtrendModel_new->A=$mmtrend->A;
                    if($target_unit=='0'){
                        $mmtrendModel_new->B=$mmtrend->B;
                    }else{
                        $mmtrendModel_new->B=$target_unit;
                    }
                    $mmtrendModel_new->C=$mmtrend->C;
                    $mmtrendModel_new->D=$mmtrend->D;
                    $mmtrendModel_new->E=$mmtrend->E;
                    $mmtrendModel_new->F0=$mmtrend->F0;
                    $mmtrendModel_new->F1=$mmtrend->F1;
                    $mmtrendModel_new->H=$mmtrend->H;
                    $mmtrendModel_new->I=$mmtrend->I;
                    $mmtrendModel_new->G=$mmtrendM_new->ZZ;
                    $mmtrendModel_new->save();
                }
            }
        }
        Log::info("mmnameModel ->".$mmtrendM->A);
        return response()->json(['mmtrendM'=>json_encode($mmtrendM)]);
    }

    public function deleteMmtrend(Request $request){
        $mode=request('mode');
        $mmtrendM=null;
        if($mode=='deleteAll'){
            $ids=request('ids');
            foreach($ids as $id) {
                $mmtrendM= MmtrendModel::on(DBUtils::getDBName())->find($id);
                $mmtrendM->delete();
            }

        }else{
            $id=request('ZZ');
            Log::info("deleteMmtrend [".$id."] x");
            $mmtrendM= MmtrendModel::on(DBUtils::getDBName())->find($id);
            $mmtrendM->delete();
        }
        session()->flash('message', ' Delete successfuly.');
        return response()->json(['mmtrendM'=>json_encode($mmtrendM)]);
    }
    public  function searchMmpoint(Request $request){
        $keyword=request('keyword');
        $h_id=request('H');
        $p_id=request('P');
        Log::info("h_id [".$h_id."] ,p_id [".$p_id."]");
        if($p_id=='0' || $p_id=='-1'){
            //$datas = MmcalculationModel::query();
            $datas =DB::connection(DBUtils::getDBName())->table('mmcalculation_table');
            //if (sizeof($keyword)>0) {
               // $datas->where('C','LIKE', "%".$keyword."%");
            $datas->Where(function ($datas) use ($keyword,$p_id){
                    if (sizeof($keyword)>0) {
                        $datas->orWhere('C', 'LIKE', "%$keyword%")
                            ->orWhere('D', 'LIKE', "%$keyword%");
                            //->where('H','=',"'".Auth::user()->empId."'");
                    }


                });
            if($p_id=='0'){
                Log::info("Auth [".Auth::user()->empId."] ");
                $datas->where('H','=',''.Auth::user()->empId.'');

            }

            $lists = $datas->take(9);

            if($h_id!='0'){
                $lists = DB::connection(DBUtils::getDBName())->table('mmcalculation_table')->where('A',$h_id)->union($lists);
            }

        }else{
            $datas = MmpointModel::on(DBUtils::getDBName())->newQuery();
            Log::info("keyword [".$keyword."] ");
            if (sizeof($keyword)>0) {
                $datas->where('B','LIKE', "%".$keyword."%");
            }
            $lists = $datas->take(9);
            if($h_id!='0'){
                $lists = DB::connection(DBUtils::getDBName())->table('mmpoint_table')->where('A',$h_id)->union($lists);
            }
           // $lists =$lists->get();
        }
        $lists =$lists->get();


        //$lists = $datas->orderBy('B','ASC')->take(9)->union($old_mmpoint)->get();
        return response()->json(['mmpointM'=>json_encode($lists)]);
    }
    public  function searchAddPointMmpoint(Request $request){
        $keyword=request('keyword');
       // $h_id=request('H');
        $p_id=request('P');
        if($p_id=='0' || $p_id=='-1'){
            $datas = MmcalculationModel::on(DBUtils::getDBName())->newQuery();
            if (sizeof($keyword)>0) {
                // $datas->where('C','LIKE', "%".$keyword."%");
                $datas= $datas->Where(function ($datas) use ($keyword){
                    $datas->orWhere('C', 'LIKE', "%$keyword%")
                        ->orWhere('D', 'LIKE',"%$keyword%");
                });
            }
            if($p_id=='0'){
                $datas->where('H','=', ''.Auth::user()->empId.'');
            }
            $lists = $datas->take(9);
            /*
            if($h_id!='0'){
                $lists = DB::table('mmcalculation_table')->where('A',$h_id)->union($lists);
            }
            */

        }else{
            $datas = MmpointModel::on(DBUtils::getDBName())->newQuery();
            Log::info("keyword [".$keyword."] ");
            if (sizeof($keyword)>0) {
                $datas->where('B','LIKE', "%".$keyword."%");
            }
            $lists = $datas->take(9);
            /*
            if($h_id!='0'){
                $lists = DB::table('mmpoint_table')->where('A',$h_id)->union($lists);
            }
            */
            // $lists =$lists->get();
        }
        $lists =$lists->get();


        //$lists = $datas->orderBy('B','ASC')->take(9)->union($old_mmpoint)->get();
        return response()->json(['mmpointM'=>json_encode($lists)]);
    }
    public  function doAddPointMmpoint(Request $request){
        $key=request('key');
        // $h_id=request('H');
        $type=request('type');
        $datas=null;
        if($type=='0' || $type=='-1'){
            $datas = MmcalculationModel::on(DBUtils::getDBName())->find($key);


        }else{
            $datas = MmpointModel::on(DBUtils::getDBName())->find($key);
        }
      //  $lists =$datas->get();


        //$lists = $datas->orderBy('B','ASC')->take(9)->union($old_mmpoint)->get();
        return response()->json(['formula'=>json_encode($datas)]);
    }
    public function getMmTrendById(Request $request){
        $zz_data=request('ZZ');
        Log::info("Into getMmTrendById callAjax ZZ[".$zz_data."]");

        $mmtrendM = DB::connection(DBUtils::getDBName())->table('mmtrend_table')->where('ZZ', $zz_data)->first();


        // Log::info("lenth ".sizeof($mmtrendM));
        return response()->json(['mmtrendM'=>json_encode($mmtrendM)]);
    }
    public function mulipleDB(Request $request){

        $account = DB::connection(DBUtils::getDBName())->connection('lportal')->table('Account_')->get();
        Log::info("Into mulipleDB callAjax".$account[0]->name);
        $mmpoint = DB::connection(DBUtils::getDBName())->table('mmpoint_table')->get();
        Log::info("Into mulipleDB callAjax".$mmpoint[0]->A);
        return response()->json(['account'=>json_encode($account),'mmpoint'=>json_encode($mmpoint)]);
    }
}
