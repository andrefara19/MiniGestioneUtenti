@extends('layouts.app')

@section('title', 'Crea evento')

@section('extra-css')

@endsection

@section('content')


<div class="row">
    <div class="col-sm-12 col-md-4"> </div>
    <div class="col-sm-12 col-md-4" style="margin-bottom: 30px;">
        <div class="card">
            <div class="card-header">
                <h4>Crea nuovo evento</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('event.store') }}">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="text" name="titolo" placeholder="Titolo *">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="comune" placeholder="Comune *">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="provincia" placeholder="Provincia">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="indirizzo" placeholder="Indirizzo *">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="date" id="data_inizio" name="data_inizio">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="date" id="data_fine" name="data_fine">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="posti" placeholder="Posti *">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="ospiti" placeholder="Ospiti *">
                    </div>
                    <div class="mb-3"> Gratuito
                        <input type="checkbox" name="gratuito">
                    </div>

                    <button class="btn btn-primary mt-3" style="margin-right: 10px;" type="submit">Crea evento</button>
                    <button class="btn btn-secondary mt-3" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection