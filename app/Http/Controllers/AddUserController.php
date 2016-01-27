<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Model\AddUserModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use Log;
class AddUserController extends Controller
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
    public function search()
    {
        $search = Input::get('search');
        $sortBy = Input::get('sortBy');
        $orderBy= Input::get('orderBy');
        $datas = AddUserModel::query();
        if(Input::has('page')){ // paging
            Log::info("into paging");
            $search = session()->get('addUser_search');
            $sortBy = session()->get('sortBy');
            $orderBy= session()->get('orderBy');
        }
        if(!empty($search)){
            $datas= $datas->Where(function ($datas) use ($search){
                $datas->orWhere('A', 'LIKE', "%$search%")
                    ->orWhere('C', 'LIKE',"%$search%");
            });
        }
        if(!empty($sortBy) && !empty($orderBy)){
            $datas=$datas->orderBy($sortBy,$orderBy);
        }
        session()->put('sortBy',$sortBy);
        session()->put('orderBy',$orderBy);
        session()->put('addUser_search',$search);

        $datas=$datas->paginate(10);

        /*
        $info_employee = AddUserModel::orderBy('updated_at','DESC')
           // ->orderBy('updated_at','DESC')
            ->paginate(12);
        $info_employee->setPath('/ais/addUser');
*/
        return view('ais/addUser', ['info_employee'=>$datas]);
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
        $id = $request->input('empId');
        if($id!=null) {
            $emp = AddUserModel::find($id);
            $emp->A = $request->input('empNo');
            $emp->B = $request->input('empTitle');
            $emp->C = $request->input('empFirstName') . "   " . $request->input('empLastName');
            $emp->D0 = $request->input('empPriority');

            $emp->save();
            session()->flash('message', ' Info save successfuly.');
        }else{
            $maxId = DB::table('mmemployee_table')->max('ZZ');
            $emp = new AddUserModel();
            $emp->ZZ = $maxId+1;
            $emp->A = $request->input('empNo');
            $emp->B = $request->input('empTitle');
            $emp->C = $request->input('empFirstName') . "   " . $request->input('empLastName');
            $emp->D0 = $request->input('empPriority');
            $emp->save();
            session()->flash('message', ' Info save successfuly.');
        }
        return redirect('ais/addUser');
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
    public function update(Request $request, $id)
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

//        AddUserModel::find(explode(',', $id));
//        alert($id);
    //$id=$request->input('empId');
        foreach($_GET['checkbox'] as $check) {
            //echo $check . ', ';
            AddUserModel::find($check)->delete();
        }
        return redirect('ais/addUser');
    }

    public function destroy($id)
    {
        Log::info('into destroy  ['.$id.']');
        AddUserModel::find($id)->delete();

        return redirect('ais/addUser');
    }
}
