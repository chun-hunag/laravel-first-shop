@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex">
        {{-- picture --}}
        <div class="col-md-5">
            <div class="col-md-12 text-center">
                主圖
            </div>
            <div class="col-md-12 d-flex text-center">
                <div class="col-md-1 text-left">
                    <
                </div>
                <div class="col-md-10">
                    圖
                </div>
                <div class="col-md-1 text-right">
                    >
                </div>
            </div>
        </div>
        {{-- infomation --}}
        <div class="col-md-7">
            {{-- title --}}
            <div class="col-md-12 text-center">
                我是標題
            </div>
            <div class="col-md-12 text-center">
                我是價格
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
@endsection
