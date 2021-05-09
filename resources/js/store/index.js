import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
      user: '', // 使用者資料
      userName: '', // 使用者名稱
      isGuest: true, // 是否為訪客
      isLoading: false, // 是否顯示loading
      jwtToken: '', // jwt token
      cart: '', // 購物車
      shipWay: '', // 運輸資訊
      payWay: '', // 付款方式
      address: '', // 收件資訊

    },
    mutations: {
      setUser(state, user) { // update user
          state.user = user;
      },
      setJwtToken(state, jwtToken) { // update jwtToken
          state.jwtToken = jwtToken;
      },
      setUserName(state, userName) { // update username
          state.userName = userName;
      },
      setIsGuest(state, isGuest) { // update isGuest
          state.isGuest = isGuest;
      },
      setIsLoading(state, isLoading) { // update isLoading
          state.isLoading = isLoading;
      },
      setCart(state, cart) { // update cart by pass value
          state.cart = cart;
      },
      updateCart(state) { // update cart by call api
          axios.get('/api/auth/cart',{
              headers: {
                'Authorization': `Bearer ${state.jwtToken}`
            }
          })
          .then(response => {
            state.cart = response.data;
          })
          .catch(error => {

          });
      },
      setShipWay(state, shipWay) { // update shipWay
          state.shipWay = shipWay;
      },
      setPayWay(state, payWay) { // update payWay
          state.payWay = payWay;
      },
      setAddress(state, address) { // update address
          state.address = address;
      }
    }
})