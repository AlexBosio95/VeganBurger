<template>
    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <router-link class="navbar-brand fw-bold fs-3" :to="{name: homeRouteLink}">VeganBurger</router-link>
                <ul class="navbar-nav">
                    <li v-for="(item, index) in menu" :key="index" class="nav-item active">
                        <router-link class="navbar-brand" :to="{name: item.routeLink}">{{item.title}}</router-link>
                    </li>
                </ul>
            </div>
            <div class="display-relative">
                <router-link class="navbar-brand fw-bold fs-3" :to="{name: cartRouteLink}"><i class="bi bi-cart-fill"></i></router-link>
                <div class="number-order">{{totalQuantity}}</div>
                <a class="navbar-brand fw-bold fs-3" href="#"><i class="bi bi-person-circle"></i></a>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Header',
    props: {
        orderBurger: Array
    },
    data() {
        return {
            menu:[
                {
                    title: 'Our Burger',
                    routeLink : 'allburger'
                }
            ],
            homeRouteLink: 'home',
            cartRouteLink: 'cart'
        }
    },
    computed: {
        totalQuantity() {
        // Calcola la somma di 'quantity_to_order' per ogni elemento in orderBurger
        return this.orderBurger.reduce((total, item) => total + item.quantity_to_order, 0);
        },
    }

}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';
nav{
    position: fixed;
    background-color: white;
}

.number-order{
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: $st-green;
    color: white;
    position: absolute;
    bottom: 13px;
    right: 65px;
    text-align: center;
    line-height: 20px;
}

</style>