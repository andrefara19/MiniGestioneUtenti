import './bootstrap';

import { createApp } from "vue";
import Register from "./components/Register.vue"
import Login from "./components/Login.vue"
import Profile from "./components/Profile.vue"

const app = createApp({
    components:{
        Register,
        Login,
        Profile,
    }
});
app.mount('#app');

