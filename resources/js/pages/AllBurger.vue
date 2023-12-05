<template>
<div class="bg">
  <div class="container">
    <div class="box">
      <h1 class="title">All VeganBurger</h1>
      <div class="d-flex flex-wrap">
        <div v-for="part in parts" :key="part.id" class="my-card">
          <BurgerCard :part = 'part'/>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import BurgerCard from '../components/BurgerCard.vue'
export default {
  components: { BurgerCard },
    props: {
            parts: Array
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
      font-size: 4rem;
      font-weight: 500;
      margin-bottom: 3rem;
    }

    .my-card{
      text-align: center;
      width: calc((100% / 3) - 20px);
      margin: 10px;
    }
  }
}

</style>