<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 30/12/2015
 * Time: 22:22
 */

namespace App\Http\Controllers\Auth;
use Log;

class LDAPAuth
{
   // public static function authen($email,$password){
    public static function authen($empId,$password){
        $user_ldap=null;
        $adServer = "ldap://10.249.99.50:3268";
        //$email_explode = explode("@", $email);
        $ldap = ldap_connect($adServer);
       // $username = 'assysit@egat.co.th';//$_POST['username'];
       // $username = $email_explode[0];
        $username = $empId;
       // $password = 'mm.2910mm';//$_POST['password'];
        //$username = 'assysit';//$_POST['username'];
        //$password = 'mm.2910mm';//$_POST['password'];
        Log::info(" ".$username." ".$password."");
        if(($username!="")&&($password!=""))
        {
            $ldaprdn = 'egat' . "\\" . $username;

            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

            $bind = @ldap_bind($ldap, $ldaprdn, $password);

            Log::info(" is bind ".$bind);
            if ($bind) {
                // session_start();
                $filter="(sAMAccountName=$username)";
                //$filter="(mail=$username)";
                $result = ldap_search($ldap,"dc=egat,dc=local",$filter);
                ldap_sort($ldap,$result,"sn");
                $info = ldap_get_entries($ldap, $result);
                Log::info("count->".$info["count"]);
              /*  $attributes=['mail','cn','c','st','title','description','postofficebox',
                    'physicaldeliveryofficename','telephonenumber','distinguishedname','info',
                    'memberof','department','company'];
              */
                $attributes=['cn'];
                for ($i=0; $i<$info["count"]; $i++)
                {
                    if($info['count'] > 1)
                        break;
                    //  $userlogon= $info[$i]["givenname"][0] ." " . $info[$i]["sn"][0] ." (" . $info[$i]["samaccountname"][0] .")";

                    Log::info("givenname->".$info[$i]["givenname"][0]);
                    //Log::info("sn->".$info[$i]["sn"][0]);
                    Log::info("samaccountname->".$info[$i]["samaccountname"][0]);

                    for ($j=0; $j<sizeof($attributes); $j++){
                        Log::info(($j+1)." [".$attributes[$j]."]->".$info[$i][$attributes[$j]][0]);

                    }
                    $user_ldap = [
                        //'name' => $info[$i]["samaccountname"][0],
                        'name' => $info[$i]["cn"][0],
                        'email' => $info[$i]["mail"][0],
                        'empId' => $info[$i]["samaccountname"][0],
                      //  'id' => $info[$i]["samaccountname"][0],
                        'password' => 'password'
                    ];
                    //Log::info("givenname->".$info[$i]); // for show attributes
                    /*
                    $_SESSION['name']=$info[$i]["givenname"][0];
                    $_SESSION['sn']=$info[$i]["sn"][0];
                    $_SESSION['id']=$info[$i]["samaccountname"][0];
                    */
                    //echo '<pre>';
                    //var_dump($info);
                    // echo '</pre>';
                    //$userDn = $info[$i]["distinguishedname"][0];
                    //header( "location: index.php" );
                    // exit(0);

                }
                @ldap_close($ldap);

            } else {
                //  $userlogon="Invalid";
                //header( "location: index.php" );
            }
        }
        else
        {
            //$userlogon="Invalid";
            //header( "location: index.php" );

        }
        return $user_ldap;
    }
}