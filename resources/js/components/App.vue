<template>
  <div id="app">
    <Header></Header>
    <router-view></router-view>
    <Footer></Footer>
  </div>
</template>

<script>
import Footer from './layouts/Footer.vue';
import Header from './layouts/Header.vue';

export default {
    data () {
      return {
      }
    },
    components: {
        Footer,
        Header
    },
}
</script>