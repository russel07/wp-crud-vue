import { createWebHashHistory, createRouter } from "vue-router";

import Product from '../components/Product.vue'
import AddProduct from '../components/AddProduct.vue'

const routes = [
    { path: '/', name:'Product', component: Product },
    { path: '/add-product', name:'AddProduct', component: AddProduct }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;