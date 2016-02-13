<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use \App\Model\UserLoginLog;
use Log;
use Auth;
use Session;
use Carbon\Carbon;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('guest', ['except' => 'logout']);
        // $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {

        return User::create([
            'empId' => $data['empId'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }

    public function authenticate()
    {
      //  $email  = Input::get('email');
        $empId = Input::get('empId');
        $password  = Input::get('password');
        $mmplant  = Input::get('mmplant');
        /*
        $credentials = [
            'email' => 'moooooooooooogle@gmail.com',
            'password' => 'password'
        ];
        */
        // $remember = $request->has('remember');
        Log::info("into authenticate->[".$empId."]");
        $error_message=null;
        $hasAuthened=false;
        $user_empId=null;
        $user_db=null;
        $mmtrendsM=null;
        $user_priority=0;
        if (Auth::check()) {
            // User is logged in
            Log::info("into check->");
            $hasAuthened=true;
        } else {
            Log::info("into login->");


            // check user in DB?
            $mmtrendsM = DB::table("mmemployee_table")
                ->where('A',$empId)// as mmemployee where mmemployee.A='".$user_ldap['empId']."'")
                ->orderBy('updated_at','DESC')->get();



            if (!empty($mmtrendsM)) {
                Log::info($mmtrendsM[0]->A);
                $user_empId=$mmtrendsM[0]->A;
                $user_priority=$mmtrendsM[0]->D0;
                // for LDAP Authen
                // $user_ldap = LDAPAuth::authen($empId, $password);

                // for Test
                /*  */
                $email='moooooooooooogle6@gmail.com';
                $user_ldap = [
                    'email' => $email,
                    'name' => 'Chatchai Pimtun',
                    'empId' => $empId,
                    // 'id' => '409642',
                    'password' => 'password'
                ];

                // end test
                if (!empty($user_ldap)){
                    Log::info($user_ldap);
                    //$user_db = User::where('email', $email)
                    $user_db = User::where('empId', $empId)
                        //->get();
                        ->first();
                    Log::info("user_db->"+sizeof($user_db));
                    $user_key=null;
                    if (empty($user_db)){
                        //create user
                        $this->create($user_ldap);
                        //$user_db = User::where('email', $email)
                        $user_db = User::where('empId', $empId)
                            //->get();
                            ->first();
                    }
                    $user_key=$user_db->id;
                    $hasAuthened=true;


                    Auth::loginUsingId($user_key);

                    //set mmplant
                    Auth::user()->mmplant=$mmplant;
                    Session::put('user_mmplant', $mmplant);

                    // set mmemployee_table
                    $user_priority=255;

                    Session::put('user_empId', $user_empId);
                    Session::put('user_priority', $user_priority);

                    Log::info('mmplant->'.$mmplant);
                }else{
                    $error_message=" Invalid Employee ID or Password";
                }
                Log::info($user_ldap);
            }else{
                $error_message=" Employee is Empty";
            }



   /*
            $user_name = [
                'name' => 'imake',
                'email' => 'moooooooooooogle3@gmail.com',
                'password' => 'password'
            ];
            $user_name=null;

   */

        }
        // You can also specify true as the second parameter to set the "remember me" cookie.
        Session::put('error_message', $error_message);
        //return redirect()->intended('/home');
        if($hasAuthened) {
            $session_id =Session::getId();
            if (!empty($mmtrendsM)) {
                $userLoginLog = new UserLoginLog();
                $userLoginLog->user_id=$user_empId;
                $current_time = Carbon::now();

                $userLoginLog->user_login_log_id=$session_id;

                $userLoginLog->login_time=$current_time;
                $userLoginLog->date_created=$current_time;
                $userLoginLog->session_id=$session_id;
                $userLoginLog->title_name=$mmtrendsM[0]->B;
                $names = explode("   ", $mmtrendsM[0]->C);
                $userLoginLog->first_name=$names[0];
                $userLoginLog->last_name=$names[1];
                $userLoginLog->save();
            }



            Log::info("into login successs session id->".$session_id);
            return redirect()->intended('/ais/index');
        }
        else {
            Log::info("error_message");
           // session()->flash('error_message', " Invalid Employee id or Password .");
           // Session::put('error_message', " Invalid Employee id or Password .");
            //return redirect()->intended('/ais/login');
            return redirect()->intended('/login');
        }
        // check ldap
    }

    public function getLogin()
    {
        if (Auth::check()) {
            return redirect()->intended('/ais/index');
        }
        Log::info("into getLogin->");
       // return View('login.login');
        return redirect()->intended('/ais/login');

    }
    public function getLogout()
    {
        Log::info("into doLogout->");
        $user = Auth::user();
        $session_id  = Session::getId();
        $userLoginLog= UserLoginLog::find($session_id);
        $current_time = Carbon::now();
        if (!empty($userLoginLog)) {
            $userLoginLog->logout_time=$current_time;
            $userLoginLog->save();
            Log::info("into user->" . $user . ",session id=".$session_id.",current time=".$current_time);

        }
        Auth::logout();
     //   Session::flush();
        return redirect()->intended('/login');

    }
    
}
