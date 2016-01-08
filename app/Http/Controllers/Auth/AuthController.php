<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;
use Log;
use Auth;
use Session;
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
        $this->middleware('guest', ['except' => 'logout']);
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }

    public function authenticate()
    {
        $email  = Input::get('email');
        $password  = Input::get('password');
        $mmplant  = Input::get('mmplant');
        /*
        $credentials = [
            'email' => 'moooooooooooogle@gmail.com',
            'password' => 'password'
        ];
        */
        // $remember = $request->has('remember');
        Log::info("into authenticate->");

        $hasAuthened=false;

        if (Auth::check()) {
            // User is logged in
            Log::info("into check->");
            $hasAuthened=true;
        } else {
            Log::info("into login->");
            // for LDAP Authen
           // $user_ldap = LDAPAuth::authen($email, $password);

            // for Test
            
            $email='moooooooooooogle3@gmail.com';
            $user_ldap = [
                'email' => $email
            ];
            
            // end test
            if (!empty($user_ldap)){
                Log::info($user_ldap);
                $user_db = User::where('email', $email)
                    //->get();
                    ->first();
                Log::info("user_db->"+sizeof($user_db));
                $user_key=null;
                if (empty($user_db)){
                    //create user
                    $this->create($user_ldap);
                    $user_db = User::where('email', $email)
                        //->get();
                        ->first();
                }
                $user_key=$user_db->id;
                $hasAuthened=true;


                Auth::loginUsingId($user_key);

                //set mmplant
                Auth::user()->mmplant=$mmplant;
                Session::put('user_mmplant', $mmplant);
                Log::info('mmplant->'.$mmplant);
            }
            Log::info($user_ldap);
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

        //return redirect()->intended('/home');
        if($hasAuthened)
            return redirect()->intended('/ais/index');
        else
            return redirect()->intended('/ais/login');
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
        Log::info("into user->" . $user . "xx");
        Auth::logout();
     //   Session::flush();
        return redirect()->intended('/ais/login');

    }
}
