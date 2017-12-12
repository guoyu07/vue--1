<template>
      <div class="content">
      <remote-js src='src/libs/jquery.uiAlertView-1.0.0.js'></remote-js>
            
      </div>
</template>

<script type="text/javascript">
  import axios from 'axios';
  import qs from 'qs';
  import Vue from 'vue';
  import '../../../../assets/css/uiAlertView-1.0.0.css';
  import jwt from 'jsonwebtoken'
  export default{
        data(){
            return{
              toolbar:'付款页面',
              dataset:"",
              backrouter:'/order',
              token:""
            }
        },
        //外部引入js;
        components: {
            'remote-js': {
                render(createElement) {
                 return createElement('script', { attrs: { type: 'text/javascript', src: this.src }});
                },
                props: {
                  src: { type: String, required: true },
                },
           },
           total(){
             var num = null;
             this.dataset.forEach(function(v,i){
               num += v.goodpirce*v.qty 
            });
            return num
          }
       },
        mounted:function(){
            this.$parent.initToolbar(this.toolbar,this.backrouter);
            $('#qrcode').html('').qrcode('http://10.3.135.254/porject/vue_erp/new-project/src');
             if($.cookie('token')){
              this.token = $.cookie('token');

            jwt.verify(this.token,'abc',function(error,result){
                      //console.log(result.username)
                      var thisVue = this;
                      //关键点
                      var username = result.username;
                      axios({
                            url:'http://localhost:777/php/cart.php',
                            method: "post",
                            data: qs.stringify({username:username}),
                            //参数要经过qs转化为字符
                            headers: {
                              'Content-Type': 'application/x-www-form-urlencoded',
                            }
                      }).then(res => {

                            console.log(res.data)
                            res.data.forEach(function(item,idx){
                                if(item.orderstate==1){

                                  thisVue.dataset = JSON.parse(item.orderDetail)
                                  //关键点
                                  //console.log(thisVue)
                                }
                            })
                            console.log(this.dataset)
                            var myDate = new Date();
                            var nowtime = myDate.toLocaleString( );
                            var marketName = 'motherfucker无人超市app\n\n';
                            var br = '**************************************\n';
                            var line = '---------------------------------------------\n';
                            var TheCartList = `商品      数量     单价        \n`;
                            var num = null;
                            this.dataset.forEach(function(item,idx){
                              TheCartList+=`${item.goodname}      ${item.qty}     ￥${item.goodpirce}\n`;
                               num += item.goodpirce*item.qty; 
                            })
                            var total = num;
                            var somes = marketName + br + TheCartList + line + '总价  ￥'+num +'\n'+ br +'\n\n';
                            console.log(somes)
                            var json = {
                              title:"确定支付？",
                              msg:"",
                              buttons:[
                                  { title:"确定",color:"red",click:function(){
                                      axios({
                                              url:'http://10.3.135.62:81/print',
                                              method: "post",
                                              data:qs.stringify({text:somes}),
                                              //参数要经过qs转化为字符
                                              headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded',
                                              }
                                      })
                                      alert('已成功支付')
                                  
                                  }},
                                  { title:"取消",click:function(){alert("你点了取消")} }
                              ]
                            }
                            $.alertView(json)
                      });
              }.bind(this))
              //关键点
            };


    }
  }
</script>

