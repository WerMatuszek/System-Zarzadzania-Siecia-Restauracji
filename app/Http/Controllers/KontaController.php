<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontaController extends Controller
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
        return "usuwanie, zmiana loginu/hasła, zmiana uprawnień kont";
    }
}
