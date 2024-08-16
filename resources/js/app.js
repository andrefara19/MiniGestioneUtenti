import './bootstrap';

import { createApp } from "vue";
import Register from "./components/Register.vue"
import Login from "./components/Login.vue"

const app = createApp({
    components:{
        Register,
        Login,
    }
});
app.mount('#app');

