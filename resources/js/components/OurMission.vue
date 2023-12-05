<template>
    <div class="bg-our-mission" id="ourMission">
        <div class="box">
            <h1 class="title">Our Mission</h1>
            <p class="text">At VeganBurger, our mission is to provide a unique and satisfying plant-based burger experience that is not only delicious but also nutritious. We believe that plant-based proteins are the future of food, and we’re proud to be at the forefront of this movement. Join us in our mission towards a healthier and more sustainable future.</p>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';

.bg-our-mission{
    background-image: url('/images/our-mission-1.jpg');
    height: 80vh;
    width: 100%;
    position: relative;
    object-fit: cover;
    background-size: 100%;
    object-position: center;

    &::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
    }

    .box{
        z-index: 1;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background: transparent;
        color: white;
        text-align: center;
        width: 60%;

        .title{
            font-size: 4rem;
        }

        .text{
            text-align: center;
            font-size: 1.3rem;
        }
    }
}

</style>