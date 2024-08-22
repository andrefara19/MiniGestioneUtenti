@extends('layouts.app')

@section('title', 'Lista eventi')

@section('extra-css')

@endsection

@section('content')
<h2 style="text-align: center; margin-bottom: 30px">Elenco degli eventi:</h2>
<a href="{{ route('event.create') }}">Crea nuovo evento</a>
<table class="table table-striped mt-5">

    <tr>
        <th>Data inizio</th>
        <th>Data fine</th>
        <th>Comune</th>
        <th>Provincia</th>
        <th>Indirizzo</th>
        <th>Titolo</th>
        <th>Posti</th>
        <th>Ospiti</th>
        <th>Gratuito</th>
        <th>Azioni</th>
    </tr>
    @foreach($events as $event)
    <tr>
        <td>{{ $event->data_inizio }}</td>
        <td>{{ $event->data_fine }}</td>
        <td>{{ $event->comune }}</td>
        <td>{{ $event->provincia }}</td>
        <td>{{ $event->indirizzo }}</td>
        <td>{{ $event->titolo }}</td>
        <td>{{ $event->posti }}</td>
        <td>{{ $event->ospiti }}</td>
        <td>{{ $event->gratuito }}</td>
        <td>
            <a href="{{ route('event.edit', $event->id) }}">
                <i class="fa-solid fa-pen" style="color: black; padding-right: 20px"></i>
            </a>
            <form action="{{ route('event.delete', $event->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo evento?')" style="background: none; border: none; padding: 0; color: black; box-shadow: none;">
                    <i class="fa-solid fa-trash" style="color: black;"></i>
                </button>
            </form>
        </td>

    </tr>

    @endforeach
</table>
@endsection