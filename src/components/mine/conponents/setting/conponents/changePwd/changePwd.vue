<template>
    <div class="content">
        <div class="list-block">
            <ul>
                
                <li>
                  <div class="item-content">
                    <div class="item-inner">
                      <div class="item-title label">原密码</div>
                      <div class="item-input">
                        <input type="text" placeholder="请输入原密码" v-model="Oldpassword" id="Oldpassword">
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="item-content">
                    <div class="item-inner">
                      <div class="item-title label">新密码</div>
                      <div class="item-input">
                        <input type="password" placeholder="请输入新密码" v-model="Newpassword1" id="Newpassword1">
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="item-content">
                    <div class="item-inner">
                      <div class="item-title label">确认密码</div>
                      <div class="item-input">
                        <input type="password" placeholder="请确认密码" v-model="Newpassword2" id="Newpassword2">
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="content-block">
                      <p><a href="#" class="button button-fill button-success" @click="changePwd">确定</a></p>
                  </div>
                </li>
            </ul>
        </div>
                
    </div>
</template>
<script type="text/javascript">
    import axios from 'axios';
    import qs from 'qs';
    import jwt from 'jsonwebtoken';
    export default{
      data:function(){
        return {
          Oldpassword:'',
          Newpassword1:'',
          Newpassword2:'',
          token:'',
          num:'',
          toolbar:'修改密码',
          backrouter:'setting'
        }
      },
      methods:{
            changePwd:function(){
                this.token=$.cookie('token'); 
                // this.num = hex_md5(this.Oldpassword);
                // console.log(this.Oldpassword);
                // console.log(this.num);
                jwt.verify(this.token,'abc',function(error,result){
                  var username=result.username;
                  // console.log(username);
                  var password=$('#Oldpassword').val();
                  // console.log(password);
                  axios({
                      url: 'http://localhost:777/php/login.php',
                      method: 'post',
                      data: qs.stringify({username:username,password:password}),
                      headers: {
                          'Content-Type': 'application/x-www-form-urlencoded'
                      }
                  }).then(res=>{
                  
                    var $pas1=$('#Newpassword1').val();
                    var $pas2=$('#Newpassword2').val();
                    if(res.data=="ok"){
                          if($pas1==""||$pas1==""){
                            alert('请输入新密码');
                          }else if($pas1==password&$pas2==password){
                            alert('密码不能和原密码一样');
                          }else if($pas1===$pas2){
                                axios({
                                    url: 'http://localhost:777/php/changePwd.php',
                                    method: 'post',
                                    data: qs.stringify({username:username,password:$pas1}),
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    }
                                }).then(rea=>{
                                  console.log(res);
                                    alert('修改成功');
                                });
                          }else{
                            alert('输入不正确');
                          }
                    }else{
                      alert('原密码不正确');
                    }
                  })
                });
                // 
            }

      },
      mounted:function(){
          this.$parent.initToolbar(this.toolbar,this.backrouter);
      }

    }

</script>