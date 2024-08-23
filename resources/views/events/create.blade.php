@extends('layouts.app')

@section('title', 'Crea evento')

@section('extra-css')

@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
<script>
    setTimeout(function() {
        window.location.href = "{{ route('event.index') }}";
    }, 1500);
</script>
@endif
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
                        <div class="text-danger">{{ $errors->first('titolo') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="comune" placeholder="Comune *">
                        <div class="text-danger">{{ $errors->first('comune') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="provincia" placeholder="Provincia">
                        <div class="text-danger">{{ $errors->first('provincia') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="indirizzo" placeholder="Indirizzo *">
                        <div class="text-danger">{{ $errors->first('indirizzo') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="date" id="data_inizio" name="data_inizio">
                        <div class="text-danger">{{ $errors->first('data_inizio') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="date" id="data_fine" name="data_fine">
                        <div class="text-danger">{{ $errors->first('data_fine') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="posti" placeholder="Posti *">
                        <div class="text-danger">{{ $errors->first('posti') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="ospiti" placeholder="Ospiti *">
                        <div class="text-danger">{{ $errors->first('ospiti') }}</div>
                    </div>
                    <div class="mb-3 mt-4">
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            <input type="checkbox" class="btn-check" id="gratuito" name="gratuito" value="1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="gratuito">Gratuito</label>
                        </div>
                    </div>
                    <button class="btn btn-success mt-3" style="margin-right: 10px;" type="submit">Crea evento</button>
                    <button class="btn btn-secondary mt-3" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection