<template>
    <div >
      <div class="list-block big"  v-if='dataset==[]'>
        <span class="icon icon-cart"></span>

        <p><a href="#" class="button button-fill button-danger " @click="barcode">去购物 </a></p>
      </div>
        <div class="list-block " id='order' v-if='dataset!=[]'>
          <ul>
            <li class='card' v-for= "(value,index) in dataset">
              <div class="card-header">{{value.ordertime}}</div>
              <a href="#" class="item-link item-content">
                <div class="item-media"><i class="icon icon-f7"></i></div>
                <div class="item-inner">
                  <div class="item-title_order">
                      <a href="#" class="button disabled" v-for='(item,index) in JSON.parse(value.orderDetail)'>
                        <img :src="item.img" alt="" />
                      </a>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
</template>
<script type="text/javascript">
  import "../../cart/cart.scss";
  import axios from 'axios';
  import qs from 'qs';
  import jwt from 'jsonwebtoken';
  export default{
        data(){
            return{
              toolbar:'全部定单',
              token:'',
              dataset:''
            }
        },
        computed:{

          total(){
             var num = null;
             this.dataset.forEach(function(v,i){
               num += v.goodprice*v.qty 
               //console.log(num)
            });
            return num
          }
        },
        methods:{
          barcode:function(){
              
            this.$router.push({path:'/barcode'}) 
          }
        },
        mounted:function(){
            this.$parent.initToolbar(this.toolbar,this.backrouter);
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
                            
                                  thisVue.dataset = res.data
                                  //关键点
                         

                      });
              }.bind(this))
              //关键点
            };
        }
    }


</script>