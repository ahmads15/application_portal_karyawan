<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use App\Division;
use App\Position;
use App\leaveSub;
use App\LeaveType;
use App\department;
use App\RemainingLeave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\submission_form_leave;
use App\SubmissionFormOvertime;

class SubmissionFormController extends Controller
{
    // Pengajuan Cuti
    public function leaveSubindex(){
        $user = auth()->user();

        $data = DB::table('user_has_position')->whereRaw('user_id = ?', $user->id)
            ->leftJoin('position', 'position.id', '=','user_has_position.position_id')
            ->leftJoin('department', 'department.id', '=','position.department_id')
            ->leftJoin('division', 'division.id','=','department.division_id')
            ->first();


        // if(!$data) abort(404);

        // $query = "select t1.* from users as t1
        //         left join model_has_roles as t2 on t1.id = t2.model_id
        //         left join roles as t3 on t2.role_id = t3.id
        //         left join user_has_position as t4 on t4.user_id = t1.id
        //         left join position as t5 on t4.position_id = t5.id
        //         left join department t6 on t5.department_id = t6.id
        //         WHERE t6.division_id  = ".$data->division_id;

        // $supervisors = DB::select(DB::raw($query.' AND t3.name = "supervisor"'));

        // $HeadSPV = DB::select(DB::raw($query.' AND t3.name = "Head Supervisor"'));

        $leave_types = LeaveType::all();

        return view('Submission_form.LeaveSub', compact('supervisors', 'leave_types','HeadSPV'));
    }

