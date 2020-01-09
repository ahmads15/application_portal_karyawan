<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\salary_level;
use Illuminate\Support\Facades\Validator;
use Alert;
use App\Bank_master;
use App\Working_day;
use App\attendance;
use App\userHasPeformance;
use App\leave_type;

class PayrollMasterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('index');
    }
    // -------------- Bank Master----------------------------------------------?
    public function BankMasterIndex()
    {
        $bank_master = Bank_master::orderby('id', 'desc')->get();
        return view('master_data.PayrollMaster.BankTypeMaster', compact('bank_master'));
    }
    public function BankMasterStore(Request $request)
    {
        $rules = [
            'bank_name' => 'required|unique:bank',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("/masterdata-payrollmaster-bankmaster")->withErrors($validator)->withInput();
        }
        $newBank = new Bank_master();
        $newBank->bank_code = $request['bank_code'];
        $newBank->bank_name = $request['bank_name'];
        $newBank->save();
        return redirect("/masterdata-payrollmaster-bankmaster")->with('success', 'New Bank has beed added.');
    }
    public function deleteBankMaster($id)
    {
        $bank_master = Bank_master::find($id);
        $bank_master->delete();
        return redirect("/masterdata-payrollmaster-bankmaster")->with('success', $bank_master->bank_name . ' has beed deleted.');
    }
    public function editBankMaster($id)
    {
        $editbank_master = salary_level::find($id);
        return view('master_data.PayrollMaster.BankTypeMaster', ['bank_master' => $editbank_master]);
    }

    public function doeditBankMaster(Request $request, $id)
    {
        $rules = [
            'bank_code' => 'required |unique :bank',
            'bank_name' => 'required |unique :bank',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("/masterdata-payrollmaster-bankmaster")->withErrors($validator)->withInput();
        }
        $editbank_master = Bank_master::find($id);
        $editbank_master->bank_code = $request['bank_code'];
        $editbank_master->bank_name = $request['bank_name'];
        $editbank_master->save();
        return redirect("/masterdata-payrollmaster-bankmaster")->with('success', $editbank_master->bank_name . ' has beed edited.');;
    }
    // ----------------------------------------------------------------

    // --------------------------Salary Level Master-----------------------------------------//

    // view salary_level
    public function SalaryLevelMasterIndex()
    {
        $salary_level = salary_level::orderby('id', 'desc')->get();
        return view('master_data.PayrollMaster.SalaryLevelMaster', compact('salary_level'));
    }
    // insert salary_level
    public function SalaryLevelMasterStore(Request $request)
    {
        $salary_level = salary_level::all();
        $rules = [
            'level_name' => 'required',
            'salary_amount' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("/masterdata-payrollmaster-salarylevelmaster")->withErrors($validator)->withInput();
        }
        $newSalaryLevel = new salary_level();
        $newSalaryLevel->salary_level_name = $request['level_name'];
        $newSalaryLevel->salary_amount = $request['salary_amount'];
        $newSalaryLevel->save();
        // Alert::success('New Salary Type has beed added', 'Success Added !')->persistent("Close");
        return redirect("/masterdata-payrollmaster-salarylevelmaster")->with('success', 'Data has beed added.');
    }
    //  edit salary level
    public function editSalaryLevel($id)
    {
        $editSalaryLevel = salary_level::find($id);
        return view('master_data.PayrollMaster.SalaryLevelMaster', ['salary_level' => $editSalaryLevel]);
    }

    public function doeditSalaryLevel(Request $request, $id)
    {
        $rules = [
            'level_name' => 'required   ',
            'salary_amount' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("/masterdata-payrollmaster-salarylevelmaster")->withErrors($validator)->withInput();
        }
        $editSalaryLevel = salary_level::find($id);
        // ini untuk narik yang udah diinput
        $editSalaryLevel->salary_level_name = $request['level_name'];
        $editSalaryLevel->salary_amount = $request['salary_amount'];
        $editSalaryLevel->save();
        // untuk meredirect dan memberikan notif sukses
        // Alert::success('User ' . "<b>$editSalaryLevel->level_name</b>"  . ' has been updated', 'Success Edited !')->persistent("Close");
        return redirect("/masterdata-payrollmaster-salarylevelmaster")->with('success', $editSalaryLevel->salary_level_name . ' has beed edited.');;
    }
    // delete salary_level
    public function deleteSalaryLevel($id)
    {
        $salary_level = salary_level::find($id);
        $salary_level->delete();

        return redirect("/masterdata-payrollmaster-salarylevelmaster")->with('success', $salary_level->salary_level_name . ' has beed deleted.');
    }

    // ini untuk search (masih ngaco)
    public function searchSalaryLevel(Request $request)
    {

        $salary_level = salary_level::selectRaw('salary_level.id, salary_level.level_name')
            ->whereRaw(
                'salary_level.level_name = ?',
                [$request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('master_data.PayrollMaster.SalaryLevelMaster', compact('salary_level', 'search'));
    }

    // --------------------------salary level section-----------------------------------------//


    // working days master


    public function WorkingDaysMasterIndex()
    {
        $working_days = Working_day::orderby('id', 'desc')->get();
        return view('master_data.PayrollMaster.WorkingDaysMaster', compact('working_days'));
    }
    public function WorkingDaysStore(Request $request)
    {
        $working_days = Working_day::all();
        $rules = [
            'working_days' => 'required',
            'month' => 'required',
            'year' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("/masterdata-payrollmaster-workingdaysmaster")->withErrors($validator)->withInput();
        }

        $newWorkingDays = new Working_day();
        $newWorkingDays->day_amount = $request['working_days'];
        $newWorkingDays->month = $request['month'];
        $newWorkingDays->year = $request['year'];
        $newWorkingDays->save();

        // FIND ID ATTENDANCE BY USER AUTHENTICATIOn
        $attendance_id = attendance::where('users_id',auth()->user()->id)->get();
        foreach ($attendance_id as $data) {
            userHasPeformance::firstOrCreate(['attendance_id' => $data->id],['workingDays_id' => $newWorkingDays->id]);
//            userHasPeformance::create([
//                'attendance_id' => $data->id,
//                'workingDays_id' => $newWorkingDays->id,
//            ]);
        }

        return redirect("/masterdata-payrollmaster-workingdaysmaster")->with('success', 'Data has beed added.');
    }
    public function deleteWorkingDays($id)
    {
        $working_days = Working_day::find($id);
        $working_days->delete();
        userHasPeformance::where('workingDays_id',$id)->delete();
        return redirect("/masterdata-payrollmaster-workingdaysmaster")->with('success', '  Data has been deleted.');
    }
    public function editWorkingDays($id)
    {
        $working_days = Working_day::find($id);
        return view('master_data.PayrollMaster.WorkingDaysMaster', ['working_days' => $working_days]);
    }
    public function doeditWorkingDays(Request $request, $id)
    {
        $rules = [
            'working_days' => 'required',
            'month' => 'required',
            'year' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("/masterdata-payrollmaster-workingdaysmaster")->withErrors($validator)->withInput();
        }
        $editWorkingDays = Working_day::find($id);
        $editWorkingDays->day_amount = $request['working_days'];
        $editWorkingDays->month = $request['month'];
        $editWorkingDays->year = $request['year'];
        $editWorkingDays->save();
        return redirect("/masterdata-payrollmaster-workingdaysmaster")->with('success',  ' Data  has beed edited.');;
    }

        // --------------------------Leave Type section-----------------------------------------//



        public function LeaveTypeMasterIndex()
        {
            $leave_type = leave_type::orderby('id', 'desc')->get();
            return view('master_data.PayrollMaster.LeaveTypeMaster', compact('leave_type'));
        }
        // add
        public function LeaveTypeMasterStore(Request $request)
        {
            // dd('asdad');
            $leave_type = leave_type::all();
            $rules = [
                'leave_type_name' => 'required',
                'day_amount' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return redirect("masterdata-payrollmaster-leavetypemaster")->withErrors($validator)->withInput();
            }
    
            $newLeaveType = new leave_type();
            $newLeaveType->leave_type_name = $request['leave_type_name'];
            $newLeaveType->day_amount = $request['day_amount'];
            $newLeaveType->save();
    
            // Alert::success('New Leave Type berhasil ditambahkan', 'Success Added !')->persistent("Close");
            return redirect("masterdata-payrollmaster-leavetypemaster")->with('success', 'New Leave Type has beed added.');
        }
        // delete
        public function deleteLeaveType($id)
        {
            $leave_type = leave_type::find($id);
            $leave_type->delete();
    
            // Alert::success($leave_type->leave_type_name . ' has been Deleted', 'Success Deleted !')->persistent("Close");
            return redirect("/masterdata-payrollmaster-leavetypemaster")->with('success', $leave_type->leave_type_name . ' has been deleted.');
        }
    
    
        public function editLeaveType($id)
        {
    
            $leave_type = leave_type::find($id);
    
            return view('master_data.PayrollMaster.LeaveTypeMaster', ['leave_type' => $leave_type]);
        }
        public function doeditLeaveType(Request $request, $id)
        {
            $rules = [
                'leave_type_name' => 'required',
                'day_amount' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect("/masterdata-payrollmaster-leavetypemaster")->withErrors($validator)->withInput();
            }
            $leave_type = leave_type::find($id);
            // ini untuk narik yang udah diinput
            $leave_type->leave_type_name = $request['leave_type_name'];
            $leave_type->day_amount = $request['day_amount'];
            $leave_type->save();
            return redirect("/masterdata-payrollmaster-leavetypemaster")->with('success', $leave_type->leave_type_name . ' has been edited.');
        }
}

