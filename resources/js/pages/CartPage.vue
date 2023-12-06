<template>
<div class="bg">
    <div class="container">
        <div class="box">
        <h1 class="title">Cart</h1>
            <div class="row">
                <div class="col-9">
                    <div class="order-list">
                            <table class="table table-striped">
                                <tbody>
                                    <tr class="p-2" v-for="order in orderBurger" :key="order.id">
                                        <th scope="row">
                                            <img class="image" :src="'storage/parts_img/' + order.image" :alt="order.name">
                                        </th>
                                        <td class="name">{{order.name}}</td>
                                        <td class="">$ {{order.price}}</td>
                                        <td>{{order.quantity_to_order}}</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
                <div class="col-3">

                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        parts: Array, 
        orderBurger: Array
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

    .box{
        background-color: white;
        width: 90%;
        min-height: 300px;
        margin: 0 auto;
        padding: 2rem;

        .title{
            font-size: 3rem;
            font-weight: 500;
            text-align: center;
        }

        .order-list{
                
            .image{
                width: 110px;
                height: 110px;
                object-fit: cover;
                object-position: center;
            }

            .name{
                font-size: 2rem;
            }
            
        }

    }
}


</style>