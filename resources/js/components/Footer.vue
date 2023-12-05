<template>
    <div class="container p-5">
        <div class="row">
            <div class="col-4 align-items-center" :class="data.border ? 'bord' : ''" v-for="data in datas" :key="data.id">
                <h2 class="text"><i class="icon" :class="data.icon"></i> {{data.name}}</h2>
            </div>
        </div>
        <div class="f-link-container">
            <div class="f-link-box">
                <h3 class="title">VeganBurger</h3>
                <p class="desc">Follow us on social media to stay up to date with our latest news and promotions. Join our community of plant-based food lovers today!</p>
                <div class="d-flex pt-4">
                    <a href="" class="social"><i class="bi bi-instagram"></i></a>
                    <a href="" class="social"><i class="bi bi-pinterest"></i></a>
                    <a href="" class="social"><i class="bi bi-facebook"></i></a>
                    <a href="" class="social"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
            <div class="f-link-box">
                <h3 class="title">Shop</h3>
                <a href="#" class="link">Hamburger</a>
            </div>
            <div class="f-link-box">
                <h3 class="title">About</h3>
                <a href="#" class="link">Home</a>
                <a href="#" class="link">Contact</a>
            </div>
            <div class="f-link-box">
                <h3 class="title">Need Help ?</h3>
                <a href="#" class="link">Shop</a>
                <a href="#" class="link">My account</a>
                <a href="#" class="link">Cart</a>
                <a href="#" class="link">Checkout</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            datas: [
                {
                    name: 'Secure Payment',
                    icon: 'bi bi-credit-card-fill',
                    border: false
                },
                {
                    name: 'Express Shipping',
                    icon: 'bi bi-truck',
                    border: true
                },
                {
                    name: 'Free Return',
                    icon: 'bi-arrow-repeat',
                    border: true
                },
            ]
        }
    }

}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';

.text{
    font-size: 1.4rem;
    font-weight: 400;
    color: rgb(35, 35, 35);
    text-align: center;

    .icon{
        color: $st-green;
    }
}

.bord{
    border-left: 1px solid rgb(50, 50, 50);
}

.title{
    font-weight: 400;
    margin-bottom: 2rem;
    font-size: 1.7rem;
}

.desc{
    font-size: 1.2rem;
}

.link{
    text-decoration: none;
    display: block;
    color: black;
    font-size: 1.2rem;
}

.f-link-container{
    display: flex;
    justify-content: center;
    padding-top: 4rem;

    .f-link-box{
        width: calc((100% / 4) - 4rem);
        margin: 1.3rem;
    }
}

.social{
    color: black;
    width: 40px;
    height: 40px;
    font-size: 1.2rem;
}


</style>