<template>
    <main>
      <router-view 
        :parts = 'parts' 
        :orderBurger = 'orderBurger'>
      </router-view>
    </main>
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

main{
  background-color: #F3F8F7;
}

</style>