<?php

namespace App\Http\Controllers;

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
    public function index(){
        Log::info("aoee test TagConfigController");
        $tags_config = TagConfigModel::orderBy('updated_at','DESC')
            ->paginate(12);
        //$tags_config->setPath('/ais/tagConfiguration');

        return view('ais/tagConfiguration', ['tags_config'=>$tags_config]);
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

            $tag = TagConfigModel::find($id);
            $tag->B = $request->input('tagDescription');
            $tag->C4 = $request->input('tag4');
            $tag->C5 = $request->input('tag5');
            $tag->C6 = $request->input('tag6');
            $tag->C7 = $request->input('tag7');
            $tag->D = $request->input('tagTitle');

            $tag->E4 = $request->input('mm04L');
            $tag->F4 = $request->input('mm04P');
            $tag->G4 = $request->input('mm04M');
            $tag->H4 = $request->input('mm04B');

            $tag->E5 = $request->input('mm05L');
            $tag->F5 = $request->input('mm05P');
            $tag->G5 = $request->input('mm05M');
            $tag->H5 = $request->input('mm05B');

            $tag->E6 = $request->input('mm06L');
            $tag->F6 = $request->input('mm06P');
            $tag->G6 = $request->input('mm06M');
            $tag->H6 = $request->input('mm06B');

            $tag->E7 = $request->input('mm07L');
            $tag->F7 = $request->input('mm07P');
            $tag->G7 = $request->input('mm07M');
            $tag->H7 = $request->input('mm07B');

            $tag->save();
            session()->flash('message', ' Info save successfuly.');
        }else{
            $maxId = DB::table('mmtag_table')->max('A');
            $tag = new TagConfigModel();
            $tag->A = $maxId+1;
            $tag->B = $request->input('tagDescription');
            $tag->C4 = $request->input('tag4');
            $tag->C5 = $request->input('tag5');
            $tag->C6 = $request->input('tag6');
            $tag->C7 = $request->input('tag7');
            $tag->D = $request->input('tagTitle');

            $tag->E4 = $request->input('mm04L');
            $tag->F4 = $request->input('mm04P');
            $tag->G4 = $request->input('mm04M');
            $tag->H4 = $request->input('mm04B');

            $tag->E5 = $request->input('mm05L');
            $tag->F5 = $request->input('mm05P');
            $tag->G5 = $request->input('mm05M');
            $tag->H5 = $request->input('mm05B');

            $tag->E6 = $request->input('mm06L');
            $tag->F6 = $request->input('mm06P');
            $tag->G6 = $request->input('mm06M');
            $tag->H6 = $request->input('mm06B');

            $tag->E7 = $request->input('mm07L');
            $tag->F7 = $request->input('mm07P');
            $tag->G7 = $request->input('mm07M');
            $tag->H7 = $request->input('mm07B');

            $tag->save();
            session()->flash('message', ' Info save successfuly.');
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

            TagConfigModel::find($check)->delete();
        }
        return redirect('ais/tagConfiguration');
    }

    public function destroy($id)
    {
        TagConfigModel::find($id)->delete();

        return redirect('ais/tagConfiguration');
    }
}