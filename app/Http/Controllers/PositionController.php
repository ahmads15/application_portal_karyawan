<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    // view
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('show');
    }

    public function managePosition()
    {

        $position = Position::all();

        return view('position.index', compact('position'));
    }
    // add 
    public function addposition(Request $request)
    {
        $position = Position::all();

        $rules = [
            'name' => 'required|unique:division'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("manage-position")->with('danger', 'Failed to add new position, Input your position.');
        }

        $newPosition = new Position();
        $newPosition->name = $request['name'];

        $newPosition->save();

        return redirect("master-position")->with('success', 'New Position has been created.');
    }
    // delete 
    public function deletePosition($id)
    {
        $position = Position::find($id);
        $position->delete();
        return redirect("master-position")->with('danger', 'Position has been deleted.');
    }

    // ini untuk search 
    public function searchposition(Request $request)
    {

        $position = Position::selectRaw('position.id, position.name')
            ->whereRaw(
                'position.name = ?',
                [$request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('position.index', compact('position', 'search'));
    }

    //  ediit 
    public function editposition($id)
    {

        $editposition = Position::find($id);

        return view('position.index', ['position' => $editposition]);
    }

    public function doeditposition(Request $request, $id)
    {


        $rules = [
            'name' => 'required|unique:position',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("master-position")->with('danger', 'Position must be unique.');
        }


        $position = Position::find($id);

        // ini untuk validasi
        $position->name = $request['name'];
        $position->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("master-position")->with('success', 'Position has been updated.');
    }
}
