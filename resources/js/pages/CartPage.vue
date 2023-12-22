<template>
<div class="bg">
    <div class="container">
        <div class="box">
        <h1 class="title mb-5">Cart</h1>
            <div class="row" v-if="!isPayment">
                <div class="col-8">
                    <div class="order-list" v-if="orderBurger.length > 0">
                        <div class="card-order" v-for="order in orderBurger" :key="order.id">
                            <div class="row">
                                <div class="col-3">
                                    <img class="image" :src="'storage/parts_img/' + order.image" :alt="order.name">
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-center">
                                    <div>
                                        <h3 class="name">{{order.name}}</h3>
                                        <p>{{order.description}}</p>
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center justify-content-center">
                                    <div>
                                        <p class="price">$ {{order.price}}</p>
                                        <p class="qta">{{order.quantity_to_order}}</p>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button @click="removeToCart(order)" class="canc-btn"><i class="bi bi-x-square-fill"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 pt-5" v-else>
                        <h2 class="text-center">No Item</h2>
                        <p class="text-center fs-4">Your cart is as light as air, but we know how to fill it with delicious vegan sandwiches. Start your flavor journey now!</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="box-pay">
                        <div class="box-container">
                            <div class="box">
                                <h4>Total Order</h4>
                                <ul class="list-group list-group-flush mt-3">
                                    <li class="list-group-item list-price" v-for="order in orderBurger" :key="order.id">{{calculateTotal(order.price, order.quantity_to_order)}} $</li>
                                    <li class="list-group-item active total-price">{{calculateAllTotal()}} $</li>
                                </ul>
                            </div>

                            <div class="box d-flex flex-column justify-content-end">
                                <div class="pay-btn" v-if="orderBurger.length > 0">
                                    <button @click="initializeBraintreeDropIn">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="payment" v-if="isPayment">
                <div v-show="showDropInContainer" ref="dropinContainer" class="pay-container" id="dropin-container"></div>

                <div v-if="paySucess" class="success-pay">
                    <i class="fs-3 bi bi-check-circle-fill"></i>
                    <h4 class="my-3">Payment completed successfully</h4>
                    <p class="fs-5 w-75 m-auto">Thank you for your order! We appreciate your support for our passion for vegan sandwiches. Enjoy your meal!</p>
                    <button class="submit mt-3"><router-link to="/">Close</router-link></button>
                    
                </div>

                <button v-show="showDropInContainer" class="submit" id="submit-button">Pay</button>

            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            isPayment: false,
            showDropInContainer: false,
            paySucess: false
        }
    },
    props: {
        parts: Array, 
        orderBurger: Array
    },
    methods:{
        calculateTotal(part, qta) {
            return (part * qta).toFixed(2);
        },
        calculateAllTotal(){
            return this.orderBurger.reduce((total, order) => {
                return total + order.price * order.quantity_to_order;
            }, 0).toFixed(2);
        },
        removeToCart(order){
            const partToRemove = order.id;

            this.$root.$emit("delete-to-cart-event", partToRemove);
        },
        async initializeBraintreeDropIn() {
            
            try {
                this.isPayment = true;
                this.showDropInContainer = true;
                this.paySucess = false;

                // Ottieni il client token dal tuo server Laravel
                const response = await axios.get('/api/braintree/client-token');
                const clientToken = response.data.clientToken;

                const vm = this;

                // Inizializza Braintree Drop-in
                const instance = await braintree.dropin.create({
                    authorization: clientToken,
                    container: '#dropin-container'
                });

                // Aggiungi la logica per gestire il pagamento
                document.getElementById('submit-button').addEventListener('click', function () {
                    instance.requestPaymentMethod(function (err, payload) {     
                    if (err) {
                        console.error(err);
                    } else {
                    // Invia il payload al tuo server Laravel per elaborare il pagamento
                    axios.post('/api/braintree/checkout', { paymentMethodNonce: payload.nonce })
                        .then(response => {
                        // Gestisci la risposta dal tuo server (ad esempio, mostra un messaggio di successo)

                            if (response.data.success) {
                                vm.$root.$emit("remove-all-to-cart-event");
                                vm.showDropInContainer = false;
                                vm.paySucess = true;
                            }

                        })
                        .catch(error => {
                        // Gestisci gli errori
                            console.error('Errore durante la richiesta di pagamento:', error);
                        });
                    }
                });
            });

            } catch (error) {
                console.error('Errore durante l\'inizializzazione di Braintree Drop-in:', error);
            }
        }
    }
}
</script>


<style lang="scss" scoped>
@import '../../sass/variables.scss';

.bg{
    background-color: #f3f4f6;
    width: 100%;
    padding-top: 110px;
    padding-bottom: 20px;
    height: 100vh;

    .box{
        background-color: white;
        width: 90%;
        min-height: 200px;
        margin: 0 auto;
        padding: 2rem;

        .payment{
            width: 70%;
            min-height: 400px;
            background-color: $gray-bg;
            padding: 2rem;
            border-radius: .5rem;
            margin: 2rem;
            margin: 0 auto;
            text-align: center;

            .pay-container{
                width: 50%;
                margin: 0 auto;
            }

            .submit{
                height: 50px;
                background-color: black;
                width: 50%;
                border-radius: .5rem;
                text-align: center;
                line-height: 50px;
                cursor: pointer;
                color: white;
                border: none;
                margin: 0 auto;

                
            }

            .success-pay{
                margin-top: 3rem;

                a{
                    color: white;
                    text-decoration: none;
                }
            }
        }

        .title{
            font-size: 3rem;
            font-weight: 500;
            text-align: center;
        }

        .order-list{
            .card-order{
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
                margin: 1rem;
            }

            .name{
                font-size: 2rem;
            }
            
            .price{
                font-size: 1.2rem;
            }

            .qta{
                font-size: 1.2rem;
                background-color: $gray-border;
                border-radius: 2rem;
                text-align: center;
                margin: 0 .7rem;
                font-weight: 450;
            }

            .canc-btn{
                border: none;
                background-color: transparent;
                color: red;
                font-size: 1.4rem;
                transition: .3s ease-in-out;

                &:hover{
                    transform: scale(1.25);
                }
            }
        }

    }

    .box-pay{
        background-color: $gray-bg;
        height: 100%;
        width: 100%;
        border-radius: .5rem;

        .box-container{
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .box{
            background-color: transparent;

            .pay-btn{
                height: 50px;
                background-color: black;
                width: 100%;
                border-radius: .5rem;
                text-align: center;
                line-height: 50px;
                cursor: pointer;

                button{
                    color: white;
                    text-decoration: none;
                    font-size: 1rem;
                    border: none;
                    background-color: transparent;
                }
            }
        }

        .list-price{
            background-color: transparent;
            font-size: 1.3rem;
            text-align: end;
        }

        .total-price{
            font-size: 1.3rem;
            text-align: end;
            margin-top: 2rem;
            border-radius: .5rem;
        }
    }
}


</style>