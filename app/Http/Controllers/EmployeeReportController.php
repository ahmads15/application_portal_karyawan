<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubmissionFormOvertime;
use App\attendance;
use App\submission_form_leave;
use App\User;

class EmployeeReportController extends Controller
{
    public function AttendanceRepindex()
    {

        $data_att = attendance::orderby('date', 'desc')
            ->selectRaw('attendance.id as id ,users.name as name_att,attendance.date,
                    attendance.check_in,attendance.check_out,t2.position_name,
                    attendance.attendance_status as att_status')
            ->leftJoin('users', 'users.id', '=', 'attendance.users_id')
            ->leftJoin('user_has_position as t1', 'users.id', '=', 't1.user_id')
            ->leftJoin('position as t2', 't1.position_id', '=', 't2.id')
            // ->whereRaw('send_id = ? AND submission_form_overtime.status = "Approved"')
            // ->leftJoin('users','users.id','=','submission_form_overtime.recv_id')
            ->get();
        return view('employee_report.attendance_report', compact('data_att'));
    }

    public function SalaryRepindex()
    {

        $data_salary = User::orderby('created_at', 'desc')
            ->selectRaw('users.id as id ,users.nip,
                    t1.created_at,users.name,t3.position_name,
                    t1.total_salary')
            ->leftJoin('user_has_salary as t1', 'users.id', '=', 't1.user_id')
            ->leftJoin('user_has_position as t2', 'users.id', '=', 't2.user_id')
            ->leftJoin('position as t3', 't2.position_id', '=', 't3.id')
            // ->whereRaw('send_id = ? AND submission_form_overtime.status = "Approved"')
            // ->leftJoin('users','users.id','=','submission_form_overtime.recv_id')
            ->get();
        return view('employee_report.salary_report', compact('data_salary'));   
}

    public function LeaveRepindexHRD()
    {
        $data = submission_form_leave::orderby('id', 'desc')
            ->selectRaw('submission_form_leave.id as id ,submission_form_leave.start_date,submission_form_leave.end_date,submission_form_leave.day_amount_sub
                    ,submission_form_leave.created_at,submission_form_leave.status')
            ->first();
        $leaves = submission_form_leave::orderby('created_at', 'desc')
            ->select('submission_form_leave.*', 'leaves.leave_type_name', 'leaves.id as leave_type_id', 'us2.name as recv_name','us2.id as recv_id','us1.name as send_name')
            ->leftJoin('leaves', 'leaves.id', '=', 'submission_form_leave.leaves_id')
            ->leftjoin('users as us1', 'us1.id', '=', 'submission_form_leave.user_auth_id')
            ->leftjoin('users as us2', 'us2.id', '=', 'submission_form_leave.user_has_leaves')
            ->get();
        return view('employee_report.leave_report', compact('data', 'leaves'));
    }

    public function OvertimeRepindexHRD()
    {
        $dataOver = SubmissionFormOvertime::orderby('date', 'desc')
            ->selectRaw('submission_form_overtime.id as id ,submission_form_overtime.date,us2.name as recv_name, us2.id as recv_id, us1.name as send_name,
                    submission_form_overtime.start_time,submission_form_overtime.end_time,
                    submission_form_overtime.hours,submission_form_overtime.overtime_reason')
            ->leftjoin('users as us1', 'us1.id', '=', 'submission_form_overtime.send_id')
            ->leftjoin('users as us2', 'us2.id', '=', 'submission_form_overtime.recv_id')
            // ->whereRaw('send_id = ? AND submission_form_overtime.status = "Approved"')
            // ->leftJoin('users','users.id','=','submission_form_overtime.recv_id')
            ->get();
        return view('employee_report.overtime_report', compact('dataOver'));
    }
}
