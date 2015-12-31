<?php
include('../include/config.php');
include('../include/database.class.php');
include('../include/functions.php');
set_time_limit(0); //Unlimited max execution time

if(isset($_GET['trendindex'])){
header('Content-type: application/json');
$resultArray = array();
   if($_GET['_unit']==2){
     $host='10.249.91.207';
     $usr='Administrator';
     $pwd='larrabee';
//     $host='localhost';
//     $usr='root';
//     $pwd='';
     $db_name="avg8-13";
   }
  $db=new Database($host,$usr,$pwd,$db_name);//connect database
  $conn=$db->conn;
   if(isset($_GET['mmunit']))
     $sql="SELECT * FROM mmtrend_table WHERE G='".$_GET['trendindex']."' AND B ='".$_GET['mmunit']."' ORDER BY A";
   else
     $sql="SELECT * FROM mmtrend_table WHERE G='".$_GET['trendindex']."'  ORDER BY A";

  $result=$db->query($sql);
  $intNumField = mysql_num_fields($result);
    while($row = mysql_fetch_array($result)){
        $arrCol = array();
/*        for($i=0;$i<$intNumField;$i++){
            $arrCol[mysql_field_name($result,$i)] = $row[$i];
        }
        */
            $arrCol["mmunit"] = $row['B'];
            $arrCol["pointname"] = $row['C'];
            $arrCol["tagname"] = $row['D'];
            $arrCol["unitname"] = $row['E'];
            $arrCol["max"] = $row['F0'];
            $arrCol["min"] = $row['F1'];
            $arrCol["pointno"] = $row['H'];

            array_push($resultArray,$arrCol);
    }
    mysql_free_result($result);
    echo json_encode($resultArray);
}else{
  echo "Used : UnitSelected.php?trendindex=xxxxxx&mmunit=xx&_unit=(1=unit 4-7,2=unit 8-13)<br>";
  echo "if mmunit not set  return all point where trendindex=xxxxx<br><br><br>";
  echo "Return Value :<br>";
  echo "[mmunit] mmunit<br>";
  echo "[pointname] name of point<br>";
  echo "[tagname] name o ftag<br>";
  echo "[unitname] unit of value<br>";
  echo "[max] max value<br>";
  echo "[min] min value<br>";
  echo "[pointno] point number on datauxx colunm<br>";
}
?>