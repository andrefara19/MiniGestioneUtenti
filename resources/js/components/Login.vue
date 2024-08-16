<template>
    <div id="app">
        <div class="row">
            <div class="col-sm-12 col-md-4"> </div>
            <div class="col-sm-12 col-md-4" style="margin-bottom: 30px;">
                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <form @submit.prevent="login">
                        <div class="mb-3">
                            <input class="form-control" id="email" v-model="email" placeholder="Email">
                            <div v-if="errori.email" class="text-danger">{{ errori.email[0] }}</div>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" id="password" type="password" v-model="password"
                                placeholder="Password">
                            <div v-if="errori.password" class="text-danger">{{ errori.password[0] }}</div>
                        </div>
                        <button class="btn btn-primary mt-3" style="margin-right: 10px;"
                            type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const email = ref('');
const password = ref('');
const errori = ref({});
const successMessage = ref('');

const login = async () => {
    errori.value = {};

    try {
        const response = await axios.post('/login', {
            email: email.value,
            password: password.value,
        });

        if (response.data.success) {
            successMessage.value = 'Login avvenuto con successo!';
            setTimeout(() => {
                window.location.href = response.data.redirect;
            }, 1000);
        } else {
            errori.value = response.data.errors || { general: ['Errore nel login. Riprova.'] };
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