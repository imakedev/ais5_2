<?php

class Database {
    var $host="";
    var $user_name="";
    var $pwd="";
    var $db_name="";
    var $conn="";
    
    //ถ้า database ตัวนี้ถูกสร้างมันจะทำงานอัตโนมัติ
    function __construct($host,$usr,$pwd,$db_name) {
        $this->host=$host;
        $this->user_name=$usr;
        $this->pwd=$pwd;
        $this->db_name=$db_name;
        $this->connect();
        $this->selectDB();
    }

    function connect(){
        $this->conn=mysql_connect($this->host, $this->user_name, $this->pwd) or die (mysql_error());
    }
    
    function close(){
        mysql_close($this->conn);
    }
    
    function selectDB(){
        mysql_select_db($this->db_name);
        mysql_query("SET NAMES UTF8");
    }
    
    function query($sql){
        $result=mysql_query($sql) or die(mysql_error());
        return $result;
    }
}

?>
