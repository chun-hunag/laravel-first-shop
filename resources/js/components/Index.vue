<template>
  <div>
      <SearchBar></SearchBar>
      <div class="container">
        <div class="row">
          <div class="col-sm">
            <router-link :to="{name: 'singleProduct', query: {id: 1}}" class="nav-link"> product </router-link>
          </div>
          <div class="col-sm">
            One of three columns
          </div>
          <div class="col-sm">
            One of three columns
          </div>
        </div>
      </div>
  </div>
</template>

<script>
import SearchBar from './layouts/SearchBar.vue';

export default {
    data () {
      return {
      }
    },
    components: {
        SearchBar
    },
}
</script>