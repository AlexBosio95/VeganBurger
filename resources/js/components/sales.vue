<template>
    <div class="container w-75 pt-5 pb-5">
        <div class="row p-2">
            <div class="col-6">
                <p class="fs-2 fw-4">Sales</p>
            </div>
            <div class="col-6 d-flex flex-row-reverse">
                <router-link class="link-all-burger" :to="{name: routeLink}">View all Burger</router-link>
            </div>
        </div>
        
        <div class="d-flex flex-wrap">
            <div class="my-card" v-for="part in parts.slice(0, 3)" :key="part.id">
                <BurgerCard 
                :part = 'part' 
                :orderBurger = 'orderBurger' />
            </div>
        </div>
    </div>
</template>

<script>
import BurgerCard from '../components/BurgerCard.vue'
export default {
    components: { BurgerCard },
    props: {
        parts: Array,
        orderBurger: Array
    },
    data(){
        return{
            routeLink: 'allburger'
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';
.bg{
    background-color: $body-bg;
    width: 100%;
    padding-top: 2rem;
}

.link-all-burger{
    text-transform: uppercase;
    font-size: 1.3rem;
    font-weight: 400;
    color: black;
    text-decoration: none;

    &::after{
        width: 100%;
        height: 2px;
        background-color: black;
    }
}

    .my-card{
        text-align: center;
        width: calc((100% / 3) - 20px);
        margin: 10px;
    }


</style>