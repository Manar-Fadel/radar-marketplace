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
        <div class="rts-breadcrumb-area service jarallax">
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
        <div class="rts-contact-page-form-area rts-section-gapNew rts-section-gap account">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mian-wrapper-form">
                            <div class="title-mid-wrapper-home-two sal-animate" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                                <h3 class="title">
                                    {{ __('web.Login') }}
                                </h3>
                            </div>
                            <form id="contact-form-contact" action="{{ route('login') }}" method="post">

                                <input type="email" name="email" placeholder="{{ __('web.Email Address') }}" required="">

                                <input type="password" name="name" placeholder="{{ __('web.Password') }}" required="">

                                <div class="checkbox">
                                    <input type="checkbox" value="lsRememberMe" id="rememberMe">
                                    <label for="rememberMe">
                                        {{ __('web.Remember me') }}
                                    </label>
                                </div>

                                <button type="submit" class="rts-btn btn-primary radius-small">
                                    {{ __('web.Log In') }}
                                </button>
                                <div class="forgot-password">
                                    <a href="#0">
                                        {{ __('web.Forgot Your Password?') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mian-wrapper-form">
                            <div class="title-mid-wrapper-home-two sal-animate" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                                <h3 class="title">
                                    {{ __('web.Registration') }}
                                </h3>
                            </div>
                            <form id="contact-form-contact" action="mailer.php" method="post">
                                <input type="text" name="name" placeholder="Your Name" required="">
                                <input type="email" name="email" placeholder="Email Address" required="">
                                <input type="text" name="name" placeholder="New Password" required="">
                                <input type="text" name="name" placeholder="Confirm Password" required="">

                                <button type="submit" class="rts-btn btn-primary radius-small">
                                    {{ __('web.Register') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
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
