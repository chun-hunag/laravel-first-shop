<template>
  <div style="padding: 2rem 3rem; text-align: left;">
      Step4
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