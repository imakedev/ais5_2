<?php
header("Access-Control-Allow-Origin: *");
include('../include/config.php');
include('../include/database.class.php');
include('../include/functions.php');
set_time_limit(0); //Unlimited max execution time

if(isset($_GET['pointno'])){
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
        $pwd='010535546';
      // $pwd='p@ssw0rd';
       $db_name="ais";
       
      $sql="SELECT mmtrend_table.B AS mmunit,mmtrend_table.C AS description,mmtrend_table.D AS tagname,mmtrend_table.E,mmtrend_table.F0,mmtrend_table.F1,mmtrend_table.G,mmtrend_table.H
    FROM  mmtrend_table
    WHERE  mmtrend_table.H = '".$_GET['pointno']."' AND mmtrend_table.B >7
    GROUP BY
    mmtrend_table.B";
   }else{
      $sql="SELECT mmtrend_table.B AS mmunit,mmtrend_table.C AS description,mmtrend_table.D AS tagname,mmtrend_table.E,mmtrend_table.F0,mmtrend_table.F1,mmtrend_table.G,mmtrend_table.H
    FROM  mmtrend_table
    WHERE  mmtrend_table.H = '".$_GET['pointno']."'  AND mmtrend_table.B <8
    GROUP BY
    mmtrend_table.B";

   }

  $db=new Database($host,$usr,$pwd,$db_name);//connect database
  $conn=$db->conn;

// echo $sql;
  $result=$db->query($sql);
  $intNumField = mysql_num_fields($result);
    while($row = mysql_fetch_array($result)){
        $arrCol = array();
            $arrCol["mmunit"] = $row['mmunit'];
            $arrCol["pointname"] = $row['description'];
            $arrCol["tag"] = $row['tagname'];
            $arrCol["unit"] = $row['E'];
            $arrCol["max"] = $row['F0'];
            $arrCol["min"] = $row['F1'];
            $arrCol["pointno"] = $_GET['pointno'];

            array_push($resultArray,$arrCol);
    }
    mysql_free_result($result);
    echo json_encode($resultArray);
}else{
  echo "Used : PointName.php?pointno=xxxxxx&_unit=(1=unit 4-7,2=unit 8-13)<br>";
  echo "_unit= (1=unit 4-7,2=unit 8-13) default= 1<br>";
  echo "pointno=number of point<br>";

  echo "Return Value :<br>";
  echo "[mmunit] unit of power plant<br>";
  echo "[pointname] Description<br>";
  echo "[tag] tag name<br><br>";
  echo "[unit] measurement unit<br>";
  echo "[max] max value<br>";
  echo "[min] min value<br>";
  echo "[pointno] point number of column trend<br>";
}
//http://localhost/ais_service/webservice/PointName.php?pointno=244&_unit=1
?>