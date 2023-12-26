<template>
    <router-link to="allburger" class="sw-button">
        {{dataButton.title}}
    </router-link>
    
</template>

<script>
export default {
    props:{ dataButton: Object }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables.scss';

.sw-button{
    background-color: $body-bg;
    color: black;
    text-align: center;
    padding: 1.1rem;
    border-radius: .4rem;
    font-weight: 450;
    font-size: 1rem;
    text-decoration: none;
    border: none;
    margin: .5rem;

    &:hover{
        background-color: $st-green;
        color: $body-bg;
    }
}

</style>