<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\incidents;
use Illuminate\Http\Request;

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
        $encours = incidents::where('statut',1)->get();
        $enattente = incidents::where('statut',0)->get();
        $termine = incidents::where('statut',2)->get();
        $taches = incidents::all();
        $clients = Client::all();
        return view('home',compact('taches','encours','termine','enattente','clients'));
    }
}
