<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
{
    // view
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('show');
    }

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
            'name' => 'required|unique:division'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("master-division")->with('danger', 'Failed to add new division, Input your division.');
        }

        $newDivision = new Division();
        $newDivision->name = $request['name'];

        $newDivision->save();

        return redirect("master-division")->with('success', 'New Division has been created.');
    }
    // delete department
    public function deleteDivision($id)
    {
        $division = Division::find($id);
        $division->delete();
        return redirect("master-division")->with('danger', 'Division has been deleted.');
    }

    // ini untuk search 
    public function searchdivision(Request $request)
    {

        $division = Division::selectRaw('division.id, division.name')
            ->whereRaw(
                'division.name = ?',
                [$request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('division.index', compact('division', 'search'));
    }

    //  ediit 
    public function editdivision($id)
    {

        $editdivision = Division::find($id);

        return view('division.index', ['division' => $editdivision]);
    }

    public function doeditdivision(Request $request, $id)
    {


        $rules = [
            'name' => 'required|unique:division',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("master-division")->with('danger', 'Division must be unique.');
        }


        $division = Division::find($id);

        // ini untuk validasi
        $division->name = $request['name'];
        $division->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("master-division")->with('success', 'Division has been updated.');
    }
}
