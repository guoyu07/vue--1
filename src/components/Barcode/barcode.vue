<template>
    <div class="content">
        <div class="list-block">
            <ul>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">商品条码</div>
                            <div class="item-input">
                              <input type="text" v-model="barcode" id="barcode" @keyup="keyup">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <spinner v-show="spShow"></spinner>  
    </div>
</template>

<script type="text/javascript">
    import spinner from '../spinner/spinner.vue';
    import axios from 'axios';
    import qs from 'qs';
    import jwt from 'jsonwebtoken';
    
    export default{
        data:function(){
            return {
                toolbar:'扫描',
                backrouter:'/home',
                token:'',
                barcode:'',
                spShow: false
            }
        },
        methods: {
            login:function(){
                this.$router.push({path:'/login'}) 
            },
            keyup:function(e){
                if(e.keyCode==13){
                    this.spShow=true;
                    var $this=this;
                    axios({
                        url: 'http://10.3.135.228:777/php/searchgood.php',
                        method: 'post',
                        data: qs.stringify({barcode:this.barcode}),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    }).then(res => {             
                        if(res.data!="fail"){ 
                            var new_add_good={
                                good_id:res.data[0].good_id,
                                goodname:res.data[0].goodname,
                                goodprice:res.data[0].goodprice,
                                img:res.data[0].img,
                                barcode:res.data[0].barcode,
                                qty:1
                            }
                            this.token=$.cookie('token');
                            jwt.verify(this.token,'abc',function(error,result){
                                var username=result.username;
                                axios({
                                    url: 'http://10.3.135.228:777/php/searchorder.php',
                                    method: 'post',
                                    data: qs.stringify({username:username,orderstate:1}),
                                    headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                    }
                                }).then(res => {
                                    if(res.data[0].orderstate==1){
                                        var goodlist =$.parseJSON(res.data[0].orderDetail);
                                        var order=true
                                        var barcode = $('#barcode').val();
                                        for(let i=0;i<goodlist.length;i++){
                                            if(goodlist[i].barcode==barcode){
                                                order=false;
                                            }
                                        }
                                        if(order){
                                            goodlist[goodlist.length]=new_add_good;
                                            var good_list=JSON.stringify(goodlist);
                                            $.ajax({
                                                url:'http://10.3.135.228:777/php/storeorder_good.php'//php动态页
                                                ,type:'POST'
                                                ,data:{orderDetail:good_list,username:username}//调用json.js类库将json对象转换为对应的JSON结构字符串
                                                ,success:function(rst){
                                                    $this.spShow=false;
                                                }
                                                ,error:function(xhr){
                                                    $this.spShow=false;
                                                    alert('PHP页面有错误！'+xhr.responseText);
                                                    
                                                }
                                              });
                                            return goodlist;
                                        }else{
                                            $this.spShow=false;
                                            alert('该商品已存在')
                                        }
                                    }else{
                                        var orderId=new Date().getTime();
                                        function p(s) {
                                            return s < 10 ? '0' + s: s;
                                        }
                                        var myDate = new Date();
                                        var year=myDate.getFullYear();
                                        var month=myDate.getMonth()+1;
                                        var date=myDate.getDate(); 
                                        var h=myDate.getHours();  
                                        var m=myDate.getMinutes();
                                        var ordertime=year+'-'+p(month)+"-"+p(date)+" "+p(h)+':'+p(m);
                                        var orderDetail = JSON.stringify([new_add_good]);
                                        axios({
                                            url: 'http://10.3.135.228:777/php/add_orderlist.php',
                                            method: 'post',
                                            data: qs.stringify({orderId:orderId,orderDetail:orderDetail,username:username,ordertime:ordertime}),
                                            headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                            }
                                        }).then(res => {
                                            $this.spShow=false;
                                        });
                                    }
                                });                
                             });
                        }else{
                            this.spShow=false;
                            alert('没有此商品条码');
                        }
                    });                   
                }
            }
        },
        mounted:function(){
            this.$parent.initToolbar(this.toolbar,this.backrouter);
        },
        beforeCreate:function(){
            var $this=this
            if($.cookie('token')){
                $(document).ready(function(){$("#barcode").focus();});
            }else{
               this.$router.push({path:'/login'}); 
            } 
        },
        components: {
            spinner: spinner
        }
    }
    
</script>
