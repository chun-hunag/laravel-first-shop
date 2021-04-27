<template>
  <div class="container content">
     <div>{{msg}}</div>
  </div>
</template>


<script>
export default {
    data () {
      return {
          msg: '',
          redirectName: 'index'
      }
    },
    mounted: function () {
        // 判斷是否登入
    }
}
</script>