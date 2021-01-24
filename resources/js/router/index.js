import Vue from 'vue';
import VueRouter from 'vue-router';
import Example from '../components/Example.vue';
import Index from '../components/Index.vue';
import Login from '../components/auth/Login.vue';
import Register from '../components/auth/Register.vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
      {
        path: '/index',
        alias: '/',
        name: 'index',
        component: Index,
      },
      {
        path: '/login',
        name: 'login',
        component: Login,
      },
      {
        path: '/register',
        name: 'register',
        component: Register,
      },
      {
        path: '/example',
        name: 'example',
        component: Example,
        // meta: {index:0}
      },
    ]
})
