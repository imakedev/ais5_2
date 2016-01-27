<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Model\ServSetModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Log;

class ServController extends Controller
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
    public function store(Request $request){
        $rules = array(
            'dmm4-7' => 'required',
            'dmm8-13' => 'required',
            //'dmm11-13' => 'required',
            'dfgd8-13' => 'required',
            'lmm4-7' => 'required',
            'lmm8-10' => 'required',
            'lmm11-13' => 'required',
            'lfgd8-13' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {

            session()->flash('error_message', " You can't leave this all empty.");
            session()->flash('error_message2', " You can use letters, numbers, Periods, and Hyphen.");

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

            $input = input::all();

        }else {
            $id = $request->input('id');
            $data = ServSetModel::find($id);
            $data->mm_4_17_db_server = $request->input('dmm4-7');
            $data->mm_8_13_db_server = $request->input('dmm8-13');
            //$data->mm_11_13_db_server = $request->input('dmm11-13');
            $data->fgd_8_13_db_server = $request->input('dfgd8-13');
            $data->mm_4_7_logs_server = $request->input('lmm4-7');
            $data->mm_8_10_logs_server = $request->input('lmm8-10');
            $data->mm_11_13_logs_server = $request->input('lmm11-13');
            $data->fgd_8_13_logs_server = $request->input('lfgd8-13');

            $data->save();
            session()->flash('message', ' Info save successfuly.');
            return redirect('ais/serverSetting');
        }
    }
    public function index(){

        $ip = \App\Model\ServSetModel::where('server_setting_id', '1')->first();
        Log::info("aoee test ServController");
        return view('ais/serverSetting',compact('ip'));
    }
}
