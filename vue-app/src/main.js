import { createApp } from 'vue'
import Toaster from '@meforma/vue-toaster';

import App from './App.vue'
import router from './router/router.js';

const app = createApp(App);
app.use(router);
app.use(Toaster);

app.mount('#vue-app');