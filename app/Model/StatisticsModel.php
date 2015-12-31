<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatisticsModel extends Model
{
    protected $table = 'user_login_log';

    protected $primaryKey = 'user_login_log_id';
}
