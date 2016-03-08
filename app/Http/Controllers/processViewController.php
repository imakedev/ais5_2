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
    
    public function __construct(){

        //Session::put('user_mmplant', '0');

    }
    /*################################## PCVSteam47 START #######################################*/
    public function createDataPCVSteam47($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate){
    
        Log::info("Into createDataPCVSteam47");
        

        $sess_emp_id= Auth::user()->id;
        $user_mmplant= Session::get('user_mmplant');


        $query="SELECT EvTime,
        D32,
        D260,
        D267,
        D98,
        D99,
        D101,
        D105,
        D104,
        D103,
        D96,
        D93,
        D109,
        D108,
        D55,
        D56,
        D52,
        D119,
        D54,
        D53,
        D218,
        D282,
        D114,
        D113,
        D112,
        D115,
        D116,
        D117,
        D118,
        D273,
        D1,
        D107,
        D106,
        D111,
        D110
        from datau0$paramUnit
        WHERE EvTime BETWEEN  '$paramFromDate' AND '$paramToDate'";



        if($user_mmplant==0){
            $reslutQuery = DB::select($query);

        }if($user_mmplant==1){
            $reslutQuery = DB::connection('mysql_ais_47')->select($query);
        }
        




        //return json_encode($reslutQuery);
        
        /*Create File*/
 
        $strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
        $objCreate = fopen($strFileName, 'w');
        if($objCreate)
        {
            //echo '["createJsonSuccess"]';
            /*write flie here start.*/
            
            //$strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
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
  

      $sess_emp_id= Auth::user()->id;
      $user_mmplant= Session::get('user_mmplant');



      $query="
      select   sys_date ,ois_event from event_raw
      WHERE sys_date  BETWEEN '$paramFromDate' AND '$paramToDate'
      AND ois_event REGEXP '40SP01E131|40NA40L001|40NC03P001|40NA25T001|40NA26T001|40RA01T002|40RA03T001|40RA03P002|40RA03F001|40RC03T001|40NF01G004|40RA08T001|40RA08P001|40RC22P001|40RC22T001|40RC05T001|40RC04T001|40RC09T001|40RC07T001|40RB01T001|40RB02T001|40RB03T001|40RB03P003|40RB03F001|40RB04P001|40RB04T001|40RB05P001|40RB05T001|40NB35F001|40RF01P001|40RA07T001|40RA07P001|40SF62P001|40SF61P001'
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
          AND ois_event REGEXP 'L|40SP01E131|40NA40L001|40NC03P001|40NA25T001|40NA26T001|40RA01T002|40RA03T001|40RA03P002|40RA03F001|40RC03T001|40NF01G004|40RA08T001|40RA08P001|40RC22P001|40RC22T001|40RC05T001|40RC04T001|40RC09T001|40RC07T001|40RB01T001|40RB02T001|40RB03T001|40RB03P003|40RB03F001|40RB04P001|40RB04T001|40RB05P001|40RB05T001|40NB35F001|40RF01P001|40RA07T001|40RA07P001|40SF62P001|40SF61P001'
          order by sys_date asc ";
          $reslutQuery = DB::select($query);

      }



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
      
      /*################################## PCVSteam47 END #######################################*/

      /*################################## PCVFGD67 START #######################################*/
      public function createDataPCVFGD($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate){

          Log::info("Into createDataPCVFGD");


          $sess_emp_id= Auth::user()->id;
          $user_mmplant= Session::get('user_mmplant');


          $query="SELECT EvTime,
            D32,
            D276,
            D220,
            D1,
            D219,
            D285,
            D284,
            D1,
            D1,
            D362,
            D1,
            D355,
            D365,
            D357,
            D1,
            D358,
            D354,
            D359,
            D360,
            D361,
            D1,
            D363
          from datau0$paramUnit
          WHERE EvTime BETWEEN  '$paramFromDate' AND '$paramToDate'";



          if($user_mmplant==0){
          $reslutQuery = DB::select($query);

          }if($user_mmplant==1){
          $reslutQuery = DB::connection('mysql_ais_47')->select($query);
          }





          //return json_encode($reslutQuery);

          /*Create File*/

          $strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
          $objCreate = fopen($strFileName, 'w');
          if($objCreate)
          {
          //echo '["createJsonSuccess"]';
          /*write flie here start.*/

          //$strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
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

public function createDataEventPCVFGD($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate){

      Log::info("Into createDataEventPCVFGD");


          $sess_emp_id= Auth::user()->id;
          $user_mmplant= Session::get('user_mmplant');



          $query="
          select   sys_date ,ois_event from event_raw
          WHERE sys_date  BETWEEN '$paramFromDate' AND '$paramToDate'
          AND ois_event REGEXP '40SP01E131|
            40NR33T001|
            40NR33P001|
            40NR33D001|
            40NR33G004|
            40NR43T001|
            40NR43P001|
            40NR43D001|
            40NR43G001|
            45WF05Q904|
            45WF18P002|
            45WF05Q002|
            45WF05Q003|
            45WF05Q005|
            45WF18P001|
            45WF01P901|
            45WF01Q001|
            45WF01T001|
            45WF01T002|
            45WF01T003|
            45WF18D001|
            45WF18U001
          '
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
                AND ois_event REGEXP 'L|
                        40SP01E131|
                        40NR33T001|
                        40NR33P001|
                        40NR33D001|
                        40NR33G004|
                        40NR43T001|
                        40NR43P001|
                        40NR43D001|
                        40NR43G001|
                        45WF05Q904|
                        45WF18P002|
                        45WF05Q002|
                        45WF05Q003|
                        45WF05Q005|
                        45WF18P001|
                        45WF01P901|
                        45WF01Q001|
                        45WF01T001|
                        45WF01T002|
                        45WF01T003|
                        45WF18D001|
                        45WF18U001
                            '
                order by sys_date asc ";
          $reslutQuery = DB::select($query);

      }



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

public function readDataEventPCVFGD($paramPCV,$paramUnit,$paramEmpId){

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

public function readDataPCVFGD($paramPCV,$paramUnit,$paramEmpId){

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

/*################################## PCVFGD67 END #######################################*/
/*################################## PCVTurbine47 START #######################################*/
public function createDataPCVTurbine47($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate){

          Log::info("Into createDataPCVFGD");


          $sess_emp_id= Auth::user()->id;
          $user_mmplant= Session::get('user_mmplant');


          $query="SELECT EvTime,
            D32,
            D152,
            D153,
            D146,
            D147,
            D76,
            D77,
            D159,
            D160,
            D158,
            D157,
            D156,
            D169,
            D145,
            D148,
            D1,
            D1,
            D1,
            D1
          from datau0$paramUnit
          WHERE EvTime BETWEEN  '$paramFromDate' AND '$paramToDate'";



          if($user_mmplant==0){
              $reslutQuery = DB::select($query);

          }if($user_mmplant==1){
              $reslutQuery = DB::connection('mysql_ais_47')->select($query);
          }





          //return json_encode($reslutQuery);

          /*Create File*/

          $strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
          $objCreate = fopen($strFileName, 'w');
          if($objCreate)
          {
              //echo '["createJsonSuccess"]';
              /*write flie here start.*/

              //$strFileName = "processView/flieProcessView/processViewJson-$paramPCV-$paramUnit-$paramEmpId.txt";
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

public function createDataEventPCVTurbine47($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate){

          Log::info("Into createDataEventPCVFGD");


          $sess_emp_id= Auth::user()->id;
          $user_mmplant= Session::get('user_mmplant');



          $query="
          select   sys_date ,ois_event from event_raw
          WHERE sys_date  BETWEEN '$paramFromDate' AND '$paramToDate'
          AND ois_event REGEXP '40SP01E131|
40RW05L002|
40RW05T001|
40SD11T001|
40SD11T002|
40SA32P001|
40SA32T001|
40RM68T001|
40RM72T001|
40RM64T001|
40RM61T001|
40RM61F001|
45VD00L001|
40SD11P001|
40SD12L001|
40VC10D001|
40VC11D001|
40RM41D001|
40RM42D001|
45VD00L001|
40RW05L002
          '
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
          AND ois_event REGEXP 'L|
                40SP01E131|
                40RW05L002|
                40RW05T001|
                40SD11T001|
                40SD11T002|
                40SA32P001|
                40SA32T001|
                40RM68T001|
                40RM72T001|
                40RM64T001|
                40RM61T001|
                40RM61F001|
                45VD00L001|
                40SD11P001|
                40SD12L001|
                40VC10D001|
                40VC11D001|
                40RM41D001|
                40RM42D001|
                45VD00L001|
                40RW05L002
                    '
        order by sys_date asc ";
  $reslutQuery = DB::select($query);

}



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

public function readDataEventPCVTurbine47($paramPCV,$paramUnit,$paramEmpId){

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

public function readDataPCVTurbine47($paramPCV,$paramUnit,$paramEmpId){

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

/*################################## PCVTurbine47 END #######################################*/

      
      
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