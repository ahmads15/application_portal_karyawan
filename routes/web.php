<?php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//  INI ROUTE UNTUK DI MASTER DATA

// route employee_master by admin
Route::resource('users', 'UserController');
Route::get('delete-user/{id}', 'UserController@deleteUser');
Route::get('export-userAdmin', 'UserController@userExportAdmin');
Route::post('import-userAdmin', 'UserController@userImportAdmin');
// Route::get('download-template-admin', 'UserController@downloadtemplateAdmin');


// route untuk employe_master by hrd
Route::get('master-employee-detail', 'UserController@dataEmployee1');
Route::get('edit-employee/{id}', 'UserController@editEmployee');
Route::post('edit-employee/{id}', 'UserController@doEditEmployee');
Route::get('download-template-hrd', 'UserController@downloadtemplateHrd');

Route::get('/find-department', 'UserController@find_department');
Route::get('/find-supervisor', 'UserController@find_supervisor');
Route::get('/find-hsupervisor', 'UserController@find_hsupervisor');
Route::get('/find-position', 'UserController@find_position');

// route user
Route::get('profile', 'UserController@profile');
Route::post('users-search', 'UserController@searchuser');
Route::get('users-detail/{id}', 'UserController@detail')->name('users.detail');;



// INI ROUTE UNTUK DI MAIN MENU
// employee data
Route::get('data-employee', 'UserController@dataEmployee');



//  INI DI SETTINGS
//  update account profile
Route::get('update-account/{id}', 'UserController@updateAccount');
Route::post('update-account/{id}', 'UserController@doUpdateAccount');
Route::get('update-profile/{id}', 'UserController@updateProfile');
Route::post('update-profile/{id}', 'UserController@doUpdateProfile');

//  update and remove image
Route::post('user-update-picture', 'UserController@updatepicture');
Route::get('user-remove-picture/{id}', 'UserController@removepicture');

//  route roles
Route::resource('roles', 'RoleController');
Route::get('delete-role/{id}', 'RoleController@deleteRole');

// company setting
Route::post('/company-store', 'CompanyController@CompanyStore');
Route::get('company-setting', 'CompanyController@manageCompany'); 

// route permission
Route::resource('permissions', 'PermissionController');

// route dashboard
Route::resource('dashboard', 'DashboardController');

// route todo list
Route::post('add-todo', 'DashboardController@addtodo');
Route::get('add-todo', function () {
    return view('dashboard');
});
Route::get('delete-todo', 'DashboardController@deletetodo');

// route attendance
Route::get('attendance', 'AttendanceController@index');
Route::post('do_absen', 'AttendanceController@doabsen');

// route employee performance
Route::get('employee-performance', 'employeePeformanceController@index');
Route::get('api/employee-performance/{year}','employeePeformanceController@getEmployeePerformance');
// route import export add user
Route::get('export-user', 'UserController@userExport');
Route::post('import-user', 'UserController@userImport');
Route::get('download-template-user', 'UserController@downloadtemplate');

// route donwload template file user
route::get('donwload-files', 'DashboardController@donwloadFiles');
// route untuk master department
Route::get('master-department', 'EmployeeMasterHRDController@manageDepartment');
Route::post('add-department', 'EmployeeMasterHRDController@adddepartment');
Route::get('add-department', function () {
    return view('department.add');
});
Route::get('delete-department/{id}', 'EmployeeMasterHRDController@deleteDepartment');
Route::get('edit-department/{id}', 'EmployeeMasterHRDController@editdepartment');
Route::post('edit-department/{id}', 'EmployeeMasterHRDController@doeditdepartment');

// route master division
Route::get('division-master', 'EmployeeMasterHRDController@manageDivision');
Route::post('add-division', 'EmployeeMasterHRDController@adddivision');
Route::get('add-division', function () {
    return view('division.index');
});
Route::get('delete-division/{id}', 'EmployeeMasterHRDController@deleteDivision');
Route::get('edit-division/{id}', 'EmployeeMasterHRDController@editdivision');
Route::post('edit-division/{id}', 'EmployeeMasterHRDController@doeditdivision');

// route master position
Route::get('master-position', 'EmployeeMasterHRDController@managePosition');
Route::post('add-position', 'EmployeeMasterHRDController@addposition');
Route::get('add-position', function () {
    return view('position.index');
});
Route::get('delete-position/{id}', 'EmployeeMasterHRDController@deletePosition');
Route::get('edit-position/{id}', 'EmployeeMasterHRDController@editposition');
Route::post('edit-position/{id}', 'EmployeeMasterHRDController@doeditposition');

