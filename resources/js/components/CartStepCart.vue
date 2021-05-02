<template>
  <div style="padding: 2rem 3rem; text-align: left;">
    <div v-if="isEmpty">
        <div @click="goToIndex()">
          沒有產品.... <br>
        </div>
        
    </div>
    <div v-else class="wrapper">
      <!-- 欄位 -->
      <div class="w-100 h-10 text-center d-flex bg-gray" >
        <div class="w-20 mx-2">&nbsp;</div>
        <div class="w-40 mx-2 product-title">商品名稱</div>
        <div class="w-10 mx-2 product-price"> 價格 </div>
        <div class="w-10 mx-2 product-amount"> 數量 </div>
        <div class="w-10 mx-2">變更</div>
      </div>
      <!-- 商品資訊 -->
      <div class="grid-item" v-for="(item, index) in cart.cart_item" :key="index">
        <div class="w-100 h-80 text-center d-flex" >
          <div class="w-20 mx-2">
            <img :src="'/upload/'  + item.product.cover_image" class ="product-img"/>
          </div>
          <div class="w-40 mx-2 product-title">{{item.product.title}}</div>
          <div class="w-10 mx-2 product-price"> {{ '$' + ((item.product.price * item.amount) | decimalFormat)}} </div>
          <div class="w-10 mx-2 product-amount"> {{item.amount}} 個</div>
          <div class="w-10 mx-2 btn-remove-product" @click="removeCartItem(item.id)"><img src="/static/icons/fa-times-circle.svg" class="img-btn-remve" /></div>
        </div>
      </div>
      <!-- 總價格 -->
      <div class="w-100 h-10 text-center d-flex bg-gray" >
        <div class="w-20 mx-2">&nbsp;</div>
        <div class="w-40 mx-2 product-title">&nbsp;</div>
        <div class="w-10 mx-2 product-price"> {{ totalPrice | decimalFormat }} </div>
        <div class="w-10 mx-2 product-amount"> &nbsp; </div>
        <div class="w-10 mx-2">&nbsp;</div>
      </div>
    </div>
  </div>
</template>

<script>

import VueGridLayout from 'vue-grid-layout';
export default {
    props: ['clickedNext', 'currentStep'],
    data() {
        return {

        }
    },
    methods: {
      goToIndex: function () {
          this.$router.push('index');
      },
      removeCartItem: function(cartItemId){
          axios.delete('/auth/cart/' + cartItemId + '/delete',)
          .then(response => { // 成功會直接回傳購物車 
              this.$store.commit('setCart', response.data)
          }).catch(error => { // 失敗應跳modal 提示訊息(未實作)
            
          });
      },
    },
    mounted() {
      this.$emit('can-continue', {value: true});
        // if(!this.$v.$invalid) {
        //     this.$emit('can-continue', {value: true});
        // } else {
        //     this.$emit('can-continue', {value: false});
        // }
    },
    computed: {
      cart: function () {
        return this.$store.state.cart;
      },
      isEmpty: function () {
        if (this.cart === undefined  || this.cart === '' || this.cart.cart_item.length === 0) {
          return true;
        }
        
        return false;
      },
      totalPrice: function () {
        if (this.cart === undefined  || this.cart === '' || this.cart.cart_item.length === 0) {
          return 0;
        }
        let totalPirce = 0;
        this.cart.cart_item.forEach(item => {
          totalPirce += (item.amount * item.product.price)
        });
        return totalPirce;
      }
    },
    filters: {
      decimalFormat: function (value) {
        return (Math.round(value * 100) / 100).toFixed(2);
      }
    },
    components: {
        GridLayout: VueGridLayout.GridLayout,
        GridItem: VueGridLayout.GridItem
    }
}
</script>
<style scoped>
.product-title {
    height: 20%;
    max-height: 20%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-self: center;
    border-left: solid 2px #FFFFFF;
}
.product-img {
    height: 60%;
    max-height: 128px;
}
.product-price {
    height: 20%;
    max-height: 20%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-self: center;
    border-left: solid 2px #FFFFFF;
}
.product-amount {
    height: 20%;
    max-height: 20%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-self: center;
    border-left: solid 2px #FFFFFF;
}
/* 移除按鈕 */
.btn-remove-product {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-self: center;
    border-left: solid 2px #FFFFFF;
}
/* 移除按鈕icon */
.img-btn-remve {
    max-width: 32px;
    height: auto;
}
</style>