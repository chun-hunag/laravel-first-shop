// vue router
import router from './router';
// 設定router 的callback function 
router.beforeEach((to, from, next) => { // 設置全域前置守衛(每次router 切換前)
    store.commit('setIsLoading', true); // 開始loading
    console.log(store.state.isLoading)
    next();
  });
router.afterEach((to, from, next) => { // 設置全域後置守衛(每次router 切換後)
    store.commit('setIsLoading', false); // 結束loading
  });



import store from './store';
import App from './components/App';
import 'bootstrap/dist/css/bootstrap.css';
// import 'bootstrap-vue/dist/bootstrap-vue.css';
// import '/public/css/app.css';
import '/public/css/web.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
// import '@fortawesome/fontawesome-svg-core/css/all.min.css';
// import '@fortawesome/free-regular-svg-icons/css/all.min.css';
// import '@fortawesome/free-solid-svg-icons/css/all.min.css';


import './bootstrap.js';


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import { library } from '@fortawesome/fontawesome-svg-core';
import { faCoffee } from '@fortawesome/free-solid-svg-icons';
import { faGooglePlus } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(faCoffee, faGooglePlus);
Vue.component('font-awesome-icon', FontAwesomeIcon);

import VueAwesomeSwiper from 'vue-awesome-swiper';

// vue-loading
import Loading from 'vue-loading-overlay' //component
import 'vue-loading-overlay/dist/vue-loading.css' //style
Vue.component('Loading', Loading)


// require styles
import 'swiper/css/swiper.css';
Vue.use(VueAwesomeSwiper, /* { default global options } */)

// mixin
import {cookieMixin} from './mixin/cookieMixin.js';
Vue.mixin(cookieMixin);

// plugins


// axios
axios.interceptors.request.use(function (config) { // 新增攔截器
    // do something before request
    store.commit('setIsLoading', true); // 開始loading
    return config;
  }, function (error) { // do somethin when request error
    store.commit('setIsLoading', false); // 結束loading
    return Promise.reject(error);
  });

axios.interceptors.response.use(function (response) { // 新增response 攔截器
    // do something after response
    store.commit('setIsLoading', false); // 結束loading
    return response;
  }, function (error) { // do something when response error
    store.commit('setIsLoading', false); // 結束loading
    return Promise.reject(error);
  });

const app = new Vue({
    el: '#app',
    router,
    store, // vuex
    components: { App },
	template: '<App/>',
});

