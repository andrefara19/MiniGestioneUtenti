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
                <h4>Iscriviti</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('subscriptions.store', $event->id) }}">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nome" value= {{ $nome }} placeholder="Nome *">
                        <div class="text-danger">{{ $errors->first('nome') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="cognome" value= {{ $cognome }} placeholder="Cognome *">
                        <div class="text-danger">{{ $errors->first('cognome') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="email" value= {{ $email }} placeholder="Email *">
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="cellulare" value= {{ $cellulare }} placeholder="Cellulare *">
                        <div class="text-danger">{{ $errors->first('cellulare') }}</div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="codice_fiscale" placeholder="Codice fiscale *">
                        <div class="text-danger">{{ $errors->first('codice_fiscale') }}</div>
                    </div>
                    <div class="mb-3">
                        <select class="form-select mb-3" id="accompagnatori" onchange="campiAccompagnatori()">
                            <option value="" disabled selected hidden>Numero di accompagnatori *</option>
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                        <div id="accompagnatore1" style="display: none;">
                            <h5>Accompagnatore 1</h5>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nome_accompagnatore_1" placeholder="Nome">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="cognome_accompagnatore_1" placeholder="Cognome">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="cf_accompagnatore_1" placeholder="Codice Fiscale *">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email_accompagnatore_1" placeholder="Email *">
                            </div>
                        </div>
                        
                        <div id="accompagnatore2" style="display: none;">
                            <h5>Accompagnatore 2</h5>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nome_accompagnatore_2" placeholder="Nome">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="cognome_accompagnatore_2" placeholder="Cognome">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="cf_accompagnatore_2" placeholder="Codice Fiscale *">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email_accompagnatore_2" placeholder="Email *">
                            </div>
                        </div>
                        <button class="btn btn-success mt-3" style="margin-right: 10px;" type="submit">Crea evento</button>
                        <button class="btn btn-secondary mt-3" type="reset">Reset</button>
                        <div class="mb-3">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function campiAccompagnatori() {
            var selezione = document.getElementById('accompagnatori').value;
            document.getElementById('accompagnatore1').style.display = selezione >= 1 ? 'block' : 'none';
            document.getElementById('accompagnatore2').style.display = selezione == 2 ? 'block' : 'none';
        }
    </script>
@endsection


