<template>
  <div class="content-check">
    <!-- 提示 -->
    <div class="my-2">
      <div>親愛的<span class="deep-red">{{this.$store.state.userName}}</span>您好，請確認以下購物資訊是否正確</div>
    </div>
    <!-- 購物明細 -->
    <div class="my-2">
      <div class="layout-item-title">
        <div class="text-radio-title">購物明細</div>
      </div>
      <table class="w-100">
        <thead class="w-100">
          <tr class="w-100">
              <th class="w-40">商品名稱</th>
              <th class="w-20">價格</th>
              <th class="w-20">數量</th>
              <th class="w-20">&nbsp;</th>
              <!-- <th class="col-md-2">庫存</th> -->
          </tr>
        </thead>
        <tbody class="w-100">
          <tr  class="w-100" v-for="(item, index) in this.$store.state.cart.cart_item" :key="index" :style="(index % 2 === 1) ? grayStyle : ''">
              <td class="w-40">{{item.product.title  + ' / ' + item.product_sku.title}}</td>
              <td class="w-20">{{ '$' + ((item.product.price * item.amount) | decimalFormat)}}</td>
              <td class="w-20">{{item.amount}} 個</td>
              <th class="w-20">&nbsp;</th>
              <!-- <td class="col-md-2"></td> -->
          </tr>
        </tbody>
      </table>
    </div>
    <!-- 付款方式及寄送資 -->
    <div class="my-2">
      <div class="layout-item-title">
        <div class="text-radio-title">付款方式及寄送資訊</div>
      </div>
      <table class="w-100">
        <tbody class="w-100">
          <!-- 訂購人 -->
          <tr  class="w-100">
              <td class="w-40">姓名</td>
              <td class="w-60">{{user.first_name + user.last_name}}</td>
          </tr>
          <tr  class="w-100">
              <td class="w-40">運送方式</td>
              <td class="w-60">{{shipWay}}</td>
          </tr>
          <tr  class="w-100">
              <td class="w-40">付款方式</td>
              <td class="w-60">{{payWay}}</td>
          </tr>
          <tr  class="w-100">
              <td class="w-40">收件地址</td>
              <td class="w-60">{{this.$store.state.address}}</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</template>

<script>
export default {
    props: ['clickedNext', 'currentStep'],
    data() {
        return {
          grayStyle: 'background-color: #ECECEC;',
          shipWay: '',
          payWay: '',
        }
    },
    filters: {
        decimalFormat: function (value) {
          return (Math.round(value * 100) / 100).toFixed(2);
        }
    },
    methods: {
        getShipWayText: function () {
            switch (this.$store.state.shipWay) {
              case 'home_delivery':
                  return '宅配';
              default:
                  return '';
            }
        },
        getPayWayText: function () {
            switch (this.$store.state.payWay) {
              case 'credit_card':
                  return '信用卡';
              default:
                  return '';
            }
        }
    },
    computed: {
      user: function () {
          return this.$store.state.user;
      }
    },
    mounted() {
      this.shipWay = this.getShipWayText();
      this.payWay = this.getPayWayText()
      this.$emit('can-continue', {value: true});
        // if(!this.$v.$invalid) {
        //     this.$emit('can-continue', {value: true});
        // } else {
        //     this.$emit('can-continue', {value: false});
        // }
    }
}
</script>
<style scoped>
/* 確認資訊 content */
.content-check {
  min-height: 50vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 2rem 3rem;
  text-align: left;
}

/* 文字layout */
.layout-item-title {
  border-bottom: solid 1px #3383C8;
}
/* 文字 */
.text-radio-title {
  width: fit-content;
  color: #FFFFFF;
  background-color: #3383C8;
  border-radius: 4px 4px 0 0;
}
</style>