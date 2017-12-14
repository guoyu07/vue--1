<template>
        <product api="http://localhost:333/php/products.php" :filterCols="filterColumns"></product> 
</template>

<script>
    import product from './product.vue'

    export default {
        data: function(){
            return {
                filterColumns: ['img']
            }
        },
        components: {
            product
        }
    }
</script>
<style>

</style>
