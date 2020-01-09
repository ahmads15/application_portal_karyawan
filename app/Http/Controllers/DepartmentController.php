<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\department;
use Illuminate\Support\Facades\Validator;
use Auth;
use Alert;

class DepartmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('index');
    }

    public function manageDepartment()
    {

        $department = department::orderby('id', 'desc')->get();

        return view('department.index', compact('department'));
    }
    // delete department
    public function deleteDepartment($id)
    {
        $department = department::find($id);
        $department->delete();
        Alert::success('Department ' . $department->name . ' berhasil dihapus', 'Success Deleted !')->persistent("Close");
        return redirect("manage-department");
    }

    // add department
    //  ediit 
    public function editdepartment($id)
    {

        $editdepartment = department::find($id);

        return view('department.index', ['department' => $editdepartment]);
    }

    public function doeditdepartment(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:department',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("master-department")->with('danger', 'Department must be unique.');
        }
        $department = department::find($id);
        // ini untuk validasi
        $department->name = $request['name'];
        $department->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("master-department")->with('success', 'Department has been updated.');
    }
}
