<template>
  <div class="container content">
      <SearchBar v-on:searchProducts="searchProducts"></SearchBar>
      <div class="wrapper">
        <div class="grid-item" v-for="(product, index) in products" :key="index">
          <div class="w-100 h-100 text-center" @click="clickProduct(product.id)">
              <img :src="'/upload/'  + product.cover_image" class ="product-img"/>
              <br/>
              <span class="product-title">{{ product.title | gridTitleFilter }}</span>
              <br/>
              <span class=" deep-red bg-gray product-price">${{ product.price }}</span>
          </div>
        </div>
      </div>
      <div class="w-100 text-center">
          <div class="d-flex justify-content-center">
            <div class="" v-for="(index) in totalPage" :key="index" @click="switchPage(index)">
                <span v-if="index != currentPage" class="dot">{{ index }}</span>
                <span v-else class="dot-blue">{{ index }}</span>
            </div>
          </div>
      </div>
  </div>
</template>

<script>
import SearchBar from './layouts/SearchBar.vue';
import VueGridLayout from 'vue-grid-layout';

export default {
    data () {
      return {
        searchText: '',
        searchSort: '',
        searchLimit: '',
        searchPage: 1,
        totalPage: 0,
        currentPage: 1,
        products: [],
        layout: [

            ],
        draggable: true,
        resizable: true,
        index: 0,
        eventLog: []
      }
    },
    methods: {
        clickProduct: function (id) {
          if (!Number.isInteger(id)) {
            return;
          }

          this.$router.push({ name: 'singleProduct', query: { id:  id}})
        },
        searchProducts: function (data) {
          console.log(data);
          this.products = data.products;
          this.searchText = data.searchText;
          this.totalPage = Number.parseInt(data.count / 30) + (((data.count % 30) !== 0) ? 1 : 0);
        },
        switchPage: function (page) {
          this.searchPage = page;
          this.currentPage = page;
          axios.get('products/search', {
            params: {
              text: this.searchText,
              limit: 30,
              page: page
            }
          }).then(response => {
            this.products = response.data.products;
            this.totalPage = Number.parseInt(response.data.count / 30) + (((response.data.count % 30) !== 0) ? 1 : 0);
          }).catch(error => {

          });
        }
    },
    filters: {
      gridTitleFilter: function (value) {
        if (!value) {
          return '';
        }
        value = value.toString()
        return (value.length > 10) ? value.substr(0, 10) : value;
      }
    },
    mounted: function () {
      axios.get('products/search', {
        params: {
          text: '',
          limit: 30,
          page: this.searchPage
        }
      }).then(response => {
        this.products = response.data.products;
        this.totalPage = (response.data.count / 30) + (((response.data.count % 30) !== 0) ? 1 : 0);
      }).catch(error => {

      });
    },
    components: {
        SearchBar,
        GridLayout: VueGridLayout.GridLayout,
        GridItem: VueGridLayout.GridItem
    },
}
</script>

<style scoped>
.product-title {
    width: auto;
    height: 20%;
    max-height: 20%;
}
.product-img {
    width: auto;
    height: 60%;
    max-height: 80%;
}
.product-price {
  width: auto;
  height: 20%;
  max-height: 20%;
}
.wrapper {
  display: grid;
  grid-template-columns: 10vw 10vw 10vw 10vw 10vw;
  grid-auto-rows: 20vh;
  grid-column-gap: 10px; /* 設定左右間距 */
  grid-row-gap: 20px; /* 設定上下間距 */
  max-width: 100vw;
}
.grid-item {
  width: auto;
  height: 100%;
}
.dot {
  height: 2rem;
  width: 2rem;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
}
.dot-blue {
  height: 2rem;
  width: 2rem;
  background-color: #0389ff;
  border-radius: 50%;
  display: inline-block;
}
.vue-grid-layout {
    background: #FFFFFF;
    height: 1140px !important;
}
.vue-grid-item:not(.vue-grid-placeholder) {
    background: #FFFFFF;
    border: 1px solid #0389ff;
}
.vue-grid-item .resizing {
    opacity: 0.9;
}
.vue-grid-item .static {
    background: #FFFFFF;
}
.vue-grid-item .text {
    font-size: 24px;
    text-align: center;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    height: 100%;
    width: 100%;
}
.vue-grid-item .no-drag {
    height: 100%;
    width: 100%;
}
.vue-grid-item .minMax {
    font-size: 12px;
}
.vue-grid-item .add {
    cursor: pointer;
}
</style>