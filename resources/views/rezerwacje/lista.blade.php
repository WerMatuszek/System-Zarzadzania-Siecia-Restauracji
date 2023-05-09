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
                                <td width="30%">{{ __('Aktualne rezerwacje:')}}</td>
                                <td width=40%">
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
                                <th width="12%">Imie:</th>
                                <th width="12%">Nazwisko:</th>
                                <th width="12%">Godzina rozpoczęcia:</th>
                                <th width="12%">Godzina zakończenia:</th>
                                <th width="12%">Numer Stolika:</th>
                                <th width="12%">Liczba Gości:</th>
                                <th width="12%">Data rezerwacji: </th>
                                <th width="12%">Restauracja: </th>

                            @if(isset($rezerwacjes))

                            @foreach($rezerwacjes as $rezerwacje)
                                <tr>
                                    <td width="2%">{{ $rezerwacje->name_res }} </td>

                                    <td width="2%">{{ $rezerwacje->name_res }}</td>


                                    <td width="2%">{{ $rezerwacje->hour_start }}</td>

                                    <td width="2%">{{ $rezerwacje->hour_end }}</td>

                                    <td width="2%">{{ $rezerwacje->table_nr }}</td>

                                    <td width="2%">{{ $rezerwacje->guest_nr }}</td>

                                    <td width="2%">{{ $rezerwacje->date_res }}</td>

                                    <td width="2%">{{ $rezerwacje->restauracja }}</td>
                                    <td width="10%"></td>
                                    <td width="10%"></td>
                                </tr>

                            @endforeach
                                @endif
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

