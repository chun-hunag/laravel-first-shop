<template>
  <div class="container content">
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-8 is-offset-2">
                    <horizontal-stepper :steps="checkSteps" @completed-step="completeStep"
                                        @active-step="isStepActive" @stepper-finished="check"
                    >                     
                    </horizontal-stepper>
                </div>
            </div>
        </div>
    </section>
  </div>
</template>


<script>
import HorizontalStepper from 'vue-stepper';
// This components will have the content for each stepper step.
import StepCart from './CartStepCart.vue'; // 購物車調整頁面
import StepPay from './CartStepPay.vue'; // 繳費方式調整頁面
import StepCheck from './CartStepCheck.vue'; // 結帳頁面
import StepInfo from './CartStepInfo.vue'; // 結帳資訊業面

export default {
    data () {
      return {
        checkSteps: [
                    {
                        icon: 'shopping_cart',
                        name: 'first',
                        title: '購物明細',
                        subtitle: '',
                        component: StepCart,
                        completed: false

                    },
                    {
                        icon: 'payment',
                        name: 'second',
                        title: '付款方式',
                        subtitle: '',
                        component: StepPay,
                        completed: false
                    },
                    {
                        icon: 'check_circle',
                        name: 'third',
                        title: '結帳',
                        subtitle: '',
                        component: StepCheck,
                        completed: false
                    },
                    // {
                    //     icon: 'info',
                    //     name: 'fourth',
                    //     title: '付款明細',
                    //     subtitle: '',
                    //     component: StepInfo,
                    //     completed: false
                    // }
        ]
      }
    },
    methods: {
      // Executed when @completed-step event is triggered
      completeStep(payload) {
          this.checkSteps.forEach((step) => {
              if (step.name === payload.name) {
                  step.completed = true;
              }
          })
      },
      // Executed when @active-step event is triggered
      isStepActive(payload) {
          this.checkSteps.forEach((step) => {
              if (step.name === payload.name) {
                  if(step.completed === true) {
                      step.completed = false;
                  }
              }
          })
      },
      // Executed when @stepper-finished event is triggered
      check(payload) {
          alert('end')
      }
    },
    mounted: function () {
        if (this.$store.state.isGuest) {
            this.$router.push({ name: 'redirect', params: { message: '請登入會員', redirect: 'login' } })
        }
        this.$store.commit('updateCart');  // 撈取cart 資料
    },
    components: {
          HorizontalStepper
    },
}
</script>