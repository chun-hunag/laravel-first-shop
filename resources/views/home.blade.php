@extends('layouts.app')

@section('content')
<div class="container mx-2">
    {{-- breadcrumb --}}
    <div id='breadcrumb-trail'>
        <div class="d-flex">
            <div class="m-1">
            <a href="/">{{ __('home.title')}}</a>
            </div>
            <div class="m-1"> > </div>
            <div class="m-1">{{ __('home.home') }}</div>
        </div>
    </div>
    {{-- card panel --}}
    <div class="row justify-content-center">
        <div class="col-md-12 m-2 float font-color-blue-deep section-header">{{ __('home.home') }}</div>
        <div class="col-md-12 p-2 bg-gray panel-container">
            {{-- account managemnet --}}
            <div class="col-md-12 panel-title font-color-blue-mid">
                <i class="fa fa-user" aria-hidden="true"></i>
                {{__('home.account_manage')}}
            </div>
            <div class="d-flex">
                <div class="col-md-3 m-2 card">
                    <a href="{{ URL::route('home') }}">{{__('home.change_member_data')}}</a>
                </div>
                <div class="col-md-3 m-2 card">
                    <a href="{{ URL::route('home') }}">{{__('home.change_password')}}</a>
                </div>
            </div>
            {{-- trade recorder --}}
            <div class="col-md-12 panel-title font-color-blue-mid">
                <i class="fa fa-credit-card" aria-hidden="true"></i>
                {{__('home.order_recorder')}}
            </div>
            <div class="d-flex">
                <div class="col-md-3 m-2 card">
                    <a href="{{ URL::route('home') }}">{{__('home.order_search')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style scoped>
.section-header {
    border-bottom: 1px solid #1c79c0;
    font-size: 1.5rem;
}

.panel-container {
    min-height: 30vh;
    border-radius: 5px;
}

.panel-title {
    border-bottom: 1px solid #0389ff;
    font-size: 1.0rem;
}

.card {
    background-color: #FFFFFF;
    border-radius: 5px;
    border: 1px solid #c0c0c0;
}
</style>