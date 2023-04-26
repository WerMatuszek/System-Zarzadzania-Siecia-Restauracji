@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edytuj pracownika') }}</div>

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
                                <th width="20%"></th>
                            </tr>
                            </thead>
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
                                    <td><a class="btn btn-default" href="{{route('konta.edytujPracownika', ['id' => $user->id])}}"><i class="fa fa-user"></i></a></td>
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

