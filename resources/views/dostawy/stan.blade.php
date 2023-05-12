@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <table>
                            <tbody>
                                <tr>
                                    <td width="30%">{{ __('Przeglądnij stan zaopatrzenia dla')}}</td>
                                    <td width=40%">
                                        <form method="POST"
                                              action="{{ route('dostawy.wybierz') }}">
                                            @csrf
                                            <div style="display: flex; justify-content: space-between;">
                                                <select class="form-control"
                                                        style="flex: 1; margin-right: 10px; width: 120px" id="wybrana_restauracja"
                                                        name="wybrana_restauracja"
                                                        {{Auth::user()->roles->contains('role_name', 'kierownik') || Auth::user()->roles->contains('role_name', 'pracownik') ? 'disabled' : ''}}>
                                                    <option value="Wybierz restaurację">Wybierz restaurację</option>
                                                    @foreach($restauracje as $restauracja)
                                                        <option value={{$restauracja->name}} {{ $wybrana_restauracja == $restauracja->name ? 'selected' : '' }}>
                                                        {{$restauracja->name}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary" style="flex: 0 0 auto;" {{Auth::user()->roles->contains('role_name', 'kierownik') || Auth::user()->roles->contains('role_name', 'pracownik') ? 'hidden' : ''}} >
                                                    <i class="fa-solid fa-repeat"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table>
                            <thead>
                            <tr>
                                <th width="40%">Nazwa produktu</th>
                                <th width="40%">Ilość (kg)</th>
                                <th width="10%"></th>
                                <th width="10%"></th>
                                <th width="10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($dostawy))
                                    @foreach($dostawy as $produkt)
                                        <tr>
                                            <td>{{ $produkt->name }}</td>
                                            <td>{{ $produkt->ilość }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

