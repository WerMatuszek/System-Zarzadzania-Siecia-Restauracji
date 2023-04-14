<p>Witaj kierowniku!</p>
<p>Zarządzasz poniższymi restauracjami:</p>

@foreach(auth()->user()->restauracjas as $restaurant)
    <li>{{$restaurant->name}}</li>
@endforeach


