import { createApp } from 'vue'
import App from './App.vue'

import { createWebHistory, createRouter } from "vue-router";

import HelloWorld from './components/HelloWorld.vue'
import HelloAdmin from './components/HelloAdmin.vue'

const routes = [
    { path: '/hello', name:'HelloWorld', component: HelloWorld },
    { path: '/hello-admin', name:'HelloAdmin', component: HelloAdmin }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(router).mount('#app')
