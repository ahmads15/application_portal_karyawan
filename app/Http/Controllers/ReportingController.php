<?php

namespace App\Http\Controllers;
use App\SubmissionFormOvertime;
use App\UserHasSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\leaveSub;
use App\User;
use App\LeaveType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\submission_form_leave;
use App\salary_level;

class ReportingController extends Controller
{
    public function LeaveRepindex(){
        // $user = Auth::user()->id;
        $data = submission_form_leave::orderby('id', 'desc')
            ->selectRaw('submission_form_leave.id as id ,submission_form_leave.start_date,submission_form_leave.end_date,submission_form_leave.day_amount_sub
                        ,submission_form_leave.created_at,submission_form_leave.status')
            ->first();
        $leave_approved = submission_form_leave::where('user_auth_id',auth()->user()->id)->whereMonth('created_at','=',Carbon::now()->month)->where('status','=','Approved')->count();
        $leave_rejected = submission_form_leave::where('user_auth_id',auth()->user()->id)->whereMonth('created_at','=',Carbon::now()->month)->where('status','=','Rejected')->count();
        $leave_pending = submission_form_leave::where('user_auth_id',auth()->user()->id)->whereMonth('created_at','=',Carbon::now()->month)->where('status','=','Pending')->count();

        $leaves = submission_form_leave::orderby('id', 'desc')
            ->where('user_auth_id', auth()->user()->id)
            ->select('submission_form_leave.*','leaves.leave_type_name','leaves.id as leave_type_id','users.name as supervisor')
            ->leftJoin('leaves','leaves.id','=','submission_form_leave.leaves_id')
            ->leftJoin('users','submission_form_leave.user_has_leaves','=','users.id')
            ->whereMonth('submission_form_leave.created_at','=',Carbon::now()->month)
            ->get();
        return view('reporting.LeaveRep', compact('data', 'leave_approved','leave_rejected','leave_pending', 'leaves'));
    }

    public function leaveDetail($id)
    {
        $leaves = submission_form_leave::where('submission_form_leave.id', $id)
            ->select('submission_form_leave.*','leaves.leave_type_name','leaves.id as leave_type_id','users.name as supervisor')
            ->leftJoin('leaves','leaves.id','=','submission_form_leave.leaves_id')
            ->leftJoin('users','submission_form_leave.user_has_leaves','=','users.id')
            ->whereMonth('submission_form_leave.created_at','=',Carbon::now()->month)
            ->first();
        if(!$leaves) return abort(404);
        return response()->json($leaves,200);
    }
    public function LoanRepindex(){
        return view('reporting.LoanRep');
    }
    public function OvertimeRepindex(){
        $total_overtime_approved = SubmissionFormOvertime::where('send_id',auth()->user()->id)->whereMonth('created_at','=',Carbon::now()->month)->where('status','Approved')->count();
        $total_overtime_reject = SubmissionFormOvertime::where('send_id',auth()->user()->id)->whereMonth('created_at','=',Carbon::now()->month)->where('status','Rejected')->count();
        $total_overtime_pending = SubmissionFormOvertime::where('send_id',auth()->user()->id)->whereMonth('created_at','=',Carbon::now()->month)->where('status','Pending')->count();
        $overtime = SubmissionFormOvertime::where('send_id',auth()->user()->id)->get();
        return view('reporting.OvertimeRep', compact('total_overtime_approved','total_overtime_pending','total_overtime_reject','overtime'));
    }


    public function getDetailOvertimer($id)
    {
        $overtime = SubmissionFormOvertime::where('submission_form_overtime.id', $id)
            ->select('start_time','end_time','users.name as supervisor','submission_form_overtime.status','submission_form_overtime.overtime_reason','submission_form_overtime.note')
            ->leftJoin('users','users.id','=','submission_form_overtime.recv_id')
            ->first();
        return response()->json($overtime,200);
    }
    public function getTotalOvertime ()
    {
        if(auth()->user() == null) return abort(404);
        $total_overtime = SubmissionFormOvertime::where('send_id',auth()->user()->id)->whereMonth('created_at','=',Carbon::now()->month)->get();
        return response()->json($total_overtime,200);
    }
    public function PaySlipRepindex (){
        $id = Auth::user()->id;
        $user = User::orderby('id', 'desc')
        ->selectRaw(' users.id as id,users.name, users.company_name,users.address,users.phone_number ,users.private_email,users.profile_picture')
        ->where('users.id', $id)
        ->first();

        $payslip = UserHasSalary::where('user_id',auth()->user()->id)->get();
        return view('reporting.PaySlipRep',compact('user','payslip'));
    }

    public function PaySlipDetail($id){
        $user = User::orderby('id', 'desc')
        ->selectRaw(' users.id as id,users.name, users.no_rekening ,users.nip,users.company_name,users.address,users.phone_number,b.bank_name,b.bank_code')
        ->leftJoin('bank as b', 'b.id', '=', 'users.bank_id')
        ->where('users.id', auth()->user()->id)
        ->first();

        $payslip_detail = UserHasSalary::find($id);

        $salary_level = salary_level::find($payslip_detail->salary_level_id);

//        dd($payslip_detail);
        $list_component = [];
        for($i = 0; $i < count($payslip_detail->salary_component) ; $i++)
        {
            $list_component[$i] = (object)['salary_component' => $payslip_detail->salary_component[$i], 'salary_amount' => $payslip_detail->salary_amount[$i]];
        }
        return view('reporting.PaySlipDetail.PaySlipDetail',compact('user','list_component', 'payslip_detail', 'salary_level'));
    }


}
