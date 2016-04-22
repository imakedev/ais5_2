<?php 

$tagName=$_GET['tagName'];
$startDateTime=$_GET['startDateTime'];
$endDateTime=$_GET['endDateTime'];
$event=$_GET['event'];
$sess_emp_id=$_GET['sess_emp_id'];
$user_mmplant=$_GET['user_mmplant'];
$unit=$_GET['unit'];

/*
http://localhost:9952/getLogByTrend.php?tagName=0173&startDateTime=2014-10-07%2000:00:00&endDateTime=2014-10-07%2023:00:00&event=vpser&sess_emp_id=3&user_mmplant=1&unit=4
*/
readEventDataTrendByEvent($tagName,$startDateTime,$endDateTime,$event,$sess_emp_id,$user_mmplant,$unit);

function readEventDataTrendByEvent($tagName,$startDateTime,$endDateTime,$event,$sess_emp_id,$user_mmplant,$unit){    
   
   $rows = array();
   $host_db_params="";
   $user_db_params="";
   $pass_db_param="";
   
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
        
        
        
    }else if($user_mmplant==2){
        

        /*
        $host_db_params="";
        $user_db_params="";
        $pass_db_param="";
        */
        
        
        
    }else if($user_mmplant==3){
        
        /*
        $host_db_params="";
        $user_db_params="";
        $pass_db_param="";
        */
    }
    
     if($event=='vpser'){
        
         
        $query="
                select sys_date as 'EvTime',vpser_raw.ois_vpser from vpser_raw
                where vpser_raw.ois_vpser REGEXP '$tagName'
                AND vpser_raw.sys_date BETWEEN '$startDateTime'  AND  '$endDateTime' 
            	
                    	";
        
        
        if($user_mmplant==1){
            
          

            if($unit==4){
               $schema_db_param="log04";
              // $schema_db_param="ais_db";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
               
               
            }else if($unit==5){
                //echo "data here mysql_ais_log_47_5";
               $schema_db_param="log05";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
               
            }else if($unit==6){
                //echo "data here mysql_ais_log_47_6";
                $schema_db_param="log06";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
            }else if($unit==7){
               // echo "data here mysql_ais_log_47_7";
                $schema_db_param="log07";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
            }
            
            
        }else if($user_mmplant==2){
           
            
        }else if($user_mmplant==3){
           
            
        }
        
        echo json_encode($rows);
        //return json_encode($rows);
        

     }else if($event=='event'){
         
         $query="
                
                select sys_date as 'EvTime',event_raw.ois_event from event_raw
                where event_raw.ois_event REGEXP '$tagName'
                AND event_raw.sys_date BETWEEN '$startDateTime'  AND  '$endDateTime' 
                	
                	";
      if($user_mmplant==1){
            
           
            
            if($unit==4){
             $schema_db_param="log04";
              // $schema_db_param="ais_db";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
               
            }else if($unit==5){
             //$schema_db_param="log05";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
            }else if($unit==6){
            //$schema_db_param="log06";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
            }else if($unit==7){
            //$schema_db_param="log07";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
            }
            
            
        }else if($user_mmplant==2){
            
            
        }else if($user_mmplant==3){
           
            
        }
         return json_encode($rows);
         
         
     } else if($event=='action'){
          
         $query="
                select sys_date as 'EvTime',action_raw.ois_action from action_raw
                where action_raw.ois_action REGEXP '$tagName'
                AND action_raw.sys_date BETWEEN '$startDateTime'  AND  '$endDateTime' 
                	";
      if($user_mmplant==1){
         
          
            if($unit==4){
                
               $schema_db_param="log04";
               //$schema_db_param="ais_db";
               
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
                
                //$reslutQuery = DB::connection('mysql_ais_log_47_4')->select($query);
            }else if($unit==5){
               $schema_db_param="log05";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
            }else if($unit==6){
               $schema_db_param="log06";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
            }else if($unit==7){
               $schema_db_param="log07";
               $conn = @mysql_connect($host_db_params, $user_db_params, $pass_db_param);
               $db = mysql_select_db($schema_db_param);
               $reslutQuery=  mysql_query($query);
               while($r = mysql_fetch_assoc($reslutQuery)) {
                   $rows[] = $r;
               }
            }
            
            
        }else if($user_mmplant==2){
            
            
        }else if($user_mmplant==3){
          
            
        }
         return json_encode($rows);
          
          
     }
   
}
?>