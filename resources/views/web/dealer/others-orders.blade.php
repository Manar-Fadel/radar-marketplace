@extends('web.layout.default')
@section('content')

    <style>
        nav div span, nav div a{
            margin: 0 10px !important;
        }
    </style>
<div class="search-input-area">
    <div class="container">
        <div class="search-input-inner">
            <div class="input-div">
                <input class="search-input autocomplete" type="text" placeholder="Search by keyword or #">
                <button><i class="far fa-search"></i></button>
            </div>
        </div>
    </div>
    <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
</div>
<div id="anywhere-home">
</div>
<!-- progress area start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
        </path>
    </svg>
</div>
<!-- progress area end -->

<div class="rts-wrapper">
    <div class="rts-wrapper-inner">

        <!-- header area start -->
        @include('web.includes.login-header')
        <!-- header area end -->

        <!-- Pricing Start -->
        <section class="rts-portfolio-area sold-car rts-section-gap">
            <div class="container">
                <div class="section-inner">
                    <div class="row g-5">
                        @foreach($orders as $order)
                        <div class="col-lg-4 col-md-6">
                            <div class="project-wrapper2">
                                <div class="image-area text-center">
                                    <a href="{{ route('my-orders.view', ['id', $order->id]) }}">
                                        <img src="{{ $order->main_image_url }}" alt="{{ $order->description }}" style="height: 240px;">
                                    </a>
                                    @if($order->status == 'PENDING' && count($order->offers) == 0 )
                                    <span class="tag">
                                        {{ __('web.will get offers soon') }}
                                    </span>
                                    @elseif($order->status == 'PENDING' && count($order->offers) > 0 )
                                    <span class="tag">
                                        {{ __('web.waiting accept') }}
                                    </span>
                                    @elseif($order->status == 'ACCEPTED')
                                    <span class="tag">
                                        {{ __('web.offer accepted') }}
                                    </span>
                                    @endif

                                    <a href="{{ route('my-orders.view', ['id' => $order->id]) }}" class="wishlist">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    @if(count($order->images) > 0)
                                    <a href="{{ route('my-orders.view', ['id' => $order->id]) }}" class="gallery-image">
                                        <img src="{{ URL::asset("assets/webassets/images/icon/image.svg") }}" alt="">
                                        {{ count($order->images) }}
                                    </a>
                                    @endif
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title ">
                                        <a href="{{ route('my-orders.view', ['id' => $order->id]) }}">
                                            {{ $order->description }}
                                        </a>
                                    </h6>
                                    <div class="button-area">
                                        @if(count($order->offers) > 0)
                                        <p class="">
                                            {{ count($order->offers) }} {{ __('web.offer') }}
                                        </p>
                                        @endif
                                        <a class="btn rts-btn btn-primary radius-small" data-modal-toggle="#add_new_offer{{$order->id}}">
                                            {{ __('web.Send Offer') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                            @include('web.includes.create-offer', ['order' => $order])
                        @endforeach
                    </div>
                </div>

                <!-- pagination -->
                <div class="container row col-12" style="margin-top: 15px;">
                    <div class="swiper-pagination">
                        {{ $orders->onEachSide(1)->links() }}
                    </div>
                </div>

            </div>
        </section>
        <!-- Pricing End -->

    </div>
</div>

<!-- rts footer area start -->
@include('web.includes.footer')
<!-- rts footer area end -->

<!-- header style two -->
@include('web.includes.header-two')
<!-- header style two End -->
@endsection

