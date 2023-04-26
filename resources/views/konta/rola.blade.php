@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Zmień role pracownika') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table>
                            <thead>
                            <tr>
                                <th width="20%">Imię</th>
                                <th width="20%">Nazwisko</th>
                                <th width="40%">Email</th>
                                <th width="20%">Rola</th>
                                <th width="40%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            {{ $role->role_name }} <br>
                                        @endforeach
                                    </td>
                                    <td>

                                        <form method="POST"
                                              action="{{ route('konta.zmienRole', ['id' => $user->id]) }}">
                                            @csrf
                                            <div style="display: flex; justify-content: space-between;">
                                                <select class="form-control"
                                                        style="flex: 1; margin-right: 10px; width: 120px" id="new_role"
                                                        name="new_role">
                                                    <option value="Wybierz rolę" selected>Wybierz rolę</option>
                                                    @foreach($roles as $role)
                                                        @if(!$user->roles->contains('role_name', $role))
                                                            <option value={{$role}}>{{$role}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                <button type="submit" class="btn btn-primary" style="flex: 0 0 auto;"
                                                        onclick="return confirm('Czy jesteś pewny, że chcesz zmienić rolę pracownika?')">
                                                    <i class="fa-solid fa-repeat"></i>
                                                </button>
                                            </div>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

