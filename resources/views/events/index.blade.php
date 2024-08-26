@extends('layouts.app')

@section('title', 'Lista eventi')

@section('extra-css')

@endsection

@section('content')
<h2 style="text-align: center; margin-bottom: 30px">Elenco degli eventi:</h2>
<table class="table table-striped mt-5">
    <div style="display: flex; justify-content: center; align-items: center;">
    <a href="{{ route('event.create') }}" class="btn btn-info mt-3" style="background-color: silver; margin-right:10px;">Crea nuovo evento</a>
    <a href="{{ route('event.index.user', ['user_id' => Auth::id()]) }}" class="btn btn-light mt-3" style="background-color: #D6EAF8; margin-right:10px;">Mostra i tuoi eventi</a>
    <a href="{{ route('event.index', ['user_id' => Auth::id()]) }}" class="btn btn-light mt-3" style="background-color: #D5F5E3; margin-right:10px;">Mostra tutti gli eventi</a>
    </div>
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
        @if($event->gratuito)
            <td><i class="fa-solid fa-check"></i></td>
        @else
        <td></td>
        @endif
        <td>
            @if(Auth::id() == $event->user_id || $isadmin)
            <a href="{{ route('event.edit', $event->id) }}" title="Modifica evento">
                <i class="fa-solid fa-pen" style="color: black; padding-right: 20px"></i>
            </a>
            <form action="{{ route('event.delete', $event->id) }}" title= "Elimina evento" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo evento?')" style="background: none; border: none; padding: 0; color: black; box-shadow: none;">
                    <i class="fa-solid fa-trash" style="color: black; padding-right: 20px"></i>
                </button>
            </form>
            @endif
            <a href="{{ route('subscriptions.create', Auth::user()->id) }}" title="Partecipa all'evento">
                <i class="fa-solid fa-ticket" style="color: black; padding-right: 20px"></i>
            </a>
        </td>

    </tr>
    @endforeach
</table>

@endsection