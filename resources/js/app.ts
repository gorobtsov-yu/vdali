import { createApp } from 'vue';
import App from './App.vue';
import router from './router/index.js';
import { createPinia } from 'pinia';
import api from './services/axios.js';
import { setupGuards } from './router/guards.js';

const app = createApp(App);
const pinia = createPinia();

setupGuards(router);

app.use(pinia);
app.use(router);

app.config.globalProperties.$api = api;

app.mount('#app');