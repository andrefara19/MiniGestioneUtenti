<template>
    <div id="app">
        <h2 class="text-center mb-4">
            {{ isMyProfile ? 'Il tuo profilo, ' + initialNome : 'Profilo di ' + initialNome + ' ' + initialCognome
            }}
        </h2>

        <div v-if="successMessage" class="alert alert-success" role="alert">
            {{ successMessage }}
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-4"></div>
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="mb-3">
                                <input class="form-control" type="text" id="nome" v-model="formData.nome"
                                    placeholder="Nome" :disabled="!canEdit">
                                <div v-if="errori.nome" class="text-danger">{{ errori.nome[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="cognome" v-model="formData.cognome"
                                    placeholder="Cognome" :disabled="!canEdit">
                                <div v-if="errori.cognome" class="text-danger">{{ errori.cognome[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="indirizzo" v-model="formData.indirizzo"
                                    placeholder="Indirizzo" :disabled="!canEdit">
                                <div v-if="errori.indirizzo" class="text-danger">{{ errori.indirizzo[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="cap" v-model="formData.cap"
                                    placeholder="Cap" :disabled="!canEdit">
                                <div v-if="errori.cap" class="text-danger">{{ errori.cap[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="citta" v-model="formData.citta"
                                    placeholder="Città" :disabled="!canEdit">
                                <div v-if="errori.citta" class="text-danger">{{ errori.citta[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="provincia" v-model="formData.provincia"
                                    placeholder="Provincia" :disabled="!canEdit">
                                <div v-if="errori.provincia" class="text-danger">{{ errori.provincia[0] }}</div>
                            </div>
                            <select class="form-select mb-3" id="nazione" v-model="formData.nazione_id"
                                :disabled="!canEdit" required>
                                <option v-for="country in countries" :key="country.id" :value="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                            <div v-if="errori.nazione_id" class="text-danger">{{ errori.nazione_id[0] }}</div>
                            <div class="mb-3">
                                <input class="form-control" id="cellulare" v-model="formData.cellulare"
                                    placeholder="Cellulare" :disabled="!canEdit">
                                <div v-if="errori.cellulare" class="text-danger">{{ errori.cellulare[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" id="email" v-model="formData.email"
                                    placeholder="Email" :disabled="!canEdit">
                                <div v-if="errori.email" class="text-danger">{{ errori.email[0] }}</div>
                            </div>
                            <button v-if="isAdmin || isMyProfile" class="btn btn-success mb-3 mt-4"
                                type="submit">Modifica profilo</button>
                        </form>

                        <form v-if="isAdmin && !isMyProfile" @submit.prevent="deleteUser">
                            <button class="btn btn-danger" type="submit" @click="confirmDelete">Elimina utente</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4"></div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        user: Object,
        nome: String,
        cognome: String,
        indirizzo: String,
        cap: String,
        citta: String,
        provincia: String,
        nazione_id: Number,
        cellulare: String,
        email: String,
        isAdmin: Boolean,
        isMyProfile: Boolean,
        countries: Array
    },
    data() {
        return {
            initialNome: this.nome,
            initialCognome: this.cognome,
            formData: {
                nome: this.nome,
                cognome: this.cognome,
                indirizzo: this.indirizzo,
                cap: this.cap,
                citta: this.citta,
                provincia: this.provincia,
                nazione_id: this.nazione_id,
                cellulare: this.cellulare,
                email: this.email
            },
            errori: {},
            successMessage: '',
        };
    },
    mounted() {
        this.formData.nome = this.nome;
        this.formData.cognome = this.cognome;
    },
    computed: {
        canEdit() {
            return this.isAdmin || this.isMyProfile;
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.put(`/utente/${this.user.id}`, this.formData);

                this.successMessage = 'Profilo MODIFICATO con successo!';
                this.errori = {};
                setTimeout(() => {
                    window.location.href = '/area_personale';
                }, 1500);
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errori = error.response.data.errors;
                } else {
                    this.errori = { general: ['Errore imprevisto. Riprova più tardi.'] };
                }
            }
        },

        async deleteUser() {
            if (confirm('Sei sicuro di voler eliminare questo utente?')) {
                try {
                    await axios.delete(`/utente/${this.user.id}`);
                    this.successMessage = 'Profilo ELIMINATO con successo!';
                    setTimeout(() => {
                        window.location.href = '/area_personale';
                    }, 1500);
                } catch (error) {
                    this.errori = { general: ['Impossibile eliminare l\'utente.'] };
                }
            }
        }
    }
};
</script>
