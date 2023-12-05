<template>
    <div class="container">
        <div class="text-center m-5">
            <h1>Why VeganBurger?</h1>
            <p class="fs-5 mt-4">Our burgers are made from only high-quality ingredients, and we are committed to using sustainable and eco-friendly practices in every aspect of our business. With every bite, you’re making a positive impact on your health and the environment.</p>
        </div>
        <strengthsComponent :datas = 'datas' class="m-5"/>
    </div>
</template>

<script>
import strengthsComponent from './strengthsComponent.vue'
export default {
    components: { strengthsComponent },
    data: function(){
        return{
            datas:[
                {
                    number: '01.',
                    title: '100% Vegan',
                    description: 'Our burgers are made entirely from plant-based ingredients, so you can enjoy the taste and texture of meat without any animal products.',
                    isHR: true
                },
                {
                    number: '02.',
                    title: 'Gluten-Free',
                    description: 'Our burgers are made without gluten, making them a great option for people with gluten sensitivities or celiac disease.',
                    isHR: true
                },
                {
                    number: '03.',
                    title: 'Eco-Friendly Packaging',
                    description: 'We use sustainable and recyclable packaging materials, reducing our impact on the environment and ensuring your food stays fresh.',
                    isHR: false
                },
                {
                    number: '04.',
                    title: 'Customizable',
                    description: 'Our burgers can be customized with a variety of toppings and sauces, ensuring you get the perfect burger every time.',
                    isHR: false
                }
            ]
        }
    }

}
</script>

<style>

</style>