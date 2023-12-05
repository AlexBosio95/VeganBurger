<template>
    <main>
        <Header />
        <Sponsor />
        <BurgerPreview />
        <Why />
        <div class="bg">
            <Sales :parts = 'parts' :orderBurger = 'orderBurger'/>
            <Banner />
            <Customer />
        </div>
        <OurMission />
        <Footer />
    </main>
</template>

<script>
import Header from '../components/Header.vue';
import BurgerPreview from '../components/BurgerPreview.vue' 
import Sales from '../components/sales.vue'
import Sponsor from '../components/Sponsor.vue'
import Why from '../components/Why.vue'
import Banner from '../components/Banner.vue';
import Customer from '../components/Customer.vue';
import OurMission from '../components/OurMission.vue';
import Footer from '../components/Footer.vue';
export default {
    components: { Header, Sponsor, BurgerPreview, Why, Sales, Banner, Customer, OurMission, Footer },
    props:{
        parts: Array,
        orderBurger: Array
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';
.bg{
    background-color: $body-bg;
    width: 100%;
}

main{
    background-color: $gray-bg;
}

</style>