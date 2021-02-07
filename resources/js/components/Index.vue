<template>
  <div>
       <div class="m-1 seachbar-container">
          <div class="container d-flex">
            <div class="col-md-3 mx-1 text-right"><i class="fab fa-shopify icon blue-mid"></i></div>
            <div class="col-md-6 search-bar">
                <form class="" method="POST" action="">
                    <div class="d-flex bg-white">
                        <input class="col-md-10 search-input" type="text" name="search-content">
                          <button class="col-md-2 p-1 bg-blue-mid search-btn " ><i class="fas fa-search bg-blue-mid white icon"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md-3 mx-1 text-left"><i class="fas fa-shopping-cart blue-mid icon"></i></div>
        </div>
      </div>
      <div class="container">
         <grid-layout :layout.sync="layout"
                     :col-num="10"
                     :row-height="30"
                     :is-draggable="false"
                     :is-resizable="false"
                     :vertical-compact="true"
                     :use-css-transforms="true"
        >
         <grid-item v-for="(product, index) in products" :key="index"
                       :x="0 + (index % 5) * 2"
                       :y="0 + Number.parseInt(index / 5) * 5"
                       :w="2"
                       :h="5"
                       :i="0"
                       drag-allow-from=".vue-draggable-handle"
                       drag-ignore-from=".no-drag"
            >
                <div class="text">
                    <!-- <div class="vue-draggable-handle"></div> -->
                    <div class="no-drag" @click="clickProduct(product.id)">
                        <img :src="'/upload/'  + product.cover_image" class ="product-img"/>
                        <br/>
                        <span class="product-title">{{ product.title | gridTitleFilter }}</span>
                        <br/>
                        <span class=" deep-red bg-gray product-price">${{ product.price }}</span>
                    </div>
                </div>
            </grid-item>
        </grid-layout>
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
        searchPage: '',
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
          page: 1
        }
      }).then(response => {
        this.products = response.data.products;
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

.vue-grid-layout {
    background: #FFFFFF;
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