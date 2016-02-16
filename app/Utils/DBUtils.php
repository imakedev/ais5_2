<?php
namespace App\Utils;
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 13/02/2016
 * Time: 19:32
 */

use Log;
class DBUtils
{
    public static function getDBName() {
        Log::info("into getDBName");
       $user_mmplant= session()->get('user_mmplant');
        Log::info("$user_mmplant->".$user_mmplant);
        $dbName='mysql';
        if($user_mmplant=='1'){
            $dbName='mysql';//'mysql_ais_47';
        }else if($user_mmplant=='2'){
            $dbName='mysql_ais_813';
        }else if($user_mmplant=='3'){
            $dbName='mysql_ais_fgd813';
        }
        Log::info("dbName->".$dbName);
        return $dbName;
    }
}