

<template>

	<ul id="insert">
			<li><label>商品ID&nbsp;&nbsp;&nbsp;<input type="text" v-model='dataform.id' placeholder="请输入商品id" id="goodsId" required/></label></li>
			<li><label>商品类型<input type="text" v-model='dataform.type'placeholder="请输入商品类型" id="type" required/></label></li>

			<li><label>商品名称<input type="text" v-model='dataform.name' placeholder="请输入商品名称" id="name" required/></label></li>

			<li><label>商品价格<input type="text" v-model='dataform.price'placeholder="请输入商品价格" id="price" required/></label></li>

			<li><label>商品简介<input type="text" v-model='dataform.describe' placeholder="商品简介" id="describe" /></label></li>
			<li>图片路径<label><input type="text"  v-model='dataform.up' value="上传商品图片" id="up" required/></label></li>

			<li><label>商品编码<input type="text"v-model='dataform.barcode' placeholder="请输入商品编码" id="barcode" required/></label></li>

			<li><label>商品状态<select type="text" v-model='dataform.goodstate' id="goodstate">
				<option value="上架">上架</option>
				<option value="下架">下架</option>
			</select></label></li>

			<li><label>商品库存<input type="text" v-model='dataform.stock' placeholder="请输入商品库存" id="stock" required/></label></li>
		</ul>
</template>

<script>
	//import $ from 'jquery';
	import router from '../../router/index';
	//import './client.scss';

	export default {				
		data:function(){
			return {
				dataform : {},
				tools : {
					add: {
	                    text: '保存',
	                    event: () => {
	                    	const id = $('#goodsId').val();
	                    	const name = $('#name').val();
	                    	const type = $('#type').val();
	                    	const price = $('#price').val();
	                    	const describe = $('#describe').val();
	                    	const up = $('#up').val();
	                    	const barcode = $('#barcode').val();
	                    	const opt = $('#goodstate option:selected').val();
	                    	const stock = $('#stock').val();
	                    	console.log(id);
	                     	$.post('http://localhost:333/php/goodsUp.php',{goodid:id,name:name,type:type,price:price,describe:describe,up:up,barcode:barcode,opt:opt,stock:stock},function(res){
	                     		if(res){
	                     			router.push({name: 'students'});
	                     		}else{
	                     			alert('插入数据出错');
	                     		}
	                     	})  
	                    }
	                },
	                back: {
	                    text: '返回',
	                    event: () => {
	                        router.push({name: 'students'})
	                    }
	                }
				}
			}
		},
		mounted :function(){
          	this.$parent.initToolbar(this.tools);  
		}
	}
</script>
<style>
#insert {margin: 100px auto;padding-left: 150px;border-radius: 5%;color: #fff;width: 500px;height: 400px;background-color: #ccc;border: 1px solid #aaa; }
#insert ul, #insert li {list-style: none; }
#insert li {margin-top: 10px;height: 30px;line-height: 30px; }
#insert select {border-radius: 10%;width: 200px;height: 30px; }
#insert input {border-radius: 10%;width: 200px;height: 30px; }
</style>
