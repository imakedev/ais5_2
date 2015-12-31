<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 13/10/15
 * Time: 19:14
 */

namespace App\Http\Controllers;
use Log;

class WelcomeController  extends Controller
{
    public function hello(){
        Log::info('Thixxs is some useful information.');
        return 'Hello from WelcomeController';

    }
}