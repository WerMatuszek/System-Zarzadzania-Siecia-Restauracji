<p>Witaj recepcjonistko!</p>
<p>Pacujesz w resturacji:</p>

@foreach(auth()->user()->restauracjas as $restaurant)
    <li>{{$restaurant->name}}</li>
@endforeach


