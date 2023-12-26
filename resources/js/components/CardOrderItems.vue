<template>
    <div class="order-list">
        <div class="card-order" v-for="order in orderBurger" :key="order.id">
            <div class="row align-items-center">
                <div class="col-3">
                    <img class="image" :src="'storage/parts_img/' + order.image" :alt="order.name">
                </div>
                <div class="col-6 d-flex align-items-center justify-content-center">
                    <div>
                        <h3 class="name">{{order.name}}</h3>
                        <p class="m-0">{{order.description}}</p>
                    </div>
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center">
                    <div>
                        <p class="price mb-0">$ {{order.price}}</p>
                        <p class="qta">{{order.quantity_to_order}}</p>
                    </div>
                </div>
            </div>
            <button @click="removeToCart(order)" class="canc-btn"><i class="bi bi-x-square-fill"></i></button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        parts: Array, 
        orderBurger: Array
    },
    methods: {
        removeToCart(order){
            const partToRemove = order.id;

            this.$root.$emit("delete-to-cart-event", partToRemove);
        },
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';

.order-list{
    

    .card-order{
        position: relative;
        background-color: $gray-bg;
        padding: 1rem;
        border-radius: .5rem;
        margin-bottom: 1rem;
    }

    .image{
        width: 110px;
        height: 110px;
        object-fit: cover;
        object-position: center;
        border-radius: .3rem;
        margin-right: 1rem;
    }

    .name{
        font-size: 2rem;
    }
    
    .price{
        font-size: 1.2rem;
    }

    .qta{
        font-size: 1rem;
        background-color: $gray-border;
        border-radius: 2rem;
        text-align: center;
        margin: 0 .7rem;
        font-weight: 450;
    }

    .canc-btn{
        border: none;
        position: absolute;
        right: 8px;
        top: 5px;
        background-color: transparent;
        color: red;
        font-size: 1.4rem;
        transition: .3s ease-in-out;

        &:hover{
            transform: scale(1.25);
        }
    }
}

</style>