<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userHasPeformance extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'user_has_peformance';
    protected $fillable = [
        'attendance_id','workingDays_id'
    ];
}
