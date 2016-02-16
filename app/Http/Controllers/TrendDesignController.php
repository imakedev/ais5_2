<?php
/**
 * User: imake
 * Date: 10/11/15
 * Time: 12:41
 */

namespace App\Http\Controllers;

use App\Model\MmnameModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Model\TagConfigModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Log;
use \App\Utils\DBUtils;
class TrendDesignController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(){
        Log::info("Into TrendDesignController");
        $design_trend_B=Input::get('design_trend_B');
        $search = Input::get('search');
        $sortBy = Input::get('sortBy');
        $orderBy= Input::get('orderBy');

        if(empty($design_trend_B)){
            $design_trend_B=Auth::user()->empId;
        }
        $datas = MmnameModel::on(DBUtils::getDBName())->newQuery();
        if(Input::has('page')){ // paging
            Log::info("into paging");
            $search = session()->get('design_trend_search');
            $sortBy = session()->get('sortBy');
            $orderBy= session()->get('orderBy');
            $design_trend_B= session()->get('design_trend_B');
        }
        if(!empty($search)){
            $datas= $datas->Where(function ($datas) use ($search){
                $datas->orWhere('A', 'LIKE', "%$search%");

            });
        }
        if(!empty($design_trend_B) && $design_trend_B!=-1){
            $datas= $datas->Where('B', '=', "$design_trend_B");
        }
        if(!empty($sortBy) && !empty($orderBy)){
            $datas=$datas->orderBy($sortBy,$orderBy);
        }
        session()->put('sortBy',$sortBy);
        session()->put('orderBy',$orderBy);
        session()->put('design_trend_search',$search);
        session()->put('design_trend_B',$design_trend_B);
        $datas=$datas->orderBy('updated_at','DESC')->paginate(10);
        //$mmtrend_groups = DB::connection(DBUtils::getDBName())->table('mmtrend_group')->where('mmplant','=',session()->get('user_mmplant'))->get();
        $mmtrend_groups = DB::table('mmtrend_group')->where('mmplant','=',session()->get('user_mmplant'))->get();
        return view('ais/design_trend', ['mmtrendsM'=>$datas,'mmtrend_groups'=>$mmtrend_groups]);
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
    public function destroy($id)
    {
        Log::info("destroy [".$id."] x");
       // MmnameModel::find($id)->delete();
        session()->flash('message', ' Delete successfuly.');
        return redirect('ais/designTrend');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSelect(Request $request){
        Log::info("deleteSelect");
        foreach($_GET['checkbox'] as $check) {

            //MmnameModel::find($check)->delete();
        }
        session()->flash('message', ' Delete successfuly.');
        return redirect('ais/designTrend');
    }
}