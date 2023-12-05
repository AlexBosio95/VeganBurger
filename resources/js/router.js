import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from './pages/HomePage.vue';
import AllBurger from './pages/AllBurger.vue';
import CartPage from './pages/CartPage.vue';

const router = new VueRouter({
    mode : 'history',
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/allburger',
            name: 'allburger',
            component: AllBurger
        },
        {
            path: '/cart',
            name: 'cart',
            component: CartPage
        }
    ]
})

export default router;