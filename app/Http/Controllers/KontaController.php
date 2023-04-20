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
        return view('konta.index');
    }

    public function dodaj()
    {
        return view('konta.dodaj');
    }

    public function dodajDoBazy()
    {
        return redirect('konta');
    }


    public function usun()
    {
        return view('konta.usun');
    }
}
