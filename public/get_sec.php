<?php
set_time_limit(0); //Unlimited max execution time
error_reporting(E_ALL ^ E_NOTICE);
header('Cache-control: private'); // IE 6 FIX
// always modified
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
// HTTP/1.1
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
// HTTP/1.0
header('Pragma: no-cache');



$url = '/mnt/aisdata/MM08/0820140521/08201405210000.dat';
$p = array(10,15,20,25,30);
get_secdata();



function get_secdata(){
    global $url;
    global $p;

    $hd = fopen($url,"rb");

        $data = fread($hd,6);
        $ar = unpack("vid/fdata",$data);
        fseek($hd,($ar['data']+1)*6);

        while (!feof($hd)){

        $data = fread($hd,6);
              if(strlen($data)!=6) {
               //echo "length ".strlen($data);
                break;
              }
        $ar = unpack("vid/fdata",$data);

        echo "sec : ".$ar['id']."->".$ar['data']."<br>";


          for($i=0;$i<=$ar['data']-1;$i++){
            $data = fread($hd,6);
            $arr = unpack("vid/fdata",$data);
            $trend_data[$arr['id']]=$arr['data'];

          }

          foreach ($p as $key=>$value) {
              echo "Point : " .$p[$key] .", data : ".$trend_data[$value]."<br />\n";
          }
      }

    fclose($hd);
}





?>