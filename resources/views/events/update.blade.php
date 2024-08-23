@extends('layouts.app')

@section('title', 'Aggiorna evento')

@section('extra-css')

@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
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
                        <input class="form-control" type="text" id="titolo" name="titolo" value="{{ $event->titolo }}" placeholder="Titolo *">
                        <div class="text-danger">{{ $errors->first('titolo') }}</div>
                    </div>

                    <div class="mb-3">
                        <input class="form-control" type="text" id="comune" name="comune" value="{{ $event->comune }}" placeholder="Comune *">
                        <div class="text-danger">{{ $errors->first('comune') }}</div>
                    </div>

                    <div class="mb-3">
                        <input class="form-control" type="text" id="provincia" name="provincia" value="{{ $event->provincia }}" placeholder="Provincia">
                        <div class="text-danger">{{ $errors->first('provincia') }}</div>
                    </div>

                    <div class="mb-3">
                        <input class="form-control" type="text" id="indirizzo" name="indirizzo" value="{{ $event->indirizzo }}" placeholder="Indirizzo *">
                        <div class="text-danger">{{ $errors->first('indirizzo') }}</div>

                    <div class="mb-3">
                        <input class="form-control" type="date" id="data_inizio" name="data_inizio" value="{{ $event->data_inizio }}">
                        <div class="text-danger">{{ $errors->first('data_inizio') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="date" id="data_fine" name="data_fine" value="{{ $event->data_fine }}">
                        <div class="text-danger">{{ $errors->first('data_fine') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" id="posti" name="posti" value="{{ $event->posti}}" placeholder="Posti *">
                        <div class="text-danger">{{ $errors->first('posti') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" id="ospiti" name="ospiti" value="{{ $event->ospiti}}" placeholder="Ospiti *">
                        <div class="text-danger">{{ $errors->first('ospiti') }}</div>
                    </div>
                    <div class="mb-3 mt-4">
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            <input type="checkbox" class="btn-check" id="gratuito" name="gratuito" value="1" autocomplete="off"
                                {{ $event->gratuito ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="gratuito">Gratuito</label>
                        </div>
                    </div>
                    <button class="btn btn-success mt-3" style="margin-right: 10px;" type="submit">Aggiorna evento</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection