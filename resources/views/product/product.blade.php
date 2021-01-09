@extends('layouts.app')
@section('content')
<div class="container product-container">
    <div class="d-flex">
        {{-- picture --}}
        <div class="col-md-5 pl-0">
            <div class="swiper-container gallery-top">
                <div class="swiper-wrapper">
                    @foreach ($product->images as $image)
                        <div class="swiper-slide" style="background-image:url({{'/upload/' . $image}})"></div>
                    @endforeach
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next swiper-button-white"></div>
                <div class="swiper-button-prev swiper-button-white"></div>
            </div>
            <div class=" swiper-container gallery-thumbs">
                <div class="swiper-wrapper">
                    @foreach ($product->images as $image)
                        <div class="swiper-slide" style="background-image:url({{'/upload/' . $image}})"></div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- infomation --}}
        <div class="col-md-7 product-column-container">
            {{-- title --}}
            <div class="col-md-12 text-center product-title">
                <strong>{{ $product->title }}</strong>
            </div>
            <div class="col-md-12 text-right">
                <strong>{{ $product->review_count }}</strong>
                <span class="product-review-count-text">已售出</span>
            </div>
            <div class="col-md-12 my-2 text-center deep-red bg-gray product-price">
                <span class="">${{ $product->price }}</span>
            </div>
            <div class="col-md-12 my-2 text-center d-flex">
                @foreach ($productSkus as $productSku)
                    <div class="m-1 border ">{{ $productSku->title}}</div>
                @endforeach
            </div>
            <div class="col-md-12 my-2 text-center d-flex">
                <div class="col-md-3 text-left gray">數量</div>
                <div class="col-md-6 p-0 text-center border d-flex" id="product-amount">
                    <button class="col-md-3 product-amount-btn-minus" id="product-amount-btn-minus" onclick="amountMinus()">-</button>
                    <div class="col-md-6 product-amount-value" id="product-amount-value">{{0}}</div>
                    <button class="col-md-3 product-amount-btn-plus" id="product-amount-btn-plus" onclick="amountPlus()">+</button>
                </div>
                <div class="col-md-3 text-right gray" id="product-remain">還剩{{1}}件</div>
            </div>
            <div class="col-md-12 text-center d-flex">
                <div class="col-md-6">
                    加入購物車
                </div>
                <div class="col-md-6">
                    直接購買
                </div>
            </div>
        </div>
    </div>

</div>
<style>
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
  </style>
<script>
    // variable declare
    var amount = 1;
    var stock = <?php echo $productSkus[0]->stock?>;
    window.onload = function () {
        var galleryThumbs = new Swiper('.gallery-thumbs', {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
            });
        var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs
        }
        });
    };
    function amountMinus () {
        amount -= 1;
        if(amount < 1){
            amount = 1;
        }
        console.log("Minus");
    }
    function amountPlus () {
        amount += 1;
        console.log("Plus");
    }

</script>
@endsection
