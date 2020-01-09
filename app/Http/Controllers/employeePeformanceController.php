<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\userHasPeformance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class employeePeformanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    public function index()
    {
        $user = Auth::user();
        $query = "select (count(t2.id) / t3.day_amount * 10) as performance_val,
                    t3.`month`
                    from user_has_peformance as t1
                left join attendance as t2 on t1.attendance_id = t2.id
                left join workingdays as t3 on t1.workingDays_id = t3.id
                where date_format(t2.`date`, '%y') = date_format(curdate(),'%y')
                and date_format(t2.`date`, '%m') < date_format(curdate(),'%m')
                and t2.users_id = ".auth()->user()->id." 
                group by t3.id
                order by performance_val Asc";
        $employee_performance = DB::select(DB::raw($query));
        return view('employee_performance.index', compact('user','employee_performance'));
    }

    public function getEmployeePerformance($year)
    {
        $query = "select (count(t2.id) / t3.day_amount * 10) as performance_val,
                    t3.`month`
                    from user_has_peformance as t1
                left join attendance as t2 on t1.attendance_id = t2.id
                left join workingdays as t3 on t1.workingDays_id = t3.id
                where date_format(t2.`date`, '%Y') =  '".$year."'
                and date_format(t2.`date`, '%m') < date_format(curdate(),'%m')
                and t2.users_id = ".auth()->user()->id." 
                group by t3.id";
//        dd($query);
        $employee_performance = DB::select(DB::raw($query));
        return response()->json($employee_performance, 200);
    }
}
