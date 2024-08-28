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
        <div id="vuesation" class="col-sm-12 col-md-4" style="margin-bottom: 30px;">
            <div class="card">
                <div class="card-header">
                    <h4>Iscriviti</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="storeSubscription()">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control" type="text" v-model="nome"placeholder="Nome *">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" v-model="cognome" placeholder="Cognome *">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" v-model="email" placeholder="Email *">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" v-model="cellulare" placeholder="Cellulare *">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" v-model="codice_fiscale"
                                placeholder="Codice fiscale *">
                        </div>
                        <div class="mb-3">
                            <select v-model="num_accompagnatori" class="form-select mb-3" id="accompagnatori">
                                <option value="" disabled selected hidden>Numero di accompagnatori *</option>
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                            </select>

                            <button class="btn btn-success mt-3" style="margin-right: 10px;"
                                type="submit">Partecipa</button>
                            <button class="btn btn-secondary mt-3" type="reset">Reset</button>
                            <div class="mb-3">
                            </div>

                            <div id="accompagnatore" v-for="accompagnatore in accompagnatori">
                                <h5 style="margin-bottom: 20px">Accompagnatore </h5>
                                <div class="mb-3">
                                    <input type="text" class="form-control" v-model="accompagnatore.nome_accompagnatore"
                                        placeholder="Nome">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control"
                                        v-model="accompagnatore.cognome_accompagnatore" placeholder="Cognome">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" v-model="accompagnatore.cf_accompagnatore"
                                        placeholder="Codice Fiscale *">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" v-model="accompagnatore.email_accompagnatore"
                                        placeholder="Email *">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#vuesation',
            data: function() {

                return {
                    nome: '{{ $nome }}',
                    cognome: '{{ $cognome }}',
                    email: '{{ $email }}',
                    cellulare: '{{ $cellulare }}',
                    codice_fiscale: '',
                    num_accompagnatori: 0,
                    accompagnatori: []
                }
            },
            watch: {
                'num_accompagnatori': function(newVal) {
                    if (newVal >= 0) {
                        
                        this.accompagnatori = [];

                        
                        for (let i = 0; i < newVal; i++) {
                            this.accompagnatori.push({
                                nome_accompagnatore: '',
                                cognome_accompagnatore: '',
                                cf_accompagnatore: '',
                                email_accompagnatore: '',
                            });
                        }
                    }
                }
            },
            methods: {
                async storeSubscription() {
                    const response = await axios.post("{!! route('subscriptions.store') !!}", {
                        id_event: "{!! $event->id !!}",
                        nome: this.nome,
                        cognome: this.cognome,
                        email: this.email,
                        cellulare: this.cellulare,
                        codice_fiscale: this.codice_fiscale,
                        num_accompagnatori: this.num_accompagnatori,
                        accompagnatori: this.accompagnatori
                    });

                    if (response.data.success) {

                    }
                }
            }
        });
    </script>
@endsection
