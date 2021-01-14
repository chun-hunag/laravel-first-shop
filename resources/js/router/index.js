import Vue from 'vue';
import VueRouter from 'vue-router';
import Example from '../components/Example.vue';
import Index from '../components/Index.vue';
import Login from '../components/auth/Login.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
      {
          path: '/index',
          alias: '/',
          name: 'index',
          component: Index,
          // meta: {index:0}
      },
      {
        path: '/login',
        name: 'login',
        component: Login,
        // meta: {index:0}
      },
      {
        path: '/example',
        name: 'example',
        component: Example,
        // meta: {index:0}
      },
    ]
})
