<?php
  mysql_connect("localhost","root","");
  mysql_select_db("appointment");
  mysql_query("SET NAMES UTF8");
  $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
  $format = strtolower($_GET['format']) == 'xml' ? 'xml' : 'json'; //json is the default
  $sql= "SELECT egat_id,`name`,`sec`,`div`,`dep` FROM `appointment`.`data_2557` limit $number_of_posts";
  $result=mysql_query($sql);
  while($row=mysql_fetch_assoc($result,MYSQL_ASSOC)){
    $output[]=$row;
  }
  print "{\"egat_id\": ";
  print(json_encode($output));
  print "}";
  mysql_free_result($result);
  mysql_close();
?>