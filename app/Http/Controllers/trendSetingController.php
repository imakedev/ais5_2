<?php
/**
 * User: kosit araomsava
 * Date: 24/11/15
 * Time: 9:17
 */

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
 use Illuminate\Support\Facades\DB;
 use Illuminate\Pagination\LengthAwarePaginator;
 use \App\Model\trendGroupModel;
 use Log;
 use Session;
 use Auth;

class trendSetingController extends Controller
{
    public function getAllTrendGroup(){
        //Test 001
        Log::info("Into getAllGroup");
       // $trendGroupModel = trendGroupModel::all();
        $myTrend= Auth::user()->empId;
        $query="
                select * from(
                select $myTrend AS B, 'My Trend' as group_name
                UNION
                select B,group_name from mmtrend_group where B!=9
                )queryA
                ";
        $reslutQuery = DB::select($query);
        
        
        Log::info($reslutQuery); 
        return json_encode($reslutQuery);
        
    }
    public function getTrendGroupBySearch(){
        Log::info("Into getTrendGroupBySearch");
    }
    public function getTrendByGroup($id,$trendGroupName=null){
        
       
        if($trendGroupName!=null){
            //echo "trendName";
        $query="select * from mmname_table
        WHERE A LIKE '%$trendGroupName%'";
        //mysql
        //$reslutQuery = DB::connection('mysql_ais_47')->select($query);
        $reslutQuery = DB::select($query);
        Log::info(json_encode($reslutQuery));
        return json_encode($reslutQuery);
        }else{
            //echo "idgroup";
        $query="select * from mmname_table WHERE (B='$id' or '$id'='All')";
        //$trendByGroup = DB::connection('mysql_ais_47')->select($query);
        $trendByGroup = DB::select($query);
        Log::info(json_encode($trendByGroup));
        return json_encode($trendByGroup);
        }
        
    }
   

    public function getPointByPointID($pontID){
    
    
        Log::info("Into getPointByPointID");
        // Log::info($trendID);
        // Log::info($unitID);
    
        $query="select * from mmtrend_table WHERE ZZ IN($pontID)";
        $reslutQuery = DB::select($query);
        //$reslutQuery = DB::connection('mysql_ais_47')->select($query);
        Log::info(json_encode($reslutQuery));

        return json_encode($reslutQuery);
    
    
    }
    
    public function getPointByTrend($trendID,$unitID){
        
        
        Log::info("Into getPointByTrend");
       // Log::info($trendID);
       // Log::info($unitID);
        
        $query="select * from mmtrend_table where G='$trendID'  
                AND (B='$unitID' or 'All'='$unitID')";
        
        $reslutQuery = DB::select($query);
        //$reslutQuery = DB::connection('mysql_ais_47')->select($query);
        Log::info(json_encode($reslutQuery));
        return json_encode($reslutQuery);
        
        
    }
    public function getDataByQuery($query){
    /*
        $mmtrend_group = DB::table('mmtrend_group')
                     ->select(DB::raw('*'))
                      ->where('B', '=', $param)
                     ->groupBy('B')
                     ->get();
        */
        $mmtrend_group = DB::select($query);
        //$mmtrend_group = DB::connection('mysql_ais_47')->select($query);
        Log::info(json_encode($mmtrend_group));
    }
    public function getTrendByTrendNameGroup($trendNameGroup){
        //echo $trendName;
        
        $query="select * from mmname_table
        WHERE A LIKE '%$trendNameGroup%'";
        
        $reslutQuery = DB::select($query);
        //$reslutQuery = DB::connection('mysql_ais_47')->select($query);
        Log::info(json_encode($reslutQuery));
        return json_encode($reslutQuery);
        
        
    }
    
}