<template>
    <div class="content">
        <textarea placeholder="亲,你在使用中遇到什么问题,或者有什么建议,欢迎您提供给我们" v-model="feedback"></textarea>
            
        <div class="content-block">
            <p><a href="#" class="button button-fill button-success" @click="feedback1">提交<b v-if="anonymity">(匿名意见)</b></a></p>
        </div>
        <spinner v-show="spShow"></spinner>
    </div>
</template>

<script type="text/javascript">
    import spinner from '../../../spinner/spinner.vue'
    import './feedback.scss';
    import axios from 'axios';
    import qs from 'qs';
    import jwt from 'jsonwebtoken';

    export default{
        data(){
            return{
              toolbar:'用户反馈',
              backrouter:'/mine',
              feedback:'',
              token:'',
              spShow:false,
              anonymity:false
            }
        },
        methods:{
            feedback1:function(){
                this.spShow=true;
                var username;
                // var feedback=$('#feedback').val();
                if($.cookie('token')){
                    this.token=$.cookie('token');
                    jwt.verify(this.token,'abc',function(error,result){
                        username=result.username;
                    });
                }else{
                    username='匿名'
                }
                axios({
                    url: 'http://localhost:777/php/feedback.php',
                    method: 'post',
                    data: qs.stringify({username:username, feedback: this.feedback}),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(res => {
                    this.spShow=false;
                    if(res.data=='ok'){
                        alert('感谢您的宝贵意见，我们会对您的意见进行改进');
                        this.$router.push({path: '/mine'})
                    }
                });
            }
        },
        mounted:function(){
            this.$parent.initToolbar(this.toolbar,this.backrouter);
        },
        components: {
            spinner: spinner
        },
        beforeMount:function(){
            if($.cookie('token')){
                this.anonymity=false;
            }else{
                this.anonymity=true;
            }
        }
    }

   
</script>