    public function leaveSubmissionStore(Request $request)
    {
        // Validation
        $rules = [
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_duration' => 'numeric|min:1',
            'reason' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $notification = array(
                'message' => $validator->errors()->first(),
                'alert-type' => 'error'
            );

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = Auth::user();

        // Check Leave Type
        if($request->leave_type == '1'){
            if($request->leave_duration > $user->default_leave){
                $notification = array(
                    'message' => 'Your Leaves is Excess',
                    'alert-type' => 'error'
                );

                return redirect()->back()->withErrors(['errors'=>$notification->message])->withInput();
            }

            $lt_id = $request->leave_type;

            $user_leave = User::find($user->id);
            $user_leave->default_leave = ($user_leave->default_leave) - ($request->leave_duration);
            $user_leave->save();
        }
        else{
            $lt_id = $request->leave_type;

            $check = LeaveType::find($lt_id);

            if($request->leave_duration > $check->day_amount){
                $notification = array(
                    'message' => 'Your Leaves is Excess',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with(['errors' => $notification->message])->withInput();
            }
        }

        // Auth User Role
        $role = User::selectRaw('r.*')
            ->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id')
            ->join('roles as r', 'r.id', '=', 'mr.role_id')
            ->whereRaw('users.id = ?', [$user->id])
            ->first();

        // Auth User Department
        $department = User::selectRaw('d.*')
            ->join('user_has_position as uhp', 'uhp.user_id', '=', 'users.id')
            ->join('position as p', 'p.id', '=', 'uhp.position_id')
            ->join('department as d', 'd.id', '=', 'p.department_id')
            ->whereRaw('users.id = ?', [$user->id])
            ->first();

        // Leave Sub Receiver
        if($role->name == 'Supervisor'){
            $user_recv = Department::selectRaw('u.*')
                ->join('users as u', 'u.id', '=', 'department.hs_id')
                ->first();
        }
        else if($role->name == 'Head Supervisor'){
            $user_recv = Auth::user();
        }
        else{
            $user_recv = Department::selectRaw('u.*')
                ->join('users as u', 'u.id', '=', 'department.supervisor_id')
                ->first();
        }

        $newLeaveSub = new submission_form_leave();
        
        $newLeaveSub->user_has_leaves = $user_recv->id;
        $newLeaveSub->user_auth_id = Auth::user()->id;
        $newLeaveSub->day_amount_sub = $request->leave_duration;
        $newLeaveSub->leaves_id = $lt_id;
        $newLeaveSub->reason = $request->reason;
        $newLeaveSub->start_date =  date("Y-m-d", strtotime(request('start_date')));
        $newLeaveSub->end_date = date("Y-m-d", strtotime(request('end_date')));
        
        $newLeaveSub->save();
        
        return back()->with('success','Leave request has been sent.');
    }

    public function leaveSubCheck(Request $request){
//        $leaves = DB::table('user_has_leaves')
//            ->leftJoin('leaves','leaves.id','=','user_has_leaves.leaves_id')
//            ->leftJoin('submission_form_leave','submission_form_leave.user_has_leaves','=','user_has_leaves.leaves_id')
//            ->where('user_has_leaves.user_id', '=', auth()->user()->id)
//            ->get();

        $dt = new Carbon($request->start_date);
        $dt2 = new Carbon($request->end_date);

        $diff = $dt->diffInDaysFiltered(function(Carbon $date) {
            return !$date->isWeekend();
        }, $dt2);

        if($request->durasi > auth()->user()->default_leave || $request->durasi == 0 || $request->durasi < 1){
            $notification = array(
                'diff' => $diff+1,
                'message' => 'You are not available to leave, your max duration leaves is '.auth()->user()->default_leave,
                'alert-type' => 'error'
            );
            return response()->json($notification, 422);
        }
        else{
            $notification = array(
                'diff' => $diff+1,
                'message' => 'You are available to leave',
                'alert-type' => 'success'
            );
            return response()->json($notification, 200);
        }
    } 

    public function OvertimeSubIndex(){
        return view('Submission_form.OvertimeSub');
    }

    public function overSubmissionStore(Request $request)
    {
        $user = Auth::user();
        
        $role = User::selectRaw('r.*')
            ->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id')
            ->join('roles as r', 'r.id', '=', 'mr.role_id')
            ->whereRaw('users.id = ?', [$user->id])
            ->first();

        if($role->name == 'Supervisor'){
            $user_recv = Department::selectRaw('u.*')
                ->join('users as u', 'u.id', '=', 'department.hs_id')
                ->first();
        }
        else if($role->name == 'Head Supervisor'){
            $user_recv = Auth::user();
        }
        else{
            $user_recv = Department::selectRaw('u.*')
                ->join('users as u', 'u.id', '=', 'department.supervisor_id')
                ->first();
        }
        
        $date = date('Y-m-d', strtotime($request->date));

        $sub_over = new SubmissionFormOvertime();

        $sub_over->send_id = Auth::user()->id;
        $sub_over->recv_id = $user_recv->id;
        $sub_over->date = $date;
        $sub_over->start_time = $request->start_time;
        $sub_over->end_time = $request->end_time;
        $sub_over->hours = $request->hour_duration;
        $sub_over->overtime_reason = $request->reason;
        $sub_over->save();

        return redirect()->back()->with('success','Overtime request has been sent.');;
    }

    // public function LeaveApprovalIndex(){
    //     return view('Submission_form.OvertimeSub');
    // }

    // Approval
    public function LeaveApprovalIndex()
    {
        $approvals = leaveSub::selectRaw('submission_form_leave.id, DATE(submission_form_leave.created_at) as CreateDate, 
                DATE(submission_form_leave.updated_at) as UpdatedDate, DATE(submission_form_leave.start_date) as startDate, 
                DATE(submission_form_leave.end_date) as endDate, u_send.name as sender_name, u_recv.name as recver_name, 
                leave_type_name as approval_type, submission_form_leave.status, note')
            ->join('users as u_send', 'u_send.id', '=', 'submission_form_leave.user_auth')
            ->join('users as u_recv', 'u_recv.id', '=', 'submission_form_leave.user_id')
            ->join('leave_type as lt', 'lt.id', '=', 'submission_form_leave.leave_type_id')
            ->whereRaw('u_recv.id = ?', [Auth::user()->id])
            ->get();

        $role = User::selectRaw('r.*')
            ->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id')
            ->join('roles as r', 'r.id', '=', 'mr.role_id')
            ->whereRaw('users.id = ?', [Auth::user()->id])
            ->first();

        return view('approval.index', compact('approvals', 'role'));

    }

    public function submitApproval(Request $request){
        //Check Approval
        if($request->approved == '1'){
            $sub_form_leave = leaveSub::find($request->id);
            $sub_form_leave->status = 'approved';
            $sub_form_leave->note = $request->note;
            $sub_form_leave->save();
        }
        else{
            $sub_form_leave = leaveSub::find($request->id);
            $sub_form_leave->status = 'rejected';  
            $sub_form_leave->note = $request->note;
            $sub_form_leave->save();
        }

        $notification = array(
            'message' => 'Submission has been submitted.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    // // delete department
    // public function deleteLeaveApproval($id)
    // {
    //     $department = department::find($id);
    //     $department->delete();
    //     Alert::success('Department ' . $department->name . ' berhasil dihapus', 'Success Deleted !')->persistent("Close");
    //     return redirect()->back();
    // }
    
    // // ini untuk search 
    // public function searchLeaveApproval(Request $request)
    // {

    //     $department = department::selectRaw('department.id, department.name')
    //         ->whereRaw(
    //             'department.name = ?',
    //             [$request->search]
    //         )
    //         ->paginate(15);

    //     $search = $request->search;

    //     return view('department.index', compact('department', 'search'));
    // }

    // //  ediit 
    // public function editLeaveApproval($id)
    // {

    //     $editdepartment = department::find($id);

    //     return view('department.index', ['department' => $editdepartment]);
    // }

    // public function doeditLeaveApproval(Request $request, $id)
    // {


    //     $rules = [
    //         'division' => 'required',
    //         'name' => 'required',
    //         'assigned_head_supervisor' => 'required',
    //         'assigned_supervisor' => 'required',

    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         $notification = array(
    //             'message' => $validator->errors()->first(),
    //             'alert-type' => 'error'
    //         );
    //         return redirect("master-department")->with($notification);
    //     }


    //     $department = department::find($id);

    //     // ini untuk validasi
    //     $department->division_id = $request['division'];
    //     $department->name = $request['name'];
    //     $department->hs_id = $request['assigned_head_supervisor'];
    //     $department->supervisor_id = $request['assigned_supervisor'];
    //     $department->save();

    //     Alert::success('Department has been updated', 'Success Updated');

    //     // untuk meredirect dan memberikan notif sukses
    //     return redirect("master-department")->with('success', 'Department has been updated.');
    // }

    public function OvertimeApprovalIndex(){
        return view('Submission_form.OvertimeSub');
    }

    public function FindLTDuration(Request $request){
        $data = LeaveType::where('id', $request->lt_id)->first();

        return response()->json($data);
    }
}
