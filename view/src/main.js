import { createApp } from 'vue'
import App from './App.vue'

import { createWebHistory, createRouter } from "vue-router";

import HelloWorld from './components/HelloWorld.vue'

const routes = [
    { path: '/', name:'HelloWorld', component: HelloWorld }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(router).mount('#app')
