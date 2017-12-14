<template>
        <datagrid api="http://localhost:333/php/goods.php" :filterCols="filterColumns" limit="12" :tools="tools" ></datagrid>
</template>

<script>
    import datagrid from '../datagrid/datagrid.vue';
    import router from '../../router/index.js';
    //import './goods.scss';
    export default {

        data: function(){
            return {
                filterColumns: [],
                tools: {
                    add: {
                        text: '添加商品',
                        event: function(){
                           router.push({name:'client'});
                        }
                    }
                },

            }
        },
        
        mounted:function(){
            // for(var i=0;i>5;i++){
            //      window.location.reload();   
            //  }
            this.$parent.initToolbar(this.tools);
            
        },
        components: {
            datagrid
        }
    }
</script> 
<style>
</style>

 