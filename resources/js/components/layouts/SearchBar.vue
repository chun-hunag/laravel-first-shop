<template>
  <div class="m-1 seachbar-container">
      <div class="container d-flex">
        <div class="col-md-3 mx-1 text-right"><i class="fab fa-shopify icon blue-mid"></i></div>
        <div class="col-md-6 search-bar">
            <div class="">
                <div class="d-flex bg-white">
                    <input class="col-md-10 search-input" type="text" v-model="searchText" name="search-content">
                      <button class="col-md-2 p-1 bg-blue-mid search-btn " @click="search()"><i class="fas fa-search bg-blue-mid white icon"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-3 mx-1 text-left"><i class="fas fa-shopping-cart blue-mid icon"></i></div>
    </div>
  </div>
</template>

<script>
export default {
    data () {
      return {
        searchText: '',
      }
    },
    methods: {
      search: function () {
        axios.get('products/search', {
          params: {
            text: this.searchText,
            limit: 30,
            page: 1
          }
        }).then(response => {
          let data = new Object;
          data.products = response.data.products;
          data.searchText = this.searchText;
          data.count = response.data.count;
          this.$emit('searchProducts', data); // pass value to parent component
        }).catch(error => {

        });
        }
    }
}
</script>