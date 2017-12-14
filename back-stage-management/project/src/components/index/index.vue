<template>
<div class="index clearfix">
<div class="header">
 <div class="logo fl">
  后台管理系统
 </div>
 <div class="fr top-link">
  <span target="mainCont" title="DeathGhost">管理员：Admin</span>
  <span><router-link to="/login">退出</router-link></span>
 </div>
 </div>
<div class="menu-list frame fl"style="background:#313131">
  <!--  <a  target="mainCont" class="block menu-list-title center" style="border:none;margin-bottom:8px;color:#fff;">起始页></a> -->
   <ul>
    <li class="menu-list-title"@click="toggle1">
     <span>商品管理</span>
     <i>◢</i>
    </li>
    <li id="aa">
     <ul class="menu-children"@click="toggle4"id="d">
      <li title="订单列表" target="mainCont"><router-link to="/students">商品列表</router-link></li>
     </ul>
    </li>
   
    <li class="menu-list-title"@click="toggle2">
     <span>订单管理</span>
     <i>◢</i>
    </li>
    <li id="b">
     <ul class="menu-children"@click="toggle5"id="e">
      <li title="商品列表" target="mainCont"><router-link to="/products">订单列表</router-link></li>
     </ul>
    </li>
   </ul>
    <li class="menu-list-title"@click="toggle3">
   <span>会员管理</span>
   <i>◢</i>
  </li>
  <li id="c">
   <ul class="menu-children"@click="toggle6"id="f">
    <li><a title="会员列表" target="mainCont"><router-link to="/members">会员列表</router-link></a></li>
   </ul>
  </li>
</div>
 <div id="toolList">
     <a v-if="toolList" v-for="(value,key) in toolList" @click="click(value)">{{value.text ? value.text : key}}</a>
  </div>
  <router-view></router-view>
</div>
</template>
<script>
   export default {
  data () {
    return {
      toolList : null,
     
    }
  },
  methods :{
    initToolbar : function(_config){
      this.toolList = _config;
    },
    click: function(evt){
        if(evt && evt.event){
            evt.event()
        }
    },
    toggle1:function(){
      console.log(44)
       $("#aa").toggle('1500')
    },
    toggle2:function(){
       $("#b").toggle('1500')
    },
    toggle3:function(){
       $("#c").toggle('1500')
    },toggle4:function(){
       $("#d").css({background:'#f35844'})
      $('#e,#f').css({background:'none'})
    },toggle5:function(){
       $("#e").css({background:'#f35844'})
      $('#f,#d').css({background:'none'})
    },toggle6:function(){
       $("#f").css({background:'#f35844'})
      $("#e,#d").css({background:'none'})
    }
  }
}
</script>
<style>
.index{height:100%;}
.header{background:#3d3d3d;color:#fff;height:10%;min-height:75px;border-bottom:1px #383838 solid;}
.top-link,.logo{height:75px;line-height:75px;}
.menu-list{color:#cecece;width:10%;height:90%;min-width:100px;min-height:600px;}
.logo {text-indent:20px;}
.top-link span{padding-right:15px;}
.top-link span a{color:#b7b1b1;font-weight:900;}
.menu-list-title{font-size:14px;font-weight:bold;height:45px;line-height:45px;padding-left:5px;background:#555555;border-bottom:1px #666666 solid;cursor:pointer;}
.menu-list-title i{float:right;position:relative;right:5px;top:4px;color:#666666;}
.menu-children li{height:45px;line-height:45px;overflow:hidden;border-bottom:1px #494948 dotted;padding-left:2em;}
.menu-children li:hover{background:rgba(85,85,85,0.5);}
.menu-children li a{color:#fff;display:block;}
.menu-footer{color:#ccc;text-align:center;width:100%;position:fixed;bottom:0;padding:8px 0;border-top:1px #383838 solid;}
#toolList{height:30px;margin-left:180px;padding-top:10px;}
#toolList a{display:block;width:80px;height:30px;background: #26C9FF;float: right;margin-right:5px;text-align: center;line-height:30px;border-radius:10%; }

</style>