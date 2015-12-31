<?php
header("Access-Control-Allow-Origin: *");
include('../include/config.php');
include('../include/database.class.php');
include('../include/functions.php');
set_time_limit(0); //Unlimited max execution time

if(isset($_GET['trend'])){
header('Content-type: application/json');
$resultArray = array();
   if($_GET['_unit']==2){
       /*
     $host='10.249.91.207';
     $usr='Administrator';
     $pwd='larrabee';
     $db_name="avg8-13";
     */
       $host='localhost';
       $usr='root';
       //$pwd='010535546';
       $pwd='p@ssw0rd';
       $db_name="ais";
   }
  $db=new Database($host,$usr,$pwd,$db_name);//connect database
  $conn=$db->conn;

  if($_GET['trend']=='All')
    $sql="SELECT * FROM mmname_table WHERE  B<>'' ORDER BY A";
  else if($_GET['trend']=='Point')
    $sql="SELECT * FROM mmpoint_table ORDER BY B";
  else
    $sql="SELECT * FROM mmname_table WHERE B=".$_GET['trend']." AND B<>'' ORDER BY A";

  $result=$db->query($sql);
  $intNumField = mysql_num_fields($result);
    while($row = mysql_fetch_array($result)){
        $arrCol = array();
/*        for($i=0;$i<$intNumField;$i++){
            $arrCol[mysql_field_name($result,$i)] = $row[$i];
        }
        */
        if($_GET['trend']!='Point'){
            $arrCol["trendname"] = $row['A'];
            $arrCol["trendgroup"] = $row['B'];
            $arrCol["trendindex"] = $row['ZZ'];
            array_push($resultArray,$arrCol);
         }else{
            $arrCol["pointname"] = $row['B'];
            $arrCol["tagindex"] = $row['H'];
            array_push($resultArray,$arrCol);
         }
    }
    mysql_free_result($result);
    echo json_encode($resultArray);
}else{
  echo "Used : TrendGroup.php?trend=xxxxxx&_unit=(1=unit 4-7,2=unit 8-13) default=1<br>";
  echo "if trend=All  return all trend<br>";
  echo "if trend=Point  return all point<br>";
  echo "other return trend name in group xxxxxx<br><br>";
  echo "Return Value :<br>";
  echo "[trendname] name of trend<br>";
  echo "[trendgroup] group of trend<br>";
  echo "[trendindex] index of trend<br><br>";
  echo "Return Value if trend=Point<br>";
  echo "[pointname] name of point<br>";
  echo "[tagindex] index of tag index<br>";
}
//example
//http://localhost/ais_service/webservice/TrendGroup.php?trend=Point&_unit=1
?>