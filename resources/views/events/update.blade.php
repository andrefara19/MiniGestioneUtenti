@extends('layouts.app')

@section('title', 'Aggiorna evento')

@section('extra-css')

@endsection

@section('content')


<div class="row">
    <div class="col-sm-12 col-md-4"> </div>
    <div class="col-sm-12 col-md-4" style="margin-bottom: 30px;">
        <div class="card">
            <div class="card-header">
                <h4>Modifica evento</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('event.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <input class= "form-control" type="text" id="titolo" name="titolo" value="{{ $event->titolo }}" placeholder="Titolo *">
                    </div>

                    <div class="mb-3">
                        <input class= "form-control" type="text" id="comune" name="comune" value="{{ $event->comune }}" placeholder="Comune *">
                    </div>

                    <div class="mb-3">
                        <input class= "form-control" type="text" id="provincia" name="provincia" value="{{ $event->provincia }}" placeholder="Provincia *">
                    </div>

                    <div class="mb-3">
                        <input class= "form-control" type="text" id="indirizzo" name="indirizzo" value="{{ $event->indirizzo }}" placeholder="Indirizzo *">
                    </div>

                    <div class="mb-3">
                        <input class= "form-control" type="date" id="data_inizio" name="data_inizio" value="{{ $event->data_inizio }}">
                    </div>
                    <div class="mb-3">
                        <input class= "form-control" type="date" id="data_fine" name="data_fine" value="{{ $event->data_fine }}">
                    </div>
                    <div class="mb-3">
                        <input class= "form-control" type="text" id="posti" name="posti" value="{{ $event->posti}}" placeholder="Posti *">
                    </div>
                    <div class="mb-3">
                        <input class= "form-control" type="text" id="ospiti" name="ospiti" value="{{ $event->ospiti}}" placeholder="Ospiti *">
                    </div>
                    <div class="mb-3">
                        <label for="gratuito">Gratuito:</label>
                        <input type="checkbox" id="gratuito" name="gratuito" value="{{ $event->gratuito}}">
                    </div>
                    <button class="btn btn-primary mt-3" style="margin-right: 10px;" type="submit">Aggiorna evento</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection