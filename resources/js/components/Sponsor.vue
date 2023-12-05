<template>
    <div class="bg-white">
            <div class="container box-image">
                <img v-for="image in images" :key="image.id" :src="image.url" alt="" srcset="">
            </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            images: [
                {url: 'https://10web-site.ai/62/wp-content/uploads/sites/65/2023/08/recycled-shoe-store-featured-in-logo-5_hf0ZkTIf.webp'},
                {url: 'https://10web-site.ai/62/wp-content/uploads/sites/65/2023/08/recycled-shoe-store-featured-in-logo-4_hf0ZkTIf.webp'},
                {url: 'https://10web-site.ai/62/wp-content/uploads/sites/65/2023/08/recycled-shoe-store-featured-in-logo-3-1-1_hf0ZkTIf.webp'},
                {url: 'https://10web-site.ai/62/wp-content/uploads/sites/65/2023/08/recycled-shoe-store-featured-in-logo-2-1-1_hf0ZkTIf.webp'},
                {url: 'https://10web-site.ai/62/wp-content/uploads/sites/65/2023/08/recycled-shoe-store-featured-in-logo-1-1_hf0ZkTIf.webp'}
            ]
        }
    }

}
</script>

<style lang="scss" scoped>

.bg-white{
    background-color: white;
    width: 100%;
    height: 200px;

    .box-image{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        flex-wrap: nowrap;

        img{
            width: 200px;
            margin: 1rem;
        }
    }
}

</style>