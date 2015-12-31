<?php
/**
 * User: imake
 * Date: 12/11/15
 * Time: 16:35
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \App\Model\memberModel;
use Log;
class memberController extends Controller
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
    public  function postMember(Request $request){
        //Log::info("Into postMember");
        // do something
       
        $action=request("action");
        $name=request("name");
        $age=request("age");
        $id=request("id");
        
    
        
        $memberModel=null;
        if($action=='add'){
            $memberModel = new memberModel();
            $memberModel->name =$name;
            $memberModel->age =$age;
            $memberModel->save();
            session()->flash('message', ' Info save successfuly.');
            return '["addSuccess"]';
        }else{
            $memberModel =  memberModel::find($id);
            $memberModel->name=$name;
            $memberModel->age=$age;
            $memberModel->save();
            return '["editSuccess"]';
        }
        
        
        
    }
    public  function AllMember(){
 
         $memberModel =  new memberModel();
         $memberModel = $memberModel->get();
         return response()->json(['memberModel'=>json_encode($memberModel)]);
        
    }
    public  function delMember(Request $request){
        //Log::info("1111111111111111111111");
        Log::info(request('id'));
        
        $id=request('id');
        $memberModel= memberModel::find($id);
        $memberModel->delete();
        return '["success"]';
        
        
    }
    public  function editMember(Request $request){
        //Log::info("2222222222222222222222".request('id'));
         $id=request('id');
        $memberModel= memberModel::find($id);
        return response()->json(['memberModel'=>json_encode($memberModel)]);
        
       
    
    }
    
    
  
}
