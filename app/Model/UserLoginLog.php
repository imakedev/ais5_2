<?php
/**
 * Created by PhpStorm.
 * User: imake
 * Date: 26/01/2016
 * Time: 11:39
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserLoginLog extends Model
{
    protected $table = 'user_login_log';
    protected $primaryKey = 'user_login_log_id';
    public $timestamps = false;
}