<template>
  <div id='app'>
    <div class="page-group">
        <div class="page page-current">
        <!-- 你的html代码 -->
                <header class="bar bar-nav">
                  <a class="button button-link button-nav pull-left back" v-if='unShows.indexOf(toolbar)>0' @click="back">
                  <span class="icon icon-left" ></span>
                  返回
                  </a>
                  <h1 class="title">{{toolbar}}</h1>                  
                </header>
                <nav class="bar bar-tab" v-if="unShows.indexOf(toolbar)<0">

                  <a class="tab-item " @click="home">
                    <span class="icon icon-home"></span>
                    <span class="tab-label">首页</span>
                  </a>
                  <a class="tab-item" @click="barcode">
                    <span class="icon icon-star"></span>
                    <span class="tab-label">扫码购</span>
                  </a>
                  <a class="tab-item" @click="cart">
                    <span class="icon icon-cart"></span>
                    <span class="tab-label">购物车</span>
                  </a>
                  <a class="tab-item" @click="mine">
                    <span class="icon icon-me"></span>
                    <span class="tab-label">我的</span>
                  </a>
                </nav>
                <div class="content">

                <!-- 这里是页面内容区 -->

                  <router-view></router-view>

                </div>
        </div>
      </div>
    </div>

</template>

<script>

export default {
  name: 'app',
  data () {
    return {
      toolbar:null,
      unShows:['登录','电子发票','分享给好友','用户反馈','优惠券','关于我们','设置','修改密码','常见问题','确认订单',"二维码"],
      backrouter:null
    }
  },
  methods:{
        home : function(event){
              this.$router.push({path: '/home'})
              event.path[1].classList.add("active")
            },
        mine : function(event){

              this.$router.push({path:'/mine'})
              event.path[1].classList.add("active")

        },
        cart : function(event){
              this.$router.push({path:'/cart'}) 
              event.path[1].classList.add("active")

        },
        barcode:function(event){
              this.$router.push({path:'/barcode'}) 
              event.path[1].classList.add("active")

        },
        back:function(){
          this.$router.push({path:this.backrouter})
        },
        initToolbar:function(_config,_backrouter){
          this.toolbar = _config;
          this.backrouter = _backrouter;
        }


  },
  // beforeUpdate:function(){
  //  this.$router.push({path: '/home'})
  // }
}

</script>

<style>
@import url("//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css");

.bar{
  border-top: 1px solid #fff;
 }
</style>
