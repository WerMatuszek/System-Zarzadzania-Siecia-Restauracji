@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Możliwe akcje do wykonania') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <ul>
                            <li><a href="{{ route('konta.dodaj') }}">Dodaj pracownika</a></li>
                            <li><a href="{{ route('konta.usun') }}">Usuń pracownika</a></li>
                            <li><a href="{{ route('konta.edytuj') }}">Edytuj pracownika</a></li>
                            <li><a href="{{ route('konta.rola') }}">Zmień rolę pracownika</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
