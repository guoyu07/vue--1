<template>
<div>
  <div class="header clearfix">
    <div class="logo">
    后台管理系统
    </div>
    <div class="fr top-link">
    <a  target="mainCont" title="DeathGhost"><i class="adminIcon"></i><span>管理员：Admin</span></a>
    <a href="#" title="安全退出" style="background:rgb(60,60,60);"><i class="quitIcon"></i><router-link to="/login">退出</router-link></a>
    </div>
  </div>
  <div class="menu-list frame fl"style="background:#313131">
     <a  target="mainCont" class="block menu-list-title center" style="border:none;margin-bottom:8px;color:#fff;">起始页</a>
     <ul>
      <li class="menu-list-title">
       <span>订单管理</span>
       <i>◢</i>
      </li>
      <li>
       <ul class="menu-children">
        <li title="订单列表" target="mainCont"><router-link to="/students">订单列表</router-link></li>
       </ul>
      </li>
     
      <li class="menu-list-title">
       <span>商品管理</span>
       <i>◢</i>
      </li>
      <li>
       <ul class="menu-children">
        <li title="商品列表" target="mainCont"><router-link to="/products">商品列表</router-link></li>
       </ul>
      </li>
     </ul>
      <li class="menu-list-title">
     <span>会员管理</span>
     <i>◢</i>
    </li>
    <li>
     <ul class="menu-children">
      <li><a title="会员列表" target="mainCont"><router-link to="/members">会员列表</router-link></a></li>
     </ul>
    </li>
  </div>
</div>
</template>
<script>
    export default {
        name : 'commom'
    }