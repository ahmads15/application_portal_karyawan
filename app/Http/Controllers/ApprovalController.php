<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\submission_form_leave;
use Illuminate\Support\Facades\Auth;
use App\SubmissionFormOvertime;

class ApprovalController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('index');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        
        $role = User::selectRaw('b.*')
            ->join('model_has_roles as a', 'a.model_id', '=', 'users.id')
            ->join('roles as b', 'b.id', '=', 'a.role_id')
            ->whereRaw('users.id = ?', [$user_id])
            ->first()->name;

        $sub_leaves = submission_form_leave::selectRaw('submission_form_leave.*, us2.name as recv_name, us2.id as recv_id, us1.name as send_name, l.leave_type_name, leave_type_name')
            ->join('users as us1', 'us1.id', '=', 'submission_form_leave.user_auth_id')
            ->join('users as us2', 'us2.id', '=', 'submission_form_leave.user_has_leaves')
            ->join('leaves as l', 'l.id', '=', 'submission_form_leave.leaves_id')
            ->whereRaw('CASE WHEN ? != "HRD" THEN us1.id = ? OR us2.id = ? ELSE 1 END', [$role, $user_id, $user_id])
            ->get();

        $sub_overtime = SubmissionFormOvertime::selectRaw('submission_form_overtime.*, us2.name as recv_name, us2.id as recv_id, us1.name as send_name')
            ->join('users as us1', 'us1.id', '=', 'submission_form_overtime.send_id')
            ->join('users as us2', 'us2.id', '=', 'submission_form_overtime.recv_id')
            ->whereRaw('CASE WHEN ? != "HRD" THEN us1.id = ? OR us2.id = ? ELSE 1 END', [$role, $user_id, $user_id])
            ->get();

        return view('approval.index', compact('sub_leaves', 'sub_overtime'));
    }

    public function update_leaves(Request $request)
    {
        if (isset($request->approved)){
            $sub_leave = submission_form_leave::find($request->id);
            $sub_leave->status = 'Approved';
            $sub_leave->save();
        }
        else{
            $sub_leave = submission_form_leave::find($request->id);

            $sub_leave->status = 'Rejected';
            $sub_leave->save();
        }

        return redirect()->back();
    }

    public function update_overtime(Request $request)
    {
        if (isset($request->approved)){
            $sub_overtime = SubmissionFormOvertime::find($request->id);
            $sub_overtime->status = 'Approved';
            $sub_overtime->save();
        }
        else{
            $sub_overtime = SubmissionFormOvertime::find($request->id);
            $sub_overtime->status = 'Rejected';
            $sub_overtime->save();
        }

        return redirect()->back();
    }
}
