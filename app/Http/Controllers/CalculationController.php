<?php
/**
 * User: imake
 * Date: 08/01/2016
 * Time: 13:31
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
                //session(['static_search' => $queryString]);
                session()->put('calculation_keySearch',$calculationKeySearch);
            }
            if(!empty($calculationSelection)){
               // $queryString = Input::get('calculationSelection');
                //session(['static_search' => $queryString]);
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
        if(!empty($calculationSelection)){
            if($calculationSelection=='1'){
                $datas=$datas->where('H', '=',  session()->get('user_empId'));
            }else   if($calculationSelection=='2'){
                $datas=$datas->where('H', '!=', session()->get('user_empId'));
            }


        }
        $datas=$datas->orderBy('updated_dt','DESC')->paginate(12);
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
        $id = $request->input('tagId');
        if($id!=null) {

        }else{

        }
        return redirect('ais/designTrend');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info("edit [".$id."] ");
        $mmcalculation =   MmcalculationModel::find($id);
        return view('ais.form_calculation', ['mmcalculation'=>$mmcalculation]);
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
        MmcalculationModel::find($id)->delete();

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
                MmcalculationModel::find($checkboxs_explode[$i])->delete();
            }

        }
        return redirect('ais/designCalculation');
    }
}