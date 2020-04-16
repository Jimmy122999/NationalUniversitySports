<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FixtureResult;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function homePage()
    {
        $results = FixtureResult::orderBy('created_at' , 'desc')->take(3)->get();
        return view('index' , compact('results' , $results));
    }
}
