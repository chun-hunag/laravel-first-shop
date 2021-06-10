import Vue from 'vue';
import VueRouter from 'vue-router';
import Index from '../components/Index.vue';
import Login from '../components/auth/Login.vue';
import Register from '../components/auth/Register.vue';
import Email from '../components/auth/Email.vue';
import Error from '../components/Error.vue';
import ResetPassword from '../components/auth/ResetPassword.vue';
import SingleProduct from '../components/product/SingleProduct.vue';
import Cart from '../components/Cart.vue';
import Redirect from '../components/Redirect.vue';

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
        path: '/password/email',
        name: 'email',
        component: Email
      },
      {
        path: '/password/reset',
        name: 'reset',
        component: ResetPassword
      },
      {
        path:　'/error',
        name:  'error',
        component: Error
      },
      {
        path: '/product',
        name: 'singleProduct',
        component: SingleProduct,
      },
      {
        path: '/cart',
        name: 'cart',
        component: Cart
      },
      {
        path: '/redirect',
        name: 'redirect',
        component: Redirect
      }
  ],

})
