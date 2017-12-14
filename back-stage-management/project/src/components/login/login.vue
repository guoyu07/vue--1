<template>
    <div class="page-container">
            <h1>后台登录系统</h1>
            <form action="" method="post">
                <input type="text" name="username" class="username" placeholder="请输入您的用户名！" v-model="username">
                <input type="password" name="password" class="password" placeholder="请输入您的用户密码！"v-model="password"/>
                 <input type="button" value="登录" @click="Login"/>
            </form>
            <spinner v-show="show"></spinner>
    </div>
</template>

<script>
    import axios from 'axios';
    import spinner from '../spinner/spinner.vue'
    import request from 'superagent'
    import qs from 'qs'
    export default {
        data: function(){
            return {
                username: '',
                password: '',
                show: false
            }
        },
        methods: {
            Login: function(){
                // console.log(spinner);
                // this.show = true;
                // request.post('http://localhost/course/course-code/gz1706/vue/php/user.php').set('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8').send({username: this.username, password: this.password}).end((err, res) => {
                //     console.log(111);
                // })
                // axios.post('http://localhost/course/course-code/gz1706/vue/php/user.php', {username: this.username, password: this.password}).then(res => {
                //     console.log(this, res);
                //     // this.show = false;
                // })
                this.show = true;
                axios({
                    url: 'http://localhost:333/php/user.php',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    method: 'post',
                    data: qs.stringify({username: this.username, password: this.password}),
                }).then(res => {
                    console.log(res.data)
                     this.show = false;
                    if(res.data==''){
                        alert('登录或密码有误')
                        return
                    }
                    this.$router.push({name: 'students'});
                    
                })
                //发起 ajax 请求
            }
        },
        components: {
            spinner: spinner
        }
    }
</script>
<style>

.page-container {
    width: 350px;
    height: 350px;
    margin: 120px auto 0 auto;
    color: #fff;
    border: 1px solid #fcfc;
}

.page-container h1 {
    text-align:center;
    font-size: 30px;
    font-weight: 700;
    text-shadow: 0 1px 4px rgba(0,0,0,.2);
}

.page-container form {
    position: relative;
    width: 350px;
    margin: 15px auto 0 auto;
    text-align: center;
}

.page-container input {
    width: 270px;
    height: 42px;
    margin-top: 25px;
    padding: 0 15px;
    background: #2d2d2d; 
    background: rgba(45,45,45,.15);
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    border: 1px solid #3d3d3d; 
    border: 1px solid rgba(255,255,255,.15);
    -moz-box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset;
    -webkit-box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset;
    box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset;
    font-family: 'PT Sans', Helvetica, Arial, sans-serif;
    font-size: 14px;
    color: #fff;
    text-shadow: 0 1px 2px rgba(0,0,0,.1);
    -o-transition: all .2s;
    -moz-transition: all .2s;
    -webkit-transition: all .2s;
    -ms-transition: all .2s;
}

.page-container input:-moz-placeholder { color: #fff; }
.page-container input:-ms-input-placeholder { color: #fff; }
.page-container input::-webkit-input-placeholder { color: #fff; }

.page-container input:focus {
    outline: none;
    -moz-box-shadow:
        0 2px 3px 0 rgba(0,0,0,.1) inset,
        0 2px 7px 0 rgba(0,0,0,.2);
    -webkit-box-shadow:
        0 2px 3px 0 rgba(0,0,0,.1) inset,
        0 2px 7px 0 rgba(0,0,0,.2);
    box-shadow:
        0 2px 3px 0 rgba(0,0,0,.1) inset,
        0 2px 7px 0 rgba(0,0,0,.2);
}

</style>