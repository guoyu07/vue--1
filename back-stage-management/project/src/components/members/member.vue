<template>
    <div class="member">
    <button @click="trans"v-show="a">{{CH}}</button>
    <button @click="trans"v-show="b">{{EN}}</button>
 <!--    <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i class="order"></i><em>订单列表</em></span>
  </div>
  <div class="operate">
   <form>

    <input type="text" class="textBox length-long" placeholder="输入订单编号或收件人姓名..."/>
    <select class="inline-select">
     <option>未付款</option>
     <option>已付款</option>
    </select>
    <input type="button" value="查询" class="tdBtn"/>
   </form>
  </div>
</div> -->
        <table v-if="items.length > 0"class="perpeo">
            <thead>
                    <tr v-show="a">
                    <th v-for="(value, key) in items[0]"v-if="filterCols.indexOf(key) < 0" >{{key}}</th>
                    </tr>
                    <tr v-show="b"><th>序号</th><th>会员姓名</th><th>手机号码</th><th>会员生日</th><th>性别</th><th>会员昵称</th><th>会员注册时间</th>
                    </tr>
            </thead>
            <tbody>
                    <tr v-for="(object, index) in items">
                    <td v-for="(value, key) in object"v-if="filterCols.indexOf(key) < 0">{{object[key]}}</td>
                    </tr>
            </tbody>
        </table>
            <mo-paging 
                :page-index="currentPage" 
                :total="count" 
                :page-size="pageSize" 
                @change="pageChange">
            </mo-paging>
    </div>
</template>

<script>
    import axios from 'axios';
    import qs from 'qs';
    import MoPaging from '../MoPaging.vue';
 

    export default {
        data:function(){
            return {
                items: [],
                pageSize : 10 , 
                currentPage : 1,
               count : 0,
               a: true,
               b:false,
               CH:'CH',
               EN:'EN'
            }
        },
        components : {
            MoPaging 
        },
        props: ['api', 'filterCols'],
        methods:{  
            getList(){
                axios({
                    url:'http://localhost:333/php/members.php',
                    headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                    params:{
                        'pageSize':this.pageSize,
                        'currentPage':this.currentPage
                    },             
                    method: 'post',              
                    }).then(res => {
                    console.log(res)
                    this.items = res.data.data;
                    this.count=res.data.total;
                })
            },
            trans:function(){
                this.a=this.a? false:true
                this.b=this.b?false:true
            },   
            pageChange (page) {
                this.currentPage = page;
                console.log(page)
                this.getList()
            }
        },
        mounted(){
            this.getList()
        }
    }
</script>
<style>
#toolList{height:30px;margin-left:180px;padding-top:10px;}
#toolList a{display:block;width:80px;height:30px;background: #26C9FF;float: right;margin-right:5px;text-align: center;line-height:30px;border-radius:10%; }
.member{width:85%;float:right;padding-left:10px;}
.member{width:85%;float:right;padding-left:10px;}
.member th{border:1px #ddd solid;height:35px;}
.member td{border:1px #ddd solid;padding:5px;}
.member td a{cursor:pointer;}
.perpeo th,.perpeo td{border-space:none;padding:10px;text-align:center;color:#555;}
.perpeo{border:1px solid #999;border-collapse:collapse;}
</style>
