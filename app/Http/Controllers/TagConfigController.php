<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Model\TagConfigModel;
use \App\Model\PointConfigModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Log;
use \App\Utils\DBUtils;
class TagConfigController extends Controller
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
    public function search(){
        Log::info("aoee test TagConfigController");
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

        return view('ais/tagConfiguration', ['tags_config'=>$datas,'columns'=>$columns,'c_unit'=>$c_unit,'efgh_array'=>$efgh_array]);
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

            $tag = TagConfigModel::on(DBUtils::getDBName())->find($id);
            $tag->B = $request->input('tagDescription');
            $mmplant=session()->get('user_mmplant');
            if($mmplant=='1'){
                $tag->C4 = $request->input('tag4');
                $tag->C5 = $request->input('tag5');
                $tag->C6 = $request->input('tag6');
                $tag->C7 = $request->input('tag7');

                if(!empty($tag->C4)){
                    $tag->E4 = $request->input('mm04L');
                    $tag->F4 = $request->input('mm04P');
                    $tag->G4 = $request->input('mm04M');
                    $tag->H4 = $request->input('mm04B');
                }else{
                    $tag->E4 = null;
                    $tag->F4 = null;
                    $tag->G4 = null;
                    $tag->H4 = null;
                }
                Log::info('xxx['.$request->input('tag5').']');

                if(!empty($tag->C5)){
                    $tag->E5 = $request->input('mm05L');
                    $tag->F5 = $request->input('mm05P');
                    $tag->G5 = $request->input('mm05M');
                    $tag->H5 = $request->input('mm05B');
                }else{
                    $tag->E5 = null;
                    $tag->F5 = null;
                    $tag->G5 = null;
                    $tag->H5 = null;
                }

                if(!empty($tag->C6)){
                    $tag->E6 = $request->input('mm06L');
                    $tag->F6 = $request->input('mm06P');
                    $tag->G6 = $request->input('mm06M');
                    $tag->H6 = $request->input('mm06B');
                }else{
                    $tag->E6 = null;
                    $tag->F6 = null;
                    $tag->G6 = null;
                    $tag->H6 = null;
                }

                if(!empty($tag->C7)){
                    $tag->E7 = $request->input('mm07L');
                    $tag->F7 = $request->input('mm07P');
                    $tag->G7 = $request->input('mm07M');
                    $tag->H7 = $request->input('mm07B');
                }else{
                    $tag->E7 = null;
                    $tag->F7 = null;
                    $tag->G7 = null;
                    $tag->H7 = null;
                }

            }else if($mmplant=='2'){
                $tag->C8 = $request->input('tag8');
                $tag->C9 = $request->input('tag9');
                $tag->C10 = $request->input('tag10');
                $tag->C11 = $request->input('tag11');
                $tag->C12 = $request->input('tag12');
                $tag->C13 = $request->input('tag13');

                if(!empty($tag->C8)){
                    $tag->E8 = $request->input('mm08L');
                    $tag->F8 = $request->input('mm08P');
                    $tag->G8 = $request->input('mm08M');
                    $tag->H8 = $request->input('mm08B');
                }else{
                    $tag->E8 = null;
                    $tag->F8 = null;
                    $tag->G8 = null;
                    $tag->H8 = null;
                }

                if(!empty($tag->C9)){
                    $tag->E9 = $request->input('mm09L');
                    $tag->F9 = $request->input('mm09P');
                    $tag->G9 = $request->input('mm09M');
                    $tag->H9 = $request->input('mm09B');
                }else{
                    $tag->E9 = null;
                    $tag->F9 = null;
                    $tag->G9 = null;
                    $tag->H9 = null;
                }

                if(!empty($tag->C10)){
                    $tag->E10 = $request->input('mm10L');
                    $tag->F10 = $request->input('mm10P');
                    $tag->G10 = $request->input('mm10M');
                    $tag->H10 = $request->input('mm10B');
                }else{
                    $tag->E10 = null;
                    $tag->F10 = null;
                    $tag->G10 = null;
                    $tag->H10 = null;
                }

                if(!empty($tag->C11)){
                    $tag->E11 = $request->input('mm11L');
                    $tag->F11 = $request->input('mm11P');
                    $tag->G11 = $request->input('mm11M');
                    $tag->H11 = $request->input('mm11B');
                }else{
                    $tag->E11 = null;
                    $tag->F11 = null;
                    $tag->G11 = null;
                    $tag->H11 = null;
                }

                if(!empty($tag->C12)){
                    $tag->E12 = $request->input('mm12L');
                    $tag->F12 = $request->input('mm12P');
                    $tag->G12 = $request->input('mm12M');
                    $tag->H12 = $request->input('mm12B');
                }else{
                    $tag->E12 = null;
                    $tag->F12 = null;
                    $tag->G12 = null;
                    $tag->H12 = null;
                }

                if(!empty($tag->C13)){
                    $tag->E13 = $request->input('mm13L');
                    $tag->F13 = $request->input('mm13P');
                    $tag->G13 = $request->input('mm13M');
                    $tag->H13 = $request->input('mm13B');
                }else{
                    $tag->E13 = null;
                    $tag->F13 = null;
                    $tag->G13 = null;
                    $tag->H13 = null;
                }

            }else if($mmplant=='3'){
                $tag->C8 = $request->input('tag8');
                $tag->C9 = $request->input('tag9');
                $tag->C10 = $request->input('tag10');
                $tag->C11 = $request->input('tag11');
                $tag->C12 = $request->input('tag12');
                $tag->C13 = $request->input('tag13');


                if(!empty($tag->C8)){
                    $tag->E8 = $request->input('mm08L');
                    $tag->F8 = $request->input('mm08P');
                    $tag->G8 = $request->input('mm08M');
                    $tag->H8 = $request->input('mm08B');
                }else{
                    $tag->E8 = null;
                    $tag->F8 = null;
                    $tag->G8 = null;
                    $tag->H8 = null;
                }

                if(!empty($tag->C9)){
                    $tag->E9 = $request->input('mm09L');
                    $tag->F9 = $request->input('mm09P');
                    $tag->G9 = $request->input('mm09M');
                    $tag->H9 = $request->input('mm09B');
                }else{
                    $tag->E9 = null;
                    $tag->F9 = null;
                    $tag->G9 = null;
                    $tag->H9 = null;
                }

                if(!empty($tag->C10)){
                    $tag->E10 = $request->input('mm10L');
                    $tag->F10 = $request->input('mm10P');
                    $tag->G10 = $request->input('mm10M');
                    $tag->H10 = $request->input('mm10B');
                }else{
                    $tag->E10 = null;
                    $tag->F10 = null;
                    $tag->G10 = null;
                    $tag->H10 = null;
                }

                if(!empty($tag->C11)){
                    $tag->E11 = $request->input('mm11L');
                    $tag->F11 = $request->input('mm11P');
                    $tag->G11 = $request->input('mm11M');
                    $tag->H11 = $request->input('mm11B');
                }else{
                    $tag->E11 = null;
                    $tag->F11 = null;
                    $tag->G11 = null;
                    $tag->H11 = null;
                }

                if(!empty($tag->C12)){
                    $tag->E12 = $request->input('mm12L');
                    $tag->F12 = $request->input('mm12P');
                    $tag->G12 = $request->input('mm12M');
                    $tag->H12 = $request->input('mm12B');
                }else{
                    $tag->E12 = null;
                    $tag->F12 = null;
                    $tag->G12 = null;
                    $tag->H12 = null;
                }

                if(!empty($tag->C13)){
                    $tag->E13 = $request->input('mm13L');
                    $tag->F13 = $request->input('mm13P');
                    $tag->G13 = $request->input('mm13M');
                    $tag->H13 = $request->input('mm13B');
                }else{
                    $tag->E13 = null;
                    $tag->F13 = null;
                    $tag->G13 = null;
                    $tag->H13 = null;
                }
            }
            $tag->D = $request->input('tagTitle');


            $tag->save();
            session()->flash('message', ' Update successfuly.');
        }else{
            $maxId = DB::connection(DBUtils::getDBName())->table('mmtag_table')->max('A');
            $tag = new TagConfigModel();
            $tag->setConnection(DBUtils::getDBName());
            $tag->A = $maxId+1;
            $tag->B = $request->input('tagDescription');
            $mmplant=session()->get('user_mmplant');
            if($mmplant=='1') {
                $tag->C4 = $request->input('tag4');
                $tag->C5 = $request->input('tag5');
                $tag->C6 = $request->input('tag6');
                $tag->C7 = $request->input('tag7');


                if(!empty($tag->C4)){
                    $tag->E4 = $request->input('mm04L');
                    $tag->F4 = $request->input('mm04P');
                    $tag->G4 = $request->input('mm04M');
                    $tag->H4 = $request->input('mm04B');
                }else{
                    $tag->E4 = null;
                    $tag->F4 = null;
                    $tag->G4 = null;
                    $tag->H4 = null;
                }

                if(!empty($tag->C5)){
                    $tag->E5 = $request->input('mm05L');
                    $tag->F5 = $request->input('mm05P');
                    $tag->G5 = $request->input('mm05M');
                    $tag->H5 = $request->input('mm05B');
                }else{
                    $tag->E5 = null;
                    $tag->F5 = null;
                    $tag->G5 = null;
                    $tag->H5 = null;
                }

                if(!empty($tag->C6)){
                    $tag->E6 = $request->input('mm06L');
                    $tag->F6 = $request->input('mm06P');
                    $tag->G6 = $request->input('mm06M');
                    $tag->H6 = $request->input('mm06B');
                }else{
                    $tag->E6 = null;
                    $tag->F6 = null;
                    $tag->G6 = null;
                    $tag->H6 = null;
                }

                if(!empty($tag->C7)){
                    $tag->E7 = $request->input('mm07L');
                    $tag->F7 = $request->input('mm07P');
                    $tag->G7 = $request->input('mm07M');
                    $tag->H7 = $request->input('mm07B');
                }else{
                    $tag->E7 = null;
                    $tag->F7 = null;
                    $tag->G7 = null;
                    $tag->H7 = null;
                }
            }else if($mmplant=='2') {
                $tag->C8 = $request->input('tag8');
                $tag->C9 = $request->input('tag9');
                $tag->C10 = $request->input('tag10');
                $tag->C11 = $request->input('tag11');
                $tag->C12 = $request->input('tag12');
                $tag->C13 = $request->input('tag13');


                if(!empty($tag->C8)){
                    $tag->E8 = $request->input('mm08L');
                    $tag->F8 = $request->input('mm08P');
                    $tag->G8 = $request->input('mm08M');
                    $tag->H8 = $request->input('mm08B');
                }else{
                    $tag->E8 = null;
                    $tag->F8 = null;
                    $tag->G8 = null;
                    $tag->H8 = null;
                }

                if(!empty($tag->C9)){
                    $tag->E9 = $request->input('mm09L');
                    $tag->F9 = $request->input('mm09P');
                    $tag->G9 = $request->input('mm09M');
                    $tag->H9 = $request->input('mm09B');
                }else{
                    $tag->E9 = null;
                    $tag->F9 = null;
                    $tag->G9 = null;
                    $tag->H9 = null;
                }

                if(!empty($tag->C10)){
                    $tag->E10 = $request->input('mm10L');
                    $tag->F10 = $request->input('mm10P');
                    $tag->G10 = $request->input('mm10M');
                    $tag->H10 = $request->input('mm10B');
                }else{
                    $tag->E10 = null;
                    $tag->F10 = null;
                    $tag->G10 = null;
                    $tag->H10 = null;
                }

                if(!empty($tag->C11)){
                    $tag->E11 = $request->input('mm11L');
                    $tag->F11 = $request->input('mm11P');
                    $tag->G11 = $request->input('mm11M');
                    $tag->H11 = $request->input('mm11B');
                }else{
                    $tag->E11 = null;
                    $tag->F11 = null;
                    $tag->G11 = null;
                    $tag->H11 = null;
                }

                if(!empty($tag->C12)){
                    $tag->E12 = $request->input('mm12L');
                    $tag->F12 = $request->input('mm12P');
                    $tag->G12 = $request->input('mm12M');
                    $tag->H12 = $request->input('mm12B');
                }else{
                    $tag->E12 = null;
                    $tag->F12 = null;
                    $tag->G12 = null;
                    $tag->H12 = null;
                }

                if(!empty($tag->C13)){
                    $tag->E13 = $request->input('mm13L');
                    $tag->F13 = $request->input('mm13P');
                    $tag->G13 = $request->input('mm13M');
                    $tag->H13 = $request->input('mm13B');
                }else{
                    $tag->E13 = null;
                    $tag->F13 = null;
                    $tag->G13 = null;
                    $tag->H13 = null;
                }
            }else if($mmplant=='3') {
                $tag->C8 = $request->input('tag8');
                $tag->C9 = $request->input('tag9');
                $tag->C10 = $request->input('tag10');
                $tag->C11 = $request->input('tag11');
                $tag->C12 = $request->input('tag12');
                $tag->C13 = $request->input('tag13');


                if(!empty($tag->C8)){
                    $tag->E8 = $request->input('mm08L');
                    $tag->F8 = $request->input('mm08P');
                    $tag->G8 = $request->input('mm08M');
                    $tag->H8 = $request->input('mm08B');
                }else{
                    $tag->E8 = null;
                    $tag->F8 = null;
                    $tag->G8 = null;
                    $tag->H8 = null;
                }

                if(!empty($tag->C9)){
                    $tag->E9 = $request->input('mm09L');
                    $tag->F9 = $request->input('mm09P');
                    $tag->G9 = $request->input('mm09M');
                    $tag->H9 = $request->input('mm09B');
                }else{
                    $tag->E9 = null;
                    $tag->F9 = null;
                    $tag->G9 = null;
                    $tag->H9 = null;
                }

                if(!empty($tag->C10)){
                    $tag->E10 = $request->input('mm10L');
                    $tag->F10 = $request->input('mm10P');
                    $tag->G10 = $request->input('mm10M');
                    $tag->H10 = $request->input('mm10B');
                }else{
                    $tag->E10 = null;
                    $tag->F10 = null;
                    $tag->G10 = null;
                    $tag->H10 = null;
                }

                if(!empty($tag->C11)){
                    $tag->E11 = $request->input('mm11L');
                    $tag->F11 = $request->input('mm11P');
                    $tag->G11 = $request->input('mm11M');
                    $tag->H11 = $request->input('mm11B');
                }else{
                    $tag->E11 = null;
                    $tag->F11 = null;
                    $tag->G11 = null;
                    $tag->H11 = null;
                }

                if(!empty($tag->C12)){
                    $tag->E12 = $request->input('mm12L');
                    $tag->F12 = $request->input('mm12P');
                    $tag->G12 = $request->input('mm12M');
                    $tag->H12 = $request->input('mm12B');
                }else{
                    $tag->E12 = null;
                    $tag->F12 = null;
                    $tag->G12 = null;
                    $tag->H12 = null;
                }

                if(!empty($tag->C13)){
                    $tag->E13 = $request->input('mm13L');
                    $tag->F13 = $request->input('mm13P');
                    $tag->G13 = $request->input('mm13M');
                    $tag->H13 = $request->input('mm13B');
                }else{
                    $tag->E13 = null;
                    $tag->F13 = null;
                    $tag->G13 = null;
                    $tag->H13 = null;
                }
            }
            $tag->D = $request->input('tagTitle');
            $tag->save();
            /*
            $point = new PointConfigModel();
            $point->setConnection(DBUtils::getDBName());
            $point->A=$maxId+1;
            $point->B=$tag->B;
            if($mmplant=='1') {
                $point->C4=$tag->C4;
                $point->C5=$tag->C5;
                $point->C6=$tag->C6;
                $point->C7=$tag->C7;
            }else if($mmplant=='2') {
                $point->C8=$tag->C8;
                $point->C9=$tag->C9;
                $point->C10=$tag->C10;
                $point->C11=$tag->C11;
                $point->C12=$tag->C12;
                $point->C13=$tag->C13;
            }else if($mmplant=='3') {
                $point->C8=$tag->C8;
                $point->C9=$tag->C9;
                $point->C10=$tag->C10;
                $point->C11=$tag->C11;
                $point->C12=$tag->C12;
                $point->C13=$tag->C13;
            }

            $point->H=$maxId+1;
            $point->save();
            */
            session()->flash('message', ' Save successfuly.');
        }
        return redirect('ais/tagConfiguration');
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

            $tagConfigModel=TagConfigModel::on(DBUtils::getDBName())->find($check);
            $tagConfigModel->delete();
            DB::connection(DBUtils::getDBName())->table('mmpoint_table')->where('A', '=', $tagConfigModel->A)->delete();
        }
        session()->flash('message', ' Delete successfuly.');
        return redirect('ais/tagConfiguration');
    }

    public function destroy($id)
    {
        $tagConfigModel=TagConfigModel::on(DBUtils::getDBName())->find($id);
        $tagConfigModel->delete();
        DB::connection(DBUtils::getDBName())->table('mmpoint_table')->where('A', '=', $tagConfigModel->A)->delete();
        session()->flash('message', ' Delete successfuly.');
        return redirect('ais/tagConfiguration');
    }
}