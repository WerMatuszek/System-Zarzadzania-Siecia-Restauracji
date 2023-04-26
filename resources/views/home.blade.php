@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (auth()->check() && auth()->user()->roles->contains('role_name', 'szef'))
                            {{ __('Witaj szefie!') }}
                        @elseif(auth()->check() && auth()->user()->roles->contains('role_name', 'kierownik'))
                            @include('welcome.kierownik')
                        @elseif(auth()->check() && auth()->user()->roles->contains('role_name', 'pracownik'))
                            @include('welcome.pracownik')
                        @elseif(auth()->check() && auth()->user()->roles->contains('role_name', 'recepcjonistka'))
                            @include('welcome.recepcjonistka')
                        @elseif(auth()->check() && auth()->user()->roles->contains('role_name','magazynier'))
                            {{ __('Witaj magazynierze')  }}
                        @elseif(auth()->check() && auth()->user()->roles->contains('role_name','ksiegowa'))
                            {{ __('Witaj ksiegowo') }}

                        @else
                            {{ __('Niezidentyfikowana rola!') }}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
