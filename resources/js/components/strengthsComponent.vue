<template>
    <div class="d-flex flex-wrap justify-content-between">
        <div class="box" v-for="data in datas" :key="data.id">
            <p class="number">{{data.number}}</p>
            <h1 class="title">{{data.title}}</h1>
            <p class="description">{{data.description}}</p>
            <div class="hr" v-if="data.isHR"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        datas: Array
    }

}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';

.box{
    width: 45%;
    padding: 2rem;

    .number{
        font-size: 1.2rem;
        margin: 0;
        font-weight: 450;
        color: $st-green;
    }
    
    .title{
        font-size: 1.7rem;
        font-weight: 450;
    }
    
    .description{
        font-size: 1.1rem;
        font-weight: 450;
        opacity: 90%;
        min-height: 90px;
    }
}

.hr{
    width: 100%;
    height: .5px;
    margin-top: 2rem;
    background-color: black;
}


</style>