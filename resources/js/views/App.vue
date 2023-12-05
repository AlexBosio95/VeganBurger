<template>
    <div>
        <Navbar :orderBurger = 'orderBurger'/>
        <MainEcommerce :parts = 'parts' :orderBurger = 'orderBurger' />
    </div>
</template>

<script>

import MainEcommerce from '../components/MainEcommerce.vue';
import Navbar from '../components/Navbar.vue';

export default {
    name: 'App',
    components: {
        MainEcommerce, Navbar
    },
    data(){
        return{
            parts: [],
            orderBurger: []
        }
    },
    methods: {
        async fetchParts(){
            try{
                const response = await axios.get('/api/parts').then((response) => {
                    this.parts = response.data.data.map((part) => ({...part, quantity_to_order: 1,}));
                });
            } catch(error){
                console.log('non è possibile recuperare i dati', error)
            };
        },
        addToCartHandler(partToAdd) {
            this.orderBurger.push(partToAdd);
        },
    },
    created() {
        this.$root.$on("add-to-cart-event", this.addToCartHandler);
    },
    mounted(){
        this.fetchParts();
    }
}
</script>

<style>
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css");
@import url('https://fonts.cdnfonts.com/css/futura-pt');

body{
    font-family: 'Futura PT', sans-serif;
}

</style>