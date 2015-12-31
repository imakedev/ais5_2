<?php
include('config.php');
include('../include/database.class.php');

//<pre>/* require the user as the parameter */
//<pre>//http://localhost:8080/sample1/webservice1.php?user=1
//if(isset($_GET['user']) && intval($_GET['user'])) {
  /* soak in the passed variable or set our own */
  $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
  $format = strtolower($_GET['format']) == 'xml' ? 'xml' : 'json'; //xml is the default
  $user_id = intval($_GET['user']); //no default
  /* connect to the db */
  $db=new Database($host,$usr,$pwd,$db_name);//connect database
  $conn=$db->conn;

 // $link = mysql_connect('localhost','root','') or die('Cannot connect to the DB');
 // mysql_select_db('appointment',$link) or die('Cannot select the DB');
 // mysql_query("SET NAMES UTF8");
  /* grab the posts from the db */
  //$query = "SELECT post_title, guid FROM wp_posts WHERE post_author =
  //  $user_id AND post_status = 'publish' ORDER BY ID DESC LIMIT $number_of_posts";
  $query = "SELECT
datau08.EvTime,
datau08.d1,
datau08.d2,
datau08.d3,
datau08.d4,
datau08.d5
FROM
datau08
WHERE
datau08.EvTime BETWEEN '2014-09-13 00:00:00' and '2014-09-13 02:59:00'
";
  //echo $query;
  //$result = mysql_query($query,$link) or die('Errant query:  '.$query);
  $result=$db->query($query);
  /* create one master array of the records */
  //$posts = array();
  $resultArray = array();
  $intNumField = mysql_num_fields($result);
  if(mysql_num_rows($result)) {
    header('Content-type: application/json');
    while($row = mysql_fetch_array($result)){
        $arrCol = array();
        for($i=0;$i<$intNumField;$i++){
            $arrCol[mysql_field_name($result,$i)] = $row[$i];
        }
        array_push($resultArray,$arrCol);
    }
  }

echo json_encode($resultArray);
?>