<template>   
    <div class="content">
      <div class="list-block">
        <ul>
          <li>
            <div class="item-content">
              <div class="item-inner">
                <div class="item-title label">手机号</div>
                <div class="item-input">
                  <input type="text" placeholder="请输入手机号" v-model="username">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="item-content">
              <div class="item-inner">
                <div class="item-title label">密码</div>
                <div class="item-input">
                  <input type="password" placeholder="请输入密码" v-model="password">
                </div>
              </div>
            </div>
          </li>
          <li>
              <h6><a href="#" >忘记密码？</a></h6>
          </li>
          <li>
            <div class="content-block">
                <p><a href="#" class="button button-fill button-success" @click="login">登录</a></p>
                <p><a href="#" class="button button-fill button-danger" @click="register" >注册</a></p>
                <p><a href="#" class="button button-fill button-warning " @click="home">返回</a></p>
            </div>
          </li>
        </ul>
      </div>
      <spinner v-show="spShow"></spinner>
    </div>
</template>    
<script type="text/javascript">
    import spinner from '../spinner/spinner.vue'
    import axios from 'axios';
    import qs from 'qs';
    import jwt from 'jsonwebtoken';
    export default{
        data: function(){
            return {
                username:"" ,
                password:"",
                toolbar:'登录',
                spShow: false
            }
        },
        methods:{
            login:function(){
              this.spShow = true;
                axios({
                    url: 'http://localhost:777/php/login.php',
                    method: 'post',
                    data: qs.stringify({username: this.username, password: this.password}),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(res => {
                  this.spShow = false;
                  if(res.data=="ok"){
                    this.home();
                    this.token = jwt.sign({username:this.username}, 'abc', {
                            expiresIn:86400
                            }
                      );                    
                    $.cookie("token", this.token, { path: "/", expiress:1 ,sucue:true});
                  }else{
                    alert('密码和账号有误');
                  }

                })
            },
            home : function(){
                this.$router.push({path: '/home'})
            },
            register : function(){
                this.$router.push({path: '/register'});
            }
        },
        mounted:function(){
            this.$parent.initToolbar(this.toolbar);
            if($.cookie('token')){
              this.home()
            }
        },
        components: {
            spinner: spinner
        }
    }

    
</script>