<template>
  <div id="app">
      <Header></Header>
      <router-view></router-view>
      <!-- vue-loading -->
      <loading :active.sync="isLoading"></loading>
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
    computed: {
      isLoading: function() {
        return this.$store.state.isLoading;
      }
    }
}
</script>