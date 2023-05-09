<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Restauracja;
use App\Models\Rezerwacje;
use Illuminate\Support\Facades\DB;


class RezerwacjeController extends Controller
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
        //$restauracjas = DB::table('restauracjas')->pluck('name')->toArray();
        return view('rezerwacje.index');
    }

    public function dodaj()
    {
        $restauracjas = DB::table('restauracjas')->pluck('name')->toArray();
        return view('rezerwacje.szefDodaj')->with('restauracjas', $restauracjas);
    }

    public function lista()
    {
        $rezerwacjes = DB::table('rezerwacjes')->get();

        return view('rezerwacje.lista')->with('rezerwacjes', $rezerwacjes);
    }

    public function store(Request $request)
    {
        $rezerwacje = new Rezerwacje;
        $rezerwacje->name_res = $request->input('name_res');
        $rezerwacje->last_name_res = $request->input('last_name_res');
        $rezerwacje->hour_start = $request->input('hour_start');
        $rezerwacje->hour_end = $request->input('hour_end');
        $rezerwacje->table_nr = $request->input('table_nr');
        $rezerwacje->guest_nr = $request->input('guest_nr');
        $rezerwacje->date_res = $request->input('date_res');
        $rezerwacje->restauracja = $request->input('restauracja');
        $rezerwacje->save();

        return redirect('/rezerwacje')->with('status', 'Rezerwacja dodana pomyślnie!');
    }
}
