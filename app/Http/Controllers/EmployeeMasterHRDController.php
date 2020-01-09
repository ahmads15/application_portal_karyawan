<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use Illuminate\Support\Facades\Validator;
use App\department;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Position;

class EmployeeMasterHRDController extends Controller
{
    // ini untuk division
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('show');
    }
    // POSITION
    public function managePosition()
    {
        $position = Position::orderby('id','desc')
            ->selectRaw('d.department_name as department_name, position.*')
            ->leftJoin('department as d', 'd.id', '=', 'position.department_id')
            ->get();    
        $departments = department::all();
        return view('position.index', compact('position', 'departments'));
    }
    // add 
    public function addposition(Request $request)
    {
        $rules = [
            'department_name' => 'required',
            'name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("master-position")->with('danger', 'Failed to add new position, Input your position.');
        }
        $newPosition = new Position();
        $newPosition->department_id = $request['department_name'];
        $newPosition->position_name = $request['name'];
        $newPosition->save();
        return redirect("master-position")->with('success', 'New Position has been created.');
    }

    public function editposition($id)
    {

        $editposition = Position::find($id);

        return view('position.index', ['position' => $editposition]);
    }

    public function doeditposition(Request $request, $id)
    {
        $rules = [
            'department_name' => 'required',
            'position_name' => 'required',
            
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $notification = array(
                'message' => $validator->errors()->first(),
                'alert-type' => 'error'
            );
            return redirect("master-position")->with($notification);
        }

        $position = Position::find($id);

        // ini untuk validasi
        $position->position_name = $request['position_name'];
        $position->department_id = $request['department_name'];
        $position->save();


        // untuk meredirect dan memberikan notif sukses
        return redirect("master-position")->with('success',$position->position_name.' has been edited');
    }
    public function deletePosition($id)
    {
        $position = Position::find($id);
        $position->delete();
        return redirect("master-position")->with('success', 'Position has been deleted.');
    }
    // DIVISION

    public function manageDivision()
    {
        $division = Division::all();
        return view('division.index', compact('division'));
    }



    // add division
    public function adddivision(Request $request)
    {
        $division = Division::all();
        $rules = [
            'division_name' => 'required|unique:division'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("division-master")->with('danger', 'Failed to add new division, Input your division.');
        }
        $newDivision = new Division();
        $newDivision->division_name = $request['division_name'];
        $newDivision->save();
        return redirect("division-master")->with('success', 'New Division has been created.');
    }
    // delete Division
    public function deleteDivision($id)
    {
        $division = Division::find($id);
        $division->delete();
        return redirect("division-master")->with('danger', 'Division has been deleted.');
    }
    //  ediit Division
    public function editdivision($id)
    {
        $editdivision = Division::find($id);
        return view('division.index', ['division' => $editdivision]);
    }
    public function doeditdivision(Request $request, $id)
    {
        $rules = [
            'division_name' => 'required|unique:division',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("division-master")->withErrors($validator)->withInput();
        }
        $division = Division::find($id);
        $division->division_name = $request['division_name'];
        $division->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("division-master")->with('success', 'Division has been updated.');
    }


    // Department
    public function manageDepartment()
    {
        $department = department::selectRaw('d.division_name as division_name, us1.name as supervisor, us2.name as head_supervisor, department.*')
            ->leftJoin('users as us1', 'us1.id', '=', 'department.supervisor_id')
            ->leftJoin('users as us2', 'us2.id', '=', 'department.hs_id')
            ->leftJoin('division as d', 'd.id', '=', 'department.division_id')
            ->orderby('id', 'desc')->get();

        $divisions = Division::all();

        $h_supervisors = User::selectRaw('users.*')
            ->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id')
            ->join('roles as r', 'r.id', '=', 'mr.role_id')
            ->whereRaw('r.name = "Head Supervisor"')
            ->get();

        $supervisors = User::selectRaw('users.*')
            ->join('model_has_roles as mr', 'mr.model_id', '=', 'users.id')
            ->join('roles as r', 'r.id', '=', 'mr.role_id')
            ->whereRaw('r.name = "Supervisor"')
            ->get();

        return view('department.index', compact('department', 'divisions', 'supervisors', 'h_supervisors'));
    }
    public function adddepartment(Request $request)
    {
        $rules = [
            'division' => 'required',
            'name' => 'required',
            'head_supervisor' => 'required',
            'supervisor' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $notification = array(
                'message' => $validator->errors()->first(),
                'alert-type' => 'error'
            );
            return redirect("master-department")->with($notification);
        }

        $newDepartment = new department();
        $newDepartment->department_name = $request['name'];
        $newDepartment->division_id = $request['division'];
        $newDepartment->hs_id = $request['head_supervisor'];
        $newDepartment->supervisor_id = $request['supervisor'];
        $newDepartment->save();
        // Alert::success('New Department berhasil ditambahkan', 'Success Added !');
        return redirect("master-department")->with('success','New Department has been added.');
    }

    //  ediit 
    public function doeditdepartment(Request $request, $id)
    {
        $rules = [
            'division' => 'required',
            'name' => 'required',
            'head_supervisor' => 'required',
            'supervisor' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $notification = array(
                'message' => $validator->errors()->first(),
                'alert-type' => 'error'
            );
            return redirect("master-department")->with($notification);
        }
        $department = department::find($id);
        // ini untuk validasi
        $department->division_id = $request['division'];
        $department->department_name = $request['name'];
        $department->hs_id = $request['head_supervisor'];
        $department->supervisor_id = $request['supervisor'];
        $department->save();

        return redirect ("master-department")->with('success', 'Department has been updated.');
    }
    public function deleteDepartment($id)
    {
        $department = department::find($id);
        $department->delete();
        return redirect("master-department")->with('success', 'Department has been deleted.');
    }
}
