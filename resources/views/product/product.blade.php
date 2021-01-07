@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex">
        {{-- picture --}}
        <div class="col-md-5">
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
        <div class="col-md-7">
            {{-- title --}}
            <div class="col-md-12 text-center">
                {{$product->title}}
            </div>
            <div class="col-md-12 text-center">
                {{$product->price}}
            </div>
            <div class="col-md-12 text-center">
                ProductSku
            </div>
            <div class="col-md-12 text-center">
                數量
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
  </style>
<script>
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
</script>
@endsection
