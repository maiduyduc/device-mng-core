<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home(){
//        return view('dashboard.homepage');
        return view('apps.dashboard.index');
    }

    public function duc(){
        dd("hi");
    }
}
