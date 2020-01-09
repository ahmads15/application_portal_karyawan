<?php

namespace App\Http\Controllers;

use App\salary_level;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\SubmissionFormOvertime;
use App\UserHasSalary;
use Alert;
use Illuminate\Support\Facades\Auth;

class EmployeePayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function EmployeePayrollIndex()
    {
        $query_data_user = "select 
                            t1.id,
                            t1.name,
                            t1.status_karyawan,
                            t1.nip, 
                            t3.position_name
                        from users as t1
                        left join user_has_position as t2 on t1.id = t2.user_id
                        left join `position` as t3 on t2.position_id = t3.id";
        $data_user = DB::select(DB::raw($query_data_user));
        return view('employee_payroll.employee_payroll', compact('data_user'));
    }

    public function EmployeeSubmitPayrollIndex($id)
    {
        $query_data_user = "select 
                            t1.nip,
                            t1.name,
                            t1.gender,
                            t1.birthofdate,
                            t1.address,
                            t1.status_karyawan,
                            t1.status,
                            t1.number_of_kids,
                            t3.position_name,
                            t4.department_name, 
                            t5.division_name, 
                            t6.bank_name
                        from users as t1
                        left join user_has_position as t2 on t1.id = t2.user_id
                        left join `position` as t3 on t2.position_id = t3.id
                        left join department as t4 on t3.department_id = t4.id
                        left join division as t5 on t4.division_id = t5.id
                        left join bank as t6 on t1.bank_id = t6.id
                        where t1.id = " . $id;

        $data_user = DB::select(DB::raw($query_data_user))[0];
        $data_salary = salary_level::all();

        $overtimes = SubmissionFormOvertime::whereRaw('send_id = ? AND status = "Approved"', [$id])
            ->whereMonth('created_at','=',Carbon::now()->month)
            ->get();

        $arr_salary = array();

        $salary = UserHasSalary::where('user_id', $id)->whereMonth('created_at','=',Carbon::now()->month)->first();

        $overtime_hours = ($salary ? $salary->overtime_hours : '');

        $salary_level_id = 0;
        
        if($salary){
            for($i = 0; $i < count($salary->salary_component) ; $i++)
                $arr_salary[$i] = (object)['salary_component' => $salary->salary_component[$i], 'salary_amount' => $salary->salary_amount[$i]];

        $salary_level_id = $salary->salary_level_id;
        }


        return view('employee_payroll.employee_submit_payroll', compact('data_user', 'data_salary', 'overtimes', 'arr_salary', 'id', 'overtime_hours', 'salary_level_id'));
    }

    public function submit(Request $request)
    {
        $totalJam = (int) substr($request->get('total_hours'), 0,2);
//        dd($request->all());
        $salary_comp = [];
        $salary_amount = [];
        $totalAmount = 0;
        foreach($request->Schoolname as $s){
            array_push($salary_comp, $s);
        }
        foreach($request->Major as $m){
            $totalAmount += $m;
            array_push($salary_amount, $m);
        }
//        dd($salary_comp);
        $totalPriceOvertime = ($totalJam * $request->get('overtime_hours')) + $totalAmount;
//        dd($totalJam);
        $salary = UserHasSalary::where('user_id',$request->id)->whereMonth('updated_at','=',Carbon::now()->month)->first();
        if(!$salary) {
            $newSalary = new UserHasSalary();
            $newSalary->user_id = $request->get('id');
            $newSalary->salary_level_id = $request->get('salary_level');
            $newSalary->overtime_hours = $totalJam * $request->get('overtime_hours');
            $newSalary->total_salary = $totalPriceOvertime + intval(str_replace('.','', $request->basedsalary));
            $newSalary->salary_component = $salary_comp;
            $newSalary->salary_amount = $salary_amount;
            $newSalary->save();
            Alert::success('Salary ' .' berhasil ditambahkan', 'Success Added !')->persistent("Close");
            return redirect()->back();
        }
        $salary->user_id = $request->get('id');
        $salary->salary_level_id = $request->get('salary_level');
        $salary->overtime_hours = ($totalJam * (int) $request->get('overtime_hours'));
        $salary->salary_component = $salary_comp;
        $salary->salary_amount = $salary_amount;
        $salary->total_salary =$totalPriceOvertime;
        $salary->save();

        Alert::success('Salary ' .' berhasil ditambahkan', 'Success Added !')->persistent("Close");
        return redirect()->back()->with('success','Salary has been added.');
    }
}
