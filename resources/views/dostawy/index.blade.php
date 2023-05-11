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
                            <li><a href="{{ route('dostawy.stan') }}">Stan zaopatrzenia</a></li>
                            @if(auth()->user()->roles->contains('role_name','magazynier'))
                                <li><a href="{{ route('dostawy.dodaj') }}">Dodaj zaopatrzenie</a></li>
                                <li><a href="{{ route('dostawy.usun') }}">Usuń zaopatrzenie</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
