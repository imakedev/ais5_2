<?php
function text_number($fid){
//ถอดรหัส
    $txt_len=strlen($fid);
    if($txt_len>255)
      $txt_len=255;
      $d=0;
      $j=0;
      for($i=0;$i<=$txt_len;$i++){
        $d=$d+(ord(substr($fid,$i,1)) * pow(10,$j));
        $j++;
      }
      return $d;
}
function chk_login($username,$passwd){
//include('include/config.php');
//include('include/database.class.php');
global $host;
global $usr;
global $pwd;
   $db=new Database($host,$usr,$pwd,"employee");//connect database
    $conn=$db->conn;
    $sql="select * from mmemployee_table where E='".text_number($username)."' and F='".text_number($passwd)."'";
    $result=$db->query($sql);
    if(mysql_num_rows($result)>0){
       $row= mysql_fetch_object($result);
       return $row->A.",".$row->B.$row->C;
    }else
       return false;
    $db->close();
}

function TIStoUTF($s_txt)
{
    $s_txt=iconv("TIS-620","UTF-8",$s_txt);
    return $s_txt;
}

function UTFtoTIS($s_txt)
{
    $s_txt=iconv("UTF-8","TIS-620",$s_txt);
    return $s_txt;
}

?>