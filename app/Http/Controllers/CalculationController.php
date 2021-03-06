<?php
/**
 * User: imake
 * Date: 08/01/2016
 * Time: 13:37
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
class CalculationController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function search(){
        $search = Input::get('calculationKeySearch');
        $sortBy = Input::get('sortBy');
        $orderBy= Input::get('orderBy');
        $calculationSelection=Input::get('calculationSelection');

        if(empty($calculationSelection)){
            $calculationSelection='1';
        }

        $datas = MmcalculationModel::on(DBUtils::getDBName())->newQuery();
        if(Input::has('page')){ // paging
            Log::info("into paging");
            $search = session()->get('calculation_keySearch');
            $sortBy = session()->get('sortBy');
            $orderBy= session()->get('orderBy');
            $calculationSelection=Input::get('calculation_selection');
        }
        if(!empty($search)){
            $datas= $datas->Where(function ($datas) use ($search){
                $datas->orWhere('B', 'LIKE', "%$search%")
                    ->orWhere('C', 'LIKE', "%$search%")
                    ->orWhere('D', 'LIKE', "%$search%");
            });
        }
        /*  */
        if(!empty($calculationSelection)){
            if($calculationSelection=='1'){
                $datas=$datas->where('H', '=',  session()->get('user_empId'));
            }else   if($calculationSelection=='2'){
                $datas=$datas->where('H', '!=', session()->get('user_empId'));
            }
        }

        if(!empty($sortBy) && !empty($orderBy)){
            $datas=$datas->orderBy($sortBy,$orderBy);
        }
        session()->put('sortBy',$sortBy);
        session()->put('orderBy',$orderBy);
        session()->put('calculation_keySearch',$search);
        session()->put('calculation_selection',$calculationSelection);

        /*
        $datas = MmcalculationModel::query();
        $calculationSelection=Input::get('calculationSelection');
        $calculationKeySearch=Input::get('calculationKeySearch');
        Log::info("xx->".Input::get('calculationSelection'));
        $queryString=null;
        if(Input::has('page')){ // paging
            Log::info("into paging xx");
            $queryString = session()->get('calculation_keySearch');

        }else{
            if (Input::has('calculationKeySearch')) {
                $queryString = Input::get('calculationKeySearch');
                session()->put('calculation_keySearch',$calculationKeySearch);
            }
            if(!empty($calculationSelection)){
                session()->put('calculation_selection',$calculationSelection);
            }
            session()->put('calculation_keySearch',$queryString);
            session()->put('calculation_selection',$calculationSelection);
        }
        $haveWhere=false;
        if(!empty($queryString)) {

            $datas = $datas->orWhere('B', 'LIKE', "%$queryString%")
                ->orWhere('C', 'LIKE', "%$queryString%")
                ->orWhere('D', 'LIKE', "%$queryString%");

            $haveWhere = true;

        }
        */

        //$datas=$datas->orderBy('updated_at','DESC')->paginate(10);
        $datas=$datas->paginate(10);
        return view('ais/design_calculation', ['lists'=>$datas]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        Log::info("Into index");


        return view('ais/design_trend');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cal_a = $request->input('cal_a');
        Log::info("store [".$cal_a."] ");
        $cal_b = $request->input('cal_slelect_b');
        $cal_c = $request->input('cal_c');
        $cal_d = $request->input('cal_d');
        $cal_e = $request->input('cal_slelect_e');
        $cal_f0 = $request->input('cal_f0');
        $cal_f1 = $request->input('cal_f1');
        $cal_g = $request->input('cal_g');
        $cal_h = $request->input('cal_h');
        $cal_g2 = Input::get('cal_g');
        $cal_messages='';
        Log::info(" cal_g [".$cal_g."] ");
        Log::info(" cal_g2 [".$cal_g2."] ");

        $mmcalculation=null;
        if($cal_a!=null && $cal_a!='0') {
            $mmcalculation = MmcalculationModel::on(DBUtils::getDBName())->find($cal_a);
            $cal_messages= 'Update successfuly.';
            $mmcalculation->H = $cal_h;
        }else{
            $mmcalculation = new MmcalculationModel();
            $mmcalculation->setConnection(DBUtils::getDBName());
            $cal_messages= 'Save successfuly.';
            $mmcalculation->H = Auth::user()->empId;
        }
        $mmcalculation->B = $cal_b;
        $mmcalculation->C = $cal_c;
        $mmcalculation->D = $cal_d;
        $mmcalculation->E = $cal_e;
        $mmcalculation->F0 = $cal_f0;
        $mmcalculation->F1 = $cal_f1;
        $mmcalculation->G = $cal_g;

        $mmcalculation->save();
        session()->flash('message', $cal_messages);
        return redirect('ais/formCalculation/'.$mmcalculation->A);
       // return view('ais.form_calculation', ['mmcalculation'=>$mmcalculation]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info("edit [" . $id . "] ");
        $mode='EDIT';
        $mmcalculation = MmcalculationModel::on(DBUtils::getDBName())->find($id);
        if (empty($mmcalculation)){
            $mmcalculation = new MmcalculationModel();
            $mmcalculation->setConnection(DBUtils::getDBName());
            $mmcalculation->A='0';
            $mode='ADD';
        }
        return view('ais.form_calculation', ['mmcalculation'=>$mmcalculation,'mode'=>$mode]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cloneCalculation($id)
    {
        Log::info("edit [" . $id . "] ");
        $mode='EDIT';
        $mmcalculation = MmcalculationModel::on(DBUtils::getDBName())->find($id);
        $mmcalculation_new = new MmcalculationModel();
        $mmcalculation_new->setConnection(DBUtils::getDBName());
        $mmcalculation_new->B=$mmcalculation->B;
        $mmcalculation_new->C=$mmcalculation->C;
        $mmcalculation_new->D=$mmcalculation->D;
        $mmcalculation_new->E=$mmcalculation->E;
        $mmcalculation_new->F0=$mmcalculation->F0;
        $mmcalculation_new->F1=$mmcalculation->F1;
        $mmcalculation_new->G=$mmcalculation->G;
        $mmcalculation_new->H=session()->get('user_empId');
        $mmcalculation_new->save();
        Log::info($mmcalculation_new->A);
        return redirect('ais/formCalculation/'.$mmcalculation_new->A);
      //  return view('ais.form_calculation', ['mmcalculation'=>$mmcalculation,'mode'=>$mode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info("destroy [".$id."] x");
        MmcalculationModel::on(DBUtils::getDBName())->find($id)->delete();

        return redirect('ais/designCalculation');
        //$this->search();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSelect(Request $request){
        Log::info("deleteSelect ");
        $checkboxs_hidden= Input::get('checkboxs_hidden');
        $checkboxs_explode = explode("_", $checkboxs_hidden);
        for( $i=0;$i<sizeof($checkboxs_explode);$i++){
            if(!empty($checkboxs_explode[$i])){
                Log::info(" [".$i."]".$checkboxs_explode[$i]);
                MmcalculationModel::on(DBUtils::getDBName())->find($checkboxs_explode[$i])->delete();
            }
        }
        return redirect('ais/designCalculation');
    }
}
