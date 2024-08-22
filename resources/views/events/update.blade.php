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
                        <label for="titolo">Titolo:</label>
                        <input type="text" id="titolo" name="titolo" value="{{ $event->titolo }}">
                    </div>

                    <div class="mb-3">
                        <label for="comune">Comune:</label>
                        <input type="text" id="comune" name="comune" value="{{ $event->comune }}">
                    </div>

                    <div class="mb-3">
                        <label for="provincia">Provincia:</label>
                        <input type="text" id="provincia" name="provincia" value="{{ $event->provincia }}">
                    </div>

                    <div class="mb-3">
                        <label for="indirizzo">Indirizzo:</label>
                        <input type="text" id="indirizzo" name="indirizzo" value="{{ $event->indirizzo }}">
                    </div>

                    <div class="mb-3">
                        <label for="data_inizio">Data Inizio:</label>
                        <input type="date" id="data_inizio" name="data_inizio" value="{{ $event->data_inizio }}">
                    </div>
                    <div class="mb-3">
                        <label for="data_fine">Data Fine:</label>
                        <input type="date" id="data_fine" name="data_fine" value="{{ $event->data_fine }}">
                    </div>
                    <div class="mb-3">
                        <label for="posti">Posti:</label>
                        <input type="text" id="posti" name="posti" value="{{ $event->posti}}">
                    </div>
                    <div class="mb-3">
                        <label for="ospiti">Ospiti:</label>
                        <input type="text" id="ospiti" name="ospiti" value="{{ $event->ospiti}}">
                    </div>
                    <div class="mb-3">
                        <label for="gratuito">Gratuito:</label>
                        <input type="checkbox" id="gratuito" name="gratuito" value="{{ $event->gratuito}}">
                    </div>
                    <button class="btn btn-primary mt-3" style="margin-right: 10px;" type="submit">Aggiorna evento</button>
                    <button class="btn btn-secondary mt-3" type="reset">Elimina evento</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection