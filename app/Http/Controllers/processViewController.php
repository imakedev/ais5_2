<?php
/**
 * User: kosit araomsava
 * Date: 8/12/15
 * Time: 13:45
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
use Log;
use Session;
use Auth;


class processViewController  extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
        Session::put('user_mmplant', '0');
    }
    public function createDataPCVSteam47($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate){
    
        Log::info("Into createDataPCVSteam47");
        
        $query="SELECT EvTime,D1,D2,D3,D4,D5,D6,D7,D8,D9,D10,D11,D12,D13,D2
                ,D14,D15,D16,D17,D18,D19
                ,D15,D16,D17,D18,D19,D20
                ,D16,D17,D18,D19,D20,D21
                from datau0$paramUnit 
                WHERE EvTime BETWEEN  '$paramFromDate' AND '$paramToDate'";
        $reslutQuery = DB::select($query);
        
        
        //return json_encode($reslutQuery);
        
        /*Create File*/
 
        $strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
        $objCreate = fopen($strFileName, 'w');
        if($objCreate)
        {
            //echo '["createJsonSuccess"]';
            /*write flie here start.*/
            
            $strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
            $objFopen = fopen($strFileName, 'w');
            $strText1 = json_encode($reslutQuery);
            fwrite($objFopen, $strText1);
            if($objFopen)
            {
                echo '["createJsonSuccess"]';
            }
            else
            {
                echo '["error"]';
            }
            fclose($objFopen);
            
            /*write flie here end.*/
        
        }else{
            echo "File Not Create.";
        }
        
        
        
       //http://localhost:9999/ais/processView/createDataPCVSteam47/11/4/11/2014-05-01%2000:00:00/2014-05-01%2001:00:00
  }
  
  public function createDataEventPCVSteam47($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate){
  
      Log::info("Into createDataEventPCVSteam47");
  
      $query="select  '2014-05-01 01:00:00' as 'sys_date' ,ois_event from event_raw
WHERE sys_date  BETWEEN '2014-10-07 00:00:00' AND '2014-10-07 16:23:00'
AND (ois_event LIKE '%L8%' or ois_event LIKE '%L4%' or ois_event LIKE '%L5%')
 order by sys_date asc ";
      
      $reslutQuery = DB::select($query);
  
  
      //return json_encode($reslutQuery);
  
      /*Create File*/
  
      $strFileName = "processView/flieProcessView/processViewJson-event-$paramPCV-$paramUnit-$paramEmpId.txt";
      $objCreate = fopen($strFileName, 'w');
      if($objCreate)
      {
      //echo '["createJsonSuccess"]';
      /*write flie here start.*/
  
          $strFileName = "processView/flieProcessView/processViewJson-event-$paramPCV-$paramUnit-$paramEmpId.txt";
          $objFopen = fopen($strFileName, 'w');
          $strText1 = json_encode($reslutQuery);
          fwrite($objFopen, $strText1);
          if($objFopen)
          {
          echo '["createJsonSuccess"]';
      }
      else
      {
      echo '["error"]';
      }
      fclose($objFopen);
  
          /*write flie here end.*/
  
      }else{
          echo "File Not Create.";
      }
  
  
  
      //http://localhost:9999/ais/processView/createDataEventPCVSteam47/11/4/11/2014-05-01%2000:00:00/2014-05-01%2001:00:00
      }
      
      public function readDataEventPCVSteam47($paramPCV,$paramUnit,$paramEmpId){
      
          Log::info("Into readDataPCVSteam47");
      
          $strFileName = "processView/flieProcessView/processViewJson-event-$paramPCV-$paramUnit-$paramEmpId.txt";
          $objFopen = fopen($strFileName, 'r');
          if ($objFopen) {
              while (!feof($objFopen)) {
                  $file = fgets($objFopen, 4096);
                  echo $file;
              }
              fclose($objFopen);
          }
          //http://localhost:9999/ais/processView/readDataEventPCVSteam47/11/4/11
      }
      
      public function readDataPCVSteam47($paramPCV,$paramUnit,$paramEmpId){
      
          Log::info("Into readDataPCVSteam47");

           $strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
          $objFopen = fopen($strFileName, 'r');
          if ($objFopen) {
              while (!feof($objFopen)) {
                  $file = fgets($objFopen, 4096);
                  echo $file;
              }
              fclose($objFopen);
          }
          
         
          
          
         
      }
      
      
      
      
      
