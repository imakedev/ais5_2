<?php header("Access-Control-Allow-Origin: *");?>
<?php 
/*echo $_GET['paramEvent']."<br>";
echo $_GET['paramAction']."<br>";
echo $_GET['paramVpser']."<br>";
*/
echo "<div style='border:1px solid white'>";
if($_GET['paramEvent']=="event"){
echo "<b style='color:yellow';>Event:</b><span style='color:white';>4/92050159.06.51.51.359 RW36U001 COMD</span><br>";
}
if($_GET['paramAction']=="action"){
echo "<b style='color:yellow';>Action:</b><span style='color:white';>4/92050159.06.51.51.359 RW36U001 COMD</span><br>";
}
if($_GET['paramVpser']=="vpser"){
echo "<b style='color:yellow';>VPSER:</b><span style='color:white';>4/92050159.06.51.51.359 RW36U001 COMD</span><br>";
}
echo "</div>";  
//echo $_GET['paramEvtime']."<br>";
?>