// route reporting 
Route::get('/Reporting-LeaveReport', 'ReportingController@LeaveRepindex');
Route::get('/Reporting-DetailLeave/{id}','ReportingController@leaveDetail');
Route::get('/Reporting-PaySlipReport', 'ReportingController@PaySlipRepindex');
Route::get('/Reporting-PaySlipReport-PaySlipDetail/{id}', 'ReportingController@PaySlipDetail');
Route::get('/Reporting-OvertimeReport', 'ReportingController@OvertimeRepindex');
Route::get('/Reporting-TotalOvertime','ReportingController@getTotalOvertime');
Route::get('/Reporting-DetailOvertime/{id}','ReportingController@getDetailOvertimer');
Route::get('/Reporting-LoanReport', 'ReportingController@LoanRepindex');

// employee report HRD
Route::get('/EmployeeReport-AttendanceReport', 'EmployeeReportController@AttendanceRepindex');
Route::get('/EmployeeReport-SalaryReport', 'EmployeeReportController@SalaryRepindex');
Route::get('/EmployeeReport-LeaveReport', 'EmployeeReportController@LeaveRepindexHRD');
Route::get('/EmployeeReport-OvertimeReport', 'EmployeeReportController@OvertimeRepindexHRD');

// route Submission form
// leave
Route::get('/SubmissionForm-DayOffSubmission', 'SubmissionFormController@leaveSubindex');
Route::post('/SubmissionForm-DayOffSubmission', 'SubmissionFormController@addDoLeaveType');
Route::get('leave-duration', 'SubmissionFormController@FindLTDuration');
Route::post('/SubmissionForm-leaveSubmission-store', 'SubmissionFormController@leaveSubmissionStore');
Route::post('/leaveSub-check', 'SubmissionFormController@leaveSubCheck');

// overtime
Route::get('/SubmissionForm-LoanSubmission', 'SubmissionFormController@loanSubIndex');
Route::get('/SubmissionForm-OvertimeSubmission', 'SubmissionFormController@OvertimeSubIndex');
Route::post('/SubmissionForm-overSubmission-store', 'SubmissionFormController@overSubmissionStore');
Route::post('update-overtime-sub', 'ApprovalController@update_overtime');

// employee payroll 
Route::get('/EmployeePayroll', 'EmployeePayrollController@EmployeePayrollIndex');
Route::get('/EmployeePayroll-EmployeeSubmitPayroll/{id}', 'EmployeePayrollController@EmployeeSubmitPayrollIndex');
Route::post('/submit-salary-payroll', 'EmployeePayrollController@submit');

// route Approval
Route::get('approval', 'ApprovalController@index');
Route::post('update-leaves-sub', 'ApprovalController@update_leaves');

// Bank master
Route::get('/masterdata-payrollmaster-bankmaster', 'PayrollMasterController@BankMasterIndex');
Route::post('/masterdata-payrollmaster-bankmaster-store', 'PayrollMasterController@BankMasterStore');
Route::get('/masterdata-payrollmaster-bankmaster-edit/{id}', 'PayrollMasterController@editBankMaster');
Route::post('/masterdata-payrollmaster-bankmaster-edit/{id}', 'PayrollMasterController@doeditBankMaster');
Route::get('/masterdata-payrollmaster-bankmaster-delete/{id}', 'PayrollMasterController@deleteBankMaster');


//salary_level_master
Route::get('/masterdata-payrollmaster-salarylevelmaster', 'PayrollMasterController@SalaryLevelMasterIndex');
Route::post('/masterdata-payrollmaster-salarylevelmaster-store', 'PayrollMasterController@SalaryLevelMasterStore');
Route::get('/masterdata-payrollmaster-salarylevelmaster-edit/{id}', 'PayrollMasterController@editSalaryLevel');
Route::post('/masterdata-payrollmaster-salarylevelmaster-edit/{id}', 'PayrollMasterController@doeditSalaryLevel');
Route::get('/masterdata-payrollmaster-salarylevelmaster-delete/{id}', 'PayrollMasterController@deleteSalaryLevel');
Route::post('/masterdata-payrollmaster-salarylevelmaster-search', 'PayrollMasterController@searchSalaryLevel');

