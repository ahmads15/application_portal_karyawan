<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\attendance;
use App\Working_day;
use App\userHasPeformance;
use Alert;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user()->id;
        $date = date("Y-m-d", strtotime('now'));
        $cek_absen = attendance::where(['users_id' => $user, 'date' => $date])
            ->first();
            
        $data_absen = attendance::orderby('date', 'desc')
        ->selectRaw('attendance.id as id , attendance.date , attendance.check_in , attendance.check_out, attendance.attendance_status')
        ->where('users_id', $user)
        ->get();

        $query = "SELECT (COUNT(a.id)/wd.day_amount*10) as performance
            FROM attendance as a 
            JOIN user_has_peformance as uh ON uh.attendance_id = a.id
            JOIN workingdays as wd ON wd.id = uh.workingDays_id
            WHERE DATE_FORMAT(a.date, '%Y %m') = DATE_FORMAT(NOW()-INTERVAL 1 MONTH, '%Y %m') AND a.users_id = '".$user."'
            GROUP BY YEAR(a.date), MONTH(a.date) DESC";
            
        $last_perf = DB::select(DB::raw($query));

        return view('absen.absen', compact('data_absen', 'cek_absen', 'info', 'last_perf'));
    }

    // function button absensi di dashboard
    public function doabsen(Request $request)
    {
        $user = Auth::user()->id;
        $date = date("Y-m-d", strtotime('now'));//2017-02-01
        $time = date("H:i:s", strtotime('now'));

        // absen masuk
        if (isset($request->btnIn)){
            $absen = new attendance();
            $absen->users_id =  $user;
            $absen->date =  $date;
            $absen->check_in =  $time;
            // Working Days ID
            $wd_id = 0;
            $month1 = date('M Y', strtotime($date));
            $working_days = Working_day::all();

            $flag = 0;

            foreach($working_days as $wd){
                $wd_date = $wd->month.$wd->year;
                $month2 = date('M Y', strtotime($wd_date));
                if($month1 == $month2){
                    $wd_id = $wd->id;
                    $flag = 1;
                    break;
                }
            }

            if($flag == 0){
                return redirect()->back()->with('danger', 'Working Days not found!');
            }

            if($time <= '07:00:00'){
                $absen->attendance_status = "Present";
            }else{
                $absen->attendance_status = "Late";
            }
            $absen->save();
            // Attendance ID
            $att_id = attendance::selectRaw('MAX(id) as id')->first()->id;
            $user_has_performance = new userHasPeformance();
            $user_has_performance->attendance_id = $att_id;
            $user_has_performance->workingDays_id = $wd->id;
            $user_has_performance->save();
            return redirect()->back();
        }
        elseif(isset($request->btnOut)){
            // dd($user);
            attendance::where('date', $date)->where('users_id', $user)
                ->update([
                    'check_out' => $time,
                ]);
            return redirect()->back();
        }
        return $request->all();
    }
}
