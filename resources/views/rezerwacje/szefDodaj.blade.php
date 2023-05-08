@extends('layouts.app')

@section('content')
    <h1 class="text-center">Dodawanie Rezerwacji</h1>
    <div class="container d-flex justify-content-center">
        <div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="post" action="{{ route('rezerwacje.store') }}">
                @csrf
                <div class="form-group" >
                    <label for="name_res">Imię:</label>
                    <input type="text" class="form-control" id="name_res" name="name_res" required style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="last_name_res">Nazwisko:</label>
                    <input type="text" class="form-control" id="last_name_res" name="last_name_res" required style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="hour_start">Godzina Rozpoczęcia:</label>
                    <input type="number" class="form-control" id="hour_start" name="hour_start" required min="1" max="24" style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="hour_end">Godzina Zakończenia:</label>
                    <input type="number" class="form-control" id="hour_end" name="hour_end" required min="1" max="24" style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="table_nr">Numer Stolika:</label>
                    <input type="number" class="form-control" id="table_nr" name="table_nr" required min="1" max="20" style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="guest_nr">Liczba gości:</label>
                    <input type="number" class="form-control" id="guest_nr" name="guest_nr" required min="1" max="4" style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="date_res">Data Rezerwacji:</label>
                    <input type="date" class="form-control" id="date_res" name="date_res" required style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="restauracja">Restauracja:</label>
                    <select class="form-control" name="restauracja" required style="width: 200px;">
                        @foreach($restauracjas as $restauracja)
                            <option value="{{$restauracja}}">{{$restauracja}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
@endsection


