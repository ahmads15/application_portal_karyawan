<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeePerformance extends Controller
{
    //
    public function index()
    {

        return view('employee_performance.index');
    }
}
