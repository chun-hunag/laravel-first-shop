import router from './router';
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

// require styles
import 'swiper/css/swiper.css';
Vue.use(VueAwesomeSwiper, /* { default global options } */)



const app = new Vue({
    el: '#app',
    router,
    store, // vuex
    components: { App },
	template: '<App/>',
});

