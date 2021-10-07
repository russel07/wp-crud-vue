import { createWebHashHistory, createRouter } from "vue-router";

import HelloWorld from '../components/HelloWorld.vue'
import Product from '../components/Product.vue'

const routes = [
    { path: '/', name:'Product', component: Product },
    { path: '/hello', name:'HelloWorld', component: HelloWorld }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;