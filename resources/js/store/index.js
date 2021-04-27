import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
      userName: '', // 使用者名稱
      isGuest: true, // 是否為訪客
      isLoading: false, // 是否顯示loading
      cart: []
    },
    mutations: {
      setUserName (state, userName) { // update username
        state.userName = userName;
      },
      setIsGuest (state, isGuest) { // update isGuest
          state.isGuest = isGuest;
      },
      setIsLoading(state, isLoading) { // update isLoading
          state.isLoading = isLoading;
      },
      setCart (state, product){ // update cart
        state.cart.push(product);
      }
    }
  })