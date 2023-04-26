<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $userExist = User::where('email', $request->input('email'))->first();

        if ($userExist) {
            return redirect('/konta/dodaj')->with('status', 'Konto o tym adresie email już istnieje.');
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $role = Role::where('role_name', $request->input('role'))->first();

        $user->roles()->attach($role->id);

        return redirect('/konta/dodaj')->with('status', 'Konto pracownika zostało pomyślnie utworzone.');
    }

    public function usun()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('role_name', 'szef');
        })->get();
        return view('konta.usun')->with('users', $users);
    }

    public function rola()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('role_name', 'szef');
        })->get();
        //$users->
        $roles = Role::whereDoesntHave('users', function ($query) {
            $query->where('role_name', 'szef');
        })->get();
        return view('konta.rola')->with('users', $users)->with('roles',$roles);
    }

    public function zmienRole(int $id, int $role_id)
    {
        $user = User::find($id);
        $user->roles()->sync($role_id);
        $user->save();
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('role_name', 'szef');
        })->get();
        $roles = Role::whereDoesntHave('users', function ($query) {
            $query->where('role_name', 'szef');
        })->get();
        return redirect('/konta/rola')->with('users', $users)->with('status', 'Rola pracownika została pomyślnie zmieniona.')->with('roles',$roles);
    }


    public function usunZBazy(int $id)
    {
        $user = User::find($id);
        $user->delete();

        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('role_name', 'szef');
        })->get();
        return redirect('/konta/usun')->with('users', $users)->with('status', 'Konto pracownika zostało pomyślnie usunięte.');
    }

    public function edytuj()
    {
        $users = User::get();
        return view('konta.edytuj2')->with('users', $users);
    }

    public function edytujPracownika()
    {
        $user = Auth::user();
        //$user = User::find($id);
        //$user->edit();
        //$users = User::get();
        return view('konta.edytuj',compact('user'));
        //return redirect('konta.edytuj')->with('users', $users)->with('status', 'Konto pracownika zostało pomyślnie edytowane.');
    }

}
