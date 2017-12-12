<template>

    <div class="content">
       
        <div class="list-block">
            <ul>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">商品条码</div>
                            <div class="item-input">
                              <input type="text" placeholder="请扫描商品条码" v-model="barcode">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>   
            

    </div>
</template>

<script type="text/javascript">

    import axios from 'axios';
    import qs from 'qs';
    import jwt from 'jsonwebtoken';
    
    export default{
        data:function(){
            return {
                toolbar:null,
                token:'',
                barcode:''
            }
        },
        methods: {
            login:function(){
                this.$router.push({path:'/login'}) 
            }
        },
        beforeCreate:function(){
            var $this=this
            if($.cookie('token')){
               this.token=$.cookie('token'); 
               jwt.verify(this.token,'abc',function(error,result){

                    axios({
                            url: 'http://localhost:777/php/login.php',
                            method: 'post',
                            data: qs.stringify({username:result.username}),
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                    }).then(res => {
                                
                                    if(res.data=="ok"){
                                        console.log(res.data);
                                    }else{
                                       
                                        $this.$router.push({path:'/login'}); 
                                    }
                            });
                });
            }else{
               this.$router.push({path:'/login'}); 
            } 
        }



    }
</script>


