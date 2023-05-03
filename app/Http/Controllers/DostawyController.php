<?php

namespace App\Http\Controllers;

use App\Models\Dostawy;
use App\Models\Restauracja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DostawyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role_mag');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dostawy.index');
    }
    public function stan()
    {
        $restauracje = DB::table('restauracjas')->get()->sortBy('name');
        return view('dostawy.stan')->with('restauracje', $restauracje)->with('dostawy', $dostawy ?? [])->with('wybrana_restauracja', $wybrana_restauracja ?? '');
    }
    public function wybierz(Request $request)
    {
        $restauracje = DB::table('restauracjas')->get()->sortBy('name');
        $wybrana_restauracja = $request->wybrana_restauracja;
        $rest_id = Restauracja::where('name', $request->wybrana_restauracja)->value('id');
        $dostawy = DB::table('dostawies')
            ->join('restauracja_dostawa', 'dostawies.id', '=', 'restauracja_dostawa.produkt_id')
            ->where('restauracja_id', '=', $rest_id)
            ->get()
            ->sortBy('name');
        return view('dostawy.stan')->with('restauracje', $restauracje)->with('dostawy', $dostawy)->with('wybrana_restauracja', $wybrana_restauracja);
    }
    public function dodaj()
    {
        return view('dostawy.dodaj');
    }
}
