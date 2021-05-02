<template>
  <div class="container content">
     <div class="text-redirect-msg">{{message}}</div>
  </div>
</template>


<script>
export default {
    data () {
        return {
            message: '',
        }
    },
    mounted: function () {
        let message = this.$route.params.message;
        let redirect = this.$route.params.redirect;
        if (message && redirect) { // 若有待訊息和重導位置
            this.message = message;
            setTimeout(() => // 設定三秒後重導至指定位置
                this.$router.push({name: redirect})
            , 3000)
        } else {
            this.$router.push({name: 'index'});
        }
    }
}
</script>
<style scoped>
.text-redirect-msg {
    display: flex;
    flex-direction: column;
    text-align: center;
    justify-content: center;
    height: 100%;
    font-size: 3rem;
}
</style>