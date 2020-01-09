<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\User;
use Excel;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Session;
use App\department;
use Illuminate\Support\Facades\Response;
use App\Division;
use App\Position;
use App\user_has_position;
use App\PTKP;
use App\Company;
use Alert;
use App\Bank_master;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('show');
    }

    // search user view
    public function searchuser(Request $request)
    {
        $users = User::selectRaw('users.id, users.name,users.email,users.position,users.created_at')
            ->whereRaw(
                'users.name = ? or users.email = ? or users.position = ?',
                [$request->search, $request->search, $request->search]
            )
            ->paginate(10);
        $search = $request->search;

        return view('users.index', compact('users', 'search'));
    }
    
    public function searchrole(Request $request)
    {
        $users = User::orderby('created_at', 'desc')
        ->selectRaw('users.id as id, users.created_at, users.name as name,users.email,users.company_name')
        ->get();
        if($request->role_id != 'all'){
            $roles = Role::where('id', $request->role_id)->get();
        }
        else{
            $roles = Role::all();
        }
        $select_roles = Role::all();
        return view('master_data.employeemaster_byadmin.index', compact('roles', 'select_roles','users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // -----------------------------------------------------------------------------------------------------------------------------------
    //  INI FUNCTION UNTUK EMPLOYEE MASTER BY ADMIN

    // Ini view data employee
    public function index()
    {
        $users = User::orderby('created_at', 'desc')
            ->selectRaw('users.id as id, users.created_at, users.name as name,users.email,users.company_name')
            ->get();
        $roles = Role::all(); //Get all roles
        $select_roles = Role::all();
        return view('master_data.employeemaster_byadmin.index', compact('roles', 'select_roles','users'));
    }
    // add employee data
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get all roles and pass it to the view
        $roles = Role::get();
        return view('master_data.employeemaster_byadmin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name, email and password fields
        $rules = [
            'name' => 'required|max:120',
            'company_name' => 'required',
            'email' => 'required|email|unique:users',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('users/create')->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->name = $request->name;   
        $user->company_name = $request->company_name;
        $user->email = $request->email;
        $password = "Emportal123";
        $user->password = $password;
        $roles = $request['roles']; //Retrieving the roles field
        $user->save();
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        return redirect()->route('users.index')->with('success', 'New User has been added. ');
    }
    // end add employee data
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  get user to edit view
    public function edit($id)
    {
        $roles = Role::get(); //Get all roles
        $users = User::find($id);
        return view('master_data.employeemaster_byadmin.edit', compact('users', 'roles')); //pass user and roles data to view
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //  do update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        //Validate name, email and password fields 
        if ($request->input('password')) {
            $rules = [
                'name' => 'required',
                'email' => 'required|unique:users,email,' . $id,
                'company_name' => 'required',
                'password' => 'required|min:6|confirmed',
            ];
        } else {
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
            ];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("users/$id/edit")->withErrors($validator)->withInput();
        }
        $user = User::find($id);
        if ($request->input('password')) {
            $user->name = $request['name'];
            $user->company_name = $request['company_name'];
            $user->email = $request['email'];
            $user->password = $request['password'];
        } else {
            $user->name = $request['name'];
            $user->company_name = $request['company_name'];
            $user->email = $request['email'];
        }
        $roles = $request['roles']; //Retreive all roles
        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        $user->save();
        return redirect()->route('users.index')->with('success', $user->name . ' Has been edited. ');
    }
    // delete user by admin
    public function deleteUser($id)
    {
        $user = User::find($id); /*Mengambil data user sesuai id user*/
        $user->delete(); /*Menghapus user yang dipilih sesuai id user*/
        return redirect()->route('users.index')->with('success', $user->name . ' has been deleted. ');
    }
    // export to excel
    public function userExportAdmin()
    {
        $users = User::all();
        $array_role = [];
        foreach ($users as $user) {
            $role = $user->roles()->pluck('name')->implode(' ');
            array_push($array_role, $role);
        }
        $user = User::select('name', 'company_name', 'email')->get();
        return Excel::create('data_userByAdmin', function ($excel) use ($user, $array_role) {
            $excel->sheet('mysheet', function ($sheet) use ($user, $array_role) {
                $sheet->fromArray($user);
                $sheet->data = [];
                $sheet->setCellValue('A1', 'Name');
                $sheet->setCellValue('B1', 'Company Name');
                $sheet->setCellValue('C1', 'Email');
                $sheet->setCellValue('D1', 'Role');
                $row = 2;
                foreach ($array_role as $role) {
                    $sheet->setCellValue(('D' . $row), $role);
                    $row++;
                }
            });
        })->download('xls');
    }
    // add user using import excel

    public function userImportAdmin(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function ($reader) { })->get();
            if (!empty($data) && $data->count()) {
                $flag = 0;
                $nip_error = "";
                $email_error = "";
                foreach ($data as $key => $value) {
                    $check_user_nip = User::whereRaw('nip = ?', [$value->nip])->get();
                    $check_user_email = User::whereRaw('email = ?', [$value->email])->get();
                    $check_user_role = Role::whereRaw('name = ?', [$value->role])->get();
                    if (count($check_user_nip) > 0) {
                        $flag = 1;
                        $nip_error = $nip_error . $value->nip . " has been registered." . "-";
                    } elseif (count($check_user_email) > 0) {
                        $flag = 1;
                        $email_error = $email_error . $value->email . " has been registered." . "-";
                    } else { 
                        $user = new User();
                        $user->name = $value->name;
                        $user->company_name = $value->company_name;
                        $user->email = $value->email;
                        $password = "Emportal123";
                        $user->password = $password;
                        $user->save();

                        // Save Role
                        $role_id = Role::whereRaw('name = ?', [$value->role])->first()->id;

                        DB::table('model_has_roles')->insert([
                            'model_id' => $user->id,
                            'role_id' => $role_id,
                            'model_type' => 'App\User'
                        ]);
                    }
                }
                if ($flag == 1) {
                    $error = substr($nip_error, 0, -1) . "*" . substr($email_error, 0, -1);
                    return back()->with('error', $error);
                }
            }
        }
        return back()->with('success', 'Data has been added');
    }
    // donwload template excel by ADMIN
    // public function downloadtemplateAdmin()
    // {
    //     $file = public_path()."/files/import-template-byAdmin.xls";
    //     return MaatwebsiteExcel::download($file, 'import-template-byAdmin.xls');
    // }
    // END EMPLOYEE_MASTER BY ADMIN
    // ------------------------------------------------------------------------------------------------------------------------------------------

    //  GOOD JOB !!!!
    // --------------------------------------------------------------------------------------------------------------------------------------------
    // INI FUNCTION UNTUK EMPLOYEE MASTER BY HRD
    //  view data employee
    public function dataEmployee1()
    {
        $dataemployee1 = User::orderby('id', 'desc')
            ->selectRaw('users.id as id ,users.nip,users.name,t3.department_name,t2.position_name,users.status_karyawan')
            ->leftJoin('user_has_position as t1', 'users.id', '=', 't1.user_id')
            ->leftJoin('position as t2', 't1.position_id', '=', 't2.id')
            ->leftJoin('department as t3', 't2.department_id', '=', 't3.id')
            ->get();
        return view('master_data.employeemaster_byhrd.index', ['users' => $dataemployee1]);
    }
    // edit employee
    public function editEmployee($id)
    {
        $department = department::all();
        $divisions = Division::all();
        $position = Position::all();
        $bank = Bank_master::all();
        $users = User::find($id);
        return view('master_data.employeemaster_byhrd.edit', compact('users', 'department', 'divisions', 'position', 'bank', 'supervisors')); //pass user
    }
    public function doEditEmployee(Request $request, $id)
    {
        /*Validator update user Account*/
        $rules = [
            'name' => 'required|max:120',
            'email' => 'required',
            'nip' => 'required',
            'no_rekening' => 'required',
            'default_leave' => 'required',
            'bank' => 'required',
            'region' => 'required|max:120',
            'gender' => 'required',
            'education' => 'required',
            'placeofbirth' => 'required',
            'birthofdate' => 'required',
            'address' => 'required',
            'status' => 'required',
            // 'department' => 'required',
            // 'division' => 'required',
            // 'position' => 'required',
            'status_karyawan' => 'required',
            'private_email' => 'required',
            'phone_number' => 'required',
            'emergency_number' => 'required',
            'emergency_name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("edit-employee/$id")->withErrors($validator)->withInput();
        }
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->nip = $request['nip'];
        $user->bank_id = $request['bank'];
        $user->no_rekening = $request['no_rekening'];
        $user->default_leave = $request['default_leave'];
        $user->region = $request['region'];
        $user->gender = $request['gender'];
        $user->education = $request['education'];
        $user->placeofbirth = $request['placeofbirth'];
        $user->number_of_kids = $request['number_of_kids'];
        $user->birthofdate = $request['birthofdate'];
        $user->address = $request['address'];
        $user->status = $request['status'];
        // $user->division_id = $request['division'];
        // $user->position_id = $request['position'];
        $user->status_karyawan = $request['status_karyawan'];
        $user->private_email = $request['private_email'];
        // $user->department_id = $request['department'];
        $user->phone_number = $request['phone_number'];
        $user->emergency_number = $request['emergency_number'];
        $user->emergency_name = $request['emergency_name'];
        $user->save();
        return redirect("master-employee-detail")->with('success', $user->name . ' has been edited');
    }
    // donwload template excel by ADMIN
    // public function downloadtemplateHrd()
    // {
    //     $file = public_path() . "/files/import-template-byHRD.xls";
    //     return Response::download($file, 'import-template-byHRD.xls');
    // }


    // END FUNCTION EMPLOYEE MASTER BY HRD
    // ============================================================================================================================================


    // --------------------------------------------------------------------------------------------------------------------
    //  INI UNTUK FUNCTION DI MAIN MENU
    // employee Data
    public function dataEmployee()
    {
        $dataemployee = User::orderby('id', 'desc')
            ->selectRaw('users.id as id ,users.private_email,users.name,
                            users.phone_number, users.created_at,users.status_karyawan,users.profile_picture,uhs.total_salary')
            ->leftJoin('user_has_salary as uhs', 'users.id', '=', 'uhs.user_id')
            // ->leftJoin('department as d', 'd.id', '=', 'users.department_id')
            // ->leftJoin('division as dv', 'dv.id', '=', 'users.division_id')
            ->paginate(10);
        return view('employee_data.data-employee', ['users' => $dataemployee]);
    }
    // detail employee
    public function detail($id)
    {
        $query_data_user = "select 
                            t1.nip,
                            t1.name,
                            t1.gender,
                            t1.email,
                            t1.phone_number,
                            t1.birthofdate,
                            t1.address,
                            t1.status_karyawan,
                            t1.status,
                            t1.no_rekening,
                            t1.region,
                            t1.education,
                            t1.placeofbirth,
                            t1.profile_picture,
                            t1.number_of_kids,
                            t1.default_leave,
                            t1.emergency_name,
                            t1.emergency_number,
                            t1.private_email,
                            t3.position_name,
                            t4.department_name, 
                            t5.division_name, 
                            t6.bank_name,
                            t6.bank_code,
                            t7.total_salary
                        from users as t1
                        left join user_has_position as t2 on t1.id = t2.user_id
                        left join `position` as t3 on t2.position_id = t3.id
                        left join department as t4 on t3.department_id = t4.id
                        left join division as t5 on t4.division_id = t5.id
                        left join bank as t6 on t1.bank_id = t6.id
                        left join user_has_salary as t7 on t1.id  = t7.user_id
                        where t1.id = " . $id;

        $user = Db::select(DB::raw($query_data_user))[0];
        return view('employee_data.detail', compact('user'));
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $query_data_user = "select 
                            t1.nip,
                            t1.name,
                            t1.gender,
                            t1.email,
                            t1.phone_number,
                            t1.birthofdate,
                            t1.address,
                            t1.status_karyawan,
                            t1.status,
                            t1.no_rekening,
                            t1.region,
                            t1.education,
                            t1.placeofbirth,
                            t1.number_of_kids,
                            t1.default_leave,
                            t1.emergency_name,
                            t1.emergency_number,
                            t1.private_email,
                            t3.position_name,
                            t4.department_name, 
                            t5.division_name, 
                            t6.bank_name,
                            t6.bank_code,
                            t7.total_salary
                        from users as t1
                        left join user_has_position as t2 on t1.id = t2.user_id
                        left join `position` as t3 on t2.position_id = t3.id
                        left join department as t4 on t3.department_id = t4.id
                        left join division as t5 on t4.division_id = t5.id
                        left join bank as t6 on t1.bank_id = t6.id
                        left join user_has_salary as t7 on t1.id  = t7.user_id
                        where t1.id = " . $id;

        $user = Db::select(DB::raw($query_data_user))[0];
        return view('users.profile', compact('user'));

        // return view('users.profile', compact('user', 'position'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with(
                'flash_message',
                'User successfully deleted.'
            );
    }
    // export data employee 
    public function userExport()
    {
        $user = User::orderby('nip', 'desc')
            ->selectRaw('users.nip, users.name as name ,t6.bank_name as bank,users.no_rekening ,users.gender,users.email,users.private_email,users.region,users.education,users.placeofbirth,users.birthofdate,
                            users.phone_number,users.emergency_number,users.emergency_name,users.address,users.number_of_kids ,users.default_leave ,
                            users.status,users.status_karyawan,t5.total_salary,t2.position_name,t3.department_name,t4.division_name')
            ->leftJoin('user_has_position as t1', 'users.id', '=', 't1.user_id')
            ->leftJoin('position as t2', 't1.position_id', '=', 't2.id')
            ->leftJoin('department as t3', 't2.department_id', '=', 't3.id')
            ->leftJoin('division as t4', 't3.division_id', '=', 't4.id')
            ->leftJoin('user_has_salary as t5', 'users.id', '=', 't5.user_id')
            ->leftJoin('bank as t6', 't6.id', '=', 'users.bank_id')
            ->get();
        return Excel::create('data_user', function ($excel) use ($user) {
            $excel->sheet('mysheet', function ($sheet) use ($user) {
                $sheet->fromArray($user);
            });
        })->download('xls');
    }
    // update and delete picture profile
    public function updatepicture(Request $request)
    {
        $user = User::find($request->id);
        if ($request->file('profile_picture') != null) {
            $rand = rand();
            if ($user->profile_picture != null) {
                unlink('images/profile/' . $user->profile_picture);
            }
            $file = $request->file('profile_picture');
            $file->move(public_path('/images/profile'), $rand . $file->getClientOriginalName());
            $user->profile_picture = $rand . $file->getClientOriginalName();
            $user->save();
        }

        return back()->with('update_pp', 'Picture has been updated.');
    }
    public function removepicture($id)
    {
        $user = User::find($id);
        unlink('images/profile/' . $user->profile_picture);
        $user->profile_picture = null;
        $user->save();
        return back()->with('remove_pp', 'Picture has been removed.');
    }
    public function userImport(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function ($reader) { })->get();
            if (!empty($data) && $data->count()) {
                $flag = 0;
                $nip_error = "";
                $email_error = "";
                foreach ($data as $key => $value) {
                    $check_user_nip = User::whereRaw('nip = ?', [$value->nip])->get();
                    $check_user_email = User::whereRaw('email = ?', [$value->email])->get();
                    if (count($check_user_nip) > 0) {
                        $flag = 1;
                        $nip_error = $nip_error . $value->nip . " has been registered." . "-";
                    } elseif (count($check_user_email) > 0) {
                        $flag = 1;
                        $email_error = $email_error . $value->email . " has been registered." . "-";
                    } else {
                        $user = new User();
                        $user->nip = $value->nip;
                        $user->department_id = $value->department;
                        $user->position_id = $value->position;
                        $user->division_id = $value->division;
                        $user->name = $value->name;
                        $user->profile_picture = $value->profile_picture;
                        $user->education = $value->education;
                        $user->email = $value->email;
                        $user->gender = $value->gender;
                        $user->private_email = $value->private_email;
                        $user->region = $value->region;
                        $user->phone_number = $value->phone_number;
                        $user->birthofdate = $value->birthofdate;
                        $user->status_karyawan = $value->status_karyawan;
                        $user->address = $value->address;
                        $user->status = $value->status;

                        $dob = date('dmY', strtotime($value->birthofdate));
                        $password = "Emportal" . $dob;
                        $user->password = $password;

                        $user->save();
                    }
                }

                if ($flag == 1) {
                    $error = substr($nip_error, 0, -1) . "*" . substr($email_error, 0, -1);

                    return back()->with('error', $error);
                }
            }
        }
        return back();
    }



    // Ini function untuk dibagian SETTINGS
    // update account
    public function updateAccount($id)
    {
        /*Mengambil data user sesuai id untuk dibawa ke view update-account*/

        $updateAccount = User::find($id);
        return view('users.update-account', ['users' => $updateAccount]);
    }

    public function doUpdateAccount(Request $request, $id)
    {

        /*Validator update user Account*/
        $rules = [
            'password' => 'required',
            'password' => 'confirmed',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("update-account/$id")->withErrors($validator)->withInput();
        }

        /*Mengambil data user sesuai id untuk di update dengan data yang baru*/
        $user = User::find($id);
        // ini untuk validasi
        // $user->name = $request['name'];
        $user->password = $request['password'];
        $user->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("update-account/$id")->with('success', 'Data account has been updated.');
    }

    // update profile
    public function updateProfile($id)
    {
        /*Mengambil data user sesuai id untuk dibawa ke view update-account*/

        $updateProfile = User::find($id);
        return view('users.update-profile', ['users' => $updateProfile]);
    }
    public function doUpdateProfile(Request $request, $id)
    {
        /*Validator update user Account*/
        $rules = [
            'name' => 'required',
            'education' => 'required',
            'address' => 'required',
            'status' => 'required',
            'private_email' => 'required',
            'phone_number' => 'required',
            'emergency_number' => 'required',
            'emergency_name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("update-profile/$id")->withErrors($validator)->withInput();
        }
        /*Mengambil data user sesuai id untuk di update dengan data yang baru*/
        $user = User::find($id);
        // ini untuk validasi
        $user->name = $request['name'];
        $user->education = $request['education'];
        $user->address = $request['address'];
        $user->status = $request['status'];
        $user->private_email = $request['private_email'];
        $user->phone_number = $request['phone_number'];
        $user->emergency_number = $request['emergency_number'];
        $user->emergency_name = $request['emergency_name'];
        $user->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("update-profile/$id")->with('success', 'Data profile has been updated.');
    }

    public function find_department(Request $request)
    {
        $response = department::where('division_id', $request->id)->get();

        return response()->json($response);
    }

    public function find_supervisor(Request $request)
    {
        $response = department::selectRaw('us1.name as supervisor, us2.name as head_supervisor')
            ->leftJoin('users as us1', 'us1.id', '=', 'department.supervisor_id')
            ->leftJoin('users as us2', 'us2.id', '=', 'department.hs_id')
            ->where('department.id', $request->id)
            ->first();

        return response()->json($response);
    }

    public function find_position(Request $request)
    {
        $response = Position::where('department_id', $request->id)->get();

        return response()->json($response);
    }


    // END FUNCTION MAIN MENU
    // ------------------------------------------------------------------------------------------------------------------------



}
