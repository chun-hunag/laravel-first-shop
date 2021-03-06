<template>
  <div class="container content">
      <!-- 搜尋欄 -->
      <SearchBar v-on:searchProducts="searchProducts"></SearchBar>
      <!-- 商品列表 -->
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
      <!-- 分頁按鈕 -->
      <div class="w-100 text-center">
          <div class="d-flex justify-content-center">
            <div class="mr-2 page-left-double-arrow" @click="toFirstPage()">
              <i class=" fas fa-angle-double-left"></i>
            </div>
            <div class="mr-2 page-left-arrow" @click="pageMinus()">
              <i class="fas fa-chevron-left"></i>
            </div>
            <div class="" v-for="(value, index) in currentPageArray" :key="index" @click="switchPage(value)">
                <!-- 不是目前瀏覽頁面時，圓形頁面按鈕 -->
                <div v-if="value != currentPage" class="dot">
                  <div class="text-dot">{{ value }}</div>
                </div>
                <!-- 是目前瀏覽頁面時，圓形的頁面按鈕 -->
                <div v-else class="dot-blue">
                  <div class="text-dot">{{ value }}</div> 
                </div>
            </div>
            <div class="ml-2 page-right-arrow" @click="pagePlus()">
                <i class="fas fa-chevron-right"></i>
            </div>
            <div class="ml-2 page-right-double-arrow" @click="toLastPage()">
              <i class="fas fa-angle-double-right"></i>
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
        searchText: '', // searchBar 內容
        searchSort: '',
        searchLimit: '', // search 的上限
        searchPage: 1, // searh 第幾頁
        totalPage: 0, // 總共幾頁
        currentPage: 1, // 目前第幾頁
        currentPageArray: [], // 目前頁數的arrau
        products: [], // 商品資料的array
        // 其它套件參數
        layout: [

            ],
        draggable: true,
        resizable: true,
        index: 0,
        eventLog: [],
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
          this.initCurrentPageArray();
        },
        switchPage: function (page) { // 商品頁面切換
          this.searchPage = page;
          this.currentPage = page;
          axios.get('api/product/search', {
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
        },
        initCurrentPageArray: function () { // 初始化page Array
          let tmpArray = [];
          if (this.totalPage < 5) {
            for (let i = 1; i <= this.totalPage; i++) {
              tmpArray.push(i);
            }
          } else {
            tmpArray = [1, 2, 3, 4, 5];
          }
          this.currentPageArray = tmpArray;
        },
        pagePlus: function () { // 下一頁
          if (!(Math.max(...this.currentPageArray) >= this.totalPage)) { // make sure page number
            this.currentPageArray = this.currentPageArray.map(x => x + 1);
          }
          if (this.currentPage < this.totalPage) {
            this.currentPage += 1;
            this.switchPage(this.currentPage);
          }
        },
        pageMinus: function () { // 上一頁
          if (!(Math.min(...this.currentPageArray) <= 1)) { // make sure page number
             this.currentPageArray = this.currentPageArray.map(x => x - 1);
          }
          if (this.currentPage > 1) {
            this.currentPage -= 1;
            this.switchPage(this.currentPage);
          }
        },
        toFirstPage: function () { // 到第一頁
          this.currentPage = 1;
          this.initCurrentPageArray();
          this.switchPage(this.currentPage);
        },
        toLastPage: function () { // 到最後一頁
          this.currentPage = this.totalPage;
          if (this.totalPage >= 5) {
            this.currentPageArray = [this.totalPage - 4, this.totalPage - 3, this.totalPage - 2, this.totalPage - 1, this.totalPage];
          } else {
            this.initCurrentPageArray();
          }
          this.switchPage(this.currentPage);
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
    computed: {
      
    },
    mounted: function () {
      axios.get('/api/product/search', {
        params: {
          text: '',
          limit: 30,
          page: this.searchPage
        }
      }).then(response => {
        this.products = response.data.products;
        this.totalPage = (response.data.count / 30) + (((response.data.count % 30) !== 0) ? 1 : 0);
        this.initCurrentPageArray();
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
  grid-template-columns: 1fr 1fr 1fr 1fr 1fr ;
  grid-auto-rows: 20vh;
  grid-column-gap: 10px; /* 設定左右間距 */
  grid-row-gap: 20px; /* 設定上下間距 */
  max-width: 100vw;
}
.grid-item {
  width: auto;
  height: 100%;
  max-height: 240px;
  max-width: 240px;
}
.dot {
  height: 2rem;
  width: 2rem;
  background-color: #bbb;
  border-radius: 50%;
  display: flex;
}
.dot-blue {
  height: 2rem;
  width: 2rem;
  background-color: #0389ff;
  border-radius: 50%;
  display: flex;
}
/* 頁面切換按鈕的置中 */
.text-dot {
    width: 100%;
    height: 100%;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content: center;
}
/* 針對所有 fontawesome 的圖片元素class 置中 */
.fas {
    width: 100%;
    height: 100%;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content: center;
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