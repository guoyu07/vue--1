import Vue from 'vue';
import VueRouter from 'vue-router';

import LoginComponent from '../components/login/Login.vue'
import indexComponent from '../components/index/index.vue'
import StudentsComponent from '../components/students/students.vue'
import ProductsComponent from '../components/products/products.vue'
import MembersComponent from '../components/members/members.vue'
import client from '../components/client/client.vue'


Vue.use(VueRouter);

var router = new VueRouter({
    routes: [{
        path: '/index',
        name: 'index',
        component: indexComponent,
        children: [{
            path: '/students',
            name: 'students',
            component: StudentsComponent
        },{
            path: '/products',
            name: 'products',
            component: ProductsComponent
        },{
            path: '/members',
            name: 'members',
            component: MembersComponent
        },{
            path:'/client',
            name:'client',
            component:client
        }]
        },{
            path: '/login',
            name: 'login',
            component: LoginComponent
        }         
    ]
})
// router.beforeEach((to, from, next) =>{
//     // console.log(to);
//     if(to.path.indexOf('login') < 0 && !window.localStorage.getItem('access_token')){
//         router.replace('login');
//         next();
//     } 
//     next();
// })

export default router;