<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasSalary extends Model
{
    protected $table = 'user_has_salary';
    protected $id = 'id';
    protected $fillable = [
        'salary_level_id', 'user_id', 'total_salary', 'salary_amount', 'note', 'overtime_hours'
    ];

    protected $casts = [
        'salary_component' => 'array',
        'salary_amount' => 'array',
    ];
}
