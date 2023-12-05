<template>
    <div class="burger-card">
        <img :src="'storage/parts_img/' + part.image" :alt="part.name">
        <h5 class="name">{{ part.name }}</h5>
        <p class="price mb-2">$ {{ part.price }}</p>
        <div class="quantity-input">
            <button @click="decrement(part)">-</button>
            <input type="number" :id="'quantity_to_order' + part.id" v-model="part.quantity_to_order" />
            <button @click="increment(part)">+</button>
        </div>
        <button @click="addToCart(part)" class="link-card" href="">Add to card</button>
    </div>
</template>

<script>
export default {
    props: {
        part: Object,
        orderBurger: Array
    },
    methods: {
        increment(part) {
            part.quantity_to_order += 1;
        },
        decrement(part) {
            if (part.quantity_to_order > 1) {
                part.quantity_to_order -= 1;
            }
        },
        addToCart(part) {
            // Copia l'oggetto part in modo che le modifiche non influenzino direttamente la prop
            const partToAdd = { ...part, quantity: part.quantity_to_order };

            // Emetti un evento per aggiungere l'elemento all'array orderBurger
            this.$root.$emit("add-to-cart-event", partToAdd);

            // Resetta la quantità a 1
            part.quantity_to_order = 1;
        },
    }
}
</script>

<style lang="scss" scoped>
.burger-card{
    min-height: 250px;
    border: none;
    text-align: center;

    img{
        height: 350px;
        border: none;
        object-fit: cover;
        width: 100%;
        border-radius: .4rem;
    }

    .name{
        margin-top: 1rem;
        font-size: 1.3rem;
        font-weight: 450;
    }

    .price{
        font-size: 1.1rem;
        opacity: 90%;
    }

    .quantity-input {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-bottom: .8rem;

        button {
            cursor: pointer;
            background-color: #ffffff;
            border: .3px rgba(0, 0, 0, 0.5) solid;
            width: 35px;
            height: 30px;
            margin: 0;
            font-size: 1rem;
        }

        input {
            width: 50px;
            text-align: center;
            border-top: .3px rgba(0, 0, 0, 0.5) solid;
            border-bottom: .3px rgba(0, 0, 0, 0.5) solid;
            border-left: none;
            border-right: none;
            height: 30px;
            margin: 0;
            -moz-appearance: textfield; /* Firefox */
        }

        input::-webkit-inner-spin-button,
        input::-webkit-outer-spin-button {
            -webkit-appearance: none; /* WebKit */
            margin: 0; /* Non-rimuove lo spazio per la freccia WebKit */
        }
    }

    .link-card{
        color: black;
        font-weight: 500;
        font-size: .9rem;
        text-decoration: none;
        padding-bottom: 1rem;
    }
}

</style>