<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Log;
use DB;
use \DateTime;
use \SplFixedArray;
use \App\Utils\DBUtils;
class SootController extends Controller
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
        // php artisan make:controller SootController
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('into index');
        return view('ais/soot_blower');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search()
    {
        $sootView  = Input::get('sootView');
        $sootUnit  = Input::get('sootUnit');
        $sootDate  = Input::get('sootDate');
        Log::info('sootViewi['.Input::get('sootView').']');
        Log::info('sootUnit['.Input::get('sootUnit').']');
        Log::info('sootDate['.Input::get('sootDate').']');
        Log::info('into search'.Input::has('search').'x');
        if(!Input::has('sootDate')) {
            $date = new DateTime();
            $sootDate=date_format($date,'d/m/Y');
        }
        if(!Input::has('sootView')) {
            $sootView='1';
        }
        if(!Input::has('sootUnit')) {
            $sootUnit='4';
        }
        $sootDates = explode("/", $sootDate);
        $phase_start_times=['00:00:00','08:00:00','16:00:00'];
        $phase_end_times=['07:59:59','15:59:59','23:59:59'];
        $columns=['D990','D991','D992','D993','D994','D995','D996','D997','D998','D999'];
        $data_phase1=null;
        $data_phase2=null;
        $data_phase3=null;
        $data_phase_list=[$data_phase1,$data_phase2,$data_phase3];
        $data_result_phase1=[];
        $data_result_phase2=[];
        $data_result_phase3=[];
        $data_phase_result_list=[$data_result_phase1,$data_result_phase2,$data_result_phase3];
        $data_blow1=array();
        $data_blow2=array();
        $data_blow3=array();
        $data_blow_list=[$data_blow1,$data_blow2,$data_blow3];
        $i = 0;
        for($i=0;$i<sizeof($data_phase_list);$i++){
            $sootStartDate_phase=$sootDates[2]."-".$sootDates[1]."-".$sootDates[0]." ".$phase_start_times[$i];
            $sootEndDate_phase=$sootDates[2]."-".$sootDates[1]."-".$sootDates[0]." ".$phase_end_times[$i];

            $query="SELECT EVTIME, D4, D990, D991, D992, D993, D994, D995, D996, D997, D998, D999
                from datau0$sootUnit
                WHERE EvTime BETWEEN  '$sootStartDate_phase' AND '$sootEndDate_phase'";
            $data_phase_list[$i] = DB::connection(DBUtils::getDBName())->select($query);
            $data_compare='';
            $max=0;
            $k=0;
            $data_time=null;
            foreach ($data_phase_list[$i] as $phase) {
               // $data_result_phase=[];
                $data='';

                $haveData=false;
                $j=0;
                foreach($columns as $column){
                    if($phase->$column!='0'){
                        if($haveData)
                            $data=$data.',';
                        $sootNumber=$this->getSootFormat($j,$phase->$column);
                        $data=$data.$sootNumber;

                        if(empty($data_blow_list[$i][$sootNumber]))
                            $data_blow_list[$i][$sootNumber]=1;
                        else
                            $data_blow_list[$i][$sootNumber]=$data_blow_list[$i][$sootNumber]+1;;
                        $haveData=true;
                    }
                    $j++;
                }
                if(empty($data))
                    $data='No Soot Operate';
                else
                    $data='Soot='.$data;
                //$max=$phase->D4;
                if($k==0){
                    $data_time=$phase->EVTIME;
                    $max=$phase->D4;
                    $data_compare=$data;
                }


                if($data_compare!=$data){
                    //$phase->data=$data;
                    //$phase->time=date_format(new DateTime($phase->EVTIME),'H:i');
                    //$phase->amount='Flow='.number_format($phase->D4, 2, '.', ',').' kg/s';
                    $phase->data=$data_compare;
                    $phase->time=date_format(new DateTime($data_time),'H:i');
                    $phase->amount='Flow='.number_format($max, 2, '.', ',').' kg/s';
                    array_push($data_phase_result_list[$i],$phase);

                    // reset
                    $data_compare=$data;
                    $max=$phase->D4;
                    $data_time=$phase->EVTIME;
                }

                if($phase->D4>$max){
                    $max=$phase->D4;
                }
                if($k==sizeof($data_phase_list[$i])-1){
                    //Log::info('lasted   ['.$data_time.'],max ['.$max.']');
                    $phase->data=$data_compare;
                    $phase->time=date_format(new DateTime($data_time),'H:i');
                    $phase->amount='Flow='.number_format($max, 2, '.', ',').' kg/s';
                    array_push($data_phase_result_list[$i],$phase);
                }
                $k++;
               // Log::info('phase1  ['.$i++.']['.date_format(new DateTime($phase->EVTIME),'H:i').']['.number_format($phase->D4, 2, '.', ',').']='.$phase->data);
            }
           // Log::info('sootCount_list   ['.sizeof($data_blow_list[$i]).']');
        }
        /*
                return view('ais/soot_blower',['sootDate'=>$sootDate,'sootView'=>$sootView,
                    'data_phase_list'=>$data_phase_list,'data_blow_list'=>$data_blow_list]);
            */
                return view('ais/soot_blower',['sootDate'=>$sootDate,'sootView'=>$sootView,
                    'data_phase_list'=>$data_phase_result_list,'data_blow_list'=>$data_blow_list]);

    }
    private function getSootFormat($igroup,$index){
        $format_return='';
       // Log::info('into getSootFormat['.$igroup.']');
        switch ($igroup) {
            case 0:
                $format_return=$index.'L';
                break;
            case 1:
                $format_return=$index.'R';
                break;
            case 2:
                $format_return=($index+21).'L';
                break;
            case 3:
                $format_return=($index+21).'R';
                break;
            case 4:
               if($index<8)
                   $format_return='B'.$index;
               else if($index<15)
                   $format_return='C'.($index-7);
               else if($index<22)
                   $format_return='D'.($index-14);
               else if($index<29)
                   $format_return='E'.($index-21);
               else
                   $format_return='F'.($index-28);
                break;
            case 5:
                if($index<8)
                    $format_return='B'.($index+7);
                else if($index<15)
                    $format_return='C'.($index);
                else if($index<22)
                    $format_return='D'.($index-7);
                else if($index<29)
                    $format_return='E'.($index-14);
                else
                    $format_return='F'.($index-21);
                break;
            case 6:
                $format_return='AHC1';
                break;
            case 7:
                $format_return='AHC2';
                break;
            case 8:
                $format_return='AHC3';
                break;
            case 9:
                $format_return='AHC4';
                break;
            default:
                $format_return='';
        }
    return $format_return;
    }
}
