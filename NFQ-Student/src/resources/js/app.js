require('./bootstrap');

import { createApp } from 'vue';
import router from './router';
import App from './App.vue';
import ErrorIndex from './views/components/error/AlertView';
import ConfirmationIndex from './views/components/confirmation/ConfirmationView';

const app = createApp(App);

app.use(router);

app.component('ErrorIndex', ErrorIndex);
app.component('ConfirmationIndex', ConfirmationIndex);

app.mount('#app');
