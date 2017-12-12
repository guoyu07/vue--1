<template>
  
    <div class="content">
      <div style="background:#fff">
        <span>用户</span><br />
        <i id="name"></i>
      </div>

      <div class="list-block" style="margin-top:10px;">
        <div class="buttons-tab">
              <a class="button">全部订单</a>
              <a class="button">待支付</a>
              <a class="button">退货订单</a>
        </div>
        <div>
          <ul>
            <li class="item-content" @click="invoice">
              <div class="item-inner">
                <div class="item-title"><span class="icon icon-menu"></span> 电子发票</div>
                <span class="icon icon-right"></span>
              </div>
            </li>
            <li class="item-content" @click="share">
              <div class="item-inner">
                <div class="item-title"><span class="icon icon-share"></span> 分享给 好友</div>
                <span class="icon icon-right"></span>
              </div>
            </li>
            <li class="item-content" @click="feedback">
              <div class="item-inner">
                <div class="item-title"><span class="icon icon-edit"></span> 用户反馈</div>
                <span class="icon icon-right"></span>
              </div>
            </li>
            <li class="item-content" @click="discount">
              <div class="item-inner">
                <div class="item-title"><span class="icon icon-gift"></span> 优惠券</div>
                <span class="icon icon-right"></span>
              </div>
            </li>
            <li class="item-content" @click="aboutUs">
              <div class="item-inner">
                <div class="item-title"><span class="icon icon-emoji"></span> 关于我们</div>
                <span class="icon icon-right"></span>
              </div>
            </li>
            <li class="item-content" @click="setting">
              <div class="item-inner">
                <div class="item-title"><span class="icon icon-settings"></span> 设置</div>
                <span class="icon icon-right"></span>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
</template>
<script type="text/javascript">

    import axios from 'axios';
    import qs from 'qs';
    import jwt from 'jsonwebtoken';

    export default{
        data(){
            return{
              toolbar:'我的',
              token:''
            }
        },
        methods:{
            invoice : function(){
              this.$router.push({path: '/invoice'})
            },
            share : function(){
              this.$router.push({path: '/share'})
            },
            feedback : function(){
              this.$router.push({path: '/feedback'})
            },
            discount : function(){
              this.$router.push({path: '/discount'})
            },
            aboutUs : function(){
              this.$router.push({path: '/aboutUs'})
            },
            setting : function(){
              this.$router.push({path: '/setting'})
            }
        },
        mounted:function(){
            this.$parent.initToolbar(this.toolbar);
            if($.cookie('token')){
              console.log(66);
               this.token=$.cookie('token'); 
               jwt.verify(this.token,'abc',function(error,result){
                $('#name').html(result.username)
                })           
            }else{
              $('#name').html('登录优惠更多');
            }
        }
    }

</script>