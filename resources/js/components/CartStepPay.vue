<template>
  <div class="content-pay">
    <!-- 配送方式 -->
    <div class="my-2">
      <div class="layout-item-title">
        <div class="text-radio-title">選擇配送方式</div>
      </div>
      <div class="layout-radio-option">
        <radio name="delivery-way" value="home_delivery" v-model="shipWay" checked>宅配</radio>
      </div>
    </div>
    <!-- 付款方式 -->
    <div class="my-2">
      <div class="layout-item-title">
        <div class="text-radio-title">選擇付款方式</div>
      </div>
      <div class="layout-radio-option">
        <radio name="pay-way" value="credit_card" v-model="payWay" checked>信用卡</radio>
      </div>
    </div>

    <div class="my-2">
      <div class="layout-title">
        <div class="text-radio-title">收件資訊</div>
      </div>
      <div class="panel-info">
        <div class="d-flex mt-2 mr-2">
            <div class="col-md-4">地址</div>
            <input class="col-md-8 input-adress" v-model="address"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>


export default {
    props: ['clickedNext', 'currentStep'],
    data() {
        return {
            shipWay: '', // 運送方式
            payWay: '', // 繳費方式
            address: '', // 收件地址
        }
    },
    methods: {
        checkIsDone: function () { // 檢查是否可進行下一步
            if (this.shipWay !== '' && this.payWay !== '' && this.address !== '') {
                this.$store.commit('setShipWay', this.shipWay);
                this.$store.commit('setPayWay', this.payWay);
                this.$store.commit('setAddress', this.address);
                this.$emit('can-continue', {value: true}); // 可進行下一步
            } else {
                this.$emit('can-continue', {value: false}); // 可進行下一步
            }
        }
    },
    watch: {
        shipWay: function (newShipWay, oldShipWay) {
            if (newShipWay !== '') {
                this.checkIsDone();
            }
        },
        payWay: function (newPayWay, oldPayWay) {
            if (newPayWay !== '') {
                this.checkIsDone();
            }
        },
        address: function (newAddress, oldAddress) {
            this.checkIsDone();
        },
        isDone: function (newIsDone, oldIsDone) {
            this.$emit('can-continue', {value: newIsDone}); // 可進行下一步
        }
    },
    computed: {
        isDone: function () {
            if (this.shipWay !== '' && this.payWay !== '' && this.address !== '') {
                this.$store.commit('setShipWay', this.shipWay);
                this.$store.commit('setPayWay', this.payWay);
                this.$store.commit('setAddress', this.address);
                return true;
            } else {
                return false;
            }
        }
    },
    mounted() {
        console.log('mounted');
        if (this.isDone) {
            this.$emit('can-continue', {value: newIsDone}); // 可進行下一步
        }
    }
}
</script>
<style scoped>
/* 付費方式 content */
.content-pay {
  min-height: 50vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 2rem 3rem;
  text-align: left;
}
/* Radio 文字layout */
.layout-item-title {
  border-bottom: solid 1px #3383C8;
}
/* Radio 文字 */
.text-radio-title {
  width: fit-content;
  color: #FFFFFF;
  background-color: #3383C8;
  border-radius: 4px 4px 0 0;
}
/* Radio option layout */
.layout-radio-option {
  border-radius: 4px;
  background-color: #ececec;
}

/* 收件資訊 panel */
.panel-info {
  min-height: 128px;
  background: #fff;
  box-shadow: 0px 1px 2px #a4a4a4;
  border-radius: 4px;
  border: 1px solid #e6e6e6;
}

/* adress input */
.input-adress {
  min-height: 64px;
  border-radius: 4px;
  border: 1px solid #e6e6e6;
}

</style>