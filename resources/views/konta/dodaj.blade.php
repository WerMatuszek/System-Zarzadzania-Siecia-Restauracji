@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dodaj pracownika') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('konta.dodajDoBazy') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Imię') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Nazwisko') }}</label>
                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Hasło') }}</label>
                                <div class="col-md-6 d-flex align-items-center">
                                    <input id="password" type="password" class="form-control flex-grow-1"
                                           name="password" value="{{ Str::random(8) }}" required autocomplete="password"
                                           autofocus>
                                    <button id="passwordBtn" type="button" class="btn btn-secondary ml-3"
                                            onclick="togglePassword()">Pokaż
                                    </button>
                                </div>
                            </div>

                            <script>
                                function togglePassword() {
                                    var passwordField = document.getElementById("password");
                                    var passwordBtn = document.getElementById("passwordBtn");
                                    if (passwordField.type === "password") {
                                        passwordField.type = "text";
                                        passwordBtn.innerHTML = "Ukryj";
                                    } else {
                                        passwordField.type = "password";
                                        passwordBtn.innerHTML = "Pokaż";
                                    }
                                }
                            </script>

                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Rola') }}</label>
                                <div class="col-md-6">
                                    <select id="role" name="role" class="form-control" value="{{ old('role') }}">
                                        <option value="pracownik" {{ old('role') == 'pracownik' ? 'selected' : '' }}>
                                            Pracownik
                                        </option>
                                        @if(auth()->check())
                                            @if(auth()->user()->roles->contains('role_name', 'szef'))
                                                <option
                                                    value="kierownik" {{ old('role') == 'kierownik' ? 'selected' : '' }}>
                                                    Kierownik
                                                </option>
                                            @endif
                                        @endif
                                        <option
                                            value="recepcjonistka" {{ old('role') == 'recepcjonistka' ? 'selected' : '' }}>
                                            Recepcjonistka
                                        </option>
                                        <option value="magazynier" {{ old('role') == 'magazynier' ? 'selected' : '' }}>
                                            Magazynier
                                        </option>
                                        <option value="ksiegowa" {{ old('role') == 'ksiegowa' ? 'selected' : '' }}>
                                            Księgowa
                                        </option>
                                    </select>
                                </div>
                            </div>

                            @if(auth()->user()->roles->contains('role_name', 'kierownik'))
                                @php
                                    $rest_names_kierownik = auth()->user()->restauracjas->pluck('name')->toArray()
                                @endphp
                                <div class="row mb-3">
                                    <label for="restaurant"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Restauracja') }}</label>
                                    <div class="col-md-6">
                                        <select id="restaurant" name="restaurant" class="form-control"
                                                value="{{ old('restaurant') }}">
                                            @foreach($rest_names_kierownik as $restaurant)
                                                <option
                                                    value="{{$restaurant}}" {{ old('restaurant') == $restaurant ? 'selected' : '' }}>{{$restaurant}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="row mb-3">
                                    <label for="restaurant"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Restauracja') }}</label>
                                    <div class="col-md-6">
                                        <select id="restaurant" name="restaurant" class="form-control"
                                                value="{{ old('restaurant') }}">
                                            <option value="Żadna" {{ old('restaurant') == 'Żadna' ? 'selected' : '' }}>
                                                Żadna
                                            </option>
                                            @foreach($rest_names as $restaurant)
                                                <option
                                                    value="{{$restaurant}}" {{ old('restaurant') == $restaurant ? 'selected' : '' }}>{{$restaurant}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Dodaj') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
