import './bootstrap';

import { createApp } from "vue";
import Register from "./components/Register.vue"

const app = createApp({
    components:{
        Register,
    }
});

app.mount('#app');

