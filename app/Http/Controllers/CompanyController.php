<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('index');
    }

    public function manageCompany()
    {

        $company = Company::orderby('id', 'desc')->get();

        return view('company_setting.index', compact('company'));
    }
    public function CompanyStore(Request $request)
    {
        $company = Company::all();
        $rules = [
            'company_name' => 'required',
            'company_picture' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("/company-setting")->withErrors($validator)->withInput();
        }
        $newCompany = new Company();
        $newCompany->company_name = $request['company_name'];
        $newCompany->company_picture = $request['company_picture'];
        $newCompany->save();
        return redirect("/company-setting")->with('success', 'Data has beed added.');
    }
}
