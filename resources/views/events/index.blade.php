@extends('layouts.app')

@section('title', 'Lista eventi')

@section('extra-css')

@endsection

@section('content')
<h2 style="text-align: center; margin-bottom: 30px">Elenco degli eventi:</h2>
<a href="{{ route('event.create') }}">Crea nuovo evento</a>
<table class="table table-striped mt-5">
    
    <tr>
        <th>Titolo</th>
        <th>Comune</th>
        <th>Provincia</th>
        <th>Indirizzo</th>
        <th>Data inizio</th>
        <th>Data fine</th>
        <th>Posti</th>
        <th>Ospiti</th>
        <th>Gratuito</th>
    </tr>
    @foreach($events as $event)
        <tr>
            <td>{{ $event->titolo }}</td>
            <td>{{ $event->comune }}</td>
            <td>{{ $event->provincia }}</td>
            <td>{{ $event->indirizzo }}</td>
            <td>{{ $event->data_inizio }}</td>
            <td>{{ $event->data_fine }}</td>
            <td>{{ $event->posti }}</td>
            <td>{{ $event->ospiti }}</td>
            <td>{{ $event->gratuito }}</td>
            <td><a href="{{ route('event.update', $event->id) }}">Modifica</a></td>

        </tr>

    @endforeach
</table>
@endsection