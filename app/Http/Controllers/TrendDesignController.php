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
use Log;

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
    public  function search(){
        $datas = StatisticsModel::query();

        if (Input::has('search')) {
            $queryString = Input::get('search');
            $datas->orWhere('first_name', 'LIKE', "%$queryString%")
                ->orWhere('last_name', 'LIKE', "%$queryString%");
        }
        $lists = $datas->orderBy('user_login_log_id','ASC')->paginate(5);

        return view('ais/design_trend', ['lists'=>$lists]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        Log::info("Into TrendDesignController");
        // $trendDesignM = TagConfigModel::orderBy('A','ASC')->paginate(12);
        /*
        $users = DB::table('really_long_table_name AS t')
            ->select('t.id AS uid')
            ->get();
        */

        $mmtrendsM = DB::table('mmname_table as mmtrend ')
            ->orderBy('updated_at','DESC')
          //  ->join('mmname_table as mmname ', 'mmtrend.G', '=', 'mmname.ZZ')
         //   ->join('orders', 'users.id', '=', 'orders.user_id')
         //   ->select('users.*', 'contacts.phone', 'orders.price')
         //     ->select('mmtrend.*', 'mmname.A')
            ->paginate(10);
            //->get();
        /*$i = 0;
        foreach ($mmtrendsM as $mmtrendM) {
            //Log::info($trendDesignM->A);
            //Log::info('Group x');
            // $i++;
            Log::info("Group [".($i++)."] x".$mmtrendM->A."x");
        }
        */
      //  $trendDesignsM->setPath('/ais/designTrend');
        //$tags_config->setPath('/ais/tagConfiguration');
        return view('ais/design_trend', ['mmtrendsM'=>$mmtrendsM]);
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
        MmnameModel::find($id)->delete();

        return redirect('ais/designTrend');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSelect(Request $request){

        foreach($_GET['checkbox'] as $check) {

            MmnameModel::find($check)->delete();
        }
        return redirect('ais/designTrend');
    }
}