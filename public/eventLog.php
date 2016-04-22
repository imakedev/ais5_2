<?php session_start();

/*
http://localhost:9952/eventLog.php?paramPCV=plantow47&paramUnit=4&paramEmpId=3&paramFromDate=2016-03-18%2000:00:00&paramToDate=2016-03-18%2014:48:00
*/
    $paramPCV=$_GET['paramPCV'];
    $paramUnit=$_GET['paramUnit'];
    $paramEmpId=$_GET['paramEmpId'];
    $paramFromDate=$_GET['paramFromDate'];
    $paramToDate=$_GET['paramToDate'];
    $rows = array();

    $user_mmplant=$_GET['user_mmplant'];
    
  if($paramPCV=='plantow47'){
      
      
      
      
      createDataEventPCVPlantow47($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate,$user_mmplant);
  }


 function createDataEventPCVPlantow47($paramPCV,$paramUnit,$paramEmpId,$paramFromDate,$paramToDate,$user_mmplant){

   //for test 2014-10-07 Hour 16:00 Minute 59:00 Span T 5
    
    $conn="";
    $rs="";

    $query="
    select   sys_date ,ois_event from event_raw
    WHERE sys_date  BETWEEN '$paramFromDate' AND '$paramToDate'
    AND ois_event REGEXP 'L83E131|40SP01E131|40NB01T001|40RM41D001|40RM42D001|40NB01P003|40NB01F001|40NB32F001|40RL11F001|40RL12F001|40RL13F001|40RA03T001|40RA03P002|40RA03F001|40SD11T001|40SD11T002|40VC21T001|40RC22T001|40NB35F001|40NC03P001|40NA40L001|40SD12L001|40SD11P001|40RL64T001|40RF50T00|40RB03T001|40RB03P003|40RB03F001|40NL85M901|40NG01F901|40NM11F001|40VC41T001|40NG14P002|40NG83P003|40RL61T00z|40RH30T001|40RH20T001|40RH12P001|40RM72T001|40RM68T001|40RM64T001|40RM61T001|40RH40T002|40RH40P005|40RH40L001'
    order by sys_date asc
    ";
    
    $query_test="
    select   sys_date ,ois_event from event_raw
    order by sys_date asc
    ";
    //REGEXP '$tagName'
    if($user_mmplant==1){
       
        //for test
        /*
        $host_db_params="localhost";
        $user_db_params="root";
        $pass_db_param="010535546";
        */
        
        $host_db_params="10.249.94.232";
        $user_db_params="root";
        $pass_db_param="seven";
        
    if($paramUnit==4){
        
        //echo $paramUnit;
        $schema_db_param="log04";
        //$schema_db_param="ais_db";
        $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
        $db = mysql_select_db($schema_db_param);
        $reslutQuery=  mysql_query($query);
        //for matt
        /*
          
         [{"EvTime":"2014-05-07 00:00:00","D32":149.609,"D266":222.561,"D1":0,"D2":0,"D264":157.985,"D261":129
.534,"D272":-0.0799523,"D137":67.9508,"D141":67.5184,"D253":2.29919,"D105":528.438,"D104":140.521}]
         */
      
       
        while($r = mysql_fetch_assoc($reslutQuery)) {
            $rows[] = $r;
        }
        
        //echo json_encode($rows);
        
        
        //echo json_encode($rs);
        
        
        //mysql_close($conn);

        //$reslutQuery = DB::connection('mysql_ais_log_47_4')->select($query);
        }else if($paramUnit==5){
            
        
            $schema_db_param="log05";
            $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
            $reslutQuery=  mysql_query($query);
            
        }else if($paramUnit==6){
            
            $schema_db_param="log06";
            $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
            $reslutQuery=  mysql_query($query);
            $rs = mysql_fetch_array($reslutQuery);
            while($r = mysql_fetch_assoc($reslutQuery)) {
                $rows[] = $r;
            }
            //echo json_encode($rs);
            
        }else if($paramUnit==7){
            
            $schema_db_param="log07";
            $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
            $reslutQuery=  mysql_query($query);
            $rs = mysql_fetch_array($reslutQuery);
            while($r = mysql_fetch_assoc($reslutQuery)) {
                $rows[] = $r;
            }
            //echo json_encode($rs);
            
        }
        

        }else if($user_mmplant==2){
       

        }else if($user_mmplant==3){
         

        }

        //return json_encode($reslutQuery);
        
        
        /*Create File*/
        
        $strFileName = "processView/flieProcessView/processViewJson-event-$paramPCV-$paramUnit-$paramEmpId.txt";
        $objCreate = fopen($strFileName, 'w');
        
        
        
        
        if($objCreate)
        {
            
        $objFopen = fopen($strFileName, 'w');
        $strText1 = json_encode($rows);
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

        }else{
        echo "File Not Create.";
        }
        

        //http://localhost:9999/ais/processView/createDataEventPCVSteam47/11/4/11/2014-05-01%2000:00:00/2014-05-01%2001:00:00
}
       
?>