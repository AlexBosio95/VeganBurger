<template>
        <div class="container">
            <div class="box">
                <div class="row justify-content-center">
                    <div class="col-7">
                        <div class="text-box">
                            <p class="fs-5">At VeganBurger, we’re committed to sustainability. Our plant-based burgers are not only better for your health, but also better for the environment. We believe that small changes can make a big difference, and we’re proud to serve burgers that are both delicious and sustainable.</p>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="d-flex align-items-center justify-content-center">
                            <img class="cicle-img" :src="'images/vegan-slogan.jpg'" alt="vegan-slogan">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
@import '../../sass/variables.scss';

.box{
    background-color: $gray-bg;
    width: 100%;
    margin: 0 auto;
    padding: 3rem;
}

.text-box{
    display: flex;
    align-items: center;
    height: 100%;
    width: 80%;
    padding-left: 4rem;
}


.cicle-img{
    border-radius: 50%;
    width: 280px;
    height: 280px;
    object-fit: cover;
}

</style>