import { createApp } from 'vue'
import { createWebHistory, createRouter } from "vue-router";

import App from './App.vue'
import HelloWorld from './components/HelloWorld.vue'

const routes = [
    { path: '/hello', name:'HelloWorld', component: HelloWorld }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(router).mount('#vue-app')
