<?php

namespace App\Http\Controllers;

use App\Models\Restauracja;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * @return Renderable
     */
    public function index()
    {
        return view('konta.index');
    }

    public function getWorkers(){
        $user = Auth::user();

        if($user->roles->contains('role_name', 'szef')){
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->where('role_name', 'szef');
            })->get();
        }
        else{
            $user_rest = $user->restauracjas->pluck('name')->toArray();
            $users = User::whereHas('restauracjas', function ($query) use ($user_rest) {
                $query->whereIn('name', $user_rest);
            })->whereHas('roles', function ($query) {
                $query->where('role_name', '!=', 'kierownik');
            })->get();
        }

        return $users;
    }

    public function getRoles(){
        $user = Auth::user();

        if($user->roles->contains('role_name', 'szef')){
            $roles = DB::table('roles')
                ->whereNotIn('role_name', ['szef'])
                ->pluck('role_name')
                ->toArray();
        }
        else{
            $roles = DB::table('roles')
                ->whereIn('role_name', ['pracownik', 'recepcjonistka'])
                ->pluck('role_name')
                ->toArray();
        }

        return $roles;
    }

    public function dodaj()
    {
        $rest_names = DB::table('restauracjas')->pluck('name')->toArray();
        return view('konta.dodaj')->with('rest_names', $rest_names);
    }

    public function dodajDoBazy(Request $request)
    {
        $userExist = User::where('email', $request->input('email'))->first();

        if ($userExist) {
            return back()->withInput()->with('status', 'Konto o tym adresie email już istnieje.');
        }

        $role = Role::where('role_name', $request->input('role'))->first();
        $rest_name = $request->input('restaurant');

        if($rest_name != "Żadna" && $role->role_name == "magazynier"){
            return back()->withInput()->with('status', 'Nie można przypisać magazyniera do konkretnej restauracji.');
        }
        if($rest_name == "Żadna" && $role->role_name != "magazynier"){
            return back()->withInput()->with('status', 'Pracownika wybranej roli należy przypisać do konkretnej restauracji.');
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $user->roles()->attach($role->id);
        if($rest_name != "Żadna"){
            $restaurant = Restauracja::where('name', $rest_name)->first();
            $user->restauracjas()->attach($restaurant->id);
        }

        return redirect('/konta/dodaj')->with('status', 'Konto pracownika zostało pomyślnie utworzone.');
    }

    public function usun()
    {
        $users = $this->getWorkers();
        return view('konta.usun')->with('users', $users);
    }

    public function usunZBazy(int $id)
    {
        $user = User::find($id);
        $user->delete();

        $users = $this->getWorkers();
        return redirect('/konta/usun')->with('users', $users)->with('status', 'Konto pracownika zostało pomyślnie usunięte.');
    }

    public function rola()
    {
        $users = $this->getWorkers();
        $roles = $this->getRoles();

        return view('konta.rola')->with('users', $users)->with('roles',$roles);
    }

    public function zmienRole(Request $request, int $id)
    {
        $role = Role::where('role_name', $request->new_role)->value('id');

        $users = $this->getWorkers();
        $roles = $this->getRoles();

        if(!isset($role)){
            return back()->with('users', $users)->with('roles',$roles)->with('status', 'Wybierz rolę!');
        }

        $user = User::find($id);
        $user->roles()->sync($role);
        $user->save();

        return back()->with('users', $users)->with('roles',$roles)->with('status', 'Rola pracownika została pomyślnie zmieniona.');
    }

    public function edytuj()
    {
        $users = $this->getWorkers();
        return view('konta.edytuj2')->with('users', $users);
    }
    public function edytujPracownika(int $id)
    {
        $user = User::find($id);
        return view('konta.edytuj',compact('user'));
    }

    public function zmienDane(Request $request, int $id)
    {
        $userExist = User::where('email', $request->input('email'))->first();

        if ($userExist) {
            return back()->withInput()->with('status', 'Konto o tym adresie email już istnieje.');
        }

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if(!empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        $users = User::get();
        return back()->with('users', $users)->with('status', 'Konto pracownika zostało pomyślnie edytowane.');
    }
}
