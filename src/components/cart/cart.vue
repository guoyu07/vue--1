<template>
    <div >
      <div class="list-block big"  v-if='dataset==[]'>
        <span class="icon icon-cart"></span>

        <p><a href="#" class="button button-fill button-danger " @click="barcode">去购物 </a></p>
      </div>
        <div class="list-block" v-if='dataset!=[]' >
          <ul>
              <li class="item-content red">
                <div class="item-media"><i class="icon icon-f7"></i></div>
              </li>
              <li class="item-content btn">
                <div class="item-media"><i class="icon icon-f7"></i></div>
                <p><a href="#" class="button button-big"><i class="icon icon-cart sm"></i>买购物袋 </a></p>
              </li>
              <li class="item-content white">
                 <div class="item-title"> <a href="#" class="button button-fill button-danger">促销 </a><span>一元一积分</span> </div>
              </li>
              <li class="item-content list" v-for= "(value,index) in dataset" :id="value.good_id">
                <a href="#" @click="del">X</a>
                  <div class="item-title">
                    <a href="#" class="button disabled">
                      <img :src="value.img" alt="" />
                    </a>
                  </div>
                  <div class="content-padded grid-demo ">
                    <div class="row">
                      <p >{{value.goodname}}</p>
                    </div>
                    <div class="row price">
                      <p >￥{{value.goodprice}}</p>
                      <p><button @click='addqty($event,index)' >-</button><span>{{value.qty}}</span><button @click='minqty($event,index)' >+</button></p>
                    </div>
                  </div>

              </li>
              <li class="item-content total" >
                  <div class="col-80">
                    <p class='big'>
                      合计：<span>￥{{total}}</span>
                    </p>
                    <p class="small">
                      总额：<span>￥{{total}}</span>
                      促销：<span>-￥0.00</span>
                    </p>
                  </div>
                  <div class='col-20' @click="order">
                    <span>去结算(<span>{{dataset.length}}</span>)</span>
                  </div>
              </li>

          </ul>
        </div>
      </div>
</template>
<script type="text/javascript">
  import "./cart.scss";
  import axios from 'axios';
  import qs from 'qs';
  import jwt from 'jsonwebtoken';
    export default{
        data(){
            return{
              toolbar:'购物车',
              dataset:"",
              token:""
            }
        },
        methods:{
          barcode:function(){
              
              this.$router.push({path:'/barcode'}) 
            },
          minqty:function(event,_index){
              event.path[1].children[1].innerText++;
              this.dataset[_index].qty = event.path[1].children[1].innerText;
            },
          addqty:function(event,_index){
            if(event.path[1].children[1].innerText>0){
                event.path[1].children[1].innerText--;
                this.dataset[_index].qty = event.path[1].children[1].innerText;
               
              } 
            },
          order:function(){
              this.$router.push({path:"/order"});
              var datas = this.dataset;
              if($.cookie('token')){
                this.token = $.cookie('token')
                jwt.verify(this.token,'abc',function(error,result){
                  var username = result.username;
                  console.log(username)
                  $.ajax({
                    url:'http://localhost:777/php/addshow.php'//php动态页
                    ,type:'POST'
                    ,data:{data:JSON.stringify(datas),username:username}//调用json.js类库将json对象转换为对应的JSON结构字符串
                    ,success:function(rst){
                      console.log(rst);
                      //alert('PHP接收JSON数据成功！');
                    }
                    ,error:function(xhr){alert('PHP页面有错误！'+xhr.responseText);}
                  });
                })
              }
          },
          barcode:function(){
              this.$router.push({path:'/barcode'});
          },
          del:function(event,index){
            console.log(event)
             this.dataset.splice(index,1);
             console.log(this.dataset)
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
        mounted:function(){
          this.$parent.initToolbar(this.toolbar);
          console.log(this.dataset)
          var datas = this.dataset;
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

                            //console.log(res.data)
                            res.data.forEach(function(item,idx){
                                if(item.orderstate==1){

                                  thisVue.dataset = JSON.parse(item.orderDetail)
                                  //关键点
                                }
                            })

                      });
              }.bind(this))
            //关键点
          }
        }

      }
</script>