// BPJS_Type_master
Route::get('/masterdata-payrollmaster-BPJStypemaster', 'PayrollMasterController@BPJSTypeMasterIndex');
Route::post('/masterdata-payrollmaster-BPJStypemaster-store', 'PayrollMasterController@BPJSTypeMasterStore');
Route::get('/masterdata-payrollmaster-BPJStypemaster-edit/{id}', 'PayrollMasterController@editBPJSType');
Route::post('/masterdata-payrollmaster-BPJStypemaster-edit/{id}', 'PayrollMasterController@doeditBPJSType');
Route::get('/masterdata-payrollmaster-BPJStypemaster-delete/{id}', 'PayrollMasterController@deleteBPJSType');
Route::post('/masterdata-payrollmaster-BPJStypemaster-search', 'PayrollMasterController@searchBPJSType');


// ini untuk leave type master
// ini view
Route::get('/masterdata-payrollmaster-leavetypemaster', 'PayrollMasterController@LeaveTypeMasterIndex');
// ini untuk add
Route::post('/masterdata-payrollmaster-leavetypemaster-store', 'PayrollMasterController@LeaveTypeMasterStore');
// delete
Route::get('/masterdata-payrollmaster-leavetypemaster-delete/{id}', 'PayrollMasterController@deleteLeaveType');
// edit
Route::get('/masterdata-payrollmaster-leavetypemaster-edit/{id}', 'PayrollMasterController@editLeaveType');
Route::post('/masterdata-payrollmaster-leavetypemaster-edit/{id}', 'PayrollMasterController@doeditLeaveType');
// end leave type


// ini untuk incentive master
Route::get('/masterdata-payrollmaster-incentivemaster', 'PayrollMasterController@IncentiveMasterIndex');
Route::post('/masterdata-payrollmaster-incentivemaster-store', 'PayrollMasterController@IncentiveMasterStore');
Route::get('/masterdata-payrollmaster-incentivemaster-delete/{id}', 'PayrollMasterController@deleteIncentive');
Route::get('/masterdata-payrollmaster-incentivemaster-edit/{id}', 'PayrollMasterController@editIncentive');
Route::post('/masterdata-payrollmaster-incentivemaster-edit/{id}', 'PayrollMasterController@doeditIncentive');
// end incentive

// ini untuk pph master
Route::get('/masterdata-payrollmaster-PPHtypemaster', 'PayrollMasterController@PPHtypeMasterIndex');
Route::post('/masterdata-payrollmaster-PPHtypemaster-store', 'PayrollMasterController@PPHTypeMasterStore');
Route::get('/masterdata-payrollmaster-PPHtypemaster-delete/{id}', 'PayrollMasterController@deletePPH');
Route::get('/masterdata-payrollmaster-PPHtypemaster-edit/{id}', 'PayrollMasterController@editPPH');
Route::post('/masterdata-payrollmaster-PPHtypemaster-edit/{id}', 'PayrollMasterController@doeditPPH');
// end pph

// ini untuk PTKP Master
Route::get('/masterdata-payrollmaster-PTKPtypemaster', 'PayrollMasterController@PTKPTypeMasterIndex');
Route::post('/masterdata-payrollmaster-PTKPtypemaster-store', 'PayrollMasterController@PTKPTypeMasterStore');
Route::get('/masterdata-payrollmaster-PTKPtypemaster-delete/{id}', 'PayrollMasterController@deletePTKP');
Route::get('/masterdata-payrollmaster-PTKPtypemaster-edit/{id}', 'PayrollMasterController@editPTKP');
Route::post('/masterdata-payrollmaster-PTKPtypemaster-edit/{id}', 'PayrollMasterController@doeditPTKP');
// end PTKP


// ini untuk Working days Master
Route::get('/masterdata-payrollmaster-workingdaysmaster', 'PayrollMasterController@WorkingDaysMasterIndex');
Route::post('/masterdata-payrollmaster-workingdaysmaster-store', 'PayrollMasterController@WorkingDaysStore');
Route::get('/masterdata-payrollmaster-workingdaysmaster-edit/{id}', 'PayrollMasterController@editWorkingDays');
Route::post('/masterdata-payrollmaster-workingdaysmaster-edit/{id}', 'PayrollMasterController@doeditWorkingDays');
Route::get('/masterdata-payrollmaster-workingdaysmaster-delete/{id}', 'PayrollMasterController@deleteWorkingDays');
// end Working days Master

// ini untuk  filter
Route::post('roles-search', 'RoleController@searchrole');
Route::post('roles-search-employee', 'UserController@searchrole');

