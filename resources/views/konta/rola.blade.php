@extends('layouts.app')
@section('content')
    <div class="container" style="float:left">
        <div class="row justify-content-center" >
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
                                <th width="20%"></th>
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
                                            @php($role_temp = $role->role_name)
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>




                            <script>
                                function role_function() {
                                    var selectElement = document.getElementById('roles_id');
                                    var selectedOption= selectElement.options[selectElement.selectedIndex];
                                    var userId = selectedOption.getAttribute('data-userId');
                                    //var roleId=selectedOption.value;
                                    var roleId = selectedOption.getAttribute('data-roleId');
                                    if(confirm("czy jesteś pewien, że chcesz zmienić rolę tego pracownika?")) {
                                        window.location.href = '/konta/zmienRole/' + userId + '/' + roleId;
                                    }
                                }
                                function role_function_2() {
                                    var selectElement = document.getElementById('roles_id2');
                                    var selectedOption= selectElement.options[selectElement.selectedIndex];
                                    var userId = selectedOption.getAttribute('data-userId');
                                    //var roleId=selectedOption.value;
                                    var roleId = selectedOption.getAttribute('data-roleId');
                                    if(confirm("czy jesteś pewien, że chcesz zmienić rolę tego pracownika?")) {
                                        window.location.href = '/konta/zmienRole/' + userId + '/' + roleId;
                                    }
                                }

                                function role_function_3() {
                                    var selectElement = document.getElementById('roles_id3');
                                    var selectedOption= selectElement.options[selectElement.selectedIndex];
                                    var userId = selectedOption.getAttribute('data-userId');
                                    //var roleId=selectedOption.value;
                                    var roleId = selectedOption.getAttribute('data-roleId');
                                    if(confirm("czy jesteś pewien, że chcesz zmienić rolę tego pracownika?")) {
                                        window.location.href = '/konta/zmienRole/' + userId + '/' + roleId;
                                    }
                                }

                                function role_function_4() {
                                    var selectElement = document.getElementById('roles_id4');
                                    var selectedOption= selectElement.options[selectElement.selectedIndex];
                                    var userId = selectedOption.getAttribute('data-userId');
                                    //var roleId=selectedOption.value;
                                    var roleId = selectedOption.getAttribute('data-roleId');

                                    if(confirm("czy jesteś pewien, że chcesz zmienić rolę tego pracownika?")){
                                        window.location.href = '/konta/zmienRole/'+ userId + '/' + roleId;
                                    }
                                }

                                function role_function_5() {
                                    var selectElement = document.getElementById('roles_id5');
                                    var selectedOption= selectElement.options[selectElement.selectedIndex];
                                    var userId = selectedOption.getAttribute('data-userId');
                                    //var roleId=selectedOption.value;
                                    var roleId = selectedOption.getAttribute('data-roleId');
                                    if(confirm("czy jesteś pewien, że chcesz zmienić rolę tego pracownika?")) {
                                        window.location.href = '/konta/zmienRole/' + userId + '/' + roleId;
                                    }
                                }

                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style=" position: fixed;bottom: 630px;right: 660px; ">
                <div class="card">

                    <div class="card-body">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <select id="roles_id" onchange="role_function()">
                                            @foreach($roles as $role=>$value)
                                                @if($value->role_name !== $role_temp)
                                                    <option value="{{$role}}" data-userId={{2}} data-roleId={{$value->id}}>
                                                        {{$value->role_name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr><tr>
                                    <td>
                                        <select id="roles_id2" onchange="role_function_2()">
                                            @foreach($roles as $role=>$value)
                                                @if($value->role_name !== $role_temp)
                                                    <option value="{{$role}}" data-userId={{3}} data-roleId={{$value->id}}>
                                                        {{$value->role_name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr><tr>
                                    <td>
                                        <select id="roles_id3" onchange="role_function_3()">
                                            @foreach($roles as $role=>$value)
                                                @if($value->role_name !== $role_temp)
                                                    <option value="{{$role}}" data-userId={{4}} data-roleId={{$value->id}}>
                                                        {{$value->role_name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr><tr>
                                    <td>
                                        <select id="roles_id4" onchange="role_function_4()">
                                            @foreach($roles as $role=>$value)
                                                @if($value->role_name !== $role_temp)
                                                    <option value="{{$role}}" data-userId={{5}} data-roleId={{$value->id}}>
                                                        {{$value->role_name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    </tr><tr>
                                    <td>
                                        <select id="roles_id5" onchange="role_function_5()">
                                            @foreach($roles as $role=>$value)
                                                @if($value->role_name !== $role_temp)
                                                    <option value="{{$role}}" data-userId={{6}} data-roleId={{$value->id}}>
                                                        {{$value->role_name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection

