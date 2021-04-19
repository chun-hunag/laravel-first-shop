import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
      userName: '',
      isGuest: true,
      cart: []
    },
    mutations: {
      setUserName (state, userName) {
        state.userName = userName;
      },
      setIsGuest (state, isGuest) {
          state.isGuest = isGuest;
      },
      setCart (state, product){
        state.cart.push(product);
      }
    }
  })