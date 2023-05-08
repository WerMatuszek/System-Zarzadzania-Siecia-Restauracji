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
                                <td width="30%">{{ __('Dodaj stan zaopatrzenia dla')}}</td>
                                <td width=40%">
                                    <form method="POST"
                                          action="{{ route('dostawy.wybierzDodaj') }}">
                                        @csrf
                                        <div style="display: flex; justify-content: space-between;">
                                            <select class="form-control"
                                                    style="flex: 1; margin-right: 10px; width: 120px" id="wybrana_restauracja"
                                                    name="wybrana_restauracja">
                                                <option value="">Wybierz restaurację</option>
                                                @foreach($restauracje as $restauracja)
                                                    <option value={{$restauracja->name}} {{ $wybrana_restauracja == $restauracja->name ? 'selected' : '' }}>
                                                        {{$restauracja->name}}</option>
                                                @endforeach
                                            </select>

                                            <button type="submit" class="btn btn-primary" style="flex: 0 0 auto;">
                                                <i class="fa-solid fa-repeat"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <form method="POST" action="{{ route('dostawy.dodajDoBazy') }}">
                        @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            <table>
                                <thead>
                                <tr>
                                    <th width="40%">Nazwa produktu</th>
                                    <th width="40%">Ilość (kg)</th>
                                    <th width="10%"></th>
                                    <th width="10%">Dodaj</th>
                                    <th width="10%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($dostawy))
                                    @foreach($dostawy as $produkt)
                                        <tr>
                                            <td>{{ $produkt->name }}</td>
                                            <td>{{ $produkt->ilość }}</td>
                                            <td></td>
                                            <td><input type="number" value={{ old("produkt".$produkt->produkt_id) ?? "0" }} min="0" id={{ "produkt".$produkt->produkt_id }} name={{ "produkt".$produkt->produkt_id }}
                                                        class="form-control" style="flex: 1; margin-right: 10px; width: 120px"></td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if(isset($dostawy_new) && $wybrana_restauracja)
                                    @foreach($dostawy_new as $produkt)
                                        <tr>
                                            <td>{{ $produkt->name }}</td>
                                            <td>0</td>
                                            <td></td>
                                            <td><input type="number" value={{ old("produkt".$produkt->id) ?? "0" }} min="0" id={{ "produkt".$produkt->id }} name={{ "produkt".$produkt->id }}
                                                        class="form-control" style="flex: 1; margin-right: 10px; width: 120px"></td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if($wybrana_restauracja)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><input id="rest_prod" hidden="hidden" name="rest_prod" value={{$wybrana_restauracja}}></td>
                                        <td>
                                            <div class="row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary"
                                                            onclick="return confirm('Czy jesteś pewny, że chcesz dodać te produkty?')">
                                                        {{ __('Dodaj') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

