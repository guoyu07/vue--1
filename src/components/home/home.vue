<template>

    <div class="content">

      <swiper :options="swiperOption" ref="mySwiper" >
        
          <div class="swiper-slide" v-for='item in dataset'><img :src="item" width="100%" /></div>
          <div class="swiper-pagination" slot="pagination"></div>
      </swiper>

      <div class="list-block">
        <ul>
          <li class="item-content">
            <div class="item-media"><i class="icon icon-f7"></i></div>
            <div class="item-inner">
              <div class="item-title">商品名称</div>
              <div class="item-after">杜蕾斯</div>
            </div>
          </li>
          <li class="item-content">
            <div class="item-media"><i class="icon icon-f7"></i></div>
            <div class="item-inner">
              <div class="item-title">型号</div>
              <div class="item-after">极致超薄型</div>
            </div>
          </li>
        </ul>
      </div>

    </div>
</template>


<script type="text/javascript">
    import { swiper, swiperSlide } from 'vue-awesome-swiper'
    export default{
        name: 'carrousel',
        components: {
          swiper,
          swiperSlide,
        },
        //components要放上面
        data(){
            return{
                dataset : ["src/assets/img/img1.jpg","src/assets/img/img2.jpg","src/assets/img/img3.jpg"],
                //绝对路径
                toolbar:'首页',
                swiperOption: { 
                autoplay:true, 
                //是一个组件自有属性，如果notNextTick设置为true，组件则不会通过NextTick来实例化swiper，也就意味着你可以在第一时间获取到swiper对象，假如你需要刚加载遍使用获取swiper对象来做什么事，那么这个属性一定要是true  
                notNextTick: true,  
                pagination: '.swiper-pagination',  
                slidesPerView: 'auto',  
                centeredSlides: true,  
                paginationClickable: true,  
                spaceBetween: 30,  
                    onSlideChangeEnd: swiper => {  
                        //这个位置放swiper的回调方法  
                        this.page = swiper.realIndex+1;  
                        this.index = swiper.realIndex;  
                    }  
                }  
          }
        },
        computed: {  
  
            swiper() {  
              return this.$refs.mySwiper.swiper;  
            }  
        },
        mounted:function(){
            this.$parent.initToolbar(this.toolbar);

        },
    }
</script>
<style type="text/css">
@import url("../../assets/css/swiper.min.css");


</style>
