<template>
<div class="container product-container content">
    <div class="d-flex">
        <!-- picture -->
        <div class="col-md-5 pl-0">
            <!-- swiper1 -->
            <swiper :options="swiperOptionTop" class="gallery-top" ref="swiperTop" >
              <div v-for="(image, index) in images" :key="index" class="swiper-slide" :style="'background-image:url(' + '/upload/' + image + ')'"></div>

              <div class="swiper-button-next swiper-button-white" slot="button-next"></div>
              <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
            </swiper>
            <!-- swiper2 Thumbs -->
            <swiper :options="swiperOptionThumbs" class="gallery-thumbs" ref="swiperThumbs">
               <div v-for="(image, index) in images" :key="index" class="swiper-slide" :style="'background-image:url(' + '/upload/' + image + ')'"></div>
            </swiper>
        </div>

        <!-- infomation -->
        <div class="col-md-7 product-column-container">
            <!-- title -->
            <div class="col-md-12 h-10 text-center product-title">
                <strong>{{ title }}</strong>
            </div>
            <div class="col-md-12 h-10 text-center">
                <div>
                  <strong>{{ reviewCount }}</strong>
                  <span class="product-review-count-text">已售出</span>
                </div>
            </div>
            <div class="col-md-12 my-2 h-20 text-center deep-red bg-gray product-price">
                    <span class="verticle-center">${{ price }}</span>
            </div>
            <div class="col-md-12 h-20 my-2 ">
                <div class="text-center d-flex">
                    <div v-for="(productSku, index) in productSkus" :key="productSku.id" :class="'m-1 ' + (isSelected(productSku.id) ? 'productSku-selected' : 'border') " @click="selectSku(productSku.id)" >{{ productSku.title}}</div>
                </div>
            </div>
            <div class="col-md-12 h-10 my-2 ">
                <div class="text-center d-flex">
                    <div class="col-md-3 text-left gray">數量</div>
                    <div class="col-md-6 p-0 text-center border d-flex" id="product-amount">
                        <button class="col-md-3 product-amount-btn-minus" id="product-amount-btn-minus" @click="minusAmount()">-</button>
                        <div class="col-md-6 product-amount-value" id="product-amount-value">{{amount}}</div>
                        <button class="col-md-3 product-amount-btn-plus" id="product-amount-btn-plus" @click="addAmount()">+</button>
                    </div>
                    <div class="col-md-3 text-right gray" id="product-remain">還剩{{stock}}件</div>
                </div>
            </div>
            <div class="col-md-12 h-10 text-center d-flex">
                <!-- 加入購物車按鈕 -->
                <div class="col-md-6 mx-2 h-100 bg-blue-mid white product-cart-btn"  @click="addCart()">
                    <span class="verticle-center">加入購物車</span>
                </div>
                <!-- 加入購物車後 跳結帳頁面 -->
                <div class="col-md-6 mx-2 h-100 bg-blue-mid white product-buy-btn"  @click="addAnadGoCart()">
                    <span class="verticle-center">直接購買</span>
                </div>
            </div>
        </div>
    </div>

</div>

</template>

<script>
import axios from 'axios';
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';

