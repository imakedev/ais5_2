<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Model\MmtrendColorModel;
use Log;
use DB;
use \App\Utils\DBUtils;
use Illuminate\Support\Facades\Auth;
class TrendColorController extends Controller
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
    public function index()
    {
        $user = Auth::user()->empId;//'admin';

        $mmtrend_color = DB::table('mmtrend_color_table as mmtrend_color ')
            ->where('O', '=', $user)
            ->first();
        if ($mmtrend_color == null) {

            $mmtrend_color = new MmtrendColorModel();
            //$mmtrend_color->setConnection(DBUtils::getDBName());
        }

        return view('ais.trend_color',['mmtrend_color'=>$mmtrend_color,'userid'=>$user]);
    }
    public function store(Request $request)
    {

        $user = $request->input('userid');
        $mmtrend_color = MmtrendColorModel::where('O', $user)
            ->first();
        if ($mmtrend_color == null) {
            $mmtrend_color = new MmtrendColorModel();
           // $mmtrend_color->setConnection(DBUtils::getDBName());
        }
        $mmtrend_color->O=$user;
        $mmtrend_color->A = $request->input('color_point_A');
        $mmtrend_color->B = $request->input('color_point_B');
        $mmtrend_color->C = $request->input('color_point_C');
        $mmtrend_color->D = $request->input('color_point_D');
        $mmtrend_color->E = $request->input('color_point_E');
        $mmtrend_color->F = $request->input('color_point_F');
        $mmtrend_color->G = $request->input('color_point_G');
        $mmtrend_color->H = $request->input('color_point_H');
        $mmtrend_color->I = $request->input('color_point_I');
        $mmtrend_color->J = $request->input('color_point_J');
        $mmtrend_color->K = $request->input('color_point_K');
        $mmtrend_color->L = $request->input('color_point_L');
        $mmtrend_color->M = $request->input('color_point_M');
        $mmtrend_color->N = $request->input('color_type');
        $mmtrend_color->save();
         session()->flash('message', ' Update successfuly.');
        return view('ais.trend_color',['mmtrend_color'=>$mmtrend_color,'userid'=>$user]);
    }
}