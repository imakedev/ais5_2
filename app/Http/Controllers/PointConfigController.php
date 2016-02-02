<?php

namespace App\Http\Controllers;

use \App\Model\PointConfigModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Log;
class PointConfigController extends Controller
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
    //

    public  function searchTagOfPoint(){
        $search = Input::get('search');
        $sortBy = Input::get('sortBy');
        $orderBy= Input::get('orderBy');
        $datas = PointConfigModel::query();
        if(Input::has('page')){ // paging
            Log::info("into paging");
            $search = session()->get('pointConf_search');
            $sortBy = session()->get('sortBy');
            $orderBy= session()->get('orderBy');
        }
        if(!empty($search)){
            $datas= $datas->Where(function ($datas) use ($search){
                $datas->orWhere('B', 'LIKE', "%$search%");

            });
        }
        if(!empty($sortBy) && !empty($orderBy)){
            $datas=$datas->orderBy($sortBy,$orderBy);
        }
        session()->put('sortBy',$sortBy);
        session()->put('orderBy',$orderBy);
        session()->put('pointConf_search',$search);
        $datas=$datas->orderBy('updated_at','DESC')->paginate(10);

        /*
        $points_config = PointConfigModel::orderBy('updated_at','DESC')->paginate(12);
        $points_config->setPath('/ais/pointConfiguration');
        */
        return view('ais/pointConfiguration', ['points_config'=>$datas]);
    }
    public  function search(){
        $search = Input::get('search');
        $sortBy = Input::get('sortBy');
        $orderBy= Input::get('orderBy');
        $datas = PointConfigModel::query();
        if(Input::has('page')){ // paging
            Log::info("into paging");
            $search = session()->get('pointConf_search');
            $sortBy = session()->get('sortBy');
            $orderBy= session()->get('orderBy');
        }
        if(!empty($search)){
            $datas= $datas->Where(function ($datas) use ($search){
                $datas->orWhere('B', 'LIKE', "%$search%");

            });
        }
        if(!empty($sortBy) && !empty($orderBy)){
            $datas=$datas->orderBy($sortBy,$orderBy);
        }
        session()->put('sortBy',$sortBy);
        session()->put('orderBy',$orderBy);
        session()->put('pointConf_search',$search);
        $datas=$datas->orderBy('updated_at','DESC')->paginate(10);

        /*
        $points_config = PointConfigModel::orderBy('updated_at','DESC')->paginate(12);
        $points_config->setPath('/ais/pointConfiguration');
        */
        return view('ais/pointConfiguration', ['points_config'=>$datas]);
    }
    public function store(Request $request)
    {
        $id = $request->input('poiId');
        if($id!=null) {
            $avgChk = Input::has('avg') ? Input::get('avg') : null;
            $point = PointConfigModel::find($id);
            $point->D = $request->input('poiAtom');
            if(isset($avgChk)){
                $point->E = "Yes";
            }else{
                $point->E = "No";
            }
            $point->F = $request->input('poiUnit');
            $point->G0 = $request->input('poiMax');
            $point->G1 = $request->input('poiMin');

            $point->save();
            session()->flash('message', ' Update successfuly.');
        }else{
            $maxId = DB::table('mmpoint_table')->max('A');
            $avgChk = Input::has('avg') ? Input::get('avg') : null;
            $point = new PointConfigModel();
            $point->A = $maxId+1;
            $point->D = $request->input('poiAtom');
            if(isset($avgChk)){
                $point->E = "Yes";
            }else{
                $point->E = "No";
            }
            $point->F = $request->input('poiUnit');
            $point->G0 = $request->input('poiMax');
            $point->G1 = $request->input('poiMin');

            $point->save();
            session()->flash('message', ' Save successfuly.');
        }
        return redirect('ais/pointConfiguration');
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
        //
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
    public function deleteSelect(Request $request){

        foreach($_GET['checkbox'] as $check) {

            $pointConfigModel = PointConfigModel::find($check);
            $pointConfigModel->delete();
            DB::table('mmtag_table')->where('A', '=', $pointConfigModel->H)->delete();
        }
        session()->flash('message', ' Delete successfuly.');
        return redirect('ais/pointConfiguration');
    }

    public function destroy($id)
    {
        $pointConfigModel = PointConfigModel::find($id);
        $pointConfigModel->delete();
        DB::table('mmtag_table')->where('A', '=', $pointConfigModel->H)->delete();
        session()->flash('message', ' Delete successfuly.');
        return redirect('ais/pointConfiguration');
    }
}