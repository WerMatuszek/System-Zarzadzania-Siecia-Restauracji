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
    public function wybierzDodaj(Request $request)
    {
        $restauracje = DB::table('restauracjas')->get()->sortBy('name');
        $wybrana_restauracja = $request->wybrana_restauracja;
        $rest_id = Restauracja::where('name', $request->wybrana_restauracja)->value('id');
        $dostawy = DB::table('dostawies')
            ->join('restauracja_dostawa', 'dostawies.id', '=', 'restauracja_dostawa.produkt_id')
            ->where('restauracja_id', '=', $rest_id)
            ->get()
            ->sortBy('name');
        $dostawy_new = DB::table('dostawies')
            ->whereNotIn('name', $dostawy->pluck('name'))
            ->get()
            ->sortBy('name');
        return view('dostawy.dodaj')->with('restauracje', $restauracje)->with('dostawy', $dostawy)->with('dostawy_new', $dostawy_new)->with('wybrana_restauracja', $wybrana_restauracja);
    }
    public function dodaj()
    {
        $restauracje = DB::table('restauracjas')->get()->sortBy('name');
        return view('dostawy.dodaj')->with('restauracje', $restauracje)->with('dostawy', $dostawy ?? [])->with('wybrana_restauracja', $wybrana_restauracja ?? '');
    }
    public function dodajDoBazy(Request $request)
    {
        $rest_id = Restauracja::where('name', $request->rest_prod)->value('id');
        $dostawy = DB::table('restauracja_dostawa')
            ->where('restauracja_id', '=', $rest_id)
            ->get();
        $all_0 = true;
        foreach ($dostawy as $produkt) {
            $prod_id = $produkt->produkt_id;
            if ($request->get("produkt" . $prod_id) != 0) {
                $all_0 = false;
                DB::table('restauracja_dostawa')
                    ->where('restauracja_id', '=', $rest_id)
                    ->where('produkt_id', '=', $produkt->produkt_id)
                    ->update(array('ilość' => $produkt->ilość + $request->get("produkt" . $prod_id)));
            }
        }
        $dostawy_new = DB::table('dostawies')
            ->whereNotIn('id', $dostawy->pluck('produkt_id'))
            ->get();
        foreach ($dostawy_new as $produkt) {
            $prod_id = $produkt->id;
            if ($request->get("produkt" . $prod_id) != 0) {
                $all_0 = false;
                DB::table('restauracja_dostawa')
                    ->insert(['restauracja_id'=>$rest_id, 'produkt_id'=>$produkt->id, 'ilość'=>$request->get("produkt" . $prod_id)]);
            }
        }
        $restauracje = DB::table('restauracjas')->get()->sortBy('name');
        if($all_0)
            return back()->with('error', 'Nie dodano żadnych produktów!');
        return back()->with('status', 'Zaopatrzenie zostało pomyślnie dodane.');
    }
}
