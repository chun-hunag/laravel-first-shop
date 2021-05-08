<template>
  <div style="padding: 2rem 3rem; text-align: left;">
      <!-- 配送方式 -->
      <div>
          <div>選擇配送方式</div>
          <div></div>
      </div>
      <!-- 付款方式 -->
      <div>
          <div>選擇付款方式</div>
          <div></div>
      </div>
  </div>
</template>

<script>


    export default {
        props: ['clickedNext', 'currentStep'],
        data() {
            return {
            }
        },
        mounted() {
          this.$emit('can-continue', {value: true});
            // if(!this.$v.$invalid) {
            //     this.$emit('can-continue', {value: true});
            // } else {
            //     this.$emit('can-continue', {value: false});
            // }
        }
    }
  </script>