/*################################## PCVPlantow47 START #######################################*/
      
      
      public function createDataPCVPlantow47($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate){
      
          Log::info("Into createDataPCVPlantow47");
          //SELECT DISTINCT H,D FROM mmtrend_table WHERE D IN ('40SP01E141','40SP01E171')
          $query="SELECT EvTime,
D32,
D266,
0 as 'D1',
0 as 'D2',
D264,
D261,
D272,
D137,
D141,
D253,
D105,
D104,
D103,
D146,
D147,
D14,
D56,
D273,
D267,
D260,
D148,
D145,
D270,
D258,
D114,
D113,
D112,
D131,
D223,
D133,
D16,
D229,
D225,
D269,
D165,
D163,
D161,
D160,
D159,
D158,
D157,
D151,
D150,
D149
          from datau0$paramUnit
          WHERE EvTime BETWEEN  '$paramFromDate' AND '$paramToDate'";
          $reslutQuery = DB::select($query);
      
      
          //return json_encode($reslutQuery);
      
          /*Create File*/
      
          $strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
          $objCreate = fopen($strFileName, 'w');
          if($objCreate)
          {
          //echo '["createJsonSuccess"]';
          /*write flie here start.*/
      
              $strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
              $objFopen = fopen($strFileName, 'w');
              $strText1 = json_encode($reslutQuery);
              fwrite($objFopen, $strText1);
              if($objFopen)
              {
              echo '["createJsonSuccess"]';
          }
          else
          {
          echo '["error"]';
          }
          fclose($objFopen);
      
              /*write flie here end.*/
      
          }else{
              echo "File Not Create.";
          }
      
      
      
          //http://localhost:9999/ais/processView/createDataPCVSteam47/11/4/11/2014-05-01%2000:00:00/2014-05-01%2001:00:00
          }
      
          
      public function createDataEventPCVPlantow47($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate){
  
      Log::info("Into createDataEventPlantow47");


      $sess_emp_id= Auth::user()->id;
      $user_mmplant= Session::get('user_mmplant');



      $query="
          select   sys_date ,ois_event from event_raw
          WHERE sys_date  BETWEEN '$paramFromDate' AND '$paramToDate'
          AND ois_event REGEXP '40SP01E131|40NB01T001|40RM41D001|40RM42D001|40NB01P003|40NB01F001|40NB32F001|40RL11F001|40RL12F001|40RL13F001|40RA03T001|40RA03P002|40RA03F001|40SD11T001|40SD11T002|40VC21T001|40RC22T001|40NB35F001|40NC03P001|40NA40L001|40SD12L001|40SD11P001|40RL64T001|40RF50T00|40RB03T001|40RB03P003|40RB03F001|40NL85M901|40NG01F901|40NM11F001|40VC41T001|40NG14P002|40NG83P003|40RL61T00z|40RH30T001|40RH20T001|40RH12P001|40RM72T001|40RM68T001|40RM64T001|40RM61T001|40RH40T002|40RH40P005|40RH40L001'
          order by sys_date asc
      ";
    //REGEXP '$tagName'
      if($user_mmplant==1){

          if($paramUnit==4){
              $reslutQuery = DB::connection('mysql_ais_log_47_4')->select($query);
          }else if($paramUnit==5){
              $reslutQuery = DB::connection('mysql_ais_log_47_5')->select($query);
          }else if($paramUnit==6){
              $reslutQuery = DB::connection('mysql_ais_log_47_6')->select($query);
          }else if($paramUnit==7){
              $reslutQuery = DB::connection('mysql_ais_log_47_7')->select($query);
          }


      }else if($user_mmplant==2){
          $reslutQuery = DB::connection('mysql_ais_813')->select($query);

      }else if($user_mmplant==3){
          $reslutQuery = DB::connection('mysql_ais_fgd')->select($query);

      }else{

         $query="select  '2014-05-01 01:00:00' as 'sys_date' ,ois_event from event_raw
          WHERE sys_date  BETWEEN '2014-10-07 00:00:00' AND '2014-10-07 16:23:00'
          AND ois_event REGEXP '40SP01E131|40NB01T001|40RM41D001|40RM42D001|40NB01P003|40NB01F001|40NB32F001|40RL11F001|40RL12F001|40RL13F001|40RA03T001|40RA03P002|40RA03F001|40SD11T001|40SD11T002|40VC21T001|40RC22T001|40NB35F001|40NC03P001|40NA40L001|40SD12L001|40SD11P001|40RL64T001|40RF50T00|40RB03T001|40RB03P003|40RB03F001|40NL85M901|40NG01F901|40NM11F001|40VC41T001|40NG14P002|40NG83P003|40RL61T00z|40RH30T001|40RH20T001|40RH12P001|40RM72T001|40RM68T001|40RM64T001|40RM61T001|40RH40T002|40RH40P005|40RH40L001'
          order by sys_date asc ";
          $reslutQuery = DB::select($query);

      }
      





      //return json_encode($reslutQuery);
      
      /*Create File*/
      
      $strFileName = "processView/flieProcessView/processViewJson-event-$paramPCV-$paramUnit-$paramEmpId.txt";
                  $objCreate = fopen($strFileName, 'w');
                  if($objCreate)
                  {
                  //echo '["createJsonSuccess"]';
                  /*write flie here start.*/
      
                  //$strFileName = "processView/flieProcessView/processViewJson-event-$paramPCV-$paramUnit-$paramEmpId.txt";
                  $objFopen = fopen($strFileName, 'w');
                      $strText1 = json_encode($reslutQuery);
                      fwrite($objFopen, $strText1);
                      if($objFopen)
                  {
                  echo '["createJsonSuccess"]';
                  }
                  else
                  {
                  echo '["error"]';
                  }
                  fclose($objFopen);
      
                  /*write flie here end.*/
      
                  }else{
                          echo "File Not Create.";
                          }
      
      
      
                          //http://localhost:9999/ais/processView/createDataEventPCVSteam47/11/4/11/2014-05-01%2000:00:00/2014-05-01%2001:00:00
          }
      
      public function readDataEventPCVPlantow47($paramPCV,$paramUnit,$paramEmpId){
  
          Log::info("Into readDataEventPlantow47");
  
          $strFileName = "processView/flieProcessView/processViewJson-event-$paramPCV-$paramUnit-$paramEmpId.txt";
          $objFopen = fopen($strFileName, 'r');
            if ($objFopen) {
            while (!feof($objFopen)) {
            $file = fgets($objFopen, 4096);
          echo $file;
          }
          fclose($objFopen);
          }
              //http://localhost:9999/ais/processView/readDataEventPCVSteam47/11/4/11
      }
  
      public function readDataPCVPlantow47($paramPCV,$paramUnit,$paramEmpId){

      Log::info("Into readDataPlantow47");

      $strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
      $objFopen = fopen($strFileName, 'r');
      if ($objFopen) {
      while (!feof($objFopen)) {
      $file = fgets($objFopen, 4096);
      echo $file;
      }
      fclose($objFopen);
      }

       


       
    }
 /*################################## PCVPlantow47 END #######################################*/
    public function testMultiConnection(Request $request){
       Log::info("Into testMultiConnection");
        
       /*
      $query="select * from books ";
      $reslutQuery = DB::connection('mysql_ais_pd')->query($query);
      */
      $query="select * from books ";
      $reslutQuery = DB::connection('mysql_ais_pd')->select($query);
     // return $reslutQuery;
      return json_encode($reslutQuery);

    }
    public function testConnection47(Request $request){
        Log::info("Into testMultiConnection");
    
        /*
         $query="select * from books ";
        $reslutQuery = DB::connection('mysql_ais_pd')->query($query);
        */
        $query="select * from books ";
        $reslutQuery = DB::connection('mysql_ais_pd')->select($query);
        // return $reslutQuery;
        return json_encode($reslutQuery);
    
    }
    
    
   
}