<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function dodajDoBazy(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $password = Str::random(8);
        $user->password = bcrypt($password);
        $user->save();
        $user_id = $user->id;

        $role = Role::where('role_name', $request->input('role'))->first();

        $user->roles()->attach($role->id);

        return redirect('konta')->with('status', 'Konto pracownika zostało pomyślnie utworzone.');
        //return redirect('konta');
    }

    public function usun()
    {
        return view('konta.usun');
    }
}
