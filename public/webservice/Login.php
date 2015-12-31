<?php
header("Access-Control-Allow-Origin: *");
include('../include/config.php');
include('../include/database.class.php');
include('../include/functions.php');


$resultArray = array();
if(isset($_GET['username'])){
header('Content-type: application/json');
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
    $db_name="ais";
    
   }
   $xuser=chk_login($_GET['username'],$_GET['passwd']);
   if($xuser){
     $_user=explode(",",$xuser);
//     print_r($_user);
     $arrCol["author"] = 1;
     $arrCol["egat_id"] = $_user[0];
     $arrCol["fullname"] = TIStoUTF($_user[1]);
     $arrCol["unit"] = $_GET['_unit'];
   }else{
      $arrCol["author"] = 0;
   }


array_push($resultArray,$arrCol);
echo json_encode($resultArray);

}else{
  echo "Used : Login.php?username=egat_id&passwd=password&_unit=(1=unit 4-7,2=unit 8-13)<br><br>";
  echo "Return Value :<br>";
  echo "[author] 0=login fail! ,1=login seccuss<br>";
  echo "[egat_id] egat-id<br>";
  echo "[fullname] Full name of user<br>";
  echo "[unit] 1=unit 4-7,2=unit 8-13<br>";
}
?>