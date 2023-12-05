<template>
    <header>
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-6 z-1 position-relative ps-5">
                    <h1 class="title">Burgers Beyond Meat</h1>
                    <p class="text">Browse our sleek and user-friendly website to purchase the tastiest gluten-free burger you’ve ever had. Our selection of high-quality ingredients and attention to detail will leave you satisfied and coming back for more.</p>
                    <div class="d-flex w-100 flex-wrap">
                        <HamButton :dataButton = 'buttonHam'/>
                        <HamButton :dataButton = 'buttonOur'/>
                    </div>
                </div>
                <div class="col-6">
                    
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import HamButton from '../components/HamButton.vue';

export default {
    components: { HamButton },
    data: function(){
        return{
            buttonHam: {
                title: 'Hamburger',
                url: ''
            },
            buttonOur: {
                title: 'Our Mission',
                url: 'ourMission'
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';
header{
    height: 100vh;
    background-image: url('/images/jumbo_burger.jpg');
    font-family: sans-serif;
    color: white;
    background-position: center;
    background-size: cover;
    position: relative;

    &::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
    }

    .title{
        font-size: 5rem;
        font-weight: bold;
        color: white;
        line-height: 5rem;
    }

    .text{
        font-size: 1rem;
        margin-left: .3rem;
        margin-top: 3rem;
    }
}
</style>