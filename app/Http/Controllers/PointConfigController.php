<?php

namespace App\Http\Controllers;

use \App\Model\PointConfigModel;
use \App\Model\TagConfigModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Log;
use \App\Utils\DBUtils;
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
        $datas = PointConfigModel::on(DBUtils::getDBName())->newQuery();
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
        //$datas=$datas->orderBy('updated_at','DESC')->paginate(10);
        $datas=$datas->paginate(10);
        /*
        $points_config = PointConfigModel::orderBy('updated_at','DESC')->paginate(12);
        $points_config->setPath('/ais/pointConfiguration');
        */
        return view('ais/pointConfiguration', ['points_config'=>$datas]);
    }
    public  function pointOfTag($id){
        Log::info("into pointOfTag[".$id."]");
        $search = Input::get('search');
        $sortBy = Input::get('sortBy');
        $orderBy= Input::get('orderBy');
        $tagModel = TagConfigModel::on(DBUtils::getDBName())->newQuery()->where('A', '=', $id)->first();
        $datas = PointConfigModel::on(DBUtils::getDBName())->newQuery();
        $datas=$datas->where('H', '=', $id);
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
        //$datas=$datas->orderBy('updated_at','DESC')->paginate(10);
        $datas=$datas->paginate(10);
        $mmplant=session()->get('user_mmplant');
        $columns=null;
        $c_unit = 'C';
        $efgh_array = ['E','F','G','H'];
        if($mmplant=='1'){// 4-7
            $columns=['4','5','6','7'];
        }else if($mmplant=='2'){// 4-7
            $columns=['8','9','10','11','12','13'];
        }else if($mmplant=='3'){// 4-7
            $columns=['8','9','10','11','12','13'];
        }
        /*
        $points_config = PointConfigModel::orderBy('updated_at','DESC')->paginate(12);
        $points_config->setPath('/ais/pointConfiguration');
        */
        return view('ais/pointOfTag', ['tagModel'=>$tagModel,'points_config'=>$datas,'columns'=>$columns,'c_unit'=>$c_unit,'efgh_array'=>$efgh_array]);

    }
    public function search(){
        $search = Input::get('search');
        $sortBy = Input::get('sortBy');
        $orderBy= Input::get('orderBy');
        $datas = PointConfigModel::on(DBUtils::getDBName())->newQuery();
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
        //$datas=$datas->orderBy('updated_at','DESC')->paginate(10);
        $datas=$datas->paginate(10);
        $mmplant=session()->get('user_mmplant');
        $columns=null;
        $c_unit = 'C';
        $efgh_array = ['E','F','G','H'];
        if($mmplant=='1'){// 4-7
            $columns=['4','5','6','7'];
        }else if($mmplant=='2'){// 4-7
            $columns=['8','9','10','11','12','13'];
        }else if($mmplant=='3'){// 4-7
            $columns=['8','9','10','11','12','13'];
        }
        /*
        $points_config = PointConfigModel::orderBy('updated_at','DESC')->paginate(12);
        $points_config->setPath('/ais/pointConfiguration');
        */
        return view('ais/pointConfiguration', ['points_config'=>$datas,'columns'=>$columns,'c_unit'=>$c_unit,'efgh_array'=>$efgh_array]);

    }
    public  function tagList(){
        Log::info("tagList TagConfigController");
        $search = Input::get('search');
        $sortBy = Input::get('sortBy');
        $orderBy= Input::get('orderBy');
        $datas = TagConfigModel::on(DBUtils::getDBName())->newQuery();
        // $datas->newQuery()
        if(Input::has('page')){ // paging
            Log::info("into paging");
            $search = session()->get('tagConf_search');
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
        session()->put('tagConf_search',$search);
        //$datas=$datas->orderBy('updated_at','DESC')->paginate(10);
        $datas=$datas->paginate(10);

        /*
        $tags_config = TagConfigModel::orderBy('updated_at','DESC')
            ->paginate(12);
        */
        //$tags_config->setPath('/ais/tagConfiguration');
        $mmplant=session()->get('user_mmplant');
        $columns=null;
        $c_unit = 'C';
        $efgh_array = ['E','F','G','H'];
        if($mmplant=='1'){// 4-7
            $columns=['4','5','6','7'];
        }else if($mmplant=='2'){// 4-7
            $columns=['8','9','10','11','12','13'];
        }else if($mmplant=='3'){// 4-7
            $columns=['8','9','10','11','12','13'];
        }
        /*
        $points_config = PointConfigModel::orderBy('updated_at','DESC')->paginate(12);
        $points_config->setPath('/ais/pointConfiguration');
        */
        return view('ais/tagList', ['tags_config'=>$datas,'columns'=>$columns,'c_unit'=>$c_unit,'efgh_array'=>$efgh_array]);
    }
    public function store(Request $request)
    {
        $id = $request->input('poiId');
        $tagId=$request->input('tagId');
        Log::info("into store poiId[".$id."] tagId[".$tagId."]");
        if($id!=null) {
            $avgChk = Input::has('avg') ? Input::get('avg') : null;
            $point = PointConfigModel::on(DBUtils::getDBName())->find($id);
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

            $maxId = DB::connection(DBUtils::getDBName())->table('mmpoint_table')->max('A');
            Log::info("saveeee  store poiId[".$maxId."]");
            $avgChk = Input::has('avg') ? Input::get('avg') : null;
            $point = new PointConfigModel();
            $point->setConnection(DBUtils::getDBName());
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
            $point->H = $tagId;

            $tagModel = TagConfigModel::on(DBUtils::getDBName())->newQuery()->where('A', '=', $tagId)->first();
            $point->B=$tagModel->B;
            $mmplant=session()->get('user_mmplant');
            if($mmplant=='1'){// 4-7
                $point->C4=$tagModel->C4;
                $point->C5=$tagModel->C5;
                $point->C6=$tagModel->C6;
                $point->C7=$tagModel->C7;
            }else if($mmplant=='2'){// 4-7
                $point->C8=$tagModel->C8;
                $point->C9=$tagModel->C9;
                $point->C10=$tagModel->C10;
                $point->C11=$tagModel->C11;
                $point->C12=$tagModel->C12;
                $point->C13=$tagModel->C13;
            }else if($mmplant=='3'){// 4-7
                $point->C8=$tagModel->C8;
                $point->C9=$tagModel->C9;
                $point->C10=$tagModel->C10;
                $point->C11=$tagModel->C11;
                $point->C12=$tagModel->C12;
                $point->C13=$tagModel->C13;
            }
            $point->save();
            session()->flash('message', ' Save successfuly.');
        }
        //return redirect('ais/pointConfiguration');
        return redirect('ais/tag/'.$tagId.'/points');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSelect(Request $request){
        $tagId=null;
        foreach($_GET['checkbox'] as $check) {

            $pointConfigModel = PointConfigModel::on(DBUtils::getDBName())->find($check);
            $tagId=$pointConfigModel->H;

            $pointConfigModel->delete();

           // DB::connection(DBUtils::getDBName())->table('mmtag_table')->where('A', '=', $pointConfigModel->H)->delete();
        }
        session()->flash('message', ' Delete successfuly.');
        // return redirect('ais/pointConfiguration');
        return redirect('ais/tag/'.$tagId.'/points');
    }

    public function destroy($id)
    {
        Log::info("into destroy[".$id."]");

        $pointConfigModel = PointConfigModel::on(DBUtils::getDBName())->find($id);
        Log::info($pointConfigModel->H);

        $pointConfigModel->delete();
        /*
       //DB::connection(DBUtils::getDBName())->table('mmtag_table')->where('A', '=', $pointConfigModel->H)->delete();
       */
        session()->flash('message', ' Delete successfuly.');

        //return redirect('ais/pointConfiguration');
        return redirect('ais/tag/'.$pointConfigModel->H.'/points');
    }
}