<template>
<div class="bg">
    <div class="container">
        <div class="box">
        <h1 class="title mb-5">Cart</h1>
            <div class="row" v-if="!isPayment">
                <div class="col-8">
                    <CardOrderItems v-if="orderBurger.length > 0" :orderBurger = "orderBurger" />
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
                    <h5>Order ID: {{orderNumber}}</h5>
                    <p class="fs-5 w-75 m-auto">Thank you for your order! We appreciate your support for our passion for vegan sandwiches. Enjoy your meal!</p>
                    <button class="submit mt-3"><router-link to="/">Close</router-link></button>
                </div>

                <div v-if="payError" class="success-pay mt-5">
                    <i class="fs-2 bi bi-x-circle-fill"></i>
                    <h4 class="my-3">{{ErrorTitle}}</h4>
                    <p class="fs-5 w-75 m-auto">{{Errormessage}}</p>
                    <button class="submit mt-3"><router-link to="/">Close</router-link></button>
                </div>

                <button v-show="showDropInContainer" class="submit" id="submit-button">Pay</button>

            </div>
        </div>
    </div>
</div>
</template>

<script>
import CardOrderItems from '../components/CardOrderItems.vue';
export default {
    components: {CardOrderItems},
    data(){
        return{
            isPayment: false,
            showDropInContainer: false,
            paySucess: false,
            orderNumber: "",
            payError: false,
            Errormessage: "",
            ErrorTitle: ""
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
                    axios.post('/api/braintree/checkout', {
                            paymentMethodNonce: payload.nonce,
                            orderItems: vm.orderBurger 
                        })
                        .then(response => {

                            if (response.data.success) {
                                vm.$root.$emit("remove-all-to-cart-event");
                                vm.showDropInContainer = false;
                                vm.paySucess = true;
                                vm.orderNumber = response.data.order_number;
                            }

                        })
                        .catch(error => {
                            vm.payError = true;
                            vm.paySucess = false;
                            vm.showDropInContainer = false;
                            vm.Errormessage = "Error requesting payment, we ask you to try again",
                            vm.ErrorTitle = "Payment error"
                        });
                    }
                });
            });

            } catch (error) {
                this.showDropInContainer = false;
                this.Errormessage = "Error token missmatch, we ask you to try again";
                this.payError = true;
                this.ErrorTitle = "Token error"
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
    min-height: 100vh;

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
                margin-top: 1rem;

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