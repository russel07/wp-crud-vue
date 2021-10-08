import { createWebHashHistory, createRouter } from "vue-router";

import Product from '../components/Product.vue'
import AddProduct from '../components/AddProduct.vue'
import EditProduct from '../components/EditProduct.vue'

const routes = [
    { path: '/', name:'Product', component: Product },
    { path: '/add-product', name:'AddProduct', component: AddProduct },
    { path: '/edit-product/:productId', name:'EditProduct', component: EditProduct }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;