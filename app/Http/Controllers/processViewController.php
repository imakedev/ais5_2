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


class processViewController  extends Controller{
 
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
      
          $query="SELECT EvTime,D1,D2,D3,D4,D5,D6,D7,D8,D9,D10,D11,D12,D13,D2
          ,D14,D15,D16,D17,D18,D19
          ,D15,D16,D17,D18,D19,D20
          ,D21,D22,D23,D24,D25,D26
		  ,D27,D28,D29,D30,D31,D32
		  ,D33,D34,D35,D36,D37,D38
		  ,D39,D40,D41,D42,D43,D44,D45
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