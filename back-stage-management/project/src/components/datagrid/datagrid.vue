<template>
    <div class="list-style">
    <div class="list">
    <button @click="trans"v-show="a">{{CH}}</button>
    <button @click="trans"v-show="b">{{EN}}</button>
     <input type="text" id="find"/><button id="test" @click="find"class="check">查询</button>
     </div>
        <table id="goodstable">
            <thead>
                    <tr v-show="a">
                    <th v-for="(value, key) in items[0]" v-if="filterCols.indexOf(key) < 0">{{key}}</th><th>handle</th><th>del</th>
                    </tr>
                    <tr v-show="b"><th>序号</th><th>商品编号</th><th>商品名称</th><th>商品价格</th><th>商品数量</th><th>采购员</th><th>供应商</th><th>商品类型</th><th>会员价</th>  <th >编辑</th>
                    <th>删除</th>
                    </tr>
            </thead>  
            <tbody>
                    <tr v-for="(object, index) in items">
                    <td v-for="(value, key) in object" v-if="filterCols.indexOf(key) < 0">{{object[key]}}</td><td @click="change">编辑</td>
                    <td @click="del">删除</td>
                    </tr>
            </tbody>
        </table>
         <div v-if="show" id="show">
            <ul>
            <li><label>商品ID&nbsp;&nbsp;&nbsp;<input type="text"  v-model='upid' required/></label></li>

            <li><label>商品类型<input type="text"  v-model="uptype" required/></label></li>

            <li><label>商品名称<input type="text"  v-model="upname" required/></label></li>

            <li><label>商品价格<input type="text"  v-model="upprice" required/></label></li>

            <li><label>商品简介<input type="text"  v-model="updescribe" /></label></li>
            <li>图片路径<label><input type="text"    v-model="upurl" required/></label></li>

            <li><label>商品编码<input type="text"  v-model="upbarcode" required/></label></li>

            <li><label>商品状态<select type="text"  v-model="upgoodstate">
                <option value="上架">上架</option>
                <option value="下架">下架</option>
            </select></label></li>
            <li><label>商品库存<input type="text"  v-model="upstock" required/></label></li>
           </ul>
            <button @click="save">保存</button>
        </div>
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
    // import router from '';
    import MoPaging from '../MoPaging.vue';
     // import './datagrid.scss';
    import router from '../../router/index';
 

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
               EN:'EN',
               upNum : null,
                toolList : null,
                show:false,
                showdata : [],
                upid :null,
                uptype :null,
                upname : null,
                upprice : null,
                updescribe : null,
                upurl : null,
                upbarcode : null,
                upgoodstate : null,
                upstock : null,
            }
        },
        components : {
            MoPaging 
        },
        props: ['api', 'filterCols','limit','toolbar','tools'],
        methods:{  
            change : function(e){
                //console.log(123);
                this.upNum = e.path[1].children[0].innerHTML*1,
                
                this.show = true
                $.post('http://localhost:333/php/goods.php',{sql:'select * from goodslist where good_id ='+this.upNum},res=>{
                   console.log(res);
                    this.showdata = JSON.parse(res);
                    console.log(this.showdata);
                    this.upid = this.showdata[0].good_id;
                    this.uptype = this.showdata[0].goodclassfiy;
                    this.upname = this.showdata[0].goodname;
                    this.upprice = this.showdata[0].goodprice;
                    this.updescribe = this.showdata[0].introduce;
                    this.upurl = this.showdata[0].img;
                    this.upbarcode = this.showdata[0].barcode;
                    this.upgoodstate  = this.showdata[0].goodstate;
                    this.upstock = this.showdata[0].stock;

                 })
            },
            del : function(e){
              var id = e.path[1].children[0].innerHTML*1;
              console.log(id);
              e.path[2].removeChild(e.path[1]);
              $.post(this.api,{sql:'delete from goodslist where good_id ='+id});
            },
            save : function(){
                this.show = false;

                $.post('http://localhost:333/php/goodsChange.php',{goodid:this.upid,type:this.uptype,name:this.upname,price:this.upprice,describe:this.updescribe,up:this.upurl,barcode:this.upbarcode,opt:this.upgoodstate,stock:this.upstock},function(res){
                    console.log(res);
                    router.push({name: 'students'}
                    );
                })
            },
            find : function(){
                const num = $('#find').val();
                //console.log(this) ;
                $.post('http://localhost:333/php/select.php',{val:num,pageSize:this.pageSize,currentPage:this.currentPage},res=>{
                    
                    res = JSON.parse(res);
                   console.log(this) ;
              this.count=res.total;
                    this.items = res.data;
                })
            },

            getList(){
                // axios({
                //     url:'http://localhost:333/php/goods.php',
                //     headers: {
                //             'Content-Type': 'application/x-www-form-urlencoded'
                //         },
                //     method: 'post',
                //     params:{
                //         'pageSize':this.pageSize,
                //         'currentPage':this.currentPage
                //     }                
                //     }).then(res => {
                //     console.log(res)
                //     this.count=res.data.total;
                //     this.items = res.data.data;
                // })
                 $.post('http://localhost:333/php/student.php',{sql:'select * from goodslist',pageSize:this.pageSize,currentPage:this.currentPage},res=>{
                            res = JSON.parse(res);
                            this.items=res.data;
                             console.log(res.data);
                             this.count=res.total;
             
                });
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
            console.log(this)
            this.getList()
        }
    }
</script>
<style>
.list-style{width:85%;float:right;padding-left:10px;}
.list-style .check{width:50px;height:30px;background:#eb93d8;border-radius:5px;border:none; box-sizing:border-box;margin-left:10px;} 
.list-style .list{padding-bottom:5px;}
.list-style .check:active{border:none;}
.list-style th{border:1px #ddd solid;height:35px;}
.list-style td{border:1px #ddd solid;padding:5px;}
.list-style td em,i{font-style:normal;}
.list-style td a{cursor:pointer;}
#goodstable th,#goodstable td{border-space:none;padding:10px;text-align:center;color:#555;}
#goodstable{border:1px solid #999;border-collapse:collapse;}
#show {position: absolute;left: 30%;top: 28%; margin: 0 auto;border-radius: 5%;color:#fff;width:500px;height: 400px;background-color: #ccc;border: 1px solid #aaa;z-index: 10000;text-align: center; opacity: 0.9;}
#show ul, #show li {list-style: none;}
#show li {margin-top: 10px;height: 30px;line-height:30px;}
#show select {border-radius: 10%;width: 200px;height:30px;}
#show input {border-radius: 10%;width: 200px;height:30px;}
#show button {width: 50px;height: 30px;line-height:30px;background-color:#26C9FF;border:none;color:#eee;
    border-radius: 8%;margin-top: 5px }
</style>
