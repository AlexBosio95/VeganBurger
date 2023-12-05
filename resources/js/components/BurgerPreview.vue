<template>
    <div class="bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-6 p-5">
                    <img class="vegan" :src="'images/vegan.jpg'" alt="" srcset="">
                </div>
                <div class="col-6">
                    <div class="text-box">
                        <div>
                            <p class="fs-4 title-about">ABOUT US</p>
                            <h1 class="title">Welcome to VeganBurger, where burgers meet veganism</h1>
                            <p class="mt-4 fs-5">We believe everyone should have access to delicious burgers, regardless of their dietary preferences. That’s why we offer a wide range of vegan burgers that are not only tasty but also nutritious. Say goodbye to bland and hello to the best vegan burgers.</p>
                            <a class="read-me" href="">READ MORE</a>
                        </div>
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

<style lang="scss" scoped>

.bg-gray{
    margin: 4rem 8rem 4rem 8rem;
    height: 80vh;
    display: flex;
    align-items: center;

    .vegan{
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        object-position: center;
    }

    .text-box{
        width: 90%;
        height: 100%;
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        .title-about{
            color: #156F5B;
            font-weight: 450;
        }

        .title{
            font-size: 2.6rem;
            font-weight: 500;
        }

        .read-me{
            font-size: 1.1rem;
            font-weight: 450;
            text-decoration: none;
            color: black;

            &:hover{
                color: #156F5B;
            }

        }
    }
}


</style>