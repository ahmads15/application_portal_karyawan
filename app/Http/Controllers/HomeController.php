<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Todo;
use App\Dashboard;
use App\User;
use Auth;
use Alert;
use App\attendance;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $news = Post::orderby('id', 'desc')->paginate(5, ['*'], 'news');
        $todo = Todo::orderby('id', 'desc')->where('user_id', Auth::user()->id)->paginate(5, ['*'], 'todo');
        $birth_now =  User::whereRaw("DATE_FORMAT(birthofdate, '%m-%d') = DATE_FORMAT(now(),'%m-%d')")
            ->orWhereRaw("DATE_FORMAT(birthofdate,'%m-%d') = '02-29' and DATE_FORMAT(birthofdate, '%m') = '02' AND 
        LAST_DAY(NOW()) = DATE(NOW())")
            ->get();
            
        $user = Auth::user()->id;
        $date = date("Y-m-d", strtotime('now'));
        $cek_absen = attendance::where(['users_id' => $user, 'date' => $date])
            ->first();
        $query = "SELECT (COUNT(a.id)/wd.day_amount*10) as performance
        FROM attendance as a 
        JOIN user_has_peformance as uh ON uh.attendance_id = a.id
        JOIN workingdays as wd ON wd.id = uh.workingDays_id
        WHERE DATE_FORMAT(a.date, '%Y %m') = DATE_FORMAT(NOW()-INTERVAL 1 MONTH, '%Y %m') AND a.users_id = '".$user."'
        GROUP BY YEAR(a.date), MONTH(a.date) DESC";
            
        $last_perf = DB::select(DB::raw($query));

        Alert::success('Dont forget to attendance', 'Welcome ' . Auth::user()->name . ' !')->autoclose(2000);
        return view('dashboard.dashboard', compact('news', 'todo', 'users', 'birth_now', 'cek_absen','last_perf'));
    }
}
