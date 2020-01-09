<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PTKP;

class PtkpController extends Controller
{
    //
    
    public function managePtkp()
    {
       
        $ptkp = PTKP::all();
      
        return view('position.index',compact('ptpk'));
    }
}