export default {
    data () {
      return {
          title: '',
          reviewCount: 0,
          price: '',
          images: [],
          amount: 1,
          product: '',
          productSkus: [],
          selectedSkuId : 0,
          swiperOptionTop: {
            notNextTick: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            spaceBetween: 10
          },
          swiperOptionThumbs: {
            notNextTick: true,
            spaceBetween: 10,
            centeredSlides: true,
            slidesPerView: 'auto',
            touchRatio: 0.2,
            slideToClickedSlide: true
          }
      } 
    },
    components: {
      Swiper,
      SwiperSlide
    },
    methods: {
        addAmount: function () { // 增加數量
            this.amount += 1;
            if (this.amount > this.stock) {
              this.amount = this.stock;
            }
        },
        minusAmount: function () { // 減少數量
            this.amount -= 1;
            if (this.amount < 1) {
              this.amount = 1;
            }
        },
        selectSku: function (id) { // 選擇單品庫存
            this.selectedSkuId = id;
            if (this.amount > this.stock) {
              this.amount = this.stock;
            }
        },
        isSelected: function (id) {
            return id === this.selectedSkuId;
        },
        addCart: async function () { // 將商品加入購物車
            let jwtToken = this.$store.state.jwtToken;
            await axios.post('/api/auth/cart-add', {
                'product_id': this.product.id,
                'product_sku_id': this.selectedSkuId,
                'amount': this.amount
            }, {
                headers: {
                    'Authorization': `Bearer ${jwtToken}`
                }
            })
            .then(response => { // 成功會直接回傳最新的購物車資料
                this.$store.commit('setCart', response.data)
            })
            .catch(error => { // 失敗應跳出Modal 提示

            });
        },
        addAnadGoCart: async function () { // 將商品加入購物車後跳到購車頁面
            await this.addCart();
            this.$router.push('cart');
        }
    },
    computed: {
        stock: function () { 
            let stock = 0;
            this.productSkus.forEach(element => {
              if (this.selectedSkuId === element.id) {
                stock = element.stock;
              }
            });
            return stock;
          }
    },
    mounted: function () {
        // swipper 設定
        this.$nextTick(() => {
          const swiperTop = this.$refs.swiperTop.$el.swiper
          const swiperThumbs = this.$refs.swiperThumbs.$el.swiper
          swiperTop.controller.control = swiperThumbs
          swiperThumbs.controller.control = swiperTop
        })
        // 搜尋該筆商品資訊
        let id = this.$route.query.id;
        if (id === null) {
            this.$router.push('index');
            return;
        }
        // 發出請求
        axios.get('/api/product/' + id,)
        .then(response => {
            this.product = response.data.product;
            this.productSkus = response.data.productSkus;
            this.images = this.product.images;
            this.title = this.product.title;
            this.reviewCount = this.product.review_count;
            this.price = this.product.price;
            this.selectedSkuId = this.productSkus[0].id;
        }).catch(error => { // 應使用modal 跳警告視窗

        });
  },

}
</script>

<style scoped>
    .swiper-container {
      width: 100%;
      height: 300px;
      margin-left: auto;
      margin-right: auto;
    }

    .swiper-slide {
      background-size: cover;
      background-position: center;
    }

    .gallery-thumbs {
      max-height: 150px;
      box-sizing: border-box;
      padding: 10px 0;
    }

    .gallery-thumbs .swiper-slide {
      width: 150px;
      height: 150px;
      opacity: 0.4;
    }

    .gallery-thumbs .swiper-slide-thumb-active {
      opacity: 1;
    }
    .product-review-count-text{
      font-size: .875rem;
      color: #767676;
      text-transform: capitalize;
    }
    .product-container { 
      padding-left: 0px;
      background-color: #FFFFFF;
    }

    .product-colum-container { 
      padding: 1rem;
    }

    .product-title {
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 3;
      font-size: 1.25rem
    }
    .product-amount-value {
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 3;
    }
    .product-amount-btn-minus {
      background-color: #FFFFFF;
      border-top: 0px solid #dee2e6; ;
      border-bottom: 0px solid #dee2e6; ;;
      border-left: 0px solid #dee2e6; ;;
      border-right: 1px solid #dee2e6; ;;
    }
    .product-amount-btn-plus {
      background-color: #FFFFFF;
      border-top: 0px solid #dee2e6; ;
      border-bottom: 0px solid #dee2e6; ;;
      border-left: 1px solid #dee2e6; ;;
      border-right: 0px solid #dee2e6; ;;
    }
    .product-price {
      font-size: 1.875rem;
      font-weight:500;
    }
    .productSku-selected {
      border: #1c79c0 solid 4px;
    }
    .product-cart-btn {

    }
    .product-buy-btn {

    }
  </style>