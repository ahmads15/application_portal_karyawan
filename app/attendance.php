<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    //
    protected $table = 'attendance';
    protected $fillable = ['users_id','date','check_in','check_out','check_in_status'];
}
