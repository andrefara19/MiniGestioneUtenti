<template>
    <div id="app">
        <div class="row">
            <div class="col-sm-12 col-md-4"> </div>
            <div class="col-sm-12 col-md-4" style="margin-bottom: 30px;">
                <div class="card">
                    <div class="card-header">
                        <h4>Registrati</h4>
                    </div>
                    <div class="card-body">
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <form @submit.prevent="register">
                            <div class="mb-3">
                                <input class="form-control" type="text" id="nome" v-model="nome" placeholder="Nome *" required>
                                <div v-if="errori.nome" class="text-danger">{{ errori.nome[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="cognome" v-model="cognome" placeholder="Cognome *" required>
                                <div v-if="errori.cognome" class="text-danger">{{ errori.cognome[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="indirizzo" v-model="indirizzo" placeholder="Indirizzo">
                                <div v-if="errori.indirizzo" class="text-danger">{{ errori.indirizzo[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="cap" v-model="cap" placeholder="CAP">
                                <div v-if="errori.cap" class="text-danger">{{ errori.cap[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="citta" v-model="citta" placeholder="Città">
                                <div v-if="errori.citta" class="text-danger">{{ errori.citta[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="text" id="provincia" v-model="provincia" placeholder="Provincia">
                                <div v-if="errori.provincia" class="text-danger">{{ errori.provincia[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" id="nazione" v-model="nazione_id" required>
                                    <option value="" disabled selected hidden>Seleziona una nazione *</option>
                                    <option v-for="country in countries" :value="country.id" :key="country.id">{{ country.name }}</option>
                                </select>
                                <div v-if="errori.nazione_id" class="text-danger">{{ errori.nazione_id[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="tel" id="cellulare" v-model="cellulare" placeholder="Cellulare *" required>
                                <div v-if="errori.cellulare" class="text-danger">{{ errori.cellulare[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="email" id="email" v-model="email" placeholder="Email *" required>
                                <div v-if="errori.email" class="text-danger">{{ errori.email[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" id="password" type="password" v-model="password" placeholder="Password *" minlength="8" required @input="validatePassword">
                                <div v-if="errori.password" class="text-danger">{{ errori.password[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" id="confirmPassword" type="password" v-model="confirmPassword" placeholder="Conferma password *" required @input="validatePassword">
                            </div>
                            <button class="btn btn-primary mt-3" style="margin-right: 10px;" type="submit">Registrati</button>
                            <button class="btn btn-secondary mt-3" type="reset">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const countries = ref([]);
const nome = ref('');
const cognome = ref('');
const indirizzo = ref('');
const cap = ref('');
const citta = ref('');
const provincia = ref('');
const nazione_id = ref('');
const cellulare = ref('');
const email = ref('');
const password = ref('');
const confirmPassword = ref('');
const errori = ref({});
const successMessage = ref('');

onMounted(async () => {
    try {
        const response = await axios.get('/api/countries');
        countries.value = response.data;
    } catch (error) {
        console.error("Errore nel caricamento delle nazioni:", error);
    }
});

const register = async () => {
    if (password.value !== confirmPassword.value) {
        errori.value = { password: ['Le password non corrispondono'] };
        return;
    }

    try {
        const response = await axios.post('/registrati', {
            nome: nome.value,
            cognome: cognome.value,
            indirizzo: indirizzo.value,
            cap: cap.value,
            citta: citta.value,
            provincia: provincia.value,
            nazione_id: nazione_id.value,
            cellulare: cellulare.value,
            email: email.value,
            password: password.value,
            password_confirmation: confirmPassword.value,
        });

        if (response.data.success) {
            successMessage.value = 'Registrazione avvenuta con successo!';
            errori.value = {};
            setTimeout(() => {
                window.location.href = '/login';
            }, 1500);
        } else {
            errori.value = response.data.errors || { general: ['Errore nella registrazione. Controlla i campi e riprova.'] };
        }
    } catch (error) {
        if (error.response && error.response.data.errors) {
            errori.value = error.response.data.errors;
        } else {
            errori.value = { general: ['Errore imprevisto. Riprova più tardi.'] };
        }
    }
};
</script>
