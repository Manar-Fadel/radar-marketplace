@extends('web.layout.default')
@section('content')

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
        <!-- header area start -->
        @include('web.includes.login-header')
        <!-- header area end -->

        <!-- Breadcrumb area start -->
        <!-- rts breadcrumb area start -->
        <div class="rts-category-area rts-breadcrumb-area portfolio-3 jarallax" style="margin-top: 0; height: 300px; padding: 3% 0;">
            <div class="container">
                <div class="breadcrumb-area-wrapper">
                    <h1 class="title">{{ __('web.Account') }}</h1>
                    <div class="nav-bread-crumb">
                        <a href="{{ route('home') }}">{{ __('web.Home') }}</a>
                        <a href="#" class="current">{{ __('web.Account') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- rts breadcrumb area end -->
        <!-- Breadcrumb area end -->
        <!-- Contact Start -->
        <div class="rts-category-area rts-contact-page-form-area rts-section-gapNew rts-section-gap account" style="margin-top: 0; padding-top: 30px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="mian-wrapper-form">
                            <div class="title-mid-wrapper-home-two sal-animate" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                                <h3 class="title">
                                    {{ __('web.Registration') }}
                                </h3>
                            </div>
                            <form id="contact-form-contact"  enctype="multipart/form-data"
                                  action="{{ route('register') }}" method="post">
                                @csrf

                                <input type="text" name="full_name" id="full_name"
                                       placeholder="{{ __('web.Full Name') }}" required="">
                                <input type="email" name="email" id="email"
                                       placeholder="{{ __('web.Email Address') }}" required="">
                                <input type="text" name="phone_number" id="phone_number"
                                       placeholder="{{ __('web.Mobile Number') }}" required="">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>{{ __('web.User Type') }}</label>
                                    </div>
                                    <div class="col-lg-9 row" style="font-size: 14px;">
                                        <div class="radio-group col-lg-6 align-content-center">
                                            <input type="radio" name="user_type" id="dealer_type" class="ratio font-semibold" value="DEALER">
                                            <span for="dealer_type">{{ __('web.Dealer') }}</span>

                                        </div>
                                        <div class="radio-group col-lg-6 align-content-center">
                                            <input type="radio" name="user_type" id="bank_type" class="ratio font-semibold" value="BANK_DELEGATE">
                                            <span for="bank_type">{{ __('web.Bank Delegate') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <input type="file" class="img-fluid" name="document_url" id="document_url">
                                <input type="file" class="img-fluid" name="showroom_doc" id="showroom_doc">

                                <input type="password" name="password" id="password"
                                       placeholder="{{ __('web.New Password') }}" required="">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       placeholder="{{ __('web.Confirm Password') }}" required="">

                                <button type="submit" class="rts-btn btn-primary radius-small">
                                    {{ __('web.Register') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-shape-area">
                <img src="{{ URL::asset("assets/web/images/category/shape/shape-01.svg") }}" alt="">
                <img src="{{ URL::asset("assets/web/images/category/shape/shape-02.svg") }}" alt="">
            </div>
        </div>
        <!-- Contact End -->
    </div>
</div>

<!-- rts footer area start -->
@include('web.includes.footer')
<!-- rts footer area end -->
<!-- header style two -->
@include('web.includes.header-two')
<!-- header style two End -->
@endsection
