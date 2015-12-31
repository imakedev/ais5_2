<?php
header("Access-Control-Allow-Origin: *");
include('../include/config.php');
include('../include/database.class.php');
include('../include/functions.php');
set_time_limit(0); //Unlimited max execution time

if(isset($_GET['starttime']) && isset($_GET['endtime'])){
if(isset($_GET['mmunit'])){
header('Content-type: application/json');
$p_list=explode(",",$_GET['point']);


$_point="";
for ($i=0;$i<=count($p_list);$i++){
    if ( ! isset($p_list[$i])) {
        //$parts[$i] = null;
        $_point = $_point.null.",";
    }else{
      // echo $p_list[$i];
        $_point = $_point.$p_list[$i].",";
    }
   
  //echo $_point.$p_list[$i]."=".$i;
  //$_point = $_point.$p_list[$i].",";
}
$_point = substr($_point,0,strlen($_point)-2);
$resultArray = array();
   if($_GET['_unit']==2){
     /*
     $host='10.249.91.207';
     $usr='Administrator';
     $pwd='larrabee';
     $db_name="avg8-13";
     */
       $host='10.249.99.107';
       $usr='root';
      // $pwd='010535546';
       $pwd='p@ssw0rd';
       $db_name="ais";
       
   }
  $db=new Database($host,$usr,$pwd,$db_name);//connect database
  $conn=$db->conn;
  $sql="SELECT EvTime,".$_point." FROM datau".$_GET['mmunit']." WHERE EvTime BETWEEN '".$_GET['starttime']."' and '".$_GET['endtime']."'";

 // echo $sql;
  $result=$db->query($sql);
  $resultArray = array();
  $intNumField = mysql_num_fields($result);
  if(mysql_num_rows($result)) {
    header('Content-type: application/json');
    while($row = mysql_fetch_array($result)){
        $arrCol = array();
        for($i=0;$i<$intNumField;$i++){
          if($i>0)
            $arrCol[mysql_field_name($result,$i)] = number_format($row[$i],2);
          else
            $arrCol[mysql_field_name($result,$i)] = $row[$i];
        }
        array_push($resultArray,$arrCol);
    }
  }

    mysql_free_result($result);
    
    /*Create File*/
    $paramTrendID=$_GET['paramTrendID'];
    $strFileName = "fileTrend/trendJson-$paramTrendID.txt";
    chmod($strFileName, 0755);
    $objCreate = fopen($strFileName, 'w');
    if($objCreate)
    {
        /*write flie here start.*/    
        $strFileName = "fileTrend/trendJson-$paramTrendID.txt";
        $objFopen = fopen($strFileName, 'w');
        $strText1 = json_encode($resultArray);
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
        
    }
    else
    {
        echo "File Not Create.";
    }
 

    
    
    
    //echo json_encode($resultArray);
    }else{
  echo "Used : PlotGraph.php?starttime=yyyy-mm-dd hh:mm:ss&endtime=yyyy-mm-dd hh:mm:ss&mmunit=xx&point=d1,d2,d3&_unit=(1=unit 4-7,2=unit 8-13)<br>";
  echo "if point is d1..d999<br><br>";
  echo "if mmunit not set  return all point where trendindex=xxxxx<br><br><br>";

  echo "Return Value :<br>";
  echo "[evtime] time<br>";
  echo "[point] name of point<br>";
  echo "[value] value o point<br>";
    }
}else{
  echo "Used : PlotGraph.php?starttime=yyyy-mm-dd hh:mm:ss&endtime=yyyy-mm-dd hh:mm:ss&mmunit=xx&point=d1,d2,d3&_unit=(1=unit 4-7,2=unit 8-13)<br>";
  echo "if point is d1..d999<br><br>";
  echo "if mmunit not set  return all point where trendindex=xxxxx<br><br><br>";

  echo "Return Value :<br>";
  echo "[evtime] time<br>";
  echo "[point] name of point<br>";
  echo "[value] value o point<br>";
}
//http://localhost/ais_service/test/writeFile.php?starttime=2014-05-01%2000:00:00&endtime=2014-05-01%2001:00:00&mmunit=04&point=D19,D999&_unit=1
?>

