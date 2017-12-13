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
                <div class="item-title label">验证码</div>
                <div class="item-input">
                  <input type="text" placeholder="请输入验证码" v-model="authCode">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="item-content">
              <div class="item-inner">
                <div class="item-title label">设置密码</div>
                <div class="item-input">
                  <input type="password" placeholder="密码不小于6位" v-model="password">
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="item-content">
              <div class="item-inner">
                <div class="item-title label">确认密码</div>
                <div class="item-input">
                  <input type="password" placeholder="请确认密码" v-model="password2">
                </div>
              </div>
            </div>
          </li>
      <!-- Select -->
          <li>
              <h6>注册即视为同意<a href="#" >注册协议</a></h6>
          </li>
          <li>
            <div class="content-block">
                <p><a href="#" class="button button-fill button-danger" @click="register">注册</a></p>
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
                toolbar:'注册', 
                authCode:'',             
                password:'',
                password2:'',
                token:'',
                spShow: false,
                backrouter:'/login'
            }
        },
        methods:{
            login : function(){
                this.$router.push({path: '/login'})
            },
            home:function(){
              this.$router.push({path:'/home'})
            },
            register:function(){
              if(this.username==''){
                alert('请输入手机号');
              }else  if(this.authCode==''){
                alert('请输入验证码');
              }else  if(this.password==''||this.password2==''){
                alert('请输入密码');
              }else  if(this.password===this.password2){
                this.spShow=true;
                axios({
                    url: 'http://localhost:777/php/register.php',
                    method: 'post',
                    data: qs.stringify({username: this.username, password: this.password}),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(res => {
                  this.spShow=false;
                  console.log(res.data)
                  if(res.data=='fail'){
                    alert('用户名已注册');
                  }else{
                      this.home();
                      this.token = jwt.sign({username:this.username}, 'abc', {
                            expiresIn:86400
                            }
                      );                    
                      $.cookie("token", this.token, { path: "/", expiress:1 ,sucue:true});
                  }
                })
              
              }else{
                alert('请输入相同密码');
              }
            }
        },
        mounted:function(){
            this.$parent.initToolbar(this.toolbar,this.backrouter);
        },
        components: {
            spinner: spinner
        }
    }
</script>