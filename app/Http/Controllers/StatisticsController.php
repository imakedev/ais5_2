<?php

namespace App\Http\Controllers;

use \App\Model\StatisticsModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Log;
use DB;
class StatisticsController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function testAuth(){
        $adServer = "ldap://10.249.99.50:3268";

        $ldap = ldap_connect($adServer);
        $username = 'assysit';//$_POST['username'];
        $password = 'mm.2910mm';//$_POST['password'];
        echo " ".$username." ".$password."<br>";
        if(($username!="")&&($password!=""))
        {
            $ldaprdn = 'egat' . "\\" . $username;

            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

            $bind = @ldap_bind($ldap, $ldaprdn, $password);


            if ($bind) {
               // session_start();
                $filter="(sAMAccountName=$username)";
                $result = ldap_search($ldap,"dc=egat,dc=local",$filter);
                ldap_sort($ldap,$result,"sn");
                $info = ldap_get_entries($ldap, $result);
                Log::info("count->".$info["count"]);
                $attributes=['mail','cn','c','st','title','description','postofficebox',
                    'physicaldeliveryofficename','telephonenumber','distinguishedname','info',
                    'memberof','department','company'];

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
    }
    public  function search(){
//        $datas = \App\Model\StatisticsModel::where(function($query){
//
//            $search_input = Input::has('search') ? Input::get('search') : null;
//
//            if(isset($search_input)){
//                $query->orWhere('first_name','=',$search_input)
//                    ->orWhere('last_name','=' ,$search_input);
//            }
//
//        })->get();
//
//        return view('ais/statistics', ['datas'=>$datas]);
//    }

        $datas = StatisticsModel::query();
        $query="SELECT *
                from user_login_log
               ";


        //$datas = DB::table('user_login_log as userlog ');
       // $datas = DB::table('user_login_log')
        $fromDate  = Input::get('fromDate');
        $toDate  = Input::get('toDate');

        Log::info("fromDate2->".$fromDate);
        Log::info("toDate2->".$toDate);
        Log::info("xx->".Input::has('search'));
        Log::info("page->".Input::has('page'));
        Log::info("session->".session()->get('static_fromDate'));
        $queryString=null;
      //  $fromDate=null;
       // $toDate=null;
        if(Input::has('page')){ // paging
            Log::info("into paging");
            $queryString = session()->get('static_search');
            $fromDate = session()->get('static_fromDate');
            $toDate = session()->get('static_toDate');
        }else{
            if (Input::has('search')) {
                $queryString = Input::get('search');
                //session(['static_search' => $queryString]);
                session()->put('static_search',$queryString);
            }
            session()->put('static_search',$queryString);
            if(!empty($fromDate)){
                //session(['static_fromDate' => $fromDate]);
                session()->put('static_fromDate',$fromDate);
            }
            session()->put('static_fromDate',$fromDate);
            if(!empty($toDate)){
               // session(['static_toDate' => $toDate]);
                session()->put('static_toDate',$toDate);
            }
            session()->put('static_toDate',$toDate);
        }
        $haveWhere=false;
        if(!empty($queryString)){
            $datas= $datas->orWhere('first_name', 'LIKE', "%$queryString%")
                ->orWhere('last_name', 'LIKE', "%$queryString%");

            $query=$query." where first_name like '%$queryString%' or  last_name like '%$queryString%' ";
            $haveWhere=true;
        }
        if(!empty($fromDate)){
            $fromDates = explode("/", $fromDate);
            $datas=$datas->where('date_created', '>=', $fromDates[2].'-'.$fromDates[1].'-'.$fromDates[0]);

            if($haveWhere)
                $query=$query." and date_created >= '".$fromDates[2]."-".$fromDates[1]."-".$fromDates[0]."' ";
            else
                $query=$query." where date_created >= '".$fromDates[2]."-".$fromDates[1]."-".$fromDates[0]."' ";
            $haveWhere=true;
        }
        if(!empty($toDate)){
            $toDates = explode("/", $toDate);
            $datas=$datas->where('date_created', '<=', $toDates[2].'-'.$toDates[1].'-'.$toDates[0]);

            if($haveWhere)
                $query=$query." and date_created <= '".$toDates[2]."-".$toDates[1]."-".$toDates[0]."' ";
            else
                $query=$query." where date_created <= '".$toDates[2]."-".$toDates[1]."-".$toDates[0]."' ";
            $haveWhere=true;

        }
        Log::info("fromDate->".$fromDate);
        Log::info("toDate->".$toDate);
// ... more clauses from the querystring
        $datas=$datas->orderBy('user_login_log_id','ASC')->paginate(12);
        Log::info("query->".$query);
        //$datas_list = DB::select($query);
        $this->testAuth();
        return view('ais/statistics', ['lists'=>$datas]);
    }

}
