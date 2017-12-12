<template>
    <div class="content">
        
    </div>
</template>

<script type="text/javascript">

    export default{
        data(){
            return{
              toolbar:'关于我们',
              backrouter:'/mine'
            }
        },
        mounted:function(){
            this.$parent.initToolbar(this.toolbar,this.backrouter);
        }
    }

</script>