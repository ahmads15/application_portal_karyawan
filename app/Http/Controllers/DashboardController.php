<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Post;
use App\User;
use App\Todo;
use App\Absen;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\attendance;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }


    /**
     * Display a listing of the resource.
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
        return view('dashboard.dashboard', compact('news', 'todo', 'users', 'birth_now', 'cek_absen','last_perf'));
    }

    public function addtodo(Request $request)
    {
        $todo = Todo::all();
        $newtodo = new Todo();
        $newtodo->todo = $request['todo'];
        $newtodo->user_id = Auth::user()->id;
        $newtodo->save();

        return redirect('dashboard')->with('info', 'Todo has been created.');
    }
    // delete todolist

    public function deletetodo()
    {
        
            //
            $news = DB::table('todo')->where('user_id', Auth::user()->id);
            $news->delete();
            // $news = Todo::find()->where('user_id', Auth::user()->id);
            // $news->delete();
            return redirect("dashboard")
                ->with(
                    'success',
                    'Todo has been deleted'
                );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating title and body field
        $rules = [
            'title' => 'required|max:100',
            'body' => 'required',
            'footer' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('dashboard/create')->withErrors($validator)->withInput();
        }
        $title = $request['title'];
        $body = $request['body'];   
        $footer = $request['footer'];
        $news = Post::create($request->only('title', 'body', 'footer'));
        return back()->with('success','News has been created. ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $news = Post::findOrFail($id); //Find post of id = $id
        return view('dashboard.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $news = Post::findOrFail($id);

        return view('dashboard.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required',
            'footer' => 'required',
        ]);

        $news = Post::findOrFail($id);
        $news->title = $request->input('title');
        $news->body = $request->input('body');
        $news->footer = $request->input('footer');
        $news->save();

        return redirect()->route(
            'dashboard.show',
            $news->id
        )->with(
            'flash_message',
            'Article, ' . $news->title . ' updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $news = Post::findOrFail($id);
        $news->delete();

        return redirect("dashboard")
            ->with(
                'success',
                'News has been deleted'
            );
    }

}
