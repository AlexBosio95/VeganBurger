<template>
    <div class="container pt-5">
        <h1 class="title">Our Customers speak for us</h1>
        <div class="row box">
            <div class="col-4" v-for="post in dataPosts" :key="post.id">
                <div class="post-card">
                    <div>
                        <p class="text">{{post.text}}</p>
                        <span class="name">{{post.name}}</span>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="text-average">4.8 average rating from 1814 reviews</h5>
    </div>
</template>

<script>
export default {
    data(){
        return{
            dataPosts: [
                {
                    text: '"VeganBurger is my go-to for delicious and nutritious plant-based burgers. Their delivery service is fast and efficient, ensuring that I can enjoy a great meal from the comfort of my own home."',
                    name: 'JULIAN KEYS'
                },
                {
                    text: '"I was blown away by the delicious taste of VeganBurger\'s burgers. I love how they use plant-based proteins, making it a healthy and ethical alternative to traditional burgers."',
                    name: 'LUIS ADAM'
                },
                {
                    text: ' "I highly recommend VeganBurger to anyone looking for a delicious and satisfying plant-based burger experience. Their toppings and sauces are customizable, making it easy to create a burger that\'s perfect for your taste." ',
                    name: 'MINE ASHMON'
                },
            ]
        }
    }

}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';

.title{
    text-align: center;
    font-size: 3rem;
    font-weight: 450;
}

.box{
    margin: 0 auto;
    padding-top: 2rem;
    padding-bottom: 4rem;
    width: 90%;
    background-color: $body-bg;
}

.post-card{
    border: 1px solid rgba(206, 206, 206, 0.4) ;
    padding: 1rem;
    display: flex;
    height: 280px;
    overflow: hidden;

    .text{
        font-size: 1.35rem;
        width: 100%;
        font-style: italic;
        line-height: 1.6rem;
        font-weight: 400;
        opacity: 72%;
    }

    .name{
        text-transform: uppercase;
        color: $st-green;
        font-size: 1.2rem;
        font-weight: 400;
    }
}

.text-average{
    opacity: 90%;
    text-align: center;
    padding-bottom: 3rem;
    font-size: 1.2rem;
    margin: 0;
}

</style>