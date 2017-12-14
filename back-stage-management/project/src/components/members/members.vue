<template>
        <member api="http://localhost:333/php/members.php" :filterCols="filterColumns"></member> 
</template>
<script>

    import member from './member.vue'
    export default {
        data: function(){
            return {
                filterColumns: ['password']
            }
        },
        components: {
            member
        },
        methods:{
            search:function(){
                console.log(this)
            }
        }
    }
</script>
<style>
</style>
